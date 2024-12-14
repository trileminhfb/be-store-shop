<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\ItemInvoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class InvoiceController extends Controller
{
    protected $paymentController;
    private $feeShipping = 30000;

    public function __construct(PaymentController $paymentController)
    {
        $this->paymentController = $paymentController;
    }

    public function getData(Request $request)
    {
        $data = Invoice::with(['items.product'])->where('id_user', $request->user()->id)->orderBy('created_at', 'desc')->get();

        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'Hóa đơn không tồn tại',
            ]);
        }

        return response()->json([
            'message' => 'Lấy dữ liệu hóa đơn',
            'data' => InvoiceResource::collection($data),
        ]);
    }

    public function createData(Request $request)
    {
        try {
            DB::beginTransaction();

            $total = 0;
            $invoice = Invoice::create([
                'date' => now(),
                'id_user' => $request->user()->id,
            ]);

            foreach ($request->carts as $key => $value) {

                if ($request->isInCart) {
                    Cart::where('id_product', $value['id_product'])
                        ->where('id_user', $request->user()->id)
                        ->delete();
                }

                $product = Product::find($value['id_product']);

                $total += $product->price * $value['quantity'];



                ItemInvoice::create([
                    'id_product' => $value['id_product'],
                    'id_invoice' => $invoice->id,
                    'quantity' => $value['quantity'],
                ]);
            }

            $request['price'] = $total + $this->feeShipping;
            $request['id_invoice'] = $invoice->id;

            $response = $this->paymentController->payment($request);

            DB::commit();

            return response()->json([
                'link' => $response->getData()->link
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());

            return response()->json([
                'error' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);

        $items = ItemInvoice::with('product')
            ->where('id_invoice', $id)
            ->get();

        foreach ($items as $key => $value) {
            $product = Product::find($value->product->id);

            $product->quantity -= $value->quantity;
            $product->save();
        }

        if (!$invoice) {
            return response()->json([
                'message' => 'Hóa đơn không tồn tại',
            ], Response::HTTP_NOT_FOUND);
        }

        $invoice->update($request->all());

        return response()->json([
            'message' => 'Cập nhật hóa đơn thành công',
            'data' => $invoice,
        ], Response::HTTP_OK);
    }
}

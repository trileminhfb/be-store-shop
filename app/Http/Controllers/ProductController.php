<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private $imageController;
    public function __construct(ImageController $imageController)
    {
        $this->imageController = $imageController;
    }

    public function getData()
    {
        // Fetch all products from the database
        $data = Product::all(); // or Product::get()

        // Check if data exists
        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'Không có sản phẩm nào trong hệ thống.',
                'data' => [],
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Lấy data sản phẩm thành công',
            'data' => $data,
        ], Response::HTTP_OK);
    }

    public function getDataForGender($gender)
    {
        $data = Product::where('gender', $gender)->get();

        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'Không có sản phẩm nào trong hệ thống.',
                'data' => [],
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Lấy data sản phẩm thành công',
            'data' => $data,
        ], Response::HTTP_OK);
    }

    public function getDataProduct($id)
    {
        $data = Product::find($id);

        return response()->json([
            'message' => 'Lấy data sản phẩm thành công',
            'data' => $data,
        ], Response::HTTP_OK);
    }

    public function createData(Request $request)
    {
        try {
            DB::beginTransaction();
            $check = Product::where('name', $request->name)->first();

            if ($check) {
                return response()->json([
                    'message' => 'Sản phẩm đã tồn tại',
                ], Response::HTTP_BAD_REQUEST);
            }

            $image = $this->imageController->uploadImage($request);
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $image->getData()->imageUrl,
                'quantity' => $request->quantity,
                'status' => $request->quantity > 0 ? 1 : 0,
                'category' => $request->gender ? 'Đồ nam' : 'Đồ nữ',
                'brand' => 'Balenciaga',
                'gender' => $request->gender,
            ]);

            WareHouse::create([
                'id_product' => $product->id,
                'quantity' => 0,
                'status' => 1,
            ]);
            DB::commit();

            return response()->json([
                'message' => 'Tạo sản phẩm thành công',
                'data' => $product,
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());

            return response()->json([
                'message' => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateData(Request $request)
    {
        try {
            $product = Product::find($request->id);

            if (!$product) {
                return response()->json([
                    'message' => 'Không có sản phẩm này',
                    'data' => $product,
                ], Response::HTTP_BAD_REQUEST);
            }
            $dataUpdate = $request->all();

            if ($request->image != $product->image) {
                $image = $this->imageController->uploadImage($request);
                $dataUpdate['image'] = $image->getData()->imageUrl;
            }

            $product->update($dataUpdate);

            return response()->json([
                'message' => 'Cập nhật sản phẩm thành công',
                'data' => $product,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'message' => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Không có sản phẩm này',
                'data' => $product,
            ], Response::HTTP_BAD_REQUEST);
        }

        $product->update($request->all());

        return response()->json([
            'message' => 'Cập nhật sản phẩm thành công',
            'data' => $product,
        ], Response::HTTP_OK);

    }

    public function deleteData($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return response()->json([
                'message' => 'Xoá sản phẩm thành công',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Sản phẩm không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }

    public function search(Request $request)
    {
        $data = Product::where('name', 'like', '%' . $request->keyword . '%')->get();

        return response()->json([
            'message' => 'Lấy data sản phẩm thành công',
            'data' => $data,
        ], Response::HTTP_OK);
    }
}

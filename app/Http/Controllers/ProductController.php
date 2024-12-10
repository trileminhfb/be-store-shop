<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
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

            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $request->image,
                'quantity' => $request->quantity,
                'status' => $request->status,
                'category' => $request->category,
                'brand' => $request->brand,
                'gender' => $request->gender,
            ]);

            WareHouse::create([
                'id_product' => $product->id,
                'quantity'   => 0,
                'status'     => 1,
            ]);
            DB::commit();

            return response()->json([
                'message' => 'Tạo sản phẩm thành công',
                'data' => $product,
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateData(Request $request)
    {
        $product = Product::find($request->id);

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
                'id' => $id,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Sản phẩm không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}

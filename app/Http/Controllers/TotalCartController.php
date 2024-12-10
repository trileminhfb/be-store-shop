<?php

namespace App\Http\Controllers;

use App\Models\TotalCart;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TotalCartController extends Controller
{
    public function getData()
    {
        $data = TotalCart::with('cart')->get();

        return response()->json([
            'message' => 'lấy data tổng giỏ hàng thành công',
            'data' => $data,
        ], Response::HTTP_OK);
    }

    public function createData(Request $request)
    {
        $check = TotalCart::where('id_cart', $request->id_cart)->first();

        if ($check) {
            return response()->json([
                'message' => 'Đơn đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $total = TotalCart::create([
            'id_cart' => $request->id_cart,
            'id_payment' => $request->id_payment,
            'orderTime' => $request->orderTime,
            'address' => $request->address,
            'phoneNumber' => $request->phoneNumber,
            'total' => $request->total,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Tạo đơn thành công',
            'data' => $total,
        ], Response::HTTP_CREATED);
    }

    public function updateData(Request $request)
    {
        $total = TotalCart::find($request->id);

        if (!$total) {
            return response()->json([
                'message' => 'Không có đơn này',
                'data' => $total,
            ], Response::HTTP_BAD_REQUEST);
        }
        $total->update($request->all());

        return response()->json([
            'message' => 'Cập nhật đơn này thành công',
            'data' => $total,
        ], Response::HTTP_OK);
    }

    public function deleteData($id)
    {
        $check = TotalCart::find($id);

        if ($check) {
            $check->delete();

            return response()->json([
                'message' => 'Xoá đơn thành công',
                'id' => $id,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Đơn không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}

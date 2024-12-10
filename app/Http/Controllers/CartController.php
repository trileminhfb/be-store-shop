<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function getData(Request $request)
    {
        $data = Cart::with('user', 'product')->where('id_user', $request->user()->id)->get();

        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'Giỏ hàng rỗng',
            ]);
        }

        return response()->json([
            'data' => $data,
            'message' => 'Lấy data thành công',
        ], Response::HTTP_OK);
    }

    public function createData(Request $request)
    {
        $check = Cart::where('id_user', $request->id_user)
            ->where('id_product', $request->id_product)
            ->first();

        if ($check) {
            $check->quantity += $request->quantity;
            $check->save();

            return response()->json([
                'message' => 'Cập nhật thành công',
            ], Response::HTTP_OK);
        }
        $user = User::find($request->id_user);
        $product = Product::find($request->id_product);

        if (!$user || !$product) {
            return response()->json([
                'message' => 'Người dùng hoặc sản phẩm không tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $cart = Cart::create([
            'id_user' => $request->id_user,
            'id_product' => $request->id_product,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'cart' => $cart,
        ], Response::HTTP_CREATED);
    }

    public function updateData(Request $request)
    {
        $cart = Cart::find($request->id);

        if (!$cart) {
            return response()->json([
                'message' => 'Không tìm thấy giỏ hàng',
            ], Response::HTTP_BAD_REQUEST);
        }
        $cart->quantity += $request->quantity;
        $cart->save();

        return response()->json([
            'message' => 'Cập nhật thành công',
        ], Response::HTTP_OK);
    }

    public function deleteData($id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json([
                'message' => 'Không tìm thấy giỏ hàng',
            ], Response::HTTP_BAD_REQUEST);
        }
        $cart->delete();

        return response()->json([
            'message' => 'Xóa thành công',
        ], Response::HTTP_OK);
    }

    public function deleteAllFromTable($id_user)
    {
        $user = User::find($id_user);

        if (!$user) {
            return response()->json([
                'message' => 'Không tìm thấy bàn',
            ], Response::HTTP_BAD_REQUEST);
        }

        $cartItems = Cart::where('id_user', $id_user)->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'message' => 'Không có sản phẩm nào trong giỏ',
            ], Response::HTTP_BAD_REQUEST);
        }

        foreach ($cartItems as $item) {
            $item->delete();
        }

        return response()->json([
            'message' => 'Xóa tất cả thành công',
        ], Response::HTTP_OK);
    }
}

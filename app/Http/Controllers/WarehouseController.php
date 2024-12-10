<?php

namespace App\Http\Controllers;

use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class WarehouseController extends Controller
{
    public function getData()
    {
        $data = WareHouse::with(['products'])->get();

        return response()->json([
            'message' => 'lấy data sản phẩm thành công',
            'data' => $data,
        ], Response::HTTP_OK);
    }

    public function createData(Request $request)
    {
        $warehouse = WareHouse::where('id_product', $request->id_product)->first();

        if ($warehouse) {
            $warehouse->quantity += $request->quantity;
            $warehouse->save();

            return response()->json([
                'message' => 'Cập nhật số lượng sản phẩm thành công',
                'data' => $warehouse,
            ], Response::HTTP_OK);
        }

        $newWarehouse = WareHouse::create([
            'id_product' => $request->id_product,
            'quantity'   => $request->quantity,
            'status'     => $request->status,
        ]);

        return response()->json([
            'message' => 'Tạo sản phẩm mới thành công',
            'data'    => $newWarehouse,
        ], Response::HTTP_CREATED);
    }

    public function updateData(Request $request)
    {
        $warehouse = WareHouse::find($request->id);

        if (!$warehouse) {
            return response()->json([
                'message' => 'Không có sản phẩm này',
                'data' => $warehouse,
            ], Response::HTTP_BAD_REQUEST);
        }
        $warehouse->update($request->all());

        return response()->json([
            'message' => 'Cập nhật sản phẩm thành công',
            'data' => $warehouse,
        ], Response::HTTP_OK);
    }
    public function deleteData($id)
    {
        try {
            DB::beginTransaction();
            $warehouse = WareHouse::find($id);

            if ($warehouse) {
                $warehouse->delete();
                DB::commit();

                return response()->json([
                    'message' => 'Xoá sản phẩm trong kho thành công',
                    'id' => $id,
                ], Response::HTTP_OK);
            }

            return response()->json([
                'message' => 'Sản phẩm trong kho không tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}

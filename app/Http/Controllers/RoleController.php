<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function getData()
    {
        $role = Role::get();

        return response()->json([
            'message' => 'lấy data Role thành công',
            'data' => $role,
        ], Response::HTTP_OK);
    }

    public function createData(Request $request)
    {
        $check = Role::where('nameRole', $request->nameRole)->first();

        if ($check) {
            return response()->json([
                'message' => 'Role đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $role = Role::create([
            'nameRole'   => $request->nameRole,
        ]);

        return response()->json([
            'message' => 'Tạo Role thành công',
            'data' => $role,
        ], Response::HTTP_CREATED);
    }

    public function updateData(Request $request)
    {

        $role = Role::find($request->id);

        if (!$role) {
            return response()->json([
                'message' => 'Không có role này',
                'data' => $role,
            ], Response::HTTP_BAD_REQUEST);
        }

        $role->update($request->all());

        return response()->json([
            'message' => 'Cập nhật role thành công',
            'data' => $role,
        ], Response::HTTP_OK);
    }

    public function deleteData($id)
    {
        $check = Role::find($id);

        if ($check) {
            $check->delete();

            return response()->json([
                'message' => 'Xoá Role thành công',
                'id' => $id,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Role không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}

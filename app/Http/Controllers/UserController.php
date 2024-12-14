<?php

namespace App\Http\Controllers;

use App\Enums\invoice\StatusInvoice;
use App\Models\Invoice;
use App\Models\ItemInvoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function getData(Request $request)
    {
        return response()->json([
            'message' => 'Lấy data người dùng thành công',
            'data' => User::with(['role'])->find($request->user()->id),
        ], Response::HTTP_OK);
    }

    public function statistic(Request $request)
    {
        $invoice = Invoice::where('created_at', '>=', Carbon::now()->subDays(30))
            ->where('status', StatusInvoice::DONE)
            ->get();

        $totalProduct = 0;
        $totalPrice = 0;
        $item = ItemInvoice::with('product')->whereIn('id_invoice', $invoice->pluck('id'))->get();
        foreach ($item as $key => $value) {
            $totalProduct += $value->quantity;
            $totalPrice += $value->product->price * $value->quantity;
        }

        return response()->json([
            'totalInvoice' => $invoice->count(),
            'totalProduct' => $totalProduct,
            'totalPrice' => $totalPrice,
        ], Response::HTTP_OK);
    }

    public function getDataAccout($id)
    {
        // Tìm người dùng theo ID và load thông tin role
        $user = User::with(['role'])->find($id);

        if ($user) {
            return response()->json([
                'message' => 'Lấy data người dùng thành công',
                'data' => $user,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Người dùng không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }

    public function createData(Request $request)
    {
        $check = User::where('account', $request->account)->first();

        if ($check) {
            return response()->json([
                'message' => 'Người dùng đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = User::create([
            'account' => $request->account,
            'password' => bcrypt($request->password),
            'id_role' => 2,
            'fullName' => $request->fullName,
            'address' => $request->address,
            'birth' => $request->birth,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'Tạo người dùng thành công',
            'data' => $user,
        ], Response::HTTP_CREATED);
    }

    public function updateData(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Không có người dùng này',
                'data' => $user,
            ], Response::HTTP_BAD_REQUEST);
        }

        $user->update($request->all());

        return response()->json([
            'message' => 'Cập nhật người dùng thành công',
            'data' => $user,
        ], Response::HTTP_OK);
    }

    public function deleteData($id)
    {
        $check = User::find($id);

        if ($check) {
            $check->delete();

            return response()->json([
                'message' => 'Xoá người dùng thành công',
                'id' => $id,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Người dùng không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }

    public function authorization(Request $request)
    {
        if ($request->bearerToken()) {
            return response()->json([
                'status' => true,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => false,
        ], Response::HTTP_OK);
    }

    /**
     * login account for user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $user = User::where('account', $request->account)->first();

            if ($user && auth()->attempt(['account' => $request->account, 'password' => $request->password])) {
                $token = auth()->user()->createToken(
                    'authToken',
                    ['*'],
                    now()->addDays(7)
                )->plainTextToken;

                return response()->json([
                    'message' => 'oke',
                    'token' => $token,
                    'access_token' => $token,
                    'type_token' => 'Bearer',
                    'data' => auth()->user()
                ], Response::HTTP_OK);
            }

            return response()->json([
                'message' => 'Sai thông tin',
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'message' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout(Request $request)
    {
        try {
            //code...

            $user = $request->user();

            if ($user) {
                $user->currentAccessToken()->delete();

                return response()->json([
                    'message' => 'oke',
                ], Response::HTTP_OK);
            }

            return response()->json([
                'message' => 'm chưa đăng nhập',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'message' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

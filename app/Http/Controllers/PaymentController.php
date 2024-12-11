<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $vnpTmnCode = env('VNPAY_TMN_CODE');
            $vnpHashSecret = env('VNPAY_SECRET_KEY');
            $vnpUrl = env('VNPAY_URL');

            $vnpTxnRef = uniqid();
            $vnpAmount = $request->price;
            $vnpLocale = 'vn';
            $vnpBankCode = 'VNBANK';
            $vnpIpAddr = $request->ip();

            $startTime = date('YmdHis');
            $expire = date('YmdHis', strtotime('+15 minutes'));

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnpTmnCode,
                "vnp_Amount" => $vnpAmount * 100,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => $startTime,
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnpIpAddr,
                "vnp_Locale" => $vnpLocale,
                "vnp_OrderInfo" => "Thanh toan GD:" . $vnpTxnRef,
                "vnp_OrderType" => "other",
                "vnp_ReturnUrl" => 'http://localhost:5173/?statusPayment=true&id_invoice=' . $request->id_invoice,
                "vnp_TxnRef" => $vnpTxnRef,
                "vnp_ExpireDate" => $expire,
                "vnp_BankCode" => $vnpBankCode,
            );



            ksort($inputData);
            $query = "";
            $hashdata = "";

            foreach ($inputData as $key => $value) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $hashdata = ltrim($hashdata, '&');
            $query = rtrim($query, '&');

            $vnpUrl = $vnpUrl . "?" . $query;

            if (isset($vnpHashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnpHashSecret);
                $vnpUrl .= '&vnp_SecureHashType=SHA512&vnp_SecureHash=' . $vnpSecureHash;
            }


            return response()->json([
                'link' => $vnpUrl
            ]);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

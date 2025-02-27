<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
include(base_path() . '/phpqrcode/qrlib.php');
use App\Http\Requests\QrcodeRequest;
use QRcode;

class QrcodeController extends Controller
{

    public function getQrcode(QrcodeRequest $request)
    {
        $str = implode(", ", $request->validated());

        if (!file_exists(base_path() . '/storage/app/public/QRCode')) {
            mkdir(base_path() . '/storage/app/public/QRCode');
        }

        QRcode::png($str, base_path() . '/storage/app/public/QRCode/qrcode.png');

        return json_encode(asset('storage/QRCode/qrcode.png'));

    }

}


<?php

namespace App\Http\Controllers\Frontend;

require_once app_path().'/../vendor/qiniu/php-sdk/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;


use App\Http\Controllers\Controller;

/**
 * Class UploadController
 * @package App\Http\Controllers\Frontend
 */
class UploadController extends Controller
{

    const AK = 'CLAeGg5QgsvBP3frmUz_1tmCEZL295RBeDkuARd9';
    const SK = 'QmEkX_oWGQDKMx2yKg5wxwsEkE8y8OKYw8xdsJrJ';
    const BN = 'ijiangjiu';


    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $auth = new Auth(self::AK, self::SK);
        $token = $auth->uploadToken(self::BN);
        $uploadMgr = new UploadManager();

        $filePath = $_FILES['file']['tmp_name'];
        $key = $_FILES['file']['name'];

        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);

        if ($err !== null) {
            return response()->json(['result'=>false,'err'=>$err]);
        } else {
            return response()->json(['result'=>true,'ret'=>$ret]);
        }

//        return response()->json(['result'=>true,'ret'=>$_FILES]);
    }
}
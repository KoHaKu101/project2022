<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Settingnumber;
use App\Models\Img;
class EditController extends Controller
{
    public function randUNID($table)
    {
        $number = date('ymdhis', time());
        $length = 7;
        do {
            for ($i = $length; $i--; $i > 0) {
                $number .= mt_rand(0, 9);
            }
        } while (
            !empty(
                DB::table($table)
                ->where('UNID', $number)
                ->first(['UNID'])
            )
        );
        return $number;
    }
    public function home()
    {
        $DATA_SLIDE = Settingnumber::where('TYPE_SETTING', '=', 'SLIDE')->first();
        $DATA_DIRECTOR = Img::where("IMG_TYPE",'=','DIRECTOR' )->where("STATUS",'=',"OPEN")->first();
        $IMG_SLIDE = isset($DATA_SLIDE) ? Img::where("UNID_SETTING_NUMBER",'=',$DATA_SLIDE->UNID )->where("STATUS",'=',"OPEN")->get() : false;
        $IMG_DIRECTOR = isset($DATA_DIRECTOR->IMG_FILE) ? $DATA_DIRECTOR->IMG_FILE.$DATA_DIRECTOR->IMG_EXT : 'no_img.png';
        $LIMIT_NUMBER = isset($DATA_SLIDE->TYPE_NUMBER) ? $DATA_SLIDE->TYPE_NUMBER : '5';


        return view('masteredit.master',compact('LIMIT_NUMBER','IMG_SLIDE','IMG_DIRECTOR'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Settingnumber;
use App\Models\SlideImg;
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
        $IMG_SLIDE = isset($DATA_SLIDE) ? SlideImg::where("UNID_SETTING_NUMBER",'=',$DATA_SLIDE->UNID )->where("STATUS",'=',"OPEN")->get() : false;
        $LIMIT_NUMBER = isset($DATA_SLIDE->TYPE_NUMBER) ? $DATA_SLIDE->TYPE_NUMBER : '5';


        return view('masteredit.master',compact('LIMIT_NUMBER','IMG_SLIDE'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Settingnumber;
use App\Models\Img;
use GuzzleHttp\Psr7\Request;
use App\Models\Post;
use App\Models\AboutSchool;
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
        $IMG_SLIDE = isset($DATA_SLIDE->UNID) ? Img::where('UNID_SETTING_NUMBER','=',$DATA_SLIDE->UNID )->where('STATUS','=','OPEN')->get() : false;
        $LIMIT_NUMBER = isset($DATA_SLIDE->TYPE_NUMBER) ? $DATA_SLIDE->TYPE_NUMBER : '5';

        $DIRECTOR_IMG = Img::where('IMG_TYPE','=','DIRECTOR' )->where('STATUS','=','OPEN')->first();
        $IMG_DIRECTOR = isset($DIRECTOR_IMG->IMG_FILE) ? $DIRECTOR_IMG->IMG_FILE.$DIRECTOR_IMG->IMG_EXT : 'no_img.png';

        $DIRECTOR_TEXT = Post::where('POST_TYPE','=','DIRECTOR')->first();
        $ABOUT_SCHOOL   = AboutSchool::select('UNID','ABOUT_NAME','ABOUT_NUMBER')->orderBy('ABOUT_NUMBER')->get();
        return view('editpage.home',compact('LIMIT_NUMBER','IMG_SLIDE','IMG_DIRECTOR','DIRECTOR_TEXT','ABOUT_SCHOOL'));
    }

}

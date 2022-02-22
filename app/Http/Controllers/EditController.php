<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

use App\Models\Settingnumber;
use App\Models\Img;
use App\Models\Dircetor;
use App\Models\AboutSchool;
use App\Models\Post;
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

        $DATA_DIRCETOR  = Dircetor::first();
        $DIRECTOR_IMG   = isset($DATA_DIRCETOR->DIRCETOR_IMG) ? $DATA_DIRCETOR->DIRCETOR_IMG . $DATA_DIRCETOR->DIRCETOR_IMG_EXT : 'no_img.png';

        $ABOUT_SCHOOL   = AboutSchool::select('UNID','ABOUT_NAME','ABOUT_NUMBER')->orderBy('ABOUT_NUMBER')->get();
        $DATA_POST      = Post::where('POST_TYPE','=','PDF')->paginate(9);
        return view('editpage.home',compact('LIMIT_NUMBER','IMG_SLIDE','DIRECTOR_IMG','DATA_DIRCETOR','ABOUT_SCHOOL','DATA_POST'));
    }
    public function showpost(Request $request){
        $POST_TYPE = $request->POST_TYPE;
        $DATA_POST = Post::where('POST_TYPE','=',$POST_TYPE)->orderby('POST_DAY','ASC')->get();
        $html = '';
        foreach ($DATA_POST as $index => $row) {
            $html+= '' ;
        }
    }
}

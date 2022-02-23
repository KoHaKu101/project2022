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
    public function home(Request $request)
    {
        $POST_MONTH = isset($request->select_month_post) ? $request->select_month_post : date('n') ;
        $POST_TYPE = isset($request->select_type_post) ? $request->select_type_post : 'DEFAULT' ;
        $DATA_SLIDE = Settingnumber::where('TYPE_SETTING', '=', 'SLIDE')->first();
        $IMG_SLIDE = isset($DATA_SLIDE->UNID) ? Img::where('UNID_SETTING_NUMBER','=',$DATA_SLIDE->UNID )->where('STATUS','=','OPEN')->get() : false;
        $LIMIT_NUMBER = isset($DATA_SLIDE->TYPE_NUMBER) ? $DATA_SLIDE->TYPE_NUMBER : '5';

        $DATA_DIRCETOR  = Dircetor::first();
        $DIRECTOR_IMG   = isset($DATA_DIRCETOR->DIRCETOR_IMG) ? $DATA_DIRCETOR->DIRCETOR_IMG . $DATA_DIRCETOR->DIRCETOR_IMG_EXT : 'no_img.png';

        $ABOUT_SCHOOL   = AboutSchool::select('UNID','ABOUT_NAME','ABOUT_NUMBER')->orderBy('ABOUT_NUMBER')->get();
        $DATA_POST      = Post::where('POST_MONTH','=',$POST_MONTH)->where('POST_TYPE','=',$POST_TYPE)->paginate(2);

        return view('editpage.home',compact('LIMIT_NUMBER','IMG_SLIDE','DIRECTOR_IMG','DATA_DIRCETOR','ABOUT_SCHOOL'
                                            ,'DATA_POST','POST_MONTH','POST_TYPE'));
    }
    public function fetchpost(Request $request){
        $POST_MONTH = $request->select_month_post ;
        $POST_TYPE = $request->select_type_post ;
        $PAGE = $request->page;
        $DATA_POST      = Post::where('POST_MONTH','=',$POST_MONTH)->where('POST_TYPE','=',$POST_TYPE)->paginate(2);
        $fetchpost = '';
        foreach($DATA_POST->items($PAGE) as $key => $row){
            $fetchpost .= '<div class="col-sm-6 col-md-6 col-lg-4 text-center">
                                <button type="button" class="btn btn-primary btn-lg my-2"
                                    style="font-size: 1.1625rem;"
                                    data-name="'.$row->POST_HEADER.'"
                                    data-unid="'.$row->UNID.'" onclick="modal_about_data(this)">
                                    '.$row->POST_HEADER.'
                                </button>
                            </div>';
        }
        $next_page = $DATA_POST->currentPage()  < $DATA_POST->lastPage() ? $PAGE+1 : $PAGE;
        $previous_page = $DATA_POST->currentPage()  > 1 ? $PAGE-1 : $PAGE;

        // dd($next_page,$PAGE);
        return response()->json(['fetchpost'=>$fetchpost,'next_page'=>$next_page,'previous_page' => $previous_page]);
    }

}
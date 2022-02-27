<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

use App\Models\Settingnumber;
use App\Models\Img;
use App\Models\Dircetor;
use App\Models\AboutSchool;
use App\Models\Contract;
use App\Models\Post;
use App\Http\Controllers\CommonFuntionController;
use App\Models\Tag;
class EditController extends Controller
{
    public function home(Request $request)
    {
        $POST_MONTH = isset($request->select_month_post) ? $request->select_month_post : date('n') ;
        $POST_TYPE = isset($request->select_type_post) ? $request->select_type_post : 'DEFAULT' ;
        $FOCUS = isset($request->select_type_post) ? $request->select_type_post : '';
        $DATA_SLIDE = Settingnumber::where('TYPE_SETTING', '=', 'SLIDE')->first();
        $IMG_SLIDE = isset($DATA_SLIDE->UNID) ? Img::where('UNID_SETTING_NUMBER','=',$DATA_SLIDE->UNID )->where('STATUS','=','OPEN')->get() : false;
        $LIMIT_NUMBER = isset($DATA_SLIDE->TYPE_NUMBER) ? $DATA_SLIDE->TYPE_NUMBER : '5';

        $DATA_DIRCETOR  = Dircetor::first();
        $DIRECTOR_IMG   = isset($DATA_DIRCETOR->DIRCETOR_IMG) ? $DATA_DIRCETOR->DIRCETOR_IMG . $DATA_DIRCETOR->DIRCETOR_IMG_EXT : 'no_img.png';

        $ABOUT_SCHOOL   = AboutSchool::select('UNID','ABOUT_NAME','ABOUT_NUMBER')->orderBy('ABOUT_NUMBER')->get();
        $DATA_POST      = Post::where('POST_MONTH','=',$POST_MONTH)->where('POST_TYPE','=',$POST_TYPE)->paginate(2);
        $DATA_CONTRACT  = Contract::where('CONTRACT_STATUS','=','OPEN')->get();
        $DATA_TAG       = Tag::where('TAG_STATUS','=','OPEN')->get();
        return view('editpage.home',compact('LIMIT_NUMBER','IMG_SLIDE','DIRECTOR_IMG','DATA_DIRCETOR','ABOUT_SCHOOL'
                                            ,'DATA_POST','POST_MONTH','POST_TYPE','DATA_CONTRACT','DATA_TAG'))->with('FOCUS',$FOCUS);
    }
    public function settingpage(){
        $DATA_TAG = Tag::orderby('TAG_NAME','ASC')->paginate();
        return view('editpage.setting',compact('DATA_TAG'));
    }
    public function fetchpost(Request $request){
        $POST_MONTH = $request->select_month_post ;
        $POST_TYPE = $request->select_type_post ;
        $PAGE = $request->page;
        $DATA_POST      = Post::where('POST_MONTH','=',$POST_MONTH)->where('POST_TYPE','=',$POST_TYPE)->paginate(2);
        $fetchpost = '';
        foreach($DATA_POST->items($PAGE) as $key => $row_post){
            $img = asset('assets/image/post/logo/' . $row_post->POST_IMG_LOGO . $row_post->POST_IMG_EXT);
            $fetchpost .= '<div class="col-sm-6 col-md-4">
                                                <div class="card card-stats card-info card-round">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="icon-big text-center">
                                                                    <img src="'.$img.'"
                                                                        style="width: 100px ">
                                                                </div>
                                                            </div>
                                                            <div class="col-8 col-stats">
                                                                <div class="numbers text-center">
                                                                    <p class="card-title">
                                                                        '.$row_post->POST_HEADER.'</p>
                                                                    <p class="card-title">
                                                                        '.$row_post->POST_DAY . '/' . $row_post->POST_MONTH . '/' . $row_post->POST_YEAR.'
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row my-2">
                                                            <div class="col-md-12">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-block btn-sm text-byme">
                                                                    <i class="fas fa-edit"></i> แก้ไข
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
        }
        $next_page = $DATA_POST->currentPage()  < $DATA_POST->lastPage() ? $PAGE+1 : $PAGE;
        $previous_page = $DATA_POST->currentPage()  > 1 ? $PAGE-1 : $PAGE;

        // dd($next_page,$PAGE);
        return response()->json(['fetchpost'=>$fetchpost,'next_page'=>$next_page,'previous_page' => $previous_page]);
    }

}
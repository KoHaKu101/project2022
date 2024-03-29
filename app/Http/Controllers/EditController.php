<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

use App\Models\Settingnumber;
use App\Models\Img;
use App\Models\Dircetor;
use App\Models\AboutSchool;
use App\Models\Contract;
use App\Models\DetailId;
use App\Models\DetailSchool;
use App\Models\Post;
use App\Models\Tag;
use App\Models\EmpRank;
use App\Models\EmpSchool;
use App\Models\Register;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $DATA_TAG = Tag::orderby('TAG_NAME','ASC')->paginate(10);
        $DATA_USER = Register::orderby('USERNAME','ASC')->paginate(10);

        return view('editpage.setting',compact('DATA_TAG','DATA_USER'));
    }
    public function school(){
        $DATA_DETAIL_ID = DetailId::select('DETAIL_HEAD','UNID','DETAIL_TYPE')->paginate(20);
        $DATA_DETAIL = DetailSchool::select('UNID_REF','DETAIL_HEAD')->get();
        return view('editpage.school.school',compact('DATA_DETAIL_ID','DATA_DETAIL'));
    }
    public function emp(){
        $DATA_RANK = EmpRank::orderBy('RANK_NAME_TH','DESC')->get();
        $DATA_EMP  = EmpSchool::orderby('EMP_RANK','ASC')->orderBy('EMP_FIRST_NAME_TH','ASC')->get();
        return view('editpage.emp.emp',compact('DATA_RANK','DATA_EMP'));
    }
    public function post(Request $request){
        $DATA_POST = Post::orderBy('POST_YEAR','ASC')->orderBy('POST_MONTH','ASC')->orderBy('POST_DAY','ASC')->get();

        return view('editpage.post.post',compact('DATA_POST'));
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

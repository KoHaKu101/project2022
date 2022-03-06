<?php

namespace App\Http\Controllers;

use App\Models\AboutSchool;
use App\Models\Contract;
use App\Models\DetailId;
use App\Models\DetailSchool;
use App\Models\Dircetor;
use App\Models\EmpRank;
use App\Models\EmpSchool;
use App\Models\Img;
use App\Models\Post;
use App\Models\Settingnumber;
use App\Models\Tag;
use App\Models\PostTag;
use App\Models\PostImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function homepage()
    {

        $DATA_SLIDE = Settingnumber::where('TYPE_SETTING', '=', 'SLIDE')->get();
        $IMG_SLIDE = Img::where("IMG_TYPE", '=', 'SLIDE')->where("STATUS", '=', "OPEN")->get();
        $COUNT_SLIDE = count($DATA_SLIDE) > 0 ? count($DATA_SLIDE) : 0;
        $IMG_DIRECTOR = Img::where('IMG_TYPE', '=', 'DIRECTOR')->first();

        $DATA_DIRCETOR = Dircetor::first();
        $DIRECTOR_IMG = isset($DATA_DIRCETOR->DIRCETOR_IMG) ? $DATA_DIRCETOR->DIRCETOR_IMG . $DATA_DIRCETOR->DIRCETOR_IMG_EXT : 'no_img.png';
        $ABOUT_SCHOOL = AboutSchool::select('ABOUT_NAME', 'ABOUT_TEXT', 'ABOUT_NUMBER', 'ABOUT_IMG', 'ABOUT_IMG_EXT', 'ABOUT_IMG_POSITION')
            ->orderBy('ABOUT_NUMBER', 'ASC')->get();
        $DATA_POST = Post::where('POST_MONTH', '=', date('n'))->where('POST_YEAR', '=', date('Y'))->where('POST_STATUS', '=', 'OPEN')
            ->orderby('POST_DAY')->limit(6)->get();
        $DATA_CONTRACT = Contract::where('CONTRACT_STATUS','=', 'OPEN')->get();
        return view('showpage.homepage', compact('COUNT_SLIDE', 'IMG_SLIDE', 'DIRECTOR_IMG', 'DATA_DIRCETOR', 'ABOUT_SCHOOL', 'DATA_POST','DATA_CONTRACT'));
    }
    public function showpost(Request $request){
        $DATA_POST = Post::where('POST_MONTH', '=', $request->MONTH)->where('POST_YEAR', '=', date('Y'))->where('POST_STATUS', '=', 'OPEN')
            ->orderby('POST_DAY')->limit(6)->get();
        if ($request->MONTH == 0) {
            $DATA_POST = Post::where('POST_YEAR', '=', date('Y'))->where('POST_STATUS', '=', 'OPEN')
                ->orderby('POST_DAY')->limit(6)->get();
        }
        $months_full_th = ['1' => 'มกราคม', '2' => 'กุมภาพันธ์', '3' => 'มีนาคม', '4' => 'เมษายน', '5' => 'พฤษภาคม', '6' => 'มิถุนายน', '7' => 'กรกฎาคม', '8' => 'สิงหาคม', '9' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'];
        $show_post = '<div class="row portfolio-container " data-aos="fade-up" data-aos-delay="200">';
        foreach ($DATA_POST as $index => $row_post) {
            $img = asset('assets/image/post/logo/' . $row_post->POST_IMG_LOGO . $row_post->POST_IMG_EXT);
            $show_post .= '<div class="col-lg-4 col-md-6 portfolio-item month_'. $row_post->POST_MONTH .'">
                                <article class="card ">
                                    <div class="card-body">
                                        <div class="entry-img text-center">
                                            <img src="'. $img .'"
                                                alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <h2 class="entry-title text-center">
                                            <a href="blog-single.html" class="title-check-long"
                                                style="font-size: 25px">'. $row_post->POST_HEADER .'</a>
                                        </h2>
                                        <div class="entry-content ">
                                            <p class="text-check-long">
                                                '. $row_post->POST_BODY .'
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="entry-content ">
                                            <i class="bi bi-clock me-2"></i>
                                            '. $row_post->POST_DAY . ' ' . $months_full_th[$row_post->POST_MONTH] . ' ' . ($row_post->POST_YEAR + 543) .'
                                            <div class="read-more  my-3 text-center">
                                                <a href="blog-single.html">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>';
        }
        $show_post .= '</div>';
        return response()->json(['show_post' => $show_post]);
    }

    public function detail($DETAIL_TYPE){
        $DATA_SCHOOL = DetailId::where('DETAIL_TYPE', '=',$DETAIL_TYPE)->where('DETAIL_STATUS','=','OPEN')->first();
        $DETAIL_SCHOOL = DetailSchool::where('UNID_REF','=',$DATA_SCHOOL->UNID)->get();
        return view('showpage.detail',compact('DATA_SCHOOL','DETAIL_SCHOOL'));
    }
    public function employee(Request $request){
        $SEARCH_EMP = isset($request->SEARCH_EMP) ? trim($request->SEARCH_EMP) :'';
        $PREFIX_ARRAY = ['นาย','นาง','นางสาว'];
        if($SEARCH_EMP != '' && !in_array($SEARCH_EMP,$PREFIX_ARRAY)){
            $SEARCH_EMP = str_replace( "นาย", "", $SEARCH_EMP );
            $SEARCH_EMP = str_replace( "นาง", "", $SEARCH_EMP );
            $SEARCH_EMP = str_replace( "นางสาว", "", $SEARCH_EMP );
        }

        $RANK_NAME_ENG = isset($request->RANK_NAME_ENG) ? $request->RANK_NAME_ENG : '';
        $DATA_RANK = EmpRank::where('RANK_STATUS','=','OPEN')->orderby('RANK_NAME_TH','DESC')->get();
        $DATA_EMP = EmpSchool::orderby('EMP_RANK','DESC')->orderby('EMP_FIRST_NAME_TH','ASC')->paginate(10);
        $RANK_SELECTED = $RANK_NAME_ENG != '' ? EmpRank::select('UNID','RANK_NAME_TH')->where('RANK_NAME_ENG','=',$RANK_NAME_ENG)->first() : '';
        $RANK_NAME_TH  = $RANK_NAME_ENG != '' ? $RANK_SELECTED->RANK_NAME_TH : null;
        $DATA_EMP = EmpSchool::where(function($query) use ($RANK_NAME_ENG,$RANK_SELECTED){
            if($RANK_NAME_ENG != ''){
                $query->where('EMP_RANK_REF','=',$RANK_SELECTED->UNID);
            }
        })->where(function($query) use ($SEARCH_EMP){
            if($SEARCH_EMP != ''){
            $query->where('EMP_PREFIX','like','%'.$SEARCH_EMP.'%')
                  ->orwhere('EMP_FIRST_NAME_TH','like','%'.$SEARCH_EMP.'%')
                  ->orwhere('EMP_LAST_NAME_TH','like','%'.$SEARCH_EMP.'%')
                  ->orwhere('EMP_FIRST_NAME_EN','like','%'.$SEARCH_EMP.'%')
                  ->orwhere('EMP_LAST_NAME_EN','like','%'.$SEARCH_EMP.'%');
            }
        })->orderby('EMP_RANK','DESC')->orderby('EMP_FIRST_NAME_TH','ASC')->paginate(10);
        $SEARCH_EMP = isset($request->SEARCH_EMP) ? trim($request->SEARCH_EMP) :'';

        return view('showpage.employee',compact('DATA_EMP','DATA_RANK','RANK_NAME_ENG','RANK_SELECTED','RANK_NAME_TH','SEARCH_EMP'));
    }
    public function post_tag(Request $request){
        $TAG = $request->TAG;
        $DATA_TAG = null;
        $DATA_POST = Post::where('POST_YEAR','=',date('Y'))->paginate(9);
        if(isset($TAG)){
            $DATA_TAG = Tag::where('TAG_NAME','=',$TAG)->first();
            $DATA_POST = DB::table('POST_TAG')->where('UNID_TAG','=',$DATA_TAG->UNID)
                        ->join('POST','POST_TAG.UNID_POST','=','POST.UNID')
                        ->select('POST_HEADER','POST_IMG_LOGO','POST_IMG_EXT','POST_BODY'
                                 ,'POST_DAY','POST_MONTH','POST_YEAR','POST.UNID')->paginate(9);
        }

        return view('showpage.posttag',compact('DATA_TAG','DATA_POST'));
    }
    public function post_detail(Request $request){
        $HEADER = $request->HEADER;
        $DATA_POST = Post::where('POST_HEADER','=',$HEADER)->first();
        $POST_TAG  = DB::table('POST_TAG')->where('UNID_POST','=',$DATA_POST->UNID)
                        ->join('TAG','POST_TAG.UNID_TAG','=','TAG.UNID')->get();
        $POST_IMG  = null;
        if($DATA_POST->POST_TYPE == 'DEFAULT'){
            $POST_IMG = PostImg::where('UNID_REF','=',$DATA_POST->UNID)->get();
        }

        return view('showpage.postdetail',compact('DATA_POST','POST_IMG','POST_TAG'));

    }
    public function contract(Request $request){
        $DATA_CONTRACT = Contract::all();
        return view('showpage.contract',compact('DATA_CONTRACT'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settingnumber;
use App\Models\Img;
use App\Models\Post;
use App\Models\AboutSchool;
class HomepageController extends Controller
{
  public function homepage()
    {
        $DATA_SLIDE     = Settingnumber::where('TYPE_SETTING', '=', 'SLIDE')->get();
        $IMG_SLIDE      = Img::where("IMG_TYPE",'=','SLIDE')->where("STATUS",'=',"OPEN")->get();
        $COUNT_SLIDE    = count($DATA_SLIDE) > 0 ? count($DATA_SLIDE) : 0;
        $IMG_DIRECTOR   = Img::where('IMG_TYPE','=','DIRECTOR')->first();
        $DIRECTOR_IMG   = isset($IMG_DIRECTOR->IMG_FILE) ? $IMG_DIRECTOR->IMG_FILE . $IMG_DIRECTOR->IMG_EXT : 'no_img.png';
        $DIRECTOR_TEXT  = Post::where('POST_TYPE','=','DIRECTOR')->first();
        $ABOUT_SCHOOL   = AboutSchool::select('ABOUT_NAME','ABOUT_TEXT','ABOUT_NUMBER','ABOUT_IMG','ABOUT_IMG_EXT','ABOUT_IMG_POSITION')
                                     ->orderBy('ABOUT_NUMBER','ASC')->get();

        return view('homepage',compact('COUNT_SLIDE','IMG_SLIDE','DIRECTOR_IMG','DIRECTOR_TEXT','ABOUT_SCHOOL'));
    }
}

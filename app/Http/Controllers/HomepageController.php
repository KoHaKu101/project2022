<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settingnumber;
use App\Models\Img;
class HomepageController extends Controller
{
  public function homepage()
    {
        $DATA_SLIDE     = Settingnumber::where('TYPE_SETTING', '=', 'SLIDE')->get();
        $IMG_SLIDE      = count($DATA_SLIDE->TYPE_NUMBER) > 0 ? Img::where("IMG_TYPE",'=','SLIDE')->where("STATUS",'=',"OPEN")->get() : false;
        $IMG_DIRECTOR   = Img::where('IMG_TYPE','=','DIRECTOR')->first();
        $LIMIT_NUMBER   = count($DATA_SLIDE->TYPE_NUMBER) > 0 ? count($IMG_SLIDE) : 5;
        dd($LIMIT_NUMBER);
        return view('homepage',compact('LIMIT_NUMBER','IMG_SLIDE','IMG_DIRECTOR'));
    }}
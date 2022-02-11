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


        return view('homepage',compact('DATA_SLIDE','IMG_SLIDE','IMG_DIRECTOR'));
    }}
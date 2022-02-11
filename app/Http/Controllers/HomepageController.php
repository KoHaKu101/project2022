<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settingnumber;
use App\Models\Img;
class HomepageController extends Controller
{
  public function homepage()
    {
        $DATA_SLIDE     = Settingnumber::where('TYPE_SETTING', '=', 'SLIDE')->first();
        $IMG_SLIDE      = isset($DATA_SLIDE->TYPE_NUMBER) ? Img::where("UNID_SETTING_NUMBER",'=',$DATA_SLIDE->UNID )->where("STATUS",'=',"OPEN")->get() : false;
        $IMG_DIRECTOR   = Img::where('IMG_TYPE','=','DIRECTOR')->first();
        $LIMIT_NUMBER   = isset($DATA_SLIDE->TYPE_NUMBER) ? count($IMG_SLIDE) : 5;

        return view('homepage',compact('LIMIT_NUMBER','IMG_SLIDE','IMG_DIRECTOR'));
    }}
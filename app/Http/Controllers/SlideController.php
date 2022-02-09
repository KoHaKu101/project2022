<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settingnumber;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Image;
class SlideController extends Controller
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
    public function number(Request $request){
        if(is_numeric($request->number)){
            $DATA_SETTING = Settingnumber::where("TYPE_SETTING",'=',"SLIDE")->first();
            if(isset($DATA_SETTING->NUMBER)){
                $UNID = $DATA_SETTING->UNID;
                Settingnumber::where("UNID",'=',$UNID)->update([
                    'TYPE_NUMBER' => $request->number,
                    'MODIFY_BY' => Auth::user()->USERNAME,
                    'MODIFY_TIME' => Carbon::now(),
                ]);



            }else{
                $UNID = $this->randUNID('SETTING_NUMBER');
                  Settingnumber::insert([
                    'UNID' => $UNID,
                    'TYPE_SETTING' => "SLIDE",
                    'TYPE_NUMBER' => $request->number,
                    'STATUS' => "OPEN",
                    'CREATE_BY' => Auth::user()->USERNAME,
                    'CREATE_TIME' => Carbon::now(),

                ]);
            }

        }
        return response()->json(["message"=>'true']);
    }
    public function slide_img(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'imgFile' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);

        $image = $request->file('imgFile');
        $input['imagename'] = time().'.'.$image->extension();

        $filePath = public_path('/thumbnails');
        $img = Image::make($image->path());
        $img->resize(110, 110, function ($const) {
            $const->aspectRatio();
        })->save($filePath.'/'.$input['imagename']);

        $filePath = public_path('/images');
        $image->move($filePath, $input['imagename']);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settingnumber;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use App\Models\Img;
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
    private function table_setting($NUMBER){
            $DATA_SETTING = Settingnumber::where("TYPE_SETTING",'=',"SLIDE")->first();
            if(isset($DATA_SETTING->NUMBER)){
                $UNID = $DATA_SETTING->UNID;
                Settingnumber::where("UNID",'=',$UNID)->update([
                    'TYPE_NUMBER' => $NUMBER,
                    'MODIFY_BY' => Auth::user()->USERNAME,
                    'MODIFY_TIME' => Carbon::now(),
                ]);
            }else{
                $UNID = $this->randUNID('SETTING_NUMBER');
                  Settingnumber::insert([
                    'UNID' => $UNID,
                    'TYPE_SETTING' => "SLIDE",
                    'TYPE_NUMBER' => $NUMBER,
                    'STATUS' => "OPEN",
                    'CREATE_BY' => Auth::user()->USERNAME,
                    'CREATE_TIME' => Carbon::now(),
                ]);
            }
            return $UNID;
    }
    public function number(Request $request){
        if(is_numeric($request->NUMBER)){
            $this->table_setting($request->NUMBER);
            return response()->json(["message"=>'true']);

        }else{
            return response()->json(["message"=>'false']);
        }
    }
    public function upload(Request $request){
        $image = $request->file('FILE_IMG');
           if(!getimagesize($image)){
            alert()->error('เกิดข้อผิดพลาด','กรุณาอัพโหลดเป็นไฟล์รูปภาพเท่านั้น');
            return redirect()->back();
           }
        $IMG_NUMBER = $request->NUMBER_SLIDE;
        $DATA_SETTING = Settingnumber::where("TYPE_SETTING",'=','SLIDE')->first();
        if(!isset($DATA_SETTING->TYPE_SETTING)){
             $UNID_SETTING_NUMBER = $this->table_setting(5);
        }else{
            $UNID_SETTING_NUMBER = $DATA_SETTING->UNID;
        }
        $FILE_NAME = 'slide'.$IMG_NUMBER;
        $filePath = public_path('assets/image/slideshow');
        $fix_w = 1569;
        $fix_h = 1176;
        $type = 'SLIDE';
        $upload_img = new ImageController();
        $upload_img->img_resize($image,$filePath,$FILE_NAME,$fix_w,$fix_h,$UNID_SETTING_NUMBER,$type,$IMG_NUMBER);

        alert()->success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function remove(Request $request){
        $IMG_NUMBER = $request->IMG_NUMBER;
        $DATA_IMG = Img::where('IMG_NUMBER','=',$IMG_NUMBER)->first();
        $FILE_NAME = $DATA_IMG->IMG_FILE;
        $EXT = $DATA_IMG->IMG_EXT;
        $filePath = public_path('assets/image/slideshow/'.$FILE_NAME.$EXT);
        unlink($filePath);
        $DATA_IMG->delete();
        return response()->json(['massage'=>'true']);
    }

}

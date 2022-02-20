<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settingnumber;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Img;
use Illuminate\Support\Facades\File;
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
            $NUMBER_SETTING = $DATA_SETTING->TYPE_NUMBER;
            if(isset($NUMBER_SETTING)){
                $UNID = $DATA_SETTING->UNID;
                if($NUMBER < $NUMBER_SETTING){
                    Img::where('IMG_TYPE','=','SLIDE')->where('IMG_NUMBER','>',$NUMBER)->update([
                    'STATUS' => "OFF",
                    ]);
                }else if($NUMBER >= $NUMBER_SETTING){
                    Img::where('IMG_TYPE','=','SLIDE')->where('IMG_NUMBER','>=',$NUMBER)->update([
                    'STATUS' => "OPEN",
                    ]);
                }
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
        if(is_numeric($request->number)){
            $UNID = $this->table_setting($request->number);
            if($UNID != null){
                return response()->json(['alert'=>'success','title'=>'เพิ่มข้อมูลสำเร็จ','text'=>' ']);
            }

        }else{
            return response()->json(['alert'=>'error','title'=>'เกิดข้อผิดพลาด','text'=>'กรุณาลองใหม่หรือติดต่อผู้ดูแลระบบ']);
        }
    }
    public function upload(Request $request){
        $image = $request->file('FILE_IMG');
           if(!getimagesize($image)){
            alert()->error('เกิดข้อผิดพลาด','กรุณาอัพโหลดเป็นไฟล์รูปภาพเท่านั้น')->autoClose($milliseconds = 1000);
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

        alert()->success('บันทึกสำเร็จ')->autoClose($milliseconds = 1000);
        return redirect()->back();
    }
    public function remove(Request $request){
        $IMG_NUMBER = $request->IMG_NUMBER;
        $DATA_IMG = Img::where('IMG_TYPE','=','SLIDE')->where('IMG_NUMBER','=',$IMG_NUMBER)->first();
        $FILE_NAME = $DATA_IMG->IMG_FILE;
        $EXT = $DATA_IMG->IMG_EXT;
        $filePath = public_path('assets/image/slideshow/'.$FILE_NAME.$EXT);
        File::delete($filePath);
        $DATA_IMG->delete();
        return response()->json(['massage'=>'true']);
    }

}

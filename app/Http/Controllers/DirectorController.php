<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;
use App\Models\Settingnumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class DirectorController extends Controller
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
                $UNID = $this->randUNID('SETTING_NUMBER');
                  Settingnumber::insert([
                    'UNID' => $UNID,
                    'TYPE_SETTING' => "DIRECTOR",
                    'TYPE_NUMBER' => $NUMBER,
                    'STATUS' => "OPEN",
                    'CREATE_BY' => Auth::user()->USERNAME,
                    'CREATE_TIME' => Carbon::now(),
                    'MODIFY_BY' => Auth::user()->USERNAME,
                    'MODIFY_TIME' => Carbon::now(),
                ]);
            return $UNID;
  }
  public function upload(Request $request){
        $image = $request->file('IMG_DIRECTOR');
           if(!getimagesize($image)){
            alert()->error('เกิดข้อผิดพลาด','กรุณาอัพโหลดเป็นไฟล์รูปภาพเท่านั้น');
            return redirect()->back();
           }
        $DATA_SETTING = Settingnumber::where('TYPE_SETTING','=','DIRECTOR')->first();
        if(!isset($UNID_SETTING_NUMBER)){
            $UNID_SETTING_NUMBER = $this->table_setting(1);
        }else{
            $UNID_SETTING_NUMBER = $DATA_SETTING->UNID;
        }

        $FILE_NAME  = 'director';
        $filePath   = public_path('assets\image\people');
        $type       = 'DIRECTOR';
        $fix_w      =  243 ;
        $fix_h      =  299 ;
        $IMG_NUMBER =  1;
        $upload_img = new ImageController();
        $upload_img->img_resize($image,$filePath,$FILE_NAME,$fix_w,$fix_h,$UNID_SETTING_NUMBER,$type,$IMG_NUMBER);
         alert()->success('บันทึกสำเร็จ');
        return redirect()->back();

    }
}
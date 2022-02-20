<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;
use App\Models\Settingnumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

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
            alert()->error('เกิดข้อผิดพลาด','กรุณาอัพโหลดเป็นไฟล์รูปภาพเท่านั้น')->autoClose($milliseconds = 1000);
            return redirect()->back();
           }
        $DATA_SETTING = Settingnumber::where('TYPE_SETTING','=','DIRECTOR')->first();
        if(!isset($UNID_SETTING_NUMBER)){
            $UNID_SETTING_NUMBER = $this->table_setting(1);
        }else{
            $UNID_SETTING_NUMBER = $DATA_SETTING->UNID;
        }

        $FILE_NAME  = 'director';
        $filePath   = public_path('assets/image/people');
        $type       = 'DIRECTOR';
        $fix_w      =  243 ;
        $fix_h      =  299 ;
        $IMG_NUMBER =  1;
        $upload_img = new ImageController();
        $upload_img->img_resize($image,$filePath,$FILE_NAME,$fix_w,$fix_h,$UNID_SETTING_NUMBER,$type,$IMG_NUMBER);
         alert()->success('บันทึกสำเร็จ')->autoClose($milliseconds = 1000);
        return redirect()->back();

    }
    public function post(Request $request){
        $POST_TEXT = $request->POST_TEXT;
        $POST_NAME = $request->POST_NAME;
        $POST_SCHOOL = $request->POST_SCHOOL;
        $DATA_POST = Post::where('POST_TYPE','=','DIRECTOR')->first();
        if(isset($DATA_POST->UNID)){
            $UNID = $DATA_POST->UNID;
            Post::where('UNID','=',$UNID)->update([
                'POST_TEXT' => $POST_TEXT,
                'POST_LINK' => '',
                'POST_NAME' => $POST_NAME,
                'POST_SCHOOL' => $POST_SCHOOL,
                'POST_DAY' => date('d'),
                'POST_MONTH' => date('n'),
                'POST_YEAR' => date('Y'),
                'POST_STATUS' => 'OPEN',
                'MODIFY_BY' => Auth::user()->UNSERNAME,
                'MODIFY_TIME' => carbon::now(),
            ]);
        }else{
            $UNID = $this->randUNID('POST');
            Post::insert([
                'UNID' => $UNID,
                'POST_TYPE' => 'DIRECTOR',
                'POST_TEXT' => $POST_TEXT,
                'POST_LINK' => '',
                'POST_NAME' => $POST_NAME,
                'POST_SCHOOL' => $POST_SCHOOL,
                'POST_DAY' => date('d'),
                'POST_MONTH' => date('n'),
                'POST_YEAR' => date('Y'),
                'POST_STATUS' => 'OPEN',
                'CREATE_BY' => Auth::user()->UNSERNAME,
                'CREATE_TIME' => carbon::now(),
            ]);
        }

        alert()->success('บันทึกข้อมูลสำเร็จ')->autoClose($milliseconds = 1000);
        return redirect()->back();
    }
}

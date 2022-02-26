<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\DIRCETOR;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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
  public function upload(Request $request){
        $image = $request->file('DIRECTOR_IMG');
           if(!getimagesize($image)){
            alert()->error('เกิดข้อผิดพลาด','กรุณาอัพโหลดเป็นไฟล์รูปภาพเท่านั้น')->autoClose(1500);
            return redirect()->back()->with(['FOCUS'=> 'DIRECTOR']);
           }
        $FILE_NAME  = 'director';
        $filePath   = public_path('assets/image/people');
        if(!file_exists($filePath)){
            File::makeDirectory($filePath);
        }
        $fix_w      =  243 ;
        $fix_h      =  299 ;
        $img        = Image::make($image->path());
        $EXT        = '.'.$image->extension();
        $img->resize($fix_w, $fix_h)->save($filePath.'/'.$FILE_NAME.$EXT);
        $img->save($filePath.'/'.$FILE_NAME.$EXT);

        $DATA_POST = Dircetor::select('UNID')->first();
        if(!isset($DATA_POST->UNID)){
            Dircetor::insert([
                'UNID' => $this->randUNID('DIRCETOR'),
                'DIRCETOR_TEXT' => '',
                'DIRCETOR_TEXT_NAME' => '',
                'DIRCETOR_SCHOOL' => '',
                'STATUS' => 'OPEN',
                'DIRCETOR_IMG' => $FILE_NAME,
                'DIRCETOR_IMG_EXT' => $EXT,
                'CREATE_BY' => Auth::user()->UNSERNAME,
                'CREATE_TIME' => carbon::now(),
            ]);
        }else{
            $UNID = $DATA_POST->UNID;
            Dircetor::where('UNID','=',$UNID)->update([
                'DIRCETOR_IMG' => $FILE_NAME,
                'DIRCETOR_IMG_EXT' => $EXT,
                'MODIFY_BY' => Auth::user()->UNSERNAME,
                'MODIFY_TIME' => carbon::now(),
            ]);
        }
         alert()->success('บันทึกสำเร็จ')->autoClose(1500);
        return redirect()->back()->with(['FOCUS'=> 'DIRECTOR']);

    }
    public function post(Request $request){
        $DIRCETOR_TEXT   = $request->DIRCETOR_TEXT;
        $DIRCETOR_NAME   = $request->DIRCETOR_NAME;
        $DIRCETOR_SCHOOL = $request->DIRCETOR_SCHOOL;
        $DATA_POST = Dircetor::select('UNID')->first();
        if(!isset($DIRCETOR_TEXT) && !isset($DIRCETOR_NAME) && !isset($DIRCETOR_SCHOOL)){
            alert()->error('กรุณากรอกข้อมูลให้ครบถ้วน')->autoClose(1500);
            return redirect()->back()->with(['FOCUS'=> 'DIRECTOR']);
        }
        if(isset($DATA_POST->UNID)){
            $UNID = $DATA_POST->UNID;
            Dircetor::where('UNID','=',$UNID)->update([
                'DIRCETOR_TEXT' => $DIRCETOR_TEXT,
                'DIRCETOR_TEXT_NAME' => $DIRCETOR_NAME,
                'DIRCETOR_SCHOOL' => $DIRCETOR_SCHOOL,
                'STATUS' => 'OPEN',
                'MODIFY_BY' => Auth::user()->UNSERNAME,
                'MODIFY_TIME' => carbon::now(),
            ]);
        }else{
            $UNID = $this->randUNID('POST');
            Dircetor::insert([
                'UNID' => $UNID,
                'DIRCETOR_TEXT' => $DIRCETOR_TEXT,
                'DIRCETOR_TEXT_NAME' => $DIRCETOR_NAME,
                'DIRCETOR_SCHOOL' => $DIRCETOR_SCHOOL,
                'STATUS' => 'OPEN',

                'CREATE_BY' => Auth::user()->UNSERNAME,
                'CREATE_TIME' => carbon::now(),
            ]);
        }

        alert()->success('บันทึกข้อมูลสำเร็จ')->autoClose(1500);
        return redirect()->back()->with(['FOCUS'=> 'DIRECTOR']);
    }

}

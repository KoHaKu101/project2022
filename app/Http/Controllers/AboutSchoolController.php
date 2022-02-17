<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AboutSchool;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
class AboutSchoolController extends Controller
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

    public function insert(Request $request){
        $ABOUT_NAME = $request->ABOUT_NAME;
        $ABOUT_TEXT = $request->ABOUT_TEXT;
        if($ABOUT_NAME == null || $ABOUT_TEXT == null ){
            $text_1 = $ABOUT_NAME == null ? 'กรุณากรอกส่วนหัว' : '' ;
            $text_2 = $ABOUT_TEXT == null ? 'กรุณากรอกส่วนข้อมูล' : '' ;
            alert()->error('เกิดข้อผิดพลาด',$text_1,$text_2);
            return redirect()->back();
        }
        $DATA_ABOUT = AboutSchool::select('ABOUT_NUMBER')->get();
        $NUMBER_ABOUT = count($DATA_ABOUT)+1 ;
        $image      = $request->file('ABOUT_IMG');
        if($image != null){
        $FILE_NAME  = 'About'.$NUMBER_ABOUT;

            $this->imgupload($image,$FILE_NAME);


            $EXT        = '.'.$image->extension();
        }else{
            $FILE_NAME= '';
            $EXT = '';
        }

            AboutSchool::insert([
                'UNID' => $this->randUNID('ABOUT_SCHOOL'),
                'ABOUT_NUMBER' => $NUMBER_ABOUT,
                'ABOUT_NAME' => $request->ABOUT_NAME,
                'ABOUT_TEXT' => $request->ABOUT_TEXT,
                'ABOUT_IMG' => $FILE_NAME,
                'ABOUT_IMG_EXT' => $EXT,
                'ABOUT_IMG_POSITION' => $request->ABOUT_POSITION,
                'ABOUT_STATUS' => 'OPEN',
                'CREATE_BY' => Auth::user()->USERNAME,
                'CREATE_TIME' => Carbon::now(),
            ]);
        alert()->success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function update(Request $request){
        $UNID       = $request->ABOUT_UNID;
        $image      = $request->file('ABOUT_IMG');
        $ABOUT_NAME = $request->ABOUT_NAME;
        $ABOUT_TEXT = $request->ABOUT_TEXT;
        $ABOUT_POSITION = $request->ABOUT_POSITION;
        if(!isset($image)){
            AboutSchool::where('UNID','=',$UNID)->update([
            'UNID' => $this->randUNID('ABOUT_SCHOOL'),
                'ABOUT_NAME' => $ABOUT_NAME,
                'ABOUT_TEXT' => $ABOUT_TEXT,
                'ABOUT_IMG_POSITION' => $ABOUT_POSITION,
                'ABOUT_STATUS' => 'OPEN',
                'MODIFY_BY' => Auth::user()->USERNAME,
                'MODIFY_TIME' => Carbon::now(),
        ]);
        }else{
            $DATA_ABOUT = AboutSchool::where('UNID','=',$UNID)->first();
            $FILE_NAME = $DATA_ABOUT->ABOUT_IMG;

            $EXT        = '.'.$image->extension();
            $this->imgupload($image,$FILE_NAME);
            AboutSchool::where('UNID','=',$UNID)->update([
            'UNID' => $this->randUNID('ABOUT_SCHOOL'),
                'ABOUT_NAME' => $ABOUT_NAME,
                'ABOUT_TEXT' => $ABOUT_TEXT,
                'ABOUT_IMG_POSITION' => $ABOUT_POSITION,
                'ABOUT_IMG' => $FILE_NAME,
                'ABOUT_IMG_EXT' => $EXT,
                'ABOUT_STATUS' => 'OPEN',
                'MODIFY_BY' => Auth::user()->USERNAME,
                'MODIFY_TIME' => Carbon::now(),
            ]);
        }

        alert()->success('แก้ไขสำเร็จ');
        return redirect()->back();
    }
    public function delete(Request $request){
        $UNID = $request->UNID;
        $DATA_ABOUT = AboutSchool::where('UNID','=',$UNID)->first();
        if(!isset($DATA_ABOUT->ABOUT_IMG)){
            $FILE_NAME = $DATA_ABOUT->ABOUT_IMG;
            $EXT = $DATA_ABOUT->ABOUT_IMG_EXT;
            $filePath = public_path('assets/image/about/'.$FILE_NAME.$EXT);
            File::delete($filePath);
        }
         $DATA_ABOUT->delete();
        alert()->success('ลบสำเร็จ');
        return redirect()->back();
    }
    public function imgupload($image,$FILE_NAME){
            $w = 546;
            $h = 410;
            $filePath   = public_path('assets/image/about');
            $img        = Image::make($image->path());
            $EXT        = '.'.$image->extension();
            $width      = $img->width();
            $height     = $img->height();
            if(!file_exists($filePath)){
                File::makeDirectory($filePath);
            }
            if($width != $w || $height != $h){
                $img->resize($w, $h)->save($filePath.'/'.$FILE_NAME.$EXT);
            }
            $img->save($filePath.'/'.$FILE_NAME.$EXT);

    }
    public function show(Request $request){
        $UNID = $request->ABOUT_UNID ;
        $DATA_ABOUT = AboutSchool::where('UNID','=',$UNID)->first();
        if(!isset($DATA_ABOUT->UNID)){
         return response()->json(['status'=>'error']);
        }
        $ABOUT_NAME = $DATA_ABOUT->ABOUT_NAME ;
        $ABOUT_TEXT = $DATA_ABOUT->ABOUT_TEXT ;
        $ABOUT_IMG = isset($DATA_ABOUT->ABOUT_IMG) ? $DATA_ABOUT->ABOUT_IMG.$DATA_ABOUT->ABOUT_IMG_EXT : '' ;

        $ABOUT_POSITION = $DATA_ABOUT->ABOUT_IMG_POSITION ;
        return response()->json(['status'=>'pass','ABOUT_NAME' => $ABOUT_NAME,'ABOUT_TEXT' => $ABOUT_TEXT,'ABOUT_IMG' => $ABOUT_IMG,'ABOUT_POSITION' => $ABOUT_POSITION]);
    }
}

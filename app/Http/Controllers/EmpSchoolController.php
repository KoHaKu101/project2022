<?php

namespace App\Http\Controllers;

use App\Models\EmpRank;
use App\Models\EmpSchool;
use Illuminate\Http\Request;
use App\Http\Controllers\CommonFuntionController;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class EmpSchoolController extends Controller
{
    public function show(Request $request){
        $DATA_RANK = EmpRank::where('RANK_STATUS','=','OPEN')->get();
        return view('editpage.empshow',compact('DATA_RANK'));
    }
    public function edit($UNID){
        $DATA_RANK = EmpRank::where('RANK_STATUS','=','OPEN')->get();
        $DATA_EMP = EmpSchool::where('UNID','=',$UNID)->first();
        return view('editpage.empedit',compact('DATA_RANK','DATA_EMP'));
    }
    public function save_img($img,$file_name,$file_ext){
        $w = 1024;
        $h = 1024;
        $filePath   = public_path('assets/image/emp/');
        if(!file_exists($filePath)){
            File::makeDirectory($filePath);
        }
        if(!file_exists($filePath)){
            File::makeDirectory($filePath);
        }
        $img = Image::make($img->path());
        $img->resize($w, $h)->save($filePath.'/'.$file_name.$file_ext);
        $img->save($filePath.'/'.$file_name.$file_ext);
    }
    public function insert(Request $request){
        $FUNCTION = new CommonFuntionController();
        $UNID = $FUNCTION->randUNID('EMP_SCHOOL');
        $EMP_PREFIX = $request->EMP_PREFIX;

        $EMP_FIRST_NAME_TH  = $request->EMP_FIRST_NAME_TH;
        $EMP_LAST_NAME_TH   = $request->EMP_LAST_NAME_TH;

        $EMP_FIRST_NAME_EN  = isset($request->EMP_FIRST_NAME_EN) ? $request->EMP_FIRST_NAME_EN : '';
        $EMP_LAST_NAME_EN   = isset($request->EMP_LAST_NAME_EN) ? $request->EMP_LAST_NAME_EN : '';

        $EMP_AGE    = $request->EMP_AGE;
        $EMP_NATION = $request->EMP_NATION;
        $EMP_SEX    = $request->EMP_SEX;

        $EMP_RANK_UNID = $request->EMP_RANK_UNID;
        $FILE_IMG = $request->file('FILE_IMG');
        $DATA_RANK = EmpRank::where('UNID','=',$EMP_RANK_UNID)->first();
        $EMP_IN_DATE = $request->EMP_IN_DATE;
        $file_name = null;
        $file_ext = null;
        if(isset($FILE_IMG)){
            $img = $FILE_IMG ;
            $file_name = date('ymdhis') . uniqid() . time();
            $file_ext = '.'.$img->extension();
            $this->save_img($img,$file_name,$file_ext);
        }
        $EMP_IN_DAY = null ;
        $EMP_IN_MONTH = null ;
        $EMP_IN_YEAR = null ;
        if($EMP_IN_DATE != null){
            $EMP_IN_DAY = date('j',strtotime($EMP_IN_DATE));
            $EMP_IN_MONTH = date('n',strtotime($EMP_IN_DATE));
            $EMP_IN_YEAR =  date('Y',strtotime($EMP_IN_DATE))+543;
        }
        EmpSchool::insert([
            'UNID'=> $UNID,
            'EMP_PREFIX' => $EMP_PREFIX,
            'EMP_FIRST_NAME_TH' => $EMP_FIRST_NAME_TH,
            'EMP_MIDDLE_NAME_TH' => '',
            'EMP_LAST_NAME_TH' => $EMP_LAST_NAME_TH,
            'EMP_FIRST_NAME_EN' => $EMP_FIRST_NAME_EN,
            'EMP_MIDDLE_NAME_EN' => '',
            'EMP_LAST_NAME_EN' => $EMP_LAST_NAME_EN,
            'EMP_IMG'=> $file_name,
            'EMP_IMG_EXT'=> $file_ext,
            'EMP_AGE' => $EMP_AGE,
            'EMP_NATION' => $EMP_NATION,
            'EMP_SEX'=> $EMP_SEX,
            'EMP_RANK' => $DATA_RANK->RANK_NAME_TH,
            'EMP_RANK_REF' => $DATA_RANK->UNID,
            'EMP_STATUS' => 'OPEN',
            'EMP_IN_DAY' => $EMP_IN_DAY,
            'EMP_IN_MONTH' => $EMP_IN_MONTH,
            'EMP_IN_YEAR' => $EMP_IN_YEAR,
            'CREATE_BY' => Auth::user()->USERNAME,
            'CREATE_TIME' => Carbon::now(),

        ]);

        alert()->success('บันทึกสำเร็จ')->autoClose(1500);
        return redirect()->route('edit.emp');
    }
    public function update($UNID,Request $request){
        $EMP_PREFIX = $request->EMP_PREFIX;

        $EMP_FIRST_NAME_TH  = $request->EMP_FIRST_NAME_TH;
        $EMP_LAST_NAME_TH   = $request->EMP_LAST_NAME_TH;

        $EMP_FIRST_NAME_EN  = isset($request->EMP_FIRST_NAME_EN) ? $request->EMP_FIRST_NAME_EN : '';
        $EMP_LAST_NAME_EN   = isset($request->EMP_LAST_NAME_EN) ? $request->EMP_LAST_NAME_EN : '';

        $EMP_AGE    = $request->EMP_AGE;
        $EMP_NATION = $request->EMP_NATION;
        $EMP_SEX    = $request->EMP_SEX;

        $EMP_RANK_UNID = $request->EMP_RANK_UNID;
        $FILE_IMG = $request->file('FILE_IMG');
        $DATA_RANK = EmpRank::where('UNID','=',$EMP_RANK_UNID)->first();
        $EMP_IN_DATE = $request->EMP_IN_DATE;

        $file_name = null;
        $file_ext = null;
        $EMP_IN_DAY = null ;
        $EMP_IN_MONTH = null ;
        $EMP_IN_YEAR = null ;

        $EMP_SCHOOL = EmpSchool::where('UNID','=',$UNID)->first();
        if(isset($FILE_IMG)){
            $img = $FILE_IMG ;
            $file_name = $EMP_SCHOOL->EMP_IMG;
            $file_ext = '.'.$img->extension();
            $this->save_img($img,$file_name,$file_ext);
        }else{
            if(isset($EMP_SCHOOL->EMP_IMG)){
                $file_name = $EMP_SCHOOL->EMP_IMG;
                $file_ext = $EMP_SCHOOL->EMP_IMG_EXT;
            }
        }

        if($EMP_IN_DATE != null){
            $EMP_IN_DAY = date('j',strtotime($EMP_IN_DATE));
            $EMP_IN_MONTH = date('n',strtotime($EMP_IN_DATE));
            $EMP_IN_YEAR =  date('Y',strtotime($EMP_IN_DATE))+543;
        }
        $EMP_SCHOOL->update([
            'EMP_PREFIX' => $EMP_PREFIX,
            'EMP_FIRST_NAME_TH' => $EMP_FIRST_NAME_TH,
            'EMP_MIDDLE_NAME_TH' => '',
            'EMP_LAST_NAME_TH' => $EMP_LAST_NAME_TH,
            'EMP_FIRST_NAME_EN' => $EMP_FIRST_NAME_EN,
            'EMP_MIDDLE_NAME_EN' => '',
            'EMP_LAST_NAME_EN' => $EMP_LAST_NAME_EN,
            'EMP_IMG'=> $file_name,
            'EMP_IMG_EXT'=> $file_ext,
            'EMP_AGE' => $EMP_AGE,
            'EMP_NATION' => $EMP_NATION,
            'EMP_SEX'=> $EMP_SEX,
            'EMP_RANK' => $DATA_RANK->RANK_NAME_TH,
            'EMP_RANK_REF' => $DATA_RANK->UNID,
            'EMP_STATUS' => 'OPEN',
            'EMP_IN_DAY' => $EMP_IN_DAY,
            'EMP_IN_MONTH' => $EMP_IN_MONTH,
            'EMP_IN_YEAR' => $EMP_IN_YEAR,
            'MODIFY_BY' => Auth::user()->USERNAME,
            'MODIFY_TIME' => Carbon::now(),

        ]);

        alert()->success('อัพเดทรายการสำเร็จ')->autoClose(1500);
        return redirect()->back();
    }
    public function delete(Request $request){
        $UNID = $request->UNID;
        $EMP_SCHOOL = EmpSchool::where('UNID','=',$UNID)->first();
        if($EMP_SCHOOL->EMP_IMG != null || $EMP_SCHOOL->EMP_IMG != ''){
            $file_name = $EMP_SCHOOL->EMP_IMG ;
            $file_ext = $EMP_SCHOOL->EMP_IMG_EXT ;
        $filePath   = public_path('assets/image/emp/'.$file_name.$file_ext);
        File::delete($filePath);
        }
        $EMP_SCHOOL->delete();
        return response()->json(['status'=>'pass']);

    }
}
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
    public function edit(Request $request){
        dd($request);
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
            'EMP_IN_DAY' => date('j',strtotime($EMP_IN_DATE)),
            'EMP_IN_MONTH' => date('n',strtotime($EMP_IN_DATE)),
            'EMP_IN_YEAR' => date('Y',strtotime($EMP_IN_DATE))+543,
            'CREATE_BY' => Auth::user()->USERNAME,
            'CREATE_TIME' => Carbon::now(),

        ]);

        alert()->success('บันทึกสำเร็จ')->autoClose(1500);
        return redirect()->route('edit.emp');
    }
    public function update(Request $request){
        dd($request);
    }
    public function delete(Request $request){
        dd($request);
    }
}
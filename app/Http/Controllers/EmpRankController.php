<?php

namespace App\Http\Controllers;

use App\Models\EmpRank;
use Illuminate\Http\Request;
use App\Http\Controllers\CommonFuntionController;
use App\Models\EmpSchool;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class EmpRankController extends Controller
{

    public function insert(Request $request){
        $RANK_NAME_TH = $request->RANK_NAME_TH;
        $RANK_NAME_ENG = strtolower($request->RANK_NAME_ENG);
        $FUNCTION = new CommonFuntionController;
        $UNID = $FUNCTION->randUNID('EMP_RANK');
        EmpRank::insert([
        'UNID' => $UNID,
        'RANK_NAME_TH' => $RANK_NAME_TH,
        'RANK_NAME_ENG' => $RANK_NAME_ENG,
        'RANK_STATUS' => 'OPEN',
        'CREATE_BY' => Auth::user()->USERNAME,
        'CREATE_TIME' => Carbon::now(),
        ]);
        alert()->success('เพิ่มตำแหน่งสำเร็จ')->autoClose(1500);
        return redirect()->back();
    }
    public function update(Request $request){
        $RANK_NAME_TH = $request->RANK_NAME_TH;
        $RANK_NAME_ENG = strtolower($request->RANK_NAME_ENG);
        $UNID = $request->UNID;

        EmpRank::where('UNID','=',$UNID)->update([
            'RANK_NAME_TH' => $RANK_NAME_TH,
            'RANK_NAME_ENG' => $RANK_NAME_ENG,
            'MODIFY_BY' => Auth::user()->USERNAME,
            'MODIFY_TIME' => Carbon::now(),
        ]);
        EmpSchool::where('EMP_RANK_REF','=',$UNID)->update([
            'EMP_RANK' => $RANK_NAME_TH,
        ]);

        alert()->success('แก้ไขตำแหน่งสำเร็จ')->autoClose(1500);
        return redirect()->back();
    }
    public function delete(Request $request){
        $UNID = $request->UNID;
        EmpRank::where('UNID','=',$UNID)->delete();
        EmpSchool::where('EMP_RANK_REF','=',$UNID)->update([
            'EMP_RANK' => '',
            'EMP_RANK_REF' => '',
        ]);
        return response()->json(['status'=>'pass']);
    }
}

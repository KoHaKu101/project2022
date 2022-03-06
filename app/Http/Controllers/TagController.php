<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CommonFuntionController;
use App\Models\PostTag;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{

    public function save(Request $request){
        $commonfunction = new CommonFuntionController;
        $UNID = $commonfunction->randUNID('TAG');
        $TAG_NAME = trim($request->TAG_NAME);
        if(Tag::where('TAG_NAME','=', $TAG_NAME)->count() > 0){
             alert()->error('มีกลุ่มนี้อยู่แล้ว')->autoClose(1500);
            return redirect()->back();
        }
        Tag::insert([
            'UNID' => $UNID,
            'TAG_NAME' => $TAG_NAME,
            'TAG_STATUS' => 'OPEN',
            'CREATE_BY' => Auth::user()->USERNAME,
            'CREATE_TIME' => Carbon::now(),
        ]);
        alert()->success('เพิ่มรายการสำเร็จ')->autoClose(1500);
        return redirect()->back();
    }
    public function status(Request $request){
        $UNID = $request->UNID;

        $DATA_TAG = Tag::where('UNID','=', $UNID)->first();
        $STATUS = $DATA_TAG->TAG_STATUS == 'OPEN' ? 'OFF' : 'OPEN';
        $DATA_TAG->update([
            'TAG_STATUS' => $STATUS,
            'MODIFY_BY' => Auth::user()->USERNAME,
            'MODIFY_TIME' => Carbon::now(),
        ]);
        return response()->json(['status'=>$STATUS]);
    }
    public function show(Request $request){
        $UNID = $request->UNID;
        $DATA_TAG = Tag::where('UNID','=', $UNID)->first();
        return response()->json(['TAG_NAME'=>$DATA_TAG->TAG_NAME]);
    }
    public function edit(Request $request){
        $TAG_NAME = trim($request->TAG_NAME);
        $UNID = $request->TAG_UNID;
        if(Tag::where('TAG_NAME','=', $TAG_NAME)->count() > 0){
             alert()->error('มีชื่อกลุ่มนี้อยู่แล้ว')->autoClose(1500);
            return redirect()->back();
        }
        Tag::where('UNID','=',$UNID)->update([
            'TAG_NAME' => $TAG_NAME,
            'MODIFY_BY' => Auth::user()->USERNAME,
            'MODIFY_TIME' => Carbon::now(),
        ]);
        alert()->success('แก้ไขรายการสำเร็จ')->autoClose(1500);
        return redirect()->back();
    }
    public function remove(Request $request){
        $UNID_TAG = $request->UNID;
        Tag::where('UNID','=',$UNID_TAG)->delete();
        $DATA_POST_TAG = PostTag::where('UNID_TAG','=',$UNID_TAG)->get();
        if(count($DATA_POST_TAG) > 0){
            $DATA_POST_TAG->delete();
        }
        alert()->success('ลบรายการสำเร็จ')->autoClose(1500);
        return redirect()->back();
    }
    public function ajaxshow(){
        $data = Tag::select('UNID','TAG_NAME')->where('TAG_STATUS','=','OPEN')->get();
        $data_array = array();
        foreach($data as $index => $row){
            $data_array[$index] = ['UNID' =>"".$row->UNID."",'TAG_NAME'=>$row->TAG_NAME];
        }
        return response()->json($data_array);
    }
}

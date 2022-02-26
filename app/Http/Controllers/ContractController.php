<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
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
    public function first_data($TYPE,$VALUE){

        Contract::insert([
            'UNID' => $this->randUNID('CONTRACT'),
            'CONTRACT_TYPE' => $TYPE,
            'CONTRACT_DATA' => $VALUE,
            'CONTRACT_STATUS' => 'OPEN',
            'CREATE_BY' => Auth::user()->USERNAME,
            'CREATE_TIME' => Carbon::now(),
        ]);


    }
    public function insert_map(Request $request){
        $CONTRACT_MAP = $request->CONTRACT_MAP;
        switch ($CONTRACT_MAP){
            case $CONTRACT_MAP == null:
                alert()->error('กรุณากรอกข้อมูลให้ครบถ้วน')->autoClose(1500);
                break;
            case Contract::where('CONTRACT_TYPE','=','MAP')->count() == 0:
                $this->first_data('MAP',$CONTRACT_MAP);
                alert()->success('เพิ่มรายการสำเร็จ')->autoClose(1500);
            break;
            case Contract::where('CONTRACT_TYPE','=','MAP')->count() == 1:
                   Contract::where('CONTRACT_TYPE','=','MAP')->update([
                    'CONTRACT_DATA' => $CONTRACT_MAP ,
                    'MODIFY_BY' => Auth::user()->USERNAME,
                    'MODIFY_TIME' => Carbon::now(),
                ]);
                alert()->success('แก้ไขรายการสำเร็จ')->autoClose(1500);
            break;
            case Contract::where('CONTRACT_TYPE','=','MAP')->count() > 1:
                alert()->error('เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน','พบข้อมูลเกินกำหนด')->autoClose(1500);
            break;
            default :
                alert()->error('เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน')->autoClose(1500);
             break;

        }
        return redirect()->back()->with(['FOCUS'=>'MAP']);



    }
    public function insert_data(Request $request){
        $CONTRACT_DATA = $request->CONTRACT_DATA;
        $CONTRACT_TYPE  = $request->CONTRACT_TYPE;
        //when edit
        $UNID           = $request->CONTRACT_UNID;
        $DATA_CONTRACT = Contract::where('CONTRACT_TYPE','=',$CONTRACT_TYPE)->where('UNID','=',$UNID)->first();
        //end when edit
        switch($CONTRACT_DATA){
            case $CONTRACT_DATA == null :
                alert()->error('กรุณากรอกข้อมูลให้ครบถ้วน')->autoClose(1500);
                break;
            case Contract::where('CONTRACT_TYPE','=',$CONTRACT_TYPE)->where('CONTRACT_DATA','=',$CONTRACT_DATA)->count() > 0 :
                if($request->ajax()){
                    return response()->json(['icon' => 'error','title' => 'มีอีเมล์นี้อยู่แล้ว']);
                }else{
                    alert()->error('มีอีเมล์นี้อยู่แล้ว')->autoClose(1500);
                }
                break;
            case !isset($DATA_CONTRACT->UNID) :
                $this->first_data($CONTRACT_TYPE,$CONTRACT_DATA);
                alert()->success('เพิ่มรายการสำเร็จ')->autoClose(1500);
                break;
            case isset($DATA_CONTRACT->UNID) :
                $DATA_CONTRACT->update([
                    'CONTRACT_DATA' => $CONTRACT_DATA ,
                    'MODIFY_BY' => Auth::user()->USERNAME,
                    'MODIFY_TIME' => Carbon::now(),
                ]);
                return response()->json(['icon' => 'success','title' => 'แก้ไขสำเร็จ']);
                break;
            default :
                alert()->error('เกิดข้อผิดพลาด กรุณาลองใหม่')->autoClose(1500);
                break;
        }
         return redirect()->back()->with(['FOCUS'=>$CONTRACT_TYPE]);
    }
    public function insert_tel(Request $request){
        $CONTRACT_TEL   = $request->CONTRACT_TEL;
        $UNID           = $request->CONTRACT_UNID;
        $FOCUS          = 'TEL';
        $CHECK_CONTRACT = Contract::where('UNID','=',$UNID)->first();
        switch($CONTRACT_TEL){
            case $CONTRACT_TEL == null :
                alert()->error('กรุณากรอกข้อมูลให้ครบถ้วน')->autoClose(1500);
                break;
            case Contract::where('CONTRACT_DATA','=',$CONTRACT_TEL)->count() > 0 :
                if($request->ajax()){
                    return response()->json(['icon' => 'error','title' => 'มีอีเมล์นี้อยู่แล้ว']);
                }else{
                    alert()->error('มีอีเมล์นี้อยู่แล้ว')->autoClose(1500);
                }
                break;
            case !isset($CHECK_CONTRACT->UNID) :
                $this->first_data('TEL',$CONTRACT_TEL);
                alert()->success('เพิ่มรายการสำเร็จ')->autoClose(1500);
                break;
            case isset($CHECK_CONTRACT->UNID) :
                $CHECK_CONTRACT->update([
                    'CONTRACT_DATA' => $CONTRACT_TEL ,
                    'MODIFY_BY' => Auth::user()->USERNAME,
                    'MODIFY_TIME' => Carbon::now(),
                ]);
                return response()->json(['icon' => 'success','title' => 'แก้ไขสำเร็จ']);
                break;
            default :
                alert()->error('เกิดข้อผิดพลาด กรุณาลองใหม่')->autoClose(1500);
                break;
        }
         return redirect()->back()->with(['FOCUS'=>$FOCUS]);
    }
    public function delete_data(Request $request){
        $UNID = $request->CONTRACT_UNID;
        $CHECK_CONTRACT = Contract::where('UNID','=',$UNID)->first();
        if(!isset($CHECK_CONTRACT->UNID)){
            $icon ='error' ;
            $title = 'เกิดข้อผิดพลาดกรุณาลองใหม่';

        }else{
            $CHECK_CONTRACT->delete();
            $icon = 'success' ;
            $title = 'ลบรายการสำเร็จ';
        }
        return response()->json(['icon' => $icon,'title' => $title]);
    }
    public function delete_tel(Request $request){
        dd($request);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon;

class LoginController extends Controller
{
      public function randUNID($table){
        $number = date("ymdhis", time());
        $length=7;
        do {
        for ($i=$length; $i--; $i>0) {
            $number .= mt_rand(0,9);
        }
        }
        while ( !empty(DB::table($table)
        ->where('UNID',$number)
        ->first(['UNID'])) );
        return $number;
    }
    public function login(Request $request){
        $USERNAME = $request->USERNAME ;
        $PASSWORD = $request->PASSWORD;
        $DATA_USER = Register::where("USERNAME",'=',$USERNAME)->first();
        if($USERNAME == "" || isset($DATA_USER) == false){
            Alert::error('เข้าสู่ระบบไม่สำเร็จ', 'ไม่พบชื่อผู้ใช้');
            return redirect()->route('homepage');
        }
        dd("s");
        if(Hash::check($PASSWORD,$DATA_USER->PASSWORD)){
               Alert::error('เข้าสู่ระบบไม่สำเร็จ', 'รหัสผ่านผิดพลาด');
            }
        Alert::success('เข้าสู่ระบบสำเร็จ', 'ยินดีต้อนรับ');
        return redirect()->route('homepage');
    }
    public function register(Request $request){
        dd($request);
        $UNID = $this->randUNID('PMCS_MACHINE');
        $PASSWORD = $request->NEW_PASSWORD;
        $CONFIRM_PASSWORD = $request->CONFIRM_PASSWORD;

        if($PASSWORD != $CONFIRM_PASSWORD){
            Alert::error('เกิดข้อผิดพลาด', 'รหัสไม่ตรงกัน');
            return Redirect()->back();
        }
        $CURRENT_PASSWORD = $PASSWORD;
        Register::insert([
            'UNID' => $UNID,
            'USERNAME' => $request->NEW_USERNAME,
            'EMAIL' => $request->NEW_EMAIL,
            'PASSWORD' => $CURRENT_PASSWORD,
            'STATUS' => "OPEN",
            'ROLE' => "USER",
            'CREATE_BY' => $request->NEW_USERNAME,
            'CREATE_TIME' => Carbon::now(),
        ]);
        Alert::error('เข้าสู่ระบบไม่สำเร็จ', 'ไม่พบชื่อผู้ใช้');
        return redirect()->route('homepage');
    }
    public function homepage(){
        return view("homepage.homepage");
    }
}

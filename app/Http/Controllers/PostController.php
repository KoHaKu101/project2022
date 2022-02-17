<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
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
    public function director(Request $request){
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

        alert()->success('บันทึกข้อมูลสำเร็จ');
        return redirect()->back();
    }
}
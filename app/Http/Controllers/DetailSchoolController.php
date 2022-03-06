<?php

namespace App\Http\Controllers;

use App\Models\DetailSchool;
use Illuminate\Http\Request;
use App\Http\Controllers\CommonFuntionController;
use App\Models\DetailId;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
class DetailSchoolController extends Controller
{
    public function insert(Request $request){
        $DETAIL_TYPE = strtolower($request->DETAIL_TYPE) ;
        $DETAIL_HEAD = $request->DETAIL_HEAD;
        if(!isset($DETAIL_TYPE) || !isset($DETAIL_HEAD)){
            alert()->error('เกิดข้อผิดพลาด','กรุณากรอกข้อมูลให้ครบถ้วน')->autoClose(2000);
            return redirect()->back();
        }
        if(DetailId::where('DETAIL_TYPE','=',$DETAIL_TYPE)->count() > 0){
            alert()->error('เกิดข้อผิดพลาด','มีข้อมูลพื้นฐานชนิดนี้อยู่แล้ว')->autoClose(2000);
            return redirect()->back();
        }
        $FUNCTION = new CommonFuntionController;
        $UNID = $FUNCTION->randUNID('DETAIL_ID');
        DetailId::insert([
            'UNID' => $UNID,
            'DETAIL_TYPE' => $DETAIL_TYPE,
            'DETAIL_HEAD' => $DETAIL_HEAD,
            'CREATE_BY' => Auth::user()->USERNAME,
            'CREATE_TIME' => Carbon::now(),
        ]);
        return redirect()->route('edit.school.show',$UNID);
    }
    public function insert_detail(Request $request){
        $UNID_REF = $request->UNID_REF;
        $DETAIL_HEAD = $request->DETAIL_HEAD;
        $DETAIL_TEXT = str_replace( "_", "&nbsp;", $request->DETAIL_TEXT );
        $DETAIL_TEXT = str_replace( " ", " ", $DETAIL_TEXT );
        $DETAIL_TEXT = str_replace( "\r\n", "\n", $DETAIL_TEXT );
        $image  = $request->file('DETAIL_IMG');
        $FUNCTION    = new CommonFuntionController;
            if(isset($image)){
                $DETAIL_IMG_POSITION = $request->DETAIL_IMG_POSITION;
                $DETAIL_IMG_EXT = '.'.$image->extension();
                $DETAIL_IMG = date('ymdhis') . uniqid() . time();
                $this->save_img($image,$DETAIL_IMG,$DETAIL_IMG_EXT,$UNID_REF);
                DetailSchool::insert([
                    'UNID' => $FUNCTION->randUNID('DETAIL_SCHOOL'),
                    'UNID_REF' => $UNID_REF,
                    'DETAIL_HEAD' => $DETAIL_HEAD,
                    'DETAIL_TEXT' => $DETAIL_TEXT,
                    'DETAIL_IMG' => $DETAIL_IMG,
                    'DETAIL_IMG_EXT' => $DETAIL_IMG_EXT,
                    'DETAIL_IMG_POSITION' => $DETAIL_IMG_POSITION,
                    'DETAIL_DAY' => date('d'),
                    'DETAIL_MONTH' => date('n'),
                    'DETAIL_YEAR' => date('Y'),
                    'CREATE_BY' => Auth::user()->USERNAME,
                    'CREATE_TIME' => Carbon::now(),
                ]);
            }
            elseif(!isset($image)){
                DetailSchool::insert([
                    'UNID' => $FUNCTION->randUNID('DETAIL_SCHOOL'),
                    'UNID_REF' => $UNID_REF,
                    'DETAIL_HEAD' => $DETAIL_HEAD,
                    'DETAIL_TEXT' => $DETAIL_TEXT,
                    'DETAIL_DAY' => date('d'),
                    'DETAIL_MONTH' => date('n'),
                    'DETAIL_YEAR' => date('Y'),
                    'CREATE_BY' => Auth::user()->USERNAME,
                    'CREATE_TIME' => Carbon::now(),
                ]);
            }


        alert()->success('บันทึกสำเร็จ')->autoClose(1500);
        return redirect()->back();
    }

    public function save_img($image,$FILE_NAME,$EXT,$UNID_REF){
        $w = 1024;
        $h = 768;
        $folder_name = DetailId::where('UNID','=',$UNID_REF)->first()->DETAIL_TYPE;
        $filePath   = public_path('assets/image/school/'.$folder_name);
        if(!file_exists($filePath)){
            File::makeDirectory($filePath);
        }
        $img        = Image::make($image->path());
        if(!file_exists($filePath)){
            File::makeDirectory($filePath);
        }
        $img->resize($w, $h)->save($filePath.'/'.$FILE_NAME.$EXT);
        $img->save($filePath.'/'.$FILE_NAME.$EXT);
    }
    public function remove_img($UNID,$UNID_REF){
        $file_name = DetailSchool::where('UNID','=',$UNID)->first()->DETAIL_IMG;
        $file_ext = DetailSchool::where('UNID','=',$UNID)->first()->DETAIL_IMG_EXT;
        $folder_name = DetailId::where('UNID','=',$UNID_REF)->first()->DETAIL_TYPE;
        $filePath = public_path('assets/image/school/'.$folder_name.'/'.$file_name.$file_ext);
        if(File::delete($filePath)){
            return true;
        }else{
            return false;
        }
    }
    public function update(Request $request){
        $UNID = $request->UNID;
        $DETAIL_TYPE = $request->DETAIL_TYPE;
        $DETAIL_HEAD = $request->DETAIL_HEAD;
        $folder_name = DetailId::where('UNID','=',$UNID)->first()->DETAIL_TYPE;
        DetailId::where('UNID','=',$UNID)->update([
            'DETAIL_TYPE' => $DETAIL_TYPE,
            'DETAIL_HEAD' => $DETAIL_HEAD,
            'MODIFY_BY' => Auth::user()->USERNAME,
            'MODIFY_TIME' => Carbon::now(),
        ]);
        $filePath   = public_path('assets/image/school/'.$folder_name);
        $newfilePath = public_path('assets/image/school/'.$DETAIL_TYPE);
        rename($filePath,$newfilePath);
        alert()->success('แก้ไขรายการสำเร็จ')->autoClose(1500);
        return redirect()->back();
    }
     public function update_detail(Request $request){
        $UNID = $request->UNID;
        $DETAIL_HEAD = $request->DETAIL_HEAD;
        $DETAIL_TEXT = str_replace( "_", "&nbsp;", $request->DETAIL_TEXT );
        $DETAIL_TEXT = str_replace( " ", " ", $DETAIL_TEXT );
        $DETAIL_TEXT = str_replace( "\r\n", "\n", $DETAIL_TEXT );
        $image  = $request->file('DETAIL_IMG');
        $DATA_DETAIL = DetailSchool::where('UNID','=',$UNID)->first();
        $UNID_REF = $DATA_DETAIL->UNID_REF;
        if(isset($image)){
            $DETAIL_IMG_POSITION = $request->DETAIL_IMG_POSITION;
            $DETAIL_IMG_EXT = '.'.$image->extension();
            $DETAIL_IMG = isset($DATA_DETAIL->DETAIL_IMG) ? $DATA_DETAIL->DETAIL_IMG : date('ymdhis') . uniqid() . time();
            $this->save_img($image,$DETAIL_IMG,$DETAIL_IMG_EXT,$UNID_REF);
            $array_update = [
                'DETAIL_HEAD' => $DETAIL_HEAD,
                'DETAIL_TEXT' => $DETAIL_TEXT,
                'DETAIL_IMG' => $DETAIL_IMG,
                'DETAIL_IMG_EXT' => $DETAIL_IMG_EXT,
                'DETAIL_IMG_POSITION' => $DETAIL_IMG_POSITION,
                'DETAIL_DAY' => date('d'),
                'DETAIL_MONTH' => date('n'),
                'DETAIL_YEAR' => date('Y'),
                'MODIFY_BY' => Auth::user()->USERNAME,
                'MODIFY_TIME' => Carbon::now(),
            ];
        }else if(!isset($image)){
            $DELETE_IMG = $request->DELETE_IMG;
            if($DELETE_IMG){
                $check_remove = $this->remove_img($UNID,$UNID_REF);
                $array_update = [
                    'DETAIL_HEAD' => $DETAIL_HEAD,
                    'DETAIL_TEXT' => $DETAIL_TEXT,
                    'DETAIL_IMG' => null,
                    'DETAIL_IMG_EXT' => null,
                    'DETAIL_IMG_POSITION' => null,
                    'DETAIL_DAY' => date('d'),
                    'DETAIL_MONTH' => date('n'),
                    'DETAIL_YEAR' => date('Y'),
                    'MODIFY_BY' => Auth::user()->USERNAME,
                    'MODIFY_TIME' => Carbon::now(),
                ];
            }else{
                 $array_update = [
                    'DETAIL_HEAD' => $DETAIL_HEAD,
                    'DETAIL_TEXT' => $DETAIL_TEXT,
                    'DETAIL_DAY' => date('d'),
                    'DETAIL_MONTH' => date('n'),
                    'DETAIL_YEAR' => date('Y'),
                    'MODIFY_BY' => Auth::user()->USERNAME,
                    'MODIFY_TIME' => Carbon::now(),
                ];
            }
        }
        $DATA_DETAIL->update($array_update);
        alert()->success('แก้ไขรายการสำเร็จ')->autoClose(1500);
        return redirect()->route('edit.school.show',[$UNID=>$UNID_REF]);
    }
    public function delete(Request $request){
        $UNID = $request->UNID;
        $DETAIL_SCHOOL = DetailSchool::where('UNID_REF',$UNID)->count();
        $icon = 'success';
        $title = 'ลบรายการสำเร็จ';
        $text = '';
        if($DETAIL_SCHOOL > 0){
            $icon = 'error';
            $title = 'ไม่สามารถลบรายการนี้ได้';
            $text = 'เนื่องจากมีข้อมูลอยู่';
            return response()->json(['status'=>'nopass','icon' => $icon,'title' => $title,'text' => $text]);
        }
        $DETAIL_ID = DetailId::where('UNID','=',$UNID)->first();
        $filePath = public_path('assets/image/school/'.$DETAIL_ID->DETAIL_TYTPE);
        File::delete($filePath);
        DetailId::where('UNID','=',$UNID)->delete();
        return response()->json(['status'=>'pass','icon' => $icon,'title' => $title,'text' => $text]);
    }
    public function delete_detail(Request $request){
        $UNID = $request->UNID;
        $DETAIL_SCHOOL = DetailSchool::where('UNID','=',$UNID)->first();
        $check = $this->remove_img($UNID,$DETAIL_SCHOOL->UNID_REF);

        if($check){
            $DETAIL_SCHOOL->delete();
            $return_array = ['status'=>true,'icon'=>'success','title'=>'ลบรายการสำเร็จ'];
        }else{
            $return_array = ['status'=>false,'icon'=>'error','title'=>'เกิดข้อผิดพลาดกรุณาลองใหม่'];
        }
        return response()->json($return_array);
    }
    public function show($UNID){
        $DATA_DETAIL = DetailId::where('UNID','=',$UNID)->first();
        $DATA_DETAIL_SCHOOL = DetailSchool::where('UNID_REF','=',$UNID)->get();
        return view('editpage.school.schoolshow',compact('DATA_DETAIL','DATA_DETAIL_SCHOOL'));
    }
    public function show_edit($UNID){
        $DATA_DETAIL_SCHOOL = DetailSchool::where('UNID','=',$UNID)->first();
        $DETAIL_TYPE = DetailId::where('UNID','=',$DATA_DETAIL_SCHOOL->UNID_REF)->first()->DETAIL_TYPE;
        return view('editpage.school.schooledit',compact('DATA_DETAIL_SCHOOL','DETAIL_TYPE'));

    }
}

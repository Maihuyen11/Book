<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class LayOutController extends Controller {
    
    public function sach() {
        $data = DB::select("select * from sach order by gia_ban asc limit 0,8"); 
        return view("sach.index", compact("data")); 
    }

    public function theloai($id) {
        $data = DB::select("select * from sach where the_loai = ?", [$id]); 
        return view("sach.index", compact("data")); 
    }
public function chitiet($id) {
    $sach = DB::select("select * from sach where id = ?", [$id]);
    
    if (count($sach) > 0) {
        return view("sach.chitiet", ['sach' => $sach[0]]);
    }
    return redirect('/sach');
}
public function bookview(Request $request)
{
$the_loai = $request->input("the_loai");
$data = [];
if($the_loai!="")
$data = DB::select("select * from sach where the_loai = ?",[$the_loai]);
else
$data = DB::select("select * from sach order by gia_ban asc limit 0,10");
return view("sach.bookview", compact("data"));
}
}
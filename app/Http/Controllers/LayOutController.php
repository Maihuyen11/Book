<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TestSendEmail;
use App\Models\User; 

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
   function testemail()
{
     $user = User::find(1);
 $donHang = DB::select("select * from chi_tiet_don_hang c, sach s
 where c.sach_id = s.id
 and c.ma_don_hang = 1");
 $user->notify(new TestSendEmail($donHang));
 }


}
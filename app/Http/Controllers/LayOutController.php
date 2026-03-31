<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TestSendEmail;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class LayOutController extends Controller 
{
    public function sach() 
    {
        $data = DB::select("select * from sach order by gia_ban asc limit 0,8"); 
        return view("sach.index", compact("data")); 
    }

    public function theloai($id) 
    {
        $data = DB::select("select * from sach where the_loai = ?", [$id]); 
        return view("sach.index", compact("data")); 
    }

    public function chitiet($id) 
    {
        $sach = DB::select("select * from sach where id = ?", [$id]);
        
        if (count($sach) > 0) {
            return view("sach.chitiet", ['sach' => $sach[0]]);
        }
        return redirect('/sach');
    }

    public function cartadd(Request $request)
    {
        $request->validate([
            "id" => ["required", "numeric"],
            "num" => ["required", "numeric"]
        ]);

        $id = $request->id;
        $num = $request->num;
        $cart = [];

        if (session()->has('cart')) {
            $cart = session()->get("cart");
            if (isset($cart[$id])) {
                $cart[$id] += $num;
            } else {
                $cart[$id] = $num;
            }
        } else {
            $cart[$id] = $num;
        }

        session()->put("cart", $cart);
        return count($cart);
    }

    public function order()
    {
        $cart = [];
        $data = [];
        $quantity = [];

        if (session()->has('cart')) {
            $cart = session("cart");
            $list_book = "";
            foreach ($cart as $id => $value) {
                $quantity[$id] = $value;
                $list_book .= $id . ", ";
            }
            
            $list_book = substr($list_book, 0, strlen($list_book) - 2);
            $data = DB::table("sach")->whereRaw("id in (" . $list_book . ")")->get();
        }

        return view("sach.order", compact("data", "quantity"));
    }
  
    public function ordercreate(Request $request)
    {
        // Bước 1: Kiểm tra dữ liệu đầu vào (Của Mai Huyền)
        $request->validate([
            "hinh_thuc_thanh_toan" => ["required", "numeric"]
        ]);

        $data = [];
        $quantity = [];

        if (session()->has('cart')) {
            // Chuẩn bị dữ liệu đơn hàng (Của Mai Huyền)
            $order = [
                "ngay_dat_hang" => DB::raw("now()"),
                "tinh_trang" => 1,
                "hinh_thuc_thanh_toan" => $request->hinh_thuc_thanh_toan,
                "user_id" => Auth::user()->id
            ];

            // Thực hiện lưu vào Database (Của Mai Huyền)
            DB::transaction(function () use ($order, &$data, &$quantity) {
                $id_don_hang = DB::table("don_hang")->insertGetId($order);
                $cart = session("cart");
                $list_book = "";
                $quantity = [];
                
                foreach ($cart as $id => $value) {
                    $quantity[$id] = $value;
                    $list_book .= $id . ", ";
                }
                
                $list_book = substr($list_book, 0, strlen($list_book) - 2);
                $data = DB::table("sach")->whereRaw("id in (" . $list_book . ")")->get();
                
                foreach ($data as $row) {
                    $row->so_luong = $quantity[$row->id]; 
                }

                $detail = [];
                foreach ($data as $row) {
                    $detail[] = [
                        "ma_don_hang" => $id_don_hang,
                        "sach_id" => $row->id,
                        "so_luong" => $quantity[$row->id],
                        "don_gia" => $row->gia_ban
                    ];
                }
                
                DB::table("chi_tiet_don_hang")->insert($detail);
                
                // --- ĐÂY LÀ PHẦN TÍCH HỢP CỦA BÍCH HỢP (CÂU 6B) ---
                // 1. Lấy thông tin người dùng đang đăng nhập
                $user = Auth::user(); 
                
                // 2. Gửi email thông báo đơn hàng thành công
                $donHang = DB::select("select * from chi_tiet_don_hang c, sach s
                                       where c.sach_id = s.id
                                       and c.ma_don_hang = ?", [$id_don_hang]);
                                       
                if ($user) {
                    $user->notify(new TestSendEmail($donHang));
                }
                // ------------------------------------------------

                // Xóa giỏ hàng (Của Mai Huyền) sau khi đã lưu xong
                session()->forget('cart');
            });
        }

        // Trả về view hiển thị thông báo đặt hàng thành công
        return view("sach.order", compact('data', 'quantity'));
    }

    public function cartdelete(Request $request)
    {
        $request->validate([
            "id" => ["required", "numeric"]
        ]);

        $id = $request->id;
        $cart = [];

        if (session()->has('cart')) {
            $cart = session()->get("cart");
            unset($cart[$id]);
        }

        session()->put("cart", $cart);
        return redirect()->route('order');
    }

    public function testemail()
    {
        $user = User::find(1);
        $donHang = DB::select("select * from chi_tiet_don_hang c, sach s
                               where c.sach_id = s.id
                               and c.ma_don_hang = 1");
                               
        $user->notify(new TestSendEmail($donHang));
    }

    public function bookview(Request $request)
    {
        $the_loai = $request->input("the_loai");
        $data = [];
        
        if ($the_loai != "") {
            $data = DB::select("select * from sach where the_loai = ?", [$the_loai]);
        } else {
            $data = DB::select("select * from sach order by gia_ban asc limit 0,10");
        }
        
        return view("sach.bookview", compact("data"));
    }
}
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller {
    public function index() {
        $ds_sach = DB::table('sach')->get();
        return view('index_sach', compact('ds_sach'));
    }

    public function create() {
        return view('them_sach');
    }

    public function store(Request $request) {
        $request->validate([
            'tieu_de' => 'required','string','max:255',
            'gia_ban' => 'required','numeric',
            'tac_gia' => 'required','string','max:255',
        ]); 

        $data = [
            'tieu_de' => $request->input('tieu_de'),
            'nha_cung_cap' => $request->input('nha_cung_cap'),
            'nha_xuat_ban' => $request->input('nha_xuat_ban'),
            'tac_gia' => $request->input('tac_gia'),
            'hinh_thuc_bia' => $request->input('hinh_thuc_bia'),
            'mo_ta' => $request->input('mo_ta'),
            'gia_ban' => $request->input('gia_ban'),
            'link_anh_bia' => $request->input('link_anh_bia'),
            'the_loai' => $request->input('the_loai'),
        ]; 

        if($request->hasFile("file_anh_bia")) {
            $fileName = time() . '.' . $request->file('file_anh_bia')->extension();
            $request->file('file_anh_bia')->storeAs('public/books', $fileName);
            $data['file_anh_bia'] = $fileName;
        } 

        DB::table('sach')->insert($data);
        return redirect()->route('sach.index')->with('status', 'Đã thêm sách thành công!'); 
    }

    public function destroy($id) {
        DB::table('sach')->where('id', $id)->delete();
        return redirect()->back()->with('status', 'Đã xóa sách!');
    }

    public function edit($id) {
        $sach = DB::table('sach')->where('id', $id)->first();
        return view('sua_sach', compact('sach'));
    }

    public function update(Request $request, $id) {
    $sach_cu = DB::table('sach')->where('id', $id)->first();

    $data = [
        'tieu_de'       => $request->input('tieu_de') ?? $sach_cu->tieu_de,
        'tac_gia'       => $request->input('tac_gia') ?? $sach_cu->tac_gia,
        'nha_xuat_ban'  => $request->input('nha_xuat_ban') ?? $sach_cu->nha_xuat_ban,
        'nha_cung_cap'  => $request->input('nha_cung_cap') ?? $sach_cu->nha_cung_cap,
        'gia_ban'       => $request->input('gia_ban') ?? $sach_cu->gia_ban,
        'hinh_thuc_bia'  => $request->input('hinh_thuc_bia') ?? $sach_cu->hinh_thuc_bia,
        'file_anh_bia'  => $sach_cu->file_anh_bia, 
        'link_anh_bia'  => $sach_cu->link_anh_bia, 
    ];

   if($request->hasFile("file_anh_bia")) {
    $fileName = time() . '.' . $request->file('file_anh_bia')->extension();
    
    $request->file('file_anh_bia')->move(public_path('image'), $fileName);
    
    $data['file_anh_bia'] = $fileName;
    $data['link_anh_bia'] = null; 
}
DB::table('sach')->where('id', $id)->update($data); 
    return redirect()->route('sach.index'); 
}
}
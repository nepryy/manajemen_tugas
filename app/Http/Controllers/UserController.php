<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

use function Laravel\Prompts\password;

class UserController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Data User',
            'menuAdminUser' => 'active',
            'user' => User::orderBy('jabatan', 'asc')->get(),
        ];
        return view("admin/user/index", $data);
    }

    public function create(){
        $data = [
            'title' => 'Tambah Data User',
            'menuAdminUSer' => 'active',
        ];
        return view("admin/user/create", $data);
    }

    public function store( Request $request){
        $request->validate([
            'nama'=>'required',
            'email'=>'required|unique:users,email',
            'jabatan'=>'required',
            'password'=>'required|confirmed|min:8',
        ],[
            'nama.required'=>'Nama tidak boleh kosong',
            'email.required'=>'Email tidak boleh kosong',
            'email.unique'=>'Email tidak boleh sama',
            'jabatan.required'=>'Mohon pilih jabatan',
            'password.required'=>'password tidak boleh kosong',
            'password.confirmed'=>'Password tidak sama',
            'password.min'=>'Password minimal 8 karakter',
        ]);

        $user = new User;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->jabatan = $request->jabatan;
        $user->password = Hash::make($request->password);
        $user->is_tugas = false;
        $user->save();

        return redirect()->route('user')->with('success','Data user berhasil di tambahkan');
    }

    public function edit($id){
        $data = [
            'title' => 'Edit Data User',
            'menuAdminUSer' => 'active',
            'user' => User::findOrFail($id),
        ];
        return view("admin/user/edit", $data);
    }

    public function update( Request $request, $id){
        $request->validate([
            'nama'=>'required',
            'email'=>'required|unique:users,email,' .$id,
            'jabatan'=>'required',
            'password'=>'nullable|confirmed|min:8',
        ],[
            'nama.required'=>'Nama tidak boleh kosong',
            'email.required'=>'Email tidak boleh kosong',
            'email.unique'=>'Email tidak boleh sama',
            'jabatan.required'=>'Mohon pilih jabatan',
            'password.confirmed'=>'Password tidak sama',
            'password.min'=>'Password minimal 8 karakter',
        ]);

        $user = User::with('tugas')->findOrFail( $id );
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->jabatan = $request->jabatan;
        if($request->jabatan=='Admin'){
            $user->is_tugas = false;
            $user->tugas()->delete();
        }
        if ($request->filled('password')){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('user')->with('success','Data user berhasil di edit');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user')->with('success','Data user berhasil di hapus');
    }

    public function excel(){
        $filename = now()->format('d-m-Y_H.i.s');
        return Excel::download(new UserExport, 'DataUser'.$filename.'.xlsx');
    }

    public function pdf(){
        $filename = now()->format('d-m-Y_H.i.s');
        $data = [
            'user' => User::get(),
            'tanggal' => now()->format('d-m-Y'),
            'jam' => now()->format('H.i.s'),
        ] ;

        $pdf = Pdf::loadView('admin/user/pdf', $data);
        return $pdf->setPaper('a4', 'landscape')->stream('DataUser'.$filename.'.pdf');

    }
}

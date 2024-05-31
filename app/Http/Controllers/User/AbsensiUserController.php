<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AbsensiRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Absensi;
use App\Models\Instansi;

use Intervention\Image\Facades\Image;

class AbsensiUserController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $today = date('Y-m-d');

        $cek_absensi = Absensi::where([
            ['user_id','=', $user_id],
            ['date','=', $today]
        ])->count();

        $instansi = Instansi::first();

        return view('pages.user.absensi.index',[
            'cek_absensi' => $cek_absensi,
            'instansi' => $instansi
        ]);
    }

    public function store(AbsensiRequest $request){
        $validatedData = $request->all();

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['date'] = date("Y-m-d");
        $validatedData['entry_time'] = date("H:i:s");

        if ($request->hasFile('picture')) {
            $image = $request->file('picture');

            $compressedImage = Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 75); 

            $path = 'assets/presensi/' . uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put($path, (string) $compressedImage->encode());

            $validatedData['picture'] = $path;
        }

        Absensi::create($validatedData);

        $route = ($request->description == 'Hadir')? 'absensi.index':'absensi-izin';
        
        return redirect()
                ->route($route)
                ->with('success', 'Sukses! Absensi anda Berhasil Disimpan');
    }

    public function update(Request $request, $id){
        $model = Absensi::findOrFail($id);
        $model->out_time = $request->out_time;
        $model->save();

        return redirect()
                ->route('absensi-pulang')
                ->with('success', 'Sukses! Absensi anda Berhasil Disimpan');
    }

    public function get_back(){
        $user_id = Auth::user()->id;
        $today = date('Y-m-d');

        $cek_absensi = Absensi::where([
            ['user_id','=', $user_id],
            ['date','=', $today]
        ])->count();

        $cek_pulang = Absensi::where([
            ['user_id','=', $user_id],
            ['date','=', $today],
            ['out_time','=', NULL],
            ['description','=', 'Hadir'],
        ])->count();

        $instansi = Instansi::first();

        $item = Absensi::where([
            ['user_id','=', $user_id],
        ])->latest()->first();

        return view('pages.user.absensi.go-back',[
            'cek_absensi' => $cek_absensi,
            'cek_pulang' => $cek_pulang,
            'instansi' => $instansi,
            'item' => $item
        ]);
    }

    public function get_permission(){
        $user_id = Auth::user()->id;
        $today = date('Y-m-d');

        $cek_absensi = Absensi::where([
            ['user_id','=', $user_id],
            ['date','=', $today]
        ])->count();

        $instansi = Instansi::first();

        $item = Absensi::where('user_id', $user_id)->latest()->first();

        return view('pages.user.absensi.permission',[
            'cek_absensi' => $cek_absensi,
            'instansi' => $instansi,
            'item' => $item
        ]);
    }
}

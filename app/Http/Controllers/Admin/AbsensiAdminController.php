<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Absensi;
use App\Models\Instansi;

use Yajra\DataTables\Facades\DataTables;

class AbsensiAdminController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $today = date('Y-m-d');

            $query = Absensi::with(['user']);

            if ($request->filled('start_date') && $request->filled('end_date') && $request->filled('description')) {
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $description = $request->description;

                if ($description != 'all') {
                    $query->where('description', $description);
                }

                $query->whereBetween('date', [$start_date, $end_date])->get();
            }else{
                $query->where('date', $today);
            }
            
            $query->latest();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i></button>
                            <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                <a class="dropdown-item" href="' . route('presensi.show', $item->id) . '">Detail</a>
                                <form action="' . route('presensi.destroy', $item->id) . '" method="POST" id="deleteForm'.$item->id.'">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button class="dropdown-item btn-delete" data-form-id="deleteForm'.$item->id.'">
                                     Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('date', function ($item) {
                    return date('d-m-Y', strtotime($item->date));
                })
                ->editColumn('out_time', function ($item) {
                    return $item->out_time != NULL ? $item->out_time : '-';
                })
                ->editColumn('picture', function ($item) {
                    return $item->picture ? 
                                '<div class="d-flex align-items-center">
                                    <div class="avatar me-2"><img class="avatar-img img-fluid" src="'. Storage::url($item->picture) .'" /></div>
                                </div>' 
                            : 
                                '<div class="d-flex align-items-center">
                                    <div class="avatar me-2"><img class="avatar-img img-fluid" src="https://ui-avatars.com/api/?name='.$item->user->name.'" /></div>
                                </div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','picture'])
                ->make();
        }

        return view('pages.admin.presensi.index');
    }

    public function show($id)
    {
        $item = Absensi::with(['user'])->find($id);
        $instansi = Instansi::first();

        return view('pages.admin.presensi.show',[
            'title' => 'Detail Absensi',
            'item' => $item,
            'instansi' => $instansi,
        ]);
    }

    public function destroy($id)
    {
        $item = Absensi::findorFail($id);

        if ($item->picture != null) {
            if (Storage::disk('public')->exists($item->picture)) {
                Storage::disk('public')->delete($item->picture);
            }
        }

        $item->delete();

        return redirect()
                    ->route('presensi.index')
                    ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function reset_data(Request $request){
        $date1 = $request->date1;
        $date2 = $request->date2;
        $category = $request->category;

        if ($category == 'Foto') {
            $absensi = Absensi::whereBetween('date', [$date1, $date2])->get();
            foreach ($absensi as $key) {
                if ($key->picture != null) {
                    if (Storage::disk('public')->exists($key->picture)) {
                        Storage::disk('public')->delete($key->picture);
                    }
                }
            }
        } else {
            $absensi = Absensi::whereBetween('date', [$date1, $date2])->get();
            foreach ($absensi as $key) {
                if ($key->picture != null) {
                    if (Storage::disk('public')->exists($key->picture)) {
                        Storage::disk('public')->delete($key->picture);
                    }
                }
            }
            Absensi::whereBetween('date', [$date1, $date2])->delete();
        }

        return redirect()
                    ->route('presensi.index')
                    ->with('success', 'Sukses! 1 Data Berhasil Direset');
        
    }
}

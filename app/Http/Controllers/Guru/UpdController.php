<?php

namespace App\Http\Controllers\Guru;

use App\Models\Guru\Upd;
use App\Models\Admin\Rombel;
use Illuminate\Http\Request;
use App\Models\Admin\Jurusan;
use App\Http\Controllers\Controller;

class UpdController extends Controller
{
    public function validation(Request $request)
    {
        $validation = $request->validate([
            'siswa_id' => 'required',
            'detail_upd_id' => 'required',
            'jenis_nilai_id' => 'required',
            'nilai_upd' => 'required',
            'semester' => 'required',
            'jumlah_tidak_hadir' => 'required',
        ],
            [
                'siswa_id.required' => 'Field ini harus diisi!',
                'detail_upd_id.required' => 'Field ini harus diisi!',
                'jenis_nilai_id' => 'Field ini harus di isi',
                'nilai_upd.required' => 'Field ini harus diisi!',
            ]);
    }

    public function index()
    {
        $upd = Upd::all();
        return view('guru.upd.index', compact('upd'));
    }

    public function create()
    {
        return view('guru.upd.create');
    }

    public function store(Request $request)
    {
        $this->validation($request);
        Upd::create([
            'siswa_id' => $request->siswa_id,
            'detail_upd_id' => $request->detail_upd_id,
            'jenis_nilai_id' => $request->jenis_nilai_id,
            'nilai_upd' => $request->nilai_upd,
            'jumlah_tidak_hadir' => $request->jumlah_tidak_hadir,
            'semester' => $request->semester,
        ]);

        return redirect('upd')->with('toast_success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $upd = Upd::find($id);
        return view('guru.upd.edit', compact('upd'));
    }

    public function update(Request $request, $id)
    {
        $upd = Upd::find($id);
        $upd->update([
            'siswa_id' => $request->siswa_id,
            'detail_upd_id' => $request->detail_upd_id,
            'jenis_nilai_id' => $request->jenis_nilai_id,
            'nilai_upd' => $request->nilai_upd,
            'semester' => $request->semester,
            'jumlah_tidak_hadir' => $request->jumlah_tidak_hadir,
        ]);

        return redirect()->route('upd.index')->with('message', 'Mapel berhasil di perbarui');
    }

    public function destroy($id)
    {
        $upd = Upd::find($id);
        $upd->delete();
        return redirect('upd');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ekstrakulikuler;
use RealRashid\SweetAlert\Facades\Alert;

class EkstrakulikulerController extends Controller
{
    public function index()
    {
        $ekskuls = Ekstrakulikuler::paginate(10);
        $title = 'Ekstrakulikuler';
        return view('ekstrakulikuler.index', compact('ekskuls', 'title'));
    }
    public function create()
    {
        $title = 'Ekstrakulikuler';
        return view('ekstrakulikuler.create', compact('title'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_ekstrakulikuler' => 'required|max:38',
            'keterangan' => 'nullable|string',
        ],[
            'nama_ekstrakulikuler.required' => 'Nama ekstrakulikuler harus diisi',
            'nama_ekstrakulikuler.max' => 'Nama ekstrakulikuler maksimal 38 karakter',
            'keterangan' => 'Keterangan harus berupa text'
        ]);
        Ekstrakulikuler::create($request->all());
        Alert::success('Berhasil', 'Data berhasil ditambahkan.');
        if ($request->has('repeat')) {
            Alert::success('Berhasil', 'Data berhasil ditambahkan, silakan tambahkan data baru.');
            return back();
        }
        return redirect()->route('data-ekstrakulikuler');
    }
    public function edit($id)
    {
        $title = 'Ekstrakulikuler';
        $ekskul = Ekstrakulikuler::findOrFail($id);
        return view('ekstrakulikuler.edit', compact('ekskul','title'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
        'nama_ekstrakulikuler' => 'required|max:38',
        'keterangan' => 'nullable|string',
        ],[
            'nama_ekstrakulikuler.required' => 'Nama ekstrakulikuler harus diisi',
            'nama_ekstrakulikuler.max' => 'Nama ekstrakulikuler maksimal 38 karakter',
            'keterangan' => 'Keterangan harus berupa text'
        ]);
        $ekskul = Ekstrakulikuler::findOrFail($id);
        $ekskul->update($request->all());
        Alert::success('success', 'Data berhasil diubah.');
        return redirect()->route('data-ekstrakulikuler');
    }
    public function destroy($id)
    {
        $ekskul = Ekstrakulikuler::findOrFail($id);
        $ekskul->delete();
        Alert::success('success', 'Data berhasil dihapus.');
        return redirect()->route('data-ekstrakulikuler');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ekstrakulikuler;
use RealRashid\SweetAlert\Facades\Alert;

class EkstrakulikulerController extends Controller
{
    public function index(Request $request)
    {
        // Start building the query for 'ekstrakulikuler'
        $query = Ekstrakulikuler::whereNull('deleted_at');

        // Apply filters based on user input
        if ($request->filled('nama_ekstrakulikuler')) {
            $query->where('nama_ekstrakulikuler', 'like', '%' . $request->input('nama_ekstrakulikuler') . '%');
        }

        // Paginate the results with query strings preserved
        $ekskuls = $query->orderBy('nama_ekstrakulikuler', 'ASC')
            ->paginate(10)
            ->withQueryString();

        // Title for the page
        $title = 'Ekstrakulikuler';

        // Return the view with data and filters
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
        Alert::success('Kerja Bagus', 'Data berhasil ditambahkan.');
        
        if ($request->has('repeat')) {
            Alert::success('Kerja Bagus', 'Data berhasil ditambahkan, silakan tambahkan data baru.');
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
        $ekskul->deleted_at = now(); // Menandai sebagai terhapus
        $ekskul->save();

        Alert::success('success', 'Data berhasil dihapus.');
        return redirect()->route('data-ekstrakulikuler');
    }

}

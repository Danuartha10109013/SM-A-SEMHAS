<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengecekan;

class PengecekanController extends Controller
{
    public function index()
    {
        $pengecekan = Pengecekan::all();
        return view('Mapping-Container.content.pengecekan.index', compact('pengecekan'));
    }

    public function create()
    {
        return view('Mapping-Container.content.pengecekan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'awal_muat' => 'required|date_format:H:i',
            'awal_muat1' => 'required|date_format:H:i',
            'kota_negara' => 'required|string',
            'lantai' => 'required|string',
            'dinding' => 'required|string',
            'pengunci_kontainer' => 'required|string',
            'sapu' => 'required|string',
            'vacum' => 'required|string',
            'disemprot' => 'required|string',
            'choke' => 'required|string',
            'stopper' => 'required|string',
            'sling' => 'required|string',
            'silica_gel' => 'required|string',
            'fumigasi' => 'required|string',
            'selesai_muat' => 'required|string',
            'cuaca' => 'required|string',
            'kondisi_ban' => 'required|string',
            'kondisi_lantai' => 'required|string',
            'rantai_webbing' => 'required|string',
            'tonase' => 'required|string',
            'terpal' => 'required|string',
            'stuffing' => 'required|string',
        ]);

        Pengecekan::create($request->all());

        return redirect()->route('Mapping.admin.pengecekan.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $pengecekan = Pengecekan::findOrFail($id);
        return view('Mapping-Container.pengecekan.edit', compact('pengecekan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'awal_muat' => 'required|date_format:H:i',
            'awal_muat1' => 'required|date_format:H:i',
            'kota_negara' => 'required|string',
            'lantai' => 'required|string',
            'dinding' => 'required|string',
            'pengunci_kontainer' => 'required|string',
            'sapu' => 'required|string',
            'vacum' => 'required|string',
            'disemprot' => 'required|string',
            'choke' => 'required|string',
            'stopper' => 'required|string',
            'sling' => 'required|string',
            'silica_gel' => 'required|string',
            'fumigasi' => 'required|string',
            'selesai_muat' => 'required|string',
            'cuaca' => 'required|string',
            'kondisi_ban' => 'required|string',
            'kondisi_lantai' => 'required|string',
            'rantai_webbing' => 'required|string',
            'tonase' => 'required|string',
            'terpal' => 'required|string',
            'stuffing' => 'required|string',
        ]);

        $pengecekan = Pengecekan::findOrFail($id);
        $pengecekan->update($request->all());

        return redirect()->route('pengecekan.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengecekan = Pengecekan::findOrFail($id);
        $pengecekan->delete();

        return redirect()->route('pengecekan.index')->with('success', 'Data berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spirit;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

class SpiritController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spirits = Spirit::all(); // Mengambil semua data spirit
        return view('admin.spirits.index', compact('spirits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.spirits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Tambahkan 'unique:spirits,code'
            'code' => 'required|string|unique:spirits,code', // <-- Perubahan di sini
            'spirit' => 'required|string',
            'julukan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar_animal' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_elemen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'warna' => 'required|string',
        ]);

        $data = $request->except(['gambar_animal', 'gambar_logo', 'gambar_elemen']);

        // UPLOAD MENGGUNAKAN STORAGE FACADE KE storage/app/public/
        foreach (['gambar_animal', 'gambar_logo', 'gambar_elemen'] as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store("spirit/$field", 'public');
                $data[$field] = $path; // Simpan path relatif ke database
            }
        }

        Spirit::create($data);

        return redirect()->route('spirits.index')->with('success', 'Spirit berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Metode ini mungkin tidak Anda gunakan secara langsung untuk tampilan admin,
        // tapi ada sebagai bagian dari resource controller.
        // Anda bisa mengosongkannya atau mengimplementasikannya jika perlu.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $spirit = Spirit::findOrFail($id);
        return view('admin.spirits.edit', compact('spirit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $spirit = Spirit::findOrFail($id);

        $request->validate([
            // Tambahkan 'unique:spirits,code,' . $spirit->id
            'code' => 'required|string|unique:spirits,code,' . $spirit->id, // <-- Perubahan di sini
            'spirit' => 'required|string',
            'julukan' => 'required', // Anda set required di sini, tapi nullable di migrasi. Pastikan konsisten
            'deskripsi' => 'required', // Anda set required di sini, tapi nullable di migrasi. Pastikan konsisten
            'warna' => 'required|string',
            'gambar_animal' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_elemen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $dataToUpdate = $request->except(['gambar_animal', 'gambar_logo', 'gambar_elemen']);

        // UPLOAD MENGGUNAKAN STORAGE FACADE KE storage/app/public/
        foreach (['gambar_animal', 'gambar_logo', 'gambar_elemen'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus gambar lama jika ada dan ada di public disk
                if ($spirit->$field && Storage::disk('public')->exists($spirit->$field)) {
                    Storage::disk('public')->delete($spirit->$field);
                }
                // Simpan gambar baru
                $path = $request->file($field)->store("spirit/$field", 'public');
                $dataToUpdate[$field] = $path;
            }
        }

        $spirit->update($dataToUpdate);

        return redirect()->route('spirits.index')->with('success', 'Spirit berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $spirit = Spirit::findOrFail($id);
        
        // Hapus file gambar dari storage
        foreach (['gambar_animal', 'gambar_logo', 'gambar_elemen'] as $field) {
            if ($spirit->$field && Storage::disk('public')->exists($spirit->$field)) {
                Storage::disk('public')->delete($spirit->$field);
            }
        }

        $spirit->delete();

        return redirect()->route('spirits.index')->with('success', 'Spirit berhasil dihapus.');
    }
}
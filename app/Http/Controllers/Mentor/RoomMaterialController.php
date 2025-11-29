<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mentor\StoreMaterialRequest;
use App\Models\Room;
use App\Models\RoomMaterial;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RoomMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Tampilkan form untuk menambah materi DAN daftar materi yang sudah ada.
     */
    public function create(Room $room)
    {
        // Eagaer load materi yang sudah ada di room ini
        $room->load('materials');

        return view('mentor.material.create', compact('room'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRequest $request, Room $room)
    {
        $validated = $request->validated();

        $data = collect($validated)->except(['file_upload'])->all();

        if ($validated['type'] === 'file' && $request->hasFile('file_upload')) {
            $data['file_path'] = $request->file('file_upload')->store('materials', 'public');
        }

        $room->materials()->create($data);

        return redirect()->route('mentor.rooms.posts.create', $room)
            ->with('status', 'Materi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomMaterial $roomMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room, RoomMaterial $material)
    {
        // Ini akan mengembalikan array path seperti ['materials/file1.pdf', 'materials/file2.jpg']
        $existingFiles = Storage::disk('public')->files('materials');

        return view('mentor.material.edit', compact('room', 'material', 'existingFiles'));
    }

    /**
     * Update the specified resource in storage.
     */
    // UBAH NAMA VARIABEL DI SINI
    // public function update(StoreMaterialRequest $request, Room $room, RoomMaterial $material)
    // {
    //     $validated = $request->validated();
    //     $data = collect($validated)->except(['file_upload'])->all();

    //     if ($validated['type'] === 'file' && $request->hasFile('file_upload')) {
    //         // Hapus file lama jika ada)
    //         if ($material->file_path) {
    //             Storage::disk('public')->delete($material->file_path);
    //         }
    //         $data['file_path'] = $request->file('file_upload')->store('materials', 'public');
    //     }

    //     $material->update($data);

    //     return redirect()->route('mentor.rooms.show', $room)
    //         ->with('status', 'Materi berhasil diperbarui.');
    // }
    public function update(StoreMaterialRequest $request, Room $room, RoomMaterial $material)
    {
        // Ambil semua data yang tervalidasi
        $validated = $request->validated();

        // Ambil data dasar (title, desc)
        $dataToUpdate = [
            'title' => $validated['title'],
            'description' => $validated['description'],
        ];

        // Fungsi helper untuk menghapus file lama dengan aman
        $deleteOldFile = function () use ($material) {
            if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
                Storage::disk('public')->delete($material->file_path);
            }
        };

        // Logika bercabang berdasarkan 'type'
        switch ($validated['type']) {

            case 'file':
                $selection = $validated['file_selection'];
                $newPath = null;

                if ($selection === '_NEW_FILE_') {
                    // 1. User upload file BARU
                    if ($request->hasFile('new_file_upload')) {
                        $deleteOldFile(); // Hapus file lama
                        $newPath = $request->file('new_file_upload')->store('materials', 'public');
                    }
                } elseif ($selection === '_NULL_') {
                    // 2. User memilih 'Kosongkan'
                    $deleteOldFile(); // Hapus file lama
                    $newPath = null;
                } else {
                    // 3. User memilih file LAMA (path-nya ada di $selection)
                    // Jika file yang dipilih beda dengan file saat ini, hapus file lama
                    if ($material->file_path !== $selection) {
                        $deleteOldFile();
                    }
                    $newPath = $selection; // Gunakan path dari file yang sudah ada
                }

                $dataToUpdate['file_path'] = $newPath;
                $dataToUpdate['link_url'] = null; // Bersihkan kolom lain
                $dataToUpdate['content'] = null;  // Bersihkan kolom lain
                break;

            case 'link':
                $deleteOldFile(); // Hapus file fisik jika beralih tipe
                $dataToUpdate['file_path'] = null;
                $dataToUpdate['link_url'] = $validated['link_url'];
                $dataToUpdate['content'] = null;
                break;

            case 'text':
                $deleteOldFile(); // Hapus file fisik jika beralih tipe
                $dataToUpdate['file_path'] = null;
                $dataToUpdate['link_url'] = null;
                $dataToUpdate['content'] = $validated['content'];
                break;
        }

        // Update materi dengan data yang sudah disiapkan
        $material->update($dataToUpdate);

        return redirect()->route('mentor.rooms.show', $room)
            ->with('status', 'Materi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room, RoomMaterial $roomMaterial)
    {
        // Ensure the material belongs to the room using integer-safe comparison
        if ((int) $roomMaterial->room_id !== (int) $room->id) {
            abort(403);
        }

        if ($roomMaterial->file_path) {
            Storage::disk('public')->delete($roomMaterial->file_path);
        }

        $roomMaterial->delete();

        return redirect()->route('mentor.rooms.show', $room)
            ->with('status', 'Materi berhasil dihapus.');
    }
}

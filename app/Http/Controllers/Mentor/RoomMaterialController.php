<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mentor\StoreMaterialRequest;
use App\Models\Room;
use App\Models\RoomMaterial;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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

        // return view('mentor.material.create', compact('room'));
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

        // return redirect()->route('mentor.material.create', $room)
        //                  ->with('status', 'Materi berhasil ditambahkan.');
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
    public function edit(RoomMaterial $roomMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomMaterial $roomMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room ,RoomMaterial $roomMaterial)
    {
        if ($roomMaterial->room_id !== $room->id) {
            abort(403);
        }

        if ($roomMaterial->file_path) {
            Storage::disk('public')->delete($roomMaterial->file_path);
        }

        $roomMaterial->delete();

        // return redirect()->route('mentor.material.create', $room)
                        //  ->with('status', 'Materi berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mentor\StoreRoomRequest;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Tampilkan formulir untuk membuat Room baru.
     */
    public function create()
    {
        $roomTypes = RoomType::query()->orderBy('name')->get();

        // return view('mentor.room.create', ['roomTypes' => $roomTypes,]);
    }

    /**
     * Simpan Room baru ke database.
     */
    public function store(StoreRoomRequest $request)
    {
        $validated = $request->validated();

        $mentor = $request->user();

        $room = $mentor->roomsAsMentor()->create($validated);

        // return redirect()->route('mentor.material.create', $room)
        //     ->with('status', 'Room berhasil dibuat! Silakan tambahkan materi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        if ($room->mentor_id !== auth()->id()) {
            abort(403);
        }

        $room->load(['materials', 'posts']);

        // return view('mentor.room.show', ['room' => $room]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}

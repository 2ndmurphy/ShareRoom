<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Requests\JoinRoomRequest;

class ExploreController extends Controller
{
    /**
     * Tampilkan halaman feed.
     */
    public function index()
    {
        // Ambil semua post, urutkan dari yang terbaru
        $posts = Post::with(['user', 'room'])
            ->latest()
            ->paginate(15);

        // return view('explore.index', compact('posts'));
    }

    /**
     * Tampilkan halaman detail publik untuk satu Room.
     */
    public function show(Room $room)
    {
        // Eager load semua data yang relevan
        $room->load(['mentor.mentorProfile', 'materials', 'roomType', 'posts']);

        // Cek apakah user yang sedang login sudah bergabung
        $isMember = false;

        if (auth()->check()) {
            // Gunakan relasi N:N 'rooms()'
            $isMember = auth()->user()->rooms()->where('room_id', $room->id)->exists();
        }

        return view('room.show', [
            'room' => $room,
            'isMember' => $isMember,
        ]);
    }

    /**
     * Daftarkan user yang login sebagai member di Room.
     * Ini adalah method 'store'.
     */
    public function store(JoinRoomRequest $request, Room $room)
    {
        $user = $request->user();

        // syncWithoutDetaching() adalah cara TERBAIK:
        // - Jika user belum join, dia akan di-attach (join).
        // - Jika user SUDAH join, tidak terjadi apa-apa (tidak ada error duplikat).
        $user->rooms()->syncWithoutDetaching($room->id);

        // return redirect()->route('room.show', $room)
        //     ->with('status', 'Anda berhasil bergabung ke Room!');
    }
}

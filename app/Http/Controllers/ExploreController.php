<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Requests\JoinRoomRequest;
use App\Http\Requests\LeaveRoomRequest;

class ExploreController extends Controller
{
    /**
     * Menampilkan explore feed (postingan undangan mentor).
     */
    public function index()
    {
        // Ambil postingan terbaru
        // Load relasi 'user' (author) dan 'room' (beserta relasi 'roomType')
        $posts = Post::with(['user', 'room.roomType'])
                     ->latest()
                     ->paginate(10);

        // Ambil data untuk widget sidebar
        $roomTypes = RoomType::orderBy('name', 'asc')->get();

        return view('explore', [
            'posts' => $posts,
            'roomTypes' => $roomTypes
        ]);
    }

    /**
     * Tampilkan halaman detail publik untuk satu Room.
     */
    public function showRoom(Room $room)
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
    public function joinRoom(JoinRoomRequest $request, Room $room)
    {
        $user = $request->user();

        // syncWithoutDetaching() adalah cara TERBAIK:
        // - Jika user belum join, dia akan di-attach (join).
        // - Jika user SUDAH join, tidak terjadi apa-apa (tidak ada error duplikat).
        $user->rooms()->syncWithoutDetaching([
            $room->id => ['joined_at' => now()],
        ]);

        // Berikan respon yang eksplisit agar UX jelas untuk browser dan klien API.
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Anda berhasil bergabung ke Room!',
                'room_id' => $room->id,
            ]);
        }

        return redirect()->route('explore.room.show', $room)
            ->with('status', 'Anda berhasil bergabung ke Room!');
    }

    public function leaveRoom(LeaveRoomRequest $request, Room $room)
    {
        $user = $request->user();

        // detach() adalah kebalikan dari attach() / sync()
        $user->rooms()->detach($room->id);

        return redirect()->route('explore.room.show', $room)
            ->with('status', 'Anda telah berhasil keluar dari Room.');
    }
}

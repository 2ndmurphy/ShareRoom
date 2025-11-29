<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mentor\StorePostRequest;
use App\Models\Post;
use App\Models\Room;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Tampilkan formulir untuk menulis Post undangan baru.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Room $room)
    {
        return view('mentor.post.create', [
            'room' => $room,
        ]);
    }

    /**
     * Simpan Post baru ke database.
     */
    public function store(StorePostRequest $request, Room $room)
    {
        $validated = $request->validated();

        $room->posts()->create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('mentor.rooms.show', $room)
            ->with('status', 'Post undangan berhasil dipublikasikan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) 
    {

    }

    public function edit(Room $room,Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        return view('mentor.post.edit', [
            'post' => $post,
            'room' => $room,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Room $room, Post $post)
    {
        if ($post->room_id !== $room->id) {
            abort(403);
        }

        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validated();

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('mentor.rooms.show', $room)
            ->with('status', 'Post undangan berhasil diperbarui!');
    }

    /**
     * Hapus (Soft Delete) post undangan dari room.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Room $room, Post $post)
    {
        if ($post->room_id !== $room->id) {
            abort(403);
        }
    
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }
        
        $post->delete();

        return redirect()->route('mentor.rooms.show', $room)
            ->with('status', 'Post undangan berhasil dihapus!');
    }
}

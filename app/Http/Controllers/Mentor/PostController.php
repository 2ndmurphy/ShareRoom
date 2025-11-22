<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mentor\StorePostRequest;
use App\Models\Room;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
        // return view('mentor.post.create', [
        //     'room' => $room,
        // ]);
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

        // return redirect()->route('mentor.room.show', $room)
            // ->with('status', 'Post undangan berhasil dipublikasikan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mentor\MentorProfileRequest;
use App\Models\MentorProfile;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class MentorProfileController extends Controller
{
    /**
     * Show the form for editing mentor profile.
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        $profile = $user->mentorProfile()->firstOrCreate([
            'user_id' => $user->id,
        ]);

        $profile->load('skills');

        // Ambil semua skills untuk <select>
        $allSkills = Skill::query()->orderBy('name')->get();

        // return view('mentor.profile.edit', [
        //     'profile' => $profile,
        //     'allSkills' => $allSkills,
        // ]);
        return view('mentor.profile.edit', compact('profile', 'allSkills'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param MentorProfile $mentorProfile
     * @return RedirectResponse
     */
    public function update(MentorProfileRequest $request)
    {
        // Ambil hanya data yang sudah lolos validasi
        $validated = $request->validated();

        $user = $request->user();

        // ambil atau buat profile
        $profile = $user->mentorProfile()->firstOrCreate([
            'user_id' => $user->id,
        ]);

        DB::transaction(function () use ($profile, $validated) {

            // Update profile hanya dengan data tervalidasi 'skills'
            $profile->update(collect($validated)->except(['skills', 'new_skills'])->all());

            $skillIds = $validated['skills'] ?? [];

            // Handle new_skills
            if (!empty($validated['new_skills'])) {
                $newSkillIds = collect($validated['new_skills'])->map(function ($name) {
                    $name = trim(Str::lower($name));
                    return Skill::firstOrCreate(['name' => $name])->id;
                })->toArray();

                $skillIds = array_merge($skillIds, $newSkillIds);
            }

            $skillIds = array_values(array_unique($skillIds));

            // Sync mentor skills
            $profile->skills()->sync($skillIds);
        });

        return redirect()->route('mentor.profile.edit', auth()->user())->with('status', 'Profil berhasil diperbarui!');
    }
}

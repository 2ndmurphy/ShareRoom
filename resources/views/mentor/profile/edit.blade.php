<!-- INI HALAMAN UNTUK MENGEDIT PROFILE (MENTOR) -->
@extends('layouts.mentor')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Profil Mentor</h1>

    <form action="{{ route('mentor.profile.update', auth()->user()) }}" method="POST"
        class="bg-white p-6 md:p-8 rounded-lg shadow-md max-w-2xl">
        @csrf
        @method('PUT')

        @include('partials._form-errors')

        <div class="mb-4">
            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio Singkat</label>
            <textarea id="bio" name="bio" rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Ceritakan sedikit tentang diri Anda...">{{ old('bio', $profile->bio) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Pengalaman</label>
            <input type="text" id="experience" name="experience"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                value="{{ old('experience', $profile->experience) }}" placeholder="Contoh: 5 tahun sebagai Web Developer">
        </div>

        <div class="mb-6">
            <label for="skills" class="block text-sm font-medium text-gray-700 mb-1">Keahlian (Pilih maksimal 5)</label>
            @php
                // Ambil ID skill yang sudah dimiliki mentor
                $mySkillIds = $profile->skills->pluck('id')->toArray();
            @endphp
            <select name="skills[]" id="skills" multiple
                class="w-full h-40 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($allSkills as $skill)
                    <option value="{{ $skill->id }}" {{ in_array($skill->id, old('skills', $mySkillIds)) ? 'selected' : '' }}>
                        {{ $skill->name }}
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">Tahan Ctrl (atau Cmd di Mac) untuk memilih lebih dari satu.</p>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                Update Profil
            </button>
        </div>
    </form>
@endsection
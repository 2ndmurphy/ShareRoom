@extends('layouts.mentor')

@section('content')
  <div class="max-w-4xl mx-auto">
    {{-- HEADER PAGE --}}
    <div class="mb-6">
      <div class="flex items-center justify-between gap-4">
        <div>
          <h1 class="text-4xl font-bold text-white md:text-4xl">
            Edit Materi
          </h1>
          <p class="mt-1.5 text-xl text-teal-50">
            Perbarui detail materi untuk
            <span class="font-semibold">{{ $room->title }}</span>.  
            Sesuaikan judul, deskripsi, dan file agar peserta mudah mengikuti pembelajaran.
          </p>
        </div>
      </div>
    </div>

    <form
      action="{{ route('mentor.rooms.materials.update', [$room, $material]) }}"
      method="POST"
      enctype="multipart/form-data"
      x-data="{ type: '{{ old('type', $material->type) }}' }"
      class="rounded-3xl border border-gray-100 bg-white/90 p-6 shadow-lg backdrop-blur-sm md:p-8"
    >
      @csrf
      @method('PUT')

      @include('partials._form-errors')

      {{-- JUDUL MATERI --}}
      <div class="mb-5">
        <label for="title" class="mb-1.5 block text-sm font-semibold text-gray-800">
          Judul Materi
        </label>
        <input
          id="title"
          name="title"
          type="text"
          value="{{ old('title', $material->title) }}"
          class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm shadow-sm
                 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-teal-400"
        >
      </div>

      {{-- DESKRIPSI SINGKAT --}}
      <div class="mb-5">
        <label for="description" class="mb-1.5 block text-sm font-semibold text-gray-800">
          Deskripsi Singkat
        </label>
        <textarea
          id="description"
          name="description"
          rows="3"
          class="w-full resize-none rounded-2xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm shadow-sm
                 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-teal-400"
        >{{ old('description', $material->description) }}</textarea>
      </div>

      {{-- TIPE MATERI --}}
      <div class="mb-5">
        <label for="type" class="mb-1.5 block text-sm font-semibold text-gray-800">
          Tipe Materi
        </label>
        <select
          id="type"
          name="type"
          x-model="type"
          class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm shadow-sm
                 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-teal-400"
        >
          <option value="file">File (PDF, Doc, dll)</option>
          <option value="link">Link (URL)</option>
          <option value="text">Teks (Artikel)</option>
        </select>
      </div>

      {{-- WARNING: DON'T DELETE THIS! --}}
      {{-- <div x-show="type === 'file'" class="mb-4 p-4 bg-gray-50 rounded-md border">
              <label for="file_path" class="block text-sm font-medium text-gray-700 mb-1">Upload File Baru (Opsional)</label>
              <input type="file" id="file_path" name="file_path" 
                     class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
              <p class="text-xs text-gray-500 mt-2">
                  File saat ini: <span class="font-medium">{{ $material->file_path ?? 'Tidak ada' }}</span>
              </p>
              <p class="text-xs text-gray-500 mt-1">Kosongkan jika Anda tidak ingin mengganti file.</p>
          </div> --}}

      {{-- Basic Dropzone  --}}
      {{-- <div @click="newFile = null; $refs.fileInput.value = null;" class="mb-4 rounded-md border bg-gray-50 p-4"
        x-data="{
            isDragging: false,
            newFile: null,
            selectedExisting: '{{ old('existing_file_path', $material->file_path) }}'
        }" x-show="type === 'file'">
        <label class="mb-2 block text-sm font-medium text-gray-700">Upload File Baru (Opsional)</label>

        <input
          @change="
               newFile = $event.target.files[0]; 
               selectedExisting = ''; // Hapus pilihan file lama
             "
          class="hidden" id="file_path" name="new_file_upload" type="file" x-ref="fileInput">

        <div :class="{ 'border-indigo-500 bg-indigo-50': isDragging, 'border-gray-300 hover:border-gray-400': !isDragging }"
          @click.stop="$refs.fileInput.click()" @dragleave.prevent="isDragging = false"
          @dragover.prevent="isDragging = true"
          @drop.prevent="
               isDragging = false;
               newFile = $event.dataTransfer.files[0];
               selectedExisting = ''; // Hapus pilihan file lama
               $refs.fileInput.files = $event.dataTransfer.files; // Sinkronkan file ke input
           "
          class="flex w-full cursor-pointer flex-col items-center justify-center rounded-md border-2 border-dashed p-6 transition-colors">
          <template x-if="newFile">
            <div class="text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke-width="2" stroke="currentColor"
                viewBox="0 0 24 24">
                <path
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                  stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <p class="font-medium text-indigo-600" x-text="newFile.name"></p>
              <p class="text-xs text-gray-500">
                (<span x-text="(newFile.size / 1024 / 1024).toFixed(2)"></span> MB)
              </p>
              <button @click.stop="newFile = null; $refs.fileInput.value = null;"
                class="mt-1 text-xs text-red-500 hover:underline" type="button">
                Batal
              </button>
            </div>
          </template>

          <template x-if="!newFile">
            <div class="text-center">
              <svg aria-hidden="true" class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                viewBox="0 0 48 48">
                <path
                  d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
              </svg>
              <p class="mt-1 text-sm text-gray-600">
                <span class="font-medium text-indigo-600">Klik untuk upload</span> atau drag and drop
              </p>
              <p class="text-xs text-gray-500">PDF, DOCX, PNG, JPG, dll.</p>
            </div>
          </template>
        </div>

        <div class="mt-6">
          <label class="mb-2 block text-sm font-medium text-gray-700">
            Atau Pilih File yang Sudah Ada
          </label>

          <div class="max-h-60 space-y-2 overflow-y-auto rounded-md border border-gray-200 bg-white p-2">
            @if (empty($existingFiles))
              <p class="p-2 text-sm text-gray-500">Belum ada file yang di-upload ke storage.</p>
            @else
              @foreach ($existingFiles as $file)
                <label :class="{ 'bg-indigo-50 border border-indigo-200': selectedExisting === '{{ $file }}' }"
                  @click.stop="newFile = null; $refs.fileInput.value = null;"
                  class="flex cursor-pointer items-center rounded-md p-3 transition-colors hover:bg-gray-100">
                  <input class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500" name="existing_file_path"
                    type="radio" value="{{ $file }}" x-model="selectedExisting">

                  <span class="ml-3 text-sm font-medium text-gray-700">{{ basename($file) }}</span>
                </label>
              @endforeach
            @endif

            <label :class="{ 'bg-red-50 border border-red-200': selectedExisting === '' }"
              @click.stop="newFile = null; $refs.fileInput.value = null;"
              class="flex cursor-pointer items-center rounded-md p-3 text-red-600 transition-colors hover:bg-gray-100">
              <input class="h-4 w-4 border-gray-300 text-red-600 focus:ring-red-500" name="existing_file_path"
                type="radio" value="" x-model="selectedExisting">
              <span class="ml-3 text-sm font-medium">Kosongkan (Hapus File)</span>
            </label>
          </div>
        </div>
      </div> --}}

      {{-- Advance Dropzone (Kali) --}}
      {{-- <div catch(e) class="mb-4" clearFileInput() this.$refs.fileInput.value=null; this.previewName = '';
        this.previewType = 'none'; try x-data="{
            isDragging: false,
            newFile: null,
        
            // Inisialisasi 'selectedExisting' dengan file saat ini (dari $material)
            selectedExisting: '{{ old('existing_file_path', $material->file_path) }}',
        
            // State untuk preview
            previewName: '',
            previewType: 'none', // 'none', 'new', 'existing'
        
            initPreview() {
                // Fungsi ini dijalankan saat komponen diinisialisasi
                if (this.selectedExisting) {
                    // Ambil nama file dari path lengkap
                    this.previewName = this.selectedExisting.split('/').pop();
                    this.previewType = 'existing';
                }
            },
        
            handleNewFile(file) {
                if (!file) return;
                this.newFile = file;
                this.selectedExisting = ''; // Hapus pilihan file lama
                this.previewName = file.name;
                this.previewType = 'new';
            },
        
            selectExisting(path, name) {
                this.newFile = null;
                this.clearFileInput();
                this.selectedExisting = path;
                this.previewName = name;
                this.previewType = 'existing';
            },
        
            clearSelection() {
                this.newFile = null;
                this.clearFileInput();
                this.selectedExisting = ''; // Ini akan memilih radio "Kosongkan" x-init="initPreview()" x-show="type === 'file'" {
        { {} } } }" },>
        <input @change="handleNewFile($event.target.files[0])" class="hidden" id="file_path" name="new_file_upload"
          type="file" x-ref="fileInput">

        <div :class="{ 'border-indigo-500 bg-indigo-50': isDragging, 'border-gray-300': !isDragging }"
          @dragleave.prevent="isDragging = false" @dragover.prevent="isDragging = true"
          @drop.prevent="
               isDragging = false;
               handleNewFile($event.dataTransfer.files[0]);
               $refs.fileInput.files = $event.dataTransfer.files;
           "
          class="w-full rounded-lg border-2 border-dashed">
          <div :class="{ 'bg-gray-50': previewType !== 'none' }" @click="$refs.fileInput.click()"
            class="relative flex cursor-pointer flex-col items-center justify-center p-6 text-center transition-colors hover:bg-gray-50">
            <template x-if="previewType === 'none'">
              <div class="text-center">
                <svg aria-hidden="true" class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                  viewBox="0 0 48 48">
                  <path
                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                </svg>
                <p class="mt-1 text-sm text-gray-600">
                  <span class="font-medium text-indigo-600">Upload file baru</span> atau drag and drop
                </p>
                <p class="text-xs text-gray-500">Atau pilih dari daftar di bawah</p>
              </div>
            </template>

            <template x-if="previewType !== 'none'">
              <div class="relative">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke-width="2" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="font-medium text-gray-700" x-text="previewName"></p>
                <span class="rounded-full bg-indigo-500 px-2 py-0.5 text-xs font-medium text-white"
                  x-show="previewType === 'new'">BARU</span>
                <span class="rounded-full bg-gray-500 px-2 py-0.5 text-xs font-medium text-white"
                  x-show="previewType === 'existing'">LAMA</span>

                <button @click.stop="clearSelection()"
                  class="absolute -right-3 -top-3 rounded-full bg-red-500 p-1 text-white shadow-md hover:bg-red-600"
                  type="button">
                  <svg class="h-4 w-4" fill="none" stroke-width="3" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
              </div>
            </template>
          </div>

          <hr class="border-t border-gray-200">

          <div class="max-h-60 space-y-1 overflow-y-auto bg-white p-2">
            <h4 class="px-2 py-1 text-sm font-medium text-gray-500">Pilih File yang Sudah Ada:</h4>

            @if (empty($existingFiles))
              <p class="p-2 text-sm text-gray-500">Belum ada file di storage.</p>
            @else
              @foreach ($existingFiles as $file)
                @php
                  $fileName = basename($file);
                @endphp
                <label :class="{ 'bg-indigo-50 border border-indigo-200': selectedExisting === '{{ $file }}' }"
                  @click.stop="selectExisting('{{ $file }}', '{{ $fileName }}')"
                  class="flex cursor-pointer items-center rounded-md p-3 transition-colors hover:bg-gray-100">
                  <input class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500" name="existing_file_path"
                    type="radio" value="{{ $file }}" x-model="selectedExisting">

                  <span class="ml-3 text-sm font-medium text-gray-700">{{ $fileName }}</span>
                </label>
              @endforeach
            @endif

            <label :class="{ 'bg-red-50 border border-red-200': selectedExisting === '' }"
              @click.stop="selectExisting('', 'Kosongkan')"
              class="flex cursor-pointer items-center rounded-md p-3 text-red-600 transition-colors hover:bg-gray-100">
              <input class="h-4 w-4 border-gray-300 text-red-600 focus:ring-red-500" name="existing_file_path"
                type="radio" value="" x-model="selectedExisting">
              <span class="ml-3 text-sm font-medium">Kosongkan (Hapus File)</span>
            </label>
          </div>
        </div>
      </div> --}}

      <div class="mb-5"
        x-data="{
          /* - '_NULL_': Pilihan 'Kosongkan'.
            - '_NEW_FILE_': Pilihan file yang baru di-upload.
            - 'path/to/file.pdf': Pilihan file yang sudah ada.
          */
          selection: '{{ old('file_selection', $material->file_path ?? '_NULL_') }}',
  
          newFile: null, // Menyimpan File object
          newFilePreviewURL: null, // Menyimpan URL preview untuk gambar
          isDragging: false,
  
          handleNewFile(file) {
              if (!file) return;
              this.newFile = file;
              this.selection = '_NEW_FILE_'; // Langsung pilih file baru
  
              // Buat preview jika itu gambar
              if (file.type.startsWith('image/')) {
                  let reader = new FileReader();
                  reader.onload = (e) => { this.newFilePreviewURL = e.target.result; };
                  reader.readAsDataURL(file);
              } else {
                  this.newFilePreviewURL = null; // Reset jika bukan gambar
              }
          },
  
          clearNewFile() {
              this.newFile = null;
              this.newFilePreviewURL = null;
              this.$refs.fileInput.value = null; // Hapus file dari input
  
              // Kembalikan pilihan ke file asli (sebelum ada file baru)
              this.selection = '{{ $material->file_path ?? '_NULL_' }}';
          }
      }"
        x-show="type === 'file'">
        <input
          id="file_path"
          name="new_file_upload"
          type="file"
          class="hidden"
          x-ref="fileInput"
          @change="handleNewFile($event.target.files[0])"
        >

        <div
          class="w-full rounded-2xl border-2 border-dashed p-4"
          :class="{ 'border-indigo-500 bg-indigo-50': isDragging, 'border-gray-300': !isDragging }"
          @dragover.prevent="isDragging = true"
          @dragleave.prevent="isDragging = false"
          @drop.prevent="
               isDragging = false;
               handleNewFile($event.dataTransfer.files[0]);
               $refs.fileInput.files = $event.dataTransfer.files; // Sinkronkan ke input
           "
        >
          <div
            class="cursor-pointer rounded-xl p-4 text-center text-sm text-gray-600 hover:bg-gray-50"
            @click="$refs.fileInput.click()"
          >
            Seret file ke sini, atau
            <span class="font-medium text-indigo-600 hover:underline">cari di komputer Anda</span>.
          </div>

          <hr class="my-3 border-t border-gray-200">

          <div class="space-y-2">
            {{-- Preview file baru --}}
            <template x-if="newFile">
              <label
                class="flex w-full cursor-pointer items-center rounded-xl border-2 border-indigo-500 bg-indigo-50 p-3 shadow-sm"
              >
                <input
                  type="radio"
                  name="file_selection"
                  value="_NEW_FILE_"
                  class="hidden"
                  x-model="selection"
                >

                <template x-if="newFilePreviewURL">
                  <img :src="newFilePreviewURL" class="mr-3 h-10 w-10 flex-shrink-0 rounded object-cover">
                </template>
                <template x-if="!newFilePreviewURL">
                  <div
                    class="mr-3 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded bg-indigo-100"
                  >
                    <svg class="h-6 w-6 text-indigo-500" fill="none" stroke-width="1.5" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                        stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </div>
                </template>

                <div class="min-w-0 flex-grow">
                  <p class="truncate text-sm font-medium text-gray-900" x-text="newFile.name"></p>
                  <p class="text-xs text-gray-500">
                    <span x-text="(newFile.size / 1024 / 1024).toFixed(2)"></span> MB ·
                    <span class="font-medium text-indigo-600">File Baru</span>
                  </p>
                </div>

                <button
                  type="button"
                  class="ml-3 flex-shrink-0 text-gray-400 hover:text-red-500"
                  @click.prevent.stop="clearNewFile()"
                >
                  <svg class="h-5 w-5" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
              </label>
            </template>

            {{-- Daftar file yang sudah ada --}}
            @if (empty($existingFiles))
              <p class="p-2 text-center text-sm text-gray-500" x-show="!newFile">
                Belum ada file di storage.
              </p>
            @else
              @foreach ($existingFiles as $file)
                @php $fileName = basename($file); @endphp
                <label
                  class="flex w-full cursor-pointer items-center rounded-xl border p-3 hover:bg-gray-50"
                  :class="{
                      'border-2 border-indigo-500 bg-indigo-50 shadow-sm': selection === '{{ $file }}',
                      'border-gray-200': selection !== '{{ $file }}'
                  }"
                >
                  <input
                    type="radio"
                    name="file_selection"
                    value="{{ $file }}"
                    class="hidden"
                    x-model="selection"
                  >

                  <div
                    class="mr-3 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded bg-gray-100"
                  >
                    <svg class="h-6 w-6 text-gray-500" fill="none" stroke-width="1.5" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                        stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </div>

                  <div class="min-w-0 flex-grow">
                    <p class="truncate text-sm font-medium text-gray-900">{{ $fileName }}</p>
                    <p class="text-xs text-gray-500">File sudah ada</p>
                  </div>

                  <template x-if="selection === '{{ $file }}'">
                    <svg class="ml-3 h-5 w-5 flex-shrink-0 text-green-500" fill="none" stroke-width="2"
                      stroke="currentColor" viewBox="0 0 24 24">
                      <path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round"
                        stroke-linejoin="round" />
                    </svg>
                  </template>
                </label>
              @endforeach
            @endif

            {{-- Kosongkan file --}}
            <label
              class="flex w-full cursor-pointer items-center rounded-xl border p-3 hover:bg-gray-50"
              :class="{
                  'border-2 border-red-400 bg-red-50': selection === '_NULL_',
                  'border-gray-200': selection !== '_NULL_'
              }"
            >
              <input
                type="radio"
                name="file_selection"
                value="_NULL_"
                class="hidden"
                x-model="selection"
              >

              <div
                class="mr-3 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded bg-gray-100"
              >
                <svg class="h-6 w-6 text-red-500" fill="none" stroke-width="1.5" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12.54 0c-.265.03-.52.067-.766.11l-1.08 1.688M7.754 5.79l-.172 2.685m10.69 0l-.172-2.685m0 0A48.252 48.252 0 0012 5.231c-2.43 0-4.782.372-7.016 1.037l-1.08 1.688"
                    stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>

              <p class="text-sm font-medium text-red-600">
                Kosongkan (Hapus File)
              </p>
            </label>
          </div>
        </div>
      </div>

      {{-- LINK --}}
      <div class="mb-5 rounded-2xl border border-gray-200 bg-gray-50 p-4" x-show="type === 'link'">
        <label for="link_url" class="mb-1.5 block text-sm font-semibold text-gray-800">
          URL / Link
        </label>
        <input
          id="link_url"
          name="link_url"
          type="url"
          placeholder="https://contoh.com/materi-anda"
          value="{{ old('link_url', $material->link_url) }}"
          class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-2.5 text-sm shadow-sm
                 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-teal-400"
        >
      </div>

      {{-- TEKS --}}
      <div class="mb-6 rounded-2xl border border-gray-200 bg-gray-50 p-4" x-show="type === 'text'">
        <label for="content" class="mb-1.5 block text-sm font-semibold text-gray-800">
          Konten Teks
        </label>
        <textarea
          id="content"
          name="content"
          rows="10"
          class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-2.5 text-sm shadow-sm
                 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-teal-400"
        >{{ old('content', $material->content) }}</textarea>
      </div>

      {{-- ACTION BUTTONS --}}
      <div class="flex justify-end gap-3">
        <a
          href="{{ route('mentor.rooms.show', $room) }}"
          class="inline-flex items-center rounded-full border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50"
        >
          Batal
        </a>
        <button
          type="submit"
          class="inline-flex items-center rounded-full bg-teal-500 px-6 py-2.5 text-sm font-semibold text-white shadow-md transition duration-200 hover:bg-teal-600"
        >
          Update Materi
        </button>
      </div>
    </form>
  </div>
@endsection

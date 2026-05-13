@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">✏️ Edit Postingan</h2>
        <form method="POST" action="{{ route('posts.update', $post) }}" class="space-y-6">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pengguna</label>
                <input type="text" name="username" value="{{ $post->username }}" required
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Konten Postingan</label>
                <textarea name="content" rows="6" required
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary">{{ $post->content }}</textarea>
            </div>
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-primary to-blue-600 text-white py-3 px-6 rounded-xl font-semibold shadow-lg hover:shadow-xl">
                    💾 Update Postingan
                </button>
                <a href="{{ route('posts.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200">
                    ← Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
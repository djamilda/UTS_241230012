@extends('layouts.app')

@section('title', 'SocialHub Dashboard')

@section('content')
<!-- Header -->
<div class="text-center mb-12">
    <h1 class="text-5xl font-bold bg-gradient-to-r from-primary to-purple-600 bg-clip-text text-transparent mb-4">
        SocialHub
    </h1>
    <p class="text-xl text-gray-600">Kelola postingan sosial media kamu dengan mudah</p>
</div>

<!-- Create Form -->
<div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📝 Buat Postingan Baru</h2>
    <form method="POST" action="{{ route('posts.store') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pengguna</label>
            <input type="text" name="username" required
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent @error('username') border-red-300 @enderror"
                   placeholder="@username" value="{{ old('username') }}">
            @error('username') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Konten Postingan</label>
            <textarea name="content" rows="4" required
                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent @error('content') border-red-300 @enderror"
                      placeholder="Apa yang ingin kamu bagikan hari ini?">{{ old('content') }}</textarea>
            @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="flex gap-4">
            <button type="submit"
                    class="flex-1 bg-gradient-to-r from-primary to-blue-600 text-white py-3 px-6 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                🚀 Posting
            </button>
            <a href="{{ route('posts.index') }}"
               class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all">
                Clear
            </a>
        </div>
    </form>
</div>

<!-- Posts List -->
<div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-primary to-blue-600 px-8 py-6">
        <h2 class="text-2xl font-bold text-white flex items-center">
            📱 Feed Postingan
            <span class="ml-4 bg-white/20 px-4 py-1 rounded-full text-sm font-semibold">{{ $posts->count() }} Post</span>
        </h2>
    </div>
    
    @if($posts->count() === 0)
        <div class="text-center py-16 text-gray-500">
            <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                <span class="text-3xl">📭</span>
            </div>
            <h3 class="text-xl font-semibold mb-2">Belum ada postingan</h3>
            <p>Buat postingan pertama kamu sekarang!</p>
        </div>
    @else
        <div class="divide-y divide-gray-100">
            @foreach($posts as $post)
                <div class="p-8 hover:bg-gray-50 transition-all group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-primary to-blue-500 rounded-2xl flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr($post->username, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $post->username }}</h3>
                                <p class="text-sm text-gray-500">{{ $post->created_at }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-all">
                            <a href="{{ route('posts.edit', $post) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl">
                                ✏️ Edit
                            </a>
                            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus postingan ini?')"
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-xl">🗑️ Hapus</button>
                            </form>
                        </div>
                    </div>
                    <p class="text-lg text-gray-800 leading-relaxed mb-6">{{ $post->content }}</p>
                    <div class="flex items-center space-x-6 text-sm text-gray-500">
                        <span>❤️ {{ $post->likes }}</span>
                        <span>💬 0</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
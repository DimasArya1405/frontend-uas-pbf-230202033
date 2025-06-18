@extends('layout/layout')

@section('content')
<div class="max-w-4xl mx-auto mt-8 p-6 bg-gray-800 border border-gray-700 rounded-lg text-white shadow-md">
    <h1 class="text-2xl font-bold mb-6">Edit Buku</h1>

    <form method="POST" action="{{ route('buku.update', $buku['id']) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="npm" class="block text-sm mb-1">Judul Buku</label>
                <input type="text" name="judul" id="npm" class="w-full px-3 py-2 bg-gray-900 border border-gray-600 rounded focus:outline-none" value="{{ $buku['judul'] }}" required>
            </div>
            <div>
                <label for="npm" class="block text-sm mb-1">Pengarang</label>
                <input type="text" name="pengarang" id="npm" class="w-full px-3 py-2 bg-gray-900 border border-gray-600 rounded focus:outline-none" value="{{ $buku['pengarang'] }}" required>
            </div>
            <div>
                <label for="npm" class="block text-sm mb-1">Penerbit</label>
                <input type="text" name="penerbit" id="npm" class="w-full px-3 py-2 bg-gray-900 border border-gray-600 rounded focus:outline-none" value="{{ $buku['penerbit'] }}" required>
            </div>
            <div>
                <label for="npm" class="block text-sm mb-1">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" id="npm" class="w-full px-3 py-2 bg-gray-900 border border-gray-600 rounded focus:outline-none" value="{{ $buku['tahun_terbit'] }}" required>
            </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-2 rounded shadow">
                Update
            </button>
        </div>
    </form>
</div>
@endsection

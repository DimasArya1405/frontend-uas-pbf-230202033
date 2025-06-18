@extends('layout/layout')

@section('content')
<div class="max-w-4xl mx-auto mt-8 p-6 bg-gray-800 border border-gray-700 rounded-lg text-white shadow-md">
    <h1 class="text-2xl font-bold mb-6">Tambah Data Peminjaman</h1>

    <form method="POST" action="{{ route('peminjaman.store') }}" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="npm" class="block text-sm mb-1">Nama Peminjam</label>
                <input type="text" name="nama_peminjam" id="npm" class="w-full px-3 py-2 bg-gray-900 border border-gray-600 rounded focus:outline-none" required>
            </div>
            <div>
                <label for="npm" class="block text-sm mb-1">Judul Buku</label>
                <input type="text" name="judul_buku" id="npm" class="w-full px-3 py-2 bg-gray-900 border border-gray-600 rounded focus:outline-none" required>
            </div>
            <div>
                <label for="npm" class="block text-sm mb-1">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" id="npm" class="w-full px-3 py-2 bg-gray-900 border border-gray-600 rounded focus:outline-none" required>
            </div>
            <div>
                <label for="npm" class="block text-sm mb-1">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" id="npm" class="w-full px-3 py-2 bg-gray-900 border border-gray-600 rounded focus:outline-none" required>
            </div>


        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-2 rounded shadow">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection

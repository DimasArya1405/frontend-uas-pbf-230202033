@extends('layout/layout')

@section('content')

    <div class="flex flex-col gap-4">
        <div class="flex gap-4 w-full">
            <div class="flex justify-center flex-col bg-gray-800 border w-52 border-gray-700 p-3 rounded-md gap-1">
                <div class=" text-3xl font-bold">{{ count($buku) }}</div>
                <div class="text-md">Data Buku</div>
            </div>
            @php
                use Carbon\Carbon;
                $tanggal = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y');
            @endphp

            <div class=" bg-gray-800 border border-gray-700 p-3 rounded-md text-white text-sm flex justify-between px-4 py-2 w-full float-right shadow">
                <div class="font-semibold text-center text-2xl h-full flex items-center pl-3">Data Buku</div>
                <div>
                    📅 Hari ini: <span class="font-semibold">{{ $tanggal }}</span>
                </div>
            </div>



        </div>

        <div class="flex gap-4 justify-between items-center">
            <button type="button" onclick="window.location.href = '{{ route('buku.create') }}';
      "
                class="bg-gray-700 text-white px-4 py-2 rounded hover:scale-105 cursor-pointer transition duration-200 ease-in-out w-60 flex justify-center gap-2">
                <i class="bi bi-file-earmark-plus"></i>
                <div>Tambah Data Buku</div>
            </button>
            <a href="{{ route('buku_eksport.export.pdf') }}"
                class="bg-green-600 text-white px-2 py-2 rounded hover:bg-green-700 transition duration-200 ease-in-out w-44 flex justify-center gap-2">
                <i class="bi bi-download"></i>
                <div>Download PDF</div>
            </a>
            <div class="flex gap-2">

                <form action="{{ route('buku.index') }}" method="GET" class="flex gap-2">
                    <input type="text" name="search" placeholder="Cari buku..." value="{{ request('search') }}"
                        class="border border-gray-600 rounded px-3 w-92 py-2 bg-gray-900 text-white focus:outline-none">
                    <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800 transition">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <a href="{{ route('buku.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                    Reset
                </a>
            </div>
        </div>
        <div class="w-full bg-gray-800 rounded-md border border-gray-700 overflow-x-scroll">
            <table>
                <tr>
                    <th class="px-2 py-1 border border-gray-700">Judul Buku</th>
                    <th class="px-2 py-1 border border-gray-700">Pengarang</th>
                    <th class="px-2 py-1 border border-gray-700">Penerbit</th>
                    <th class="px-2 py-1 border border-gray-700">Tahun Terbit</th>
                    <th class="px-2 py-1 border border-gray-700">Aksi</th>
                </tr>
                @if (count($buku) > 0)
                    @foreach ($buku as $item)
                        <tr class="hover:bg-gray-800 transition duration-150 ease-in-out border-b border-gray-700">
                            <td class="px-4 py-2">{{ $item['judul'] }}</td>
                            <td class="px-4 py-2">{{ $item['pengarang'] }}</td>
                            <td class="px-4 py-2">{{ $item['penerbit'] }}</td>
                            <td class="px-4 py-2">{{ $item['tahun_terbit'] }}</td>
                            <td class="px-4 py-2">
                                <div class="flex gap-2">
                                    <a href="{{ route('buku.edit', $item['id']) }}"
                                        class="px-3 py-1 bg-gray-700 text-white rounded hover:bg-gray-900 transition cursor-pointer duration-150 ease-in-out text-center">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>


                                    <form method="POST" action="{{ route('buku.destroy', $item['id']) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin hapus?')"
                                            class="px-3 py-1 bg-gray-700 text-white rounded hover:bg-gray-900 transition cursor-pointer duration-150 ease-in-out">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center py-4">Data tidak ada</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>



    </div>


@endsection

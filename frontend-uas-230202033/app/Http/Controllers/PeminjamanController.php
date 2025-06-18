<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $response = Http::get('http://localhost:8080/peminjaman');
        $peminjaman = $response->json();

        if ($search) {
            $peminjaman = array_filter($peminjaman, function ($item) use ($search) {
                return stripos($item['id'], $search) !== false
                    || stripos($item['nama_peminjam'], $search) !== false;
            });
        }

        // Urutkan data berdasarkan nama A-Z
        usort($peminjaman, function ($a, $b) {
            return strcmp($a['nama_peminjam'], $b['nama_peminjam']);
        });

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        return view('peminjaman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:50',
            'judul_buku' => 'required|string|max:100',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
        ]);

        $response = Http::asJson()->post('http://localhost:8080/peminjaman', [
            'nama_peminjam' => $request->nama_peminjam,
            'judul_buku' => $request->judul_buku,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        if ($response->successful()) {
            return redirect()->route('peminjaman.index')->with('success', 'Berhasil menambahkan data peminjaman.');
        }

        return back()->withErrors(['error' => 'Gagal menambahkan data'])->withInput();
    }

    public function edit($id)
    {
        $response = Http::get("http://localhost:8080/peminjaman/$id");

        if ($response->successful()) {
            $peminjaman = $response->json()[0];
            return view('peminjaman.edit', compact('peminjaman'));
        }

        return back()->with('error', 'Data tidak ditemukan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:50',
            'judul_buku' => 'required|string|max:100',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
        ]);

        $response = Http::put("http://localhost:8080/peminjaman/$id", $request->all());

        if ($response->successful()) {
            return redirect()->route('peminjaman.index')->with('success', 'Berhasil mengupdate data.');
        }

        return back()->withErrors(['error' => 'Gagal mengupdate data'])->withInput();
    }

    public function destroy($id)
    {
        $response = Http::delete("http://localhost:8080/peminjaman/$id");

        if ($response->successful()) {
            return redirect()->route('peminjaman.index')->with('success', 'Berhasil menghapus data.');
        }

        return back()->with('error', 'Gagal menghapus data.');
    }

    public function exportPDF(Request $request)
    {
        $response = Http::get('http://localhost:8080/peminjaman');
        $peminjaman = $response->json();

        usort($peminjaman, function ($a, $b) {
            return strcmp($a['nama_peminjam'], $b['nama_peminjam']);
        });

        $pdf = Pdf::loadView('peminjaman_eksport.pdf', compact('peminjaman'));
        return $pdf->download('data_peminjaman.pdf');
    }
}

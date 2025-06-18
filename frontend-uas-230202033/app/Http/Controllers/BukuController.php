<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $response =Http::get('http://localhost:8080/buku');
        $buku = $response->json();

        if ($search) {
            $buku = array_filter($buku, function($item) use ($search) {
                return stripos($item['id'], $search) !== false 
                    || stripos($item['judul'], $search) !== false;
            });
        }

        // Urutkan data berdasarkan nama A-Z
        usort($buku, function($a, $b) {
            return strcmp($a['judul'], $b['judul']);
        });

        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'pengarang' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer',
        ]);

        $response = Http::asJson()->post('http://localhost:8080/buku', [
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
        ]);

        if ($response->successful()) {
            return redirect()->route('buku.index')->with('success', 'Berhasil menambahkan data buku.');
        }

        return back()->withErrors(['error' => 'Gagal menambahkan data'])->withInput();
    }

    public function edit($id_buku)
    {
        $response = Http::get("http://localhost:8080/buku/$id_buku");

        if ($response->successful()) {
            $buku = $response->json()[0];
            return view('buku.edit', compact('buku'));
        }

        return back()->with('error', 'Data tidak ditemukan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'pengarang' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer',
        ]);

        $response = Http::put("http://localhost:8080/buku/$id", $request->all());

        if ($response->successful()) {
            return redirect()->route('buku.index')->with('success', 'Berhasil mengupdate data.');
        }

        return back()->withErrors(['error' => 'Gagal mengupdate data'])->withInput();
    }

    public function destroy($id)
    {
        $response = Http::delete("http://localhost:8080/buku/$id");

        if ($response->successful()) {
            return redirect()->route('buku.index')->with('success', 'Berhasil menghapus data.');
        }

        return back()->with('error', 'Gagal menghapus data.');
    }

    public function exportPDF(Request $request)
    {
        $response = Http::get('http://localhost:8080/buku');
        $buku = $response->json();

        usort($buku, function ($a, $b) {
            return strcmp($a['judul'], $b['judul']);
        });

        $pdf = Pdf::loadView('buku_eksport.pdf', compact('buku'));
        return $pdf->download('data_buku.pdf');
    }
}

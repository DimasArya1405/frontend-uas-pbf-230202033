<?php namespace App\Models;
use CodeIgniter\Model;

class PeminjamanModel extends Model {
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_peminjam', 'judul_buku', 'tanggal_pinjam', 'tanggal_kembali'];
    protected $useTimestamps = false;
}
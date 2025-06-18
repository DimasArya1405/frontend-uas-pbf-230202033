<?php namespace App\Controllers;

use App\Models\PeminjamanModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header(
    "Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization"
);

class Peminjaman extends ResourceController {
    use ResponseTrait;
    protected $modelName = 'App\\Models\\PeminjamanModel';
    protected $format    = 'json';
    protected $peminjamanModel;

    public function __construct() {       
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function index()
    {
        $data = $this->peminjamanModel->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $data = $this->peminjamanModel->where("id", $id)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan");
        }
    }

    public function showName($nama = null)
    {
        try {
            if (empty($nama)) {
                return $this->fail("Nama Peminjam harus diisi", 400);
            }

            $data = $this->peminjamanModel
                ->where("nama_peminjam", $nama)
                ->findAll();

            if (!empty($data)) {
                return $this->respond(
                    [
                        "status" => 200,
                        "message" => "Data Peminjam ditemukan",
                        "data" => $data,
                    ],
                    200
                );
            } else {
                return $this->failNotFound(
                    "Data mahasiswa dengan nama " . $nama . " tidak ditemukan"
                );
            }
        } catch (\Exception $e) {
            return $this->fail("Terjadi kesalahan: " . $e->getMessage(), 500);
        }
    }

    public function create()
    {
        $data = $this->request->getJSON(true); // ini bagian penting!

        // $userCheck = $this->peminjamanModel
        //     ->where("id", $data["id"])
        //     ->where("nama_peminjam", $data["nama_peminjam"])
        //     ->first();

        // if (!$userCheck) {
        //     return $this->fail([
        //         "message" => "ID User tidak sesuai dengan yang ada di tabel user / Nama mahasiswa tidak ada di table user",
        //     ], 400);
        // }

        if (!$this->peminjamanModel->save($data)) {
            return $this->fail($this->peminjamanModel->errors());
        }

        return $this->respond([
            "status" => 200,
            "message" => ["success" => "Berhasil Menambah Data"],
        ], 200);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        $data["id"] = $id;

        $ifExist = $this->peminjamanModel->where("id", $id)->findAll();
        if (!$ifExist) {
            return $this->failNotFound("Data tidak ditemukan");
        }

        // $npmCheck = $this->peminjamanModel
        //     ->where("id", $data["id"])
        //     ->where("id !=", $id)
        //     ->first();
        // if ($npmCheck) {
        //     return $this->fail(["message" => "NPM sudah digunakan"], 400);
        // }

        // $userCheck = $this->peminjamanModel
        //     ->where("id", $data["id"])
        //     ->where("username", $data["nama_peminjam"])
        //     ->first();
        // if (!$userCheck) {
        //     return $this->fail(
        //         [
        //             "message" =>
        //             "ID User dan username tidak sesuai dengan data di tabel user",
        //         ],
        //         400
        //     );
        // }

        if (!$this->peminjamanModel->save($data)) {
            return $this->fail($this->peminjamanModel->errors());
        }

        return $this->respond(
            [
                "status" => 200,
                "message" => ["success" => "Berhasil Mengubah Data"],
            ],
            200
        );
    }

    public function delete($id_buku = null)
    {
        $buku = $this->peminjamanModel->where("id", $id_buku)->first();
        $id_buku = $buku["id"];
        $buku = $this->peminjamanModel->where("id", $id_buku)->first();

        if ($buku) {
            $this->peminjamanModel->where("id", $id_buku)->delete();
            return $this->respondDeleted([
                "status" => 200,
                "message" => ["success" => "Data berhasil dihapus."],
            ]);
        } else {
            return $this->failNotFound("Data tidak ditemukan.");
        }
    }
}
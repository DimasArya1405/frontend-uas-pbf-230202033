<?php namespace App\Controllers;

use App\Models\BukuModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header(
    "Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization"
);

class Buku extends ResourceController {

    use ResponseTrait;
    protected $modelName = 'App\\Models\\BukuModel';
    protected $format    = 'json';
    protected $bukuModel;

    public function __construct() {       
        $this->bukuModel = new BukuModel();
    }

    public function index()
    {
        $data = $this->bukuModel->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $data = $this->bukuModel->where("id", $id)->findAll();
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
                return $this->fail("Judul buku harus diisi", 400);
            }

            $data = $this->bukuModel
                ->where("judul", $nama)
                ->findAll();

            if (!empty($data)) {
                return $this->respond(
                    [
                        "status" => 200,
                        "message" => "Data Buku ditemukan",
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

        // $userCheck = $this->bukuModel
        //     ->where("id", $data["id"])
        //     ->where("judul", $data["judul"])
        //     ->first();

        // if (!$userCheck) {
        //     return $this->fail([
        //         "message" => "ID User tidak sesuai dengan yang ada di tabel user / Nama mahasiswa tidak ada di table user",
        //     ], 400);
        // }

        if (!$this->bukuModel->save($data)) {
            return $this->fail($this->bukuModel->errors());
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

        $ifExist = $this->bukuModel->where("id", $id)->findAll();
        if (!$ifExist) {
            return $this->failNotFound("Data tidak ditemukan");
        }

        // $npmCheck = $this->bukuModel
        //     ->where("id", $data["id"])
        //     ->where("id !=", $id)
        //     ->first();
        // if ($npmCheck) {
        //     return $this->fail(["message" => "NPM sudah digunakan"], 400);
        // }

        // $userCheck = $this->bukuModel
        //     ->where("id", $data["id"])
        //     ->where("username", $data["judul"])
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

        if (!$this->bukuModel->save($data)) {
            return $this->fail($this->bukuModel->errors());
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
        $buku = $this->bukuModel->where("id", $id_buku)->first();
        $id_buku = $buku["id"];
        $buku = $this->bukuModel->where("id", $id_buku)->first();

        if ($buku) {
            $this->bukuModel->where("id", $id_buku)->delete();
            return $this->respondDeleted([
                "status" => 200,
                "message" => ["success" => "Data berhasil dihapus."],
            ]);
        } else {
            return $this->failNotFound("Data tidak ditemukan.");
        }
    }
}
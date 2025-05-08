<?php
require_once 'Config/DB.php';

class Armada
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            a.*, jk.nama as jenis_kendaraan
            FROM armada a
            LEFT JOIN jenis_kendaraan jk ON jk.id = a.jenis_kendaraan_id
        ");
        $data = $stmt->fetchAll();

        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT 
            a.*, jk.nama as jenis_kendaraan
            FROM armada a
            LEFT JOIN jenis_kendaraan jk ON jk.id = a.jenis_kendaraan_id
            WHERE a.id=$id
        ");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO armada (merk, nopol, thn_beli, deskripsi, jenis_kendaraan_id, kapasitas_kursi, rating) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['merk'], 
            $data['nopol'], 
            $data['thn_beli'], 
            $data['deskripsi'], 
            $data['jenis_kendaraan_id'], 
            $data['kapasitas_kursi'], 
            $data['rating']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE armada SET merk=:merk, nopol=:nopol, thn_beli=:thn_beli, deskripsi=:deskripsi, jenis_kendaraan_id=:jenis_kendaraan_id, kapasitas_kursi=:kapasitas_kursi, rating=:rating WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':merk', $data['merk']);
        $stmt->bindParam(':nopol', $data['nopol']);
        $stmt->bindParam(':thn_beli', $data['thn_beli']);
        $stmt->bindParam(':deskripsi', $data['deskripsi']);
        $stmt->bindParam(':jenis_kendaraan_id', $data['jenis_kendaraan_id']);
        $stmt->bindParam(':kapasitas_kursi', $data['kapasitas_kursi']);
        $stmt->bindParam(':rating', $data['rating']);
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM armada WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $row;
    }
}

$armada = new Armada($pdo);
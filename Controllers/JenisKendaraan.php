<?php
require_once 'Config/DB.php';

class JenisKendaraan
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM jenis_kendaraan");
        $data = $stmt->fetchAll();
        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM jenis_kendaraan WHERE id=$id");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO jenis_kendaraan (nama) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['nama']]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE jenis_kendaraan SET nama=:nama WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM jenis_kendaraan WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $row;
    }
}

$jeniskendaraan = new JenisKendaraan($pdo);
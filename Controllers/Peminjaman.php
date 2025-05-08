<?php
require_once 'Config/DB.php';

class Peminjaman
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            p.*, a.merk as nama_armada
            FROM peminjaman p
            LEFT JOIN armada a ON a.id = p.armada_id
        ");
        $data = $stmt->fetchAll();

        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT 
            p.*, a.merk as nama_armada
            FROM peminjaman p
            LEFT JOIN armada a ON a.id = p.armada_id
            WHERE p.id=$id
        ");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO peminjaman (nama_peminjam, ktp_peminjam, keperluan_pinjam, mulai, selesai, biaya, armada_id, komentar_peminjam, status_pinjam) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['nama_peminjam'],
            $data['ktp_peminjam'],
            $data['keperluan_pinjam'],
            $data['mulai'],
            $data['selesai'],
            $data['biaya'],
            $data['armada_id'],
            $data['komentar_peminjam'],
            $data['status_pinjam']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE peminjaman SET nama_peminjam=:nama_peminjam, ktp_peminjam=:ktp_peminjam, keperluan_pinjam=:keperluan_pinjam, mulai=:mulai, selesai=:selesai, biaya=:biaya, armada_id=:armada_id, komentar_peminjam=:komentar_peminjam, status_pinjam=:status_pinjam WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':nama_peminjam', $data['nama_peminjam']);
        $stmt->bindParam(':ktp_peminjam', $data['ktp_peminjam']);
        $stmt->bindParam(':keperluan_pinjam', $data['keperluan_pinjam']);
        $stmt->bindParam(':mulai', $data['mulai']);
        $stmt->bindParam(':selesai', $data['selesai']);
        $stmt->bindParam(':biaya', $data['biaya']);
        $stmt->bindParam(':armada_id', $data['armada_id']);
        $stmt->bindParam(':komentar_peminjam', $data['komentar_peminjam']);
        $stmt->bindParam(':status_pinjam', $data['status_pinjam']);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);

        $sql = "DELETE FROM peminjaman WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $row;
    }

    public function getLatestPeminjaman()
    {
        $stmt = $this->pdo->query("SELECT 
            p.*, a.merk as nama_armada
            FROM peminjaman p
            LEFT JOIN armada a ON a.id = p.armada_id
            ORDER BY p.id DESC LIMIT 1
        ");
        $data = $stmt->fetch();
        return $data;
    }
}

$peminjaman = new Peminjaman($pdo);
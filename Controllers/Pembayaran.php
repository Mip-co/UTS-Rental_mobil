<?php
require_once 'Config/DB.php';

class Pembayaran
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            p.id, p.tanggal, p.jumlah_bayar, 
            pm.nama_peminjam as nama_peminjam, a.merk as nama_armada
            FROM pembayaran p
            LEFT JOIN peminjaman pm ON pm.id = p.peminjaman_id
            LEFT JOIN armada a ON a.id = pm.armada_id
        ");
        $data = $stmt->fetchAll();

        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT 
            p.id, p.tanggal, p.jumlah_bayar, 
            pm.nama_peminjam as nama_peminjam, a.merk as nama_armada
            FROM pembayaran p
            LEFT JOIN peminjaman pm ON pm.id = p.peminjaman_id
            LEFT JOIN armada a ON a.id = pm.armada_id
            WHERE p.id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO pembayaran (tanggal, jumlah_bayar, peminjaman_id) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['tanggal'],
            $data['jumlah_bayar'],
            $data['peminjaman_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE pembayaran SET tanggal=:tanggal, jumlah_bayar=:jumlah_bayar, peminjaman_id=:peminjaman_id WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':jumlah_bayar', $data['jumlah_bayar']);
        $stmt->bindParam(':peminjaman_id', $data['peminjaman_id']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM pembayaran WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        return $row;
    }
}

$pembayaran = new Pembayaran($pdo);
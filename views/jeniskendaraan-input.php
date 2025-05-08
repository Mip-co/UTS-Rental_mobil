<?php
require_once 'Controllers/JenisKendaraan.php';
require_once 'Helpers/helper.php';

$jenis_kendaraan_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_jenis_kendaraan = $jenis_kendaraan_id ? $jeniskendaraan->show($jenis_kendaraan_id) : [];

if (isset($_POST['type'])) {
  if ($_POST['type'] == 'create') {
    $id = $jeniskendaraan->create($_POST);
    echo "<script>alert('Data berhasil ditambahkan')</script>";
    echo "<script>window.location='?url=jeniskendaraan'</script>";
  } else if ($_POST['type'] == 'update') {
    $row = $jeniskendaraan->update($jenis_kendaraan_id, $_POST);
    echo "<script>alert('Data jenis kendaraan $row[nama] berhasil diperbarui')</script>";
    echo "<script>window.location='?url=jeniskendaraan'</script>";
  }
}
?>

<div class="container">
  <form method="post">

    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <?= $jenis_kendaraan_id ? 'Edit Jenis Kendaraan' : 'Tambah Jenis Kendaraan' ?>
        </div>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="nama">Nama Jenis Kendaraan</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?= getSafeFormValue($show_jenis_kendaraan, 'nama') ?>" required>
        </div>
      </div>

      <div class="card-footer text-right">
        <input type="hidden" name="type" value="<?= $jenis_kendaraan_id ? 'update' : 'create' ?>">
        <input type="hidden" name="id" value="<?= $jenis_kendaraan_id ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>

  </form>
</div>
<?php
require_once 'Controllers/Peminjaman.php';
require_once 'Controllers/Armada.php';
require_once 'Helpers/helper.php';

$peminjaman_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_peminjaman = $peminjaman_id ? $peminjaman->show($peminjaman_id) : [];
$list_armada = $armada->index();

if (isset($_POST['type'])) {
  if ($_POST['type'] == 'create') {
    $id = $peminjaman->create($_POST);
    echo "<script>alert('Data berhasil ditambahkan')</script>";
    echo "<script>window.location='?url=peminjaman'</script>";
  } else if ($_POST['type'] == 'update') {
    $row = $peminjaman->update($peminjaman_id, $_POST);
    echo "<script>alert('Data peminjaman oleh $row[nama_peminjam] berhasil diperbarui')</script>";
    echo "<script>window.location='?url=peminjaman'</script>";
  }
}
?>

<div class="container">
  <form method="post">

    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <?= $peminjaman_id ? 'Edit Peminjaman' : 'Tambah Peminjaman' ?>
        </div>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="nama_peminjam">Nama Peminjam</label>
          <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" value="<?= getSafeFormValue($show_peminjaman, 'nama_peminjam') ?>" required>
        </div>
        <div class="form-group">
          <label for="ktp_peminjam">KTP Peminjam</label>
          <input type="text" class="form-control" id="ktp_peminjam" name="ktp_peminjam" value="<?= getSafeFormValue($show_peminjaman, 'ktp_peminjam') ?>" required>
        </div>
        <div class="form-group">
          <label for="keperluan_pinjam">Keperluan</label>
          <textarea class="form-control" id="keperluan_pinjam" name="keperluan_pinjam" rows="3" required><?= getSafeFormValue($show_peminjaman, 'keperluan_pinjam') ?></textarea>
        </div>
        <div class="form-group">
          <label for="mulai">Mulai</label>
          <input type="datetime-local" class="form-control" id="mulai" name="mulai" value="<?= getSafeFormValue($show_peminjaman, 'mulai') ?>" required>
        </div>
        <div class="form-group">
          <label for="selesai">Selesai</label>
          <input type="datetime-local" class="form-control" id="selesai" name="selesai" value="<?= getSafeFormValue($show_peminjaman, 'selesai') ?>" required>
        </div>
        <div class="form-group">
          <label for="biaya">Biaya</label>
          <input type="number" class="form-control" id="biaya" name="biaya" value="<?= getSafeFormValue($show_peminjaman, 'biaya') ?>" required>
        </div>
        <div class="form-group">
          <label for="armada_id">Armada</label>
          <select class="form-control" id="armada_id" name="armada_id" required>
            <?php foreach ($list_armada as $armada): ?>
              <option value="<?= $armada['id'] ?>" <?= getSafeFormValue($show_peminjaman, 'armada_id') == $armada['id'] ? 'selected' : '' ?>>
                <?= $armada['merk'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="komentar_peminjam">Komentar Peminjam</label>
          <textarea class="form-control" id="komentar_peminjam" name="komentar_peminjam" rows="3"><?= getSafeFormValue($show_peminjaman, 'komentar_peminjam') ?></textarea>
        </div>
        <div class="form-group">
          <label for="status_pinjam">Status</label>
          <select class="form-control" id="status_pinjam" name="status_pinjam" required>
            <option value="Dipinjam" <?= getSafeFormValue($show_peminjaman, 'status_pinjam') == 'Dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
            <option value="Dikembalikan" <?= getSafeFormValue($show_peminjaman, 'status_pinjam') == 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
          </select>
        </div>
      </div>

      <div class="card-footer text-right">
        <input type="hidden" name="type" value="<?= $peminjaman_id ? 'update' : 'create' ?>">
        <input type="hidden" name="id" value="<?= $peminjaman_id ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>

  </form>
</div>
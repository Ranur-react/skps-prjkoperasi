<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Data Simpanan
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-sm btn-primary" onclick="location.href=('/simpanan/tambah')">
    <i class="fa fa-plus-circle"></i> Tambah Simpanan
</button>
<?= $this->endsection('subjudul') ?>

<?= $this->section('isi') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<?= form_open('simpanan/index') ?>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Cari data berdasarkan Kode, Nama, dan Kategori" name="cari"
        autofocus value="<?= $cari ?>">
    <div class="input-group-append">
        <button class="btn btn-outline-success" type="submit" name="tombolcari">
            <i class="fa fa-search"></i>
        </button>
    </div>
</div>
<?= form_close(); ?>
<span class="badge badge-success">
    <h5>
        <?= "Total Data : $totaldata"; ?>
    </h5>
</span>
<br>
<table class="table table-striped table-bordered" style="width:100;">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th>No Simpanan</th>
            <th>Nama Anggota</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Tgl Simpan</th>
            <th style="width: 15%;">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $nomor = 1 + (($nohalaman - 1) * 10);
        foreach ($tampildata as $row) :
        ?>

        <tr>
            <td><?= $nomor++; ?></td>
            <td><?= $row['nosimpanan']; ?></td>
            <td><?= $row['namaanggota']; ?></td>
            <td><?= $row['jenis']; ?></td>
            <td><?= number_format($row['jml'], 0); ?></td>
            <td><?= $row['ket']; ?></td>
            <td><?= $row['tglsimpan']; ?></td>
            <td>

                <button type="button" class="btn btn-sm btn-info" onclick="edit('<?= $row['nosimpanan'] ?>')">
                    <i class="fa fa-edit"></i></button>

                <form method="POST" action="/simpanan/hapus/<?= $row['nosimpanan'] ?>" style="display:inline;"
                    onsubmit="return hapus();">
                    <input type="hidden" value="DELETE" name="_method">

                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="float-center">
    <?= $pager->links('simpanan', 'paging'); ?>
</div>
<script>
function edit(kode) {
    window.location.href = ('/simpanan/edit/' + kode);
}

function hapus(kode) {
    pesan = confirm('Yakin data simpanan ini dihapus ?');
    if (pesan) {
        return true;
    } else {
        return false;
    }

}
</script>
<?= $this->endsection('isi') ?>
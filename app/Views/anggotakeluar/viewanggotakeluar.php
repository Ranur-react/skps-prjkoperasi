<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Data Anggota Keluar
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-sm btn-primary" onclick="location.href=('/anggotakeluar/tambah')">
    <i class="fa fa-plus-circle"></i> Tambah Anggota keluar
</button>
<?= $this->endsection('subjudul') ?>
<?= $this->section('isi') ?>


<?= session()->getFlashdata('sukses'); ?>
<?= form_open('anggotakeluar/index') ?>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Cari Data Anggota" aria-label="Recipient's username"
        aria-describedby="button-addon2" name="cari" value="<?= $cari; ?>">
    <div class="input-group-append">
        <button class="btn btn-outline-primary" type="submit" id="tombolcari" name="tombolcari">
            <i class="fa fa-search"></i></button>
    </div>
</div>
<?= form_close(); ?>
<table class="table table-striped table-bordered" style="width:100;">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th>Kode Keluar</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Nama anggota</th>
            <th>Jumlah Simpanan</th>
            <th>Sisa Pinjaman</th>
            <th style="width: 15%;">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $nomor = 1 + (($nohalaman - 1) * 5);
        foreach ($tampildata as $row) :
        ?>

        <tr>
            <td><?= $nomor++; ?></td>
            <td><?= $row['kodekel']; ?></td>
            <td><?= $row['tglkeluar']; ?></td>
            <td><?= $row['tglmasuk']; ?></td>
            <td><?= $row['namaanggota']; ?></td>
            <td><?= $row['jumlahsimpanan']; ?></td>
            <td><?= $row['sisapinjaman']; ?></td>
            <td>
                <button type="button" class="btn btn-info" title="Edit Data" onclick="edit('<?= $row['kodekel'] ?>')">
                    <i class="fa fa-edit"></i>
                </button>

                <form method="POST" action="/anggotakeluar/hapus/<?= $row['kodekel'] ?>" style="display:inline;"
                    onsubmit="return hapus();">
                    <input type="hidden" value="DELETE" name="_method">

                    <button type="submit" class="btn btn-danger" title="Hapus Data">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="float-center">
    <?= $pager->links('anggotakeluar', 'paging'); ?>
</div>
<script>
function edit(kode) {
    window.location = ('/anggotakeluar/formedit/' + kode);
}

function hapus() {
    pesan = confirm('Yakin data anggota dihapus ?');

    if (pesan) {
        return true;
    } else {
        return false;
    }
}
</script>

<?= $this->endsection('isi') ?>
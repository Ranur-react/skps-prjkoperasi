<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Data Pinjaman
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-sm btn-primary" onclick="location.href=('/pinjaman/tambah')">
    <i class="fa fa-plus-circle"></i> Tambah Pinjaman
</button>
<?= $this->endsection('subjudul') ?>

<?= $this->section('isi') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<?= form_open('pinjaman/index') ?>
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
            <th style="width: 4%;">No</th>
            <th>No Pinjam</th>
            <th>Tanggal Pinjam</th>
            <th>No Anggota</th>
            <th>Jml Pinjam</th>
            <th>Lama Pinjam</th>
            <th>Angsuran</th>
            <th>Jasa</th>
            <th>Askes</th>
            <th>Respin</th>
            <th>SW</th>
            <th>SL</th>
            <th>Hutang</th>
            <th>Jumlah Potongan</th>
            <th>Pinjaman Bersih</th>
            <th style="width: 8%;">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $nomor = 1 + (($nohalaman - 1) * 10);
        foreach ($tampildata as $row) :
        ?>

        <tr>
            <td><?= $nomor++; ?></td>
            <td><?= $row['nopinjam']; ?></td>
            <td><?= $row['tglpinjam']; ?></td>
            <td><?= $row['noanggota']; ?></td>
            <td><?= number_format($row['jmlpinjam'], 0); ?></td>
            <td><?= number_format($row['lamapinjam'], 0); ?></td>
            <td><?= number_format($row['angsuran'], 0); ?></td>
            <td><?= number_format($row['jasa'], 0); ?></td>
            <td><?= number_format($row['askes'], 0); ?></td>
            <td><?= number_format($row['respin'], 0); ?></td>
            <td><?= number_format($row['sw'], 0); ?></td>
            <td><?= number_format($row['sl'], 0); ?></td>
            <td><?= number_format($row['hutang'], 0); ?></td>
            <td><?= number_format($row['jumlahpotongan'], 0); ?></td>
            <td><?= number_format($row['pinjamanbersih'], 0); ?></td>
            <td>

                <button type="button" class="btn btn-sm btn-info" onclick="edit('<?= $row['nopinjam'] ?>')">
                    <i class="fa fa-edit"></i></button>

                <form method="POST" action="/pinjaman/hapus/<?= $row['nopinjam'] ?>" style="display:inline;"
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
    <?= $pager->links('pinjaman', 'paging'); ?>
</div>
<script>
function edit(kode) {
    window.location.href = ('/pinjaman/edit/' + kode);
}

function hapus(kode) {
    pesan = confirm('Yakin data pinjaman ini dihapus ?');
    if (pesan) {
        return true;
    } else {
        return false;
    }

}
</script>
<?= $this->endsection('isi') ?>
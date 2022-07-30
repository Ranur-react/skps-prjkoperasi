<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Manajemen Data Anggota
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fa fa-plus-circle"></i> Tambah Data', [
    'class' => 'btn btn-primary',
    'onclick' => "location.href=('" . site_url('anggota/formtambah') . "')"
]) ?>

<?= $this->endsection('subjudul') ?>

<?= $this->section('isi') ?>


<?= session()->getFlashdata('sukses'); ?>
<?= form_open('anggota/index') ?>
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
            <th>No Anggota</th>
            <th>Nama Anggota</th>
            <th>Pekerjaan</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Tgl Masuk</th>
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
            <td><?= $row['noanggota']; ?></td>
            <td><?= $row['namaanggota']; ?></td>
            <td><?= $row['pekerjaan']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['telepon']; ?></td>
            <td><?= $row['tglmasuk']; ?></td>
            <td>
                <button type="button" class="btn btn-info" title="Edit Data" onclick="edit('<?= $row['noanggota'] ?>')">
                    <i class="fa fa-edit"></i>
                </button>

                <form method="POST" action="/anggota/hapus/<?= $row['noanggota'] ?>" style="display:inline;"
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
    <?= $pager->links('anggota', 'paging'); ?>
</div>
<script>
function edit(kode) {
    window.location = ('/anggota/formedit/' + kode);
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
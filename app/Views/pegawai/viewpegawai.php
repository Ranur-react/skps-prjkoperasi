<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Manajemen Data Pegawai
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fa fa-plus-circle"></i> Tambah Data', [
    'class' => 'btn btn-primary',
    'onclick' => "location.href=('" . site_url('pegawai/formtambah') . "')"
]) ?>

<?= $this->endsection('subjudul') ?>

<?= $this->section('isi') ?>


<?= session()->getFlashdata('sukses'); ?>
<?= form_open('pegawai/index') ?>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Cari Data pegawai" aria-label="Recipient's username"
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
            <th>NIK</th>
            <th>Nama Pegawai</th>
            <th>Jabatan</th>
            <th>Gaji Pokok</th>
            <th>Status</th>
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
            <td><?= $row['nik']; ?></td>
            <td><?= $row['namapegawai']; ?></td>
            <td><?= $row['jabatan']; ?></td>
            <td><?= $row['gajipokok']; ?></td>
            <td><?= $row['status']; ?></td>
            <td>
                <button type="button" class="btn btn-info" title="Edit Data" onclick="edit('<?= $row['nik'] ?>')">
                    <i class="fa fa-edit"></i>
                </button>

                <form method="POST" action="/pegawai/hapus/<?= $row['nik'] ?>" style="display:inline;"
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
    <?= $pager->links('pegawai', 'paging'); ?>
</div>
<script>
function edit(kode) {
    window.location = ('/pegawai/formedit/' + kode);
}

function hapus() {
    pesan = confirm('Yakin data pegawai dihapus ?');

    if (pesan) {
        return true;
    } else {
        return false;
    }
}
</script>

<?= $this->endsection('isi') ?>
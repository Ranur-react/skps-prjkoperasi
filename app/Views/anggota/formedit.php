<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Edit Anggota
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/anggota/index')">
    <i class="fa fa-backward"></i> Kembali
</button>

<?= $this->endsection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open_multipart('anggota/updatedata') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<div class="form-group row">
    <label for="" class="col-sm-4 form-label">No Anggota</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="noanggota" name="noanggota" readonly value="<?= $noanggota; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Nama Anggota</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="namaanggota" name="namaanggota" value="<?= $namaAnggota; ?>"
            autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Pekerjaan</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= $pekerjaan; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Alamat</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $alamat; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Telepon</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $telepon; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Tgl Masuk</label>
    <div class="col-sm-8">
        <input type="date" class="form-control" id="tglmasuk" name="tglmasuk" value="<?= $tglMasuk; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label"></label>
    <div class="col-sm-4">
        <input type="submit" value="Update" class="btn btn-success">
    </div>
</div>
<?= form_close(); ?>
<?= $this->endSection('isi'); ?>
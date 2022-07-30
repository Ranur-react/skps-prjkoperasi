<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Edit Pegawai
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/pegawai/index')">
    <i class="fa fa-backward"></i> Kembali
</button>

<?= $this->endsection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open_multipart('pegawai/updatedata') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<div class="form-group row">
    <label for="" class="col-sm-4 form-label">NIK</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="nik" name="nik" readonly value="<?= $nik; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Nama Pegawai</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="namapegawai" name="namapegawai" value="<?= $namaPegawai; ?>"
            autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Jabatan</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $jabatan; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Gaji Pokok</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="gajipokok" name="gajipokok" value="<?= $gajiPokok; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Status</label>
    <div class="col-sm-8">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="Aktif" />
            <label class="form-check-label" for="inlineRadio1">Aktif</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="Tidak Aktif" />
            <label class="form-check-label" for="inlineRadio2">Tidak Aktif</label>
        </div>
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
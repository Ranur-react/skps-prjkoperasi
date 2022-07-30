<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Tambah Anggota
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('anggota/index') . "')"
]) ?>

<?= $this->endsection('subjudul') ?>

<?= $this->section('isi') ?>
<?= form_open('anggota/simpandata') ?>
<div class="form-group row">
    <label for="" class="col-sm-4 form-label">No Anggota</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="noanggota" name="noanggota" autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Nama Anggota</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="namaanggota" name="namaanggota">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Pekerjaan</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Alamat</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="alamat" name="alamat">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Telepon</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="telepon" name="telepon">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Tgl Masuk</label>
    <div class="col-sm-8">
        <input type="date" class="form-control" id="tglmasuk" name="tglmasuk">
    </div>
</div>
<?= session()->getFlashdata('errorNamaAnggota'); ?>
</div>

<div class="form-group">
    <?= form_submit('', 'Simpan', [
        'class' => 'btn btn-success'
    ]) ?>

</div>
<?= form_close(); ?>
<?= $this->endsection('isi') ?>
<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Tambah Pegawai
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('pegawai/index') . "')"
]) ?>

<?= $this->endsection('subjudul') ?>

<?= $this->section('isi') ?>
<?= form_open('pegawai/simpandata') ?>
<div class="form-group row">
    <label for="" class="col-sm-4 form-label">NIK</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="nik" name="nik" autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Nama Pegawai</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="namapegawai" name="namapegawai">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Cari Jabatan</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" placeholder="Nama Jabatan" name="namajabatan" id="namajabatan" readonly>
        <input type="hidden" name="idjabatan" id="idjabatan">
        <div class="input-group-append">
            <button class="btn btn-outline-primary" type="button" id="tombolCariJabatan" title="Cari jabatan">
                <i class="fa fa-search"></i>
            </button>

            <button class="btn btn-outline-success" type="button" id="tombolTambahJabatan" title="Tambah jabatan">
                <i class="fa fa-plus-square"></i>
            </button>
        </div>
    </div>
</div>
</div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Gaji Pokok</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="gajipokok" name="gajipokok">
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

        <?= session()->getFlashdata('errorNamaPegawai'); ?>
    </div>
</div>

<div class="form-group">
    <?= form_submit('', 'Simpan', [
        'class' => 'btn btn-success'
    ]) ?>

</div>
<?= form_close(); ?>

<?= $this->endsection('isi') ?>
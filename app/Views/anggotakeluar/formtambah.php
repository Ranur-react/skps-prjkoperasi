<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Tambah Anggota Keluar
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/anggotakeluar/index')">
    <i class="fa fa-backward"></i> Kembali
</button>

<?= $this->endsection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open_multipart('anggotakeluar/simpandata') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Kode Anggota</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="kodekel" name="kodekel" autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Tgl Keluar</label>
    <div class="col-sm-8">
        <input type="date" class="form-control" id="tglkeluar" name="tglkeluar">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Tgl Masuk</label>
    <div class="col-sm-8">
        <input type="date" class="form-control" id="tglmasuk" name="tglmasuk">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Pilih Anggota</label>
    <div class="col-sm-4">
        <select name="anggota" id="anggota" class="form-control">
            <option selected value="">=Pilih=</option>
            <?php foreach ($dataanggota as $ang) : ?>
            <option value="<?= $ang['noanggota'] ?>"><?= $ang['noanggota'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Jumlah Simpanan</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="jumlahsimpanan" name="jumlahsimpanan">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Sisa Pinjaman</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="sisapinjaman" name="sisapinjaman">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label"></label>
    <div class="col-sm-4">
        <input type="submit" value="Simpan" class="btn btn-success">
    </div>
</div>
<?= form_close(); ?>
<?= $this->endSection('isi'); ?>
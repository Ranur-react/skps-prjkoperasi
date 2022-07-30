<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Edit Anggota Keluar
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/anggotakeluar/index')">
    <i class="fa fa-backward"></i> Kembali
</button>

<?= $this->endsection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open_multipart('anggotakeluar/updatedata') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Kode Keluar</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="kodekel" name="kodekel" readonly value="<?= $kodekel; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Tgl Keluar</label>
    <div class="col-sm-4">
        <input type="date" class="form-control" id="tglkeluar" name="tglkeluar" value="<?= $tglkeluar; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Tgl Masuk</label>
    <div class="col-sm-4">
        <input type="date" class="form-control" id="tglmasuk" name="tglmasuk" value="<?= $tglmasuk; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Pilih Anggota</label>
    <div class="col-sm-4">
        <select name="anggota" id="anggota" class="form-control">
            <?php foreach ($dataanggota as $ang) : ?>

            <?php if ($ang['noanggota'] == $dataanggota) : ?>

            <option selected value="<?= $ang['noanggota'] ?>"><?= $ang['namaanggota'] ?></option>
            <?php else : ?>
            <option value="<?= $ang['noanggota'] ?>"><?= $ang['namaanggota'] ?></option>
            <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>
</div>


<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Jumlah Simpanan</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="jumlahsimpanan" name="jumlahsimpanan"
            value="<?= $jumlahsimpanan; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Sisa Pinjaman</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="sisapinjaman" name="sisapinjaman" value="<?= $sisapinjaman; ?>">
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
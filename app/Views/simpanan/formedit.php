<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Edit Simpanan
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/simpanan/index')">
    <i class="fa fa-backward"></i> Kembali
</button>

<?= $this->endsection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open_multipart('simpanan/updatedata') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<div class="form-group row">
    <label for="" class="col-sm-4 form-label">No Simpanan</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="nosimpanan" name="nosimpanan" readonly value="<?= $nosimpanan; ?>">
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

<!-- <div class="form-group row">
    <label for="" class="col-sm-4 form-label">Jenis</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="jenis" name="jenis" value="<?= $jenis; ?>">
    </div>
</div> -->
<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Jenis</label>
    <div class="col-sm-4">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jenis" id="inlineRadio1" value="Pokok" />
            <label class="form-check-label" for="inlineRadio1">Pokok</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jenis" id="inlineRadio2" value="Wajib" />
            <label class="form-check-label" for="inlineRadio2">Wajib</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jenis" id="inlineRadio3" value="Lainnya" />
            <label class="form-check-label" for="inlineRadio3">Lainnya</label>
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Jumlah</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="jml" name="jml" value="<?= $jml; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Keterangan</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="ket" name="ket" value="<?= $ket; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Tgl Simpan</label>
    <div class="col-sm-4">
        <input type="date" class="form-control" id="tglsimpan" name="tglsimpan" value="<?= $tglsimpan; ?>">
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
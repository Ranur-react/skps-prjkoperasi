<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Edit Pinjaman
<?= $this->endsection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/pinjaman/index')">
    <i class="fa fa-backward"></i> Kembali
</button>

<?= $this->endsection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open_multipart('pinjaman/updatedata') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Kode Pinjaman</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="nopinjam" name="nopinjam" readonly value="<?= $nopinjam; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Tgl Pinjam</label>
    <div class="col-sm-4">
        <input type="date" class="form-control" id="tglpinjam" name="tglpinjam" value="<?= $tglpinjam; ?>">
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
    <label for="" class="col-sm-4 form-label">Jml Pinjam</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="jmlpinjam" name="jmlpinjam" value="<?= $jmlpinjam; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Lama Pinjam</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="lamapinjam" name="lamapinjam" value="<?= $lamapinjam; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Angsuran</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="angsuran" name="angsuran" value="<?= $angsuran; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Jasa</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="jasa" name="jasa" value="<?= $jasa; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Askes</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="askes" name="askes" value="<?= $askes; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Respin</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="respin" name="respin" value="<?= $respin; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">SW</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="sw" name="sw" value="<?= $sw; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">SL</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="sl" name="sl" value="<?= $sl; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Hutang</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="hutang" name="hutang" value="<?= $hutang; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Jumlah Potongan</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="jumlahpotongan" name="jumlahpotongan"
            value="<?= $jumlahpotongan; ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 form-label">Pinjaman Bersih</label>
    <div class="col-sm-4">
        <input type="number" class="form-control" id="pinjamanbersih" name="pinjamanbersih"
            value="<?= $pinjamanbersih; ?>">
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
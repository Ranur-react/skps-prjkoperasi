<div class="modal fade" id="modaltambahjabatan" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form input jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('jabatan/simpan', ['class'=>'formsimpan'])?>
                <div class="form-group">
                    <label for="">Input Nama Jabatan</label>
                    <input type="text" name="namajabatan" id="namajabatan" class="form-control">
                    <div class="invalid-feedback errorNamajabatan">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Gaji Pokok</label>
                    <input type="number" name="gajijabatan" id="gajijabatan" class="form-control">
                    <div class="invalid-feedback errorgajijabatan">
                    </div>
                </div>

                <div class="form-group">
                    <label for=""></label>
                    <button type="submit" class="btn btn-block btn-success" id="tombolsimpan">
                        Simpan
                    </button>
                </div>
                <?=
                form_close();
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.formsimpan').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#tombolsimpan').prop('disabled', true);
                $('#tombolsimpan').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function() {
                $('#tombolsimpan').prop('disabled', false);
                $('#tombolsimpan').html('Simpan')
            },
            success: function(response) {
                if (response.error) {
                    let err = response.error;

                    if (err.errNamaJabatan) {
                        $('#namajabatan').addClass('is-invalid');
                        $('.errorNamajabatan').html(err.errNamaJabatan);
                    }

                    if (err.errTelp) {
                        $('#gajijabatan').addClass('is-invalid');
                        $('.errorGajiJabatan').html(err.errGajiJabatan);
                    }
                }

                if (response.sukses) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: response.sukses,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Ambil!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#namajabatan').val(response.namajabatan);
                            $('#idjabatan').val(response.idjabatan);
                            $('#modaltambahjabatan').modal('hide');
                        } else {
                            $('#modaltambahjabatan').modal('hide');
                        }
                    })
                }
            },

            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
        return false;
    });
});
</script>
function hapuslaporan(params) {
    if (params) {
        $.ajax({
            url:'/JFPP/LaporanPenilaian/'+params+'/edit',
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#hapuslaporancontent').empty()
                $('#hapuslaporancontent').append(`
                    <h5>Anda Yakin Ingin Menghapus laporan Nomor `+result.nomor+`</h5>
                    <form action="/JFPP/LaporanPenilaian/`+result.id+`" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="`+$(`meta[name="csrf-token"]`).attr(`content`)+`"></input>
                        <input type="hidden" name="_method" value="DELETE">
                        <div class="row mt-2">
                            <button class="btn btn-primary" type="submit">Hapus</button>
                        </div>
                    </form>
                `)
                var hapus = new bootstrap.Modal(document.getElementById('hapuslaporan'), {
                    keyboard: false
                })
                hapus.show()
            }
        })
    }
}

function updatelaporan(params) {
    if (params) {
        $.ajax({
            url:'/JFPP/LaporanPenilaian/'+params+'/edit',
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#updatelaporanform').attr("action", "/JFPP/LaporanPenilaian/"+result.id);
                $('#editLaporanHeader').empty()
                $('#baslUpdate').empty()
                $('#editLaporanHeader').append(`
                    <h5 class="modal-title" id="staticBackdropLabel">`+result.nomor+`/`+result.kode+`</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                `)

                $('#updatelaporancontent').empty()
                $('#updatelaporancontent').append(`
                        <div id="baslUpdate">
                        
                        
                        </div>
                        <input type="hidden" name="_token" value="`+$(`meta[name="csrf-token"]`).attr(`content`)+`"></input>
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Nomor Laporan" required value="`+result.nomor+`">
                            <label for="nomor">Nomor Laporan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode Laporan" required value="`+result.kode+`">
                            <label for="kode">Kode Laporan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="pemohon" name="pemohon" placeholder="Pemohon" required value="`+result.pemohon+`">
                            <label for="pemohon">Pemohon</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal Laporan" required value="`+result.tanggal+`">
                            <label for="tanggal">Tanggal Laporan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="nilaiWajar" name="nilaiWajar" placeholder="Nilai Wajar" required value="`+result.nilaiWajar+`">
                            <label for="nilaiWajar">Nilai Wajar</label>
                        </div>
                        <input type="file" class="form-control" name="fileUpload">
                `)

                result.basl.forEach(element => {
                    $('#baslUpdate').append(`<div id="basl-`+element.id+`" class="input-group flex-nowrap">
                    <button onclick="hapusBASL('`+element.id+`','`+result.id+`')" type="button" style="background: red; color:white" class="input-group-text" id="addon-wrapping">X</button>
                    <input disabled type="text" class="form-control" value="`+element.nomor+element.kode+element.tahun+`">
                    </div>`)
                });

                var update = new bootstrap.Modal(document.getElementById('updateLaporan'), {
                    keyboard: false
                })
                update.show()
            }
        })
    }
}

function hapusBASL(baslid, laporanid) {
    $.ajax({
        url:'/hapusbaslJFPP/'+laporanid,
        type:'POST',
        dataType:'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {basl_id:baslid, _method:'PATCH'},
        success: function (response) {
            $('#basl-'+baslid).remove()
        }
    })
}

function preview(params) {
    if (params) {
        $.ajax({
            url:'/JFPP/LaporanPenilaian/'+params+`/edit`,
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#previewFrame').empty()
                $('#previewHeader').empty()
                $('#previewHeader').append(
                    `<h5 class="modal-title" id="staticBackdropLabel">`+result.nomor+`/`+result.kode+`/`+result.tahun+`</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>`
                )
                $('#previewFrame').append(`<iframe src="`+window.location.protocol + '//' + location.host+`/storage/`+result.file+`" frameBorder="0" scrolling="auto" height="100%" width="100%"></iframe>`)
                var preview = new bootstrap.Modal(document.getElementById('preview'), {
                    keyboard: false
                })
                preview.show()
            }
        })
    }
}
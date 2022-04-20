function preview(params) {
    if (params) {
        $.ajax({
            url:'/digital-knowledge-management/laporan-pelaksanaan-tugas/'+params,
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#previewFrame').empty()
                $('#previewHeader').empty()
                $('#previewHeader').append(
                    `<h5 class="modal-title" id="staticBackdropLabel">`+result.hal+`</h5>
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

function updateLPT(params) {
    if (params) {
        $.ajax({
            url:'/digital-knowledge-management/laporan-pelaksanaan-tugas/'+params+'/edit',
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#editlaporan-pelaksanaan-tugasHeader').empty()
                $('#editlaporan-pelaksanaan-tugasHeader').append(`
                    <h5 class="modal-title" id="staticBackdropLabel">`+result.kodeUnit+`</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                `)
                $('#updatelaporan-pelaksanaan-tugascontent').empty()
                $('#updatelaporan-pelaksanaan-tugascontent').append(`
                    <form action="/digital-knowledge-management/laporan-pelaksanaan-tugas/`+result.id+`" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="`+$(`meta[name="csrf-token"]`).attr(`content`)+`"></input>
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Nomor Laporan Pelaksanaan Tugas" value="`+result.nomor+`" required>
                            <label for="nomor">Nomor Laporan Pelaksanaan Tugas</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="kodeUnit" id="kodeUnit" required placeholder="Kode Unit">
                                <option value="/KNL.1604/">/KNL.1604/</option>
                                <option value="/WKN.16/KNL.04/">/WKN.16/KNL16/</option>
                            </select>
                            <label for="kodeUnit">Kode Unit</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal Laporan Pelaksanaan Tugas" value="`+result.tanggal+`" required>
                            <label for="tanggal">Tanggal Laporan Pelaksanaan Tugas</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="hal" name="hal" placeholder="hal Laporan Pelaksanaan Tugas" value="`+result.hal+`" required>
                            <label for="hal">Hal Laporan Pelaksanaan Tugas</label>
                        </div>
                        <input type="file" class="form-control" name="fileUpload">
                        <div class="row mt-2">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                `)
                var updateLPT = new bootstrap.Modal(document.getElementById('updatelaporan-pelaksanaan-tugas'), {
                    keyboard: false
                })
                updateLPT.show()
            }
        })
    }
}

function hapusLPT(params) {
    if (params) {
        $.ajax({
            url:'/digital-knowledge-management/laporan-pelaksanaan-tugas/'+params+'/edit',
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#hapuslaporan-pelaksanaan-tugascontent').empty()
                $('#hapuslaporan-pelaksanaan-tugascontent').append(`
                    <h5>Anda Yakin Ingin Menghapus Laporan Pelaksanaan Tugas Nomor `+result.kodeUnit+`</h5>
                    <form action="/digital-knowledge-management/laporan-pelaksanaan-tugas/`+result.id+`" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="`+$(`meta[name="csrf-token"]`).attr(`content`)+`"></input>
                        <input type="hidden" name="_method" value="DELETE">
                        <div class="row mt-2">
                            <button class="btn btn-primary" type="submit">Hapus</button>
                        </div>
                    </form>
                `)
                var hapusLPT = new bootstrap.Modal(document.getElementById('hapuslaporan-pelaksanaan-tugas'), {
                    keyboard: false
                })
                hapusLPT.show()
            }
        })
    }
}
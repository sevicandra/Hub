function preview(params) {
    if (params) {
        $.ajax({
            url:'/filestorage/presentasi/'+params,
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#previewFrame').empty()
                $('#previewHeader').empty()
                $('#previewHeader').append(
                    `<h5 class="modal-title" id="staticBackdropLabel">`+result.judul+`</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>`
                )
                $('#previewFrame').append(`<iframe src="`+window.location.protocol + '//' + location.host+`/storage/`+result.file+`" frameBorder="0" scrolling="auto" height="100%" width="100%"></iframe>`)
            }
        })
    }
}

function updatePresentasi(params) {
    if (params) {
        $.ajax({
            url:'/filestorage/presentasi/'+params+'/edit',
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#updatePresentasicontent').empty()
                $('#updatePresentasicontent').append(`
                    <form action="/filestorage/presentasi/`+result.id+`" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="`+$(`meta[name="csrf-token"]`).attr(`content`)+`"></input>
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal Keputusan" value="`+result.tanggal+`" required>
                            <label for="tanggal">Tanggal Presentasi</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="judul Presentasi" value="`+result.judul+`" required>
                            <label for="judul">Judul Presentasi</label>
                        </div>
                        <input type="file" class="form-control" name="fileUpload">
                        <div class="row mt-2">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                `)
            }
        })
    }
}

function hapusPresentasi(params) {
    if (params) {
        $.ajax({
            url:'/filestorage/presentasi/'+params+'/edit',
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#hapusPresentasicontent').empty()
                $('#hapusPresentasicontent').append(`
                    <h5>Anda Yakin Ingin Menghapus presentasi `+result.judul+`</h5>
                    <form action="/filestorage/presentasi/`+result.id+`" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="`+$(`meta[name="csrf-token"]`).attr(`content`)+`"></input>
                        <input type="hidden" name="_method" value="DELETE">
                        <div class="row mt-2">
                            <button class="btn btn-primary" type="submit">Hapus</button>
                        </div>
                    </form>
                `)
            }
        })
    }
}
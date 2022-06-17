function hapusBASL(params) {
    if (params) {
        $.ajax({
            url:'/JFPP/BASL/'+params+'/edit',
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#hapusBASLcontent').empty()
                $('#hapusBASLcontent').append(`
                    <h5>Anda Yakin Ingin Menghapus BASL Nomor `+result.nomor+`</h5>
                    <form action="/JFPP/BASL/`+result.id+`" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="`+$(`meta[name="csrf-token"]`).attr(`content`)+`"></input>
                        <input type="hidden" name="_method" value="DELETE">
                        <div class="row mt-2">
                            <button class="btn btn-primary" type="submit">Hapus</button>
                        </div>
                    </form>
                `)
                var hapus = new bootstrap.Modal(document.getElementById('hapusBASL'), {
                    keyboard: false
                })
                hapus.show()
            }
        })
    }
}

function updateBASL(params) {
    if (params) {
        $.ajax({
            url:'/JFPP/BASL/'+params+'/edit',
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#editBASLHeader').empty()
                $('#editBASLHeader').append(`
                    <h5 class="modal-title" id="staticBackdropLabel">`+result.nomor+result.kode+`</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                `)
                switch (result.kode) {
                    case '/KNL.1604/':
                        kode1='selected'
                        kode2=null
                        break;
                    case '/WKN.16/KNL.04/':
                        kode1=null
                        kode2='selected'
                        break;
                }
                switch (result.tujuanPenilaian) {
                    case 1:
                        tujuan1='selected'
                        tujuan2=null
                        tujuan3=null
                        break;
                    case 2:
                        tujuan1=null
                        tujuan2='selected'
                        tujuan3=null
                        break;
                    case 3:
                        tujuan1=null
                        tujuan2=null
                        tujuan3='selected'
                        break;
                }

                $('#updateBASLcontent').empty()
                $('#updateBASLcontent').append(`
                    <form action="/JFPP/BASL/`+result.id+`" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="`+$(`meta[name="csrf-token"]`).attr(`content`)+`"></input>
                        <input type="hidden" name="_method" value="PATCH">
                      
                        <div id="anggotaUpdate">
                            
                        </div>
                        <div class="form-floating mb-3"> 
                            <button onclick="tambahTimUpdate()" class="btn btn-success" type="button"><i class="bi bi-plus-square"></i></button>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Nomor Keputusan" required value="`+result.nomor+`">
                            <label for="nomor">Nomor</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="pemilik" name="pemilik" placeholder="Pemilik Barang" required value="`+result.pemilik+`">
                            <label for="pemilik">Pemilik Barang</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="kode" id="kode" required placeholder="Kode Unit">
                                <option value="/KNL.1604/" `+kode1+`>/KNL.1604/</option>
                                <option value="/WKN.16/KNL.04/" `+kode2+`>/WKN.16/KNL.04/</option>
                            </select>
                            <label for="kode">Kode Unit</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="tujuanPenilaian" id="tujuanPenilaian" required placeholder="Tujuan Penilaian">
                                <option value="1" `+tujuan1+`>Pemindahtanganan</option>
                                <option value="2" `+tujuan2+`>Pemanfaatan</option>
                                <option value="3" `+tujuan3+`>LKPP</option>
                            </select>
                            <label for="Tujuan Penilaian">Tujuan Penilaian</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="objek" name="objek" placeholder="objek Penilaian" required value="`+result.objek+`">
                            <label for="objek">objek Penilaian</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="tanggalMulaiSurvei" name="tanggalMulaiSurvei" placeholder="Tanggal Mulai Survei" required value="`+result.tanggalMulaiSurvei+`">
                            <label for="tanggalMulaiSurvei">Tanggal Mulai Survei</label>

                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="tanggalSelesaiSurvei" name="tanggalSelesaiSurvei" placeholder="Tanggal Selesai Survei" required value="`+result.tanggalSelesaiSurvei+`">
                            <label for="tanggalSelesaiSurvei">Tanggal Selesai Survei</label>
                        </div>
                        <div class="row mt-2">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                `)
                result.user.forEach(element => {
                    $('#anggotaUpdate').append(`<div id="anggota-`+element.id+`" class="input-group flex-nowrap">
                    <button onclick="hapusAnggota('`+element.id+`','`+result.id+`')" type="button" style="background: red; color:white" class="input-group-text" id="addon-wrapping">X</button>
                    <input disabled type="text" class="form-control" value="`+element.nama+`">
                    </div>`)
                });
                var update = new bootstrap.Modal(document.getElementById('updateBASL'), {
                    keyboard: false
                })
                update.show()
            }
        })
    }
}

function tambahTim() {
    x=2
    $.ajax({
        type:'GET',
        url: '/listTim',
        dataType: "json",
        success: function(response){
            tim=''
            $.each(response, function(res, req) {
                tim=tim+'<option value="'+req.id+'">'+req.nama+'</option>';
            });
            $('#anggota').append(
                `<div class="input-group mb-3" id="anggota`+x+`">
                <button onclick="hapusTim('`+x+`')" type="button" class="input-group-text" style="background: red; color:white">X</button type="button">
                <div class="form-floating col" >
                    <select class="form-select" name="anggotaTim[]" id="anggotaTim`+x+`" required placeholder="Anggota Tim">
                        <option disabled selected></option>
                        `+tim+`
                    </select>
                    <label for="anggotaTim`+x+`">Anggota Tim</label>
                </div>
              </div>`
            );
            x++;
        }
    })
}

function hapusTim(params) {
    $('#anggota'+params).remove()
}

function tambahTimUpdate() {
    x=2
    $.ajax({
        type:'GET',
        url: '/listTim',
        dataType: "json",
        success: function(response){
            tim=''
            $.each(response, function(res, req) {
                tim=tim+'<option value="'+req.id+'">'+req.nama+'</option>';
            });
            $('#anggotaUpdate').append(
                `<div class="input-group mb-3" id="anggota`+x+`">
                <button onclick="hapusTim('`+x+`')" type="button" class="input-group-text" style="background: red; color:white">X</button type="button">
                <div class="form-floating col" >
                    <select class="form-select" name="anggotaTim[]" id="anggotaTim`+x+`" required placeholder="Anggota Tim">
                        <option disabled selected></option>
                        `+tim+`
                    </select>
                    <label for="anggotaTim`+x+`">Anggota Tim</label>
                </div>
              </div>`
            );
            x++;
        }
    })
}

function hapusTimUpdate(params) {
    $('#anggotaUpdate'+params).remove()
}

function hapusAnggota(userid, baslid) {
    $.ajax({
        url:'/hapusanggotaJFPP/'+baslid,
        type:'POST',
        dataType:'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {user_id:userid, _method:'PATCH'},
        success: function (response) {
            $('#anggota-'+userid).remove()
        }
    })
}

function cetakBASL(params) {
    $('#cetak_id').attr('value', params)
    var update = new bootstrap.Modal(document.getElementById('cetakBASL'), {
        keyboard: false
    })
    update.show()
}
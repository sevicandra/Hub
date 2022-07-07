$('.deleteButton').click(function(){
    console.log('test');
    if(!confirm("Yakin!!!")) {
        return false;
    }
    this.form.submit();
})


function preview(params) {
    if (params) {
        $.ajax({
            url:'/status-penggunaan/'+params,
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#previewFrame').empty()
                $('#previewHeader').empty()
                $('#previewHeader').append(
                    `
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
var form = new bootstrap.Modal(document.getElementById('formSurvei'), {
    keyboard: false
});
var tombol = new bootstrap.Modal(document.getElementById('tombolSurvei'), {
    keyboard: false
});
tombol.show()
function survei(){
    tombol.hide()
    form.show();
}
function tutupSurvei() {
    form.hide()
    tombol.show()
}
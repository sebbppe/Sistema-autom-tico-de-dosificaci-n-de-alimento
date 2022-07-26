var toastTrigger = document.getElementById('Verificar')
var toastLiveExample = document.getElementById('MensajeDeVerificacion')
if (toastTrigger) {
    toastTrigger.addEventListener('click', function() {
        var toast = new bootstrap.Toast(toastLiveExample)
        toast.show()
    })
}
$(document).ready(function () {
    $("#btn-register-confirm").on('click', function () {
        $("#btn-register-confirm").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        document.getElementById("btn-register-confirm").disabled = true;
        $('#form-data-step2').submit();
    });
});

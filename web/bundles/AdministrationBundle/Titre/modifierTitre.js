function validateDecimal(value) {
    var RE = /^\d*(\.\d{1})?\d{0,1}$/;
    if (RE.test(value)) {
        return true;
    } else {
        return false;
    }
}

$('body').undelegate('input#procash_administrationbundle_titre_quantiteMinimum', 'change').delegate('input#procash_administrationbundle_titre_quantiteMinimum', 'change', function () {
    var obj = $('input#procash_administrationbundle_titre_quantiteMinimum').val();

    if (!validateDecimal(obj)) {
        $('#quantMin').addClass('has-error has-feedback');
        $('#imgAbo').removeClass('hidden');
        $(".afficherErreurMontant").removeClass("hide");
    } else {
        $('#quantMin').removeClass('has-error has-feedback');
        $('#imgAbo').addClass('hidden');
        $(".afficherErreurMontant").addClass("hide");
    }
});
$('body').undelegate('input#procash_administrationbundle_titre_quantiteMinimum', 'keyup').delegate('input#procash_administrationbundle_titre_quantiteMinimum', 'keyup', function () {

    var obj = $('input#procash_administrationbundle_titre_quantiteMinimum').val();
    if (!validateDecimal(obj)) {
        $('#quantMin').addClass('has-error has-feedback');
        $('#imgAbo').removeClass('hidden');
        $(".afficherErreurMontant").removeClass("hide");
    } else {
        $('#quantMin').removeClass('has-error has-feedback');
        $('#imgAbo').addClass('hidden');
        $(".afficherErreurMontant").addClass("hide");
    }
});
$('body').undelegate('input#procash_administrationbundle_titre_quantiteMinimum', 'blur').delegate('input#procash_administrationbundle_titre_quantiteMinimum', 'blur', function () {

    var obj = $('input#procash_administrationbundle_titre_quantiteMinimum').val();
    if (!validateDecimal(obj)) {
        console.log('aaa');
        $('#quantMin').addClass('has-error has-feedback');
        $('#imgAbo').removeClass('hidden');
        $(".afficherErreurMontant").removeClass("hide");
    } else {
        console.log('bbb');
        $('#quantMin').removeClass('has-error has-feedback');
        $('#imgAbo').addClass('hidden');
        $(".afficherErreurMontant").addClass("hide");
    }

});
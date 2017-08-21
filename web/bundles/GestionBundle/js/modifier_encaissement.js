function validateDecimal(value) {
    var RE = /^\d*(\.\d{1})?\d{0,1}$/;
    if (RE.test(value)) {
        return true;
    } else {
        return false;
    }
}

$('body').undelegate('input#procash_gestionbundle_detailencaissement_montantFacture', 'change').delegate('input#procash_gestionbundle_detailencaissement_montantFacture', 'change', function () {
    var obj = $('input#procash_gestionbundle_detailencaissement_montantFacture').val();

    if (!validateDecimal(obj)) {
        $('#montantFacture').addClass('has-error has-feedback');
        $('#imgFact').removeClass('hidden');
        $(".afficherErreurMontantFacture").removeClass("hide");
    } else {
        $('#montantFacture').removeClass('has-error has-feedback');
        $('#imgFact').addClass('hidden');
        $(".afficherErreurMontantFacture").addClass("hide");
    }
});
$('body').undelegate('input#procash_gestionbundle_detailencaissement_montantFacture', 'keyup').delegate('input#procash_gestionbundle_detailencaissement_montantFacture', 'keyup', function () {

    var obj = $('input#procash_gestionbundle_detailencaissement_montantFacture').val();
    if (!validateDecimal(obj)) {
        $('#montantFacture').addClass('has-error has-feedback');
        $('#imgFact').removeClass('hidden');
        $(".afficherErreurMontantFacture").removeClass("hide");
    } else {
        $('#montantFacture').removeClass('has-error has-feedback');
        $('#imgFact').addClass('hidden');
        $(".afficherErreurMontantFacture").addClass("hide");
    }
});
$('body').undelegate('input#procash_gestionbundle_detailencaissement_montantFacture', 'blur').delegate('input#procash_gestionbundle_detailencaissement_montantFacture', 'blur', function () {

    var obj = $('input#procash_gestionbundle_detailencaissement_montantFacture').val();
    if (!validateDecimal(obj)) {
        $('#montantFacture').addClass('has-error has-feedback');
        $('#imgFact').removeClass('hidden');
        $(".afficherErreurMontantFacture").removeClass("hide");
    } else {
        $('#montantFacture').removeClass('has-error has-feedback');
        $('#imgFact').addClass('hidden');
        $(".afficherErreurMontantFacture").addClass("hide");
    }

});


$('body').undelegate('input#procash_gestionbundle_detailencaissement_montantDu', 'change').delegate('input#procash_gestionbundle_detailencaissement_montantDu', 'change', function () {
    var obj = $('input#procash_gestionbundle_detailencaissement_montantDu').val();

    if (!validateDecimal(obj)) {
        $('#montantDu').addClass('has-error has-feedback');
        $('#imgDu').removeClass('hidden');
        $(".afficherErreurMontantDu").removeClass("hide");
    } else {
        $('#montantDu').removeClass('has-error has-feedback');
        $('#imgDu').addClass('hidden');
        $(".afficherErreurMontantDu").addClass("hide");
    }
});
$('body').undelegate('input#procash_gestionbundle_detailencaissement_montantDu', 'keyup').delegate('input#procash_gestionbundle_detailencaissement_montantDu', 'keyup', function () {

    var obj = $('input#procash_gestionbundle_detailencaissement_montantDu').val();
     if (!validateDecimal(obj)) {
        $('#montantDu').addClass('has-error has-feedback');
        $('#imgDu').removeClass('hidden');
        $(".afficherErreurMontantDu").removeClass("hide");
    } else {
        $('#montantDu').removeClass('has-error has-feedback');
        $('#imgDu').addClass('hidden');
        $(".afficherErreurMontantDu").addClass("hide");
    }
});
$('body').undelegate('input#procash_gestionbundle_detailencaissement_montantDu', 'blur').delegate('input#procash_gestionbundle_detailencaissement_montantDu', 'blur', function () {

    var obj = $('input#procash_gestionbundle_detailencaissement_montantDu').val();
    if (!validateDecimal(obj)) {
        $('#montantDu').addClass('has-error has-feedback');
        $('#imgDu').removeClass('hidden');
        $(".afficherErreurMontantDu").removeClass("hide");
    } else {
        $('#montantDu').removeClass('has-error has-feedback');
        $('#imgDu').addClass('hidden');
        $(".afficherErreurMontantDu").addClass("hide");
    }

});


$('body').undelegate('input#procash_gestionbundle_detailencaissement_montantPaye', 'change').delegate('input#procash_gestionbundle_detailencaissement_montantPaye', 'change', function () {
    var obj = $('input#procash_gestionbundle_detailencaissement_montantPaye').val();

    if (!validateDecimal(obj)) {
        $('#montantPaye').addClass('has-error has-feedback');
        $('#imgPaye').removeClass('hidden');
        $(".afficherErreurMontantPaye").removeClass("hide");
    } else {
        $('#montantPaye').removeClass('has-error has-feedback');
        $('#imgPaye').addClass('hidden');
        $(".afficherErreurMontantPaye").addClass("hide");
    }
});
$('body').undelegate('input#procash_gestionbundle_detailencaissement_montantPaye', 'keyup').delegate('input#procash_gestionbundle_detailencaissement_montantPaye', 'keyup', function () {

    var obj = $('input#procash_gestionbundle_detailencaissement_montantPaye').val();
       if (!validateDecimal(obj)) {
        $('#montantPaye').addClass('has-error has-feedback');
        $('#imgPaye').removeClass('hidden');
        $(".afficherErreurMontantPaye").removeClass("hide");
    } else {
        $('#montantPaye').removeClass('has-error has-feedback');
        $('#imgPaye').addClass('hidden');
        $(".afficherErreurMontantPaye").addClass("hide");
    }
});
$('body').undelegate('input#procash_gestionbundle_detailencaissement_montantPaye', 'blur').delegate('input#procash_gestionbundle_detailencaissement_montantPaye', 'blur', function () {

    var obj = $('input#procash_gestionbundle_detailencaissement_montantPaye').val();
       if (!validateDecimal(obj)) {
        $('#montantPaye').addClass('has-error has-feedback');
        $('#imgPaye').removeClass('hidden');
        $(".afficherErreurMontantPaye").removeClass("hide");
    } else {
        $('#montantPaye').removeClass('has-error has-feedback');
        $('#imgPaye').addClass('hidden');
        $(".afficherErreurMontantPaye").addClass("hide");
    }

});

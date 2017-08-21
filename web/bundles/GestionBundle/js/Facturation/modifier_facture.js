function validateDecimal(value) {
    var RE = /^\d*(\.\d{1})?\d{0,1}$/;
    if (RE.test(value)) {
        return true;
    } else {
        return false;
    }
}

if ($('#modePaiement').val() != '') {
    var modePaiement = $('#modePaiement').val();
    var arr = modePaiement.split('__');
    $('.boutonValider').attr("disabled", false);
    if (arr[1] == 'TRE') {
        $('#contenuModePaiementTraite').removeClass("hidden");
        $('#contenuModePaiementEspece').addClass("hidden");
        $('#contenuModePaiementCheque').addClass("hidden");
        $('.boutonValider').removeClass("hidden");
        $('.boutonValider').attr("disabled", false);
        testTraite();
    } else if (arr[1] == 'ESP') {
        $('#contenuModePaiementEspece').removeClass("hidden");
        $('#contenuModePaiementCheque').addClass("hidden");
        $('#contenuModePaiementTraite').addClass("hidden");
        $('.boutonValider').removeClass("hidden");
        $('.boutonValider').attr("disabled", false);
        testValidEspece();
    } else if (arr[1] == 'CHQ') {
        $('#contenuModePaiementCheque').removeClass("hidden");
        $('#contenuModePaiementTraite').addClass("hidden");
        $('#contenuModePaiementEspece').addClass("hidden");
        $('.boutonValider').removeClass("hidden");
        $('.boutonValider').attr("disabled", false);
        testValidCheque();
    }
}

$('body').undelegate('#modePaiement', 'change').delegate('#modePaiement', 'change', function () {
    var modePaiement = $('#modePaiement').val();
    var arr = modePaiement.split('__');
    $('.boutonValider').attr("disabled", false);
    if (arr[1] == 'TRE') {
        $('#contenuModePaiementTraite').removeClass("hidden");
        $('#contenuModePaiementEspece').addClass("hidden");
        $('#contenuModePaiementCheque').addClass("hidden");
        $('.boutonValider').removeClass("hidden");
        $('.boutonValider').attr("disabled", false);
        testTraite();
    } else if (arr[1] == 'ESP') {
        $('#contenuModePaiementEspece').removeClass("hidden");
        $('#contenuModePaiementCheque').addClass("hidden");
        $('#contenuModePaiementTraite').addClass("hidden");
        $('.boutonValider').removeClass("hidden");
        $('.boutonValider').attr("disabled", false);
        testValidEspece();
    } else if (arr[1] == 'CHQ') {
        $('#contenuModePaiementCheque').removeClass("hidden");
        $('#contenuModePaiementTraite').addClass("hidden");
        $('#contenuModePaiementEspece').addClass("hidden");
        $('.boutonValider').removeClass("hidden");
        $('.boutonValider').attr("disabled", false);
        testValidCheque();
    }
}
);

function testValidCheque() {
    var resultTest = "";
    var obj = $('input#montantCheque').val();
    if (!validateDecimal(obj)) {
        $('#montantC').addClass('has-error has-feedback');
        $('#imgCheque').removeClass('hidden');
        $(".afficherErreurMontantCheque").removeClass("hide");
        resultTest = false;
    } else {
        $('#montantC').removeClass('has-error has-feedback');
        $('#imgCheque').addClass('hidden');
        $(".afficherErreurMontantCheque").addClass("hide");
        resultTest = true;
    }
    if (resultTest) {
        if (obj > montantFacture) {
            $('#montantC').addClass('has-error has-feedback');
            $('#imgCheque').removeClass('hidden');
            $(".afficherErreurMontantEncaisseSup").removeClass("hide");
            resultTest = false;
        } else {
            $('#montantC').removeClass('has-error has-feedback');
            $('#imgCheque').addClass('hidden');
            $(".afficherErreurMontantEncaisseSup").addClass("hide");
            resultTest = true;
        }
    }

    if ($("#montantCheque").val() == "" || $("#numRecuCheque").val() == "" || $("#banque").val() == "" || $("#echeance").val() == "" || $("#numeroCheque").val() == "") {
        $(".boutonValider").attr("disabled", true);
    } else {
        if (resultTest) {
            $(".boutonValider").removeAttr("disabled");
        } else {
            $(".boutonValider").attr("disabled", true);
        }
    }
}

function testValidEspece() {
    var resultTest = "";

    var obj = $('input#montantEspece').val();
    if (!validateDecimal(obj)) {
        $('#montantE').addClass('has-error has-feedback');
        $('#imgEspece').removeClass('hidden');
        $(".afficherErreurMontantEspece").removeClass("hide");
        resultTest = false;
    } else {
        $('#montantE').removeClass('has-error has-feedback');
        $('#imgEspece').addClass('hidden');
        $(".afficherErreurMontantEspece").addClass("hide");
        resultTest = true;
    }
    if (resultTest) {
        if (obj > montantFacture) {
            $('#montantE').addClass('has-error has-feedback');
            $('#imgEspece').removeClass('hidden');
            $(".afficherErreurMontantEncaisseSup").removeClass("hide");
            resultTest = false;
        } else {
            $('#montantE').removeClass('has-error has-feedback');
            $('#imgEspece').addClass('hidden');
            $(".afficherErreurMontantEncaisseSup").addClass("hide");
            resultTest = true;
        }
    }

    if ($("#montantEspece").val() == "" || $("#numRecu").val() == "") {
        $(".boutonValider").attr("disabled", true);
    } else {
        if (resultTest) {
            $(".boutonValider").removeAttr("disabled");
        } else {
            $(".boutonValider").attr("disabled", true);
        }
    }

}

function testTraite() {
    var resultTest = "";

    var obj = $('input#montantTraite').val();
    if (!validateDecimal(obj)) {
        $('#montantT').addClass('has-error has-feedback');
        $('#imgTraite').removeClass('hidden');
        $(".afficherErreurMontantTraite").removeClass("hide");
        resultTest = false;
    } else {
        $('#montantT').removeClass('has-error has-feedback');
        $('#imgTraite').addClass('hidden');
        $(".afficherErreurMontantTraite").addClass("hide");
        resultTest = true;
    }
    //Ajouter erreur si saisi montant > montant facture
    if (resultTest) {
        if (obj > montantFacture) {
            $('#montantT').addClass('has-error has-feedback');
            $('#imgTraite').removeClass('hidden');
            $(".afficherErreurMontantEncaisseSup").removeClass("hide");
            $(".boutonValider").attr("disabled", true);
        } else {
            $('#montantT').removeClass('has-error has-feedback');
            $('#imgTraite').addClass('hidden');
            $(".afficherErreurMontantEncaisseSup").addClass("hide");
            $(".boutonValider").removeAttr("disabled");
        }
    }

    if ($("#montantTraite").val() == "") {
        $(".boutonValider").attr("disabled", true);
    } else {
        if (resultTest) {
            $(".boutonValider").removeAttr("disabled");
        } else {
            $(".boutonValider").attr("disabled", true);
        }
    }
}

//Espece
$("#montantEspece").on("keyup", function () {
    testValidEspece();
});
$("#numRecu").on("keyup", function () {
    testValidEspece();
});

//Traite
$("#montantTraite").on("keyup", function () {
    testTraite();
});

//Chèque
$("#montantCheque").on("keyup", function () {
    testValidCheque();
});
$("#numRecuCheque").on("keyup", function () {
    testValidCheque();
});
$("#banque").on("keyup", function () {
    testValidCheque();
});
$("#echeance").on("keyup", function () {
    testValidCheque();
});
$("#numeroCheque").on("keyup", function () {
    testValidCheque();
});
$("#banque").on("change", function () {
    testValidCheque();
});


date = document.getElementById("echeance");
var myCalendarEcheance = new dhtmlXCalendarObject([date]);
myCalendarEcheance.setDateFormat("%d/%m/%Y"); //Date format MM/DD/YYY
myCalendarEcheance.setSkin("dhx_terrace");
myCalendarEcheance.loadUserLanguage("fr");
dateNow = new Date();
myCalendarEcheance.setSensitiveRange(dateNow, null);
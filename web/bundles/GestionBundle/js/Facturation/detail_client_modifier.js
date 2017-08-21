//if ($("#ongletLi").hasClass("active")) {
var table = $('table#tableQuotidien').DataTable({
    "language": {
        processing: "Traitement en cours...",
        search: "Rechercher&nbsp;:",
        lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
        info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix: "",
        loadingRecords: "Chargement en cours...",
        zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable: "Aucune donnée disponible dans le tableau",
        paginate: {
            first: "Premier",
            previous: "Pr&eacute;c&eacute;dent",
            next: "Suivant",
            last: "Dernier"
        },
        aria: {
            sortAscending: ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    },
    "iDisplayLength": 5,
    "columnDefs": [
        {'bSortable': false, 'aTargets': [5]}
    ]
});

var table = $('table#tableVisu').DataTable({
    "language": {
        processing: "Traitement en cours...",
        search: "Rechercher&nbsp;:",
        lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
        info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix: "",
        loadingRecords: "Chargement en cours...",
        zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable: "Aucune donnée disponible dans le tableau",
        paginate: {
            first: "Premier",
            previous: "Pr&eacute;c&eacute;dent",
            next: "Suivant",
            last: "Dernier"
        },
        aria: {
            sortAscending: ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    },
    "iDisplayLength": 5,
    "columnDefs": [
        {'bSortable': false, 'aTargets': [5]}
    ]
});

setInterval(function () {
    $('.modal-backdrop:not(:last)').remove();
}, 5);

function validateDecimal(value) {
    var RE = /^\d*(\.\d{1})?\d{0,1}$/;
    if (RE.test(value)) {
        return true;
    } else {
        return false;
    }
}
$(document).ready(function () {
    $('#modifMontant').modal('hide');
    $('#tableQuotidien_length').hide();
    $('#tableVisu_length').hide();
    $('#example_info').hide();
    $('#tableQuotidien_info').hide();
    $('#tableVisu_info').hide();
    $('#example_length').hide();
    $('#contenuModePaiementTraite').addClass("hidden");
    $('#contenuModePaiementEspece').addClass("hidden");
    $('#contenuModePaiementCheque').addClass("hidden");
    $('.boutonValider').addClass("hidden");
});

function validerMontant(obj) {
    addCache();
    var tabDataUpdate = [];
    var inputs = obj.parent("td").parent("tr").find("input");
    $.map(inputs, function (value) {
        tabDataUpdate.push(value.value);
    });
    console.log(tabDataUpdate);
    $.ajax({
        type: "POST",
        url: urlEncaissement,
        data: {montant: tabDataUpdate[0], montant_du: tabDataUpdate[1], montant_paye: tabDataUpdate[2], id: tabDataUpdate[3]},
        success: function (data) {
            removeCache();
            $('#modifMontant').modal('show');
        },
        error: function () {
            removeCache();
        }
    });
}

function verifierSaisieNombre(obj) {
    var valeur = obj.val();
    if (!(/^[0-9]{1,7}$|^[0-9]{1,7}[\.|,][0-9]{2}?$/.test(obj.val()))) {
        editChamp(valeur, obj);
    }
}
function verifierSaisieNombreDecimalEncaissement(obj) {
    var valeur = obj.val();
    if (!(/^\d*(\.\d{1})?\d{0,1}$/.test(obj.val()))) {
        editChamp(valeur, obj);
    }
}

function verifierSaisieRegulPositifNegatif(obj) {
    var valeur = obj.val();
    if (!(/^(-{1}?(?:([0-9]{0,10}))|([0-9]{1})?(?:([0-9]{0,9})))?(?:\.([0-9]{0,3}))?$/.test(obj.val()))) {
        editChamp(valeur, obj);
    }
}
var editChamp = function (valeur, vis) {
    var res = valeur.slice(0, -1);
    vis.val(res);
};

//Ne pas permettre la saisie des chaines pour les montants dans le tableau 
//nombre vendu
$('body').undelegate('input#nombVendu', 'blur').delegate('input#nombVendu', 'blur', function () {
    verifierSaisieNombre($(this));
});
$('body').undelegate('input#nombVendu', 'change').delegate('input#nombVendu', 'change', function () {
    verifierSaisieNombre($(this));
});
$('body').undelegate('input#nombVendu', 'keyup').delegate('input#nombVendu', 'keyup', function () {
    verifierSaisieNombre($(this));
});
//pour visu
$('body').undelegate('input#nombVendu_visu', 'blur').delegate('input#nombVendu_visu', 'blur', function () {
    verifierSaisieNombre($(this));
});
$('body').undelegate('input#nombVendu_visu', 'change').delegate('input#nombVendu_visu', 'change', function () {
    verifierSaisieNombre($(this));
});
$('body').undelegate('input#nombVendu_visu', 'keyup').delegate('input#nombVendu_visu', 'keyup', function () {
    verifierSaisieNombre($(this));
});

//Saisie des nombres positifs ou negatifs pour regul
$('body').undelegate('input#nombreRegul', 'blur').delegate('input#nombreRegul', 'blur', function () {
    verifierSaisieRegulPositifNegatif($(this));
    calculVendu();
});
$('body').undelegate('input#nombreRegul', 'change').delegate('input#nombreRegul', 'change', function () {
    verifierSaisieRegulPositifNegatif($(this));
    calculVendu();
});
$('body').undelegate('input#nombreRegul', 'keyup').delegate('input#nombreRegul', 'keyup', function () {
    verifierSaisieRegulPositifNegatif($(this));
    calculVendu();
});

//Pour visu
$('body').undelegate('input#nombreRegul_visu', 'blur').delegate('input#nombreRegul_visu', 'blur', function () {
    verifierSaisieRegulPositifNegatif($(this));
    calculVendu_visu();
});
$('body').undelegate('input#nombreRegul_visu', 'change').delegate('input#nombreRegul_visu', 'change', function () {
    verifierSaisieRegulPositifNegatif($(this));
    calculVendu_visu();
});
$('body').undelegate('input#nombreRegul_visu', 'keyup').delegate('input#nombreRegul_visu', 'keyup', function () {
    verifierSaisieRegulPositifNegatif($(this));
    calculVendu_visu();
});

//Calcul nombre titre vendu pour quotidien
var calculVendu = function () {
    var nombreInvenduSaisi = parseFloat($("#nombInvendu").val());
    var regul = parseFloat($('input#nombreRegul').val());
    var commande = parseFloat($('input#nombre_commande_hidden').val());
    if (isNaN(commande) || isNaN(regul) || isNaN(nombreInvenduSaisi)) {
        var vendu = 0;
    }
    else {
        var vendu = commande + regul - nombreInvenduSaisi;
    }
    $('#nombVendu').val(vendu);
};
$('body').undelegate('input#nombInvendu', 'change').delegate('input#nombInvendu', 'change', function () {
    calculVendu();
    verifierInvendu_quotidien();
    verifierSaisieNombre($(this));
});
$('body').undelegate('input#nombInvendu', 'keyup').delegate('input#nombInvendu', 'keyup', function () {
    calculVendu();
    verifierInvendu_quotidien();
    verifierSaisieNombre($(this));
});
$('body').undelegate('input#nombInvendu', 'blur').delegate('input#nombInvendu', 'blur', function () {
    calculVendu();
    verifierInvendu_quotidien();
    verifierSaisieNombre($(this));
});

function validerChiffreVente(obj) {
    $('.pellicule').removeClass('hide');
    var tabDataUpdate = [];
    var inputs = obj.parent("td").parent("tr").find("input");
    var colLogin = obj.find('td:nth-child(7)').html("best");
    $.map(inputs, function (value) {
        tabDataUpdate.push(value.value);
    });
    console.log(tabDataUpdate);
    $.ajax({
        type: "POST",
        url: url,
        data: {commande: tabDataUpdate[0], regul: tabDataUpdate[1], invendu: tabDataUpdate[2], vendu: tabDataUpdate[3], id: tabDataUpdate[4]},
        success: function (data) {
            $('.pellicule').addClass('hide');
            $('#modifCV').modal('show');     
            obj.parent("td").parent("tr").find('td:nth-child(7)').html(userEnCours);
            console.log(obj.prev().val());
            obj.prev().val(data.id);
        },
        error: function () {
            removeCache();
        }
    });
}

//Pour Visu

var calculVendu_visu = function () {
    var nombreInvenduSaisi = parseFloat($("#nombInvendu_visu").val());
    var regul = parseFloat($('input#nombreRegul_visu').val());
    var commande = parseFloat($('input#nombre_commande_hidden_visu').val());


    if (isNaN(commande) || isNaN(regul) || isNaN(nombreInvenduSaisi)) {
        var vendu = 0;
    }
    else {
        var vendu = commande + regul - nombreInvenduSaisi;
    }
    $('#nombVendu_visu').val(vendu);
};

$('body').undelegate('input#nombInvendu_visu', 'change').delegate('input#nombInvendu_visu', 'change', function () {
    calculVendu_visu();
    verifierInvendu_visu();
    verifierSaisieNombre($(this));
});
$('body').undelegate('input#nombInvendu_visu', 'keyup').delegate('input#nombInvendu_visu', 'keyup', function () {
    calculVendu_visu();
    verifierInvendu_visu();
    verifierSaisieNombre($(this));
});
$('body').undelegate('input#nombInvendu_visu', 'blur').delegate('input#nombInvendu_visu', 'blur', function () {
    calculVendu_visu();
    verifierInvendu_visu();
    verifierSaisieNombre($(this));
});


//Règle de gestion: invendu saisi doit etre <= à la commande
var verifierInvendu_quotidien = function () {
    var invendu = parseFloat($("#nombInvendu").val());
    var commande = parseFloat($('input#nombre_commande_hidden').val());

    if (invendu > commande) {
        $("#containerInvendu").addClass("has-error has-feedback");
        $("#imgelogin").removeClass("hide");
        $('#nombVendu').val(0);
        $("#modifierCVGris").removeClass('hide');
        $("#modifierCV").addClass('hide');
    } else {
        $("#containerInvendu").removeClass("has-error has-feedback");
        $("#imgelogin").addClass("hide");
        $("#modifierCVGris").addClass('hide');
        $("#modifierCV").removeClass('hide');
    }
}
var verifierInvendu_visu = function () {
    var invendu = parseFloat($("#nombInvendu_visu").val());
    var commande = parseFloat($('input#nombre_commande_hidden_visu').val());

    if (invendu > commande) {
        $("#containerInvendu_visu").addClass("has-error has-feedback");
        $("#imgelogin_visu").removeClass("hide");
        $(".afficherErreurInvendu_visu").removeClass("hide");
        $('#nombVendu_visu').val(0);
        $("#modifierCVisuGris").removeClass('hide');
        $("#modifierCVisu").addClass('hide');
    } else {
        $("#containerInvendu_visu").removeClass("has-error has-feedback");
        $("#imgelogin_visu").addClass("hide");
        $(".afficherErreurInvendu_visu").addClass("hide");
        $("#modifierCVisuGris").addClass('hide');
        $("#modifierCVisu").removeClass('hide');
    }
}

//Calcul et règle de gestion pour l'encaissement
//Ne pas permettre la saisie des chaines pour les montants dans le tableau 
//Montant facture
$('body').undelegate('#montantFacture', 'blur').delegate('#montantFacture', 'blur', function () {
    verifierSaisieNombreDecimalEncaissement($(this));
});
$('body').undelegate('#montantFacture', 'change').delegate('#montantFacture', 'change', function () {
    verifierSaisieNombreDecimalEncaissement($(this));
});
$('body').undelegate('#montantFacture', 'keyup').delegate('#montantFacture', 'keyup', function () {
    verifierSaisieNombreDecimalEncaissement($(this));
});

//Montant du
$('body').undelegate('#montantDu', 'blur').delegate('#montantDu', 'blur', function () {
    verifierSaisieNombreDecimalEncaissement($(this));
});
$('body').undelegate('#montantDu', 'change').delegate('#montantDu', 'change', function () {
    verifierSaisieNombreDecimalEncaissement($(this));
});
$('body').undelegate('#montantDu', 'keyup').delegate('#montantDu', 'keyup', function () {
    verifierSaisieNombreDecimalEncaissement($(this));
});

//Montant paye
$('body').undelegate('#montantPaye', 'blur').delegate('#montantPaye', 'blur', function () {
    verifierSaisieNombreDecimalEncaissement($(this));
    calculMontantDu();
});
$('body').undelegate('#montantPaye', 'change').delegate('#montantPaye', 'change', function () {
    verifierSaisieNombreDecimalEncaissement($(this));
    calculMontantDu();
});
$('body').undelegate('#montantPaye', 'keyup').delegate('#montantPaye', 'keyup', function () {
    verifierSaisieNombreDecimalEncaissement($(this));
    calculMontantDu();
});

//Calcul montant du = montantFacture - montantEncaisse - montantAvoir
var calculMontantDu = function () {
    var montantFacture = parseFloat($("#montantFacture").val());
    if ($('input#montantPaye').val() == '') {
        var montantEncaisse = 0;
    } else {
        var montantEncaisse = parseFloat($('input#montantPaye').val());
    }
    var montantAvoir = parseFloat($('input#montantAvoir_hidden').val());

    if (isNaN(montantAvoir) || isNaN(montantEncaisse) || isNaN(montantFacture)) {
        var montantDu = 0;
    }
    else {
        var montantDu = montantFacture - montantEncaisse - montantAvoir;
    }
    $('input#montantDu').val(montantDu);
};

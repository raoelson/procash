$(document).ready(function () {
    if ($('input#procash_administrationbundle_profil_libelle').val() == '') {
        $('#info').modal('hide');
        $('#infoModif').modal('hide');
    }
});
function deleteProfil(url) {
    $('div#modal_confirm').modal('show');
    $('div#modal_confirm').find('a#supprim').attr('href', '');
    $('div#modal_confirm').find('a#supprim').attr('href', url);
}

var table = $('#example').DataTable({
    "bPaginate": true, "bFilter": true, "bInfo": true, 'sDom': '"top"i',
    language: {
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
    "columnDefs": [
        {"targets": 0, "orderDataType": "dom-text", "type": "string"},
        {"targets": 1, "orderDataType": "dom-text-select", "type": "string"},
        {'bSortable': false, 'aTargets': [2]}
    ],
    //"bSortCellsTop": true
});
$.fn.dataTable.ext.order['dom-text'] = function (settings, col)
{
    return this.api().column(col, {order: 'index'}).nodes().map(function (td, i) {
        return $('input', td).val();
    });
}
$.fn.dataTable.ext.order['dom-text-select'] = function (settings, col)
{
    return this.api().column(col, {order: 'index'}).nodes().map(function (td, i) {
        return $('select option:selected', td).val();
    });
}
$('#example_info').hide();
$('#example tfoot tr').insertAfter($('#example thead tr'));
$('input.ajouter').click(function () {
    $(this).blur();
    addCache();
    $(this).closest('form').attr('action', '');
});
function modifierProfil() {
    $('button.modifier').click(function () {
        $(this).blur();
        addCache();
        $(this).closest('form').attr('action', '');
    });
}
function supprimerProfil() {
    $('input.btn-danger').click(function () {
        $(this).blur();
        $(this).closest('form').attr('action', '');
    });
}
modifierProfil();
supprimerProfil();

table.on('draw.dt', function () {
    $("button.modifier").unbind("click");
    modifierProfil();
});

table.on('draw.dt', function () {
    $("input.btn-danger").unbind("click");
    supprimerProfil();
});

function updateProfil(obj, url) {
    var input = obj.closest('tr').find('td:first input');
    var codeVal = $('select#procash_administrationbundle_profil_code option:selected').val();
    if ($('input[value="' + input.val() + '"]').length === 0 && $('input#procash_administrationbundle_profil[libelle]').val() !== '') {
        addCache();
        $.ajax({
            type: "POST",
            url: url,
            data: "procash_administrationbundle_profil[libelle]=" + input.val() + "&procash_administrationbundle_profil[code]=" + codeVal,
            success: function (data) {
                removeCache();
                $('#infoModif').modal('show');
            },
            error: function () {
                removeCache();
            }
        }
        );
    } else {

    }
}
function addProfil(obj, url) {
    var input = obj.closest('tr').find('td:first input');
    if ($('input[value="' + input.val() + '"]').length === 0 && $('input#procash_administrationbundle_profil_libelle').val() !== '') {
        var codeVal = $('select#procash_administrationbundle_profil_code option:selected').val();
        addCache();
        $.ajax({
            type: "POST",
            url: url,
            data: "procash_administrationbundle_profil[libelle]=" + input.val() + "&procash_administrationbundle_profil[code]=" + codeVal,
            success: function (data) {
                url = "'" + url + "'";
                table.row.add([
                    '<td class=""><div class="col-lg-6"><input type="text" style="background:none;" required="required" maxlength="255" class="form-control" value="' + input.val() + '" name="procash_administrationbundle_profil[libelle]"><span style="color: red; font-size: 9px;font-weight:bold;" class="erreurLibProf form-control-feedback hide"><i class="mdi-alert-error"></i></span><span style="color: red; font-size: 12px;font-weight:bold;" class="erreurLibProf hide">(Vous ne pouvez pas utiliser ce libellé, veuillez choisir un autre.)</span></div></td>',
                    '<td>' + codeVal + '</td>',
                    '<td >0</td>',
                    '<td style="text-align:right!important;"><a href="javascript:void(0);" onclick="updateProfil($(this),' + url + ')"><span class="glyphicon glyphicon-pencil text-info btn-lg"></span></a><a href="javascript:void(0);" onclick="deleteProfil("")"><span class="glyphicon glyphicon-remove text-danger btn-lg"></span></a></td>'
                ]).draw(false);
                input.val('');
                removeCache();
                $('#info').modal('show');
            }}
        );
    } else {

    }

}

var erreurprofil = false;
var verifierLibelleExistant = function () {
    var profil = $('input#procash_administrationbundle_profil_libelle').val();
    var profilExistant = 0;

    var re = new RegExp('^' + profil + '$', "ig");
    $('.listeProfil').map(function () {
        if (re.test($.trim($(this).text()))) {
            profilExistant = 1;
        }
    });
    if (profil !== "" && profilExistant === 1) {
        $("#erreurLibProf").removeClass("hide");
        $(".erreurLibProf").removeClass("hide");
        erreurprofil = true;
    } else {
        $("#erreurLibProf").addClass("hide");
        $(".erreurLibProf").addClass("hide");
        erreurprofil = false;
    }
};

// Test libelle existant
$('body').undelegate('input#procash_administrationbundle_profil_libelle', 'change').delegate('input#procash_administrationbundle_profil_libelle', 'change', function () {
    verifierLibelleExistant();
});
$('body').undelegate('input#procash_administrationbundle_profil_libelle', 'keyup').delegate('input#procash_administrationbundle_profil_libelle', 'keyup', function () {
    verifierLibelleExistant();
});
$('body').undelegate('input#procash_administrationbundle_profil_libelle', 'blur').delegate('input#procash_administrationbundle_profil_libelle', 'blur', function () {
    verifierLibelleExistant();
});


function verifierProfil() {
    if ($('th input.libelleProfil').val() === '' || $('select#selectCode').val() === 'Sélectionnez un code ..') {
        $('th input.ajouter').attr('disabled', 'disabled');
        $('th input.ajouter').prop('disabled', true);
        $('#ajouterProfil').addClass('hide');
        $('#ajouterProfilHidden').removeClass('hide');
    } else {
        $('th input.ajouter').removeAttr('disabled');
        $('th input.ajouter').prop('disabled', false);
        $('#ajouterProfil').removeClass('hide');
        $('#ajouterProfilHidden').addClass('hide');
    }
    if (!$('.erreurLibelle').hasClass('hide')) {
        $('th input.ajouter').attr('disabled', 'disabled');
        $('th input.ajouter').prop('disabled', true);
        $('#ajouterProfil').addClass('hide');
        $('#ajouterProfilHidden').removeClass('hide');
    }
}
function verifierProfilModifier(obj, obj1) {
    if ($('#' + obj.attr('id')).val() === '' || $('#' + obj1.attr('id')).val() === '') {
        obj.closest('tr').find('td').children('button.modifier').attr('disabled', 'disabled');
        obj.closest('tr').find('td').children('button.modifier').children('i').css('cursor', 'default');
        obj.closest('tr').find('td').children('button.modifier').prop('disabled', true);
    } else {
        obj.closest('tr').find('td').children('button.modifier').removeAttr('disabled');
        obj.closest('tr').find('td').children('button.modifier').children('i').css('cursor', 'pointer');
        obj.closest('tr').find('td').children('button.modifier').prop('disabled', false);
    }

}
verifierProfil();
verifierProfilModifier($('input.libelleProfilModif'), $('select.selectCodeModif'));
$('body').undelegate('input.libelleProfil', 'keyup').delegate('input.libelleProfil', 'keyup', function () {
    verifierProfil();
    verifierChampsExistant($(this), '.erreurLibelle', tableLibelle);
});
$('body').undelegate('input.libelleProfil', 'change').delegate('input.libelleProfil', 'change', function () {
    verifierProfil();
    verifierChampsExistant($(this), '.erreurLibelle', tableLibelle);
});
$('body').undelegate('input.libelleProfil', 'blur').delegate('input.libelleProfil', 'blur', function () {
    verifierProfil();
    verifierChampsExistant($(this), '.erreurLibelle', tableLibelle);
});
$('body').undelegate('select#selectCode', 'change').delegate('select#selectCode', 'change', function () {
    verifierProfil();
});
//vérification lors de la modification
$('body').undelegate('input.libelleProfilModif', 'keyup').delegate('input.libelleProfilModif', 'keyup', function () {
    verifierProfilModifier($(this), $('select.selectCodeModif'));
});
$('body').undelegate('input.libelleProfilModif', 'change').delegate('input.libelleProfilModif', 'change', function () {
    verifierProfilModifier($(this), $('select.selectCodeModif'));
});
$('body').undelegate('input.libelleProfilModif', 'blur').delegate('input.libelleProfilModif', 'blur', function () {
    verifierProfilModifier($(this), $('select.selectCodeModif'));
});
$('body').undelegate('select.selectCodeModif', 'change').delegate('select.selectCodeModif', 'change', function () {
    verifierProfilModifier($('input.libelleProfilModif'), $(this));
});
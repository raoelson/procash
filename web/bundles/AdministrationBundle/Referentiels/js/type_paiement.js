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
    "bSortCellsTop": true
});
$.fn.dataTable.ext.order['dom-text'] = function(settings, col)
{
    return this.api().column(col, {order: 'index'}).nodes().map(function(td, i) {
        return $('input', td).val();
    });
}
$.fn.dataTable.ext.order['dom-text-select'] = function(settings, col)
{
    return this.api().column(col, {order: 'index'}).nodes().map(function(td, i) {
        return $('select option:selected', td).val();
    });
}
$('#example_info').hide();
$('#example tfoot tr').insertAfter($('#example thead tr'));

$('input.ajouter').click(function() {
    $(this).blur();
    addCache();
    $(this).closest('form').attr('action', '');
});

function modifierTypePaiement() {
    $('button.modifier').click(function() {
        $(this).blur();
        addCache();
        $(this).closest('form').attr('action', '');
    });
}
function supprimerTypePaiement() {
    $('input.btn-danger').click(function() {
        $(this).blur();
        $(this).closest('form').attr('action', '');
    });
}
modifierTypePaiement();
supprimerTypePaiement();

table.on('draw.dt', function() {
    $("button.modifier").unbind("click");
    modifierTypePaiement();
});

table.on('draw.dt', function() {
    $("input.btn-danger").unbind("click");
    supprimerTypePaiement();
});
function verifierModeReglement() {
    if ($('th input.modeReglement').val() === '' || $('select#selectCode').val() === 'Sélectionnez un code de règlement..') {
        $('th input.ajouter').attr('disabled', 'disabled');
        $('th input.ajouter').prop('disabled', true);
        $('#ajouterPaiementHidden').removeClass('hide');
        $('#ajouterPaiement').addClass('hide');
    } else {
        $('th input.ajouter').removeAttr('disabled');
        $('th input.ajouter').prop('disabled', false);
        $('#ajouterPaiementHidden').addClass('hide');
        $('#ajouterPaiement').removeClass('hide');
    }
    if (!$('.erreurLibelle').hasClass('hide')) {
        $('th input.ajouter').attr('disabled', 'disabled');
        $('th input.ajouter').prop('disabled', true);
        $('#ajouterPaiementHidden').removeClass('hide');
        $('#ajouterPaiement').addClass('hide');
    }
}
function verifierModeReglementModifier(obj, obj1) {
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
verifierModeReglement();
verifierModeReglementModifier($('input.modeReglementModif'),$('select.selectmodeReglementModif'));
$('body').undelegate('input.modeReglement', 'keyup').delegate('input.modeReglement', 'keyup', function() {
    verifierModeReglement();
    verifierChampsExistant($(this),'.erreurLibelle',tableLibelle);
});
$('body').undelegate('input.modeReglement', 'change').delegate('input.modeReglement', 'change', function() {
    verifierModeReglement();
    verifierChampsExistant($(this),'.erreurLibelle',tableLibelle);
});
$('body').undelegate('input.modeReglement', 'blur').delegate('input.modeReglement', 'blur', function() {
    verifierModeReglement();
    verifierChampsExistant($(this),'.erreurLibelle',tableLibelle);
});
$('body').undelegate('select#selectCode', 'change').delegate('select#selectCode', 'change', function() {
    verifierModeReglement();
});
//vérification lors de la modification
$('body').undelegate('input.modeReglementModif', 'keyup').delegate('input.modeReglementModif', 'keyup', function() {    
    verifierModeReglementModifier($(this),$('select.selectmodeReglementModif'));
});
$('body').undelegate('input.modeReglementModif', 'change').delegate('input.modeReglementModif', 'change', function() {
    verifierModeReglementModifier($(this),$('select.selectmodeReglementModif'));
});
$('body').undelegate('input.modeReglementModif', 'blur').delegate('input.modeReglementModif', 'blur', function() {
    verifierModeReglementModifier($(this),$('select.selectmodeReglementModif'));
});
$('body').undelegate('select.selectmodeReglementModif', 'change').delegate('select.selectmodeReglementModif', 'change', function() {
    verifierModeReglementModifier($('input.modeReglementModif'),$(this));
});

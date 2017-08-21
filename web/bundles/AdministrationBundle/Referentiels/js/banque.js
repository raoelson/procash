var table = $('#example').DataTable({
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
    "iDisplayLength": 10,
    "columnDefs": [
        {"targets": 0, "orderDataType": "dom-text", "type": "string"},
        {"targets": 1, "orderDataType": "dom-text", "type": "string"},
        {"targets": 2, "orderDataType": "dom-text", "type": "string"},
        {'bSortable': false, 'aTargets': [3]}
    ],
    "bSortCellsTop": true
});
$.fn.dataTable.ext.order['dom-text'] = function(settings, col)
{
    return this.api().column(col, {order: 'index'}).nodes().map(function(td, i) {
        return $('input', td).val();
    });
}

$(document).ready(function () {
    $('#example_length').hide();
    $('#example_info').hide();
});
$('#example tfoot tr').insertAfter($('#example thead tr'));

$('input.ajouter').click(function () {
    $(this).blur();
    addCache();
    $(this).closest('form').attr('action', '');
});

function modifierBanque() {
    $('button.modifier').click(function () {
        $(this).blur();
        addCache();
        $(this).closest('form').attr('action', '');
    });
}
function supprimerBanque() {
    $('input.btn-danger').click(function () {
        $(this).blur();
        $(this).closest('form').attr('action', '');
    });
}
modifierBanque();
supprimerBanque();

table.on('draw.dt', function () {
    $("button.modifier").unbind("click");
    modifierBanque();    
});

table.on('draw.dt', function () {
    $("input.btn-danger").unbind("click");
    supprimerBanque();    
});

function verifierCodeBanque() {
    if ($('th input.codeBanque').val() === '' || $('th input.libelleBanque').val() === '') {
        $('th input.ajouter').attr('disabled', 'disabled');
        $('th input.ajouter').prop('disabled', true);
        $('#ajouterBanqueHidden').removeClass('hide');
        $('#ajouterBanque').addClass('hide');
    } else {
        $('th input.ajouter').removeAttr('disabled');
        $('th input.ajouter').prop('disabled', false);
        $('#ajouterBanqueHidden').addClass('hide');
        $('#ajouterBanque').removeClass('hide');
    }
    if (!$('.erreurLibelle').hasClass('hide') || !$('.erreurCode').hasClass('hide')) {
        $('th input.ajouter').attr('disabled', 'disabled');
        $('th input.ajouter').prop('disabled', true);
        $('#ajouterBanqueHidden').removeClass('hide');
        $('#ajouterBanque').addClass('hide');
    }
}
function verifierCodeBanqueModifier(obj, obj1) {
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

verifierCodeBanque();
verifierCodeBanqueModifier($('input.codeBanqueModif'),$('input.libelleBanqueModif'));
$('body').undelegate('input.codeBanque','keyup').delegate('input.codeBanque','keyup',function(){
    verifierCodeBanque();
    verifierChampsExistant($(this),'.erreurCode',tableCode);
});
$('body').undelegate('input.codeBanque','change').delegate('input.codeBanque','change',function(){
    verifierCodeBanque();
    verifierChampsExistant($(this),'.erreurCode',tableCode);
});
$('body').undelegate('input.codeBanque','blur').delegate('input.codeBanque','blur',function(){
    verifierCodeBanque();
    verifierChampsExistant($(this),'.erreurCode',tableCode);
});
$('body').undelegate('input.libelleBanque','keyup').delegate('input.libelleBanque','keyup',function(){
    verifierCodeBanque();
    verifierChampsExistant($(this),'.erreurLibelle',tableLibelle);
});
$('body').undelegate('input.libelleBanque','change').delegate('input.libelleBanque','change',function(){
    verifierCodeBanque();
    verifierChampsExistant($(this),'.erreurLibelle',tableLibelle);
});
$('body').undelegate('input.libelleBanque','blur').delegate('input.libelleBanque','blur',function(){
    verifierCodeBanque();
    verifierChampsExistant($(this),'.erreurLibelle',tableLibelle);
});

//vérification lors de la modification
$('body').undelegate('input.codeBanqueModif', 'keyup').delegate('input.codeBanqueModif', 'keyup', function() {    
    verifierCodeBanqueModifier($(this),$('input.libelleBanqueModif'));
});
$('body').undelegate('input.codeBanqueModif', 'change').delegate('input.codeBanqueModif', 'change', function() {
    verifierCodeBanqueModifier($(this),$('input.libelleBanqueModif'));
});
$('body').undelegate('input.codeBanqueModif', 'blur').delegate('input.codeBanqueModif', 'blur', function() {
    verifierCodeBanqueModifier($(this),$('input.libelleBanqueModif'));
});
$('body').undelegate('input.libelleBanqueModif', 'keyup').delegate('input.libelleBanqueModif', 'keyup', function() {
    verifierCodeBanqueModifier($('input.codeBanqueModif'),$(this));
});
$('body').undelegate('input.libelleBanqueModif', 'change').delegate('input.libelleBanqueModif', 'change', function() {
    verifierCodeBanqueModifier($('input.codeBanqueModif'),$(this));
});
$('body').undelegate('input.libelleBanqueModif', 'blur').delegate('input.libelleBanqueModif', 'blur', function() {
    verifierCodeBanqueModifier($('input.codeBanqueModif'),$(this));
});

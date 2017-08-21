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
        {"targets": 1, "orderDataType": "dom-text", "type": "string"},
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
$('#example_info').hide();
$('#example tfoot tr').insertAfter($('#example thead tr'));

$('input.ajouter').click(function() {
    $(this).blur();
   addCacheSeuil();
    $(this).closest('form').attr('action', '');
});

function modifierMotifFermeture() {
    $('button.modifier').click(function() {
        $(this).blur();
        addCache();
        $(this).closest('form').attr('action', '');
    });
}
function supprimerMotifFermeture() {
    $('input.btn-danger').click(function() {
        $(this).blur();
        $(this).closest('form').attr('action', '');
    });
}
modifierMotifFermeture();
supprimerMotifFermeture();

table.on('draw.dt', function() {
    $("button.modifier").unbind("click");
    modifierMotifFermeture();
});

table.on('draw.dt', function() {
    $("input.btn-danger").unbind("click");
    supprimerMotifFermeture();
});

function verifierMotifFermeture() {
    if ($('th input.motifFermeture').val() === '' || $('th input.codemf').val() === '' ) {
        $('th input.ajouter').attr('disabled', 'disabled');
        $('th input.ajouter').prop('disabled', true);
        $('#ajouterMotifHidden').removeClass('hide');
        $('#ajouterMotif').addClass('hide');
    } else {
        $('th input.ajouter').removeAttr('disabled');
        $('th input.ajouter').prop('disabled', false);
        $('#ajouterMotifHidden').addClass('hide');
        $('#ajouterMotif').removeClass('hide');
    }
    if (!$('.erreurLibelle').hasClass('hide') || !$('.erreurCode').hasClass('hide')) {
        $('th input.ajouter').attr('disabled', 'disabled');
        $('th input.ajouter').prop('disabled', true);
        $('#ajouterMotifHidden').removeClass('hide');
        $('#ajouterMotif').addClass('hide');
    }
}
function verifierMotifFermetureModifier(obj, obj1) {
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
verifierMotifFermeture();
verifierMotifFermetureModifier($('input.motifModif'), $('input.codemfcModif'));
$('body').undelegate('input.motifFermeture', 'keyup').delegate('input.motifFermeture', 'keyup', function() {
    verifierMotifFermeture();
    verifierChampsExistant($(this),'.erreurLibelle',tableLibelle);
});
$('body').undelegate('input.motifFermeture', 'change').delegate('input.motifFermeture', 'change', function() {
    verifierMotifFermeture();
    verifierChampsExistant($(this),'.erreurLibelle',tableLibelle);
});
$('body').undelegate('input.motifFermeture', 'blur').delegate('input.motifFermeture', 'blur', function() {
    verifierMotifFermeture();
    verifierChampsExistant($(this),'.erreurLibelle',tableLibelle);
});
$('body').undelegate('input.codemf', 'keyup').delegate('input.codemf', 'keyup', function() {
    verifierMotifFermeture();
    verifierChampsExistant($(this),'.erreurCode',tableCode);
});
$('body').undelegate('input.codemf', 'change').delegate('input.codemf', 'change', function() {
    verifierMotifFermeture();
    verifierChampsExistant($(this),'.erreurCode',tableCode);
});
$('body').undelegate('input.codemf', 'blur').delegate('input.codemf', 'blur', function() {
    verifierMotifFermeture();
    verifierChampsExistant($(this),'.erreurCode',tableCode);
});
//vérification lors de la modification
$('body').undelegate('input.motifModif', 'keyup').delegate('input.motifModif', 'keyup', function() {
    verifierMotifFermetureModifier($(this), $('input.codemfcModif'));
});
$('body').undelegate('input.motifModif', 'change').delegate('input.motifModif', 'change', function() {
    verifierMotifFermetureModifier($(this), $('input.codemfcModif'));
});
$('body').undelegate('input.motifModif', 'blur').delegate('input.motifModif', 'blur', function() {
    verifierMotifFermetureModifier($(this), $('input.codemfcModif'));
});
$('body').undelegate('input.codemfcModif', 'keyup').delegate('input.codemfcModif', 'keyup', function() {
    verifierMotifFermetureModifier($('input.motifModif'), $(this));
});
$('body').undelegate('input.codemfcModif', 'change').delegate('input.codemfcModif', 'change', function() {
    verifierMotifFermetureModifier($('input.motifModif'), $(this));
});
$('body').undelegate('input.codemfcModif', 'blur').delegate('input.codemfcModif', 'blur', function() {
    verifierMotifFermetureModifier($('input.motifModif'), $(this));
});

var addCacheSeuil = function() {
    $("body").prepend("<div id=\"cache\"><div id=\"cache-bg\"></div></div>");
};


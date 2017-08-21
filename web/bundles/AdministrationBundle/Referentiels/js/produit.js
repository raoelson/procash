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
    }
});

$('#example tfoot tr').insertAfter($('#example thead tr'));

$('input.ajouter').click(function () {
    $(this).blur();
    addCache();
    $(this).closest('form').attr('action', '');
    if ($.trim($('input.form-control:first').val()).length === 0) {
        removeCache();
        return false;
    }
});

function modifierProduit() {
    $('input.modifier').click(function () {
        $(this).blur();
        addCache();
        $(this).closest('form').attr('action', '');
    });
}

function supprimerProduit() {
    $('input.btn-danger').click(function () {
        $(this).blur();
        $(this).closest('form').attr('action', '');
    });
}

modifierProduit();
supprimerProduit();

table.on('draw.dt', function () {
    $("input.modifier").unbind("click");
    modifierProduit();    
});

table.on('draw.dt', function () {
    $("input.btn-danger").unbind("click");
    supprimerProduit();    
});

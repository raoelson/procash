var table = $('table').DataTable({
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
//    "aoColumnDefs": [
////        {'bSortable': false, 'aTargets': [0, nbColumn]}
//    ],
//    "aoColumns": [null, null, null, {"sType": "date-uk"}, null, null, null
//    ]
});
$(document).ready(function () {
$('#example_length').hide();
$('#example_info').hide();
$('input#Actions').hide();
$('#filterrow th').removeAttr('class');
});

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}
$('#example_filter input[type=search]').attr("id", "rechercheGlobal");

//Ajout filtre
$('#example thead tr#filterrow th').each(function () {
    var title = $('#example thead th').eq($(this).index()).text();
    var str = title.replace(/\s+/g, '');
    switch (title) {
        default:
            $(this).html('<input type="text" id="' + str + '" class="form-control input-sm simpleFiltre" onclick="stopPropagation(event);" placeholder="' + title + '" />');
            break;
    }

});

//activé filtre
$("#example thead input[type=text]").on('keyup change', function () {
    table.column($(this).parent().index() + ':visible')
            .search(this.value)
            .draw();
});

function resetSorting() {
    $('thead tr:first th').removeAttr('class');
    $('thead tr:first th').addClass('sorting');
    $('thead tr:first th:first').removeClass('sorting');
    $('thead tr:first th:last').removeClass('sorting');
}
;

resetSorting();


$('thead tr:first th').each(function (i) {
    i = i + 1;
    $('thead tr:first th:nth-child(' + i + ')').click(function () {
        $('#filterrow th:nth-child(' + i + ')').trigger('click')
    });
});
$('#filterrow th').each(function (i) {
    i = i + 1;
    $('#filterrow th:nth-child(' + i + ')').click(function () {
        resetSorting();
        $('thead tr:first th:nth-child(' + i + ')').removeAttr('class');
        $('thead tr:first th:nth-child(' + i + ')').addClass($(this).attr('class'));
        $('#filterrow th').removeAttr('class');
    });
});

$('tr td').css('padding', '5px 10px');
//$('thead tr:first th').css('padding', '5px 10px');
//$('thead tr:last th').css('padding', '5px 10px');
//$('table.dataTable thead th, table.dataTable thead td').css('border-bottom', '2px solid #ddd');
//$('table.dataTable.no-footer').css('border-bottom', '2px solid #ddd');
//$('table').addClass('table-bordered');
$('thead tr:first th').css('border', 'none');
$('thead tr:last th:first').css('text-align', 'center');
//$('thead tr th:first').css('width', '5%');
//$('thead tr th:last').css('width', '5%');
$('input').css('border-radius', '2px');


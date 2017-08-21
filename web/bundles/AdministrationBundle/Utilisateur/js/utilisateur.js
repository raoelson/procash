/* global dhtmlXCalendarObject */
// add once, make sure dhtmlxcalendar.js is loaded
dhtmlXCalendarObject.prototype.langData["fr"] = {
    // format
    dateformat: "%d/%m/%Y",
    // full names of months
    monthesFNames: [
        "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet",
        "Août", "Septembre", "Octobre", "Novembre", "Décembre"
    ],
    // short names of months
    monthesSNames: [
        "Jan", "Fév", "Mar", "Avr", "Mai", "Juin",
        "Juil", "Aoû", "Sep", "Oct", "Nov", "Déc"
    ],
    // full names of days
    daysFNames: [
        "Dimanche", "Lundi", "Mardi", "Mercredi",
        "Jeudi", "Vendredi", "Samedi"
    ],
    // short names of days
    daysSNames: [
        "D", "L", "M", "M",
        "J", "V", "S"
    ],
    // starting day of a week. Number from 1(Monday) to 7(Sunday)
    weekstart: 1,
    // the title of the week number column
    weekname: "w"
};

var date = document.getElementById("dateCreation");
var myCalendarCre = new dhtmlXCalendarObject([date]);
myCalendarCre.setDateFormat("%d/%m/%Y"); //Date format MM/DD/YYY
myCalendarCre.setSkin("dhx_terrace");
myCalendarCre.loadUserLanguage("fr");

nbColumn = $("#table_user thead tr:first th").length - 1;
/* Pour tous les datatables */
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
    "columnDefs": [
        {'bSortable': false, 'aTargets': [4]}
    ],
    "order": [[3, "desc"]],
    "bSortCellsTop": true,
    "bRetrieve": true
});

$(document).ready(function() {
    $('#example_length').hide();
    $('#example_info').hide();
    $('[data-toggle="popover"]').popover();
    $('.pop').popover();
    $('.plus').popover();
});

//Ajout filtre
$('#example thead tr#filterrow th').each(function() {
    var title = $('#example thead th').eq($(this).index()).text();
    var str = title.replace(/\s+/g, '');
    if (title != 'Actions') {
        switch (title) {
            default:
                $(this).html('<input type="text" id="' + str + '" class="form-control input-sm simpleFiltre" onclick="stopPropagation(event);" placeholder="' + title + '" />');
                break;
        }
    } else {
        $(this).html('<a href="javascript:void(0)" onclick="fnResetFiltre()"><span class=\'supprimer glyphicon glyphicon-remove text-danger btn-lg\'> </span></a>');
    }

});


var fnResetFiltre = function() {
    $('#Utilisateur').val('');
    $('#Email').val('');
    $('#Profil').val('');
    $('#DateCréation').val('');
    $("#Utilisateur").trigger("change");
    $("#Email").trigger("change");
    $("#Profil").trigger("change");
    $("#DateCréation").trigger("change");
    table.draw();
};


//activé filtre
$("#example thead input[type=text]").on('keyup change', function() {
    table.column($(this).parent().index() + ':visible')
            .search(this.value)
            .draw();
});

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}
$('#example_filter input[type=search]').attr("id", "rechercheGlobal");

$('#dateCreation').attr('readonly', true);
$('#dateCreation').css('background-color', '#FFF');
//mettre la date création en date picker dhtmlx
//date = document.getElementById("DateCréation");

/*
myCalendarCre.attachEvent("onClick", function() {
    $("#example thead input[type=text]").on('blur', function() {
        table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();
    });
});
*/

$('input[type=search]').addClass('input-sm');
$('input[type=text]').addClass('input-sm');
$('input[type=email]').addClass('input-sm');
$('select').addClass('input-sm');
//$('.btn').addClass('btn-sm');
$('select').addClass('btn-sm');
//$('#filterrow th').click(function () {
//    $('#filterrow th:first').removeAttr('class');
//    $('#filterrow th:last').removeAttr('class');
//});

function resetSorting() {
    $('thead tr:first th').removeAttr('class');
    $('thead tr:first th').addClass('sorting');
    $('thead tr:first th:first').removeClass('sorting');
    $('thead tr:first th:last').removeClass('sorting');
}
;

//resetSorting();

$('thead tr:first th').each(function(i) {
    i = i + 1;
    $('thead tr:first th:nth-child(' + i + ')').click(function() {
        $('#filterrow th:nth-child(' + i + ')').trigger('click')
    });
});
//$('#filterrow th').each(function(i) {
 //   i = i + 1;
//    $('#filterrow th:nth-child(' + i + ')').click(function() {
//        resetSorting();
//        $('thead tr:first th:nth-child(' + i + ')').removeAttr('class');
//        $('thead tr:first th:nth-child(' + i + ')').addClass($(this).attr('class'));
//        $('#filterrow th').removeAttr('class');
//    });
//});

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
//$('input').css('border-radius', '2px');

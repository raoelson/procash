/* global dhtmlXCalendarObject */
// add once, make sure dhtmlxcalendar.js is loaded
dhtmlXCalendarObject.prototype.langData["fr"] = {
    // date format
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
    "bSortCellsTop": true
});
$(document).ready(function () {
    $('#example_length').hide();
    $('#example_info').hide();
    $('input#Actions').hide();    
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
/*
$("#Datedébut").focusin(function () {
    $(this).trigger('blur');
});
$("#Datefin").focusin(function () {
    $(this).trigger('blur');
});
*/
var fnResetFiltre = function () {
    $('#Client').val('');
    $('#Datedébut').val('');
    $('#Datefin').val('');
    $('#Motifd').val('');
    $("#Client").trigger("change");
    $("#Datedébut").trigger("change");
    $("#Datefin").trigger("change");
    $("#Motifd").trigger("change");
    table.draw();
};
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

//resetSorting();


$('thead tr:first th').each(function (i) {
    i = i + 1;
    $('thead tr:first th:nth-child(' + i + ')').click(function () {
        $('#filterrow th:nth-child(' + i + ')').trigger('click')
    });
});
$('#filterrow th').each(function (i) {
    i = i + 1;
});

$('tr td').css('padding', '5px 10px');
$('thead tr:first th').css('border', 'none');
$('thead tr:last th:first').css('text-align', 'center');
$('input').css('border-radius', '4px');
$('input#dateDebut').addClass('input-sm');
$('input#dateFin').addClass('input-sm');

//mettre la date création en date picker dhtmlx
var date = document.getElementById("dateDebut");
var myCalendarDebut = new dhtmlXCalendarObject([date]);
myCalendarDebut.setDateFormat("%d/%m/%Y"); //Date format MM/DD/YYY
myCalendarDebut.setSkin("dhx_terrace");
myCalendarDebut.loadUserLanguage("fr");

var dateFin = document.getElementById("dateFin");
var myCalendarFin = new dhtmlXCalendarObject([dateFin]);
myCalendarFin.setDateFormat("%d/%m/%Y"); //Date format MM/DD/YYY
myCalendarFin.setSkin("dhx_terrace");
myCalendarFin.loadUserLanguage("fr");

myCalendarFin.attachEvent("onClick", function() {        
        var dt = $("#dateDebut").val().split("/");
        var tmp = dt[0];
        dt[0] = dt[1];
        dt[1] = tmp;
        dt = dt.join("/");
        var date = new Date(dt);       
        date.setDate(date.getDate() - 1);
        dt = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
        if (dt !== '') {
            myCalendarFin.setInsensitiveRange(null, dt);
        }
 });
myCalendarDebut.attachEvent("onClick", function() {
        var dt = $("#dateDebut").val().split("/");
        var tmp = dt[0];
        dt[0] = dt[1];
        dt[1] = tmp;
        dt = dt.join("/");
        var date = new Date(dt);
        if($("#dateFin").val() !== ""){
            var df = $("#dateFin").val().split("/");
             var tmpo = df[0];
            df[0] = df[1];
            df[1] = tmpo;
            df = df.join("/");
            var dfin = new Date(df);
            if(dfin < date ){
                $("#dateFin").val("");
            }
        }
        date.setDate(date.getDate() - 1);
        dt = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
        if (dt !== '') {
            myCalendarFin.setInsensitiveRange(null, dt);
        }

 });

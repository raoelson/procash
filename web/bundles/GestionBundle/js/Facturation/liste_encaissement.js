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


var table = $('table#example').DataTable({
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
        {'bSortable': false, 'aTargets': [6]}
    ]
});
$('div#example_length').hide();
$('div#example_info').hide();

date = document.getElementById("dateSynchro");
var myCalendarCre = new dhtmlXCalendarObject([date]);
myCalendarCre.setDateFormat("%d/%m/%Y"); //Date format MM/DD/YYY
myCalendarCre.setSkin("dhx_terrace");
myCalendarCre.loadUserLanguage("fr");
myCalendarCre.loadUserLanguage("fr");

$("button#annulerModifClient").click(function () {    
    $('.modal-backdrop').remove();
});
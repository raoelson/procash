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

datefrom = document.getElementById("procash_gestionbundle_saisifermeture_dateDebutFermeture");
dateto = document.getElementById("procash_gestionbundle_saisifermeture_dateFinFermeture");
dateNow = new Date();
if (seuil !== 'undefined') {
    dateNow.setDate(dateNow.getDate() + seuil);
} else {
    dateNow.setDate(dateNow.getDate());
}

var myCalendarDeb = new dhtmlXCalendarObject([datefrom]);
myCalendarDeb.loadUserLanguage("fr");
myCalendarDeb.setDateFormat("%d/%m/%Y");      //Date format MM/DD/YYY
myCalendarDeb.setSkin("dhx_terrace");
//myCalendarDeb.setInsensitiveRange(null, dateNow);


var myCalendarFin = new dhtmlXCalendarObject([dateto]);
var dateMaxDelai = new Date();
if (delaiMax !== 'undefined') {
    dateMaxDelai.setDate(dateMaxDelai.getDate() + delaiMax);
} else {
    dateMaxDelai.setDate(dateMaxDelai.getDate());
}

myCalendarFin.setDateFormat("%d/%m/%Y");      //Date format MM/DD/YYY
myCalendarFin.setSkin("dhx_terrace");
myCalendarFin.loadUserLanguage("fr");
if (delaiMax !== 'undefined' && seuil !== 'undefined') {
    myCalendarDeb.setSensitiveRange(formatDateSlash(dateNow), formatDateSlash(dateMaxDelai));
    myCalendarFin.setSensitiveRange(formatDateSlash(dateNow), formatDateSlash(dateMaxDelai));
} else {
    myCalendarDeb.setInsensitiveRange(null, dateNow);
    myCalendarFin.setInsensitiveRange(null, dateNow);
}


myCalendarDeb.attachEvent("onClick", function() {
    if ($("#procash_gestionbundle_saisifermeture_dateDebutFermeture").val() != '') {
        var newDate = $('#procash_gestionbundle_saisifermeture_dateDebutFermeture').val();
        if (delaiMax !== 'undefined'){
                   myCalendarFin.setSensitiveRange(newDate, formatDateSlash(dateMaxDelai)); 
        }else{
           myCalendarFin.setSensitiveRange(newDate,null); 
        }

    } else {
         if (delaiMax !== 'undefined'){
               myCalendarDeb.setSensitiveRange(formatDateSlash(dateNow), formatDateSlash(dateMaxDelai));
         }else{
               myCalendarDeb.setSensitiveRange(formatDateSlash(dateNow), null);
         }
      
    }
});

//    / prendre la date precedente d'une date /
function datePrecedente(date) {
    var dt = date.split('/');
    var myDate = new Date(dt[2] + '-' + dt[1] + '-' + dt[0]);
    myDate.setDate(myDate.getDate() + -1);
    newDate = formatDateSlash(myDate);
    return newDate;
}
//    / de la forme dd/mm / yyyy /
function formatDateSlash(myDate) {
    var y = myDate.getFullYear(),
            m = myDate.getMonth() + 1, // january is month 0 in javascript
            d = myDate.getDate();
    var pad = function(val) {
        var str = val.toString();
        return (str.length < 2) ? "0" + str : str
    };
    //dateString = [y, pad(m), pad(d)].join("-");
    dateString = [pad(d), pad(m), y].join("/");
    return dateString;
}
//    / prendre la date suivante d'une date /
function dateSuivante(date) {
    var dt = date.split('/');
    var myDate = new Date(dt[2] + '-' + dt[1] + '-' + dt[0]);
    myDate.setDate(myDate.getDate() + 1);
    newDate = formatDateSlash(myDate);
    return newDate;
}

$("#procash_gestionbundle_saisifermeture_dateDebutFermeture").focusin(function() {
    $(this).trigger('blur');
});
$("#procash_gestionbundle_saisifermeture_dateFinFermeture").focusin(function() {
    $(this).trigger('blur');
});

var fnValidationFermeture = function() {
    var valide = 0;
    var client = $('#procash_gestionbundle_saisifermeture_client').val();
    var dd = $("#procash_gestionbundle_saisifermeture_dateDebutFermeture").val();
    var df = $("#procash_gestionbundle_saisifermeture_dateFinFermeture").val();

    if (dd.trim() != '' && df.trim() != '') {
        var ddParam = dd;
        var ddParamSplit = ddParam.split('/');
        var dfParam = df;
        var dfParamSplit = dfParam.split('/');
        var dfParamDate = new Date(dfParamSplit[2], dfParamSplit[1] - 1, dfParamSplit[0]);
        var ddParamDate = new Date(ddParamSplit[2], ddParamSplit[1] - 1, ddParamSplit[0]);
        $(listeFermetures).each(function(key, value) {
            var ddTab = value.dd;
            var ddTabSplit = ddTab.split('/');
            var dfTab = value.df;
            var dfTabSplit = dfTab.split('/');
            var dfTabDate = new Date(dfTabSplit[2], dfTabSplit[1] - 1, dfTabSplit[0]);
            var ddTabDate = new Date(ddTabSplit[2], ddTabSplit[1] - 1, ddTabSplit[0]);
            if (dd == value.dd && df == value.df && value.user == client) {
                valide++;
            } else if (ddParamDate.toDateString() !== ddTabDate.toDateString() && dfParamDate.toDateString() === dfTabDate.toDateString() && value.user == client) {
                valide++;
            } else if (ddParamDate.toDateString() === ddTabDate.toDateString() && dfParamDate.toDateString() !== dfTabDate.toDateString() && value.user == client) {
                valide++;
            } else if (ddParamDate > ddTabDate && dfParamDate < dfTabDate && value.user == client) {
                valide++;
            } else if (ddParamDate < ddTabDate && (dfParamDate < dfTabDate && dfParamDate >= ddTabDate) && value.user == client) {
                valide++;
            } else if (dfParamDate > dfTabDate && (ddParamDate > ddTabDate && ddParamDate <= dfTabDate) && value.user == client) {
                valide++;
            } else {
            }
        });

        if (valide == 0) {
            $('#formAjoutFermeture').submit();
            $('#erreurChevauchement').remove();
        } else {
            var msg = '<div class ="alert alert-danger col-md-6 erreurChevauchement" id="erreurChevauchement" style="text-align:center!important">Cet utilisateur a une fermeture inclus dans cette période.</div>';
            $('div#footerFermeture').prepend(msg);
            $('.validerAjout').attr('disabled', true);
            $("#erreurChevauchement").delay(4000).fadeOut(function() {
                $('#erreurChevauchement').remove();
                $('.validerAjout').attr('disabled', false);
            });
        }
    } else {
        var msgObligatoire = '<div class ="alert alert-danger col-md-6 erreurObligatoire" id="erreurObligatoire" style="text-align:center!important">Veuillez remplir les champs obligatoires.</div>';
        $('div#footerFermeture').prepend(msgObligatoire);
        $('.validerAjout').attr('disabled', true);
        $("#erreurObligatoire").delay(4000).fadeOut(function() {
            $('#erreurObligatoire').remove();
            $('.validerAjout').attr('disabled', false);
        });
    }
};
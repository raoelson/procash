function changerReseau(objRes) {
    var objRes = objRes.val();
    addCache();
    $.ajax({
        url: urlChangeReseau,
        data: 'objRes=' + objRes,
        type: 'POST',
        success: function (resultat) {
            $(".placeClient").html(resultat);
            changerClient($('select#selectClient'));
            removeCache();
        }
    });
}

changerReseau($("#selectReseau"));
$('#selectReseau').change(function () {
    changerReseau($(this));
});

function changerClient(objCli) {
    var objCli = objCli.val();
    addCache();
    $.ajax({
        url: urlChangerClient,
        data: 'objCli=' + objCli,
        type: 'POST',
        success: function (resultat) {
            $("#showReport").html(resultat);
            removeCache();
        }
    });
}

$('body').undelegate('select#selectClient', 'change').delegate('select#selectClient', 'change', function () {

    changerClient($(this));
});

date = document.getElementById("Datedefermeture");
var myCalendarCre = new dhtmlXCalendarObject([date]);
myCalendarCre.setDateFormat("%d/%m/%Y"); //Date format MM/DD/YYY
myCalendarCre.setSkin("dhx_terrace");
myCalendarCre.loadUserLanguage("fr");


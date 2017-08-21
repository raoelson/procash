function addCache() {
    $("body").prepend("<div id=\"cache\"><div id=\"cache-bg\"></div></div>");
}

function removeCache() {
    $("#cache").remove();
}

if ($('#info').length) {
    $('#info').modal('show');
}

if ($('#erreur').length) {
    $('#erreur').modal('show');
}

function verifierChampsExistant(obj, classe, tableau) {
    var codeSaisi = $.trim(obj.val());
    var codeExistant = 0;
    var reCodeSaisi = new RegExp('^' + codeSaisi + '$', "ig");
    tableau.map(function(codeExist) {
        if (reCodeSaisi.test($.trim(codeExist))) {
            codeExistant = 1;
        }
    });
    if (codeSaisi != "" && codeExistant == 1) {
        $(classe).removeClass('hide');
    }
    else {
        $(classe).addClass('hide');
    }
}

if ($('.select2').length) {
    $('.select2').select2({allowClear: true, width: '100%'});
}

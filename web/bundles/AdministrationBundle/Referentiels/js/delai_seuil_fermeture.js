var erreurSeuilDelai = false;
var fnVerificationDelaiEtSeuil = function(seuil, delai) {
    if (parseInt(seuil) > parseInt(delai)) {
        erreurSeuilDelai = false;
        $('#saveDelaiFermeture').prop('disabled', false);
        if (!$('.erreurSeuilDelai').hasClass('.erreurSeuilDelai')) {
            $('.erreurSeuilDelai').addClass('hide');
        }
    } else {
        erreurSeuilDelai = true;
        $('#saveDelaiFermeture').prop('disabled', true);
        $('.erreurSeuilDelai').removeClass('hide');

    }
};
fnVerificationDelaiEtSeuil($('input#procash_administrationbundle_delaifermeture_seuilMax').val(), $('input#procash_administrationbundle_delaifermeture_delaiMin').val());

$("input#procash_administrationbundle_delaifermeture_delaiMin").keypress(function(e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        e.preventDefault();
    }
});
$("input#procash_administrationbundle_delaifermeture_seuilMax").keypress(function(e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        e.preventDefault();
    }
});
$('body').undelegate('input#procash_administrationbundle_delaifermeture_delaiMin', 'keyup').delegate('input#procash_administrationbundle_delaifermeture_delaiMin', 'keyup', function() {
    fnVerificationDelaiEtSeuil($('input#procash_administrationbundle_delaifermeture_seuilMax').val(), $(this).val());
});
$('body').undelegate('input#procash_administrationbundle_delaifermeture_delaiMin', 'change').delegate('input#procash_administrationbundle_delaifermeture_delaiMin', 'change', function() {
    fnVerificationDelaiEtSeuil($('input#procash_administrationbundle_delaifermeture_seuilMax').val(), $(this).val());
});
$('body').undelegate('input#procash_administrationbundle_delaifermeture_seuilMax', 'keyup').delegate('input#procash_administrationbundle_delaifermeture_seuilMax', 'keyup', function() {
    fnVerificationDelaiEtSeuil($(this).val(), $('input#procash_administrationbundle_delaifermeture_delaiMin').val());
});
$('body').undelegate('input#procash_administrationbundle_delaifermeture_seuilMax', 'change').delegate('input#procash_administrationbundle_delaifermeture_seuilMax', 'change', function() {
    fnVerificationDelaiEtSeuil($(this).val(), $('input#procash_administrationbundle_delaifermeture_delaiMin').val());
});


//fonction vérifiant un login existant

var erreurUserName = false;
var verifierLoginExistant = function () {
    var utilisateur = $('input#procash_user_registration_username').val();
    var utilisateurExistant = 0;

    var re = new RegExp('^' + utilisateur + '$', "ig");
    $('.listeLoginUtilisateur').map(function () {
        if (re.test($.trim($(this).text()))) {
            utilisateurExistant = 1;
        }
    });
    if (utilisateur !== "" && utilisateurExistant === 1) {
        $(".afficherErreurLogin").removeClass("hide");
        $("#imgelogin").removeClass("hide");
        $("#contenairLogin").addClass("has-error has-feedback");
        $('.submitButton').attr("disabled", true);
        erreurUserName = true;
    } else {
        if (!$(".afficherErreurLogin").hasClass("hide")) {
            $(".afficherErreurLogin").addClass("hide");
        }
        if (!$("#imgelogin").hasClass("hide")) {
            $("#imgelogin").addClass("hide");
        }
        $("#contenairLogin").removeClass("has-error has-feedback");
        // $('.submitButton').attr("disabled", false);
        erreurUserName = false;
    }
};

// Test login
$('body').undelegate('input#procash_user_registration_username', 'change').delegate('input#procash_user_registration_username', 'change', function () {
    verifierLoginExistant();
});
$('body').undelegate('input#procash_user_registration_username', 'keyup').delegate('input#procash_user_registration_username', 'keyup', function () {
    verifierLoginExistant();
});
$('body').undelegate('input#procash_user_registration_username', 'blur').delegate('input#procash_user_registration_username', 'blur', function () {
    verifierLoginExistant();
});

//fonction vérifiant un adresse email invalide 
var erreurMail = false;
var verifierEmailInvalide = function () {
    var value = $('input#procash_user_registration_email').val();
    if (/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}\b/i.test(value)) {
        erreurMail = false;
        $(".afficherErreurEmail").addClass("hide");
        $("#imgemail").addClass("hide");
        $("#contenairEmail").removeClass("has-error has-feedback");
        //  $('.submitButton').attr("disabled", false);
    } else {
        $(".afficherErreurEmailEx").addClass("hide");
        $(".afficherErreurEmail").removeClass("hide");
        $("#imgemail").removeClass("hide");
        $("#contenairEmail").addClass("has-error has-feedback");
        // $('.submitButton').attr("disabled", true);
        erreurMail = true;
    }
};

//fonction vérifiant un email déjà existant
var erreurMailEx = false;
var fnVerifierMailExistant = function () {
    var email = $('input#procash_user_registration_email').val();
    var mailExistant = 0;
    var re = new RegExp('^' + email + '$', "ig");
    $('.listeMailUtilisateur').map(function () {
        if (re.test($.trim($(this).text()))) {
            mailExistant = 1;
        }
    });
    if (email != "" && mailExistant == 1) {
        $(".afficherErreurEmail").addClass("hide");
        $(".afficherErreurEmailEx").removeClass("hide");
        $("#imgemail").removeClass("hide");
        $("#contenairEmail").addClass("has-error has-feedback");
        //  $('.submitButton').attr("disabled", true);
        erreurMailEx = true;
    } else if (!erreurMail) {
        $("#imgemail").addClass("hide");
        $(".afficherErreurEmailEx").addClass("hide");
        $("#contenairEmail").removeClass("has-error has-feedback");
        //   $('.submitButton').attr("disabled", false);
        erreurMailEx = false;
    } else {
        $("#imgemail").removeClass("hide");
        $("#contenairEmail").addClass("has-error has-feedback");
        $(".afficherErreurEmailEx").addClass("hide");
        //    $('.submitButton').attr("disabled", false);
        erreurMailEx = false;
    }
}

$('body').undelegate('select#procash_user_registration_email', 'change').delegate('input#procash_user_registration_email', 'change', function () {

});

$('body').undelegate('input#procash_user_registration_email', 'change').delegate('input#procash_user_registration_email', 'change', function () {
    verifierEmailInvalide();
    fnVerifierMailExistant();
});
$('body').undelegate('input#procash_user_registration_email', 'keyup').delegate('input#procash_user_registration_email', 'keyup', function () {
    verifierEmailInvalide();
    fnVerifierMailExistant();
});
$('body').undelegate('input#procash_user_registration_email', 'blur').delegate('input#procash_user_registration_email', 'blur', function () {
    verifierEmailInvalide();
    fnVerifierMailExistant();
});

//Vérification mot de passe
var errorMotDePa = false;
/* Vérification mot de passe */
$('#procash_user_registration_plainPassword_first').on('blur', function (event) {
    var a = $('#procash_user_registration_plainPassword_first').val();
    var arr = a.split("");
    var contentNumeric = false;
    var contentAlphabet = false;
    $.each(arr, function (index, value) {
        if (isNaN(value)) {
            if (!contentAlphabet) {
                contentAlphabet = true;
            }
        } else {
            if (!contentNumeric) {
                contentNumeric = true;
            }
        }
    });

    if (contentAlphabet && contentNumeric) {
        $('#contenairMdp').removeClass('has-error has-feedback');
        $('#imgmdp').addClass('hide');
        $('.afficherErreurPwd').addClass('hide');
        // $('.submitButton').attr("disabled", false);
        errorMotDePa = false;
    } else {
        errorMotDePa = true;
        $('.afficherErreurPwdSec').addClass('hide');
        $('.afficherErreurPwd').removeClass('hide');
        $('#procash_user_registration_plainPassword_first').focus();
        $('#contenairMdp').addClass('has-error has-feedback');
        $('#imgmdp').removeClass('hide');
        // $('.submitButton').attr("disabled", true);
        event.stopPropagation();

        return false;
    }

});
var errorMoDePa = false;
/* Vérification mot de passe */
$('#procash_user_registration_plainPassword_first').on('change', function (event) {
    var a = $('#procash_user_registration_plainPassword_first').val();
    var arr = a.split("");
    var contentNumeric = false;
    var contentAlphabet = false;
    $.each(arr, function (index, value) {
        if (isNaN(value)) {
            if (!contentAlphabet) {
                contentAlphabet = true;
            }
        } else {
            if (!contentNumeric) {
                contentNumeric = true;
            }
        }
    });

    if (contentAlphabet && contentNumeric) {
        $('#contenairMdp').removeClass('has-error has-feedback');
        $('#imgmdp').addClass('hide');
        $('.afficherErreurPwd').addClass('hide');
        //  $('.submitButton').attr("disabled", false);
        errorMoDePa = false;
    } else {
        errorMoDePa = true;
        $('.afficherErreurPwdSec').addClass('hide');
        $('.afficherErreurPwd').removeClass('hide');
        $('#procash_user_registration_plainPassword_first').focus();
        $('#contenairMdp').addClass('has-error has-feedback');
        $('#imgmdp').removeClass('hide');
        //  $('.submitButton').attr("disabled", true);
        event.stopPropagation();

        return false;
    }

});

var errorPassLength = false;
$('#procash_user_registration_plainPassword_first').on(' keyup', function () {
    var a = $('#procash_user_registration_plainPassword_first').val();
    var arr = a.split("");
    var contentNumeric = false;
    var contentAlphabet = false;
    $.each(arr, function (index, value) {
        if (isNaN(value)) {
            if (!contentAlphabet) {
                contentAlphabet = true;
            }
        } else {
            if (!contentNumeric) {
                contentNumeric = true;
            }
        }
    });
    if (a.length < 6 || !contentNumeric || !contentAlphabet) {
        $('#contenairMdp').addClass('has-error has-feedback');
        $('#imgmdp').removeClass('hide');
        $('.afficherErreurPwdSec').addClass('hide');
        $('.afficherErreurPwd').removeClass('hide');
        errorPassLength = true;
        // $('.submitButton').attr("disabled", true);
    } else {
        $('#contenairMdp').removeClass('has-error has-feedback');
        $('#imgmdp').addClass('hide');
        $('.afficherErreurPwd').addClass('hide');
        //   $('.submitButton').attr("disabled", false);
        errorPassLength = false;
    }

});
var errorPassLengthChange = false;
$('#procash_user_registration_plainPassword_first').on(' change', function () {
    if ($('#procash_user_registration_plainPassword_first').val().length < 6) {
        $('#contenairMdp').addClass('has-error has-feedback');
        $('#imgmdp').removeClass('hide');
        errorPassLengthChange = true;
        //   $('.submitButton').attr("disabled", true);
    } else {
        $('#contenairMdp').removeClass('has-error has-feedback');
        $('#imgmdp').addClass('hide');
        //     $('.submitButton').attr("disabled", false);
        errorPassLengthChange = false;
    }

});
$('#procash_user_registration_plainPassword_first').keyup(function (e) {
    if (this.value.match(/[^a-zA-Z0-9]/g)) {
        this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
    }
});
var errPassVer = false;
$('#procash_user_registration_plainPassword_second').on('keyup', function () {
    var mdp = $('#procash_user_registration_plainPassword_first').val();
    var mdpsecond = $('#procash_user_registration_plainPassword_second').val();
    if (mdp === mdpsecond) {
        $('#contenairmdpsecond').removeClass('has-error has-feedback');
        $('.afficherErreurPwdSec').addClass('hide');
        // $('.submitButton').attr("disabled", false);
        errPassVer = false;
    } else {
        $('#contenairmdpsecond').addClass('has-error has-feedback');
        if ($('.afficherErreurPwd').hasClass('hide')) {
            $('.afficherErreurPwdSec').removeClass('hide');
        }
        //  $('.submitButton').attr("disabled", true);
        errPassVer = true;
    }

});
var errPassVerChange = false;
$('#procash_user_registration_plainPassword_second').on('change', function () {
    var mdp = $('#procash_user_registration_plainPassword_first').val();
    var mdpsecond = $('#procash_user_registration_plainPassword_second').val();
    if (mdp === mdpsecond) {
        $('#contenairmdpsecond').removeClass('has-error has-feedback');
        $('.afficherErreurPwdSec').addClass('hide');
        //   $('.submitButton').attr("disabled", false);
        errPassVerChange = false;
    } else {
        $('#contenairmdpsecond').addClass('has-error has-feedback');
        if ($('.afficherErreurPwd').hasClass('hide')) {
            $('.afficherErreurPwdSec').removeClass('hide');
        }
        //  $('.submitButton').attr("disabled", true);
        errPassVerChange = true;
    }
});
var errPassSec = false;
$('#procash_user_registration_plainPassword_second').on('blur', function () {
    var mdp = $('#procash_user_registration_plainPassword_first').val();
    var mdpsecond = $('#procash_user_registration_plainPassword_second').val();
    if (mdp === mdpsecond) {
        $('#contenairmdpsecond').removeClass('has-error has-feedback');
        $('.afficherErreurPwdSec').addClass('hide');
        //  $('.submitButton').attr("disabled", false);
        errPassSec = false;
    } else {
        $('#contenairmdpsecond').addClass('has-error has-feedback');
        if ($('.afficherErreurPwd').hasClass('hide')) {
            $('.afficherErreurPwdSec').removeClass('hide');
        }
        //   $('.submitButton').attr("disabled", true);
        errPassSec = true;
    }
});

$('a.paginate_button ').on('click', function () {
    fnChangePage();
});
var fnChangePage = function () {
    $('[data-toggle="popover"]').popover();
    $('.pop').popover();
    $('.plus').popover();
    $('a.paginate_button ').on('click', function () {
        fnChangePage();
    });
};

if (modif == false) {
    $('.submitButton').attr("disabled", true);
//Désactiver bouton s'il existe des champs vides
    $('body').undelegate('#procash_user_registration_username', 'blur').delegate('#procash_user_registration_username', 'blur', function () {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_username', 'keyup').delegate('#procash_user_registration_username', 'keyup', function () {
        verifierChampVide();

    });
    $('body').undelegate('#procash_user_registration_username', 'change').delegate('#procash_user_registration_username', 'change', function () {
        verifierChampVide();
    });

    $('body').undelegate('#procash_user_registration_nom', 'blur').delegate('#procash_user_registration_nom', 'blur', function () {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_nom', 'keyup').delegate('#procash_user_registration_nom', 'keyup', function () {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_nom', 'change').delegate('#procash_user_registration_nom', 'change', function () {
        verifierChampVide();
    });


    $('body').undelegate('#procash_user_registration_prenom', 'blur').delegate('#procash_user_registration_prenom', 'blur', function () {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_prenom', 'keyup').delegate('#procash_user_registration_prenom', 'keyup', function () {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_prenom', 'change').delegate('#procash_user_registration_prenom', 'change', function () {
        verifierChampVide();
    });


    $('body').undelegate('#procash_user_registration_email', 'blur').delegate('#procash_user_registration_email', 'blur', function () {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_email', 'change').delegate('#procash_user_registration_email', 'change', function () {
        verifierChampVide();
    });


    $('body').undelegate('#selectProfil', 'blur').delegate('#selectProfil', 'blur', function () {
        verifierChampVide();
    });

    $('body').undelegate('#selectProfil', 'keyup').delegate('#selectProfil', 'keyup', function () {
        verifierChampVide();
    });
    $('body').undelegate('#selectProfil', 'change').delegate('#selectProfil', 'change', function () {
        verifierChampVide();
    });

    $('body').undelegate('select#selectReseau', 'change').delegate('select#selectReseau', 'change', function () {
        verifierChampVide();
    });

    $('body').undelegate('#procash_user_registration_plainPassword_first', 'blur').delegate('#procash_user_registration_plainPassword_first', 'blur', function () {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_plainPassword_first', 'keyup').delegate('#procash_user_registration_plainPassword_first', 'keyup', function () {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_plainPassword_first', 'change').delegate('#procash_user_registration_plainPassword_first', 'change', function () {
        verifierChampVide();
    });

    $('body').undelegate('#procash_user_registration_plainPassword_second', 'blur').delegate('#procash_user_registration_plainPassword_second', 'blur', function () {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_plainPassword_second', 'keyup').delegate('#procash_user_registration_plainPassword_second', 'keyup', function () {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_plainPassword_second', 'change').delegate('#procash_user_registration_plainPassword_second', 'change', function () {
        verifierChampVide();
    });


    function verifierChampVide() {
        if ($('input#procash_user_registration_username').val() == '' ||
                $('#procash_user_registration_nom').val() == '' ||
                $('#procash_user_registration_prenom').val() == '' ||
                $('#procash_user_registration_email').val() == '' ||
                $('#selectProfil').val() == '' ||
                $('#procash_user_registration_plainPassword_first').val() == '' ||
                $('#procash_user_registration_plainPassword_second').val() == '' || $('select#selectReseau').val() == '') {
            $('.submitButton').attr("disabled", true);
        } else {
            $('.submitButton').attr("disabled", false);
        }
    }
}
/*
$('#procash_user_registration_telephone').keypress(function (event) {
    if (event.which != 8 && isNaN(String.fromCharCode(event.which)) && event.keyCode != 43 && event.keyCode != 40 && event.keyCode != 41) {
        event.preventDefault(); //stop character from entering input
    }
});
$('#procash_user_registration_telephonePortable').keypress(function (event) {
    if (event.which != 8 && isNaN(String.fromCharCode(event.which)) && event.keyCode != 43 && event.keyCode != 40 && event.keyCode != 41 && event.keyCode != 45 && event.keyCode != 46 && event.keyCode != 32) {
        event.preventDefault(); //stop character from entering input
    }

});
*/

var fnVerificationTelephone = function (valeur) {
    if (/^(([+|0]*)([.|\-|\s]{0,1})[1-9]{1,3}([.|\-|\s]{0,1}[\d]{2,3}){4,5})$/.test(valeur)) {
        // Successful match

        var nbInt = valeur.trim().match(/\d/g).length;
        if (nbInt > 12) {
            return false;
        } else if (nbInt == 12 && (/^\+/.test(valeur))) {
            return false;
        } else if (nbInt == 11 && !(/^\+/.test(valeur))) {
            return false;
        } else if (nbInt <= 10 && (/^\+/.test(valeur))) {
            return false;
        } else if (nbInt < 10) {
            return false;
        } else if (nbInt == 12 && (/^\+/.test(valeur))) {
            return false;
        } else {
            return true;
            //vraie
        }
    } else if (/^\+\((\d{2,})\)\d(([\s|\.|\-]?)(\d{2})){4}$/.test(valeur)) {
        return true;
        //vraie
    } else {
        return false;
    }

};
/*
$('#procash_user_registration_telephone').keypress(function (event) {
    if (event.which != 8 && isNaN(String.fromCharCode(event.which)) && event.keyCode != 0 ) {
        event.preventDefault(); //stop character from entering input
    }

});
$('#procash_user_registration_telephonePortable').keypress(function (event) {
    if (event.which != 8 && isNaN(String.fromCharCode(event.which)) && event.keyCode != 0 ) {
        event.preventDefault(); //stop character from entering input
    }

});*/
var errorTel = false;
$('body').undelegate('#procash_user_registration_telephone', 'change').delegate('#procash_user_registration_telephone', 'change', function () {
    if ($(this).val().length > 0) {
        if (fnVerificationTelephone($(this).val())) {
            if (!$('div#erreurTelephone').hasClass('hide')) {
                $('div#erreurTelephone').addClass('hide');
                errorTel = false;
            }
        } else {
            $('div#erreurTelephone').removeClass('hide');
             errorTel = true;
        }
    } else {
        if (!$('div#erreurTelephone').hasClass('hide')) {
            $('div#erreurTelephone').addClass('hide');
        }
        errorTel = false;
    }
    if ($(this).val() === '') {
        if (!$('div#erreurTelephone').hasClass('hide')) {
            $('div#erreurTelephone').addClass('hide');
        }
         errorTel = false;
    }
});
$('body').undelegate('#procash_user_registration_telephone', 'blur').delegate('#procash_user_registration_telephone', 'blur', function () {
    if ($(this).val().length > 0) {
        if (fnVerificationTelephone($(this).val())) {
            if (!$('div#erreurTelephone').hasClass('hide')) {
                $('div#erreurTelephone').addClass('hide');
                errorTel = false;
            }
        } else {
            $('div#erreurTelephone').removeClass('hide');
             errorTel = true;
        }
    } else {
        if (!$('div#erreurTelephone').hasClass('hide')) {
            $('div#erreurTelephone').addClass('hide');
        }
        errorTel = false;
    }
    if ($(this).val() === '') {
        if (!$('div#erreurTelephone').hasClass('hide')) {
            $('div#erreurTelephone').addClass('hide');
        }
         errorTel = false;
    }
});
var errorTelPortable = false;
$('body').undelegate('#procash_user_registration_telephonePortable', 'change').delegate('#procash_user_registration_telephonePortable', 'change', function () {
    if ($(this).val().length > 0) {
        if (fnVerificationTelephone($(this).val())) {
            if (!$('div#erreurTelephonePortable').hasClass('hide')) {
                $('div#erreurTelephonePortable').addClass('hide');
                errorTelPortable = false;
            }
        } else {
            $('div#erreurTelephonePortable').removeClass('hide');
               errorTelPortable = true;
        }
    } else {
        if (!$('div#erreurTelephonePortable').hasClass('hide')) {
            $('div#erreurTelephonePortable').addClass('hide');
        }
        errorTelPortable = false;
    }
    if ($(this).val() === '') {
        if (!$('div#erreurTelephonePortable').hasClass('hide')) {
            $('div#erreurTelephonePortable').addClass('hide');
        }
        errorTelPortable = false;
    }
});
$('body').undelegate('#procash_user_registration_telephonePortable', 'blur').delegate('#procash_user_registration_telephonePortable', 'blur', function () {
    if ($(this).val().length > 0) {
        if (fnVerificationTelephone($(this).val())) {
            if (!$('div#erreurTelephonePortable').hasClass('hide')) {
                $('div#erreurTelephonePortable').addClass('hide');
                errorTelPortable = false;
            }
        } else {
            $('div#erreurTelephonePortable').removeClass('hide');
              errorTelPortable = true;
        }
    } else {
        if (!$('div#erreurTelephonePortable').hasClass('hide')) {
            $('div#erreurTelephonePortable').addClass('hide');
        }
        errorTelPortable = false;
    }
    if ($(this).val() === '') {
        if (!$('div#erreurTelephonePortable').hasClass('hide')) {
            $('div#erreurTelephonePortable').addClass('hide');
        }
        errorTelPortable = false;
    }
});

$('.submitButton').on('click', function () {
    fnVerifierMailExistant();
    if (erreurUserName) {
        $('input#procash_user_registration_username').focus();
    } else if (erreurMail || erreurMailEx) {
        $('input#procash_user_registration_email').focus();
    } else if (errorMotDePa || errorMoDePa || errorPassLength || errorPassLengthChange) {
        $('#procash_user_registration_plainPassword_second').val(null);
        $('#procash_user_registration_plainPassword_first').val(null);
        $('#procash_user_registration_plainPassword_first').focus();
        $('.afficherErreurPwdSec').addClass('hide');
        $('.afficherErreurPwd').removeClass('hide');
    } else if (errPassSec || errPassVer || errPassVerChange) {
        $('#procash_user_registration_plainPassword_second').val(null);
        $('#procash_user_registration_plainPassword_second').focus();
        if ($('.afficherErreurPwd').hasClass('hide')) {
            $('.afficherErreurPwdSec').removeClass('hide');
        }
    } else if (errorTel) {
            $('div#erreurTelephone').removeClass('hide');  
    } else if (errorTelPortable) {
         $('div#erreurTelephonePortable').removeClass('hide');
    } else {
        $('form').submit();
    }
});
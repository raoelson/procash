$('#procash_user_registration_plainPassword_first').removeAttr("required");
$('#procash_user_registration_plainPassword_second').removeAttr("required");
$('#password').hide();
$('#password').addClass("hidden");

if (modif) {
    $(".changeMdp").click(function() {
        if ($("#password").is(":visible")) {
            console.log('aaaaa');
            $("#password").hide();
            $("#procash_user_registration_plainPassword_first").removeAttr("required");
            $("#procash_user_registration_plainPassword_second").removeAttr("required");
            $(".procashFirst").val('');
            $("#procash_user_registration_plainPassword_second").val('');
            $("#procash_user_registration_plainPassword_first").val('');
            $('.afficherErreurPwdSec').addClass('hide');
            $('.afficherErreurPwd').addClass('hide');
            $("#lib").html("Changer mot de passe");
            $('#btnn').removeClass("dropup");
            $('#btnn').addClass("dropdown");
            $('#contenairMdp').removeClass('has-error has-feedback');
            $('#imgmdp').addClass('hide');
            $('#msg-erreur-mdp').addClass('hide');
            $('#valideBtn').removeClass('hidden');
            $('#grisBtn').addClass('hidden');
            // $('.submitButtonModif').attr("disabled", false);
            $("#password").removeClass("vissible");
        } else {
            // $('.submitButtonModif').attr("disabled", true);
            $("#procash_user_registration_plainPassword_second").val('');
            $("#procash_user_registration_plainPassword_first").val('');
            $("#password").show();
            $("#password").removeClass("hidden");
            $("#procash_user_registration_plainPassword_first").prop("required", true);
            $("#procash_user_registration_plainPassword_second").prop("required", true);
            $("#lib").html("Ne pas changer");
            $('#btnn').removeClass("dropdown");
            $('#btnn').addClass("dropup");
            $("#password").addClass("vissible");

            /*            $('body').undelegate('#procash_user_registration_plainPassword_first', 'blur').delegate('#procash_user_registration_plainPassword_first', 'blur', function () {
             verifierChampModif();
             });
             $('body').undelegate('#procash_user_registration_plainPassword_first', 'keyup').delegate('#procash_user_registration_plainPassword_first', 'keyup', function () {
             verifierChampModif();
             });
             $('body').undelegate('#procash_user_registration_plainPassword_first', 'change').delegate('#procash_user_registration_plainPassword_first', 'change', function () {
             verifierChampModif();
             });
             
             $('body').undelegate('#procash_user_registration_plainPassword_second', 'blur').delegate('#procash_user_registration_plainPassword_second', 'blur', function () {
             verifierChampModif();
             });
             $('body').undelegate('#procash_user_registration_plainPassword_second', 'keyup').delegate('#procash_user_registration_plainPassword_second', 'keyup', function () {
             verifierChampModif();
             });
             $('body').undelegate('#procash_user_registration_plainPassword_second', 'change').delegate('#procash_user_registration_plainPassword_second', 'change', function () {
             verifierChampModif();
             });
             */
            /* function verifierChampModif() {
             if ($("#password").hasClass("vissible") && $("#procash_user_registration_plainPassword_first").val() == '' || $("#procash_user_registration_plainPassword_second").val() == '') {
             $('.submitButtonModif').attr("disabled", true);
             } else {
             $('.submitButtonModif').attr("disabled", false);
             }
             }*/
        }
    });
}
else {
    $('.changeMdp').addClass('hidden');
    $("#password").show();
    $("#password").removeClass("hidden");
    $("div.containerMDP div:first").addClass('hidden');
    $("#procash_user_registration_plainPassword_first").prop("required", true);
    $("#procash_user_registration_plainPassword_second").prop("required", true);
}

$('.submitButtonModif').click(function() {
    fnVerifierMailExistant();
    if (erreurUserName) {
        $('input#proper_user_registration_username').focus();
    } else if (erreurMail || erreurMailEx) {
        $('input#proper_user_registration_email').focus();
    } else if ((errorMotDePa || errorMoDePa || errorPassLength || errorPassLengthChange) && ($("#password").is(":visible"))) {
        $('#proper_user_registration_plainPassword_second').val(null);
        $('#proper_user_registration_plainPassword_first').val(null);
        $('#proper_user_registration_plainPassword_first').focus();
        $('.afficherErreurPwdSec').addClass('hide');
        $('.afficherErreurPwd').removeClass('hide');
    } else if ((errPassSec || errPassVer || errPassVerChange) && ($("#password").is(":visible"))) {
        $('#proper_user_registration_plainPassword_second').val(null);
        $('#proper_user_registration_plainPassword_second').focus();
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

if (modif) {
    $('.submitButtonModif').attr("disabled", false);
//Désactiver bouton s'il existe des champs vides
    $('body').undelegate('#procash_user_registration_username', 'blur').delegate('#procash_user_registration_username', 'blur', function() {
        verifierChampVide();
    });
    /* $('body').undelegate('#procash_user_registration_username', 'keyup').delegate('#procash_user_registration_username', 'keyup', function () {
     verifierChampVide();
     
     });*/
    $('body').undelegate('#procash_user_registration_username', 'change').delegate('#procash_user_registration_username', 'change', function() {
        verifierChampVide();
    });

    $('body').undelegate('#procash_user_registration_nom', 'blur').delegate('#procash_user_registration_nom', 'blur', function() {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_nom', 'keyup').delegate('#procash_user_registration_nom', 'keyup', function() {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_nom', 'change').delegate('#procash_user_registration_nom', 'change', function() {
        verifierChampVide();
    });


    $('body').undelegate('#procash_user_registration_prenom', 'blur').delegate('#procash_user_registration_prenom', 'blur', function() {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_prenom', 'keyup').delegate('#procash_user_registration_prenom', 'keyup', function() {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_prenom', 'change').delegate('#procash_user_registration_prenom', 'change', function() {
        verifierChampVide();
    });

    $('body').undelegate('#procash_user_registration_email', 'blur').delegate('#procash_user_registration_email', 'blur', function() {
        verifierChampVide();
    });
    /* $('body').undelegate('#procash_user_registration_email', 'keyup').delegate('#procash_user_registration_email', 'keyup', function () {
     verifierChampVide();
     });*/
    $('body').undelegate('#procash_user_registration_email', 'change').delegate('#procash_user_registration_email', 'change', function() {
        verifierChampVide();
    });

    $('body').undelegate('#selectProfil', 'blur').delegate('#selectProfil', 'blur', function() {
        verifierChampVide();
    });
    $('body').undelegate('#selectProfil', 'keyup').delegate('#selectProfil', 'keyup', function() {
        verifierChampVide();
    });
    $('body').undelegate('#selectProfil', 'change').delegate('#selectProfil', 'change', function() {
        verifierChampVide();
    });

    $('body').undelegate('#selectReseau', 'change').delegate('#selectReseau', 'change', function() {
        verifierChampVide();
    });

    $('body').undelegate('#procash_user_registration_plainPassword_first', 'blur').delegate('#procash_user_registration_plainPassword_first', 'blur', function() {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_plainPassword_first', 'keyup').delegate('#procash_user_registration_plainPassword_first', 'keyup', function() {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_plainPassword_first', 'change').delegate('#procash_user_registration_plainPassword_first', 'change', function() {
        verifierChampVide();
    });

    $('body').undelegate('#procash_user_registration_plainPassword_second', 'blur').delegate('#procash_user_registration_plainPassword_second', 'blur', function() {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_plainPassword_second', 'keyup').delegate('#procash_user_registration_plainPassword_second', 'keyup', function() {
        verifierChampVide();
    });
    $('body').undelegate('#procash_user_registration_plainPassword_second', 'change').delegate('#procash_user_registration_plainPassword_second', 'change', function() {
        verifierChampVide();
    });

    function verifierChampVide() {
        if ($('input#procash_user_registration_username').val() == '' ||
                $('#procash_user_registration_nom').val() == '' ||
                $('#procash_user_registration_prenom').val() == '' ||
                $('#procash_user_registration_email').val() == '' ||
                $('#selectProfil').val() == '' || $('#selectReseau').val() == '' || errorTelPortable == true || errorTel == true) {
            $('.submitButtonModif').attr("disabled", true);
        } else {
            $('.submitButtonModif').attr("disabled", false);
        }
    }
    verifierChampVide();
}
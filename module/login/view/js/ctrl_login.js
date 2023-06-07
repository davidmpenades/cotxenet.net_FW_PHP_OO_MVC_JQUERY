///////////////////////////////////////REGISTER/////////////////////////////////////////////////////////////////
function register() {
  if (validate_register() != 0) {
    let data = $("#register__form").serialize();
    ajaxPromise(friendlyURL("?module=login&op=register"), "POST", "JSON", data)
      .then(function (result) {
        if (result == "error_email") {
          document.getElementById("error_email_reg").innerHTML =
            "El email ya esta en uso, asegurate de no tener ya una cuenta";
        } else if (result == "error_user") {
          document.getElementById("error_username_reg").innerHTML =
            "El usuario ya esta en uso, intentalo con otro";
        } else {
          toastr.success("Registery succesfully");
          toastr.success("Sended email");

          // setTimeout(' window.location.href = "index.php?module=ctrl_login&op=login-register_view"; ', 1000);
          // $(document).style('background: green');
          // window.location.reload();
          $("#jump").click();
          $("#username_reg").val("");
          $("#email_reg").val("");
          $("#passwd1_reg").val("");
          $("#passwd2_reg").val("");
        }
      })
      .catch(function (textStatus) {
        // if (console && console.log) {
        console.log("La solicitud ha fallado: " + textStatus);
        // }
      });
  }
}

function key_register() {
  $("#register").keypress(function (e) {
    var code = e.keyCode ? e.keyCode : e.which;
    if (code == 13) {
      e.preventDefault();
      register();
    }
  });
}

function button_register() {
  $("#register").on("click", function (e) {
    e.preventDefault();
    register();
  });
}

function validate_register() {
  var username_exp = /^[a-zA-Z0-9](?!.*__)[a-zA-Z0-9_]{4,18}[a-zA-Z0-9]$/;
  var mail_exp = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
  var pssswd_exp =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%&*])[A-Za-z\d!@#$%&*]{8,20}$/;
  var error = false;

  if (document.getElementById("username_reg").value.length === 0) {
    document.getElementById("error_username_reg").innerHTML =
      "Tienes que escribir el usuario";
    error = true;
  } else {
    if (document.getElementById("username_reg").value.length < 5) {
      document.getElementById("error_username_reg").innerHTML =
        "El username tiene que tener 5 caracteres como minimo";
      error = true;
    } else {
      if (!username_exp.test(document.getElementById("username_reg").value)) {
        document.getElementById("error_username_reg").innerHTML =
          "No se pueden poner caracteres especiales";
        error = true;
      } else {
        document.getElementById("error_username_reg").innerHTML = "";
      }
    }
  }

  if (document.getElementById("email_reg").value.length === 0) {
    document.getElementById("error_email_reg").innerHTML =
      "Tienes que escribir un correo";
    error = true;
  } else {
    if (!mail_exp.test(document.getElementById("email_reg").value)) {
      document.getElementById("error_email_reg").innerHTML =
        "El formato del mail es invalido";
      error = true;
    } else {
      document.getElementById("error_email_reg").innerHTML = "";
    }
  }

  if (document.getElementById("passwd1_reg").value.length === 0) {
    document.getElementById("error_passwd1_reg").innerHTML =
      "Tienes que escribir la contraseña";
    error = true;
  } else {
    if (document.getElementById("passwd1_reg").value.length < 8) {
      document.getElementById("error_passwd1_reg").innerHTML =
        "La password tiene que tener 8 caracteres como minimo";
      error = true;
    } else {
      if (!pssswd_exp.test(document.getElementById("passwd1_reg").value)) {
        document.getElementById("error_passwd1_reg").innerHTML =
          "Debe de contener minimo 8 caracteres, mayusculas, minusculas y simbolos especiales";
        error = true;
      } else {
        document.getElementById("error_passwd1_reg").innerHTML = "";
      }
    }
  }

  if (document.getElementById("passwd2_reg").value.length === 0) {
    document.getElementById("error_passwd2_reg").innerHTML =
      "Tienes que repetir la contraseña";
    error = true;
  } else {
    if (document.getElementById("passwd2_reg").value.length < 8) {
      document.getElementById("error_passwd2_reg").innerHTML =
        "La password tiene que tener 8 caracteres como minimo";
      error = true;
    } else {
      if (
        document.getElementById("passwd2_reg").value ===
        document.getElementById("passwd1_reg").value
      ) {
        document.getElementById("error_passwd2_reg").innerHTML = "";
      } else {
        document.getElementById("error_passwd2_reg").innerHTML =
          "La password's no coinciden";
        error = true;
      }
    }
  }

  if (error == true) {
    return 0;
  }
}
///////////////////////////////////////LOGIN//////////////////////////////////////////////////////////////
function login() {
  if (validate_login() != 0) {
    var data = $("#login__form").serialize();
    ajaxPromise(friendlyURL("?module=login&op=login"), "POST", "JSON", data)
      .then(function (result) {
        if (result == "error_user") {
          document.getElementById("error_username_log").innerHTML =
            "El usario no existe,asegurase de que lo a escrito correctamente";
        } else if (result == "error_passwd") {
          document.getElementById("error_passwd_log").innerHTML =
            "La contraseña es incorrecta";
        } else if (result == "activate error") {
          toastr.options.timeOut = 3000;
          toastr.error("Verify the email");
        } else {
          localStorage.setItem("token", result);
          toastr.success("Loged succesfully");
          let redirect = localStorage.getItem("redirect_like");

          if (redirect) {
            window.location.href = friendlyURL("?module=shop");
          } else {
            window.location.href = friendlyURL("?module=home");
          }
        }
      })
      .catch(function (textStatus) {
        if (console && console.log) {
          console.log("La solicitud ha fallado: " + textStatus);
        }
      });
  }
}

function key_login() {
  $("#login").keypress(function (e) {
    var code = e.keyCode ? e.keyCode : e.which;
    if (code == 13) {
      e.preventDefault();
      login();
    }
  });
  $("#forget_pass").keypress(function (e) {
    var code = e.keyCode ? e.keyCode : e.which;
    if (code == 13) {
      e.preventDefault();
      load_form_recover_password();
    }
  });
}

function button_login() {
  $("#login").on("click", function (e) {
    e.preventDefault();
    login();
  });
  $("#forget_pass").on("click", function (e) {
    e.preventDefault();
    load_form_recover_password();
  });
  $("#google").on("click", function (e) {
    social_login("google");
  });

  $("#github").on("click", function (e) {
    social_login("github");
  });
}

function validate_login() {
  var error = false;

  if (document.getElementById("username_log").value.length === 0) {
    document.getElementById("error_username_log").innerHTML =
      "Tienes que escribir el usuario";
    error = true;
  } else {
    if (document.getElementById("username_log").value.length < 5) {
      document.getElementById("error_username_log").innerHTML =
        "El usuario tiene que tener 5 caracteres como minimo";
      error = true;
    } else {
      document.getElementById("error_username_log").innerHTML = "";
    }
  }

  if (document.getElementById("passwd_log").value.length === 0) {
    document.getElementById("error_passwd_log").innerHTML =
      "Tienes que escribir la contraseña";
    error = true;
  } else {
    document.getElementById("error_passwd_log").innerHTML = "";
  }

  if (error == true) {
    return 0;
  }
}
//////////////////////////////////////////////SOCIAL LOGIN/////////Necesita Revisar///////////////////////////////////////////////
// function social_login(param) {
//   authService = firebase_config();
//   authService
//     .signInWithPopup(provider_config(param))
//     .then(function (result) {
//       console.log("Hemos autenticado al usuario ", result.user);
//       // console.log(result.user.email);
//       email_name = result.user.email;
//       let username = email_name.split("@");
      // console.log(username[0]);
      // console.log(result.user.email);
    //   social_user = {
    //     id: result.user.uid,
    //     username: username[0],
    //     email: result.user.email,
    //     avatar: result.user.photoURL,
    //   };
    //   // console.log(social_user);

    //   if (social_user) {
    //     ajaxPromise(
    //       friendlyURL("?module=login&op=social_login"),
    //       "POST",
    //       "JSON",
    //       social_user
    //     )
    //       .then(function (data) {
    //         console.log(data);
    //         localStorage.setItem("token", data);
    //         toastr.options.timeOut = 3000;
    //         toastr.success("Inicio de sesión realizado");
    //         if (localStorage.getItem("redirect_like") == null) {
    //           setTimeout(
    //             'window.location.href = friendlyURL("?module=home")',
    //             1000
    //           );
    //         } else {
    //           console.log(localStorage.getItem("redirect_like"));
    //           setTimeout(
    //             'window.location.href = friendlyURL("?module=shop")',
    //             1000
    //           );
    //         }
    //       })
    //       .catch(function () {
    //         console.log("Error: Social login error");
    //       });
    //   }
    // })
    // .catch(function (error) {
    //   var errorCode = error.code;
    //   console.log(errorCode);
    //   var errorMessage = error.message;
    //   console.log(errorMessage);
    //   var email = error.email;
    //   console.log(email);
    //   var credential = error.credential;
    //   console.log(credential);
    // });
// }
// function firebase_config() {
//   var config = {
//     apiKey: "",
//     authDomain: "test-.firebaseapp.com",
//     projectId: "test-",
//     storageBucket: "test-.appspot.com",
//     messagingSenderId: "",
//     appId: "1:495514694215:web:b183cd7f513ce8b0d6f762",
//     measurementId: "G-JXEGLTGLTC",
//   };
//   if (!firebase.apps.length) {
//     firebase.initializeApp(config);
//   } else {
//     firebase.app();
//   }
//   return (authService = firebase.auth());
// }
// function provider_config(param){
//   if(param === 'google'){
//       var provider = new firebase.auth.GoogleAuthProvider();
//       provider.addScope('email');
//       return provider;
//   }else if(param === 'github'){
//       return provider = new firebase.auth.GithubAuthProvider();
//   }
// }
///////////////////////////////////////LOAD CONTENT//////////////////////////////////////////////////////////////
function load_content() {
  let path = window.location.pathname.split("/");
  if (path[4] === "recover") {
    localStorage.setItem("token_email", path[5]);
    load_form_new_password();
  } else if (path[4] === "verify") {
    ajaxPromise(friendlyURL("?module=login&op=verify_email"), "POST", "JSON", {
      token_email: path[5],
    })
      .then(function (data) {
        toastr.options.timeOut = 3000;
        toastr.success("Email verified");
        setTimeout('window.location.href = friendlyURL("?module=login")', 1000);
      })
      .catch(function () {
        console.log("Error: verify email error");
      });
  } else if (path[4] === "view") {
    $(".login-wrap").show();
    $(".forget_html").hide();
  } else if (path[4] === "recover_view") {
    load_form_new_password();
  }
}
/////////////////////////////////// RECOVER PASSWORD//////////////////////////////////////////////////////////////
function load_form_recover_password() {
  $(".main").hide();
  $(".forget_html").show();
  $("html, body").animate({ scrollTop: $(".forget_html") });
  click_recover_password();
}
function click_recover_password() {
  $("#forget_html").keypress(function (e) {
    var code = e.keyCode ? e.keyCode : e.which;
    if (code == 13) {
      e.preventDefault();
      send_recover_password();
    }
  });
  $("#button_recover").on("click", function (e) {
    e.preventDefault();
    send_recover_password();
  });
}
function validate_recover_password() {
  var mail_exp = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
  var error = false;

  if (document.getElementById("email_forg").value.length === 0) {
    document.getElementById("error_email_forg").innerHTML =
      "Tienes que escribir un correo";
    error = true;
  } else {
    if (!mail_exp.test(document.getElementById("email_forg").value)) {
      document.getElementById("error_email_forg").innerHTML =
        "El formato del mail es invalido";
      error = true;
    } else {
      document.getElementById("error_email_forg").innerHTML = "";
    }
  }

  if (error == true) {
    return 0;
  }
}
function send_recover_password() {
  if (validate_recover_password() != 0) {
    let data = $("#recover_email_form").serialize();
    ajaxPromise(
      friendlyURL("?module=login&op=send_recover_email"),
      "POST",
      "JSON",
      data
    )
      .then(function (data) {
        if (data == "error") {
          $("#error_email_forg").html("The email doesn't exist");
        } else {
          toastr.options.timeOut = 3000;
          toastr.success("Email sended");
          setTimeout(
            'window.location.href = friendlyURL("?module=login")',
            1000
          );
        }
      })
      .catch(function () {
        console.log("Error: Recover password error");
      });
  }
}
function load_form_new_password() {
  token_email = localStorage.getItem("token_email");
  localStorage.removeItem("token_email");
  ajaxPromise(friendlyURL("?module=login&op=verify_token"), "POST", "JSON", {
    token_email: token_email,
  })
    .then(function (data) {
      if (data == "ok") {
        console.log("verified");
        click_new_password(token_email);
      } else {
        console.log("error");
      }
    })
    .catch(function (textStatus) {
      console.log("Error: Verify token error");
    });
}
function click_new_password(token_email) {
  $(".recover_html").keypress(function (e) {
    var code = e.keyCode ? e.keyCode : e.which;
    if (code == 13) {
      e.preventDefault();
      send_new_password(token_email);
    }
  });

  $("#button_set_pass").on("click", function (e) {
    e.preventDefault();
    send_new_password(token_email);
  });
}
function validate_new_password() {
  var error = false;

  if (document.getElementById("pass_rec").value.length === 0) {
    document.getElementById("error_password_rec").innerHTML =
      "You have to write a password";
    error = true;
  } else {
    if (document.getElementById("pass_rec").value.length < 8) {
      document.getElementById("error_password_rec").innerHTML =
        "The password must be longer than 8 characters";
      error = true;
    } else {
      document.getElementById("error_password_rec").innerHTML = "";
    }
  }

  if (
    document.getElementById("pass_rec_2").value !=
    document.getElementById("pass_rec").value
  ) {
    document.getElementById("error_password_rec_2").innerHTML =
      "Passwords don't match";
    error = true;
  } else {
    document.getElementById("error_password_rec_2").innerHTML = "";
  }

  if (error == true) {
    return 0;
  }
}
function send_new_password(token_email) {
  if (validate_new_password() != 0) {
    var data = { token_email: token_email, password: $("#pass_rec").val() };
    ajaxPromise(
      friendlyURL("?module=login&op=new_password"),
      "POST",
      "JSON",
      data
    )
      .then(function (data) {
        if (data == "done") {
          toastr.options.timeOut = 3000;
          toastr.success("New password changed");
          setTimeout(
            'window.location.href = friendlyURL("?module=login")',
            1000
          );
        } else {
          toastr.options.timeOut = 3000;
          toastr.error("Error seting new password");
        }
      })
      .fail(function (textStatus) {
        console.log("Error: New password error");
      });
  }
}

$(function () {
  $(".mx-n2").remove();
  $(".forget_html").hide();
  $(".fa-cart-shopping").hide();
  $(".navbar-inverse").hide();
  $("#footer-sec").hide();
  load_content();
  key_register();
  button_register();
  key_login();
  button_login();
});

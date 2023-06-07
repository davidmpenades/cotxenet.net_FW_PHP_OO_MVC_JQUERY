function protecturl() {
    var token = localStorage.getItem('token');
    ajaxPromise(friendlyURL('?module=login&op=controluser'), 'POST', 'JSON', { 'token': token })
        .then(function(data) {
            if (data == "Correct_User") {
                console.log("CORRECTO-->El usario coincide con la session");
            } else if (data == "Wrong_User") {
                console.log("INCORRCTO-->Peligro estan intentando acceder a una cuenta");
                logout_auto();
            }
        }).catch(function() { console.log("ANONYMOUS_user") });
}

function control_activity() {
    var token = localStorage.getItem('token');
    if (token) {
        ajaxPromise(friendlyURL('?module=login&op=actividad'), 'POST', 'JSON')
            .then(function(response) {
                if (response == "inactivo") {
                    console.log("usuario INACTIVO");
                    logout_auto();
                } else {
                    console.log("usuario ACTIVO")
                }
            }).catch(function() { console.log("Error Control_activity") });
    }else {
        console.log("No hay usario logeado");
    }

}

function refresh_token() {
    var token = localStorage.getItem('token');
    if (token) {
        ajaxPromise(friendlyURL('?module=login&op=refresh_token'), 'POST', 'JSON', { 'token': token })
            .then(function(data_token) {
                // console.log(data_token);
                if (data_token == 'error') {
                    logout_auto();
                }else{
                    localStorage.setItem("token", data_token);
                    // load_menu();
                }
            }).catch(function() { console.log("Error Refresh Token") });
    }

}

function refresh_cookie() {
    ajaxPromise(friendlyURL('?module=login&op=refresh_cookie'), 'POST', 'JSON')
        .then(function(response) {
            console.log("Refresh cookie correctly");
        }).catch(function() { console.log("Error Refresh Coookie") });
}

function logout_auto() {
    ajaxPromise('?module=login&op=logout', 'POST', 'JSON')
    .then(function(data) {
        localStorage.removeItem('token');
        toastr.warning("Se ha cerrado la cuenta por seguridad!!");
    }).catch(function() {
        console.log('Something has occured');
    });
    setTimeout('window.location.href = "?module=home&op=view";', 2000);
}

$(function() {
    control_activity();
    protecturl();
    setInterval(function() { refresh_token() }, 600000);
    setInterval(function() { refresh_cookie() },600000);
});
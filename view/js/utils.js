/* AJAX PROMISE */
function ajaxPromise(sUrl, sType, sTData, sData = undefined) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData
        }).done((data) => {
            resolve(data);
        }).fail((jqXHR, textStatus, errorThrow) => {
            reject(errorThrow);
        }); 
    });
}

/* FRIENDLY URL */
function friendlyURL(url) {
    var link = "";
    url = url.replace("?", "");
    url = url.split("&");
    cont = 0;
    for (var i = 0; i < url.length; i++) {
    	cont++;
        var aux = url[i].split("=");
        if (cont == 2) {
        	link += "/" + aux[1] + "/";	
        }else{
        	link += "/" + aux[1];
        }
    }
    return "http://localhost/cotxenet.net_FW_PHP_OO_MVC_JQUERY" + link;
}

/* Loading Spinner */
// function loading_spinner() {
//     window.onload = function(){
//         var contenedor = document.getElementById('contenedor_carga');

//         contenedor.style.visibility = "hidden";
//         contenedor.style.opacity = '0';
//     }
// }

/* LOAD MENU */
function load_menu() {
    $('.navbar-nav').append(
        '<li><a href="'+friendlyURL("?module=home") + '">HOME</a></li>' +
        '<li><a href="'+friendlyURL("?module=shop") + '">SHOP</a></li>' +
        '<li><a href="'+friendlyURL("?module=contact") + '">CONTACT</a></li>' + 
        '<li><a href="'+friendlyURL("?module=login") + '">LOGIN</a></li>' +
        '<li><a href="'+friendlyURL("?module=cart") + '"><i class="fa-solid fa-cart-shopping fa-2xl"></i></li>' +
        '<li><div id="user_info"></div></li>'+
        '<li><div  class="log-icon" ></div></li>'
    );
    let token = localStorage.getItem('token');
    if (token) {
        ajaxPromise(friendlyURL('?module=login&op=data_user'), 'POST', 'JSON',  {'token':token} )
            .then(function(data) {
                let res = data[0];
                    // Si el token existe en localStorage, mostrar los divs para usuario logueado
                    $('#button_login').hide();
                    $('#button_login').empty();
                    $('.log-icon').empty();
                    $('#user_info').empty();
                    $('<img style="width:40px; border-radius:6px" src="' + res.avatar + '"alt="Robot">').appendTo('.log-icon');
                    $('<p></p>').attr({ 'id': 'user_info' }).appendTo('#user_info')
                        .html(
                            '<a>' + res.username + '<a/>'  +
                            '<a id="logout"><i class="fa fa-sign-out">LOGOUT</i></a>'                                                       
                        );
                        
            }).catch(function() {
                console.log("Error al cargar los datos del user");
            });
    } else {
        console.log("No hay token disponible");
        $('.opc_CRUD').empty();
        $('.opc_exceptions').empty();
        $('#user_info').empty();
        $('#user_info').hide();
        $('.log-icon').empty();
        $('.log-icon').hide();
        $('#button_cart').hide();
        $('.buy').hide();
        $('.add').hide();
        $('<a href="index.php?module=ctrl_login&op=login-register_view"><i id="col-ico" class="fa-solid fa-user fa-2xl"></i></a>').appendTo('.log-icon');
    }
}

/* MENUS */

function menu_client() {
    $('<li></li>').attr('class', 'profile').attr('id', 'profile').html('<a id="profile" class="nav_link" data-tr="Profile">Profile</a>').appendTo('.nav_list');
}

/* CLICK PROFILE */
function click_profile(data) {
    $(document).on('click', '#profile', function() {
        $(".profile_options").remove();
        $('<div></div>').attr('class', 'profile_options').attr('id', 'profile_options').appendTo('.nav_list_profile')
        .html(
            "<ul class='profile_list' id='profile_list'>" +
                "<li><div class='user'>" +
                "<div class='user_img'><img class='avatar_img' src='" + data.avatar + "'></div>" + 
                "<div class='user_name'>" + data.username + "</div></li>" +
                "<li><div id='logout' class='logout' data-tr='Log out'>Log out</div></li>" +
            "</ul>"
        )
    });
    $(document).on('click scroll', function(event) {
        if (event.target.id !== 'profile') {
            $('.profile_options').fadeOut(500);
        }
    });
}
function click_logout() {
    $(document).on('click', '#logout', function() {
        localStorage.removeItem('total_prod');
        toastr.success("Logout succesfully");
        setTimeout('logout(); ', 1000);
    });
}

//================LOG-OUT================
function logout() {
    ajaxPromise(friendlyURL('?module=login&op=logout'), 'POST', 'JSON')
        .then(function(data) {
        if(data === 'done'){
            localStorage.removeItem('token');
             window.location.href = "?module=home&op=view"; 
        }else{
            console.log('Something has occured 1');

        }
        }).catch(function() {
            console.log('Something has occured');
        });
}

$(function() {
    load_menu();
    click_logout();
    // loading_spinner();
});
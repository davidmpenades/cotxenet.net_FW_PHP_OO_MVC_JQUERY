function check_email() {

		var pcontact_name = /^[a-zA-Z]+[\-'\s]?[a-zA-Z]{2,51}$/;
	    var pmessage = /^[0-9A-Za-z\s]{10,1000}$/;
    	var pmail = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
		var error = false;
	
		if(document.getElementById('contact_name').value.length === 0){
			document.getElementById('error_contact_name').innerHTML = "Escriba su nombre, por favor";
			error = true;
		}else{
			if(!pcontact_name.test(document.getElementById('contact_name').value)){
				document.getElementById('error_contact_name').innerHTML = "El nombre tiene que tener mas de 3 caracteres"; 
				error = true;
			}else{
				document.getElementById('error_contact_name').innerHTML = "";
			}
		}
	
		if(document.getElementById('contact_email').value.length === 0){
			document.getElementById('error_contact_email').innerHTML = "Escriba su email.";
			error = true;
		}else{
			if(!pmail.test(document.getElementById('contact_email').value)){
				document.getElementById('error_contact_email').innerHTML = "El formato del email invalido."; 
				error = true;
			}else{
				document.getElementById('error_contact_email').innerHTML = "";
			}
		}

		if (document.getElementById('matter').value === "Seleccione un asunto" ) {
			document.getElementById('error_matter').innerHTML = "Por favor, seleccione un asunto.";
			error = true;
		}else{
			document.getElementById('error_matter').innerHTML = "";
		}
	
		if(document.getElementById('message').value.length === 0){
			document.getElementById('error_message').innerHTML = "Debe escribir un mensaje.";
			error = true;
		}else{
			if(!pmessage.test(document.getElementById('message').value)){
				document.getElementById('error_message').innerHTML = "El mensaje debe ser superior a 20 caracteres."; 
				error = true;
			}else{
				document.getElementById('error_message').innerHTML = "";
			}
		}
		
		if(error == true){
			return 0;
		} 
}

function click_contact(){

	$("#contact_form").keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code == 13){
        	e.preventDefault();
            send();
        }
    });

	$('#send_contact').on('click', function(e) {
        e.preventDefault();
        send();
    }); 
}

function send(){
    if(check_email() != 0){
		send_email({name:$("#contact_name").val(), email:$("#contact_email").val(), matter:$("#matter").val(), message:$("#message").val()});
	}
}

function send_email(content_email) {
	ajaxPromise(friendlyURL("?module=contact&op=send_contact_us"), 'POST', 'JSON', content_email)
	.then(function (data) {
		toastr.success('Email sended');
	}).catch(function(data) {
		console.log('Error: send contact us error');
	});
}

$(function(){
    $(".mx-n2").remove();
	click_contact()
});
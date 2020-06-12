let username;
let email;
let pwd;

let clearLoginErrors = function() {
	username = document.querySelector('#login-username');
	if (username.classList.contains('is-invalid')) {
		username.classList.remove('is-invalid');
	}
	let pwd = document.querySelector('#login-pwd');
	if (pwd.classList.contains('is-invalid')) {
		pwd.classList.remove('is-invalid');
	}
	document.querySelector("#login-feedback").innerHTML = "";
};

let clearRegisterErrors = function() {
	email = document.querySelector('#register-email');
	if (email.classList.contains('is-invalid')) {
		email.classList.remove('is-invalid');
	}
	username = document.querySelector('#register-username');
	if (username.classList.contains('is-invalid')) {
		username.classList.remove('is-invalid');
	}
	pwd = document.querySelector('#register-pwd');
	if (pwd.classList.contains('is-invalid')) {
		pwd.classList.remove('is-invalid');
	}
	document.querySelector("#register-feedback").innerHTML = "";
};

document.querySelector('#login-form').onsubmit = function(e){
	e.preventDefault();
	// client-side validation
	clearLoginErrors();
	let error = false;
	let input1 = document.querySelector('#login-username');
	let input2 = document.querySelector('#login-pwd');
	if (input1.value.trim().length == 0) {
		input1.classList.add('is-invalid');
		error = true;
	}
	if (input2.value.trim().length == 0) {
		input2.classList.add('is-invalid');
		error = true;
	}
	if (!error) {
		ajaxPost("login/login_validate.php",
			"username=" + input1.value.trim() +
			"&password=" + input2.value.trim(),
			function() {
				window.location.href = "codi.php";
			},
			function(text) {
				document.querySelector("#login-feedback").innerHTML = text;
			}
		);
	}
};

document.querySelector('#register-form').onsubmit = function(e){
	e.preventDefault();
	// client-side validation
	clearRegisterErrors();
	let error = false;
	let input1 = document.querySelector('#register-email');
	let input2 = document.querySelector('#register-username');
	let input3 = document.querySelector('#register-pwd');
	if (input1.value.trim().length == 0) {
		input1.classList.add('is-invalid');
		error = true;
	}
	if (input2.value.trim().length == 0 ) {
		input2.classList.add('is-invalid');
		error = true;
	}
	if (input3.value.trim().length == 0 ) {
		input3.classList.add('is-invalid');
		error = true;
	}
	if (!error) {
		ajaxPost("login/register_validate.php",
			"email=" + input1.value.trim() +
			"&username=" + input2.value.trim() +
			"&password=" + input3.value.trim(),
			function() {
				window.location.href = "codi.php";
			},
			function(text) {
				document.querySelector("#register-feedback").innerHTML = text;
			}
		);
	}
};

// must use jquery to capture onclose event of bootstrap modal
$(document).ready(function() {
	$('#loginModal').on('hide.bs.modal', function(e) {
	  clearLoginErrors();
	  //clear previous input
	  document.querySelector('#login-username').value = "";
	  document.querySelector('#login-pwd').value = "";
	});

	$('#registerModal').on('hide.bs.modal', function(e) {
	  clearRegisterErrors();
	  //clear previous input
	  document.querySelector('#register-email').value = "";
	  document.querySelector('#register-username').value = "";
	  document.querySelector('#register-pwd').value = "";
	});
});

function ajaxPost(endpointUrl, postData, okFunction, errorFunction){
	let xhr = new XMLHttpRequest();
	xhr.open('POST', endpointUrl, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if (xhr.readyState == XMLHttpRequest.DONE) {
			if (xhr.status == 200) {
				if (xhr.responseText.trim().length > 0) {
					errorFunction(xhr.responseText);
				}
				else {
					okFunction();
				}
			} else {
				// alert('AJAX Error.');
				// console.log(xhr.status);
			}
		}
	}
	xhr.send(postData);
};
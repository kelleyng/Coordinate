let input1 = document.querySelector('#current-pwd');
let input2 = document.querySelector('#new-pwd');
let photo = document.querySelectorAll(".photo-col");
for(let i = 0; i < photo.length; i++) {
	photo[i].onclick = function() {
		if (confirm('Are you sure you want to delete?')) {
			ajaxGet("closet_delete.php?path=" + encodeURI(photo[i].firstElementChild.firstElementChild.getAttribute('src')), function(result) {
				photo[i].parentElement.removeChild(photo[i]);
			});
		}
	};
}

document.querySelector("#update-form").onsubmit = function(e) {
	e.preventDefault();
	//clear previous errors
	if (input1.classList.contains('is-invalid')) {
		input1.classList.remove('is-invalid');
	}
	if (input2.classList.contains('is-invalid')) {
		input2.classList.remove('is-invalid');
	}
	document.querySelector("#pwd-error").innerHTML = "";

	let error = false;
	
	if (input1.value.trim().length == 0) {
		input1.classList.add('is-invalid');
		error = true;
	}
	if (input2.value.trim().length == 0) {
		input2.classList.add('is-invalid');
		error = true;
	}
	if (!error) {
		ajaxPost("login/update_password.php",
			"current=" + input1.value.trim() +
			"&new=" + input2.value.trim(),
			function() {
				document.querySelector("#pwd-success").innerHTML = "successfully changed password";
			},
			function(text) {
				document.querySelector("#pwd-error").innerHTML = text;
			}
		);
	}
	input1.value = "";
	input2.value = "";
};

function ajaxGet(endpointUrl, returnFunction){
	let xhr = new XMLHttpRequest();
	xhr.open('GET', endpointUrl, true);
	xhr.onreadystatechange = function(){
		if (xhr.readyState == XMLHttpRequest.DONE) {
			if (xhr.status == 200) {
				// When a success response is returned from the server
				returnFunction( xhr.responseText );
			} else {
				// alert('AJAX Error.');
				// console.log(xhr.status);
			}
		}
	}
	xhr.send();
};

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
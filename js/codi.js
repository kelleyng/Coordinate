let boxes = document.querySelectorAll(".color-box");
for(let i = 0; i < boxes.length; i++) {
	boxes[i].style.backgroundColor = boxes[i].dataset.hex;
	if (boxes[i].dataset.hex === "#534D56") {
		boxes[i].style.border = "solid 1px black";
	}
	boxes[i].onclick = function() {
		if (boxes[i].classList.contains('picked')) {
			boxes[i].classList.remove('picked');
		}
		else {
			boxes[i].classList.add('picked');
		}
	};
}

document.querySelector("#search-button").onclick = function(e) {
	e.preventDefault();
	//clear error message
	document.querySelector("#result-error").innerHTML = "";
	
	//color selection
	let string = "";
	for(let i = 0; i < boxes.length; i++) {
		if (boxes[i].classList.contains('picked')) {
			string += (boxes[i].dataset.id + '+');
		}
	}

	string = string.substring(0, string.length-1);

	let category = document.querySelector("#categoryInput").value;
	let str = "codi_search.php?category=" + category + "&colors=" + string;
	ajaxGet("codi_search.php?category=" + category + "&colors=" + string, function(results) {
		let resultContainer = document.querySelector("#result-photos");
		//clear all the previous results on every search
		while(resultContainer.hasChildNodes()) {
			resultContainer.removeChild(resultContainer.lastChild);
		}
			
		try {
			results = JSON.parse(results);

			let pickContainer = document.querySelector("#picked-photos");
			results.forEach(function(elem) {
			  let div = document.createElement("div");
				div.classList.add("col-6", "col-sm-4", "col-md-3", "col-xl-2");
				//on click, show at top
				div.onclick = function() {
					let div2 = document.createElement("div");
					div2.classList.add("col-6", "col-sm-4", "col-md-3", "col-xl-2", "photo-col");
					div2.onclick = function() {
						div2.parentElement.removeChild(div2);
					};

					let innerDiv2 = document.createElement("div");
					innerDiv2.classList.add("row", "photo-row");

					let img2 = document.createElement("img");
					img2.src = elem;

					innerDiv2.appendChild(img2);
					div2.appendChild(innerDiv2);
					pickContainer.appendChild(div2);
				};

				let innerDiv = document.createElement("div");
				innerDiv.classList.add("row", "photo-row");

				let img = document.createElement("img");
				img.src = elem;

				innerDiv.appendChild(img);
				div.appendChild(innerDiv);
				resultContainer.appendChild(div);
			});
			
		}
		catch(e) {
			//display error msg
			document.querySelector("#result-error").innerHTML = results;
		}
	});
}

function ajaxGet(endpointUrl, returnFunction){
	let xhr = new XMLHttpRequest();
	xhr.open('GET', endpointUrl, true);
	xhr.onreadystatechange = function(){
		if (xhr.readyState == XMLHttpRequest.DONE) {
			if (xhr.status == 200) {
				// When a success response is returned from the server
				returnFunction( xhr.responseText );
			} else {
				//alert('AJAX Error.');
				//console.log(xhr.status);
			}
		}
	}
	xhr.send();
};
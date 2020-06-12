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

document.querySelector("#add-button").onclick = function(e) {
	e.preventDefault();
	let string = "";
	for(let i = 0; i < boxes.length; i++) {
		if (boxes[i].classList.contains('picked')) {
			string += (boxes[i].dataset.id + ' ');
		}
	}

	let input = document.createElement("input");
	input.type = "hidden";
	input.name = "colors";
	input.value = string;

	let form = document.querySelector("#upload-form");
	form.appendChild(input);

	form.submit();
}
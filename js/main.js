
var navTogBtn = document.getElementById('nav-tog-btn');
navTogBtn.addEventListener('click',navToggle)
function navToggle(){
		var x = document.getElementById("myTopnav");
		if (x.className === "topnav") {
			x.className += " responsive";
		} else {
			x.className = "topnav";
		}
}

var forms = document.getElementsByClassName('needs-validation');
var validation = Array.prototype.filter.call(forms, function(form) {
	form.addEventListener('submit', function(event) {
		if (form.checkValidity() === false) {
			event.preventDefault();
			event.stopPropagation();
		}
		form.classList.add('was-validated');
	}, false);
});

function deleteReq(e){
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '/BlogApp/home.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function () {
		document.body.innerHTML = this.responseText;
	};
	xhr.send('d='+e.value);
}
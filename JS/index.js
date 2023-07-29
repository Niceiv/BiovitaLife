

function ApriMenu() {
	//console.log('CI SONO');
	//var dropdown = document.getElementById("btn_altri");
	var dropdown = document.getElementsByClassName("dropdown-btn");
	//console.log(dropdown);
	var i;

	for (i = 0; i < dropdown.length; i++) {
		//console.log('i:'+i);
		dropdown[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var dropdownContent = this.nextElementSibling;
		if (dropdownContent.style.display === "block") {
		  dropdownContent.style.display = "none";
		} else {
		  dropdownContent.style.display = "block";
		}
	  });
	}
}
function OpenP() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}


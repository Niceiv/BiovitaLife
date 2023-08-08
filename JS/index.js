

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

function FaqLoadAction() {
  var faq = document.getElementsByClassName("faq-page");
  var i;


  for (i = 0; i < faq.length; i++) {
    faq[i].addEventListener("click", function () {
      /* Toggle between adding and removing the "active" class,
      to highlight the button that controls the panel */
      this.classList.toggle("active");

      console.log('CI SONO');

      /* Toggle between hiding and showing the active panel */
      var body = this.nextElementSibling;
      if (body.style.display === "block") {
        body.style.display = "none";
      } else {
        body.style.display = "block";
      }
    });
  }
}
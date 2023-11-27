function myFuncionDyspalyyText(imgs, TestoDaMostrare, descColore, prezzo) {
  console.log(TestoDaMostrare);
  /*
  console.log('imgs: ' + imgs);
  console.log('TestoDaMostrare: ' +TestoDaMostrare);
  console.log('descColore: ' +descColore);
  console.log('prezzo:' + prezzo);
  */

  var Testo01 = document.getElementById("Testo01");
  if (TestoDaMostrare == "Testo01") {
    //console.log('Testo1:si');
    Testo01.style.display = "block";
  } else {
    //console.log('Testo1:no');
    Testo01.style.display = "none";
  }

  var Testo02 = document.getElementById("Testo02");
  if (TestoDaMostrare == "Testo02") {
    //console.log('Testo2:si');
    Testo02.style.display = "block";
  } else {
    //console.log('Testo2:no');
    Testo02.style.display = "none";
  }

  var Testo03 = document.getElementById("Testo03");
  if (TestoDaMostrare == "Testo03") {
    //console.log('Testo3:si');
    Testo03.style.display = "block";
  } else {
    //console.log('Testo3:no');
    Testo03.style.display = "none";
  }

  var Testo04 = document.getElementById("Testo04");
  if (TestoDaMostrare == "Testo04") {
    //console.log('Testo4:si');
    Testo04.style.display = "block";
  } else {
    //console.log('Testo04:no');
    Testo04.style.display = "none";
  }

  if (TestoDaMostrare == "Ciocche") {
    var Testo01 = document.getElementById("Testo01");
    Testo01.style.display = "none";
    console.log("Ciocche");
    var Ciocche = document.getElementById("Ciocche");
    if (TestoDaMostrare == "Ciocche") {
      console.log("Ciocche:si");
      Ciocche.style.display = "block";
      var codColore = document.getElementById("CodiceColore");
      codColore.innerText = descColore;

      var przProd = document.getElementById("PrezzoProdotto");
      przProd.innerText = prezzo;

      console.log("Prezzo:" + prezzo);
    } else {
      console.log("Ciocche:no");
      Ciocche.style.display = "none";
    }
  } else if (TestoDaMostrare == "CioccheBionde") {
    console.log("-->CioccheBionde:" + descColore);
    console.log("Prezzo:" + prezzo);
    //if (TestoDaMostrare == "CioccheBionde") {
    var Testo01 = document.getElementById("Testo01");
    Testo01.style.display = "block";

    var codColore = document.getElementById("CodiceColore");
    codColore.innerText = descColore;

    var przProd = document.getElementById("PrezzoProdotto");
    przProd.innerText = prezzo;

    //}
  }

  var immagineGrande = document.getElementById("expandedImg");

  immagineGrande.src = imgs;

  immagineGrande.parentElement.style.display = "block";
}


function mostraCreme(idVal) {


  var modal = document.getElementById("myModal");
  var span = document.getElementsByClassName("close")[0];
  modal.style.display = "block";


  document.getElementById('miodiv').style.display = 'block';

  $.ajax({
    url: 'datiCreme.php',
    type: 'POST',
    data: {
      'idDati': idVal
    },
    dataType: 'html'
  }).done(function (html) {
    $('#miodiv').html(html)
  });


  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
}

function mostraOlii(idVal) {


  var modal = document.getElementById("myModal");
  var span = document.getElementsByClassName("close")[0];
  modal.style.display = "block";


  document.getElementById('miodiv').style.display = 'block';

  $.ajax({
    url: 'datiOlii.php',
    type: 'POST',
    data: {
      'idDati': idVal
    },
    dataType: 'html'
  }).done(function (html) {
    $('#miodiv').html(html)
  });


  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
}

$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function () {

  var readURL = function (input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('.profile-pic').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $(".file-upload").on('change', function () {
    readURL(this);
  });

  $(".upload-button").on('click', function () {
    $(".file-upload").click();
  });
});


anime({
  targets: '.row svg',
  translateY: 10,
  autoplay: true,
  loop: true,
  easing: 'easeInOutSine',
  direction: 'alternate'
});

anime({
  targets: '#zero',
  translateX: 10,
  autoplay: true,
  loop: true,
  easing: 'easeInOutSine',
  direction: 'alternate',
  scale: [{ value: 1 }, { value: 1.4 }, { value: 1, delay: 250 }],
  rotateY: { value: '+=180', delay: 200 },
});

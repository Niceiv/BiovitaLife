function verificaEmail(emailHelp) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(emailHelp);
}


function controlloForm() {
    var nome = document.forms["formMail"]["nomeCognome"].value;
    var email = document.forms["formMail"]["emailHelp"].value;
    var subject = document.forms["formMail"]["subjectHelp"].value;
    var msg = document.forms["formMail"]["messageHelp"].value;

    var bStatus = true;

    var nomeDiv = document.getElementById("nomeDiv");
    var emailDiv = document.getElementById("emailDiv");
    var msgDiv = document.getElementById("msgDiv");
    var subjectDiv = document.getElementById("subjectDiv");

    var spanMsg = document.getElementById("spanMsg");
    var spanNomeCognome = document.getElementById("spanNomeCognome");
    var spanSubject = document.getElementById("spanSubject");
    var spanEmail = document.getElementById("spanEmail");


    console.log('chk msg');

    if (msg == "") {
        msgDiv.classList.add("has-error");
        spanMsg.classList.add("glyphicon-remove");
        spanMsg.classList.add("glyphicon");
        bStatus = false;
        console.log('chk msg ko');
    } else if (nome != "") {
        msgDiv.classList.remove("has-error");
        spanMsg.classList.remove("glyphicon");
        spanMsg.classList.remove("glyphicon-remove");
        msgDiv.classList.add("has-success");
        spanMsg.classList.add("glyphicon");
        spanMsg.classList.add("glyphicon-ok");
        console.log('chk msg ok');
    }


    console.log('sbj msg');

    if (subject == "") {
        subjectDiv.classList.add("has-error");
        spanSubject.classList.add("glyphicon-remove");
        spanSubject.classList.add("glyphicon");
        bStatus = false;
        console.log('chk sbj ko');
    } else if (subject != "") {
        subjectDiv.classList.remove("has-error");
        spanSubject.classList.remove("glyphicon");
        spanSubject.classList.remove("glyphicon-remove");
        subjectDiv.classList.add("has-success");
        spanSubject.classList.add("glyphicon");
        spanSubject.classList.add("glyphicon-ok");
        console.log('chk sbj ok');
    }


    console.log('chk nome');

    //Controllo il nome
    if (nome == "") {
        nomeDiv.classList.add("has-error");
        spanNomeCognome.classList.add("glyphicon");
        spanNomeCognome.classList.add("glyphicon-remove");
        bStatus = false;
        console.log('chk nome ko');
    } else if (nome != "") {
        nomeDiv.classList.remove("has-error");
        spanNomeCognome.classList.remove("glyphicon");
        spanNomeCognome.classList.remove("glyphicon-remove");
        nomeDiv.classList.add("has-success");
        spanNomeCognome.classList.add("glyphicon");
        spanNomeCognome.classList.add("glyphicon-ok");
        console.log('chk nome ok');
    }

    console.log('chk email');


    if (email == "") {
        emailDiv.classList.add("has-error");
        spanEmail.classList.add("glyphicon");
        spanEmail.classList.add("glyphicon-remove");
        bStatus = false;
        console.log('chk email ko');
    } else if (nome != "") {
        //Controllo MAIL
        var verEmail = verificaEmail(emailHelp);
        if (!verEmail) {
            alert("L'indirizzo email non sembra corretto!");
            bStatus = false;
            console.log('chk email ver ko');
        } else if (verEmail) {
            emailDiv.classList.remove("has-error");
            spanEmail.classList.remove("glyphicon");
            spanEmail.classList.remove("glyphicon-remove");
            emailDiv.classList.add("has-success");
            spanEmail.classList.add("glyphicon");
            spanEmail.classList.add("glyphicon-ok");
            console.log('chk email ver ok');
        }
    }

    console.log('chk fine');
    if (bStatus) {
        document.forms["formMail"].submit();
    }
}

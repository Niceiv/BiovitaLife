<body onload="FaqLoadAction()">
    <div class="container-fluid">
        <main>
            <script>
                var xmlhttp, xmlDoc;
                xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "XML/FAQ.xml", false);
                xmlhttp.send();
                xmlDoc = xmlhttp.responseXML;

                gruppi = xmlDoc.childNodes[0];
                //var desc = "<h1 class='faq-heading' style='text-align: center;'>DOMANDE FREQUENTI XML-Assistenza clienti</h1>";
                var desc = "";

                desc += "<section class='faq-container'>";
                desc += "   <div class='faq-one'>";
                desc += "       <h1 class='faq-heading' style='text-align: center;'>DOMANDE FREQUENTI XML-Assistenza clienti</h1>";
                desc += "   </div>";
                desc += "</section>"

                for (var i = 0; i < gruppi.children.length; i++) {

                    //Elencp dei vari gruppi
                    var gruppo = gruppi.children[i];
                    for (var k = 0; k < gruppo.children.length; k++) {

                        if (k == 0) {

                            //Leggo il valore del campo GRP_NOME
                            nome = gruppo.children[k];
                            desc += "<section class='faq-container'>";
                            desc += "   <div class='faq-one'>";
                            desc += "       <h1 class='faq-heading' style='text-align: left;'>" + nome.textContent.toString() + "</h1>";
                            desc += "   </div>";

                        } else {

                            //Elenco delle domande all'interno di un gruppo
                            domande = gruppo.children[k];
                            desc += "   <div>";
                            for (var z = 0; z < domande.children.length; z++) {
                                //Ciclo sulle varie FAQ                                
                                domanda = domande.children[z];

                                //Salvo come Class l'elemento ID 
                                desc += "<div class='" + domanda.children[0].textContent.toString() + "''>";
                                //Mostro le'elemento DOMANDA
                                desc += "   <H2 class='faq-page' >" + domanda.children[1].textContent.toString() + "</H2>";

                                desc += "   <div class='faq-body'>";
                                //Quando viene cliccato il * mostro l'elemento RISPOSTA
                                desc += "       <p>" + domanda.children[2].textContent.toString() + "</p>";
                                desc += "   </div>";
                                desc += "</div>";
                                desc += "<hr class='hr-line'>";


                            }
                            desc += "   </div>";
                        }

                        desc += "</section>";
                    }

                }
                document.write(desc);
            </script>

        </main>

    </div>
</body>
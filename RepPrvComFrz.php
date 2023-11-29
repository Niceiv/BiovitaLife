<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        //Leggo eventuali valori inseriti in una sessione precedente
        var IDReg = $('#PreSelReg').val();
        var IDPrv = $('#PreSelPrv').val();
        var IDCom = $('#PreSelCom').val();
        var IDFrz = $('#PreSelFrz').val();

        //console.log('start\r\n');



        //Se IDPRV è valorizzata vuol dire che il dato è stato precedentemente salvato a db
        if (IDReg != '0') {
            //var strEcho = 'Reg: ' + IDReg + '\r\nPrv: ' + IDPrv + '\r\nCom: ' + IDCom + '\r\nFrz: ' + IDFrz;
            //console.log(strEcho);
            AjaxCall('ALL', IDReg, IDPrv, IDCom, IDFrz);
        }


        //Scelta della regione
        $('#cbo_reg').change(function() {
            //Regione selezionata
            IDReg = $('#cbo_reg').val();
            console.log('Regione selezionata: ' + IDReg);
            AjaxCall('REG', IDReg, IDPrv, IDCom, IDFrz);

        }); //Fine cbo_reg

        //Selta della provincia
        $('#cbo_prv').change(function() {
            //Regione selezionata

            IDPrv = $('#cbo_prv').val();
            console.log('Provincia selezionata: ' + IDPrv);
            AjaxCall('PRV', IDPrv, IDPrv, IDCom, IDFrz);

        }); //Fine cbo_prv


        //Selta della comune
        $('#cbo_com').change(function() {
            //Regione selezionata
            IDCom = $('#cbo_com').val();
            console.log('Comune selezionata: ' + IDCom);
            AjaxCall('COM', IDCom, IDPrv, IDCom, IDFrz);

        }); //Fine cbo_prv

    }); //Fine document

    function AjaxCall(Tipo, ValSel, PrvSel, ComSel, FrzSel) {
        console.log('\r\nAjaxCall2');
        var strEcho = '\r\nTipo: ' + Tipo + '\r\nValSel: ' + ValSel + '\r\nPrv: ' + PrvSel + '\r\nCom: ' + ComSel + '\r\nFrz: ' + FrzSel;
        console.log(strEcho);


        $.ajax({
            type: "POST",
            url: "datiRepPrvComFrz.php",
            data: {
                'TIPO': Tipo,
                'VAL_SEL': ValSel,
                'PRV_SEL': PrvSel,
                'COM_SEL': ComSel,
                'FRZ_SEL': FrzSel
            },
            dataType: "JSON",

            success: function(data) {

                if (data.PRV != null) {
                    //console.log('\r\nPRV:' + data.PRV);
                    $('#cbo_prv').html(data.PRV);
                }

                if (data.COM != null) {
                    //console.log('\r\COM:' + data.COM);
                    $('#cbo_com').html(data.COM);
                }

                if (data.FRZ != null) {
                    //console.log('\r\FRZ:' + data.FRZ);
                    $('#cbo_frz').html(data.FRZ);
                }


            },

            error: function() {
                alert("Chiamata fallita, si prega di riprovare...");
            }
        }); //Fine Ajax Prov
    }
</script>

<body>

    <?php
    require 'Config\SQL_Command.php';

    //Fingo di avere dei valori letti da DBase
    //QUando nel db NON ci sono dati le varibili devono essere instanziate a zero



    $IDReg = 0;
    $IDProv = 0;
    $IDCom = 0;
    $IDFrz = 0;

    $IDReg = 204;
    $IDProv = 26;
    $IDCom = 26010;
    $IDFrz = 103641;


    ?>
    <form>
        <h1>Regione - Province - Comuni - Frazioni</h1>
        <input type='text' id='PreSelReg' name='PreSelReg' value='<?= $IDReg ?>'>
        <input type='text' id='PreSelPrv' name='PreSelPrv' value='<?= $IDProv ?>'>
        <input type='text' id='PreSelCom' name='PreSelCom' value='<?= $IDCom ?>'>
        <input type='text' id='PreSelFrz' name='PreSelFrz' value='<?= $IDFrz ?>'>

        <p>Regione</p>
        <select name="cbo_reg" id="cbo_reg">
            <option value='0'>Scegli...</option>
            <?php
            $sql = "SELECT * FROM vw_Regioni ORDER BY DESCRIZIONE";
            $res = GetData($sql);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    if ($IDReg == $row["NUMRIF"]) {
                        echo "<option value='" . $row["NUMRIF"] . "' selected>" . $row["DESCRIZIONE"] . "</option>";
                    } else {
                        echo "<option value='" . $row["NUMRIF"] . "'>" . $row["DESCRIZIONE"] . "</option>";
                    }
                }
            }
            ?>
        </select>
        <br />

        <span id="span_prv" name="span_prv">
            <?php
            echo "<p>Provincia</p>";
            echo "<select name='cbo_prv' id='cbo_prv'>";
            echo "    <option value='0'>Scegli...</option>";
            echo "</select>";
            ?>
        </span>
        <span id="span_com" name="span_com">
            <?php
            echo "<p>Comune</p>";
            echo "<select name='cbo_com' id='cbo_com'>";
            echo "    <option value='0'>Scegli...</option>";
            echo "</select>";
            ?>
        </span>
        <span id="span_frz" name="span_frz">
            <?php
            echo "<p>Frazione</p>";
            echo "<select name='cbo_frz' id='cbo_frz'>";
            echo "    <option value='0'>Scegli...</option>";
            echo "</select>";
            ?>
        </span>

        <p id="res" name="res"></p>
    </form>
</body>

</html>
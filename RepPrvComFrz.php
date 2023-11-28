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



        var strEcho = 'Reg: ' + IDReg + '\r\nPrv: ' + IDPrv + '\r\nCom: ' + IDCom + '\r\nFrz: ' + IDFrz;
        alert(strEcho);

        if (IDPrv != '') {
            $.ajax({
                type: "POST",
                url: "datiRepPrvComFrz.php",
                data: {
                    'TIPO': 'REG',
                    'VAL_SEL': IDReg,
                    'PRV_SEL': IDPrv,
                    'COM_SEL': IDCom,
                    'FRZ_SEL': IDFrz
                },
                dataType: "html",

                success: function(msg) {
                    //popola la tabella delle province
                    $('#cbo_prv').html(msg);
                },

                error: function() {
                    alert("Chiamata fallita, si prega di riprovare...");
                },



            }); //Fine Ajax Reg
        }



        //Scelta della regione
        $('#cbo_reg').change(function() {
            //Regione selezionata
            var reg_sel = $('#cbo_reg').val();


            $.ajax({
                type: "POST",
                url: "datiRepPrvComFrz.php",
                data: {
                    'TIPO': 'REG',
                    'VAL_SEL': reg_sel,
                    'PRV_SEL': IDPrv,
                    'COM_SEL': IDCom,
                    'FRZ_SEL': IDFrz
                },
                dataType: "html",

                success: function(msg) {
                    //popola la tabella delle province
                    $('#cbo_prv').html(msg);
                },

                error: function() {
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            }); //Fine Ajax Reg
        }); //Fine cbo_reg

        //Selta della provincia
        $('#cbo_prv').change(function() {
            //Regione selezionata

            var prv_sel = $('#cbo_prv').val();


            $.ajax({
                type: "POST",
                url: "datiRepPrvComFrz.php",
                data: {
                    'TIPO': 'PRV',
                    'VAL_SEL': prv_sel,
                    'PRV_SEL': IDPrv,
                    'COM_SEL': IDCom,
                    'FRZ_SEL': IDFrz
                },
                dataType: "html",

                success: function(msg) {
                    //popola la tabella delle province
                    $('#cbo_com').html(msg);
                },

                error: function() {
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            }); //Fine Ajax Prov
        }); //Fine cbo_prv


        //Selta della comune
        $('#cbo_com').change(function() {
            //Regione selezionata
            var com_sel = $('#cbo_com').val();



            $.ajax({
                type: "POST",
                url: "datiRepPrvComFrz.php",
                data: {
                    'TIPO': 'COM',
                    'VAL_SEL': com_sel,
                    'PRV_SEL': IDPrv,
                    'COM_SEL': IDCom,
                    'FRZ_SEL': IDFrz
                },
                dataType: "html",

                success: function(msg) {
                    //popola la tabella delle province
                    $('#cbo_frz').html(msg);
                },

                error: function() {
                    alert("Chiamata fallita, si prega di riprovare...");
                }
            }); //Fine Ajax Prov
        }); //Fine cbo_prv

    }); //Fine document
</script>

<body>

    <?php
    require 'Config\SQL_Command.php';

    //Fingo di avere dei valori letti da DBase
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
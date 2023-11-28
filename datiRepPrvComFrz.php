<?php

$tipo = $_POST["TIPO"];
$val_sel = $_POST["VAL_SEL"];
$prv_sel = $_POST["PRV_SEL"];
$com_sel = $_POST["COM_SEL"];
$frz_sel = $_POST["FRZ_SEL"];

/*
echo "<br>Tipo: " . $tipo;
echo "<br>val_sel: " . $val_sel;
echo "<br>prv_sel: " . $prv_sel;
echo "<br>com_sel: " . $com_sel;
echo "<br>frz_sel: " . $frz_sel;
*/

require 'Config\SQL_Command.php';





if ($tipo == 'REG') {
    /*
    echo "<p>Provincia</p>";
    echo "<select name='cbo_prv' id='cbo_prv'>";
    echo "    <option value='0'>Scegli...</option>";
    */
    $pre_sel = $prv_sel;
    $sql = "SELECT * FROM vw_Province WHERE  numrifpad=" . $val_sel . "  ORDER BY DESCRIZIONE";
    $res = GetData($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            if ($pre_sel==$row["NUMRIF"]) {
                echo "<option value='" . $row["NUMRIF"] ."' selected>" . $row["DESCRIZIONE"] ."</option>";
            } else {
                echo "<option value='" . $row["NUMRIF"] ."'>" . $row["DESCRIZIONE"] ."</option>";
            }
        }
    }
    //echo "</select>";
}



if ($tipo == 'PRV') {
    /*
    echo "<br />";
    echo "<p>Comune</p>";
    echo "<select name='cbo_com' id='cbo_com'>";
    echo "    <option value='0'>Scegli...</option>";
    */
    $pre_sel = $com_sel;
    $sql = "SELECT * FROM vw_Comuni WHERE  numrifpad=" . $val_sel . "  ORDER BY DESCRIZIONE";
    $res = GetData($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            if ($pre_sel==$row["NUMRIF"]) {
                echo "<option value='" . $row["NUMRIF"] ."' selected>" . $row["DESCRIZIONE"] ."</option>";
            } else {
                echo "<option value='" . $row["NUMRIF"] ."'>" . $row["DESCRIZIONE"] ."</option>";
            }
        }
    }
    //echo "</select>";
}



if ($tipo == 'COM') {
    /*
    echo "<br />";
    echo "<p>Frazione</p>";
    echo "<select name='cbo_frz' id='cbo_frz'>";
    echo "    <option value='0'>Scegli...</option>";
    */
    $pre_sel = $frz_sel;
    $sql = "SELECT * FROM vw_Frazioni WHERE  numrifpad=" . $val_sel . "  ORDER BY DESCRIZIONE";
    $res = GetData($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            if ($pre_sel==$row["NUMRIF"]) {
                echo "<option value='" . $row["NUMRIF"] ."' selected>" . $row["DESCRIZIONE"] ."</option>";
            } else {
                echo "<option value='" . $row["NUMRIF"] ."'>" . $row["DESCRIZIONE"] ."</option>";
            }
        }
    }
    //echo "</select>";
}

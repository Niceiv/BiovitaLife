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


    $prvData='';
    $pre_sel = $prv_sel;
    $sql = "SELECT * FROM vw_Province WHERE  numrifpad=" . $val_sel . "  ORDER BY DESCRIZIONE";
    $res = GetData($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            if ($pre_sel==$row["NUMRIF"]) {
                $prvData .= "<option value='" . $row["NUMRIF"] ."' selected>" . $row["DESCRIZIONE"] ."</option>";
            } else {
                $prvData .= "<option value='" . $row["NUMRIF"] ."'>" . $row["DESCRIZIONE"] ."</option>";
            }
        }
    }
   

    $comData='';
    $pre_sel = $com_sel;
    $sql = "SELECT * FROM vw_Comuni WHERE  numrifpad=" . $prv_sel . "  ORDER BY DESCRIZIONE";
    $res = GetData($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            if ($pre_sel==$row["NUMRIF"]) {
                $comData .= "<option value='" . $row["NUMRIF"] ."' selected>" . $row["DESCRIZIONE"] ."</option>";
            } else {
                $comData .= "<option value='" . $row["NUMRIF"] ."'>" . $row["DESCRIZIONE"] ."</option>";
            }
        }
    }
   

    $frzData='';
    $pre_sel = $frz_sel;
    $sql = "SELECT * FROM vw_Frazioni WHERE  numrifpad=" . $com_sel . "  ORDER BY DESCRIZIONE";
    $res = GetData($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            if ($pre_sel==$row["NUMRIF"]) {
                $frzData .= "<option value='" . $row["NUMRIF"] ."' selected>" . $row["DESCRIZIONE"] ."</option>";
            } else {
                $frzData .= "<option value='" . $row["NUMRIF"] ."'>" . $row["DESCRIZIONE"] ."</option>";
            }
        }
    }
 

    
    if ($tipo == 'ALL') {
        $arData = array( 'PRV' => $prvData, 'COM'=>$comData, 'FRZ' => $frzData );
    }
    if ($tipo == 'REG') {
        $arData = array( 'PRV' => $prvData );
    }
    if ($tipo == 'PRV') {
        $arData = array( 'COM'=>$comData );
    }
    if ($tipo == 'COM') {
        $arData = array( 'FRZ' => $frzData );
    }
    
 
    echo json_encode($arData);


<?php

if (isset($_GET['userID']) && is_numeric($_GET['userID'])) {
    // get the 'id' variable from the URL
    $id = $_GET['userID'];

    /* Delete row from the customer table using prepared statements */
    $stmt = $dbh->prepare("DELETE FROM customer WHERE customer_id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Verifica se l'eliminazione è stata eseguita correttamente
    $deleted = $stmt->rowCount(); // Ottieni il numero di righe eliminate
    if ($deleted > 0) {
        echo "Cliente eliminato con successo.";
    } else {
        echo "Nessun cliente trovato con quell'ID.";
    }
} else {
    echo "ID cliente non valido.";
}
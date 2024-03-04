<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIBRARY . '/util/util.php';

if (isset($_POST['cakeid'])) {
    $cake_id = $_POST['cakeid'];

    $query = "DELETE FROM cakes WHERE id = ?";
    $deleteData = insert($query, ['type' => 'i', 'value' => $cake_id]);

    if ($deleteData) {
        header('Location: /dashboard/cakes/delete?success=deletecake');
        return;
    } else {
        header('Location: /dashboard/cakes/delete?error=deletecake');
        return;
    }
}

header('Location: /dashboard/cakes/delete');
return;
?>
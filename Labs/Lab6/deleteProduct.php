<?php
    include 'dbConnection.php';
    
    $dbConn = getDatabaseConnection("ottermart");
    
    $sql = "DELETE FROM om_product WHERE productId = " . $_GET['productId'];
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    
    header("Location: admin.php");
?>
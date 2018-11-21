<?php
    
    include 'dbConnection.php';
    
    $dbConn = getDatabaseConnection("ottermart");
    
    function getProductInfo () {
        
        global $dbConn;
        
        $sql = "SELECT * 
                FROM om_product
                WHERE productId = " . $_GET['productId'] ;
            
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $record;
        
    }
    
    function getCategories($catId) 
    {
    global $dbConn;
    
    $sql = "SELECT catId, catName from om_category ORDER BY catName";
    
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
        echo "<option ";
        echo ($record["catId"] == $catId)? "selected": "";
        echo " value='".$record["catId"] ."'>". $record['catName'] ." </option>";
        
    }
}
    
    if(isset($_GET['productId'])) {
            
        $product = getProductInfo();
    }
    
    if(isset($_GET['updateProduct'])) {
        
        $sql = "UPDATE om_product 
                SET productName = :productName,
                productDescription = :productDescription,
                productImage = :productImage,
                price = :price,
                catId = :catId
                WHERE productId = :productId";
                
        $np = array();
        $np[":productName"] = $_GET['productName'];
        $np[":productDescription"] = $_GET['description'];
        $np[":productImage"] = $_GET['productImage'];
        $np[":price"] = $_GET['price'];
        $np[":catId"] = $_GET['catId'];
        $np[":productId"] = $_GET['productId'];
        
        $statement = $dbConn->prepare($sql);
        $statement->execute($np);
    
        header("Location: admin.php");
    }
    
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Update Product </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Bangers|Kumar+One+Outline" rel="stylesheet">
      
    </head>
    <body>
        <h1> Update Product Page</h1>
        <form>
            <input type="hidden"   class="form-control" name="productId" value="<?=$product['productId']?>"/>
            <strong> Product name: </strong> <input  class="form-control" type="text" value= <?=$product['productName']?> name="productName"><br><br/>
            <strong>Description:</strong> <textarea name="description"  class="form-control" cols = 50 rows = 4> <?=$product['productDescription']?> </textarea><br><br/>
            <strong>Price: </strong> <input type="text"  class="form-control" value= <?=$product['price']?> name="price"><br><br/>
            <strong>Category:</strong><select name="catId"  class="form-control">
                <option value="">Select One</option>
                <?php getCategories($product['catId']); ?>
            </select> <br /><br/>
            
            Set Image Url: <input type = "text" value= <?=$product['productImage']?> name = "productImage"><br><br/>
            
            <input type="submit" class="btn btn-primary" name="updateProduct" value="Update Product">
            
        </form>
    </body>
</html>
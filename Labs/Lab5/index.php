
<?php
    
    include 'dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart"); //Starts the Db connection
    
    function displayCategories() {
        global $conn;
        
        $sql = "SELECT catId, catName FROM `om_category` ORDER BY catName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //DO db query then get the query and update the categories
        foreach ($records as $record) {
            echo "<option value='".$record["catId"]."' >" . $record["catName"] . "</option>";
        }
        
    }
    function displaySearchResults(){
        global $conn;
        
        if (isset($_GET['searchForm'])) { 
            
            echo "<h3>Products Found: </h3>"; 
            
            $namedParameters = array();
            
            $sql = "SELECT * FROM om_product WHERE 1";
            
            if (!empty($_GET['product'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND productName LIKE :productName";
                 $namedParameters[":productName"] = "%" . $_GET['product'] . "%"; //Like
            }
            
            if (!empty($_GET['product'])) { 
                 $sql .=  " OR lower(productDescription) LIKE :productName";
                 $namedParameters[":productName"] = "%" . $_GET['product'] . "%" ; //contains any case in the decirption
            }
            //For Descirption
            if (!empty($_GET['description'])) { 
                 $sql .=  " AND productName LIKE :productName";
                 $namedParameters[":productName"] = "%" . $_GET['product'] . "%"; //Like
            }
                  
             if (!empty($_GET['category'])) { 
                 $sql .=  " AND catId = :categoryId";
                 $namedParameters[":categoryId"] =  $_GET['category'];
             }    
            
             if (!empty($_GET['priceFrom'])) {
                 $sql .=  " AND price >= :priceFrom";
                 $namedParameters[":priceFrom"] =  $_GET['priceFrom'];
             }
             
            if (!empty($_GET['priceTo'])) {
                 $sql .=  " AND price <= :priceTo";
                 $namedParameters[":priceTo"] =  $_GET['priceTo'];
             }
            
             if (isset($_GET['orderBy'])) {
                 
                 if ($_GET['orderBy'] == "price") {
                     
                     $sql .= " ORDER BY price";
                     
                 } else {
                     
                      $sql .= " ORDER BY productName";
                 }
                 
                 
             }
            
             $stmt = $conn->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($records as $record) {
            
                 echo "<a href=\"purchaseHistory.php?productId=".$record["productId"]. "\"> History </a>";
                 echo  $record["productName"] . " " . $record["productDescription"] . " $" . $record["price"] . "<br /><br />";
            
            }
        }
        
    }
    
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title> OtterMart Product Search </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        
        <div>
            <h1> OtterMart Product Search </h1>
        
        <form>
            
            Product: <input type="text" name="product" />
            <br />
            Category: 
                <select name="category">
                    <option value=""> Select One </option>
                    <?=displayCategories()?>
                </select>
            <br />
            
            Price: From <input type="text" name="priceFrom" size="7" />
                   To   <input type="text" name="priceTo" size="7" />
                   
            <br />
            
            Order result by: 
            <br />
            
            <input type="radio" name="orderBy" value="price"/> Price <br />
            <input type="radio" name="orderBy" value="name"/> Name
            
            <br /><br/>
            <input type="submit" value="Search" name="searchForm" />
            
        </form>
        
        <br />
            
        </div>
        
        <hr>
        
        <?= displaySearchResults() ?>
    </body>
</html>
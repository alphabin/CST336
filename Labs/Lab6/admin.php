
<?php
    SESSION_START();
    include "dbConnection.php";
     
    $conn = getDatabaseConnection("ottermart");
     
    if(!isset($_SESSION['adminName']))
    {
        header("Location:login.php");
    }
    
    function displayAllProducts(){
        global $conn;
        $sql = "SELECT * 
                FROM om_product
                ORDER BY productId";
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     $record = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
     return $record;
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Main Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Bangers|Kumar+One+Outline" rel="stylesheet">
       <script>
            
            function confirmDelete() {
                
                return confirm("Are you sure you want to delete it?");
            }
            
        </script>
    </head>
    <body>
        <h1> Admin Main Page</h1>
        
        <h3> Welcome <?=$_SESSION['adminName']?>!</h3><br />
        
         
        <form action="addProduct.php">
            <input id="addButton" class='btn btn-secondary' id="beginning" type="submit" name="addproduct" value="Add Product"/>
        </form>
        
         <form action="logout.php">
            <input type="submit"  value="Logout"/>
        </form>

        
        
        <?php
            $records = displayAllProducts();
            
            echo "<table class='table table-hover'>";
            echo "<thead>
                    <tr>
                        <th scope='col'>ID</th> 
                        <th scope='col'>Name</th>
                        <th scope='col'>Description</th>
                        <th scope='col'>Price</th>
                        <th scope='col'>Update</th>
                        <th scope='col'>Remove</th>
                    </tr>
                    </thead>";
            echo "<tbody>";
            
            foreach($records as $record)
            {
                
                echo "<tr>";
                echo "<td>" . $record['productId'] . "</td>";
                echo "<td>" . $record['productName'] . "</td>";
                echo "<td>" . $record['productDescription'] . "</td>";
                echo "<td>" . $record['price'] . "</td>";
                echo "<td> <a class='btn btn-primary' href='updateProduct.php?productId=".$record['productId']."'>Update</a></td>";
                
                echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='productId' value='" . $record['productId']."'/>";
                echo "<td><input type='submit' class='btn btn-danger' value='Remove'></td>";
                
            }
            
        ?>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
     </body>
</html>
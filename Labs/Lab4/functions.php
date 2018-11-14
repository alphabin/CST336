<?php
    function displayResults()
    {
        global $items;
        if(isset($items))
        foreach($items as $item)
        {
            echo "<table class='table'>";
            $itemName = $item['name'];
            $itemPrice = $item['salePrice'];
            $itemImage = $item['thumbnailImage'];
            $itemId = $item['itemId'];
            
            echo "<tr>";
            
            echo "<td><img src='$itemImage'></td>";
            echo "<td><h4>$itemName</h4></td>";
            echo "<td><h4>$itemPrice</h4></td>";
            echo "<form method='post'>";
            
            echo "<input type='hidden' name='itemName' value='$itemName'>";
            echo "<input type='hidden' name='itemId' value='$itemId'>";
            echo "<input type='hidden' name='itemPrice' value='$itemPrice'>";
            echo "<input type='hidden' name='itemImage' value='$itemImage'>";
                
            if($_POST['itemId'] == $itemId)
                echo "<td><button class='btn btn-warning'>Added</button></td>";
            else
                echo "<td><button class='btn btn-success'>Add</button></td>";
            echo "</form>";
            
            echo "</tr>";        
        }
        echo "</table>";
    }
    
   function displayCart(){
        if(isset($_SESSION['cart']))
        {
            echo "<table class='table'>";
            foreach ($_SESSION['cart'] as $item)
            {
                $itemName = $item['name'];
                $itemPrice = $item['price'];
                $itemImage = $item['image'];
                $itemId = $item['id'];
                $itemQuant = $item['quantity'];
                
                echo "<tr>";
                echo "<td><img src='$itemImage'></td>";
                echo "<td><h4></h4>$itemName</td>";
                echo "<td><h4></h4>$itemPrice</td>";
                echo "<td><h4></h4>$itemQuant</td>";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='itemId' value='$itemId'>";
                echo "<td><input type='text' name='update' class='form-control' placeHolder='$itemQuant'></td>";
                echo "<td><button class='btn btn-danger'>update</button></td>";
                echo "</form>";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='removeId' value='$itemId'>";
                echo "<td><button class='btn btn-danger'>Remove</button></td>";
                echo "</form>";
                
                echo "</tr>";
            }
            echo "</table>";
        }
        
     
   }
   function displayCount(){
            echo count($_SESSION['cart']);
        }

?>
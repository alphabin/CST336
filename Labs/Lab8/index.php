<?php
    function getImages(){
        include 'dbConnection.php';
        $dbConn = getDatabaseConnection("pets");
        $sql = "SELECT id,pictureURL FROM `pets` ORDER BY `pets`.`pictureURL` ASC";
        $stmt = $dbConn ->prepare($sql);
        $stmt -> execute(array("id"=>$_GET['id']));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultSet;
}
    $imgParsed = getImages();
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CSUMB: Pet Shelter </title>
         
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>   
        <style>
            body {
                text-align: center;
                
            }
           .carousel-control-next,.carousel-control-prev
           {
                background-color: #2196F3;
            }
        </style>
   
    </head>
    <body>
        
	<!--Add main menu here -->
       <?php
            include 'inc/header.php';
        ?>
  
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                   <?php 
                   $int =0;
                   foreach ($imgParsed as $dog) 
                   {
                       if($int==0)
                            echo  '<div class="carousel-item active">';
                        else
                              echo  '<div class="carousel-item">';
          	          echo '<a href="img/'.$dog['pictureURL'].'">';
                      echo '<img class="img-fluid" width="400px" height="400px" src="img/'.$dog['pictureURL'].'" alt="First slide">';
                      echo '</a>';
                      
                      echo '</div>';
                      $int++;
                    }
                    ?>
                    
           </div>
             <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
              
            <a class="btn btn-outline-primary" href="pets.php" role="button">Adopt Now! </a>
        
       <?php
            include 'inc/footer.php';
        ?>
        
    </body>
</html>
        
<?php
    $backgroundImage = "img/sea.jpg";
    if(isset($_GET['keyword'])  && !empty($_GET['keyword']))
    {
     
        echo "You searched for: ".$_GET['keyword'];
        include 'api/pixabayAPI.php';
        if(isset($_GET['keyword']))
          $imageURLs = getImageURLs($_GET['keyword'],$_GET['layout']);
        else
          $imageURLs = getImageURLs($_GET['keyword']);
        //print_r($imageURLs);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
    else if (isset($_GET['category']) && !empty($_GET['category']))
    {
        
        echo "You searched for: ".$_GET['category'];
        include 'api/pixabayAPI.php';
        if(isset($_GET['layout']))
         $imageURLs = getImageURLs($_GET['category'],$_GET['layout']);
        else
          $imageURLs = getImageURLs($_GET['category']);
        //print_r($imageURLs);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style type="text/css">
            @import url("css/styles.css");
            body{
                background-image: url('<?=$backgroundImage?>');
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }
        </style>
        
    </head>
    <body>
        <br/><br/>
        
        <?php
            if(!isset($imageURLs))
            {
                echo "<h2> Type a Keyword to display a slideshow <br /> with random images from Pixabay.com </h2>";
            }
            // var_dump(count($imageURLs));
            // else
            // {
                
            //     for($i = 0; $i < 5 ;$i++)
            //     {
            //         do{
            //             $randomIndex = rand(0,count($imageURLs));
            //         }while (!isset($imageURLs[$randomIndex]));
                    
            //         echo "<img src='".$imageURLs[$randomIndex]."' width='200' >";
            //         unset($imageURLs[$randomIndex]);
            //     }
            // }
          
        ?>
        
      
        
        <form method="get">
          
                    <input type="text" name="keyword" placeholder="keyword" />
                      <select name="category" style="color:black; font-size:1.5em">
                         <option value=""> - Select One - </option>
                         <option value="cake"> Cake </option>
                         <option value="linda"> Linda </option>
                         <option value="jake"> Jake </option>
                         <option> Sky </option>
            </select>
            <div id="layoutDiv">
                <input type="radio" name="layout" value="horizontal" id="layout_h">
                <label for="layout_h"> Horizontal </label><br>
                 <input type="radio" name="layout" value="vertical" id="layout_v">
                 <label for="layout_v"> Vertical </label><br>
            </div>
                    <input type="submit" value="Submit" />
        </form>
        
        <?php if (count($imageURLs) > 0) { ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
             <ol class="carousel-indicators">
                <?php
                    for($i = 0 ; $i <5 ; $i++)
                    {
                      echo  "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                      echo ($i == 0)?" class='active'":"";
                      echo " ></li>";
                        
                    }
                ?>
            </ol>
            <div class="carousel-inner" role="listbox"> 
            <?php
                  $randomIndex = 0;
                  if(count($imageURLs) > 0) //Control the empty ones
                    for( $i = 0; $i <7 ;$i++)
                    {
                      do
                        {
                            $randomIndex = rand(0,count($imageURLs));
                        }while(!isset($imageURLs[$randomIndex]));
                        echo '<div class="carousel-item ';
                        echo ($i == 0)?"active": "";
                        echo '">';
                        echo '<img src="'.$imageURLs[$randomIndex].'">';
                        echo '</div>';
                        unset($imageURLs[$randomIndex]);
                    }
                ?>
            </div>
            
              <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="carousel-control-next-icon " aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            <?php } ?>
            
           
        </div>
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        </body>
</html>
<?php
    $backgroundImage = "img/sea.jpg";
    if(isset($_GET['keyword']))
    {
        echo "You searched for: ".$_GET['keyword'];
        include 'api/pixabayAPI.php';
        $imageURLs = getImageURLs($_GET['keyword']);
        //print_r($imageURLs);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <style type="text/css">
            @import url("css/styles.css");
            body{
                background-image: url('<?=$backgroundImage?>');
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
                    <input type="submit" value="Submit" />
        </form>
        
        <ol class="carousel-indicators">
            <?php
                for($i = 0 ; $i <5 ; $i++)
                {
                  echo  "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                  echo ($i == 0)?"class='active'":"";
                  echo "></li>";
                    
                }
            ?>
        </ol>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            
            <div class="carousel-inner" role="listbox"> 
            <?php
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
            
             <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>
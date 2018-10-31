            <?php 
            
              
                /*Display Function for */
                function displaySymbol($randomVal1,$pos)
                {
                    switch($randomVal1)
                    {
                        case 0:
                            $symbol = "seven";
                            break;
                        case 1:
                            $symbol = "cherry";
                            break;
                        case 2:
                            $symbol = "lemon";
                            break;
                        case 3;
                            $symbol = "bar";
                            break;
/*                        case 4:
                            $symbol = "machine";
                            break;
                        case 5:
                            $symbol = "orange";
                            break;
                        case 6:
                            $symbol = "grapes";
                            break;*/
                    }
                    echo "<img id='reel$pos'  src='img/$symbol.png' alt='$symbol' title='".ucfirst($symbol)."' width='70' >";
                }
                 
                /*Display Function for Point*/
                function displayPoints($randomVal1,$randomVal2,$randomVal3)
                {
                     
                     echo "<div id='output'>";
                        if(($randomVal1 == $randomVal2) && ($randomVal3 == $randomVal2)){
                            switch($randomVal1) //Any at this point to figure out the suit
                                {
                                    case 0:
                                        $totalPoints = 1000 ;
                                        echo "<h1>Jackpot</h1>";
                                        $soundfile = "./inc/JackPot.mp3";
                                        break;
                                    case 1:
                                         $totalPoints = 500 ;
                                         $soundfile = "./inc/WonSomething.mp3";
                                        break;
                                    case 2:
                                         $totalPoints = 250 ;
                                         $soundfile = "./inc/WonSomething.mp3";
                                        break;
                                    case 3:
 /*                                 case 4:
                                    case 5:
                                    case 6:*/
                                         $totalPoints = 900 ;
                                         $soundfile = "./inc/WonSomething.mp3";
                                        break;
                                }
                                echo "<h2>You Won $totalPoints points!</h2>";
                                
                        }
                        else
                        {
                            echo "<h3> Try Again </h3>";
                            //$soundfile = "./inc/FailEffect.mp3";
                        }
                        echo "<audio autoplay='autoplay'>";
                        echo "<source src='$soundfile'/>";
                        echo "</audio>";
                     echo "</div>";
                 }
                 
                /*Main Function*/
                function play()
                {
                 for($i = 1; $i<4; $i++){
                     ${"randomValue".$i} = rand(0,3);
                     displaySymbol(${"randomValue".$i},$i);
                 }
                 displayPoints($randomValue1,$randomValue2,$randomValue3);
                 }
            ?>
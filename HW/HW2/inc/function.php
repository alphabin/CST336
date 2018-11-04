 <?php
            
                 class GameRuntime
                 {
                     private $game; 

                    function getValidRand($startColum){
                        $smin = $startColum - 1 > 0 ? $startColum - 1  :  $startColum ;
                        $smax =  $startColum + 1 < 5   ? $startColum + 1  :  $startColum ;
                        $secondRand = rand($smin,$smax);
                        return  $secondRand;
                    }
                     
                     public function startGame($startColum)
                     {
                         $this->game = array
                                (
                                    array(),
                                    array(),
                                    array(),
                                    array()
                                );
                        
                        $this->game[0][(int)$startColum] = "set";
                        
                        for ($x = 1; $x <= 3; $x++) {
                           $rowGuess =  $this->getValidRand((int)$startColum); 
                           $this->game[(int)$x][ (int)$rowGuess ] = "set";
                           $startColum = $rowGuess;
                        } 
                         
                     }
                  
                  public function getCurrent()
                  {
                      return array_values($this->game);
                  }   
                  
                 }
                 
            
                 class GameBoard
                 {
                     private $leaderBoard ;
                     private $gameRun;
                     
                     public function initBoard()
                     {
                         $this->leaderBoard = array();
                     }
                     
                     public function initGame($startColum)
                     {
                         $this->gameRun = new GameRuntime();
                         $this->gameRun->startGame($startColum);
                     }
                       
                     public function getLeaderBoard()
                     {
                         return $this->leaderBoard;
                     }
                     
                     public function addLeaderBoard($leaderName)
                     {
                         $this->leaderBoard[]=$leaderName;
                     }
                     
                     public function getGameCurrent(){
                         
                        return $this->gameRun->getCurrent();
                     }
                     
                 }
                 
                 $game = new GameBoard();
                 $game->initBoard();
                 //Get the Column from post request

               // echo "|here Winners-->";echo json_encode($game->getLeaderBoard());echo "<--|here|<br><br>";
               // echo "|here Game Array-->";echo json_encode(($game->getGameCurrent()));echo "<--|here|";
               
               $errors = array(); //To store errors
               $form_data = array(); //Pass back the data to `form.php`

                /* Validate the form on the server side */
            if (empty($_POST['colName'])) {
                $errors['colName'] = 'Col Number can not be blank';
            }
             if (empty($_POST['userName'])) { //Name cannot be empty
                $errors['userNamer'] = 'User Name can not be blank';
            }

         if (!empty($errors)) { //If errors in validation
                $form_data['success'] = false;
                $form_data['errors']  = $errors;
            }
        else { //If not, process the form, and return true on success
                $form_data['success'] = true;
                $form_data['posted'] = 'Data Was Posted Successfully';
                $game->initGame($_POST['colName']);
                $game->addLeaderBoard("Chatura ");
                $form_data['gameData']  = $game->getGameCurrent();
                $form_data['gameUser']  = $_POST['userName'];
              }
              
                //Return the data back to form.php
                echo json_encode($form_data);
             ?>
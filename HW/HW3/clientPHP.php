<!DOCTYPE html>
<html>
    <head>
        <title>SSH Command Executor</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Bangers|Kumar+One+Outline" rel="stylesheet">
        <style type="text/css">
            @import url("css/styles.css");
        </style>
        
    </head>
    <body>


<?php
include('Net/SSH2.php');
include('File/ANSI.php');
define('NET_SSH2_LOGGING', NET_SSH2_LOG_COMPLEX);


/*Helper Class for the PHP SSH session */
class PHPSSHWrapper {
    
    private $sshConnection;
    
    public function __construct($ipAddress)
    {
      $this->sshConnection = new Net_SSH2($ipAddress);
    }
    
    public function Connect($username, $password)
    {
        if (!$this->sshConnection->login($username, $password)) 
        {
            return false;
        }
        else
        {
              return true;
        }
    }
   
   public function Debugging($option="false")
    {
        if($option == "true")
        {
           echo $this->sshConnection->getLog();
        }
    }
    
    public function VerifyHostKey($option=false)
    {
        if($option == true )
           $this->sshConnection->getServerPublicHostKey();
    }
    
    public function VerifyServerPublicHostKey($option=false)
    {
        if($option == true )
           $this->sshConnection->getServerPublicHostKey();
    }
    
    public function RunCmd($inputWord="top")
    {
            $strvar = print_r($inputWord,true);
            $ansi = new File_ANSI();
            $this->sshConnection->read();
            $this->sshConnection->write($strvar);
            $this->sshConnection->write("\n");
            echo "<div class=\"errorMessage\"> Sending the Request! </div>";
            $this->sshConnection->setTimeout(5);
            $ansi->appendString($this->sshConnection->read());
            return $ansi->getScreen(); // outputs HTML
    }
    
}

$myTerm =null;

if(!isset($_GET['ip']))
{
     echo "<div class=\"errorMessage\"> Please submit a Request! </div>";
     exit();
}
else
{
    if (filter_var($_GET['ip'], FILTER_VALIDATE_IP)) {
        $myTerm = new PHPSSHWrapper($_GET['ip']);
} else {
        echo "<div class=\"errorMessage\"> Please Enter a valid IP address for the Request! </div>";
        exit();
}
        
}


if(isset($_GET['user']) && isset($_GET['password']))
{
    if(strlen($_GET['user']) > 0 && strlen($_GET['password']) > 0)
    {
    $myTerm->Connect($_GET['user'],$_GET['password']);
    
        if($_GET['runPreCommand'] == "true")
        {
            if($_GET['cannedCommand'] != "" )
             echo $myTerm->RunCmd($_GET['cannedCommand']);
            else
             echo "<div class=\"errorMessage\">You didnt select a correct Cannned command for linux </div>";
        }
        else
        {
            if($_GET['command'] != "" )
                echo $myTerm->RunCmd($_GET['command']);
            else
             echo "<div class=\"errorMessage\">You didnt type a command </div>";
        }
        if(isset($_GET['debug']))
          {
           if( $_GET['debug'] == "true")
             echo $myTerm->Debugging("true");
          }
    }
    else{
        echo "<div class=\"errorMessage\">Login User/Password Information Invalid </div>";
        exit();
    }
}
else{
     echo "<div class=\"errorMessage\">Login Information Invalid </div>";
        exit();
}

?>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php
include('Net/SSH2.php');
include('File/ANSI.php');


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
    
    public function Debugging($option=false)
    {
        if($option == true)
        {
         define('NET_SSH2_LOGGING', NET_SSH2_LOG_COMPLEX);
        }
        else
        {
            error_reporting(E_ERROR | E_PARSE);
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
            $this->sshConnection->write($strvar);
            $this->sshConnection->write("\n");
            $this->sshConnection->setTimeout(5);
            $ansi->appendString($this->sshConnection->read());
            return $ansi->getScreen(); // outputs HTML
    }
    
}

$myTerm = new PHPSSHWrapper($_GET['ip']);
$myTerm->Debugging(false);
$myTerm->Connect($_GET['user'],$_GET['password']);
    echo $myTerm->RunCmd("cd ~ | ls -la");
?>
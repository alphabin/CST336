

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
       
        <div class="jumbotron jumbotron-fluid vertical-center">
            <h1 id="headerJumbo" class="display-4">Welcome to the SSH Terminal Command Center</h1>
        <div class="container">
            <div class="row">
                <div class="col-lg-4  col-sm-12 center">
            <form method="get" target="my-iframe" action="clientPHP.php">
              <table >
                    <tr>
                        <th>IP Address</th>
                        <td>
                            <input id="ipAddr"class="form-control" type="text" name="ip">
                        </td>
                    </tr>
                    <tr>
                        <th>UserName
                        </th>
                        <th>Password
                        </th> 
                    </tr>
                    <tr>
                        <td>
                            <input class="form-control" type="text" name="user">
                        </td>
                        <td>
                            <input  class="form-control" type="password" name="password">
                        </td>
                    </tr>
                    <tr>
                        <th>Command To Execute</th>
                        <td>
                        <textarea id="textCLI" class="form-control" name="command" rows="2" cols="20"></textarea>
                        </td>
                    </tr>
                    <tr>
                         <td></td>
                         <td>
                             <input class="form-check-input" type="checkbox" name="runPreCommand" value="true" >Run a canned Linux Command<br>
                             <select id="selectForm" class="form-control" name="cannedCommand">
                                  <option value="">Chose One</option> 
                                  <option value="ls -la">List Directory</option>
                                  <option value="whoami">Check UserName</option>
                                  <option value="uptime">Check Uptime</option>
                                  <option value="netstat -lntu">Check OpenPorts</option>
                                  <option value="df -h">Check Files Space</option>
                                  <option value="mount">Check Mount</option>
                            </select>
                        </td>
                    </tr>
                   
                    <tr>
                        <td>
                            <input type="radio" name="debug" value="false" checked>Debug OFF<br>
                            <input type="radio" name="debug" value="true">Debug ON
                        </td>
                    </tr>
                    <tr>
                        <td>
                              <input class="btn btn-primary " type="submit" value="Submit">
                        </td>
                        <td>
                              <input id="resetButton" class="btn btn-primary red" type="reset">
                        </td>
                    
                    </tr>
             </table>
            </form>
                </div>
                <div class="col-lg-8  col-sm-12">
                    <iframe name="my-iframe" width="100%" height="100%" src="clientPHP.php"></iframe>
                </div>
            </div>
           
        </div>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        </body>
</html>
var output;
var pacman;
var loopTimer;
var numLoops = 0;
const PACMAN_SPEED = 10;
const GHOST_SPEED = 10;
var redGhost;
var greenGhost;
/*var upArrowDown = false;
var downArrowDown = false;
var leftArrowDown = false;
var rightArrowDown = false;*/
var direction = 'right';
var walls = new Array();
var rgDirection;
var ggDirection;

function hitWall(element){
    var hit = false;
    for(var ii= 0; ii< walls.length;ii++)
    {
        if(hittest(walls[ii],element)) { 
            hit = true;
        }
    }
    return hit;
}

function loop() {
    
    numLoops++;
    //output.html(numLoops);
    var originalLeft = pacman[0].style.left;
    var originalTop = pacman[0].style.top;

    if (direction=='up') {
        var pacmanY = parseFloat(pacman[0].style.top) - PACMAN_SPEED;
        if(!hitWall(pacman)){
        if (pacmanY < -30) pacmanY = 390;
        pacman.css('top', pacmanY + 'px');}
    }
    if (direction=='down') {
        var pacmanY = parseFloat(pacman[0].style.top) + PACMAN_SPEED;
        if(!hitWall(pacman)){
        if (pacmanY > 380) pacmanY = -30;
           pacman.css('top', pacmanY + 'px');
        }
    }
    if (direction=='left') {

        var pacmanX = parseFloat(pacman[0].style.left) - PACMAN_SPEED;
        if(!hitWall(pacman)){
        if(pacmanX  < -30) pacmanX = 590;
        pacman.css('left', pacmanX + 'px');
        }
    }
    if (direction=='right') {
        
        var pacmanX = parseFloat(pacman[0].style.left) + PACMAN_SPEED;
        if(!hitWall(pacman))
        {
         if(pacmanX  > 580) pacmanX = -30;
         pacman.css('left', pacmanX + 'px');
            
        }
    }
    
    if(hitWall(pacman))
    {
        //output.html('collition');
        pacman.css('left', originalLeft);
        pacman.css('top', originalTop);
    }
    
   moveRedGhost();
   movegreenGhost();
  
   if(hittest(pacman, redGhost))
    {
      output.html("You Died");
      clearInterval(loopTimer);
    }
      if(hittest(pacman, greenGhost))
    {
      output.html("You Died");
      clearInterval(loopTimer);
    }
 
}

function moveRedGhost(){
    var rgx = parseInt(redGhost[0].style.left);
    var rgy = parseInt(redGhost[0].style.top);
    
    var rgNewDirection;
    var rgOppositeDirection;
    
    if(rgDirection== 'left') rgOppositeDirection = 'right';
    else if(rgDirection== 'right') rgOppositeDirection = 'left';
    else if(rgDirection== 'down') rgOppositeDirection= 'up';
    else if(rgDirection== 'up') rgOppositeDirection = 'down';
    
    do{
        redGhost[0].style.left = rgx + 'px';
        redGhost[0].style.top = rgy + 'px';
    
     do{
        var r= Math.floor(Math.random()*4);
        if(r==0) rgNewDirection = 'right';
        else if(r==1) rgNewDirection = 'left';
        else if(r==2) rgNewDirection = 'down';
        else if(r==3) rgNewDirection = 'up';
    }while( rgNewDirection ==  rgOppositeDirection);
    
    if(rgNewDirection == 'right'){
        if(rgx > 590) rgx= -30;
        redGhost[0].style.left = rgx + GHOST_SPEED + 'px';
    }
    else if(rgNewDirection == 'left'){
        if(rgx < -30) rgx= 590;
        redGhost[0].style.left = rgx - GHOST_SPEED + 'px';
    }
     else if(rgNewDirection == 'down'){
        if(rgy > 390) rgy= -30;
        redGhost[0].style.top = rgy + GHOST_SPEED + 'px';
    }
     else if(rgNewDirection == 'up'){
        if(rgy < -30) rgy= 390;
        redGhost[0].style.top = rgy - GHOST_SPEED + 'px';
    }
    
    }while(hitWall(redGhost));
    
  
    rgDirection = rgNewDirection;
    
}

function movegreenGhost(){
    var rgx = parseInt(greenGhost[0].style.left);
    var rgy = parseInt(greenGhost[0].style.top);
    
    var rgNewDirection;
    var rgOppositeDirection;
    
    if(ggDirection== 'left') rgOppositeDirection = 'right';
    else if(ggDirection== 'right') rgOppositeDirection = 'left';
    else if(ggDirection== 'down') rgOppositeDirection= 'up';
    else if(ggDirection== 'up') rgOppositeDirection = 'down';
    
    do{
        greenGhost[0].style.left = rgx + 'px';
        greenGhost[0].style.top = rgy + 'px';
    
     do{
        var r= Math.floor(Math.random()*4);
        if(r==0) rgNewDirection = 'right';
        else if(r==1) rgNewDirection = 'left';
        else if(r==2) rgNewDirection = 'down';
        else if(r==3) rgNewDirection = 'up';
    }while( rgNewDirection ==  rgOppositeDirection);
    
    if(rgNewDirection == 'right'){
        if(rgx > 590) rgx= -30;
        greenGhost[0].style.left = rgx + GHOST_SPEED + 'px';
    }
    else if(rgNewDirection == 'left'){
        if(rgx < -30) rgx= 590;
        greenGhost[0].style.left = rgx - GHOST_SPEED + 'px';
    }
     else if(rgNewDirection == 'down'){
        if(rgy > 390) rgy= -30;
        greenGhost[0].style.top = rgy + GHOST_SPEED + 'px';
    }
     else if(rgNewDirection == 'up'){
        if(rgy < -30) rgy= 390;
        greenGhost[0].style.top = rgy - GHOST_SPEED + 'px';
    }
    
    }while(hitWall(greenGhost));
    
  
    ggDirection = rgNewDirection;
}

function loadComplete() {
    output = $("#output").html("page loaded");
    pacman = $("#pacman");
    pacman.css({ 'left': '280px', 'top': '240','width' : '32px','height' : '32px' }); //JQuery
    
    redGhost = $("#redGhost");
    redGhost.css({ 'left': '280px', 'top': '160','width' : '32px','height' : '32px' }); //JQuery
    
    greenGhost = $("#greenGhost");
    greenGhost.css({ 'left': '280px', 'top': '160','width' : '32px','height' : '32px' }); //JQuery
    
    loopTimer = setInterval(loop, 70);
    //inside wall
    //createWall(200,280,200,40);
    
    createWall(240, 200, 120, 40);
    createWall(240, 280, 120, 40);
    createWall(80, 160, 40, 160);
    createWall(480, 160, 40, 160);
    createWall(160, 240, 40, 160);
    createWall(160, 0, 40, 120);
    createWall(400, 240, 40, 160);
    createWall(400, 0, 40, 120);
    createWall(80, 80, 40, 40);
    createWall(480, 80, 40, 40);
    createWall(160, 160, 40, 40);
    createWall(400, 160, 40, 40);
    createWall(240, 80, 40, 80);
    createWall(320, 80, 40, 80);
    createWall(-20, 0, 640, 40);
    createWall(0, 0, 40, 180);
    createWall(0, 220, 40, 180);
    createWall(560, 0, 40, 180);
    createWall(560, 220, 40, 180);
    createWall(-20, 360, 640, 40);
    
    
  
    
}

function createWall(left,top,width,height)
{
    var wall = $('<div>');
    wall.attr('class','wall');
    wall.css({'left':left+'px','top':top+'px','height':height+'px','width':width+'px'});
    $('#gameWindow').append(wall);
    var numWalls = walls.length;
    walls[numWalls] = wall;
    walls.push(wall);
    output.html(walls.length);
}


$(function() {
    //Run at start
    loadComplete();
    
    $(document).keydown(function(event) 
    {
        var originalLeft = pacman[0].style.left;
        var originalRight = pacman[0].style.top;
        
        if(event.keyCode==37)
        {
            pacman.css('left',parseInt(pacman[0].style.left) - PACMAN_SPEED +'px');
            direction = 'left';
            pacman.attr("class", "flip-horizontal");
        }
        
        if(event.keyCode==38)
        {
            pacman.css('right',parseInt(pacman[0].style.top) - PACMAN_SPEED +'px');
            direction = 'up';
            pacman.attr("class", "rotate270");
        }
        
        if(event.keyCode==39)
        {
            pacman.css('right',parseInt(pacman[0].style.left) + PACMAN_SPEED +'px');
            direction = 'right';
            pacman.attr("class", "");
        }
        
    
        if(event.keyCode==40)
        {
            pacman.css('right',parseInt(pacman[0].style.top) + PACMAN_SPEED +'px');
            direction = 'down';
            pacman.attr("class", "rotate90");
        }
        
        pacman[0].style.left = originalLeft;
        pacman[0].style.right = originalRight;
    });
/*  $(document).keyup(function(event) {
        output.html(event.keyCode);
        if (event.keyCode == 37)
            leftArrowDown = false;
        if (event.keyCode == 38)
            upArrowDown = false;
        if (event.keyCode == 39)
            rightArrowDown = false;
        if (event.keyCode == 40)
            downArrowDown = false;

     

    })
    */
/*
    $(document).keydown(function(event) {
        output.html(event.keyCode);
        if (event.keyCode == 37) {
            leftArrowDown = true;
            pacman.attr("class", "flip-horizontal");
        }
        if (event.keyCode == 38) {
            upArrowDown = true;
            pacman.attr("class", "rotate270");
        }
        if (event.keyCode == 39) {
            rightArrowDown = true;
            pacman.attr("class", "");
        }
        if (event.keyCode == 40) {
            downArrowDown = true;
            pacman.attr("class", "rotate90");
        }

    }) */
});
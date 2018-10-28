

window.onload=function(){
var elems = document.querySelectorAll('.sidenav');
var instances = M.Sidenav.init(elems,options);
var options = {
      menuWidth: 300, // Default is 300
      edge: 'left', // Choose the horizontal origin
      closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true // Choose whether you can drag to open on touch screens
    }
    
instances = M.Sidenav.init(elems,options);


//Draggable fuction
function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    // if present, the header is where you move the DIV from:
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV: 
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
// Make the DIV element draggable:
dragElement(document.getElementById("picMask"));

document.getElementById("navButtonTrigger").addEventListener("click", function(){
    if(instances[0].isOpen){
      instances[0].close();
      var link = document.getElementById('fullScreen');
      link.style = 'visibility : visible !important;'; 
      var link = document.getElementById('smallScreen');
      link.style = 'visibility :  visible !important'; 
    }
    else{
      instances[0].open();
      var link = document.getElementById('fullScreen');
      link.style = 'visibility : hidden  !important'; 
      var link = document.getElementById('smallScreen');
      link.style = 'visibility : visible  !important'; 
      
    }
});

}

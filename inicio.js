document.getElementById("btn_open").addEventListener("click", open_close_menu);

var menu_side = document.getElementById("menu_side");
var btn_open = document.getElementById("btn_open");
var body = document.getElementById("body");

//evento aparecer y desaparecer//

  function open_close_menu(){
    body.classList.toggle("body_move");
    menu_side.classList.toggle("menu_side_move");
  
  }
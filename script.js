//esto se usa para hacer que el registro aparezca y el login tambien aparezca//

const loginForm = document.querySelector('.formulario__login');
const registerForm = document.querySelector('.formulario__register');
const registerBtn = document.getElementById('register_btn');
const loginBtn = document.getElementById('login_btn');

registerBtn.addEventListener('click', (e) => {
  e.preventDefault();
  loginForm.style.display = 'none';
  registerForm.style.display = 'block';
});

loginBtn.addEventListener('click', (e) => {
  e.preventDefault();
  registerForm.style.display = 'none';
  loginForm.style.display = 'block';
});

//esta parte sera para controlar el movimiento de la barra lateral//
document.getElementById("btn_open").addEventListener("click", open_close_menu);

var menu_side = document.getElementById("menu_side");
var btn_open = document.getElementById("btn_open");
var body = document.getElementById("body");

//evento aparecer y desaparecer//

  function open_close_menu(){
    body.classList.toggle("body_move");
    menu_side.classList.toggle("menu_side_move");
  
  }




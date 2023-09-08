console.log("index.js 1.1");
class User {
  name;
  pass;
  permisos = 0;
  active = 1;
  constructor(nombre,password,permisos){

    if(nombre){
      this.name = nombre;
    }

    if(password){
      this.pass = password;
    }

    if(permisos){
      this.permisos = permisos;
    }
  }

}

function init() {
  const myForm = document.querySelector("#login-form");
  const respuesta = document.querySelector("#respuesta");

  myForm.addEventListener("submit", (e) => {
    e.preventDefault();

    let userNameValue = document.querySelector("#user-name").value;
    let userPasswordValue = document.querySelector("#user-password").value;
    
    if (userNameValue != "" && userPasswordValue != "") {
      let nuevoUsuario = new User(userNameValue,userPasswordValue);
      respuesta.textContent = "";
      respuesta.style.display = "none";
      console.log(nuevoUsuario);
      //porConsola(nuevoUsuario);
    } else {
      respuesta.textContent = "es necesario rellenar todos los campos";
      respuesta.style.display = "block";
    }
  })

}

function porConsola(mensaje) {
  let datosUser = []
  for(let key in mensaje){
    console.log(key," : ", mensaje[key]);
  }
}

init();

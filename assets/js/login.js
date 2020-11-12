
$(function () {
    $(document).keypress(function (e) {
        if (e.which == 13) {
            Send();
            return false;
        }
    });
});

function Send() {
  if ($("#usr").val() == "" || $("#psw").val() == "") {
    swal({title: 'Error!', text: 'Ingrese todos los datos', type: 'error'});
  }else{
    $.ajax({
          url:  "functions/Login/LoginHandler.php",
          type: 'POST',
          data: {usr: $("#usr").val(), psw: $("#psw").val(), function:'login'},
          success: function(data){
            
            var json = JSON.parse(data);
            console.log(json);
            if (json == "error") {
              swal({title: 'Error!', text: "Usuario o password incorrecto", type: 'error'});
            } else {
              if (json == 2) {
                location.href = "views/users.php";
              }else{
                location.href = "views/pqr.php";
              }
              
            }
          }
      });
  }
    
}

function modal_register(){
  $("#modal_register").modal("show");
}

function save_user(){
  var name = $("#name").val();
  var pass = $("#pass").val();
  if (name == "" || pass == "") {
    swal("Atención", "Ingrese todos los campos", "error");
  }else{
    $.ajax({
          url:  "functions/Login/LoginHandler.php",
          type: 'POST',
          data: {name:name,pass:pass,function:'save_user'},
          success: function(data){
            console.log(data);
              var json = JSON.parse(data);
              if (json == "true") {
                swal("OK", "Usuario registrado, ya puede ingresar al sistema", "success");
                $("#name").val("");
                $("#pass").val("");
                $("#modal_register").modal("hide");
              }else{
                if (json == "error") {
                  swal("Atención", "El Usuario ya se encuentra registrado", "error");
                }else{
                  swal("Atención", "Error de sistema comuniquese con el administrador", "error");
                }
              }
          }
    });
  }
}
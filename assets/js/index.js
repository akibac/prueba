function modal_save(){
	$("#modal_save").modal("show");
}

function save(){
	var name = $("#name").val();
	if (name == "") {
		swal("Atención", "Ingrese todos los campos", "error");
	}else{
		$.ajax({
	        url:  "functions/Users/UsersHandler.php",
	        type: 'POST',
	        data: {name:name,function:'save'},
	        success: function(data){
	        	console.log(data);
	            var json = JSON.parse(data);
	            if (json == "true") {
	            	swal("OK", "", "success");
	            	location.reload();
	            }else{
	            	swal("Atención", "Error de sistema comuniquese con el administrador", "error");
	            }
	        }
	    });
	}
}

function Delete(id_user){
	swal({
        title: 'Desea eliminar este usuario?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!'
    }).then((result) => {
        if (result) {
            $.ajax({
		        url:  "functions/Users/UsersHandler.php",
		        type: 'POST',
		        data: {id_user:id_user,function:'delete'},
		        success: function(data){
		            var datos = JSON.parse(data);
		            swal({
	                    type: 'success',
	                    title: 'OK',
	                    text: 'Registro Eliminado'
	                });
	                location.reload();
		        }
		    });
        }
    }).catch(swal.noop)
}
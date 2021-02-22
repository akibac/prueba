$(document).ready(function(){
	 $('#table_user').DataTable();
});

function validate_form(name){
	var array = document.forms[name].getElementsByTagName("input");
	var res = true;
	for (var i = 0;  i < array.length; i++) {
		if (array[i].value == "") {
			res = false;
			break
		}
	}	
	return res;
}

function modal_new(){
	$("#modal_new").modal("show");
}

function save(){
	if (validate_form('users')) {
		var name = $("#name").val();
		var pass = $("#password").val();
		var type = $("#type_user").val();
		var user_log = $("#user_log").val();
		$.ajax({
	        url:  "../functions/Users/UsersHandler.php",
	        type: 'POST',
	        data: {name:name,pass:pass,type:type,user_log:user_log,function:'save_user'},
	        success: function(data){
	            var json = JSON.parse(data);
	            if (json == "true") {
	            	swal("OK", "", "success");
	            	setTimeout(function(){ location.reload(); }, 1500);
	            }else{
	            	swal("Atención", "Error de sistema comuniquese con el administrador", "error");
	            }
	            
	        }
	    });
	}else{
		swal("Atención", "Ingrese todos los campos", "error");
	}
}

function modal_update(id_user){
	$.ajax({
        url:  "../functions/Users/UsersHandler.php",
        type: 'POST',
        data: {id_user:id_user,function:'Get_User_ID'},
        success: function(data){
            var json = JSON.parse(data);
            $("#id_userU").val(json.id_user);
            $("#nameU").val(json.name);
            $("#type_userU option[value='"+json.type_user+"']").attr("selected", true);

            $("#modal_update").modal("show");
        }
    });
}

function update(){
	if (validate_form('usersU')) {
		var id_user = $("#id_userU").val();
		var name = $("#nameU").val();
		var type = $("#type_userU").val();
		var user_log = $("#user_log").val();
		$.ajax({
	        url:  "../functions/Users/UsersHandler.php",
	        type: 'POST',
	        data: {id_user:id_user,name:name,type:type,user_log:user_log,function:'update_user'},
	        success: function(data){
	            var json = JSON.parse(data);
	            if (json == "true") {
	            	swal("OK", "", "success");
	            	setTimeout(function(){ location.reload(); }, 1500);
	            }else{
	            	swal("Atención", "Error de sistema comuniquese con el administrador", "error");
	            }
	            
	        }
	    });
	}else{
		swal("Atención", "Ingrese todos los campos", "error");
	}
}

function delete_user(id_user){
	swal({
        title: 'Desea eliminar este Usuario?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!'
    }).then((result) => {
        if (result) {
            $.ajax({
		        url:  "../functions/Users/UsersHandler.php",
		        type: 'POST',
		        data: {id_user:id_user,function:'delete'},
		        success: function(data){
		            var datos = JSON.parse(data);
		            swal({
	                    type: 'success',
	                    title: 'OK',
	                    text: 'Usuario Eliminado'
	                });
	                setTimeout(function(){ location.reload(); }, 1500);
		        }
		    });
        }
    }).catch(swal.noop)
}
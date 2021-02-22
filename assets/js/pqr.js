$(document).ready(function(){
	 $('#table_pqr').DataTable();
});

function modal_save(){
	$("#modal_save").modal("show");
}

function save(){
	var type_pqr = $("#type_pqr").val();
	var subject = $("#subject").val();
	var user = $("#user").val();
	var user_log = $("#id_user_log").val();
	if (subject == "") {
		swal("Atención", "Error de sistema comuniquese con el administrador", "error");
	}else{
		$.ajax({
	          url:  "../functions/PQR/PQRHandler.php",
	          type: 'POST',
	          data: {type_pqr:type_pqr,subject:subject,user:user,user_log:user_log,function:'save'},
	          success: function(data){
	              var json = JSON.parse(data);
	              if (json == "true") {
	                swal("OK", "PQR Registrada con exito", "success");
	                setTimeout(function(){ location.reload(); }, 1500);
	              }else{
	                swal("Atención", "Error de sistema comuniquese con el administrador", "error");
	              }
	          }
	    });
	}
}

function show_subject(id_pqr){
	$.ajax({
          url:  "../functions/PQR/PQRHandler.php",
          type: 'POST',
          data: {id_pqr:id_pqr,function:'get_subject'},
          success: function(data){
              var json = JSON.parse(data);
              $("#user_pqr").text(json.name);
              $("#content_subject").text(json.subject);
              $("#state").text(json.state);
              $("#state_v").val(json.state);
              $("#id_pqr_state").val(id_pqr);
              $("#modal_subject").modal("show");
              console.log(json);
          }
    });
}

function modal_update(id_pqr){
	$.ajax({
		url:  "../functions/PQR/PQRHandler.php",
		type: 'POST',
		data: {id_pqr:id_pqr,function:'get_data_update'},
		success: function(data){
			var json = JSON.parse(data);
			$("#type_pqr_edit option[value='"+json.type_pqr+"']").attr("selected", true);
			$("#user_edit option[value='"+json.id_user+"']").attr("selected", true);
			$("#subject_edit").text(json.subject);
			$("#id_pqr").val(id_pqr);
			$("#date_create").val(json.date_create);
			$("#modal_update").modal("show");
			console.log(json);
		}
    });
}

function update(){
	var id_pqr = $("#id_pqr").val();
	var type_pqr = $("#type_pqr_edit").val();
	var subject = $("#subject_edit").val();
	var user = $("#user_edit").val();
	var date_create = $("#date_create").val();
	var user_log = $("#id_user_log").val();
	$.ajax({
		url:  "../functions/PQR/PQRHandler.php",
		type: 'POST',
		data: {id_pqr:id_pqr,type_pqr:type_pqr,subject:subject,user:user,date_create:date_create,user_log:user_log,function:'update'},
		success: function(data){
			var json = JSON.parse(data);
			swal("OK", "PQR Actualizada con exito", "success");
	        setTimeout(function(){ location.reload(); }, 1500);
		}
    });
}

function delete_pqr(id_pqr){
	var user_log = $("#id_user_log").val();
	swal({
        title: 'Desea eliminar este registro?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!'
    }).then((result) => {
        if (result) {
            $.ajax({
		        url:  "../functions/PQR/PQRHandler.php",
		        type: 'POST',
		        data: {id_pqr:id_pqr,user_log:user_log,function:'delete'},
		        success: function(data){
		            var datos = JSON.parse(data);
		            swal({
	                    type: 'success',
	                    title: 'OK',
	                    text: 'Registro Eliminado'
	                });
	                setTimeout(function(){ location.reload(); }, 1500);
		        }
		    });
        }
    }).catch(swal.noop)
}

function update_state(){
	var id_pqr = $("#id_pqr_state").val();
	var state = $("#state_v").val();
	var msm = "Nuevo";
	if (state == "Nuevo") {
		msm = "En Ejecucion";
	}else{
		if (state == "En Ejecucion") {
			msm = "Cerrado";
		}
	}
	swal({
        title: 'Atención',
        text: "se cambiará el estado del PQR a "+msm+" desea cambiarlo?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!'
    }).then((result) => {
        if (result) {
            $.ajax({
		        url:  "../functions/PQR/PQRHandler.php",
		        type: 'POST',
		        data: {id_pqr:id_pqr,msm:msm,function:'update_state'},
		        success: function(data){
		            var datos = JSON.parse(data);
		            swal({
	                    type: 'success',
	                    title: 'OK',
	                    text: 'Estado Actualizado'
	                });
	                setTimeout(function(){ location.reload(); }, 1500);
		        }
		    });
        }
    }).catch(swal.noop)
}
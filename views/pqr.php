<?php
session_start();
if (!isset($_SESSION['user'])) {
	header("Location: ../index.php");
}else{
	if($_SESSION['type_user'] == "2"){
		header("Location: ../views/users.php");
	}
}
include '../functions/PQR/PQR.php';
include 'template/header.php';

$testObject = new PQR();
$data = $testObject->Get_PQR();
$type_pqr = $testObject->Get_type_PQR();
$type_pqr2 = $testObject->Get_type_PQR();
$users = $testObject->Get_Users();
$users2 = $testObject->Get_Users();

?>
	<input type="hidden" id="id_user_log" value="<?=$_SESSION['id_user']?>">
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Lista de PQR</h3>
                </div>
                <div class="col text-right">
                  <a href="#!" class="btn btn-sm btn-primary" onclick="modal_save()">Nuevo</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
			<table class="table align-items-center table-flush" id="table_pqr">
			    <thead class="thead-light">
			      <tr>
			        <th scope="col">ID</th>
			        <th scope="col">Tipo de PQR</th>
			        <th scope="col">Usuario</th>
			        <th scope="col">Estado</th>
			        <th scope="col">Fecha creación</th>
			        <th scope="col">Fecha Limite</th>
			        <th scope="col">Acciones</th>
			      </tr>
			    </thead>
			    <tbody>
			    	<?php while($value = $data->fetch_object()){ ?>
			    		<tr>
			                <th scope="row">
			                	<?= $value->id_pqr ?>
			                </th>
			                <td>
			                  <?= utf8_encode($value->description) ?>
			                </td>
			                <td>
			                	<?= $value->name ?>
			                </td>
			                <td>
			                	<?php 
			                	if ($value->date_limit < date("Y-m-d")) { ?>
			                		<?= $value->state ?> <strong>(Vencido)</strong>
			                	<?php }else{
			                		echo $value->state;
			                	}  ?>
			                </td>
			                <td>
			                	<?= $value->date_create ?>
			                </td>
			                <td>
			                	<?= $value->date_limit ?>
			                </td>
			                <td>
			                	<?php if ($value->state == "Cerrado"){ ?>
			                		El PQR se encuentra en estado <strong>Cerrado</strong>
			                	<?php }else{ ?>
				                	<button class="btn btn-icon btn-success" type="button" onclick="modal_update(<?=$value->id_pqr?>)">
										<span class="btn-inner--icon"><i class="ni ni-zoom-split-in"></i></span>
									    <span class="btn-inner--text">Editar datos</span>
									</button>
									<button class="btn btn-icon btn-primary" title="mostar asunto" type="button" onclick="show_subject(<?= $value->id_pqr ?>)">
										<span class="btn-inner--icon"><i class="ni ni-zoom-split-in"></i></span>
										<span class="btn-inner--text">Actualizar estado</span>
									</button>
									<button class="btn btn-icon btn-danger" type="button" onclick="delete_pqr(<?= $value->id_pqr ?>)">
										<span class="btn-inner--icon"><i class="ni ni-basket"></i></span>
										<span class="btn-inner--text">Eliminar PQR</span>
									</button>
			                	<?php } ?>
			                </td>
			             </tr>
			    	<?php } ?>
			    </tbody>
			</table>
            </div>
          </div>
        </div>
      </div>

<?php include 'template/footer.php'; ?>

<script src="../assets/js/pqr.js"></script>

<!-- Modal -->
<div class="modal fade" id="modal_save">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Nuevo PQR</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
	      	<div class="modal-body p-0">
	            	
				<div class="card bg-secondary border-0 mb-0">
				    <div class="card-body px-lg-5 py-lg-5">
				        <form role="form">
				            <div class="form-group mb-3">
			                	<label for="exampleFormControlSelect2">Tipo de  PQR</label>
								<select class="form-control" id="type_pqr">
									<?php while($value = $type_pqr->fetch_object()){ ?>
										<option value="<?= $value->id_type ?>"><?=utf8_encode($value->description) ?></option>
									<?php } ?>
								</select>   
				            </div>
				            <div class="form-group mb-3">
			                	<label>Asunto</label>
			                	<textarea class="form-control" id="subject"></textarea> 
				            </div>
				            <div class="form-group mb-3">
			                	<label for="exampleFormControlSelect2">Usuario</label>
								<select class="form-control" id="user">
									<?php while($value = $users->fetch_object()){ ?>
										<option value="<?= $value->id_user ?>"><?=utf8_encode($value->name) ?></option>
									<?php } ?>
								</select>   
				            </div>
				            <div class="text-center">
				                <button type="button" class="btn btn-primary my-4" onclick="save()">Guardar</button>
				            </div>
				        </form>
				    </div>
				</div>
	    	</div>
	  </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_subject">
  	<div class="modal-dialog modal- modal-dialog-centered" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Actualizar estado del PQR <label id="user_pqr"></label></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
	      	<div class="modal-body p-0">
	      		<div class="card bg-secondary border-0 mb-0">
	      			<div class="card-body px-lg-5 py-lg-5">
	      				<form role="form">
	      					<div class="form-group mb-3">
		      					<h3>Asunto del PQR - Estado (<label id="state"></label>)</h3>
		      					<p id="content_subject"></p>
		      					<input type="hidden" id="state_v">
		      					<input type="hidden" id="id_pqr_state">
		      				</div>
		      				
		      				<div class="text-center">
				                <button type="button" class="btn btn-primary my-4" onclick="update_state()">Actualizar</button>
				            </div>
	      				</form>
	      			</div>
				</div>
	    	</div>
	  	</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_update">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Editar PQR</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
	      	<div class="modal-body p-0">
	            	
				<div class="card bg-secondary border-0 mb-0">
				    <div class="card-body px-lg-5 py-lg-5">
				        <form role="form">
				            <div class="form-group mb-3">
			                	<label for="exampleFormControlSelect2">Tipo de  PQR</label>
								<select class="form-control" id="type_pqr_edit">
									<?php while($value = $type_pqr2->fetch_object()){ ?>
										<option value="<?= $value->id_type ?>"><?= utf8_encode($value->description) ?></option>
									<?php } ?>
								</select>   
				            </div>
				            <div class="form-group mb-3">
			                	<label>Asunto</label>
			                	<textarea class="form-control" id="subject_edit"></textarea> 
				            </div>
				            <div class="form-group mb-3">
			                	<label for="exampleFormControlSelect2">Usuario</label>
								<select class="form-control" id="user_edit">
									<?php while($value = $users2->fetch_object()){ ?>
										<option value="<?= $value->id_user ?>"><?= utf8_encode($value->name) ?></option>
									<?php } ?>
								</select>   
								<input type="hidden" id="id_pqr">
								<input type="hidden" id="date_create">
				            </div>
				            <div class="text-center">
				                <button type="button" class="btn btn-primary my-4" onclick="update()">Guardar</button>
				            </div>
				        </form>
				    </div>
				</div>
	    	</div>
	  </div>
	</div>
</div>

</body>

</html>
<?php
session_start();
if (!isset($_SESSION['user'])) {
	header("Location: ../index.php");
}
include '../functions/Users/Users.php';
include 'template/header.php';

$testObject = new Users();
$data = $testObject->Get_Users();
$type = $testObject->Get_Type_Users();
$type2 = $testObject->Get_Type_Users();
?>
<input type="hidden" id="user_log" value="<?=$_SESSION['id_user']?>">
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Lista de Usuarios</h3>
                </div>
                <div class="col text-right">
                  <a href="#!" class="btn btn-sm btn-primary" onclick="modal_new()">Nuevo usuario</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
			<table class="table align-items-center table-flush" id="table_user">
			    <thead class="thead-light">
			      <tr>
			      	<th scope="col">ID Usuario</th>
			        <th scope="col">Nombre</th>
			        <th scope="col">Tipo de Usuario</th>
			        <th scope="col">Acción</th>
			      </tr>
			    </thead>
			    <tbody>
			    	<?php
			    	if ($data->num_rows == 0) {
			    		echo "no hay usuarios registrados en el sistema";
			    	}else{ ?>
			    		<?php while($value = $data->fetch_object()){ ?>
			    		<tr>
			                <td>
			                	<?= $value->id_user ?>
			                </td>
			                <td>
			                	<?= $value->name ?>
			                </td>
			                <td>
			                	<?= $value->type ?>
			                </td>
			                <td>
			                	<button class="btn btn-icon btn-success" type="button" onclick="modal_update(<?=$value->id_user?>)">
											<span class="btn-inner--icon"><i class="ni ni-zoom-split-in"></i></span>
										    <span class="btn-inner--text">Editar Usuario</span>
										</button>
								<!-- <button class="btn btn-icon btn-danger" type="button" onclick="delete_user(<?= $value->id_user ?>)">
									<span class="btn-inner--icon"><i class="ni ni-basket"></i></span>
									<span class="btn-inner--text">Eliminar Usuario</span>
								</button> -->
			                </td>
			            </tr>
			    	<?php } ?>
			    	<?php } ?>
			    </tbody>
			</table>
            </div>
          </div>
        </div>
      </div>
  	</div>

<?php include 'template/footer.php'; ?>

<script src="../assets/js/users.js"></script>

<!-- Modal -->
<div class="modal fade" id="modal_new">
  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <h5 class="modal-title">Nuevo Registro</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		    <div class="modal-body p-0">
				<div class="card bg-secondary border-0 mb-0">
				    <div class="card-body px-lg-5 py-lg-5">
				        <form role="form" name="users">
				            <div class="form-group mb-3">
				                <div class="form-group">
				                	<label>Nombre</label>
				                    <input class="form-control" placeholder="Nombre" type="text" id="name">
				                </div>
				                <div class="form-group">
				                	<label>Contraseña</label>
				                    <input class="form-control" placeholder="Nombre" type="password" id="password">
				                </div>
				                <div class="form-group">
				                	<label>Tipo de usuario</label>

				                    <select class="form-control" id="type_user">
				                    	<?php while($value = $type->fetch_object()){ ?>
				                    		<option value="<?= $value->id_type ?>"><?= $value->description ?></option>
				                    	<?php } ?>
				                    </select>
				                </div>
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

<!-- Modal UPDATE -->
<div class="modal fade" id="modal_update">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <h5 class="modal-title">Actualizar Registro</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		    <div class="modal-body p-0">
				<div class="card bg-secondary border-0 mb-0">
				    <div class="card-body px-lg-5 py-lg-5">
				        <form role="form" name="usersU">
				            <div class="form-group mb-3">
				                <div class="form-group">
				                	<label>Nombre</label>
				                    <input class="form-control" placeholder="Nombre" type="text" id="nameU">
				                    <input type="hidden" id="id_userU">
				                </div>
				                <div class="form-group">
				                	<label>Tipo de usuario</label>
				                    <select class="form-control" id="type_userU">
				                    	<?php while($value = $type2->fetch_object()){ ?>
				                    		<option value="<?= $value->id_type ?>"><?= $value->description ?></option>
				                    	<?php } ?>
				                    </select>
				                </div>
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
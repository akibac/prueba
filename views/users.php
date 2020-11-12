<?php
session_start();
if (!isset($_SESSION['user'])) {
	header("Location: ../index.php");
}
include '../functions/Users/Users.php';
include 'template/header.php';

$testObject = new Users();
$data = $testObject->Get_PQR();
?>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Lista de Quejas</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
			<table class="table align-items-center table-flush">
			    <thead class="thead-light">
			      <tr>
			      	<th scope="col">ID</th>
			        <th scope="col">Tipo de PQR</th>
			        <th scope="col">Usuario</th>
			        <th scope="col">Estado</th>
			        <th scope="col">Fecha creación</th>
			        <th scope="col">Fecha Limite</th>
			      </tr>
			    </thead>
			    <tbody>
			    	<?php
			    	if ($data->num_rows == 0) {
			    		echo "no tiene quejas registradas en el sistema";
			    	}else{ ?>
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
			            </tr>
			    	<?php } ?>
			    	<?php } ?>
			    </tbody>
			</table>
            </div>
          </div>
        </div>
      </div>

<?php include 'template/footer.php'; ?>

<script src="../assets/js/index.js"></script>

<!-- Modal -->
<div class="modal fade" id="modal_save" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    	<div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	    </div>
	    <div class="modal-body p-0">
	            	
			<div class="card bg-secondary border-0 mb-0">
			    <div class="card-body px-lg-5 py-lg-5">
			        <form role="form">
			            <div class="form-group mb-3">
			                <div class="input-group input-group-merge input-group-alternative">
			                   <!--  <div class="input-group-prepend">
			                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
			                    </div> -->
			                    <input class="form-control" placeholder="Nombre" type="text" id="name">
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
</body>

</html>
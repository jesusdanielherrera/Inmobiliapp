<!DOCTYPE html>
<html>
<head>
	<?php
		require_once "scripts.php";
	 ?>
	<title>InmobiliApp</title>
</head>
<?php 
    session_start();
    require_once "php/conexion.php";

     if(isset($_SESSION['user'])){ 
      
      $usuario = $_SESSION['user'];
      $sql = "SELECT  * from login where usuario='$usuario' and tipodeusuario='Asesor'";
      $result=mysqli_query($conexion,$sql);
?>
<body>
	<form action="php/cerrarsesion.php" method="POST">
		<nav class="navbar navbar-light bg-light navbar-toggleable-sm">
       <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <a class="navbar-brand" href="ModuloAsesor.php">
           <img src="img/inmoviliapp22.png" class="d-inline-block align-top" alt="Logo boostrap"  style="width: 300px">
        </a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo01">
        <div class="navbar-nav ">
            <b><a type="button" class="nav-item nav-link active btn-outline-secondary" style="margin:5px;" href="ModuloAsesor.php">Modulo Administrativo</a></b>
        </div>
      </div>
       <form class="form-inline my-2 my-lg-0">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown ">
        <a type="button" style="background-color: gray;" class="btn btn-outline-secondary dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <img src="img/ico3-blanco.png" style="background-color: gray; ">
           <?php       
            while ($dato=mysqli_fetch_array($result)) {
            ?><b>
            <?php  echo $dato['Nombre'];
             ?>
           </b>
        </a>
        <div class="dropdown-menu" style="position: absolute; top:50px;" aria-labelledby="navbarDropdown">
          <a type="button" class="dropdown-item" href="php/cerrarsesion.php">Cerrar Sesion</a>
          </a>
      </li>
      </ul>
     
    </form >
    </nav>
     	<nav aria-label="breadcrumb" class="container-fluid">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page"><a href="ModuloAsesor.php">Modulo Administrativo</a></li>
          <li class="breadcrumb-item active" aria-current="page">Ventas realizadas</li>
          
        </ol>
          		<table class="container table table-bordered table-responsive">
		          <thead>
		            <th colspan="8"><b><h5>VIVIENDAS EN VENTAS</h5></b></th>
                <form action="BuscarIDpA.php" method="get" class="form-search">
                <!-- BUSCADOR POR ID DE ARRIENDO -->
                <th colspan="3"> <input type="text" class="form-control" id="Buscar" name="Buscar" ></th>
                <th colspan="3"> <input type="submit" class="btn btn-primary btn-block" id="BuscarID" Value="Buscar..." ></th>
                </form>
		            <tr class="text-center">             
		             
		              <th scope="col" >ID Arriendo</th>
                  <th scope="col" >ID Usuario</th>
		              <th scope="col" >tipo de Propiedad</th>
		              <th scope="col" >Estado </th>
		              <th scope="col" >Precio </th>
		              <th scope="col" >Vistas </th>
		              <th scope="col" >Dormitorios </th>
		              <th scope="col" >Antiguedad </th>
		              <th scope="col" >Terrenos </th>
		              <th scope="col" >Ciudad </th>
		              <th scope="col" >Piso</th>
                  <th scope="col" >direccion</th>
		              <th colspan="2" >Operar</th>
		            </tr>
		          </thead>
		          <?php
                $datos=$dato['idusuario'];}
          		 	$sqll="SELECT * FROM registroventa where idarriendov='$datos'";
          		 	$resultl=mysqli_query($conexion,$sqll);

          		 	while ($mostrar=mysqli_fetch_row($resultl)) {
                      $datosv=$mostrar[0]."||".
                             $mostrar[1]."||".
                             $mostrar[2]."||".
                             $mostrar[4]."||".
                             $mostrar[5]."||".
                             $mostrar[6]."||".
                             $mostrar[7]."||".
                             $mostrar[8]."||".
                             $mostrar[9]."||".
                             $mostrar[10]."||".
                             $mostrar[23] ;
          		  ?>
		          <tbody>
	                  <tr>
	                      <th scope="row" > <?php echo $mostrar[0];?></th>
	                      <td > <?php echo $mostrar[1]; ?></td>
	                      <td > <?php echo $mostrar[2]; ?></td>
	                      <td > <?php echo $mostrar[3] ;?></td>
	                      <td > <?php echo $mostrar[4] ;?></td>
	                      <td > <?php echo $mostrar[5] ;?></td>
	                      <td > <?php echo $mostrar[6] ;?></td>
	                      <td > <?php echo $mostrar[7] ;?></td>
	                      <td > <?php echo $mostrar[8] ;?></td>
	                      <td > <?php echo $mostrar[9] ;?></td>
	                      <td > <?php echo $mostrar[10] ;?></td>
                        <td > <?php echo $mostrar[23] ;?></td>
	                      <td>
	                      	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#Editar" onclick="agregaforma('<?php echo $datosv ?>')">
                          Editar</button>

                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Eliminar" onclick="preguntarSiNoP('<?php echo $mostrar[0] ?>')">
                          Eliminar</button>
	                      </td>               
	                  </tr>
	              </tbody>
                <?php } ?>	
<?php  }else{
	header("Location: php/Validar.php");
} ?>
 <!-- Modal Editar -->
                  <form id="actualizardatos">
                  <div class="modal fade" id="Editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    <div class="modal-body">
                      <div class="container-fluid table table-bordered">
                        <div class="col-sm-auto col-md-auto col-xl-auto">
                          <br>
                          <h4>DETALLES BASICOS: </h4>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-auto col-md-auto col-xl-auto" style="margin: 10px;">
                             Id  Venta: <br>
                            <input type="text" class="form-control" id="iddelestadoP" >
                          </div>
                           <div class="col-sm-auto col-md-auto col-xl-auto" style="margin: 10px;">
                             Id Acesor o Administrador: <br>
                            <input type="text" class="form-control" id="idarriendov" >
                          </div>
                          <div class="col-sm-auto col-md-auto col-xl-auto" style="margin: 10px;">
                            Tipo de Propiedad: <br>
                            <select class="form-control" type="text" id="tipoPropiedad">
                                    <option>---</option>
                                    <option>Casa</option>
                                    <option>Apartamento</option>
                                    <option>Local</option>
                                    <option>Finca</option>
                                  </select>
                          </div>
                          <div class="col-sm-auto col-md-auto col-xl-auto" style="margin: 10px;">
                            Precio de Propiedad:   <br>
                             <input type="text" class="form-control" id="preciopropiedad" >
                          </div>
                 
                          <div class="col-sm-auto col-md-auto col-xl-auto"style="margin: 10px;">
                            Vistas de la Propiedad:   <br>
                             <input type="text" class="form-control" id="vistapropiedad" >
                          </div>
                
                          <div class="col-sm-auto col-md-auto col-xl-auto" style="margin: 10px;">
                            Dormitorios:<br>
                             <input type="text" class="form-control" id="dormitorios" >
                          </div>
                          
                          <div class="col-sm-auto col-md-auto col-xl-auto" style="margin: 10px;">
                            Antiguedad: <br>
                             <input type="text" class="form-control" id="antiguedad" >
                          </div>

                          <div class="col-sm-auto col-md-auto col-xl-auto" style="margin: 10px;">
                            Terrenos :   <br>
                             <input type="text" class="form-control" id="terrenos">
                          </div>
                           <div class="col-sm-auto col-md-auto col-xl-auto" style="margin: 10px;">
                            CIUDAD: <br>
                            <input type="text" class="form-control" id="ciudad">
                          </div>
                          
                          <div class="col-sm-auto col-md-auto col-xl-auto" style="margin: 10px;">
                            PISO #: <br>
                             <input type="text" class="form-control" id="piso" >
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" id="actualizadatosv"data-dismiss="modal">Actualizar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                  </div>
                  </form>
<script type="text/javascript">
  $(document).ready(function(){
    $('#actualizadatosv').click(function() {
      actualizaDatosv();
    });
  })
</script>
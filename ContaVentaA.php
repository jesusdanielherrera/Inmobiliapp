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
      $sql = "SELECT  idusuario, usuario from login where usuario='$usuario'and tipodeusuario='Asesor'";
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
            <?php  echo $dato['usuario'];
             ?>
           </b>
        </a>
        <div class="dropdown-menu" style="position: absolute; top:50px;" aria-labelledby="navbarDropdown">
          <a class="dropdown-item"  type="button" href="perfilC.php">Perfil</a>
          <a type="button" class="dropdown-item" href="php/cerrarsesion.php">Cerrar Sesion</a>
          </a>
      </li>
      </ul>
    </nav>
  </form >
  <form id="frmregistro">
      <nav aria-label="breadcrumb" class="container-fluid">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"aria-current="page"><a href="ModuloAsesor.php">Modulo Administrativo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contabilidad en Ventas</li>
      </nav>
      <div class="container">
        <div class="table-bordered"><br>
          <th><B>CONTABILIDAD EN VENTAS</B></th><br><hr>
          <th><B>ID: <?php echo  $dato['idusuario']; ?></B></th><br><hr>
          <th><B>USUARIO: <?php echo  $dato['usuario']; ?></B></th><hr>
        </div>
      </div>
      <div class="container">
       
        <table class="table table-bordered">
          <thead>
            <th colspan="5"><b><h5>VIVIENDAS EN VENTAS</h5></b></th>
            <tr class="text-center">
              <th scope="cole"  class="text-center">ID</th>
              <th scope="cole"  class="text-center">ID Asesor o Administrador</th>
              <th scope="cole"  class="text-center">VALOR DE VENTA</th>
              <th scope="cole"  class="text-center">VALOR COMISION</th>
              <th scope="cole"  class="text-center">VALOR A PAGAR</th>
            </tr>
          </thead>
           <tbody>  
              <?php
            $datos = $dato['idusuario'];
             $sqls = "SELECT  idarriendov,iddelestadoP, preciopropiedad, (preciopropiedad*0.10) as result from registroventa where idarriendov='$datos'";}
             $results=mysqli_query($conexion,$sqls);   
             while ($datos=mysqli_fetch_array($results)) {
            ?>
                  <tr>
                      <th scope="row" class="text-center"> <?php echo $datos['iddelestadoP'];?></th>
                      <td class="text-center"> <?php echo $datos['idarriendov']; ?></td>
                      <td class="text-center"> <?php echo $datos['preciopropiedad']; ?></td>
                      <td class="text-center">10%</td>
                      <td class="text-center"><?php echo $datos['result'] ;}?></td>
                  </tr>
                </tbody>
        </table>
      </div>
  </form>
 <?php } else{
   header("Location: php/Validar.php");
} ?>
</body>
</html>
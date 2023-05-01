
<?php 
    session_start();
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Nuevo Usuario</title>
        <?php include "../Modelo/scripts.php"?>
    </head>
    <body>
        <input type="checkbox" id="menu-toggle">
        <!--Sidebar Inicio-->
        <?php include "sidebar.php" ?>
        <!--Sidebar Fin-->

        <div class="main-content">
            <!--Navbar Inicio-->
            <header>
                <div class="togle-p">
                    <label for="menu-toggle" class="menu-toggler">
                        <span class="las la-bars"></span>
                    </label>   
                    <p>Home</p>   
                </div>           
                
                <div class="head-icons">
                    <span ><?php echo fechaC(); ?></span>
                    <a href="../Modelo/salir.php"><span class="fas fa-sign-out-alt"></span></a>    
                </div>
            </header>
            <!--Navbar Fin-->
            <section>
                <?php 
                    include "../Controlador/RegistroControlador.php";
                ?>
                <div class="container-new-user">
                    <div class="section-new-user">
                        <p>Nuevo Usuario</p>
                        <form action="" method="post">
                        <div class="formulario-new-user">
                                <div class="conten-p-new">
                                    <div class="contenido-new">
                                        <label for="dni">DNI:</label>
                                        <input type="number" name="dni" id="dni" placeholder="DNI" value="">
                                    </div>
                                    <div class="contenido-new">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="">
                                    </div>
                                </div>
                                <div class="conten-p-new">
                                    <div class="contenido-new"> 
                                        <label for="edad">Edad:</label>
                                        <input type="number" name="edad" id="edad" placeholder="Edad" value="">
                                    </div>
                                    <div class="contenido-new">
                                        <label for="correo">Correo electrónico:</label>
                                        <input type="email" name="correo" id="correo" placeholder="Correo electrónico" value="">
                                    </div>
                                </div>
                                <div class="conten-p-new">
                                    <div class="contenido-new"> 
                                        <label for="telefono">Telefono:</label>
                                        <input type="number" name="telefono" id="telefono" placeholder="Telefono" value="">
                                    </div>
                                    <div class="contenido-new"> 
                                        <label for="domicilio">Domicilio:</label>
                                        <input type="text" name="domicilio" id="domicilio" placeholder="Domicilio" value="">
                                    </div>
                                </div>
                                <div class="conten-p-new">
                                    <div class="contenido-new"> 
                                        <label for="usuario">Usuario:</label>
                                        <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="">
                                    </div>
                                    <div class="contenido-new">  
                                        <label for="clave">Clave:</label>
                                        <input type="password" name="clave" id="clave" placeholder="Clave de acceso">
                                    </div>
                                </div>
                                
                                
                                <label for="rol">Tipo Usuario:</label>
                                <?php 
                                $query_rol = mysqli_query($conection,"SELECT * FROM rol");
                                mysqli_close($conection);
                                $result_rol = mysqli_num_rows($query_rol);
                                ?>
                                <select name="rol" id="rol">
                                    <?php 
                                        if($result_rol > 0)
                                        {
                                            while ($rol = mysqli_fetch_array($query_rol)) {
                                    ?>
                                            <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
                                    <?php 
                                                
                                        }
                                    
                                    }
                                    ?>
                        </select>
                        </div>
                        <div class="btn-new-user">
                            <a href="Gestion_Usuario.php"><i class="fas fa-undo"></i> Regresar</a>
                            <button type="submit" ><i class="fas fa-edit"></i> Registrar</button>
                        </div>
                        </form>
                    </div>
                </div>              
            </section>
                <div  class="alert" >
                    <?php echo isset($alert) ? $alert : ''; ?>
                </div>
        </div>
        <?php include "../Modelo/Footer.php" ?>
    </body>
</html>
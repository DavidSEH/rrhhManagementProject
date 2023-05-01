<div class="sidebar">
    <div class="brand">
        <span class="lab la-affiliatetheme"></span>
        <h3>TuTrabajo</h3>
    </div>
    <div class="sidemenu">
        <div class="side-user">
            <div  class="side-img-p">
                <img class="side-img" src="../../Imagenes/people.jpg" alt="">
            </div>
            <div class="user">
                <p><?php echo $_SESSION['user']; ?></p>
                <small><?php echo $_SESSION['email']; ?></small>
            </div>
        </div>
        <div class="sider-ul" >
            <ul>
                <li>
                    <a href="ReservaCliente.php">
                        <span class="las la-home"></span>
                        <span>Licencia</span>
                    </a>
                </li>
                <li>
                    <a href="DatosPersonales_Cliente.php?id=<?php echo  $_SESSION['idCli'];?>">
                        <span class="fas fa-user"></span>
                        <span>Datos personales</span>
                    </a>
                </li>
                <li>
                    <a href="ListaReservasCliente.php">
                        <span class="las la-calendar"></span>
                        <span>Licencias gestionadas</span>
                    </a>
                </li>
                <!--li>
                    <a href="Promociones_Cliente.php">
                        <span class="las la-users"></span>
                        <span>Promociones</span>
                    </a>
                </li-->
                
            </ul>
        </div>    
    </div>
 </div>
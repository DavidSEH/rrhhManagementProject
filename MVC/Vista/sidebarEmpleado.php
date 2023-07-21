<div class="sidebar">
    <div class="brand">
        <span class="lab la-affiliatetheme"></span>
        <h3>Talenti S.A.</h3>
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
                    <a href="LicenciasEmpleado.php">
                        <span class="las la-home"></span>
                        <span>Licencia</span>
                    </a>
                </li>
                <li>
                    <a href="ListaLicenciasEmpleado.php">
                        <span class="las la-calendar"></span>
                        <span>Licencias gestionadas</span>
                    </a>
                </li>
            </ul>
        </div>    
    </div>
 </div>
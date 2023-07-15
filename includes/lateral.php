

<!-- BARRA LATERAL -->
<aside id="sidebar">

    <?php if(isset($_SESSION['usuario'])): ?>
        <div id="usuario_logueado" class="bloque">
            <h3>Bienvenido,<?=$_SESSION['usuario']['nombre']. ' ' .$_SESSION['usuario']['apellidos']; ?></h3>
            <!-- botones cerra sesion -->
            <a href="cerrar.php" class="boton verde">Crear entradas</a>
            <a href="cerrar.php" class="boton">Crear categoria</a>
            <a href="cerrar.php" class="boton naranja">Mis datos</a>
            <a href="cerrar.php" class="boton rojo">Cerrar sesión</a>
        </div> 
    <?php endif; ?>           

    <div id="login" class="bloque">

        <h3>Identificate</h3>
        
        <?php if(isset($_SESSION['error_login'])): ?>
        <div  class="alerta alerta-error">
           <?=$_SESSION['error_login'];?>
        </div> 
        <?php endif; ?>  

        <form action="login.php" method="POST">


            <label for="email">Email</label>

            <input type="text" name="email"/>


            <label for="password">contraseña</label>

            <input type="password" name="password"/>

            <input type="submit" value="Entrar"/>

        </form>
    </div>




    <div id="register" class="bloque">

        <h3>Registrate</h3>

        <!-- MOSTRAR ERRORES -->


        <?php if (isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
                <?= $_SESSION['completado'] ?>
            </div>
        <?php elseif (isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-error">
                <?= $_SESSION['errores']['general'] ?>
            </div>
        <?php endif; ?>





        <form action="registro.php" method="POST" target="_blank">

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?> 

            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?> 

            <label for="email">Email</label>
            <input type="text" name="email"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?> 

            <label for="password">contraseña</label>
            <input type="password" name="password"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?> 

            <input type="submit" name="submit" value="Registrar"/>

        </form>
        <?php borrarErrores(); ?>
    </div>
</aside>

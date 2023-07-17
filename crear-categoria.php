<?php
require_once 'includes/cabecera.php';
require_once 'includes/lateral.php';
require_once 'includes/redireccion.php';
?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear Categorías</h1>
    <p>
        Añade lo que te salga de los huevos para rellenar un poco esta puta mierda y que np parezca 
        que esta mas vacía que tu cerebro, subnormal.
    </p>
    <br>
    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" />
        <input type="submit" value="Guardar" />
    </form>

</div> <!--FIN PRINCIPAL-->

<?php require_once 'includes/pie.php'; ?>

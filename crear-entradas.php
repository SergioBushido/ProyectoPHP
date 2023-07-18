<?php
require_once 'includes/cabecera.php';
require_once 'includes/lateral.php';
require_once 'includes/redireccion.php';
$categorias = conseguirCategorias($db);
//var_dump($categorias); con esto veo si la conexion esta bien
?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear entradas</h1>
    <p>
        Esta puta mierda es exactamente igual a la pestaña de crear categorias,
        pero cambio esto para que salga otra puta cosa.
    </p>
    <br>
    <form action="guardar-entrada.php" method="POST">
        <label for="titulo">Titulo: </label>
        <input type="text" name="titulo" />
        
        <label for="descripcion">Descripción: </label>
        <textarea name="descripcion"></textarea>
        
        <label for="categoria">Categoría</label>
    <select name="categoria">
    <?php 
    $categorias = conseguirCategorias($db);
    if (!empty($categorias)) {
        foreach ($categorias as $categoria) {
            $nombre = htmlspecialchars($categoria['nombre']);
            $id = $categoria['id'];
            echo '<option value="' . $id . '">' . $nombre . '</option>';
        }
    }
    ?>
        /*El problema específico es que el texto "Tu Puta Madre" 
        contiene caracteres especiales que están interfiriendo con el código HTML y,
        por lo tanto, el resultado final se muestra de forma incorrecta. Para evitar este problema,
        necesitas utilizar la función htmlspecialchars() al imprimir el nombre de la categoría en el atributo value
        y el contenido del*/
        <option>.
</select>


        
        <input type="submit" value="Guardar" />
    </form>

</div> <!--FIN PRINCIPAL-->

<?php require_once 'includes/pie.php'; ?>

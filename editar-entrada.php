<?php require_once 'includes/conexion.php';?>
<?php require_once 'includes/helpers.php'; ?>
<?php require_once 'includes/redireccion.php';?>

<?php
if (isset($_GET['id'])) {
    $entrada_actual = conseguirEntrada($db, $_GET['id']);
    if (empty($entrada_actual)) {
        // Redirigir a la página de inicio o mostrar un mensaje de error
        header("Location: index.php");
        exit; // Asegurarse de que el script se detenga después de redirigir
    }

    // Ahora que tenemos la entrada actual, podemos obtener su categoría
    $categoria_nombre = $entrada_actual['categoria'];
} else {
    // Redirigir a la página de inicio o mostrar un mensaje de error
    header("Location: index.php");
    exit; // Asegurarse de que el script se detenga después de redirigir
}
?>

<?php
require_once 'includes/cabecera.php';
require_once 'includes/lateral.php';

// Verificar si se hizo clic en "Ver todas las entradas"
$ver_todas = isset($_GET['ver_todas']) && $_GET['ver_todas'] === "true";

// Establecer el límite para mostrar solo 4 entradas o todas las entradas
$limit = $ver_todas ? null : 4;

// Obtener las entradas según el límite
$entradas = conseguirEntradas($db, $limit);
?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Editar entrada</h1>
    <p>
       Efdita tu entrada <?=$entrada_actual['titulo']?>
    </p>
    <br>
    <form action="guardar-entrada.php?editar=<?=$entrada_actual['id']?>" method="POST">
        <label for="titulo">Titulo: </label>
        <input type="text" name="titulo" value="<?=$entrada_actual['titulo']?>" />
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?> 
        
        <label for="descripcion">Descripción: </label>
        <textarea name="descripcion"><?=$entrada_actual['descripcion']?></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?> 
      <label for="categoria">Categoría</label>
<select name="categoria">
    <?php 
    $categorias = conseguirCategorias($db);
    if (!empty($categorias)) {
        foreach ($categorias as $categoria) {
            $nombre = htmlspecialchars($categoria['nombre']);
            $id = $categoria['id'];
            $selected = ($id == $entrada_actual['categoria_id']) ? 'selected="selected"' : '';
            echo '<option value="' . $id . '" ' . $selected . '>' . $nombre . '</option>';
        }
    }
    ?>
</select>
<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>
      <!--  /*El problema específico es que el texto "Tu Puta Madre" 
            contiene caracteres especiales que están interfiriendo con el código HTML y,
            por lo tanto, el resultado final se muestra de forma incorrecta. Para evitar este problema,
            necesitas utilizar la función htmlspecialchars() al imprimir el nombre de la categoría en el atributo value
            y el contenido del*/ -->
   
        
        <input type="submit" value="Guardar" />
    </form>
<?php    borrarErrores();?>
</div> <!--FIN PRINCIPAL-->
<?php require_once 'includes/pie.php'; ?>

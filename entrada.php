<?php require_once 'includes/conexion.php';?>
<?php require_once 'includes/helpers.php'; ?>

<?php
if (isset($_GET['id'])) {
    $entrada_actual = conseguirEntrada($db, $_GET['id']);
    if (empty($entrada_actual)) {
        // Redirigir a la página de inicio o mostrar un mensaje de error
        header("Location: index.php");
        exit; // Asegurarse de que el script se detenga después de redirigir
    }

    // Ahora que tenemos la entrada actual, podemos obtener su categoría
    $categoria_nombre = $entrada_actual[0]['categoria'];
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

<?php if (!empty($entrada_actual)) : ?>
    <h1><?= $entrada_actual[0]['titulo'] ?></h1>
    
    <a href="categoria.php?id=<?=$entrada_actual[0]['categoria_id']?>">//con este href si pinchamos en la categoria nos manda al listado de categorias
    <h2><?= $entrada_actual[0]['categoria'] ?></h2>
    </a>
    
    <h4><?= $entrada_actual[0]['fecha'] ?></h4>
    <p><?= $entrada_actual[0]['descripcion'] ?></p>
<?php else : ?>
    <p>No se encontraron entradas.</p>
<?php endif; ?>

</div> <!-- FIN PRINCIPAL -->

<?php require_once 'includes/pie.php'; ?>

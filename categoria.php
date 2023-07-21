<?php require_once 'includes/conexion.php';?>
<?php require_once 'includes/helpers.php'; ?>

<?php
if (isset($_GET['id'])) {
    $categoria_actual = conseguirCategoria($db, $_GET['id']);
    if (empty($categoria_actual)) {
        // Redirigir a la página de inicio o mostrar un mensaje de error
        header("Location: index.php");
        exit; // Asegurarse de que el script se detenga después de redirigir
    }

    // Ahora que tenemos la categoría actual, podemos obtener su nombre
    $categoria_nombre = $categoria_actual[0]['nombre'];
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
  

   <h1> Entradas de <?= $categoria_nombre ?></h1>


    <?php
    $entradas = conseguirEntradas($db, null, $_GET['id']);
    if (!empty($entradas)):
        foreach ($entradas as $entrada):
    ?>
        <article class="entrada">
            <a href="">
                <h2><?= $entrada['titulo'] ?></h2>
                <span class="fecha"><?= $entrada['titulo'].' | ' .$entrada['fecha'] ?></span>
                <p><?= $entrada['descripcion'] ?></p>
            </a>
        </article>
    <?php
        endforeach;

        // Mostrar enlace para ver todas las entradas solo si hay más de 4 entradas
        if (count($entradas) > 4 && !$ver_todas):
    ?>
        <div id="ver-todas">
            <a href="?ver_todas=true">Ver todas las entradas</a>
        </div>
    <?php
        endif;
    else:
        echo "<div class='alerta'>No se encontraron entradas.</div>";
    endif;
    
    ?>
</div> <!--FIN PRINCIPAL-->

<?php require_once 'includes/pie.php'; ?>

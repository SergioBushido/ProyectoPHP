<?php
require_once 'includes/cabecera.php';
require_once 'includes/lateral.php';

?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Ultimas Entradas</h1>

    <?php
    $entradas = conseguirEntradas($db, 4); // Mostrar solo 4 entradas inicialmente
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
    endif;
    ?>

    <div id="ver-todas">
        <a href="entradas.php?ver_todas=true">Ver todas las entradas</a> <!-- Agregar el parámetro ver_todas=true -->
    </div>
</div> <!--FIN PRINCIPAL-->

<?php require_once 'includes/pie.php'; ?>

<?php

use App\Utils\{GeneralUtils, UriUtils};

$uri = UriUtils::get();
[$route, $view] = UriUtils::split($uri);
$show_incidence = $view === 'incidence.php';

$last_uri = UriUtils::getNthUri(-2);
[$last_route, $last_view] = UriUtils::split($last_uri);
$show_return = $last_view === 'home.php' && $view !== 'home.php';
?>

<div class="container">
    <div class="divMenu">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="<?= GeneralUtils::getActiveClass('home'); ?>"
                    href="<?= $show_return ? $last_uri : '/home.php'; ?>"><?= $show_return ? 'Volver atrás' : 'Inicio'; ?></a>
            </li>
            <?php if (($show_incidence ? substr($last_route, 1) : $route) === 'incidents') { ?>
                <li class="nav-item">
                    <a class="<?= GeneralUtils::getActiveClass('incidents'); ?>"
                        href="<?= $show_incidence ? explode('?', $last_view)[0] : ''; ?>">Incidencias</a>
                </li>
            <?php } ?>
            <?php if ($show_incidence) { ?>
                <li class="nav-item">
                    <a class="<?= GeneralUtils::getActiveClass('incidence'); ?>"
                        href="">Incidencia</a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="view-content">
        <!-- View content here -->

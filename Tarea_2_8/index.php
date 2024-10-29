<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Inscripción</title>
    </head>
    <body>
        <?php
        require_once './funcionesValidacion.php';
        $mensajeError = "";
        $listaModulos = "";
        $nombre = "";
        $anio = "";

        $nombreSinFiltrar = filter_input(INPUT_GET, "nombre");
        $anioSinFiltrar = filter_input(INPUT_GET, "anio");
        $modulosSinFiltrar = filter_input(INPUT_GET, "módulos", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        $conjuntoCampos = $nombreSinFiltrar && $anioSinFiltrar && $modulosSinFiltrar;

        if ($conjuntoCampos) {
            $nombre = validarNombre($nombreSinFiltrar);
            $anio = validarAño($anioSinFiltrar);
            $modulos = validarMódulos($modulosSinFiltrar);
        }

        if ($nombre && $anio && $modulos) {
            $listaModulos = "<ol>";
            foreach ($modulos as $modulo) {
                $listaModulos .= "<li>" . ($modulo) . "</li>";
            }
            $listaModulos .= "</ol>";
        } else {
            $mensajeError = "ERROR: Los campos están vacíos o no son correctos.";
        }
        ?>

        <?php if ($mensajeError) { ?>
            <p><?php echo $mensajeError; ?></p>
        <?php } else if ($conjuntoCampos) { ?>
            <p>Hola, <?php echo ($nombre); ?>, te has matriculado en los módulos:</p>
            <?php echo $listaModulos; ?>
        <?php } ?>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
            <label>Introduce un nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombreSinFiltrar); ?>"></label><br><br>
            <label>Introduce tu año de nacimiento: <input type="text" name="anio" value="<?php echo htmlspecialchars($anioSinFiltrar); ?>"></label><br><br>  
            <label>Selecciona uno o varios módulos:</label><br><br>
            <input type="checkbox" name="módulos[]" value="DWES" <?php if (isset($modulosSinFiltrar) && in_array("DWES", $modulosSinFiltrar)) echo 'checked'; ?>> DWES
            <input type="checkbox" name="módulos[]" value="DWEC" <?php if (isset($modulosSinFiltrar) && in_array("DWEC", $modulosSinFiltrar)) echo 'checked'; ?>> DWEC
            <input type="checkbox" name="módulos[]" value="DIWEB" <?php if (isset($modulosSinFiltrar) && in_array("DIWEB", $modulosSinFiltrar)) echo 'checked'; ?>> DIWEB
            <input type="checkbox" name="módulos[]" value="EIE" <?php if (isset($modulosSinFiltrar) && in_array("EIE", $modulosSinFiltrar)) echo 'checked'; ?>> EIE
            <input type="checkbox" name="módulos[]" value="DESAW" <?php if (isset($modulosSinFiltrar) && in_array("DESAW", $modulosSinFiltrar)) echo 'checked'; ?>> DESAW
            <input type="checkbox" name="módulos[]" value="HLC" <?php if (isset($modulosSinFiltrar) && in_array("HLC", $modulosSinFiltrar)) echo 'checked'; ?>> HLC
            <br><br>
            <button type="submit" name="enviar">Enviar</button>
        </form>
    </body>
</html>

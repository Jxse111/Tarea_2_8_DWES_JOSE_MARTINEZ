<?php

// Patrones
$patronAnio = "/^(18|19|20)\d{2}$/";
$patronNombreYApellidos = "/^(([A-Z])([a-záéíóúäëïöüñÑ])+(\s)*){0,30}$/";
$patronEmail = "/^([A-Za-zÁÉÍÓÚÄËÏÖÜ0-9\-])+@[A-za-z]+\.(com|es)$/";
$patronUrl = "/^((\w*\.)|(www\.))+(com|es)$/";
$patronFecha = "/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(\d{4})$/";

// Funcion de validacion de nombre
function validarCadena($cadena) {
    $cadena = trim($cadena);
    $cadena = stripcslashes($cadena);
    $cadena = strip_tags($cadena);
    $cadena = htmlspecialchars($cadena);
    return $cadena;
}

function validarNombre($nombre) {
    global $patronNombreYApellidos;
    if (validarCadena($nombre)) {
        if (preg_match($patronNombreYApellidos, $nombre)) {
            $resultado = $nombre;
        } else {
            $resultado = false;
        }
    } else {
        $resultado = false;
    }
    return $resultado;
}

function validarEmail($email) {
    global $patronEmail;
    $email = validarCadena($email);
    $esValido = preg_match($patronEmail, $email);
    return $esValido ? $email : false;
}

function validarUrl($url) {
    global $patronUrl;
    $url = validarCadena($url);
    $esValido = preg_match($patronUrl, $url);
    return $esValido ? $url : false;
}

// Funcion de validacion de edad
function validarEdad($numero) {
    $opciones = array('options' => array('min_range' => 12, 'max_range' => 100));
    return filter_var($numero, FILTER_VALIDATE_INT, $opciones) !== false ? $numero : false;
}

// Funcion de validacion de sexo
function validarSexo($campo) {
    $sexo = ["hombre", "mujer"];
    return in_array($campo, $sexo) ? $campo : false;
}

// Funcion de validacion de aficiones
function validarAficiones($campo) {
    $aficionValidada = ["deportes", "musica", "alimentacion", "moda"];
    foreach ($campo as $aficion) {
        if (!in_array($aficion, $aficionValidada)) {
            $campo = false;
        }
    }
    return $campo;
}

// Funcion de validacion de módulos
function validarMódulos($modulos) {
    $modulosValidos = ["DWES", "DWEC", "DIWEB", "EIE", "DESAW", "HLC"];
    if (is_array($modulos)) {
        $resultado = array_intersect($modulos, $modulosValidos);
        return $resultado ? $resultado : false; // Retorna los módulos válidos o false si no hay
    }
}

// Función de validación de año
function validarAño($anio) {
    global $patronAnio;
    $anio = filter_var($anio, FILTER_VALIDATE_INT); // Validamos que sea un entero
    $esValido = ($anio !== false && preg_match($patronAnio, $anio)); // Verificamos la validez
    return $esValido ? $anio : false; // Retorna el año si es válido, o false
}

// Funcion de validacion de provincias
function validarProvincias($campo) {
    $provincia = ["Almería", "Granada", "Córdoba", "Jaen", "Sevilla", "Huelva", "Málaga"];
    return in_array($campo, $provincia) ? $campo : false;
}

// Función de validación de numero
function validarNumero($numero) {
    $numero = validarCadena($numero); // Eliminamos etiquetas HTML
    if (is_numeric($numero)) {
        $esValido = floatval($numero);
    } else {
        $esValido = false;
    }
    return $esValido;
}

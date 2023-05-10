<?php

// URL del archivo JavaScript que contiene el token
$url = "https://live.tvn.cl/";

// Función para obtener el contenido del archivo remoto utilizando cURL
function get_remote_content($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

// Obtener el contenido del archivo JavaScript
$jsFile = get_remote_content($url);

// Buscar el valor de la variable "access_token" con una expresión regular
$tokenRegex = '/access_token:\s*\'(.*?)\'/';
preg_match($tokenRegex, $jsFile, $matches);

if (isset($matches[1])) {
  $token = $matches[1];
  // Redirigir al stream con el token
  $streamUrl = "https://mdstrm.com/live-stream-playlist-v/57a498c4d7b86d600e5461cb.m3u8?access_token=$token";
  header("Location: $streamUrl");
} else {
  // Si no se pudo encontrar el token, mostrar un mensaje de error
  echo "No se pudo obtener el token de acceso.";
}

?>
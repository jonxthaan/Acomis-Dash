<?php
// Ruta de almacenamiento (puedes mover esto si usas otra estructura)
$archivo = "../data.json";

// Leer datos JSON recibidos desde la ESP32
$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (isset($data["temperatura"]) && isset($data["personas"])) {
    file_put_contents($archivo, json_encode($data, JSON_PRETTY_PRINT));
    echo "✅ Datos recibidos correctamente";
} else {
    echo "❌ Error: datos incompletos";
}
?>

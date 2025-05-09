<?php
$comandoFile = "/tmp/comando.txt";
$irEstadoFile = "/tmp/ir_estado.json";

// 1. POST: guardar comando (para ESP32)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["comando"])) {
    $comando = $_POST["comando"];
    file_put_contents($comandoFile, $comando);

    // Si es IR, marca como capturado
    if (in_array($comando, ["encender", "subir", "bajar"])) {
        $estado = file_exists($irEstadoFile) ? json_decode(file_get_contents($irEstadoFile), true) : [];
        $estado[$comando] = true;
        file_put_contents($irEstadoFile, json_encode($estado));
    }

    echo "Comando '" . htmlspecialchars($comando) . "' enviado";
    exit;
}

// 2. GET: estado de señales IR (para config-ir.php)
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["estado"])) {
    if (file_exists($irEstadoFile)) {
        header("Content-Type: application/json");
        echo file_get_contents($irEstadoFile);
    } else {
        echo json_encode(["encender" => false, "subir" => false, "bajar" => false]);
    }
    exit;
}

// 3. GET sin ?estado: leer comando (para ESP32)
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (file_exists($comandoFile)) {
        echo file_get_contents($comandoFile);
        unlink($comandoFile);
    } else {
        echo "none";
    }
    exit;
}
?>

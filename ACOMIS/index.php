<?php include("includes/header.html"); ?>

<main>
    <section class="status">
        <h2>Estado Actual</h2>
        <p><strong>Presencia:</strong> <span id="presencia">Desconocido</span></p>
        <p><strong>Temperatura:</strong> <span id="temperatura">-- °C</span></p>
    </section>

    <section class="control">
        <h2>Control de Clima</h2>
        <div class="botones">
            <button onclick="enviarComando('config')">🔧 Configurar IR</button>
            <button onclick="enviarComando('encender')">🔥 Encender A/C</button>
            <button onclick="enviarComando('subir')">🔼 Subir Temp</button>
            <button onclick="enviarComando('bajar')">🔽 Bajar Temp</button>
        </div>
    </section>
</main>

<script>
function enviarComando(comando) {
    fetch("comando.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "comando=" + encodeURIComponent(comando)
    })
    .then(res => res.text())
    .then(data => alert("✅ " + data))
    .catch(err => alert("❌ Error al enviar: " + err));
}

function actualizarEstado() {
    fetch("data.json")
    .then(res => res.json())
    .then(data => {
        document.getElementById("temperatura").innerText = data.temperatura + " °C";
        document.getElementById("presencia").innerText = data.personas > 0 ? "Sí" : "No";
    })
    .catch(err => console.warn("No se pudo cargar data.json"));
}

setInterval(actualizarEstado, 3000);
</script>

<?php include("includes/footer.html"); ?>

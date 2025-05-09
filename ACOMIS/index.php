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
            <button onclick="enviarYRedirigir()">🔧 Configurar IR</button>
            <button onclick="enviarComando('encender')">🔥 Encender A/C</button>
            <button onclick="enviarComando('subir')">🔼 Subir Temp</button>
            <button onclick="enviarComando('bajar')">🔽 Bajar Temp</button>
        </div>
    </section>
</main>

<!-- Toast de notificación -->
<div id="toast" class="toast"></div>

<style>
.toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #28a745;
    color: white;
    padding: 12px 18px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    opacity: 0;
    transition: opacity 0.3s ease, bottom 0.3s ease;
    font-family: sans-serif;
    z-index: 9999;
}
.toast.show {
    opacity: 1;
    bottom: 40px;
}
</style>

<script>
function mostrarToast(mensaje) {
    const toast = document.getElementById("toast");
    toast.textContent = mensaje;
    toast.classList.add("show");
    setTimeout(() => toast.classList.remove("show"), 3000);
}

function enviarComando(comando) {
    fetch("comando.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "comando=" + encodeURIComponent(comando)
    })
    .then(res => res.text())
    .then(data => mostrarToast("✅ " + data))
    .catch(err => mostrarToast("❌ Error: " + err));
}

function enviarYRedirigir() {
    fetch("comando.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "comando=config"
    })
    .then(res => res.text())
    .then(data => {
        mostrarToast("✅ " + data);
        setTimeout(() => {
            window.location.href = "config-ir.php";
        }, 800); // Espera un poco antes de redirigir
    })
    .catch(err => mostrarToast("❌ Error: " + err));
}

function actualizarEstado() {
    fetch("data.json")
    .then(res => res.json())
    .then(data => {
        document.getElementById("temperatura").innerText = data.temperatura + " °C";
        document.getElementById("presencia").innerText = data.personas + " persona" + (data.personas !== 1 ? "s" : "");
    })
    .catch(err => console.warn("No se pudo cargar data.json"));
}

setInterval(actualizarEstado, 3000);
</script>

<?php include("includes/footer.html"); ?>

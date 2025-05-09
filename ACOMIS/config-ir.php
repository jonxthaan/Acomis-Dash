<?php include("includes/header.html"); ?>

<main class="contenedor-ir">
    <div class="tarjeta-ir">
        <h2>🔧 Configuración de <span>Señales Infrarrojas</span></h2>

        <p class="instruccion">Apunta el control hacia el receptor IR y presiona los botones <strong>en este orden</strong>:</p>
        <ol>
            <li>Encender A/C</li>
            <li>Subir Temperatura</li>
            <li>Bajar Temperatura</li>
        </ol>

        <p class="nota">✅ Cada vez que captures una señal, aparecerá un mensaje de confirmación.</p>

        <div class="fila-botones-ir">
            <div class="grupo">
                <div class="boton-ir desactivado">📡 Encender</div>
                <span id="estado-encender" class="estado-texto"></span>
            </div>
            <div class="grupo">
                <div class="boton-ir desactivado">📈 Subir</div>
                <span id="estado-subir" class="estado-texto"></span>
            </div>
            <div class="grupo">
                <div class="boton-ir desactivado">📉 Bajar</div>
                <span id="estado-bajar" class="estado-texto"></span>
            </div>
        </div>

        <div id="estado-global" class="estado-global"></div>

        <div class="volver">
            <button onclick="window.location.href='index.php'" class="boton-volver">🏠 Volver al Dashboard</button>
        </div>
    </div>
</main>

<script>
function verificarEstados() {
    fetch("comando.php?estado=1")
    .then(res => res.json())
    .then(data => {
        let completos = 0;

        if (data.encender) {
            document.getElementById("estado-encender").innerHTML = "✅ Ya configurado";
            completos++;
        } else {
            document.getElementById("estado-encender").innerHTML = "❌ No capturado";
        }

        if (data.subir) {
            document.getElementById("estado-subir").innerHTML = "✅ Ya configurado";
            completos++;
        } else {
            document.getElementById("estado-subir").innerHTML = "❌ No capturado";
        }

        if (data.bajar) {
            document.getElementById("estado-bajar").innerHTML = "✅ Ya configurado";
            completos++;
        } else {
            document.getElementById("estado-bajar").innerHTML = "❌ No capturado";
        }

        // Mostrar mensaje global
        const estadoGlobal = document.getElementById("estado-global");
        if (completos === 3) {
            estadoGlobal.innerHTML = "🎉 Todos los comandos han sido configurados.";
        } else {
            estadoGlobal.innerHTML = "";
        }
    });
}

// Verifica estados al cargar y luego cada 2 segundos
verificarEstados();
setInterval(verificarEstados, 2000);
</script>

<?php include("includes/footer.html"); ?>

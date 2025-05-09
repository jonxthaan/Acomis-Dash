<?php include("includes/header.html"); ?>

<main class="contenedor-ir">
    <div class="tarjeta-ir">
        <h2>🔧 Configuración de <span>Señales Infrarrojas</span></h2>

        <p class="instruccion">
            Apunta el control hacia el receptor IR y presiona los botones <strong>en este orden</strong>:
        </p>
        <ol>
            <li>Encender A/C</li>
            <li>Subir Temperatura</li>
            <li>Bajar Temperatura</li>
        </ol>

        <p class="nota">✅ Cada vez que captures una señal desde el Dashboard, quedará registrada automáticamente.</p>
        <p class="nota">Solo necesitas hacerlo una vez, y podrás volver al Dashboard cuando gustes.</p>

        <div class="volver">
            <button onclick="window.location.href='index.php'" class="boton-volver">🏠 Volver al Dashboard</button>
        </div>
    </div>
</main>

<?php include("includes/footer.html"); ?>

<?php
// Habilitar reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir el header directamente
include '../src/layouts/header.php';
?>

<div class="main-content">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="mb-4">
                    <img src="assets/img/3.png" alt="Logo Clínica" height="100" class="me-3">
                    <img src="assets/img/2.png" alt="Clínica San Gabriel" height="100" class="me-0">
                </h1>
                <p style="font-size: 1.5rem; color: #e23189">CUIDAMOS TU SALUD, TRANSFORMAMOS TU VIDA</p>
            </div>

            <div class="row g-4" id="gridContainer">
                <div class="col-md-6">
                    <a href="../src/form_accidente_laboral.php" class="btn-grid">
                        <i class="fas fa-clipboard-list"></i>
                        <h3>Accidente Laboral</h3>
                        <p>Registra y gestiona los accidentes laborales de manera eficiente. Documenta todos los detalles importantes del incidente.</p>
                        <div class="access-text">Click para acceder <i class="fas fa-arrow-right"></i></div>
                    </a>
                </div>
               
                <div class="col-md-6">
                    <a href="../src/form_control_ausentismo.php" class="btn-grid">
                        <i class="fas fa-calendar-times"></i>
                        <h3>Control de Ausentismo</h3>
                        <p>Monitorea y administra el ausentismo laboral. Mantén un registro detallado de las ausencias y sus justificaciones.</p>
                        <div class="access-text">Click para acceder <i class="fas fa-arrow-right"></i></div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include '../src/layouts/footer.php'; ?> 
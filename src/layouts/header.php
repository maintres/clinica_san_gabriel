<?php
session_start();

// Headers de seguridad para prevenir cacheo
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Verificar si el usuario está autenticado
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Si no está autenticado, redirigir al login
    header('Location: ../public/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica San Gabriel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../public/assets/css/style/style.css">
    <!-- Alertas JavaScript -->
    <script src="../public/assets/js/alertas.js"></script>
    <!-- Búsqueda API JavaScript -->
    <script src="../public/assets/js/busqueda_api.js"></script>
    <!-- agrega imagen de logo -->
    <link rel="icon" href="../public/assets/img/3.png" type="image/x-icon">
</head>
<body class="bg-white d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="../public/">
                <img src="../public/assets/img/2.png" alt="Clínica San Gabriel" height="40" class="me-0" >
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../src/form_accidente_laboral.php">
                            <i class="fas fa-clipboard-list me-1"></i>Accidente Laboral
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../src/form_control_ausentismo.php">
                            <i class="fas fa-calendar-times me-1"></i>Control Ausentismo
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link text-primary">
                            <i class="fas fa-user me-1"></i><?php echo htmlspecialchars($_SESSION['username']); ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="../public/login.php?action=logout" onclick="return confirm('¿Estás seguro de que quieres salir?')">
                            <i class="fas fa-sign-out-alt me-1"></i>Salir
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> 
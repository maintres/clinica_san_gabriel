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
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
      
        /* Para el "CLÍNICA SAN GABRIEL" si quieres que sea un poco más grande */
        .navbar-brand-custom {
            font-size: 1.6rem; /* Ajusta este valor para el tamaño de la fuente */
            line-height: 1.2;
        }
        #card-form, nav{
            background-color: #f2f3f3;
        }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg shadow-sm" >
        <div class="container">
            <a class="navbar-brand text-secondary fw-bold navbar-brand-custom d-flex align-items-center" href="#">
                <img src="logo-clinica-letras.png" alt="Clínica San Gabriel" height="50" class="me-3">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="form_accidente_laboral.php">Accidente Laboral</a>
                    <a class="nav-link" href="form_control_ausentismo.php">Control de Ausentismo</a>
                </div>
            </div>
        </div>
    </nav>
    

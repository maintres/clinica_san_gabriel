<?php
require 'flight/Flight.php';    

// Configuración de la API externa
define('API_EXTERNA_URL', 'https://preocupacionales.sangabrielsj.com/api');
define('API_TOKEN', 'FynqAq1RCNxyrVo2xTrHvaA5Px1fLRtD9fEaVueXg0YiEzUpJIovj3xzI2EnLHLMKSdZJFSMa1AXq4Vs12EXCknXweeXLJrqh8PW');
define('API_TIMEOUT', 30);

// Configuración de base de datos local (opcional)
Flight::register('db', 'PDO', array(
    'mysql:host=localhost;dbname=api',
    'root',
    ''
));
//--------------------------------
// Línea 5: URL base
//define('API_EXTERNA_URL', 'https://preocupacionales.sangabrielsj.com/api');

// Línea 18: Construcción de URL completa
//$url = API_EXTERNA_URL . $endpoint;

// Línea 300: Llamada al endpoint
//$response = hacerPeticionAPI('/accidentologia/accidente', 'POST', $datosAPI);
//--------------------------------
// Función helper para hacer peticiones a la API externa
function hacerPeticionAPI($endpoint, $metodo = 'GET', $datos = null) {
    $url = API_EXTERNA_URL . $endpoint;
    
    $headers = [
        'Content-Type: application/json',
        'User-Agent: ClinicaSanGabriel/1.0',
        'Authorization: Bearer ' . API_TOKEN
    ];
    
    $opciones = [
        'http' => [
            'method' => $metodo,
            'header' => implode("\r\n", $headers),
            'timeout' => API_TIMEOUT,
            'ignore_errors' => true // Para capturar errores HTTP
        ]
    ];
    
    if ($datos && $metodo !== 'GET') {
        $opciones['http']['content'] = json_encode($datos);
    }
    
    $context = stream_context_create($opciones);
    $response = file_get_contents($url, false, $context);
    
    if ($response === false) {
        return ['error' => 'Error al conectar con la API externa'];
    }
    
    // Obtener información de la respuesta HTTP
    $httpCode = null;
    if (isset($http_response_header)) {
        $statusLine = $http_response_header[0];
        if (preg_match('/HTTP\/\d\.\d\s+(\d+)/', $statusLine, $matches)) {
            $httpCode = (int)$matches[1];
        }
    }
    
    $decodedResponse = json_decode($response, true);
    
    // Si hay error HTTP, agregarlo a la respuesta
    if ($httpCode && $httpCode >= 400) {
        return [
            'error' => true,
            'http_code' => $httpCode,
            'message' => 'Error HTTP: ' . $httpCode,
            'response' => $decodedResponse
        ];
    }
    
    return $decodedResponse;
}

// Página principal con enlaces a formularios
Flight::route('GET /', function () {
    // Verificar si es una petición AJAX o API
    $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
    if (strpos($accept, 'application/json') !== false) {
        Flight::jsonp("Bienvenido a la API de pacientes");
        return;
    }
    
    // Si no es AJAX, mostrar página HTML principal
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica San Gabriel - Sistema de Gestión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <!-- Navbar -->
<?php include 'header.php'; ?>
    <div class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="text-center mb-5">
                    <h1 class="mb-4">
                        <img src="img/3.png" alt="Logo Clínica" height="100" class="me-3">
                        <img src="img/2.png" alt="Clínica San Gabriel" height="100" class="me-0">
                    </h1>
                    <p style="font-size: 1.5rem; color: #e23189">CUIDAMOS TU SALUD, TRANSFORMAMOS TU VIDA</p>
                </div>

                <div class="row g-4" id="gridContainer">
                    <div class="col-md-6">
                        <a href="form_accidente_laboral.php" class="btn-grid">
                            <i class="fas fa-clipboard-list"></i>
                            <h3>Accidente Laboral</h3>
                            <p>Registra y gestiona los accidentes laborales de manera eficiente. Documenta todos los detalles importantes del incidente.</p>
                            <div class="access-text">Click para acceder <i class="fas fa-arrow-right"></i></div>
                        </a>
                    </div>
                    
                    <div class="col-md-6">
                        <a href="form_control_ausentismo.php" class="btn-grid">
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
<?php include 'footer.php'; ?>
</body>
</html>    
<?php
});

// ========================================
// ENDPOINTS PARA PACIENTES
// ========================================

// Obtener paciente por DNI (API externa)
Flight::route('GET /pacientes/get_by_dni/@dni', function ($dni) {
    $response = hacerPeticionAPI('/pacientes/get_by_dni/' . $dni);
    Flight::jsonp($response);
});

// ========================================
// ENDPOINTS PARA EMPRESAS
// ========================================

// Obtener todas las empresas (API externa)
Flight::route('GET /empresas/get_all', function () {
    $response = hacerPeticionAPI('/empresas/get_all');
    Flight::jsonp($response);
});

// ========================================
// ENDPOINTS PARA ACCIDENTES LABORALES
// ========================================

// Registrar accidente laboral
Flight::route('POST /accidentologia/registrar_accidente', function () {
    // Obtener datos del POST
    $datos = Flight::request()->data;
    
    // Validar datos requeridos
    if (empty($datos->empresa_id) || empty($datos->paciente_id)) {
        Flight::jsonp([
            'error' => 'Datos incompletos',
            'message' => 'Se requiere empresa y paciente'
        ], 400);
        return;
    }
    
    // Preparar datos para la API externa
    $datosAPI = [
        'empresa_id' => (int)$datos->empresa_id,
        'paciente_id' => (int)$datos->paciente_id,
        'puesto' => $datos->puesto ?? '',
        'area' => $datos->area ?? '',
        'fecha_ingreso' => $datos->fecha_ingreso ?? '',
        'antiguedad' => $datos->antiguedad ?? '',
        'antiguedad_calculada' => $datos->antiguedad_calculada ?? '',
        'antiguedad_anios' => (int)($datos->antiguedad_anios ?? 0),
        'antiguedad_meses' => (int)($datos->antiguedad_meses ?? 0),
        'obra_social' => $datos->obra_social ?? '',
        'plan' => $datos->plan ?? '',
        'nro_afiliado' => $datos->nro_afiliado ?? '',
        'testigos' => $datos->testigos ?? '',
        'tipo_accidente' => $datos->tipo_accidente ?? '',
        'agente_causal' => $datos->agente_causal ?? '',
        'partes_afectadas' => is_array($datos->partes_afectadas) ? $datos->partes_afectadas : [],
        'descripcion' => $datos->descripcion ?? '',
        'tipo_lesion' => $datos->tipo_lesion ?? '',
        'gravedad' => $datos->gravedad ?? '',
        'derivacion' => $datos->derivacion ?? '',
        'intervencion_art' => $datos->intervencion_art === 'Si' || $datos->intervencion_art === true,
        'dias_baja' => (int)($datos->dias_baja ?? 0),
        'diagnostico' => $datos->diagnostico ?? '',
        'proximo_control' => $datos->prox_ctrl ?? '',
        'medico_inicial' => $datos->medico_inicial ?? '',
        'matricula' => $datos->matricula ?? '',
        'observaciones' => $datos->observaciones ?? '',
        'fecha_registro' => $datos->fecha_registro ?? date('c')
    ];
    
    // Enviar a la API externa
    $response = hacerPeticionAPI('/accidentologia/accidente', 'POST', $datosAPI);
    
    if (isset($response['error'])) {
        Flight::jsonp([
            'error' => true,
            'message' => 'Error al registrar en la API externa: ' . $response['error']
        ], 500);
        return;
    }
    
    Flight::jsonp([
        'success' => true,
        'message' => 'Accidente registrado correctamente',
        'data' => $response
    ]);
});
// ========================================
// ENDPOINTS PARA CONTROL DE AUSENTISMO
//------------(FALTA COMPLETAR)------------
// ========================================

// Registrar ausentismo
Flight::route('POST /ausentismo/registrar_ausentismo', function () {
    // Obtener datos del POST
    $datos = Flight::request()->data;
    
    // Validar datos requeridos
    if (empty($datos->empresa_id) || empty($datos->paciente_id)) {
        Flight::jsonp([
            'error' => 'Datos incompletos',
            'message' => 'Se requiere empresa y paciente'
        ], 400);
        return;
    }
    
    // Preparar datos para la API externa   
    $datosAPI = [
        'empresa_id' => (int)$datos->empresa_id,
        'paciente_id' => (int)$datos->paciente_id,
        'fecha_ausencia' => $datos->fecha_ausencia ?? '',
        'motivo' => $datos->motivo ?? '',
        'dias_ausencia' => (int)($datos->dias_ausencia ?? 0),
        'fecha_registro' => $datos->fecha_registro ?? date('c')
    ];
    
    // Enviar a la API externa
    $response = hacerPeticionAPI('/ausentismo/ausentismo', 'POST', $datosAPI);
    
    if (isset($response['error'])) {
        Flight::jsonp([
            'error' => true,
            'message' => 'Error al registrar en la API externa: ' . $response['error']
        ], 500);
        return;
    }
});





Flight::start();

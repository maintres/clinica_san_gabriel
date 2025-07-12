
<?php
require 'flight/Flight.php';    

// Configuración de la API externa
define('API_EXTERNA_URL', 'https://preocupacionales.sangabrielsj.com/api');
define('API_TOKEN', 'FynqAq1RCNxyrVo2xTrHvaA5Px1fLRtD9fEaVueXg0YiEzUpJIovj3xzI2EnLHLMKSdZJFSMa1AXq4Vs12EXCknXweeXLJrqh8PW');
define('API_TIMEOUT', 30);

// Función helper para hacer peticiones a la API externa (equivalente al fetch de JavaScript)
// Esta función actúa como un "fetch" personalizado para PHP, permitiendo hacer peticiones HTTP seguras
function hacerPeticionAPI($endpoint, $metodo = 'GET', $datos = null) {
    // Construir la URL completa combinando la URL base de la API con el endpoint específico
    $url = API_EXTERNA_URL . $endpoint;
    
    // Definir los headers HTTP (equivalente a las opciones del fetch en JavaScript)
    // Estos headers se envían con cada petición para autenticación y formato
    $headers = [
        'Content-Type: application/json',     // Indica que enviamos datos JSON
        'User-Agent: ClinicaSanGabriel/1.0',  // Identifica nuestra aplicación
        'Authorization: Bearer ' . API_TOKEN  // Token de autenticación (equivalente al Authorization header en fetch)
    ];
    
    // Configurar las opciones de la petición HTTP (equivalente a las opciones del fetch)
    $opciones = [
        'http' => [
            'method' => $metodo,                    // Método HTTP: GET, POST, PUT, DELETE
            'header' => implode("\r\n", $headers),  // Convertir array de headers a string
            'timeout' => API_TIMEOUT,               // Timeout en segundos (evita peticiones infinitas)
            'ignore_errors' => true                 // Para capturar errores HTTP (equivalente a .catch() en fetch)
        ]
    ];
    
    // Si hay datos para enviar y no es una petición GET, agregar el body
    // Equivalente a body: JSON.stringify(data) en fetch
    if ($datos && $metodo !== 'GET') {
        $opciones['http']['content'] = json_encode($datos);
    }
    
    // Crear el contexto de stream (equivalente a crear la configuración del fetch)
    $context = stream_context_create($opciones);
    
    // Ejecutar la petición HTTP (equivalente a fetch(url, options) en JavaScript)
    // file_get_contents con contexto es el equivalente nativo de PHP para hacer peticiones HTTP
    $response = file_get_contents($url, false, $context);
    
    // Manejar errores de conexión (equivalente al .catch() en fetch)
    if ($response === false) {
        return ['error' => 'Error al conectar con la API externa'];
    }
    
    // Obtener información de la respuesta HTTP (equivalente a response.status en fetch)
    $httpCode = null;
    if (isset($http_response_header)) {
        $statusLine = $http_response_header[0];
        if (preg_match('/HTTP\/\d\.\d\s+(\d+)/', $statusLine, $matches)) {
            $httpCode = (int)$matches[1];
        }
    }
    
    // Decodificar la respuesta JSON (equivalente a response.json() en fetch)
    $decodedResponse = json_decode($response, true);
    
    // Si hay error HTTP (códigos 4xx o 5xx), manejarlo apropiadamente
    // Equivalente a verificar response.ok en fetch
    if ($httpCode && $httpCode >= 400) {
        return [
            'error' => true,
            'http_code' => $httpCode,
            'message' => 'Error HTTP: ' . $httpCode,
            'response' => $decodedResponse
        ];
    }
    
    // Retornar la respuesta decodificada (equivalente a return response.json() en fetch)
    return $decodedResponse;
}

// Página principal con enlaces a formularios
Flight::route('GET /', function () {
    $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
    if (strpos($accept, 'application/json') !== false) {
        Flight::json(["message" => "Bienvenido a la API de pacientes"]);
        return;
    }
    
    // Si no es AJAX, mostrar página HTML principal
    include 'header.php';
    ?>
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
    <?php
    include 'footer.php';
});

// ========================================
// ENDPOINTS PARA PACIENTES
// ========================================

// Obtener paciente por DNI (API externa)
Flight::route('GET /pacientes/get_by_dni/@dni', function ($dni) {
    $response = hacerPeticionAPI('/pacientes/get_by_dni/' . $dni);
    Flight::json($response);
});

// ========================================
// ENDPOINTS PARA EMPRESAS
// ========================================

// Obtener todas las empresas (API externa)
Flight::route('GET /empresas/get_all', function () {
    $response = hacerPeticionAPI('/empresas/get_all');
    Flight::json($response);
});

// ========================================
// ENDPOINTS PARA ACCIDENTES LABORALES
// ========================================

// Registrar accidente laboral
Flight::route('POST /accidentologia/registrar_accidente', function () {
    $datos = Flight::request()->data;
    if (empty($datos->empresa_id) || empty($datos->paciente_id)) {
        Flight::json([
            'error' => 'Datos incompletos',
            'message' => 'Se requiere empresa y paciente'
        ], 400);
        return;
    }
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
    $response = hacerPeticionAPI('/accidentologia/accidente', 'POST', $datosAPI);
    if (isset($response['error'])) {
        Flight::json([
            'error' => true,
            'message' => 'Error al registrar en la API externa: ' . $response['error']
        ], 500);
        return;
    }
    Flight::json([
        'success' => true,
        'message' => 'Accidente registrado correctamente',
        'data' => $response
    ]);
});
// ========================================
// ENDPOINTS PARA CONTROL DE AUSENTISMO
// ========================================

// Registrar ausentismo
Flight::route('POST /ausentismo/registrar', function () {
    $datos = Flight::request()->data;
    if (empty($datos->empresa_id) || empty($datos->paciente_id)) {
        Flight::json([
            'error' => 'Datos incompletos',
            'message' => 'Se requiere empresa y paciente'
        ], 400);
        return;
    }
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
        'tipo_licencia' => $datos->tipo_licencia ?? '',
        'agente_causal' => $datos->agente_causal ?? '',
        'diagnostico' => $datos->diagnostico ?? '',
        'tratamiento' => $datos->tratamiento ?? '',
        'aseguradora_art' => $datos->aseguradora_art ?? '',
        'inicio_certificado' => $datos->inicio_certificado ?? '',
        'vto_certificado' => $datos->vto_certificado ?? '',
        'cantidad_dias' => (int)($datos->cantidad_dias ?? 0),
        'dia_inicio_semana' => $datos->dia_inicio_semana ?? '',
        'medico_tratante' => $datos->medico_tratante ?? '',
        'matricula' => $datos->matricula ?? '',
        'especialidad' => $datos->especialidad ?? '',
        'nro_denuncia_art' => $datos->nro_denuncia_art ?? '',
        'tipo_denuncia_art' => $datos->tipo_denuncia_art ?? '',
        'partes_afectadas' => is_array($datos->partes_afectadas) ? $datos->partes_afectadas : [],
        'med_auditor' => $datos->medico_auditor ?? '',
        'fecha_control' => $datos->fecha_control ?? '',
        'resultado' => $datos->resultado ?? '',
        'requiere_reubicacion' => $datos->requiere_reubicacion ?? '',
        'apto_reingreso' => $datos->apto_reingreso ?? '',
        'alta_reingreso' => $datos->alta_reingreso ?? '',
        'dias_ausentismo_control' => (int)($datos->dias_ausentismo_control ?? 0),
        'observaciones' => $datos->observaciones ?? '',
        'fecha_registro' => $datos->fecha_registro ?? date('c')
    ];
    $response = hacerPeticionAPI('/ausentismo/ausentismo', 'POST', $datosAPI);
    if (isset($response['error'])) {
        Flight::json([
            'error' => true,
            'message' => 'Error al registrar en la API externa: ' . $response['error']
        ], 500);
        return;
    }
    Flight::json([
        'success' => true,
        'message' => 'Ausentismo registrado correctamente',
        'data' => $response
    ]);
});





Flight::start();

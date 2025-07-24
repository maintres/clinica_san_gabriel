<?php
// Habilitar reporte de errores para debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si el archivo Flight existe
if (!file_exists('../flight/Flight.php')) {
    die('Error: No se puede encontrar el archivo Flight.php');
}

require '../flight/Flight.php';    

// Configuración de la API externa
define('API_EXTERNA_URL', 'https://preocupacionales.sangabrielsj.com/api');
define('API_TOKEN', 'FynqAq1RCNxyrVo2xTrHvaA5Px1fLRtD9fEaVueXg0YiEzUpJIovj3xzI2EnLHLMKSdZJFSMa1AXq4Vs12EXCknXweeXLJrqh8PW');
define('API_TIMEOUT', 30);

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
            'ignore_errors' => true
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
    
    $httpCode = null;
    if (isset($http_response_header)) {
        $statusLine = $http_response_header[0];
        if (preg_match('/HTTP\/\d\.\d\s+(\d+)/', $statusLine, $matches)) {
            $httpCode = (int)$matches[1];
        }
    }
    
    $decodedResponse = json_decode($response, true);
    
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
?> 
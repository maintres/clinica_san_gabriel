
<?php include 'header.php'; ?>
    <div class="container-fluid container py-4 ">
        <div class="card shadow card-form">
            <div class="card-header">
                <h4 class="text-center mb-0"><i class="fas fa-clipboard-list me-2"></i>Ficha de Accidente Laboral</h4>
            </div>
            
            <div class="card-body">
                <form id="accidentForm" method="POST" enctype="multipart/form-data">
                    <!-- SECCIÓN EMPRESA -->
                    <h5 class="mb-3 border-bottom pb-2">
                        <i class="fas fa-building me-2"></i>Empresa
                    </h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <label class="input-group-text" for="razon_social_buscar"><i class="fas fa-search me-2"></i>Razón Social</label>
                                <input type="text" class="form-control" id="razon_social_buscar" name="razon_social_buscar" placeholder="Buscar por razón social" autocomplete="off">
                                <!--<button type="button" class="btn btn-transparent" id="btnBuscarEmpresa">                                   
                                     <i class="fas fa-search me-1"></i>Buscar
                                </button> -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="razon_social" class="form-label">Razón Social</label>
                            <p id="razon_social" class="form-control-plaintext fw-bold"></p>
                            <input type="hidden" name="razon_social">
                        </div>
                    </div>

                    <div class="row mb-3">                        
                        <div class="col-md-6">
                            <label for="domicilio_empresa" class="form-label">Domicilio</label>
                            <p id="domicilio_empresa" class="form-control-plaintext fw-bold"></p>
                            <input type="hidden" name="domicilio_empresa">
                        </div>                         
                    </div>

                    <!-- Campo hidden para el ID de la empresa -->
                    <input type="hidden" id="empresa_id_hidden" name="empresa_id" value="">

                    <hr class="my-4">
                    <!-- SECCIÓN EMPLEADO -->
                    <h5 class="mb-3 border-bottom pb-2">
                        <i class="fas fa-user me-2"></i>Empleado
                    </h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <label class="input-group-text" for="dni">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" value="">
                                <button type="button" class="btn btn-transparent" id="btnBuscarEmpleado">
                                    <i class="fas fa-search me-1"></i>Buscar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre y Apellido</label>
                            <div class="d-flex">
                                <p id="nombre" class="me-2 fw-bold"></p>
                                <p id="apellido" class="fw-bold"></p>
                            </div>
                            <input type="hidden" name="nombre">
                            <input type="hidden" name="apellido">
                        </div>
                        <div class="col-md-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <p id="telefono" class="form-control-plaintext fw-bold"></p>
                            <input type="hidden" name="telefono">
                        </div>
                        <div class="col-md-3">
                            <label for="celular" class="form-label">Celular</label>
                            <p id="celular" class="form-control-plaintext fw-bold"></p>
                            <input type="hidden" name="celular">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="domicilio_empleado" class="form-label">Domicilio</label>
                            <p id="domicilio_empleado" class="form-control-plaintext fw-bold"></p>
                            <input type="hidden" name="domicilio_empleado">
                        </div>
                         
                    </div>

                    <!-- Campo hidden para el ID del paciente -->
                    <input type="hidden" id="paciente_id_hidden" name="paciente_id" value="">

                    <hr class="my-4">

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="puesto" class="form-label">Puesto</label>
                            <input type="text" class="form-control" id="puesto" name="puesto" placeholder="Ej: Operario">
                        </div>
                        <div class="col-md-3">
                            <label for="area" class="form-label">Área</label>
                            <input type="text" class="form-control" id="area" name="area" placeholder="Ej: Embalaje">
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                            <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso">
                        </div>
                        <div class="col-md-3">
                            <label for="antiguedad" class="form-label">Antigüedad</label>
                            <input type="text" class="form-control" id="antiguedad" name="antiguedad" disabled>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="obra_social" class="form-label">Obra Social</label>
                            <select class="form-select" id="obra_social" name="obra_social">
                                <option value="" selected disabled>-- Seleccionar --</option>
                                <option value="Ninguna" >Ninguna</option>
                                <option value="OSDE">OSDE</option>
                                <option value="Swiss Medical">Swiss Medical</option>
                                <option value="IOMA">IOMA</option>
                                <option value="Otra">Otra</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="plan" class="form-label">Plan</label>
                            <input type="text" class="form-control" id="plan" name="plan">
                        </div>
                        <div class="col-md-4">
                            <label for="nro_afiliado" class="form-label">Nro de Afiliado</label>
                            <input type="text" class="form-control" id="nro_afiliado" name="nro_afiliado">
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- SECCIÓN ACCIDENTE -->
                    <h5 class="mb-3 border-bottom pb-2">
                        <i class="fas fa-exclamation-triangle me-2"></i>ACCIDENTE
                    </h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="tipo_accidente" class="form-label">Tipo de Accidente</label>
                            <select class="form-select" id="tipo_accidente" name="tipo_accidente" >
                                <option value="" selected disabled>-- Seleccionar tipo --</option>
                                <option value="Caída de altura" >Caída de altura</option>
                                <option value="Caída de diferente nivel" >Caída de diferente nivel</option>
                                <option value="Atrapamiento" >Atrapamiento</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="agente_causal" class="form-label">Agente Causal</label>
                            <select class="form-select" id="agente_causal" name="agente_causal">
                            <option value="" selected disabled>-- Seleccionar Agente --</option>
                                <option value="Máquina" >Máquina</option>
                                <option value="Superficie mojada">Superficie mojada</option>
                                <option value="Herramienta">Herramienta</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="testigos" class="form-label">Testigos</label>
                            <input type="text" class="form-control" id="testigos" name="testigos">
                        </div>
                    </div>
                    <!-- -------------------------------------------------------------------->
                    <hr class="my-4">
                    <!-- -------------------------------------------------------------------->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <?php include 'partes_cuerpo.php'; ?>
                        </div>
                    </div>

                    <div class="row mb-4">                        
                        <div class="col-md-12">
                            <label for="descripcion" class="form-label">Descripción del Hecho</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="6" placeholder="Detalle cómo ocurrió el accidente..."></textarea>   
                        </div>              
                    </div>
                    <!-- -------------------------------------------------------------------->
                    <hr class="my-4">
                    <!-- -------------------------------------------------------------------->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="tipo_lesion" class="form-label">Tipo de Lesión</label>
                            <select class="form-select" id="tipo_lesion" name="tipo_lesion">
                                <option value="" selected disabled>-- Seleccionar --</option>
                                <option value="Cortante">Cortante</option>
                                <option value="Fractura">Fractura</option>
                                <option value="Quemadura">Quemadura</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="gravedad" class="form-label">Gravedad</label>
                            <select class="form-select" id="gravedad" name="gravedad">
                                <option value="" selected disabled>-- Seleccionar --</option>
                                <option value="Leve">Leve</option>
                                <option value="Moderado">Moderado</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="derivacion" class="form-label">Derivación a:</label>
                            <select class="form-select" id="derivacion" name="derivacion">
                                <option value="" selected disabled>-- Seleccionar --</option>
                                <option value="Casa">Casa</option>
                                <option value="ART">ART</option>
                                <option value="Centro de salud">Centro de salud</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label d-block">Intervención ART:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="intervencion_art" id="art_si" value="Si" >
                                <label class="form-check-label" for="art_si">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="intervencion_art" id="art_no" value="No" checked>
                                <label class="form-check-label" for="art_no">No</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="dias_baja" class="form-label">Días de Baja</label>
                            <input type="number" class="form-control" id="dias_baja" name="dias_baja">
                        </div>
                        <div class="col-md-3">
                            <label for="diagnostico" class="form-label">Diagnóstico</label>
                            <input type="text" class="form-control" id="diagnostico" name="diagnostico">
                        </div>
                        <div class="col-md-3">
                            <label for="prox_ctrl" class="form-label">Próx. Control</label>
                            <input type="date" class="form-control" id="prox_ctrl" name="prox_ctrl">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="medico_inicial" class="form-label">Médico Atención Inicial</label>
                            <input type="text" class="form-control" id="medico_inicial" name="medico_inicial">
                        </div>
                        <div class="col-md-6">
                            <label for="matricula" class="form-label">Matrícula</label>
                            <input type="text" class="form-control" id="matricula" name="matricula">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="4" placeholder="Observaciones adicionales sobre el accidente..."></textarea>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-transparent btn-lg" id="btnGuardar">
                            <i class="fas fa-save me-2"></i>Guardar
                        </button>
                        <button type="button" class="btn btn-warning btn-lg ms-3" id="btnPrueba" onclick="probarAPI()">
                            <i class="fas fa-flask me-2"></i>Probar API
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <!-- Incluir SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Incluir funciones de alerta -->
    <script src="alertas.js"></script>

    <script>
        // Configuración para búsquedas (ya no se usa busquedaAPI)
        const configAccidente = {
            empresas: {
                btnId: 'btnBuscarEmpresa',
                inputId: 'razon_social_buscar',
                empresaIdField: 'empresa_id_hidden',
                campos: [
                    { id: 'razon_social', apiField: 'razonsocial' },
                    { id: 'domicilio_empresa', apiField: 'domicilio' }
                ]
            },
            empleados: {
                btnId: 'btnBuscarEmpleado',
                dniId: 'dni',
                pacienteIdField: 'paciente_id_hidden',
                campos: [
                    { id: 'nombre', apiField: 'nombre' },
                    { id: 'apellido', apiField: 'apellido' },
                    { id: 'telefono', apiField: 'telefono' },
                    { id: 'celular', apiField: 'celular' },
                    { id: 'domicilio_empleado', apiField: 'domicilio' }
                ]
            }
        };

        // El cálculo de antigüedad ahora se maneja en busqueda_api.js
        // Se inicializa automáticamente en inicializarSistemaBusqueda()
        
        // Función para probar la API con datos de prueba específicos para accidentes
        function probarAPI() {
            const datosPrueba = {
                empresa_id: 6,
                paciente_id: 10,
                puesto: "Operario de Prueba",
                area: "Área de Prueba",
                fecha_ingreso: "2023-01-15",
                antiguedad: "1 año, 6 meses",
                antiguedad_calculada: "1 año, 6 meses",
                antiguedad_anios: 1,
                antiguedad_meses: 6,
                obra_social: "OSDE",
                plan: "310",
                nro_afiliado: "12345678",
                testigos: "Testigo de Prueba",
                tipo_accidente: "Caída de altura",
                agente_causal: "Escalera",
                partes_afectadas: ["brazo_derecho", "pierna_izquierda"],
                descripcion: "Accidente de prueba - El empleado se cayó de una escalera durante tareas de mantenimiento",
                tipo_lesion: "Fractura",
                gravedad: "Moderada",
                derivacion: "Hospital",
                intervencion_art: true,
                dias_baja: 15,
                diagnostico: "Fractura de radio distal - PRUEBA",
                proximo_control: "2024-02-15",
                medico_inicial: "Dr. García - PRUEBA",
                matricula: "12345",
                observaciones: "Este es un registro de prueba para verificar la funcionalidad de la API",
                fecha_registro: new Date().toISOString()
            };

            // Usar la función centralizada de busqueda_api.js
            probarAPI(API_CONFIG.ENDPOINTS.ACCIDENTES, datosPrueba, 'Probando API de accidentes...');
        }
        
        // Función para obtener el JSON desde el formulario
        function obtenerJsonDesdeFormulario() {
            const form = document.getElementById('accidentForm');
            if (!form) {
                throw new Error('No se encontró el formulario de accidente');
            }
            
            const formData = new FormData(form);
            const jsonData = {};

            // Recorrer todos los campos del formulario
            formData.forEach((value, key) => {
                // Excluir los campos individuales del empleado y empresa del JSON final
                if (!['nombre', 'apellido', 'telefono', 'celular', 'domicilio_empleado', 'dni', 'razon_social', 'domicilio_empresa', 'razon_social_buscar'].includes(key)) {
                    jsonData[key] = value;
                }
            });

            // Obtener el array de partes seleccionadas desde Vue
            if (window.vueApp && window.vueApp.selectedParts && Array.isArray(window.vueApp.selectedParts)) {
                jsonData.partes_afectadas = window.vueApp.selectedParts;
            } else {
                jsonData.partes_afectadas = [];
            }

            // Convertir intervencion_art a boolean
            if (jsonData.intervencion_art === 'Si') {
                jsonData.intervencion_art = true;
            } else if (jsonData.intervencion_art === 'No') {
                jsonData.intervencion_art = false;
            }

            // Convertir campos numéricos
            if (jsonData.dias_baja) {
                jsonData.dias_baja = parseInt(jsonData.dias_baja);
            } else {
                jsonData.dias_baja = 0;
            }

            // Convertir IDs a números
            if (jsonData.empresa_id) {
                jsonData.empresa_id = parseInt(jsonData.empresa_id);
            }
            if (jsonData.paciente_id) {
                jsonData.paciente_id = parseInt(jsonData.paciente_id);
            }

            // Calcular antigüedad usando la función centralizada
            const antiguedad = calcularAntiguedad();
            jsonData.antiguedad = antiguedad.texto;
            jsonData.antiguedad_calculada = antiguedad.texto;
            jsonData.antiguedad_anios = antiguedad.años;
            jsonData.antiguedad_meses = antiguedad.meses;

            // Agregar fecha de registro
            jsonData.fecha_registro = new Date().toISOString();

            // Validar campos requeridos
            const camposRequeridos = ['empresa_id', 'paciente_id', 'tipo_accidente', 'agente_causal', 'descripcion'];
            const camposFaltantes = camposRequeridos.filter(campo => !jsonData[campo] || jsonData[campo] === '');
            
            if (camposFaltantes.length > 0) {
                throw new Error(`Campos requeridos faltantes: ${camposFaltantes.join(', ')}`);
            }

            // Verificar que jsonData se construyó correctamente
            if (!jsonData || typeof jsonData !== 'object') {
                throw new Error('Error al construir el JSON del formulario');
            }

            return jsonData;
        }
        

        // Envío del formulario usando el JSON generado
        document.getElementById('accidentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let jsonData;
            
            try {
                // Generar el JSON
                jsonData = obtenerJsonDesdeFormulario();
                
                // Verificar que jsonData se generó correctamente
                if (!jsonData) {
                    throw new Error('No se pudo generar el JSON del formulario');
                }

                // Mostrar alerta de carga
                mostrarAlertaCarga('Registrando accidente...');

                // Mostrar en consola para debugging
                console.log('JSON a enviar:', JSON.stringify(jsonData, null, 2));
                
                // También mostrar en una alerta informativa (solo en desarrollo)
                if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
                    console.log('Datos a enviar a la API externa:', {
                        url: 'https://preocupacionales.sangabrielsj.com/api/accidentologia/accidente',
                        method: 'POST',
                        data: jsonData
                    });
                }

                // Enviar directamente a la API externa
                fetch(API_CONFIG.BASE_URL + API_CONFIG.ENDPOINTS.ACCIDENTES, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + API_CONFIG.TOKEN
                    },
                    body: JSON.stringify(jsonData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error HTTP: ${response.status} ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    cerrarAlertaCarga();
                    
                    if (data.error) {
                        throw new Error(data.message || 'Error en el servidor');
                    }
                    
                    mostrarAlertaExito('Accidente registrado correctamente', '¡Registro Exitoso!', true);
                })
                .catch(error => {
                    cerrarAlertaCarga();
                    console.error('Error al registrar el accidente:', error);
                    mostrarAlertaError(`Error al registrar el accidente: ${error.message}`, '¡Error!');
                });
            } catch (error) {
                cerrarAlertaCarga();
                console.error('Error en la validación:', error);
                mostrarAlertaError(`Error de validación: ${error.message}`, '¡Error de Validación!');
            }
        });

        // ========================================
        // SISTEMA DE BÚSQUEDA CENTRALIZADO
        // ========================================
        // Todas las funciones de búsqueda ahora están en busqueda_api.js
        
        // Inicializar el sistema de búsqueda cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', function() {
            inicializarSistemaBusqueda();
        });
    </script>

    <?php include 'footer.php'; ?>
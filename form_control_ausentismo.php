<?php include 'header.php'; ?>
    <div class="container-fluid container py-4">
        <div class="card shadow" id="card-form" >
            <div class="card-header bg-transparent text-white">
                <h3 class="text-center mb-0"><i class="fas fa-calendar-times me-2"></i>Control de Ausentismo</h3>
            </div>
            
            <div class="card-body">
                <form id="ausentismoForm" method="POST" enctype="multipart/form-data">
                    <!-- SECCIÓN EMPRESA -->
                    <h5 class="mb-3 border-bottom pb-2">
                        <i class="fas fa-building me-2"></i>Empresa
                    </h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <label class="input-group-text" for="razon_social_buscar">Razón Social</label>
                                <input type="text" class="form-control" id="razon_social_buscar" name="razon_social_buscar" placeholder="Ingrese razón social" list="empresas-list" autocomplete="off">
                                <datalist id="empresas-list">
                                    <!-- Las opciones se cargarán dinámicamente -->
                                </datalist>
                                <style>
                                    
                                </style>
                                <button type="button" class="btn btn-transparent"style="border:1px solid #e23189" id="btnBuscarEmpresa">
                                    <i class="fas fa-search me-1"></i>Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="razon_social" class="form-label">Razón Social:</label>
                            <p id="razon_social" class="form-control-plaintext fw-bold"></p>
                            <input type="hidden" name="razon_social">
                        </div>
                    </div>

                    <div class="row mb-3">                        
                        <div class="col-md-6">
                            <label for="domicilio_empresa" class="form-label">Domicilio:</label>
                            <p id="domicilio_empresa" class="form-control-plaintext fw-bold"></p>
                            <input type="hidden" name="domicilio_empresa">
                        </div>
                        <div class="col-md-6">
                            
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
                                <input type="text" class="form-control" id="dni" name="dni">
                                <button type="button" class="btn btn-transparent" id="btnBuscarEmpleado">
                                    <i class="fas fa-search me-1"></i>Buscar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre_apellido" class="form-label">Nombre y Apellido</label>
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
                        <div class="col-md-6">
                            
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
                            <input type="text" class="form-control" id="area" name="area" placeholder="Ej: Embalaje" >
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                            <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" >
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

                    <!-- SECCIÓN LICENCIA -->
                    <h5 class="mb-3 border-bottom pb-2">
                        <i class="fas fa-file-medical me-2"></i>LICENCIA
                    </h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tipo_licencia" class="form-label">Tipo:</label>
                            <select class="form-select" id="tipo_licencia" name="tipo_licencia">
                                <option value="" selected disabled>-- Seleccionar tipo --</option>
                                <option value="Justificado">Justificado</option>
                                <option value="Injustificado">Injustificado</option>
                                <option value="ART">ART</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="agente_causal" class="form-label">Agente causal:</label>
                            <select class="form-select" id="agente_causal" name="agente_causal">
                                <option value="" selected disabled>-- Seleccionar Agente --</option>
                                <option value="Máquina" >Máquina</option>
                                <option value="Superficie mojada">Superficie mojada</option>
                                <option value="Herramienta">Herramienta</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="diagnostico" class="form-label">Diagnóstico:</label>
                            <input type="text" class="form-control" id="diagnostico" name="diagnostico">
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
                    <div class="col-md-12">
                        <label for="tratamiento" class="form-label">Tratamiento:</label>
                        <textarea class="form-control" id="tratamiento" name="tratamiento" rows="6" placeholder="Detalle del tratamiento..."></textarea>   
                    </div>    
                    <!-- -------------------------------------------------------------------------->
                    <hr class="my-4">
                    <!-- -------------------------------------------------------------------------->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Aseguradora - ART:</label>
                            <div class="mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="aseguradora_art" id="art_si" value="Si" >
                                    <label class="form-check-label" for="art_si">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="aseguradora_art" id="art_no" value="No" checked>
                                    <label class="form-check-label" for="art_no">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="inicio_certificado" class="form-label">Inicio certificado: <strong id="inicio_texto"></strong></label>
                            <input type="date" class="form-control" id="inicio_certificado" name="inicio_certificado" onchange="calcularDias()">
                        </div>
                        <div class="col-md-3">
                            <label for="vto_certificado" class="form-label">Vto. certificado: <strong id="fin_texto"></strong></label>
                            <input type="date" class="form-control" id="vto_certificado" name="vto_certificado" onchange="calcularDias()">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="dias_ausentismo" class="form-label">Días de ausentismo: <strong id="dias_ausentismo">0</strong></label>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="dia_inicio_cert" class="form-label">Día inicio certificado: <strong id="dia_inicio_cert"></strong></label>
                        </div>
                    </div>
                    <label for="inicio_certificado" class="form-label">Dia de presentacion de certificado: <strong id="inicio_texto"></strong></label>
                    fecha hoy- fecha de inicio certificado (tiene que confirmar el cliente)
                    <!-- funcion para calcular los dias de ausentismo -->
                    <script>
                    function calcularDias() {
                        const inicio = document.getElementById('inicio_certificado').value;
                        const fin = document.getElementById('vto_certificado').value;
                        
                        if(inicio) {
                            document.getElementById('inicio_texto').textContent = inicio;
                            const fecha1 = new Date(inicio);
                            const diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                            const diaSemana = diasSemana[fecha1.getDay()];
                            document.getElementById('dia_inicio_cert').textContent = diaSemana;
                        }

                        if(fin) {
                            document.getElementById('fin_texto').textContent = fin;
                        }
                        
                        if(inicio && fin) {
                            const fecha1 = new Date(inicio);
                            const fecha2 = new Date(fin);
                            const diferencia = fecha2 - fecha1;
                            const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24)) + 1;
                            document.getElementById('dias_ausentismo').textContent = dias;
                        }
                    }
                    </script>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="med_tratante" class="form-label">Médico tratante:</label>
                            <input type="text" class="form-control" id="med_tratante" name="med_tratante">
                        </div>
                        <div class="col-md-4">
                            <label for="matricula" class="form-label">Matrícula:</label>
                            <input type="text" class="form-control" id="matricula" name="matricula">
                        </div>
                        <div class="col-md-4">
                            <label for="especialidad" class="form-label">Especialidad:</label>
                            <select class="form-select" id="especialidad" name="especialidad">
                                <option value="" selected disabled>-- Seleccionar --</option>
                                <option value="Cardiólogo" >Cardiólogo</option>
                                <option value="Clínico">Clínico</option>
                                <option value="Traumatólogo">Traumatólogo</option>
                                <option value="Neurólogo">Neurólogo</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nro_denuncia_art" class="form-label">Nro. Denuncia ART:</label>
                            <input type="text" class="form-control" id="nro_denuncia_art" name="nro_denuncia_art">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tipo_denuncia_art" class="form-label">Tipo denuncia ART:</label>
                            <input type="text" class="form-control" id="tipo_denuncia_art" name="tipo_denuncia_art">
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- SECCIÓN CONTROL -->
                    <h5 class="mb-3 border-bottom pb-2">
                        <i class="fas fa-clipboard-check me-2"></i>CONTROL
                    </h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="fecha_control" class="form-label">Fecha:</label>
                            <input type="date" class="form-control" id="fecha_control" name="fecha_control">
                        </div>
                        <div class="col-md-6">
                            <label for="med_auditor" class="form-label">Médico auditor:</label>
                            <input type="text" class="form-control" id="med_auditor" name="med_auditor">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="resultado" class="form-label">Resultado:</label>
                            <select class="form-select" id="resultado" name="resultado">
                                <option value="" selected disabled>-- Seleccionar --</option>
                                <option value="Convalidado">Convalidado</option>
                                <option value="Rechazado">Rechazado</option>
                                <option value="Requiere">Requiere</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Requiere reubicación:</label>
                            <div class="mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="requiere_reubicacion" id="reub_si" value="Si">
                                    <label class="form-check-label" for="reub_si">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="requiere_reubicacion" id="reub_no" value="No" checked>
                                    <label class="form-check-label" for="reub_no">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="apto_reingreso" class="form-label">proximo al reingreso:</label>
                            <input type="date" class="form-control" id="apto_reingreso" name="apto_reingreso">
                        </div>
                        <div class="col-md-3">
                            <label for="alta_reingreso" class="form-label">Alta reingreso:</label>
                            <input type="date" class="form-control" id="alta_reingreso" name="alta_reingreso">
                        </div>
                        <div class="col-md-3">
                            <label for="dias_ausentismo_control" class="form-label">Días ausentismo:</label>
                            <input type="number" class="form-control" id="dias_ausentismo_control" name="dias_ausentismo_control">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="4" placeholder="Observaciones adicionales..."></textarea>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-transparent btn-lg">
                            <i class="fas fa-save me-2"></i>Guardar
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <!-- Incluir el archivo JS de búsquedas -->
    <script src="busqueda_api.js"></script>
    
    <!-- Incluir SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Incluir funciones de alerta -->
    <script src="alertas.js"></script>

    <script>
        // Configuración para el formulario de control de ausentismo
        const configAusentismo = {
            empresas: {
                inputId: 'razon_social_buscar',
                btnId: 'btnBuscarEmpresa',
                empresaIdField: 'empresa_id_hidden',
                campos: [
                    { id: 'razon_social', apiField: 'razonsocial' },
                    { id: 'domicilio_empresa', apiField: 'domicilio' }
                ]
            },
            empleados: {
                dniId: 'dni',
                btnId: 'btnBuscarEmpleado',
                pacienteIdField: 'paciente_id_hidden',
                campos: [
                    { id: 'nombre', apiField: 'nombres' },
                    { id: 'apellido', apiField: 'apellidos' },
                    { id: 'telefono', apiField: 'telefono' },
                    { id: 'celular', apiField: 'celular' },
                    { id: 'domicilio_empleado', apiField: 'domicilio' }
                ]
            }
        };

        // Inicializar las búsquedas cuando se carga la página
        document.addEventListener('DOMContentLoaded', function() {
            busquedaAPI.inicializarBusquedas(configAusentismo);
        });

        // Cálculo automático de días de ausentismo
        function calcularDiasAusentismo() {
            const fechaInicio = document.getElementById('inicio_certificado').value;
            const fechaVto = document.getElementById('vto_certificado').value;
            
            if (fechaInicio && fechaVto) {
                const inicio = new Date(fechaInicio);
                const vto = new Date(fechaVto);
                const diffTime = vto - inicio;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                
                document.querySelector('[for="dias_ausentismo"] + .form-control-plaintext').textContent = diffDays + ' días';
                document.getElementById('dias_ausentismo_control').value = diffDays;
            }
        }

        // Calcular día de la semana del inicio
        function calcularDiaInicio() {
            const fechaInicio = document.getElementById('inicio_certificado').value;
            if (fechaInicio) {
                const fecha = new Date(fechaInicio);
                const dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                document.querySelector('[for="dia_inicio_cert"] + .form-control-plaintext').textContent = dias[fecha.getDay()];
            }
        }

        document.getElementById('inicio_certificado').addEventListener('change', function() {
            calcularDiasAusentismo();
            calcularDiaInicio();
        });

        document.getElementById('vto_certificado').addEventListener('change', calcularDiasAusentismo);
        
        // Cálculo automático de antigüedad
        function calcularAntiguedad() {
            const fechaIngreso = document.getElementById('fecha_ingreso').value;
            if (fechaIngreso) {
                const fechaIngresoDate = new Date(fechaIngreso);
                const fechaActual = new Date();
                
                // Calcular diferencia en años con precisión
                let años = fechaActual.getFullYear() - fechaIngresoDate.getFullYear();
                const mesActual = fechaActual.getMonth();
                const mesIngreso = fechaIngresoDate.getMonth();
                
                // Ajustar si aún no ha cumplido años en el año actual
                if (mesActual < mesIngreso || (mesActual === mesIngreso && fechaActual.getDate() < fechaIngresoDate.getDate())) {
                    años--;
                }
                
                // Calcular meses adicionales
                let meses = mesActual - mesIngreso;
                if (meses < 0) {
                    meses += 12;
                }
                
                // Formatear el resultado solo con años y meses
                let resultado = '';
                if (años > 0) {
                    resultado += años + ' año' + (años > 1 ? 's' : '');
                }
                if (meses > 0) {
                    if (resultado) resultado += ', ';
                    resultado += meses + ' mes' + (meses > 1 ? 'es' : '');
                }
                
                if (!resultado) {
                    resultado = 'Menos de 1 mes';
                }
                
                document.getElementById('antiguedad').value = resultado;
            }
        }

        document.getElementById('fecha_ingreso').addEventListener('change', calcularAntiguedad);

        // Función para obtener el JSON desde el formulario
        function obtenerJsonDesdeFormulario() {
            const form = document.getElementById('ausentismoForm');
            const formData = new FormData(form);
            const jsonData = {};

            // Recorrer todos los campos del formulario
            formData.forEach((value, key) => {
                // Excluir los campos individuales del empleado y empresa del JSON final
                if (!['nombre', 'apellido', 'telefono', 'celular', 'domicilio_empleado', 'dni', 'razon_social', 'domicilio_empresa', 'razon_social_buscar'].includes(key)) {
                    jsonData[key] = value;
                }
            });

            // Calcular días de ausentismo
            const fechaInicio = document.getElementById('inicio_certificado').value;
            const fechaVto = document.getElementById('vto_certificado').value;
            
            if (fechaInicio && fechaVto) {
                const inicio = new Date(fechaInicio);
                const vto = new Date(fechaVto);
                const diffTime = vto - inicio;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                jsonData.dias_ausentismo = diffDays;
            } else {
                jsonData.dias_ausentismo = 0;
            }

            // Calcular día de la semana del inicio
            if (fechaInicio) {
                const fecha = new Date(fechaInicio);
                const dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                jsonData.dia_inicio_cert = dias[fecha.getDay()];
            } else {
                jsonData.dia_inicio_cert = '';
            }

            // Calcular antigüedad
            const fechaIngreso = document.getElementById('fecha_ingreso').value;
            if (fechaIngreso) {
                const fechaIngresoDate = new Date(fechaIngreso);
                const fechaActual = new Date();
                
                // Calcular diferencia en años con precisión
                let años = fechaActual.getFullYear() - fechaIngresoDate.getFullYear();
                const mesActual = fechaActual.getMonth();
                const mesIngreso = fechaIngresoDate.getMonth();
                
                // Ajustar si aún no ha cumplido años en el año actual
                if (mesActual < mesIngreso || (mesActual === mesIngreso && fechaActual.getDate() < fechaIngresoDate.getDate())) {
                    años--;
                }
                
                // Calcular meses adicionales
                let meses = mesActual - mesIngreso;
                if (meses < 0) {
                    meses += 12;
                }
                
                // Formatear el resultado solo con años y meses
                let resultado = '';
                if (años > 0) {
                    resultado += años + ' año' + (años > 1 ? 's' : '');
                }
                if (meses > 0) {
                    if (resultado) resultado += ', ';
                    resultado += meses + ' mes' + (meses > 1 ? 'es' : '');
                }
                
                if (!resultado) {
                    resultado = 'Menos de 1 mes';
                }
                
                jsonData.antiguedad_calculada = resultado;
                jsonData.antiguedad_anios = años;
                jsonData.antiguedad_meses = meses;
            } else {
                jsonData.antiguedad_calculada = '';
                jsonData.antiguedad_anios = 0;
                jsonData.antiguedad_meses = 0;
            }

            // Obtener el array de partes seleccionadas desde Vue
            if (window.vueApp && Array.isArray(window.vueApp.selectedParts)) {
                jsonData.partes_afectadas = window.vueApp.selectedParts;
            } else {
                jsonData.partes_afectadas = [];
            }

            jsonData.fecha_registro = new Date().toISOString();

            return jsonData;
        }

        // Envío del formulario usando el JSON generado
        document.getElementById('ausentismoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Generar el JSON
            const jsonData = obtenerJsonDesdeFormulario();
            
            // Mostrar alerta de carga
            mostrarAlertaCarga('Registrando control de ausentismo...');
            
            console.log(JSON.stringify(jsonData, null, 2));
            
            fetch('/ausentismo/registrar_ausencia', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(jsonData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                cerrarAlertaCarga();
                mostrarAlertaExito('Control de ausentismo registrado correctamente', '¡Registro Exitoso!', true);
            })
            .catch(error => {
                cerrarAlertaCarga();
                console.error('Error al registrar el accidente:', error);
                //mostrarAlertaError('Error al registrar el accidente', '¡Error!', true);
            });
        });

    </script>

    <?php include 'footer.php'; ?>
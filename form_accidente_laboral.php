<style>
    
</style>

<?php include 'header.php'; ?>
    <div class="container-fluid container py-4 ">
        <div class="card shadow" id="card-form" >
            <div class="card-header bg-primary text-white">
                <h3 class="text-center mb-0"><i class="fas fa-clipboard-list me-2"></i>Ficha de Accidente Laboral</h3>
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
                                <label class="input-group-text" for="razon_social_buscar">Razón Social</label>
                                <input type="text" class="form-control" id="razon_social_buscar" name="razon_social_buscar" placeholder="Ingrese razón social" list="empresas-list" autocomplete="off">
                                <datalist id="empresas-list">
                                    <!-- Las opciones se cargarán dinámicamente -->
                                </datalist>
                                <button type="button" class="btn btn-primary" id="btnBuscarEmpresa">
                                    <i class="fas fa-search me-1"></i>Buscar
                                </button>
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
                                <button type="button" class="btn btn-primary" id="btnBuscarEmpleado">
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
                        <button type="submit" class="btn btn-primary btn-lg">
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
        // Configuración para el formulario de accidente laboral
        const configAccidente = {
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
            busquedaAPI.inicializarBusquedas(configAccidente);
        });

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
            const form = document.getElementById('accidentForm');
            const formData = new FormData(form);
            const jsonData = {};

            // Recorrer todos los campos del formulario
            formData.forEach((value, key) => {
                // Excluir los campos individuales del empleado y empresa del JSON final
                if (!['nombre', 'apellido', 'telefono', 'celular', 'domicilio_empleado', 'dni', 'razon_social', 'domicilio_empresa', 'razon_social_buscar'].includes(key)) {
                    jsonData[key] = value;
                }
            });

            // Obtener los campos que están en <p> y sincronizarlos con los <input type="hidden">
            const camposTexto = [
                // Ya no necesitamos estos campos porque se excluyen del JSON final
            ];
            camposTexto.forEach(id => {
                const valor = document.getElementById(id).textContent.trim();
                jsonData[id] = valor;
            });

            // Obtener el array de partes seleccionadas desde Vue
            if (window.vueApp && Array.isArray(window.vueApp.selectedParts)) {
                jsonData.partes_afectadas = window.vueApp.selectedParts;
            } else {
                jsonData.partes_afectadas = [];
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

            jsonData.fecha_registro = new Date().toISOString();

            return jsonData;
        }

        // Envío del formulario usando el JSON generado
        document.getElementById('accidentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Generar el JSON
            const jsonData = obtenerJsonDesdeFormulario();

            // Mostrar alerta de carga
            mostrarAlertaCarga('Registrando accidente...');

            // Puedes mostrarlo en consola para ver el resultado
            console.log(JSON.stringify(jsonData, null, 2));

            // Enviar a la API
            fetch('/accidentologia/registrar_accidente', {
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
                mostrarAlertaExito('Accidente registrado correctamente', '¡Registro Exitoso!', true);
            })
            .catch(error => {
                console.error('Error al registrar el accidente:', error);
                //mostrarAlertaError('Error al registrar el accidente', '¡Error!', true);
            });
        });
    </script>

    <?php include 'footer.php'; ?>
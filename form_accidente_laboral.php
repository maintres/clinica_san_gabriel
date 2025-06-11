
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
                                <label class="input-group-text" for="cuit">CUIT</label>
                                <input type="text" class="form-control" id="cuit" name="cuit">
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-search me-1"></i>Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="razon_social" class="form-label">Razón Social</label>
                            <input type="text" class="form-control" id="razon_social" name="razon_social" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">                        
                        <div class="col-md-6">
                            <label for="domicilio_empresa" class="form-label">Domicilio</label>
                            <input type="text" class="form-control" id="domicilio_empresa" name="domicilio_empresa" disabled>
                        </div>
                         <div class="col-md-6">
                            <button type="button" class="btn btn-warning mt-4" id="btnModificarEmpresa">
                                <i class="fas fa-edit me-1"></i>Modificar
                            </button>
                        </div> 
                    </div>

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
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-search me-1"></i>Buscar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre_apellido" class="form-label">Nombre y Apellido</label>
                            <input type="text" class="form-control" id="nombre_apellido" name="nombre_apellido" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="tel" class="form-control" id="celular" name="celular" disabled>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="domicilio_empleado" class="form-label">Domicilio</label>
                            <input type="text" class="form-control" id="domicilio_empleado" name="domicilio_empleado" disabled>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-warning mt-4" id="btnModificarEmpleado">
                                <i class="fas fa-edit me-1"></i>Modificar
                            </button>
                        </div> 
                    </div>

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
                            <label for="antiguedad" class="form-label">Antigüedad (años)</label>
                            <input type="text" class="form-control" id="antiguedad" name="antiguedad">
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="obra_social" class="form-label">Obra Social</label>
                            <select class="form-select" id="obra_social" name="obra_social">
                                <option value="OSDE" selected>OSDE</option>
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
                            <label for="med_at_inicial" class="form-label">Médico Atención Inicial</label>
                            <input type="text" class="form-control" id="med_at_inicial" name="med_at_inicial">
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
                            <i class="fas fa-save me-2"></i>Guardar Ficha
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <script>
        // Funciones para habilitar/deshabilitar campos
        function toggleEmpresaFields() {
            const razonSocial = document.getElementById('razon_social');
            const domicilioEmpresa = document.getElementById('domicilio_empresa');
            const btn = document.getElementById('btnModificarEmpresa');
            
            if (razonSocial.disabled) {
                razonSocial.disabled = false;
                domicilioEmpresa.disabled = false;
                btn.innerHTML = '<i class="fas fa-save me-1"></i>Guardar';
                btn.classList.remove('btn-warning');
                btn.classList.add('btn-success');
            } else {
                razonSocial.disabled = true;
                domicilioEmpresa.disabled = true;
                btn.innerHTML = '<i class="fas fa-edit me-1"></i>Modificar';
                btn.classList.remove('btn-success');
                btn.classList.add('btn-warning');
                alert('Datos de empresa guardados');
            }
        }

        function toggleEmpleadoFields() {
            const nombreApellido = document.getElementById('nombre_apellido');
            const domicilioEmpleado = document.getElementById('domicilio_empleado');
            const telefono = document.getElementById('telefono');
            const celular = document.getElementById('celular');
            const btn = document.getElementById('btnModificarEmpleado');
            
            if (nombreApellido.disabled) {
                nombreApellido.disabled = false;
                domicilioEmpleado.disabled = false;
                telefono.disabled = false;
                celular.disabled = false;
                btn.innerHTML = '<i class="fas fa-save me-1"></i>Guardar';
                btn.classList.remove('btn-warning');
                btn.classList.add('btn-success');
            } else {
                nombreApellido.disabled = true;
                domicilioEmpleado.disabled = true;
                telefono.disabled = true;
                celular.disabled = true;
                btn.innerHTML = '<i class="fas fa-edit me-1"></i>Modificar';
                btn.classList.remove('btn-success');
                btn.classList.add('btn-warning');
                alert('Datos de empleado guardados');
            }
        }

        // Event listeners para botones modificar
        document.getElementById('btnModificarEmpresa').addEventListener('click', toggleEmpresaFields);
        document.getElementById('btnModificarEmpleado').addEventListener('click', toggleEmpleadoFields);

        // Cálculo automático de antigüedad
        document.getElementById('fecha_ingreso').addEventListener('change', function() {
            const fechaIngreso = new Date(this.value);
            const fechaActual = new Date();
            const diffTime = fechaActual - fechaIngreso;
            const diffYears = Math.floor(diffTime / (1000 * 60 * 60 * 24 * 365));
            document.getElementById('antiguedad').value = diffYears + ' años';
        });

        // Función para seleccionar partes del cuerpo
        function selectBodyPart(event) {
            const rect = event.currentTarget.getBoundingClientRect();
            const x = ((event.clientX - rect.left) / rect.width) * 100;
            const y = ((event.clientY - rect.top) / rect.height) * 100;
            
            const injuryPoint = document.createElement('div');
            injuryPoint.className = 'injury-point';
            injuryPoint.style.left = x + '%';
            injuryPoint.style.top = y + '%';
            injuryPoint.title = 'Zona afectada';
            injuryPoint.onclick = function() { this.remove(); };
            
            event.currentTarget.appendChild(injuryPoint);
        }

        // Validación del formulario
        document.getElementById('accidentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const requiredFields = document.querySelectorAll('.required-field');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (isValid) {
                // Aquí iría la lógica para enviar los datos
                alert('Ficha de accidente guardada correctamente');
                console.log('Datos del formulario:', new FormData(this));
            } else {
                alert('Por favor complete todos los campos obligatorios');
            }
        });

        // Función para buscar empresa por CUIT
        document.querySelector('[onclick*="buscar"]')?.addEventListener('click', function() {
            const cuit = document.getElementById('cuit').value;
            if (cuit) {
                // Simular búsqueda de empresa
                console.log('Buscando empresa con CUIT:', cuit);
            }
        });

    </script>

    <?php
    // Procesamiento PHP del formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Configuración de base de datos
        $host = 'localhost';
        $dbname = 'accidentes_laborales';
        $username = 'usuario';
        $password = 'contraseña';
        
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Preparar consulta SQL
            $sql = "INSERT INTO accidentes_laborales (
                cuit, razon_social, domicilio_empresa, dni, nombre_apellido, 
                telefono, celular, domicilio_empleado, puesto, area, 
                fecha_ingreso, antiguedad, obra_social, plan, nro_afiliado,
                tipo_accidente, agente_causal, testigos, descripcion, 
                tipo_lesion, gravedad, derivacion, intervencion_art, 
                dias_baja, diagnostico, prox_ctrl, med_at_inicial, 
                matricula, observaciones, fecha_registro
            ) VALUES (
                :cuit, :razon_social, :domicilio_empresa, :dni, :nombre_apellido,
                :telefono, :celular, :domicilio_empleado, :puesto, :area,
                :fecha_ingreso, :antiguedad, :obra_social, :plan, :nro_afiliado,
                :tipo_accidente, :agente_causal, :testigos, :descripcion,
                :tipo_lesion, :gravedad, :derivacion, :intervencion_art,
                :dias_baja, :diagnostico, :prox_ctrl, :med_at_inicial,
                :matricula, :observaciones, NOW()
            )";
            
            $stmt = $pdo->prepare($sql);
            
            // Ejecutar consulta con los datos del formulario
            $stmt->execute([
                ':cuit' => $_POST['cuit'],
                ':razon_social' => $_POST['razon_social'],
                ':domicilio_empresa' => $_POST['domicilio_empresa'],
                ':dni' => $_POST['dni'],
                ':nombre_apellido' => $_POST['nombre_apellido'],
                ':telefono' => $_POST['telefono'],
                ':celular' => $_POST['celular'],
                ':domicilio_empleado' => $_POST['domicilio_empleado'],
                ':puesto' => $_POST['puesto'],
                ':area' => $_POST['area'],
                ':fecha_ingreso' => $_POST['fecha_ingreso'],
                ':antiguedad' => $_POST['antiguedad'],
                ':obra_social' => $_POST['obra_social'],
                ':plan' => $_POST['plan'],
                ':nro_afiliado' => $_POST['nro_afiliado'],
                ':tipo_accidente' => $_POST['tipo_accidente'],
                ':agente_causal' => $_POST['agente_causal'],
                ':testigos' => $_POST['testigos'],
                ':descripcion' => $_POST['descripcion'],
                ':tipo_lesion' => $_POST['tipo_lesion'],
                ':gravedad' => $_POST['gravedad'],
                ':derivacion' => $_POST['derivacion'],
                ':intervencion_art' => $_POST['intervencion_art'],
                ':dias_baja' => $_POST['dias_baja'],
                ':diagnostico' => $_POST['diagnostico'],
                ':prox_ctrl' => $_POST['prox_ctrl'],
                ':med_at_inicial' => $_POST['med_at_inicial'],
                ':matricula' => $_POST['matricula'],
                ':observaciones' => $_POST['observaciones']
            ]);
            
            echo "<script>alert('Accidente registrado correctamente');</script>";
            
        } catch(PDOException $e) {
            echo "<script>alert('Error al guardar: " . $e->getMessage() . "');</script>";
        }
    }
    ?>
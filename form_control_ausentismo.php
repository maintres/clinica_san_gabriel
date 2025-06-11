<?php include 'header.php'; ?>
    <div class="container-fluid container py-4">
        <div class="card shadow" id="card-form" >
            <div class="card-header bg-primary text-white">
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
                            <label for="razon_social" class="form-label">Razón Social:</label>
                            <input type="text" class="form-control" id="razon_social" name="razon_social" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">                        
                        <div class="col-md-6">
                            <label for="domicilio_empresa" class="form-label">Domicilio:</label>
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
                            <input type="text" class="form-control" id="area" name="area" placeholder="Ej: Embalaje" >
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                            <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" >
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
                                    <input class="form-check-input" type="radio" name="aseguradora_art" id="art_si" value="Si" checked>
                                    <label class="form-check-label" for="art_si">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="aseguradora_art" id="art_no" value="No">
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
                                <option value="Cardiólogo" selected>Cardiólogo</option>
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
                                <option value="Convalidado" selected>Convalidado</option>
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
                            <label for="apto_reingreso" class="form-label">Apto al reingreso:</label>
                            <input type="date" class="form-control" id="apto_reingreso" name="apto_reingreso">
                        </div>
                        <div class="col-md-3">
                            <label for="alta_reingreso" class="form-label">Alta reingreso:</label>
                            <input type="date" class="form-control" id="alta_reingreso" name="alta_reingreso">
                        </div>
                        <div class="col-md-3">
                            <label for="dias_ausentismo_final" class="form-label">Días ausentismo:</label>
                            <input type="number" class="form-control" id="dias_ausentismo_final" name="dias_ausentismo_final">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="4" placeholder="Observaciones adicionales..."></textarea>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Guardar Control de Ausentismo
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <script>
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
                document.getElementById('dias_ausentismo_final').value = diffDays;
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

        // Event listeners
        document.getElementById('btnModificarEmpresa').addEventListener('click', toggleEmpresaFields);
        document.getElementById('btnModificarEmpleado').addEventListener('click', toggleEmpleadoFields);
        
        document.getElementById('inicio_certificado').addEventListener('change', function() {
            calcularDiasAusentismo();
            calcularDiaInicio();
        });

        document.getElementById('vto_certificado').addEventListener('change', calcularDiasAusentismo);
        
        // Cálculo automático de antigüedad
        document.getElementById('fecha_ingreso').addEventListener('change', function() {
            const fechaIngreso = new Date(this.value);
            const fechaActual = new Date();
            const diffTime = fechaActual - fechaIngreso;
            const diffYears = Math.floor(diffTime / (1000 * 60 * 60 * 24 * 365));
            document.getElementById('antiguedad').value = diffYears + ' años';
        });

        // Validación del formulario
        document.getElementById('ausentismoForm').addEventListener('submit', function(e) {
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
                alert('Control de ausentismo guardado correctamente');
                console.log('Datos del formulario:', new FormData(this));
            } else {
                alert('Por favor complete todos los campos obligatorios');
            }
        });

    </script>

    <?php
    // Procesamiento PHP del formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Configuración de base de datos
        $host = 'localhost';
        $dbname = 'control_ausentismo';
        $username = 'usuario';
        $password = 'contraseña';
        
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Preparar consulta SQL
            $sql = "INSERT INTO control_ausentismo (
                cuit, razon_social, domicilio_empresa, dni, nombre_apellido, 
                domicilio_empleado, telefono, celular, puesto, area, 
                fecha_ingreso, antiguedad, obra_social, plan, nro_afiliado,
                tipo_licencia, agente_causal, diagnostico, tratamiento,
                aseguradora_art, inicio_certificado, vto_certificado, dias_ausentismo,
                dia_inicio_cert, med_tratante, matricula, especialidad,
                nro_denuncia_art, tipo_denuncia_art, fecha_control, med_auditor,
                resultado, requiere_reubicacion, apto_reingreso, alta_reingreso,
                dias_ausentismo_final, observaciones, fecha_registro
            ) VALUES (
                :cuit, :razon_social, :domicilio_empresa, :dni, :nombre_apellido,
                :domicilio_empleado, :telefono, :celular, :puesto, :area,
                :fecha_ingreso, :antiguedad, :obra_social, :plan, :nro_afiliado,
                :tipo_licencia, :agente_causal, :diagnostico, :tratamiento,
                :aseguradora_art, :inicio_certificado, :vto_certificado, :dias_ausentismo,
                :dia_inicio_cert, :med_tratante, :matricula, :especialidad,
                :nro_denuncia_art, :tipo_denuncia_art, :fecha_control, :med_auditor,
                :resultado, :requiere_reubicacion, :apto_reingreso, :alta_reingreso,
                :dias_ausentismo_final, :observaciones, NOW()
            )";
            
            $stmt = $pdo->prepare($sql);
            
            // Ejecutar consulta con los datos del formulario
            $stmt->execute([
                ':cuit' => $_POST['cuit'],
                ':razon_social' => $_POST['razon_social'] ?? '',
                ':domicilio_empresa' => $_POST['domicilio_empresa'] ?? '',
                ':dni' => $_POST['dni'],
                ':nombre_apellido' => $_POST['nombre_apellido'] ?? '',
                ':domicilio_empleado' => $_POST['domicilio_empleado'] ?? '',
                ':telefono' => $_POST['telefono'] ?? '',
                ':celular' => $_POST['celular'] ?? '',
                ':puesto' => $_POST['puesto'],
                ':area' => $_POST['area'],
                ':fecha_ingreso' => $_POST['fecha_ingreso'],
                ':antiguedad' => $_POST['antiguedad'] ?? '',
                ':obra_social' => $_POST['obra_social'],
                ':plan' => $_POST['plan'],
                ':nro_afiliado' => $_POST['nro_afiliado'],
                ':tipo_licencia' => $_POST['tipo_licencia'],
                ':agente_causal' => $_POST['agente_causal'],
                ':diagnostico' => $_POST['diagnostico'],
                ':tratamiento' => $_POST['tratamiento'],
                ':aseguradora_art' => $_POST['aseguradora_art'],
                ':inicio_certificado' => $_POST['inicio_certificado'],
                ':vto_certificado' => $_POST['vto_certificado'],
                ':dias_ausentismo' => $_POST['dias_ausentismo'] ?? '',
                ':dia_inicio_cert' => $_POST['dia_inicio_cert'] ?? '',
                ':med_tratante' => $_POST['med_tratante'],
                ':matricula' => $_POST['matricula'],
                ':especialidad' => $_POST['especialidad'],
                ':nro_denuncia_art' => $_POST['nro_denuncia_art'],
                ':tipo_denuncia_art' => $_POST['tipo_denuncia_art'],
                ':fecha_control' => $_POST['fecha_control'],
                ':med_auditor' => $_POST['med_auditor'],
                ':resultado' => $_POST['resultado'],
                ':requiere_reubicacion' => $_POST['requiere_reubicacion'],
                ':apto_reingreso' => $_POST['apto_reingreso'],
                ':alta_reingreso' => $_POST['alta_reingreso'],
                ':dias_ausentismo_final' => $_POST['dias_ausentismo_final'],
                ':observaciones' => $_POST['observaciones']
            ]);
            
            echo "<script>alert('Control de ausentismo registrado correctamente');</script>";
            
        } catch(PDOException $e) {
            echo "<script>alert('Error al guardar: " . $e->getMessage() . "');</script>";
        }
    }
    ?>
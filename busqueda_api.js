// Funciones de búsqueda para API de empleados y empresas
// Reutilizable para múltiples formularios

// Variables globales
let todasLasEmpresas = [];

// ========================================
// FUNCIONES PARA BÚSQUEDA DE EMPLEADOS
// ========================================

/**
 * Busca un empleado por DNI en la API
 * @param {string} dni - DNI del empleado a buscar
 * @param {string} btnId - ID del botón de búsqueda
 * @param {Object} config - Configuración de campos
 */
function buscarEmpleado(dni, btnId, config) {
    if (!dni || !dni.trim()) {
        mostrarAlertaError('Por favor, ingrese un DNI válido', 'DNI Requerido');
        return;
    }

    // Mostrar indicador de carga
    const btnBuscar = document.getElementById(btnId);
    const originalText = btnBuscar.innerHTML;
    btnBuscar.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Buscando...';
    btnBuscar.disabled = true;

    // Hacer la llamada a la API
    fetch(`https://preocupacionales.sangabrielsj.com/api/pacientes/get_by_dni/${dni}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.success === 'yes' && data.data && data.data.listado && data.data.listado.length > 0) {
                const empleado = data.data.listado[0];
                
                // Mostrar los datos en los elementos <p>
                if (config.campos) {
                    config.campos.forEach(campo => {
                        const elemento = document.getElementById(campo.id);
                        if (elemento) {
                            elemento.textContent = empleado[campo.apiField] || '';
                        }
                    });
                }
                
                // Guardar el ID del paciente en el campo hidden
                if (config.pacienteIdField) {
                    document.getElementById(config.pacienteIdField).value = empleado.id;
                }
                
                if (config.onSuccess) {
                    config.onSuccess(empleado);
                }
            } else {
                mostrarAlertaError('No se encontró ningún empleado con ese DNI', 'Empleado No Encontrado');
                limpiarDatosEmpleado(config);
            }
        })
        .catch(error => {
            console.error('Error al buscar empleado:', error);
            mostrarAlertaError('Error al buscar empleado: ' + error.message, 'Error de Búsqueda');
            limpiarDatosEmpleado(config);
        })
        .finally(() => {
            // Restaurar el botón
            btnBuscar.innerHTML = originalText;
            btnBuscar.disabled = false;
        });
}

/**
 * Limpia los datos del empleado
 * @param {Object} config - Configuración de campos
 */
function limpiarDatosEmpleado(config) {
    if (config.campos) {
        config.campos.forEach(campo => {
            const elemento = document.getElementById(campo.id);
            if (elemento) {
                elemento.textContent = '';
            }
        });
    }
    
    // Limpiar el ID del paciente
    if (config.pacienteIdField) {
        document.getElementById(config.pacienteIdField).value = '';
    }
}

// ========================================
// FUNCIONES PARA BÚSQUEDA DE EMPRESAS
// ========================================

/**
 * Carga todas las empresas de la API
 */
function cargarTodasLasEmpresas() {
    fetch('https://preocupacionales.sangabrielsj.com/api/empresas/get_all')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.success === 'yes' && data.data && data.data.listado) {
                todasLasEmpresas = data.data.listado;
                actualizarDatalistEmpresas();
            }
        })
        .catch(error => {
            console.error('Error al cargar empresas:', error);
            mostrarAlertaError('Error al cargar la lista de empresas', 'Error de Carga');
        });
}

/**
 * Actualiza el datalist con todas las empresas
 */
function actualizarDatalistEmpresas() {
    const datalist = document.getElementById('empresas-list');
    if (!datalist) return;
    
    datalist.innerHTML = '';
    
    todasLasEmpresas.forEach(empresa => {
        if (empresa.razonsocial) {
            const option = document.createElement('option');
            option.value = empresa.razonsocial;
            option.setAttribute('data-id', empresa.id);
            option.setAttribute('data-domicilio', empresa.domicilio || '');
            datalist.appendChild(option);
        }
    });
}

/**
 * Busca empresa por razón social
 * @param {string} razonSocial - Razón social a buscar
 * @param {Object} config - Configuración de campos
 */
function buscarEmpresa(razonSocial, config) {
    if (!razonSocial || !razonSocial.trim()) {
        mostrarAlertaError('Por favor, ingrese una razón social válida', 'Razón Social Requerida');
        return;
    }

    // Buscar en la lista local de empresas
    const empresa = todasLasEmpresas.find(emp => 
        emp.razonsocial && 
        emp.razonsocial.toLowerCase().includes(razonSocial.toLowerCase())
    );
    
    if (empresa) {
        // Mostrar los datos en los elementos <p>
        if (config.campos) {
            config.campos.forEach(campo => {
                const elemento = document.getElementById(campo.id);
                if (elemento) {
                    elemento.textContent = empresa[campo.apiField] || '';
                }
            });
        }
        
        // Guardar el ID de la empresa en el campo hidden
        if (config.empresaIdField) {
            document.getElementById(config.empresaIdField).value = empresa.id;
        }
        
        if (config.onSuccess) {
            config.onSuccess(empresa);
        }
    } else {
        mostrarAlertaError('No se encontró ninguna empresa con esa razón social', 'Empresa No Encontrada');
        limpiarDatosEmpresa(config);
    }
}

/**
 * Limpia los datos de la empresa
 * @param {Object} config - Configuración de campos
 */
function limpiarDatosEmpresa(config) {
    if (config.campos) {
        config.campos.forEach(campo => {
            const elemento = document.getElementById(campo.id);
            if (elemento) {
                elemento.textContent = '';
            }
        });
    }
    
    // Limpiar el ID de la empresa
    if (config.empresaIdField) {
        document.getElementById(config.empresaIdField).value = '';
    }
}

/**
 * Configura el autocompletado de empresas
 * @param {string} inputId - ID del input de búsqueda
 * @param {Object} config - Configuración de campos
 */
function configurarAutocompletadoEmpresas(inputId, config) {
    const input = document.getElementById(inputId);
    if (!input) return;

    input.addEventListener('input', function(e) {
        const valor = e.target.value;
        const empresa = todasLasEmpresas.find(emp => emp.razonsocial === valor);
        
        if (empresa) {
            // Auto-completar los datos cuando se selecciona una opción
            if (config.campos) {
                config.campos.forEach(campo => {
                    const elemento = document.getElementById(campo.id);
                    if (elemento) {
                        elemento.textContent = empresa[campo.apiField] || '';
                    }
                });
            }
            
            // Guardar el ID de la empresa
            if (config.empresaIdField) {
                document.getElementById(config.empresaIdField).value = empresa.id;
            }
        }
    });
}

// ========================================
// FUNCIONES DE INICIALIZACIÓN
// ========================================

/**
 * Inicializa las funciones de búsqueda para un formulario
 * @param {Object} config - Configuración completa del formulario
 */
function inicializarBusquedas(config) {
    // Cargar empresas al cargar la página
    if (config.empresas) {
        cargarTodasLasEmpresas();
        
        // Configurar autocompletado
        if (config.empresas.inputId) {
            configurarAutocompletadoEmpresas(config.empresas.inputId, config.empresas);
        }
        
        // Event listeners para empresa
        if (config.empresas.btnId) {
            document.getElementById(config.empresas.btnId).addEventListener('click', function() {
                const valor = document.getElementById(config.empresas.inputId).value;
                buscarEmpresa(valor, config.empresas);
            });
        }
        
        if (config.empresas.inputId) {
            document.getElementById(config.empresas.inputId).addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const valor = e.target.value;
                    buscarEmpresa(valor, config.empresas);
                }
            });
        }
    }
    
    // Event listeners para empleados
    if (config.empleados) {
        if (config.empleados.btnId) {
            document.getElementById(config.empleados.btnId).addEventListener('click', function() {
                const dni = document.getElementById(config.empleados.dniId).value;
                buscarEmpleado(dni, config.empleados.btnId, config.empleados);
            });
        }
        
        if (config.empleados.dniId) {
            document.getElementById(config.empleados.dniId).addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const dni = e.target.value;
                    buscarEmpleado(dni, config.empleados.btnId, config.empleados);
                }
            });
        }
    }
}

// Exportar funciones para uso global
window.busquedaAPI = {
    buscarEmpleado,
    limpiarDatosEmpleado,
    buscarEmpresa,
    limpiarDatosEmpresa,
    cargarTodasLasEmpresas,
    configurarAutocompletadoEmpresas,
    inicializarBusquedas
}; 
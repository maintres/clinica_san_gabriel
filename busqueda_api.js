// API de búsqueda para formularios
const busquedaAPI = {
    // Configuración global
    config: null,
    
    // Cache de empresas
    empresasCache: [],
    
    // Inicializar las búsquedas
    inicializarBusquedas: function(config) {
        this.config = config;
        
        // Cargar empresas al inicializar
        this.cargarEmpresas();
        
        // Configurar eventos de búsqueda
        this.configurarEventos();
    },
    
    // Cargar todas las empresas desde la API
    cargarEmpresas: function() {
        fetch('/empresas/get_all')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al cargar empresas');
                }
                return response.json();
            })
            .then(data => {
                if (data && Array.isArray(data)) {
                    this.empresasCache = data;
                    this.actualizarDatalistEmpresas();
                } else {
                    console.error('Formato de respuesta inválido:', data);
                }
            })
            .catch(error => {
                console.error('Error al cargar empresas:', error);
                mostrarAlertaError('Error al cargar la lista de empresas', 'Error de conexión');
            });
    },
    
    // Actualizar el datalist con las empresas cargadas
    actualizarDatalistEmpresas: function() {
        const datalist = document.getElementById('empresas-list');
        if (!datalist) return;
        
        // Limpiar opciones existentes
        datalist.innerHTML = '';
        
        // Agregar nuevas opciones
        this.empresasCache.forEach(empresa => {
            const option = document.createElement('option');
            option.value = empresa.razonsocial || empresa.razon_social || '';
            option.textContent = empresa.razonsocial || empresa.razon_social || '';
            datalist.appendChild(option);
        });
    },
    
    // Configurar eventos de búsqueda
    configurarEventos: function() {
        // Evento para búsqueda de empresa
        const btnBuscarEmpresa = document.getElementById(this.config.empresas.btnId);
        if (btnBuscarEmpresa) {
            btnBuscarEmpresa.addEventListener('click', () => {
                this.buscarEmpresa();
            });
        }
        
        // Evento para búsqueda de empleado
        const btnBuscarEmpleado = document.getElementById(this.config.empleados.btnId);
        if (btnBuscarEmpleado) {
            btnBuscarEmpleado.addEventListener('click', () => {
                this.buscarEmpleado();
            });
        }
        
        // Evento para búsqueda automática al escribir en el campo de empresa
        const inputEmpresa = document.getElementById(this.config.empresas.inputId);
        if (inputEmpresa) {
            inputEmpresa.addEventListener('input', (e) => {
                this.buscarEmpresaPorTexto(e.target.value);
            });
        }
    },
    
    // Buscar empresa por texto (búsqueda automática)
    buscarEmpresaPorTexto: function(texto) {
        if (!texto || texto.length < 2) {
            this.limpiarCamposEmpresa();
            return;
        }
        
        const empresaEncontrada = this.empresasCache.find(empresa => {
            const razonSocial = (empresa.razonsocial || empresa.razon_social || '').toLowerCase();
            return razonSocial.includes(texto.toLowerCase());
        });
        
        if (empresaEncontrada) {
            this.mostrarDatosEmpresa(empresaEncontrada);
        } else {
            this.limpiarCamposEmpresa();
        }
    },
    
    // Buscar empresa (botón buscar)
    buscarEmpresa: function() {
        const inputEmpresa = document.getElementById(this.config.empresas.inputId);
        const texto = inputEmpresa.value.trim();
        
        if (!texto) {
            mostrarAlertaError('Por favor ingrese una razón social', 'Campo requerido');
            return;
        }
        
        // Buscar en el cache local primero
        const empresaEncontrada = this.empresasCache.find(empresa => {
            const razonSocial = (empresa.razonsocial || empresa.razon_social || '').toLowerCase();
            return razonSocial === texto.toLowerCase();
        });
        
        if (empresaEncontrada) {
            this.mostrarDatosEmpresa(empresaEncontrada);
            mostrarAlertaExito('Empresa encontrada', 'Búsqueda exitosa');
        } else {
            mostrarAlertaError('Empresa no encontrada', 'No se encontraron resultados');
            this.limpiarCamposEmpresa();
        }
    },
    
    // Mostrar datos de la empresa en los campos
    mostrarDatosEmpresa: function(empresa) {
        // Actualizar campos de visualización
        this.config.empresas.campos.forEach(campo => {
            const elemento = document.getElementById(campo.id);
            const valor = empresa[campo.apiField] || '';
            
            if (elemento) {
                if (elemento.tagName === 'P') {
                    elemento.textContent = valor;
                } else {
                    elemento.value = valor;
                }
            }
        });
        
        // Actualizar campo hidden del ID de empresa
        const empresaIdField = document.getElementById(this.config.empresas.empresaIdField);
        if (empresaIdField) {
            empresaIdField.value = empresa.id || empresa.empresa_id || '';
        }
        
        // Sincronizar campos hidden
        this.sincronizarCamposHidden();
    },
    
    // Limpiar campos de empresa
    limpiarCamposEmpresa: function() {
        this.config.empresas.campos.forEach(campo => {
            const elemento = document.getElementById(campo.id);
            if (elemento) {
                if (elemento.tagName === 'P') {
                    elemento.textContent = '';
                } else {
                    elemento.value = '';
                }
            }
        });
        
        // Limpiar campo hidden del ID
        const empresaIdField = document.getElementById(this.config.empresas.empresaIdField);
        if (empresaIdField) {
            empresaIdField.value = '';
        }
        
        // Sincronizar campos hidden
        this.sincronizarCamposHidden();
    },
    
    // Buscar empleado por DNI
    buscarEmpleado: function() {
        const dni = document.getElementById(this.config.empleados.dniId).value.trim();
        
        if (!dni) {
            mostrarAlertaError('Por favor ingrese un DNI', 'Campo requerido');
            return;
        }
        
        // Mostrar alerta de carga
        mostrarAlertaCarga('Buscando empleado...');
        
        fetch(`/pacientes/get_by_dni/${dni}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                cerrarAlertaCarga();
                
                if (data && data.id) {
                    this.mostrarDatosEmpleado(data);
                    mostrarAlertaExito('Empleado encontrado', 'Búsqueda exitosa');
                } else {
                    mostrarAlertaError('Empleado no encontrado', 'No se encontraron resultados');
                    this.limpiarCamposEmpleado();
                }
            })
            .catch(error => {
                cerrarAlertaCarga();
                console.error('Error al buscar empleado:', error);
                mostrarAlertaError('Error al buscar empleado', 'Error de conexión');
                this.limpiarCamposEmpleado();
            });
    },
    
    // Mostrar datos del empleado en los campos
    mostrarDatosEmpleado: function(empleado) {
        // Actualizar campos de visualización
        this.config.empleados.campos.forEach(campo => {
            const elemento = document.getElementById(campo.id);
            const valor = empleado[campo.apiField] || '';
            
            if (elemento) {
                if (elemento.tagName === 'P') {
                    elemento.textContent = valor;
                } else {
                    elemento.value = valor;
                }
            }
        });
        
        // Actualizar campo hidden del ID de paciente
        const pacienteIdField = document.getElementById(this.config.empleados.pacienteIdField);
        if (pacienteIdField) {
            pacienteIdField.value = empleado.id || empleado.paciente_id || '';
        }
        
        // Sincronizar campos hidden
        this.sincronizarCamposHidden();
    },
    
    // Limpiar campos de empleado
    limpiarCamposEmpleado: function() {
        this.config.empleados.campos.forEach(campo => {
            const elemento = document.getElementById(campo.id);
            if (elemento) {
                if (elemento.tagName === 'P') {
                    elemento.textContent = '';
                } else {
                    elemento.value = '';
                }
            }
        });
        
        // Limpiar campo hidden del ID
        const pacienteIdField = document.getElementById(this.config.empleados.pacienteIdField);
        if (pacienteIdField) {
            pacienteIdField.value = '';
        }
        
        // Sincronizar campos hidden
        this.sincronizarCamposHidden();
    },
    
    // Sincronizar campos hidden con los campos de visualización
    sincronizarCamposHidden: function() {
        // Sincronizar campos de empresa
        this.config.empresas.campos.forEach(campo => {
            const elementoVisual = document.getElementById(campo.id);
            const elementoHidden = document.querySelector(`input[name="${campo.id}"]`);
            
            if (elementoVisual && elementoHidden) {
                if (elementoVisual.tagName === 'P') {
                    elementoHidden.value = elementoVisual.textContent.trim();
                } else {
                    elementoHidden.value = elementoVisual.value;
                }
            }
        });
        
        // Sincronizar campos de empleado
        this.config.empleados.campos.forEach(campo => {
            const elementoVisual = document.getElementById(campo.id);
            const elementoHidden = document.querySelector(`input[name="${campo.id}"]`);
            
            if (elementoVisual && elementoHidden) {
                if (elementoVisual.tagName === 'P') {
                    elementoHidden.value = elementoVisual.textContent.trim();
                } else {
                    elementoHidden.value = elementoVisual.value;
                }
            }
        });
    }
}; 
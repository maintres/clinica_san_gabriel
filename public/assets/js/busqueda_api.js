/**
 * ARCHIVO DE FUNCIONES DE BÚSQUEDA Y API
 * Contiene todas las funciones duplicadas de los formularios
 * para centralizar la lógica de búsqueda y comunicación con APIs
 */

// ========================================
// CONFIGURACIÓN DE API
// ========================================
const API_CONFIG = {
    BASE_URL: 'https://preocupacionales.sangabrielsj.com',
    TOKEN: 'FynqAq1RCNxyrVo2xTrHvaA5Px1fLRtD9fEaVueXg0YiEzUpJIovj3xzI2EnLHLMKSdZJFSMa1AXq4Vs12EXCknXweeXLJrqh8PW',
    ENDPOINTS: {
        EMPRESAS: '/api/empresas/get_all',
        PACIENTES: '/api/pacientes/get_by_dni',
        ACCIDENTES: '/api/accidentologia/accidente',
        AUSENTISMO: '/api/ausentismo/registrar'
    }
};

// ========================================
// FUNCIONES DE CÁLCULO
// ========================================

/**
 * Calcula la antigüedad laboral basada en la fecha de ingreso
 * @param {string} fechaIngreso - Fecha de ingreso en formato YYYY-MM-DD
 * @param {string} elementId - ID del elemento donde mostrar el resultado (opcional)
 * @returns {object} Objeto con antigüedad formateada y valores numéricos
 */
function calcularAntiguedad(fechaIngreso = null, elementId = 'antiguedad') {
    const fecha = fechaIngreso || document.getElementById('fecha_ingreso').value;
    
    if (!fecha) {
        return {
            texto: '',
            años: 0,
            meses: 0,
            textoCompleto: ''
        };
    }

    const fechaIngresoDate = new Date(fecha);
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
    
    // Actualizar el campo si existe
    const element = document.getElementById(elementId);
    if (element) {
        element.value = resultado;
    }
    
    return {
        texto: resultado,
        años: años,
        meses: meses,
        textoCompleto: resultado
    };
}

// ========================================
// FUNCIONES DE EMPRESAS
// ========================================

// Variables globales para el sistema de empresas
let todasLasEmpresas = [];
let empresasFiltradas = [];

/**
 * Carga todas las empresas desde la API
 */
function cargarEmpresas() {
    
    fetch(API_CONFIG.BASE_URL + API_CONFIG.ENDPOINTS.EMPRESAS, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + API_CONFIG.TOKEN
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status} ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        // Verificar si la respuesta tiene la estructura esperada: {data: {listado: [...]}}
        if (data && data.data && data.data.listado && Array.isArray(data.data.listado)) {
            todasLasEmpresas = data.data.listado;
            actualizarDatalistEmpresas(todasLasEmpresas);
        } else if (data && data.data && Array.isArray(data.data)) {
            // Formato alternativo: {data: [...]}
            todasLasEmpresas = data.data;
            actualizarDatalistEmpresas(todasLasEmpresas);
        } else if (data && Array.isArray(data)) {
            // Formato directo: [...]
            todasLasEmpresas = data;
            actualizarDatalistEmpresas(todasLasEmpresas);
        } else {
            console.error('Formato de respuesta inválido:', data);
            mostrarAlertaError('Error al cargar empresas: formato de respuesta inválido', 'Error de formato');
        }
    })
    .catch(error => {
        console.error('Error al cargar empresas:', error);
        mostrarAlertaError('Error al cargar la lista de empresas', 'Error de conexión');
    });
}

/**
 * Actualiza la lista de empresas mostrándola como un dropdown personalizado
 * @param {Array} empresas - Array de empresas a mostrar
 */
function actualizarDatalistEmpresas(empresas) {
    // Remover dropdown anterior si existe
    const dropdownAnterior = document.getElementById('empresas-dropdown');
    if (dropdownAnterior) {
        dropdownAnterior.remove();
    }
    
    const input = document.getElementById('razon_social_buscar');
    if (!input) {
        console.error('No se encontró el input de búsqueda de empresas');
        return;
    }
    
    // Crear contenedor del dropdown
    const dropdownContainer = document.createElement('div');
    dropdownContainer.id = 'empresas-dropdown';
    dropdownContainer.className = 'position-absolute top-100 start-0 end-0 bg-dark border border-secondary border-top-0 rounded-bottom';
    dropdownContainer.style.cssText = `
        max-height: 400px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
    `;
    
    // Crear lista de opciones
    const ul = document.createElement('ul');
    ul.className = 'list-unstyled mb-0';
    
    if (empresas.length === 0) {
        const li = document.createElement('li');
        li.className = 'px-4 py-3 text-muted fst-italic';
        li.textContent = 'No se encontraron empresas';
        ul.appendChild(li);
    } else {
        empresas.forEach(empresa => {
            const li = document.createElement('li');
            li.className = 'px-4 py-3 border-bottom border-secondary border-opacity-25 text-white';
            li.style.cursor = 'pointer';
            
            const razonSocial = empresa.razonsocial || empresa.razon_social || '';
            const cuit = empresa.cuit || '';
            const domicilio = empresa.domicilio || '';
            
            // Crear texto descriptivo con información adicional
            let textoCompleto = razonSocial;
            if (cuit) {
                textoCompleto += ` (CUIT: ${cuit})`;
            }
            if (domicilio) {
                textoCompleto += ` - ${domicilio}`;
            }
            
            li.textContent = textoCompleto;
            li.setAttribute('data-razon-social', razonSocial);
            li.setAttribute('data-cuit', cuit);
            li.setAttribute('data-domicilio', domicilio);
            li.setAttribute('data-id', empresa.id || empresa.empresa_id || '');
            
            // Eventos del mouse
            li.addEventListener('mouseenter', function() {
                this.classList.remove('text-white');
                this.classList.add('bg-secondary', 'text-white');
            });
            
            li.addEventListener('mouseleave', function() {
                this.classList.remove('bg-secondary');
                this.classList.add('text-white');
            });
            
            // Evento de clic para seleccionar
            li.addEventListener('click', function() {
                const empresaSeleccionada = {
                    razonsocial: this.getAttribute('data-razon-social'),
                    cuit: this.getAttribute('data-cuit'),
                    domicilio: this.getAttribute('data-domicilio'),
                    id: this.getAttribute('data-id')
                };
                
                input.value = empresaSeleccionada.razonsocial;
                mostrarDatosEmpresa(empresaSeleccionada);
                ocultarDropdownEmpresas();
            });
            
            ul.appendChild(li);
        });
    }
    
    dropdownContainer.appendChild(ul);
    
    // Insertar el dropdown después del input
    const inputContainer = input.closest('.input-group');
    if (inputContainer) {
        inputContainer.style.position = 'relative';
        inputContainer.appendChild(dropdownContainer);
    } else {
        input.parentNode.style.position = 'relative';
        input.parentNode.appendChild(dropdownContainer);
    }
    

}

/**
 * Muestra el dropdown de empresas
 */
function mostrarDropdownEmpresas() {
    const dropdown = document.getElementById('empresas-dropdown');
    if (dropdown) {
        dropdown.style.display = 'block';
    }
}

/**
 * Oculta el dropdown de empresas
 */
function ocultarDropdownEmpresas() {
    const dropdown = document.getElementById('empresas-dropdown');
    if (dropdown) {
        dropdown.style.display = 'none';
    }
}

/**
 * Filtra empresas según el texto ingresado
 * @param {string} texto - Texto para filtrar
 */
function filtrarEmpresas(texto) {
    if (!texto || texto.length < 2) {
        empresasFiltradas = todasLasEmpresas;
        actualizarDatalistEmpresas(todasLasEmpresas);
        mostrarDropdownEmpresas();
        return;
    }
    
    const textoLower = texto.toLowerCase();
    empresasFiltradas = todasLasEmpresas.filter(empresa => {
        const razonSocial = (empresa.razonsocial || empresa.razon_social || '').toLowerCase();
        const cuit = (empresa.cuit || '').toLowerCase();
        const domicilio = (empresa.domicilio || '').toLowerCase();
        
        return razonSocial.includes(textoLower) || 
               cuit.includes(textoLower) || 
               domicilio.includes(textoLower);
    });
    
    actualizarDatalistEmpresas(empresasFiltradas);
    mostrarDropdownEmpresas();
}

/**
 * Busca una empresa específica
 */
function buscarEmpresaEspecifica() {
    const input = document.getElementById('razon_social_buscar');
    const texto = input.value.trim();
    
    if (!texto) {
        mostrarAlertaError('Por favor ingrese una razón social', 'Campo requerido');
        return;
    }
    
    // Buscar en todas las empresas de forma flexible
    const empresaEncontrada = todasLasEmpresas.find(empresa => {
        const razonSocial = (empresa.razonsocial || empresa.razon_social || '').toLowerCase();
        const cuit = (empresa.cuit || '').toLowerCase();
        const domicilio = (empresa.domicilio || '').toLowerCase();
        const textoLower = texto.toLowerCase();
        
        // Buscar en razón social, CUIT o domicilio
        return razonSocial.includes(textoLower) || 
               cuit.includes(textoLower) || 
               domicilio.includes(textoLower);
    });
    
    if (empresaEncontrada) {
        mostrarDatosEmpresa(empresaEncontrada);
        //mostrarAlertaExito('Empresa encontrada', 'Búsqueda exitosa');
    } else {
        mostrarAlertaError('Empresa no encontrada', 'No se encontraron resultados');
        limpiarDatosEmpresa();
    }
}

/**
 * Muestra los datos de una empresa en el formulario
 * @param {object} empresa - Objeto con datos de la empresa
 */
function mostrarDatosEmpresa(empresa) {
    // Actualizar campos de visualización
    document.getElementById('razon_social').textContent = empresa.razonsocial || empresa.razon_social || '';
    document.getElementById('domicilio_empresa').textContent = empresa.domicilio || '';
    
    // Actualizar campos hidden
    document.querySelector('input[name="razon_social"]').value = empresa.razonsocial || empresa.razon_social || '';
    document.querySelector('input[name="domicilio_empresa"]').value = empresa.domicilio || '';
    document.getElementById('empresa_id_hidden').value = empresa.id || empresa.empresa_id || '';
}

/**
 * Limpia los datos de empresa del formulario
 */
function limpiarDatosEmpresa() {
    document.getElementById('razon_social').textContent = '';
    document.getElementById('domicilio_empresa').textContent = '';
    
    document.querySelector('input[name="razon_social"]').value = '';
    document.querySelector('input[name="domicilio_empresa"]').value = '';
    document.getElementById('empresa_id_hidden').value = '';
}

// ========================================
// FUNCIONES DE EMPLEADOS
// ========================================

/**
 * Busca un empleado por DNI
 */
function buscarEmpleado() {
    const dni = document.getElementById('dni').value.trim();
    
    if (!dni) {
        mostrarAlertaError('Por favor ingrese un DNI', 'Campo requerido');
        return;
    }
    
    // Mostrar alerta de carga
    //mostrarAlertaCarga('Buscando empleado...');
    
    fetch(`${API_CONFIG.BASE_URL}${API_CONFIG.ENDPOINTS.PACIENTES}/${dni}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + API_CONFIG.TOKEN
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status} ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
       // cerrarAlertaCarga();
        console.log('Respuesta completa de empleado:', data);
        console.log('Tipo de data:', typeof data);
        console.log('Tiene data:', data && data.hasOwnProperty('data'));
        console.log('Data tiene listado:', data && data.data && data.data.hasOwnProperty('listado'));
        console.log('Listado es array:', data && data.data && data.data.listado && Array.isArray(data.data.listado));
        
        let empleado = null;
        
        // Verificar si la respuesta tiene la estructura esperada: {data: {listado: [...]}}
        if (data && data.data && data.data.listado && Array.isArray(data.data.listado)) {
            // Tomar el primer empleado de la lista
            empleado = data.data.listado[0];
        } else if (data && data.data && Array.isArray(data.data)) {
            // Formato alternativo: {data: [...]}
            empleado = data.data[0];
        } else if (data && Array.isArray(data)) {
            // Formato directo: [...]
            empleado = data[0];
        } else if (data && data.id) {
            // Formato individual: {id: ..., nombre: ..., ...}
            empleado = data;
        }
        
        if (empleado && empleado.id) {
            mostrarDatosEmpleado(empleado);
           // mostrarAlertaExito('Empleado encontrado', 'Búsqueda exitosa');
        } else {
            mostrarAlertaError('Empleado no encontrado', 'No se encontraron resultados');
            limpiarDatosEmpleado();
        }
    })
    .catch(error => {
        cerrarAlertaCarga();
        console.error('Error al buscar empleado:', error);
        mostrarAlertaError('Error al buscar empleado', 'Error de conexión');
        limpiarDatosEmpleado();
    });
}

/**
 * Muestra los datos de un empleado en el formulario
 * @param {object} empleado - Objeto con datos del empleado
 */
function mostrarDatosEmpleado(empleado) {
    // Actualizar campos de visualización
    document.getElementById('nombre').textContent = empleado.nombres || empleado.nombre || '';
    document.getElementById('apellido').textContent = empleado.apellidos || empleado.apellido || '';
    document.getElementById('telefono').textContent = empleado.telefono || '';
    document.getElementById('celular').textContent = empleado.celular || '';
    document.getElementById('domicilio_empleado').textContent = empleado.domicilio || '';
    
    // Actualizar campos hidden
    document.querySelector('input[name="nombre"]').value = empleado.nombres || empleado.nombre || '';
    document.querySelector('input[name="apellido"]').value = empleado.apellidos || empleado.apellido || '';
    document.querySelector('input[name="telefono"]').value = empleado.telefono || '';
    document.querySelector('input[name="celular"]').value = empleado.celular || '';
    document.querySelector('input[name="domicilio_empleado"]').value = empleado.domicilio || '';
    document.getElementById('paciente_id_hidden').value = empleado.id || empleado.paciente_id || '';
}

/**
 * Limpia los datos del empleado del formulario
 */
function limpiarDatosEmpleado() {
    document.getElementById('nombre').textContent = '';
    document.getElementById('apellido').textContent = '';
    document.getElementById('telefono').textContent = '';
    document.getElementById('celular').textContent = '';
    document.getElementById('domicilio_empleado').textContent = '';
    
    document.querySelector('input[name="nombre"]').value = '';
    document.querySelector('input[name="apellido"]').value = '';
    document.querySelector('input[name="telefono"]').value = '';
    document.querySelector('input[name="celular"]').value = '';
    document.querySelector('input[name="domicilio_empleado"]').value = '';
    document.getElementById('paciente_id_hidden').value = '';
}



// ========================================
// FUNCIONES DE INICIALIZACIÓN
// ========================================

/**
 * Configura todos los eventos necesarios para el sistema de búsqueda
 */
function inicializarSistemaBusqueda() {
    // Cargar empresas al inicializar
    cargarEmpresas();
    
    // Evento para filtrado automático al escribir
    const inputEmpresa = document.getElementById('razon_social_buscar');
    if (inputEmpresa) {
        inputEmpresa.addEventListener('input', function(e) {
            filtrarEmpresas(e.target.value);
        });
        
        // Evento para mostrar dropdown al hacer focus
        inputEmpresa.addEventListener('focus', function() {
            if (todasLasEmpresas && todasLasEmpresas.length > 0) {
                actualizarDatalistEmpresas(todasLasEmpresas);
                mostrarDropdownEmpresas();
            }
        });
        
        // Evento para ocultar dropdown al hacer blur (con delay para permitir clic)
        inputEmpresa.addEventListener('blur', function() {
            setTimeout(() => {
                ocultarDropdownEmpresas();
            }, 200);
        });
    }
    
    // Evento para búsqueda específica con botón
    const btnBuscarEmpresa = document.getElementById('btnBuscarEmpresa');
    if (btnBuscarEmpresa) {
        btnBuscarEmpresa.addEventListener('click', buscarEmpresaEspecifica);
    }
    
    // Evento para búsqueda de empleado
    const btnBuscarEmpleado = document.getElementById('btnBuscarEmpleado');
    if (btnBuscarEmpleado) {
        btnBuscarEmpleado.addEventListener('click', buscarEmpleado);
    }
    
    // Evento para cálculo automático de antigüedad
    const fechaIngreso = document.getElementById('fecha_ingreso');
    if (fechaIngreso) {
        fechaIngreso.addEventListener('change', function() {
            calcularAntiguedad();
        });
    }
    
    // Evento global para cerrar dropdown al hacer clic fuera
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('empresas-dropdown');
        const input = document.getElementById('razon_social_buscar');
        
        if (dropdown && input && !input.contains(e.target) && !dropdown.contains(e.target)) {
            ocultarDropdownEmpresas();
        }
    });
}

// ========================================
// EXPORTACIÓN DE FUNCIONES (para uso modular)
// ========================================

// Si se está usando en un entorno que soporta módulos ES6
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        API_CONFIG,
        calcularAntiguedad,
        cargarEmpresas,
        actualizarDatalistEmpresas,
        filtrarEmpresas,
        buscarEmpresaEspecifica,
        mostrarDatosEmpresa,
        limpiarDatosEmpresa,
        buscarEmpleado,
        mostrarDatosEmpleado,
        limpiarDatosEmpleado,
        probarAPI,
        inicializarSistemaBusqueda
    };
} 
// Funciones de alerta usando SweetAlert2
// Asegúrate de incluir SweetAlert2 en tu HTML: <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

/**
 * Muestra una alerta de éxito
 * @param {string} mensaje - Mensaje a mostrar
 * @param {string} titulo - Título de la alerta (opcional)
 * @param {boolean} recargar - Si debe recargar la página después (opcional)
 */
function mostrarAlertaExito(mensaje = 'Registro guardado correctamente', titulo = '¡Éxito!', recargar = false) {
    Swal.fire({
        icon: 'success',
        title: titulo,
        text: mensaje,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#28a745',
        timer: 2000,
        timerProgressBar: true
    }).then((result) => {
        // Si se hace clic en "Aceptar" o se cumple el timer y recargar es true
        if (recargar) {
            window.location.reload();
        }
    });
}

/**
 * Muestra una alerta de error
 * @param {string} mensaje - Mensaje de error a mostrar
 * @param {string} titulo - Título de la alerta (opcional)
 */
function mostrarAlertaError(mensaje = 'Ha ocurrido un error', titulo = 'Error') {
    Swal.fire({
        icon: 'error',
        title: titulo,
        text: mensaje,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#dc3545',
        timer: 2000,
        timerProgressBar: true
    });
}

/**
 * Muestra una alerta de información
 * @param {string} mensaje - Mensaje a mostrar
 * @param {string} titulo - Título de la alerta (opcional)
 */
function mostrarAlertaInfo(mensaje, titulo = 'Información') {
    Swal.fire({
        icon: 'info',
        title: titulo,
        text: mensaje,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#17a2b8',
        timer: 2000,
        timerProgressBar: true
    });
}

/**
 * Muestra una alerta de confirmación
 * @param {string} mensaje - Mensaje a mostrar
 * @param {string} titulo - Título de la alerta (opcional)
 * @param {Function} onConfirm - Función a ejecutar si se confirma
 */
function mostrarAlertaConfirmacion(mensaje = '¿Estás seguro de realizar esta acción?', titulo = 'Confirmar', onConfirm) {
    Swal.fire({
        icon: 'question',
        title: titulo,
        text: mensaje,
        showCancelButton: true,
        confirmButtonText: 'Sí, continuar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        timer: 2000,
        timerProgressBar: true
    }).then((result) => {
        if (result.isConfirmed && onConfirm) {
            onConfirm();
        }
    });
}

/**
 * Muestra una alerta de carga
 * @param {string} mensaje - Mensaje a mostrar
 */
function mostrarAlertaCarga(mensaje = 'Procesando...') {
    Swal.fire({
        title: mensaje,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

/**
 * Cierra la alerta de carga
 */
function cerrarAlertaCarga() {
    Swal.close();
}

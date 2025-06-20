# Clínica San Gabriel - Sistema de Gestión de Accidentes y Ausentismo

## Descripción del Proyecto

Sistema web para la gestión de accidentes laborales y control de ausentismo de la Clínica San Gabriel. El proyecto incluye dos formularios principales que generan datos en formato JSON para su posterior procesamiento y almacenamiento en base de datos. Los formularios integran APIs externas para obtener información de empresas y empleados de forma dinámica.

## Estructura del Proyecto

```
clinica_san_gabriel/
├── form_accidente_laboral.php      # Formulario de accidentes laborales
├── form_control_ausentismo.php     # Formulario de control de ausentismo
├── partes_cuerpo.php               # Componente SVG para selección de partes del cuerpo
├── svg-cuerpo.svg                  # Archivo SVG del cuerpo humano
├── header.php                      # Header común de la aplicación
├── footer.php                      # Footer común de la aplicación
├── index.php                       # Página principal con navegación
├── busqueda_api.js                 # Funciones para búsqueda de empresas y empleados
├── alertas.js                      # Sistema de alertas y notificaciones
├── ejemplo_accidente_laboral.json  # Ejemplo de JSON generado por accidente laboral
├── ejemplo_control_ausentismo.json # Ejemplo de JSON generado por control de ausentismo
└── README.md                       # Este archivo
```

## Formularios Disponibles

### 1. Formulario de Accidente Laboral (`form_accidente_laboral.php`)

**Propósito**: Registro de accidentes laborales con información detallada del empleado, empresa y circunstancias del accidente.

**Características principales**:
- **Búsqueda dinámica** de empresas y empleados mediante APIs
- Cálculo automático de antigüedad basado en fecha de ingreso
- Selección de partes del cuerpo afectadas mediante SVG interactivo
- Generación automática de JSON con todos los datos del formulario
- Validación de campos obligatorios
- Sistema de alertas con SweetAlert2

**Campos principales**:
- **Empresa**: Búsqueda por razón social, datos obtenidos desde API
- **Empleado**: Búsqueda por DNI, datos personales obtenidos desde API
- **Información laboral**: Puesto, área, fecha de ingreso, antigüedad calculada
- **Obra social**: Plan, número de afiliado
- **Accidente**: Tipo, agente causal, testigos, descripción
- **Lesión**: Tipo, gravedad, partes afectadas, diagnóstico
- **Médico**: Datos del médico tratante, matrícula, observaciones

### 2. Formulario de Control de Ausentismo (`form_control_ausentismo.php`)

**Propósito**: Control y seguimiento de licencias médicas y ausentismo laboral.

**Características principales**:
- **Búsqueda dinámica** de empresas y empleados mediante APIs
- Cálculo automático de días de ausentismo
- Cálculo automático de antigüedad
- Determinación automática del día de la semana del inicio de certificado
- Selección de partes del cuerpo afectadas
- Generación automática de JSON
- Sistema de alertas con SweetAlert2

**Campos principales**:
- **Empresa y Empleado**: Datos obtenidos desde APIs externas
- **Información laboral**: Puesto, área, antigüedad calculada
- **Obra social**: Plan, número de afiliado
- **Licencia**: Tipo, agente causal, diagnóstico, tratamiento
- **Certificado**: Fechas de inicio y vencimiento, días calculados automáticamente
- **Control**: Resultado del control médico, aptitud para reingreso
- **ART**: Información de denuncia y seguimiento

## Integración con APIs

### Búsqueda de Empresas

El sistema integra APIs externas para obtener información de empresas:

- **Búsqueda por razón social** con autocompletado
- **Datos obtenidos**: Razón social, domicilio, ID de empresa
- **Validación** de datos antes de mostrar
- **Almacenamiento** del ID de empresa en el JSON final

### Búsqueda de Empleados

Sistema de búsqueda de empleados por DNI:

- **Búsqueda por DNI** con validación
- **Datos obtenidos**: Nombre, apellido, teléfono, celular, domicilio
- **Validación** de datos antes de mostrar
- **Almacenamiento** del ID de paciente en el JSON final

### Archivo `busqueda_api.js`

Contiene todas las funciones para la integración con APIs:

```javascript
// Configuración para búsquedas
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
```

## Funcionalidades Técnicas

### Cálculo Automático de Antigüedad

Ambos formularios incluyen un sistema de cálculo automático de antigüedad que:

- **Calcula** años y meses exactos desde la fecha de ingreso hasta la fecha actual
- **Muestra** el resultado en formato legible (ej: "3 años, 8 meses")
- **Incluye** en el JSON tanto el formato legible como los valores numéricos separados
- **Actualiza** automáticamente cuando se cambia la fecha de ingreso

```javascript
// Ejemplo de cálculo
antiguedad_calculada: "3 años, 8 meses"
antiguedad_anios: 3
antiguedad_meses: 8
```

### Selección de Partes del Cuerpo

Sistema interactivo que permite:

- **Seleccionar** partes del cuerpo en un SVG del cuerpo humano
- **Visualizar** las partes seleccionadas con colores
- **Incluir** las partes seleccionadas como array en el JSON
- **Nombres legibles** para cada parte del cuerpo

```javascript
// Ejemplo de partes seleccionadas
partes_afectadas: ["brazo_derecho", "mano_derecha"]
```

### Generación Automática de JSON

Cada formulario genera automáticamente un JSON completo que incluye:

- **IDs de referencia** para empresa y empleado (obtenidos desde APIs)
- **Todos los campos** del formulario
- **Cálculos automáticos** (antigüedad, días de ausentismo, etc.)
- **Datos estructurados** para fácil procesamiento
- **Timestamp** de registro
- **Arrays** para datos múltiples (partes del cuerpo)

### Cálculo de Días de Ausentismo

El formulario de control de ausentismo incluye:

- **Cálculo automático** de días entre fechas de certificado
- **Determinación** del día de la semana del inicio
- **Validación** de fechas
- **Inclusión** en el JSON para procesamiento

### Sistema de Alertas

Implementado con SweetAlert2 para:

- **Alertas de carga** durante el envío de formularios
- **Mensajes de éxito** con redirección opcional
- **Mensajes de error** descriptivos
- **Confirmaciones** para acciones importantes

## Estructura de Datos JSON

### Formulario de Accidente Laboral

```json
{
  "empresa_id": "123",
  "paciente_id": "456",
  "puesto": "Operario",
  "area": "Producción",
  "fecha_ingreso": "2020-03-15",
  "antiguedad": "3 años, 8 meses",
  "antiguedad_calculada": "3 años, 8 meses",
  "antiguedad_anios": 3,
  "antiguedad_meses": 8,
  "obra_social": "OSDE",
  "plan": "310",
  "nro_afiliado": "123456789",
  "tipo_accidente": "Caída de altura",
  "agente_causal": "Máquina",
  "testigos": "María González, Carlos López",
  "partes_afectadas": ["brazo_derecho", "mano_derecha"],
  "descripcion": "Descripción detallada del accidente...",
  "tipo_lesion": "Fractura",
  "gravedad": "Moderado",
  "derivacion": "ART",
  "intervencion_art": "Si",
  "dias_baja": 15,
  "diagnostico": "Fractura de radio distal derecho",
  "prox_ctrl": "2024-01-15",
  "medico_inicial": "Dr. Roberto Martínez",
  "matricula": "MP-12345",
  "observaciones": "Observaciones adicionales...",
  "fecha_registro": "2024-01-02T10:30:00.000Z"
}
```

### Formulario de Control de Ausentismo

```json
{
  "empresa_id": "456",
  "paciente_id": "789",
  "puesto": "Supervisor",
  "area": "Calidad",
  "fecha_ingreso": "2019-06-10",
  "antiguedad": "4 años, 6 meses",
  "antiguedad_calculada": "4 años, 6 meses",
  "antiguedad_anios": 4,
  "antiguedad_meses": 6,
  "obra_social": "Swiss Medical",
  "plan": "Premium",
  "nro_afiliado": "987654321",
  "tipo_licencia": "ART",
  "agente_causal": "Herramienta",
  "diagnostico": "Lumbalgia aguda por sobreesfuerzo",
  "partes_afectadas": ["espalda_baja", "columna_lumbar"],
  "tratamiento": "Reposo relativo, antiinflamatorios...",
  "aseguradora_art": "Si",
  "inicio_certificado": "2024-01-05",
  "vto_certificado": "2024-01-20",
  "dias_ausentismo": 16,
  "dia_inicio_cert": "Viernes",
  "med_tratante": "Dr. Carlos Fernández",
  "matricula": "MP-54321",
  "especialidad": "Traumatólogo",
  "nro_denuncia_art": "ART-2024-001234",
  "tipo_denuncia_art": "Accidente de trabajo",
  "fecha_control": "2024-01-18",
  "med_auditor": "Dr. Laura Morales",
  "resultado": "Convalidado",
  "requiere_reubicacion": "No",
  "apto_reingreso": "2024-01-21",
  "alta_reingreso": "2024-01-21",
  "dias_ausentismo_control": 16,
  "observaciones": "El paciente presenta buena evolución...",
  "fecha_registro": "2024-01-18T14:45:00.000Z"
}
```

## Tecnologías Utilizadas

- **Frontend**: HTML5, CSS3, JavaScript (ES6+), Bootstrap 5
- **Backend**: PHP 7.4+
- **APIs**: Integración con APIs externas para empresas y empleados
- **Interactividad**: Vue.js (para selección de partes del cuerpo)
- **Alertas**: SweetAlert2 para notificaciones
- **Formato de Datos**: JSON
- **Servidor Web**: Apache (XAMPP)

## Instalación y Configuración

### Requisitos Previos

- XAMPP o servidor web con PHP 7.4+
- Navegador web moderno
- Acceso a APIs externas para empresas y empleados

### Pasos de Instalación

1. **Clonar/Descargar** el proyecto en la carpeta `htdocs` de XAMPP
2. **Configurar** las URLs de las APIs en `busqueda_api.js`
3. **Acceder** a `http://localhost/clinica_san_gabriel/`
4. **Verificar** que todos los archivos estén en su lugar

### Configuración de APIs

Editar `busqueda_api.js` con las URLs de las APIs:

```javascript
// URLs de las APIs (configurar según el entorno)
const API_BASE_URL = 'https://api.ejemplo.com';
const API_EMPRESAS = `${API_BASE_URL}/empresas`;
const API_EMPLEADOS = `${API_BASE_URL}/empleados`;
```

## Uso del Sistema

### Formulario de Accidente Laboral

1. **Acceder** a `form_accidente_laboral.php`
2. **Buscar empresa** ingresando razón social y haciendo clic en "Buscar"
3. **Buscar empleado** ingresando DNI y haciendo clic en "Buscar"
4. **Completar** información laboral (puesto, área, fecha de ingreso)
5. **Seleccionar** fecha de ingreso (se calcula automáticamente la antigüedad)
6. **Completar** información del accidente
7. **Seleccionar** partes del cuerpo afectadas en el SVG
8. **Agregar** descripción y datos médicos
9. **Enviar** el formulario (se genera JSON automáticamente)

### Formulario de Control de Ausentismo

1. **Acceder** a `form_control_ausentismo.php`
2. **Buscar empresa y empleado** usando las funciones de búsqueda
3. **Completar** información laboral
4. **Ingresar** información de la licencia
5. **Seleccionar** fechas de certificado (se calculan días automáticamente)
6. **Completar** datos del control médico
7. **Enviar** el formulario (se genera JSON automáticamente)

## Características Técnicas Avanzadas

### Validación de Formularios

- **Validación del lado cliente** con JavaScript
- **Campos obligatorios** marcados visualmente
- **Validación de fechas** y formatos
- **Prevención de envío** con datos incompletos
- **Validación de datos** obtenidos desde APIs

### Responsive Design

- **Diseño adaptable** para dispositivos móviles
- **Bootstrap 5** para layout responsive
- **Componentes** que se adaptan a diferentes tamaños de pantalla

### Interactividad SVG

- **Selección visual** de partes del cuerpo
- **Feedback visual** inmediato
- **Datos estructurados** en formato array
- **Nombres legibles** para cada parte

### Cálculos Automáticos

- **Antigüedad** en años y meses
- **Días de ausentismo** entre fechas
- **Día de la semana** del inicio de certificado
- **Validación** de fechas lógicas

### Integración con APIs

- **Búsqueda en tiempo real** de empresas y empleados
- **Validación** de datos obtenidos
- **Manejo de errores** de conexión
- **Almacenamiento** de IDs de referencia

## Mantenimiento y Desarrollo

### Estructura Modular

- **Componentes reutilizables** (header, footer, partes_cuerpo)
- **Separación** de lógica y presentación
- **Archivos** organizados por funcionalidad
- **APIs** centralizadas en archivos específicos

### Extensibilidad

- **Fácil agregado** de nuevos campos
- **Sistema modular** para nuevos formularios
- **JSON estructurado** para integración con otros sistemas
- **APIs configurables** para diferentes entornos

### Logs y Depuración

- **Console.log** para verificar datos
- **Validación** de JSON generado
- **Mensajes** de error descriptivos
- **Alertas** informativas para el usuario

## Contacto y Soporte

Para consultas técnicas o soporte, contactar al equipo de desarrollo de la Clínica San Gabriel.

---

**Versión**: 2.0  
**Última actualización**: Enero 2024  
**Desarrollado para**: Clínica San Gabriel 
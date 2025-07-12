# 📋 DOCUMENTACIÓN DEL SISTEMA - CLÍNICA SAN GABRIEL

## 🏥 **Descripción General**

Sistema web para la gestión de **accidentes laborales** y **control de ausentismo** de la Clínica San Gabriel. El sistema permite registrar, gestionar y monitorear incidentes laborales y ausencias de empleados de manera eficiente.

---

## 🛠️ **TECNOLOGÍAS UTILIZADAS**

### **Backend**
- **PHP 7.4+** - Lenguaje de programación principal
- **Flight PHP Framework** - Micro-framework para APIs REST
- **Composer** - Gestor de dependencias de PHP
- **Apache** - Servidor web (configurado con .htaccess)

### **Frontend**
- **HTML5** - Estructura de páginas web
- **CSS3** - Estilos y diseño responsivo
- **JavaScript (ES6+)** - Interactividad del lado cliente
- **Bootstrap 5.3.0** - Framework CSS para diseño responsivo
- **Vue.js 2.6.14** - Framework JavaScript para componentes reactivos
- **FontAwesome 6.0.0** - Iconografía

### **Librerías JavaScript**
- **SweetAlert2** - Alertas y notificaciones modernas
- **Fetch API** - Peticiones HTTP asíncronas

### **APIs Externas**
- **API REST Externa** - Sistema de gestión de datos
  - Autenticación: Bearer Token
  - Endpoints: Pacientes, Empresas, Accidentes, Ausentismo

---

## 🏗️ **ARQUITECTURA DEL SISTEMA**

### **Estructura de Archivos**
```
clinica_san_gabriel/
├── index.php                 # Punto de entrada principal (API + Frontend)
├── header.php               # Header común con dependencias
├── footer.php               # Footer común
├── form_accidente_laboral.php    # Formulario de accidentes
├── form_control_ausentismo.php   # Formulario de ausentismo
├── partes_cuerpo.php        # Componente Vue.js para selección de partes del cuerpo
├── busqueda_api.js          # Sistema centralizado de búsquedas
├── alertas.js               # Sistema de alertas con SweetAlert2
├── style/
│   └── style.css            # Estilos personalizados
├── img/
│   ├── 2.png               # Logo principal
│   ├── 3.png               # Logo secundario
│   └── svg-cuerpo.svg      # SVG del cuerpo humano
├── flight/                  # Framework Flight PHP
├── composer.json            # Configuración de dependencias
├── .htaccess               # Configuración de Apache
└── DOCUMENTACION_SISTEMA.md # Esta documentación
```

---

## 🚀 **FUNCIONALIDADES PRINCIPALES**

### **1. Página Principal (index.php)**
- **Dashboard** con acceso a formularios
- **API REST** para comunicación con sistema externo
- **Endpoints disponibles**:
  - `GET /` - Página principal
  - `GET /pacientes/get_by_dni/{dni}` - Buscar paciente por DNI
  - `GET /empresas/get_all` - Obtener todas las empresas
  - `POST /accidentologia/registrar_accidente` - Registrar accidente
  - `POST /ausentismo/registrar` - Registrar ausentismo

### **2. Formulario de Accidente Laboral**
- **Búsqueda de empresas** con dropdown personalizado
- **Búsqueda de empleados** por DNI
- **Cálculo automático de antigüedad**
- **Selección de partes del cuerpo** (Vue.js + SVG)
- **Campos específicos de accidentes**:
  - Tipo de accidente
  - Agente causal
  - Testigos
  - Tipo de lesión
  - Gravedad
  - Derivación
  - Intervención ART
  - Días de baja
  - Diagnóstico
  - Médico inicial

### **3. Formulario de Control de Ausentismo**
- **Misma funcionalidad de búsqueda** que accidentes
- **Campos específicos de ausentismo**:
  - Tipo de licencia
  - Agente causal
  - Diagnóstico
  - Tratamiento
  - Aseguradora ART
  - Certificados médicos
  - Médico tratante
  - Denuncias ART

### **4. Sistema de Búsqueda Centralizado (busqueda_api.js)**
- **Dropdown personalizado** para empresas
- **Búsqueda en tiempo real**
- **Filtrado por razón social, CUIT y domicilio**
- **Cálculo automático de antigüedad**
- **Integración con API externa**

### **5. Componente de Partes del Cuerpo (partes_cuerpo.php)**
- **SVG interactivo** del cuerpo humano
- **Selección múltiple** de partes afectadas
- **Vue.js** para reactividad
- **Vista frontal y posterior**
- **Lista de partes seleccionadas**

---

## 🔧 **CONFIGURACIÓN Y DEPENDENCIAS**

### **Configuración de API Externa**
```php
define('API_EXTERNA_URL', 'https://tu-api-externa.com/api');
define('API_TOKEN', 'TU_TOKEN_DE_AUTENTICACION');
define('API_TIMEOUT', 30);
```

### **Dependencias Frontend (CDN)**
```html
<!-- Bootstrap 5.3.0 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">

<!-- FontAwesome 6.0.0 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Vue.js 2.6.14 -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
```

### **Requisitos del Sistema**
- **PHP**: 7.4 o superior
- **Apache**: Con mod_rewrite habilitado
- **Extensiones PHP**: json, pdo_sqlite (para desarrollo)
- **Navegador**: Moderno con soporte para ES6+

---

## 🎨 **DISEÑO Y UX**

### **Paleta de Colores**
- **Primario**: `#CC1D7C` (Rosa/Magenta)
- **Secundario**: `#e23189` (Rosa claro)
- **Acentos**: `#97245e` (Rosa oscuro)
- **Fondo**: `#f3f3f2` (Gris claro)

### **Componentes de UI**
- **Cards** con sombras y bordes redondeados
- **Botones** con efectos hover
- **Dropdowns** personalizados con tema oscuro
- **Alertas** modernas con SweetAlert2
- **Formularios** responsivos con Bootstrap

### **Responsividad**
- **Mobile-first** con Bootstrap 5
- **Grid system** adaptativo
- **Componentes** que se ajustan a diferentes pantallas

---

## 🔐 **SEGURIDAD**

### **Autenticación**
- **Bearer Token** para API externa
- **Validación** de datos en frontend y backend
- **Sanitización** de inputs

### **Validaciones**
- **Campos requeridos** en formularios
- **Validación de DNI** y datos de contacto
- **Verificación** de fechas y valores numéricos

---

## 📊 **ESTRUCTURA DE DATOS**

### **Formato de Datos para Accidentes**
```json
{
  "empresa_id": 1,
  "paciente_id": 1,
  "puesto": "Operario",
  "area": "Producción",
  "fecha_ingreso": "2023-01-15",
  "antiguedad": "1 año, 6 meses",
  "obra_social": "OSDE",
  "tipo_accidente": "Caída de altura",
  "agente_causal": "Escalera",
  "partes_afectadas": ["brazo_derecho", "pierna_izquierda"],
  "descripcion": "Descripción del accidente",
  "tipo_lesion": "Fractura",
  "gravedad": "Moderada",
  "derivacion": "Hospital",
  "intervencion_art": true,
  "dias_baja": 15,
  "diagnostico": "Fractura de radio distal",
  "medico_inicial": "Dr. Ejemplo",
  "matricula": "12345",
  "observaciones": "Observaciones adicionales"
}
```

### **Formato de Datos para Ausentismo**
```json
{
  "empresa_id": 1,
  "paciente_id": 1,
  "tipo_licencia": "Justificado",
  "agente_causal": "Máquina",
  "diagnostico": "Esguince de tobillo",
  "tratamiento": "Reposo y fisioterapia",
  "aseguradora_art": "ART Seguros",
  "inicio_certificado": "2024-01-15",
  "vto_certificado": "2024-01-30",
  "cantidad_dias": 15,
  "medico_tratante": "Dr. Ejemplo",
  "matricula": "54321",
  "especialidad": "Traumatología",
  "partes_afectadas": ["tobillo_derecho"]
}
```

---

## 🚀 **INSTALACIÓN Y DESPLIEGUE**

### **Requisitos Previos**
1. Servidor web con PHP 7.4+
2. Apache con mod_rewrite
3. Composer instalado

### **Pasos de Instalación**
1. **Clonar repositorio**:
   ```bash
   git clone [url-del-repositorio]
   cd clinica_san_gabriel
   ```

2. **Instalar dependencias**:
   ```bash
   composer install
   ```

3. **Configurar servidor web**:
   - Apuntar document root al directorio del proyecto
   - Verificar que .htaccess esté habilitado

4. **Configurar API externa**:
   - Editar `index.php` con URL y token correctos
   - Verificar conectividad con API externa

5. **Verificar permisos**:
   ```bash
   chmod 755 -R .
   ```

### **Configuración de Desarrollo**
```bash
# Ejecutar servidor de desarrollo
php -S localhost:8000

# Ejecutar tests (si están configurados)
composer test
```

---

## 🔍 **MANTENIMIENTO Y SOPORTE**

### **Logs y Debugging**
- **Console.log** en JavaScript para debugging
- **Error handling** en PHP con try-catch
- **SweetAlert2** para mostrar errores al usuario

### **Monitoreo**
- **Verificación** de conectividad con API externa
- **Validación** de datos de entrada
- **Alertas** automáticas para errores

### **Actualizaciones**
- **Dependencias** actualizadas vía CDN
- **Framework** Flight PHP actualizable vía Composer
- **Código** modular para fácil mantenimiento

---

## 📈 **ESCALABILIDAD**

### **Arquitectura Modular**
- **Componentes** reutilizables
- **Funciones** centralizadas
- **APIs** bien definidas

### **Posibles Mejoras**
- **Base de datos local** para cache
- **Sistema de usuarios** y roles
- **Reportes** y estadísticas
- **Notificaciones** en tiempo real
- **API REST** completa para integraciones

---

## 📞 **CONTACTO Y SOPORTE**

### **Información del Proyecto**
- **Cliente**: Clínica San Gabriel
- **Desarrollador**: Sistema personalizado
- **Versión**: 1.0
- **Fecha**: 2024
- **Nota**: Esta documentación es confidencial y contiene información técnica del sistema

### **Soporte Técnico**
- **Documentación**: Esta documentación
- **Código**: Comentado y estructurado
- **APIs**: Documentadas en el código

---

*Documentación generada automáticamente - Sistema Clínica San Gabriel* 
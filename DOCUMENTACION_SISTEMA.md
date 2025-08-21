# 📋 DOCUMENTACIÓN DEL SISTEMA - CLÍNICA SAN GABRIEL

## 🏥 **Descripción General**

Sistema web para la gestión de **accidentes laborales** y **control de ausentismo** de la Clínica San Gabriel. El sistema permite registrar, gestionar y monitorear incidentes laborales y ausencias de empleados de manera eficiente, con un sistema completo de autenticación y seguridad.

---

## 🛠️ **TECNOLOGÍAS UTILIZADAS**

### **Backend**
- **PHP 7.4+** - Lenguaje de programación principal
- **Flight PHP Framework** - Micro-framework para APIs REST
- **Composer** - Gestor de dependencias de PHP
- **Apache** - Servidor web (configurado con .htaccess)
- **Sesiones PHP** - Sistema de autenticación y seguridad

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
├── public/
│   ├── index.php              # Dashboard principal (protegido)
│   ├── login.php              # Sistema de autenticación completo
│   ├── api.php                # API REST del sistema
│   ├── assets/
│   │   ├── css/style/style.css
│   │   ├── js/
│   │   │   ├── alertas.js     # Sistema de alertas
│   │   │   └── busqueda_api.js # Búsquedas centralizadas
│   │   └── img/
│   │       ├── 2.png          # Logo principal
│   │       ├── 3.png          # Logo secundario
│   │       └── svg-cuerpo.svg # SVG del cuerpo humano
│   └── login.php              # Página de login con autenticación
├── src/
│   ├── layouts/
│   │   ├── header.php         # Header con verificación de sesión
│   │   └── footer.php         # Footer común
│   ├── form_accidente_laboral.php    # Formulario de accidentes (protegido)
│   ├── form_control_ausentismo.php   # Formulario de ausentismo (protegido)
│   └── partes_cuerpo.php      # Componente Vue.js para selección de partes
├── flight/                    # Framework Flight PHP
├── composer.json              # Configuración de dependencias
├── .htaccess                  # Configuración de Apache
└── DOCUMENTACION_SISTEMA.md   # Esta documentación
```

---

## 🔐 **SISTEMA DE AUTENTICACIÓN Y SEGURIDAD**

### **Características de Seguridad**
- ✅ **Autenticación obligatoria** - Todas las páginas requieren login
- ✅ **Sesiones PHP seguras** - Manejo de sesiones del lado servidor
- ✅ **Headers de seguridad** - Previene cacheo del navegador
- ✅ **Logout completo** - Destruye sesión y cookies
- ✅ **Prevención de navegación atrás** - No se puede volver después del logout
- ✅ **Validación de credenciales** - Verificación en servidor

### **Usuarios del Sistema**
| Usuario | Contraseña | Rol |
|---------|------------|-----|
| `admin` | `admin3842` | Administrador |
| `usuario` | `user444` | Usuario estándar |

### **Flujo de Autenticación**
1. **Acceso inicial** → Redirección automática a login
2. **Validación** → Credenciales verificadas en servidor
3. **Establecimiento de sesión** → Variables de sesión configuradas
4. **Acceso a páginas** → Verificación automática en cada página
5. **Logout** → Destrucción completa de sesión

### **Protección de Páginas**
- **Dashboard** (`public/index.php`) - Requiere autenticación
- **Formulario de Accidentes** (`src/form_accidente_laboral.php`) - Requiere autenticación
- **Formulario de Ausentismo** (`src/form_control_ausentismo.php`) - Requiere autenticación
- **Login** (`public/login.php`) - Acceso público con redirección si ya autenticado

---

## 🚀 **FUNCIONALIDADES PRINCIPALES**

### **1. Sistema de Login (login.php)**
- **Interfaz moderna** con diseño responsivo
- **Validación en tiempo real** de campos
- **Toggle de contraseña** (mostrar/ocultar)
- **Estados de loading** durante autenticación
- **Manejo de errores** con SweetAlert2
- **Procesamiento de sesiones** del lado servidor
- **Logout completo** con destrucción de sesión

### **2. Dashboard Principal (index.php)**
- **Acceso protegido** con verificación de sesión
- **Navegación a formularios** principales
- **Información del usuario** en header
- **Diseño responsivo** con Bootstrap 5

### **3. Header del Sistema (header.php)**
- **Verificación automática** de autenticación
- **Headers de seguridad** para prevenir cacheo
- **Navegación principal** a la izquierda:
  - Accidente Laboral
  - Control Ausentismo
- **Información del usuario** a la derecha:
  - Nombre del usuario logueado
  - Botón de logout

### **4. Formulario de Accidente Laboral**
- **Acceso protegido** con verificación de sesión
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

### **5. Formulario de Control de Ausentismo**
- **Acceso protegido** con verificación de sesión
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

### **6. Sistema de Búsqueda Centralizado (busqueda_api.js)**
- **Dropdown personalizado** para empresas
- **Búsqueda en tiempo real**
- **Filtrado por razón social, CUIT y domicilio**
- **Cálculo automático de antigüedad**
- **Integración con API externa**

### **7. Componente de Partes del Cuerpo (partes_cuerpo.php)**
- **SVG interactivo** del cuerpo humano
- **Selección múltiple** de partes afectadas
- **Vue.js** para reactividad
- **Vista frontal y posterior**
- **Lista de partes seleccionadas**

---

## 🔧 **CONFIGURACIÓN Y DEPENDENCIAS**

### **Configuración de Sesiones**
```php
// Configuración automática en login.php y header.php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
```

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
- **Extensiones PHP**: json, pdo_sqlite (para desarrollo), session
- **Navegador**: Moderno con soporte para ES6+

---

## 🎨 **DISEÑO Y UX**

### **Paleta de Colores**
- **Primario**: `#CC1D7C` (Rosa/Magenta)
- **Secundario**: `#e23189` (Rosa claro)
- **Acentos**: `#97245e` (Rosa oscuro)
- **Fondo**: `#f3f3f2` (Gris claro)

### **Página de Login**
- **Diseño moderno** con gradientes
- **Logo de la clínica** prominente
- **Formulario centrado** con validación visual
- **Efectos hover** y transiciones suaves
- **Responsive design** para móviles

### **Componentes de UI**
- **Cards** con sombras y bordes redondeados
- **Botones** con efectos hover
- **Dropdowns** personalizados con tema oscuro
- **Alertas** modernas con SweetAlert2
- **Formularios** responsivos con Bootstrap
- **Header** con navegación intuitiva

### **Responsividad**
- **Mobile-first** con Bootstrap 5
- **Grid system** adaptativo
- **Componentes** que se ajustan a diferentes pantallas

---

## 🔐 **SEGURIDAD AVANZADA**

### **Autenticación y Autorización**
- **Sesiones PHP seguras** con verificación en servidor
- **Validación de credenciales** hardcodeadas (configurables)
- **Headers de seguridad** para prevenir cacheo
- **Logout completo** con destrucción de cookies

### **Protección de Páginas**
- **Verificación automática** en cada página protegida
- **Redirección automática** al login si no autenticado
- **Prevención de acceso directo** a URLs protegidas

### **Validaciones**
- **Campos requeridos** en formularios
- **Validación de DNI** y datos de contacto
- **Verificación** de fechas y valores numéricos
- **Sanitización** de inputs para prevenir XSS

### **Manejo de Sesiones**
- **Inicio de sesión** automático en páginas protegidas
- **Verificación de autenticación** en cada carga
- **Destrucción completa** al hacer logout
- **Prevención de navegación atrás** después del logout

---

## 📊 **ESTRUCTURA DE DATOS**

### **Datos de Sesión**
```php
$_SESSION = [
    'authenticated' => true,
    'username' => 'admin',
    'login_time' => 1703123456
];
```

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
4. Extensiones PHP: session, json

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
   - Apuntar document root al directorio `public/`
   - Verificar que .htaccess esté habilitado
   - Configurar permisos de escritura para sesiones

4. **Configurar API externa**:
   - Editar archivos con URL y token correctos
   - Verificar conectividad con API externa

5. **Verificar permisos**:
   ```bash
   chmod 755 -R .
   chmod 777 -R /tmp  # Para sesiones PHP
   ```

### **Configuración de Desarrollo**
```bash
# Ejecutar servidor de desarrollo
php -S localhost:8000 -t public/

# Verificar sesiones
php -m | grep session
```

### **Credenciales por Defecto**
- **Usuario**: `admin` | **Contraseña**: `admin3842`
- **Usuario**: `usuario` | **Contraseña**: `user444`

---

## 🔍 **MANTENIMIENTO Y SOPORTE**

### **Logs y Debugging**
- **Console.log** en JavaScript para debugging
- **Error handling** en PHP con try-catch
- **SweetAlert2** para mostrar errores al usuario
- **Verificación de sesiones** en cada página

### **Monitoreo de Seguridad**
- **Verificación** de conectividad con API externa
- **Validación** de datos de entrada
- **Alertas** automáticas para errores
- **Control de sesiones** activas

### **Actualizaciones**
- **Dependencias** actualizadas vía CDN
- **Framework** Flight PHP actualizable vía Composer
- **Código** modular para fácil mantenimiento
- **Sistema de autenticación** configurable

---

## 📈 **ESCALABILIDAD**

### **Arquitectura Modular**
- **Componentes** reutilizables
- **Funciones** centralizadas
- **APIs** bien definidas
- **Sistema de autenticación** extensible

### **Posibles Mejoras**
- **Base de datos local** para usuarios y sesiones
- **Sistema de roles** y permisos avanzados
- **Reportes** y estadísticas
- **Notificaciones** en tiempo real
- **API REST** completa para integraciones
- **Autenticación** con base de datos
- **Logs de auditoría** de accesos

---

## 📞 **CONTACTO Y SOPORTE**

### **Información del Proyecto**
- **Cliente**: Clínica San Gabriel
- **Desarrollador**: Sistema personalizado
- **Versión**: 2.0 (con sistema de autenticación)
- **Fecha**: 2024
- **Nota**: Esta documentación es confidencial y contiene información técnica del sistema

### **Soporte Técnico**
- **Documentación**: Esta documentación actualizada
- **Código**: Comentado y estructurado
- **APIs**: Documentadas en el código
- **Sistema de autenticación**: Completamente funcional

### **Problemas Comunes**
1. **Sesión no se mantiene**: Verificar permisos de /tmp
2. **No puede hacer login**: Verificar credenciales en login.php
3. **Páginas no cargan**: Verificar configuración de Apache
4. **API externa no responde**: Verificar URL y token

---

*Documentación actualizada - Sistema Clínica San Gabriel v2.0* 
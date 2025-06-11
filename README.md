# 🏥 Sistema de Gestión Médica Laboral - Clínica San Gabriel

## 📋 **Descripción**

Sistema web para la gestión integral de **accidentes laborales** y **control de ausentismo** en empresas. Diseñado específicamente para clínicas de medicina laboral que requieren un registro detallado y profesional de incidents y licencias médicas.

---

## 🎯 **Funcionalidades Principales**

### 📊 **Gestión de Accidentes Laborales**
- ✅ Registro completo de accidentes con datos de empresa y empleado
- ✅ Selección visual de partes del cuerpo afectadas mediante SVG interactivo
- ✅ Clasificación por tipo de accidente y gravedad
- ✅ Seguimiento médico con diagnósticos y tratamientos
- ✅ Control de intervención ART y derivaciones
- ✅ Cálculo automático de antigüedad laboral

### 🗓️ **Control de Ausentismo**
- ✅ Gestión de licencias médicas (Justificadas, Injustificadas, ART)
- ✅ Cálculo automático de días de ausentismo
- ✅ Seguimiento de certificados médicos y vencimientos
- ✅ Control de aptitudes para reingreso laboral
- ✅ Gestión de auditorías médicas
- ✅ Registro de reubicaciones laborales

### 🎨 **Selector de Partes del Cuerpo**
- ✅ Interfaz visual SVG interactiva del cuerpo humano
- ✅ Selección múltiple de partes afectadas
- ✅ Categorización por grupos anatómicos
- ✅ Vista clara y profesional para reportes médicos

---

## 🛠️ **Tecnologías Utilizadas**

| Tecnología | Versión | Propósito |
|-----------|---------|-----------|
| **PHP** | 7.4+ | Backend y procesamiento de formularios |
| **MySQL** | 5.7+ | Base de datos |
| **Bootstrap** | 5.3.0 | Framework CSS responsivo |
| **Vue.js** | 2.6.14 | Componente selector de partes del cuerpo |
| **FontAwesome** | 6.4.0 | Iconografía |
| **SVG** | - | Gráficos del cuerpo humano |

---

## 📁 **Estructura del Proyecto**

```
clinica_san_gabriel/
├── index.php                      # Página principal
├── header.php                     # Encabezado común
├── footer.php                     # Pie de página común
├── form_accidente_laboral.php     # Formulario de accidentes
├── form_control_ausentismo.php    # Formulario de ausentismo
├── partes_cuerpo.php              # Componente selector de partes
├── estructura_json.json           # Estructuras de datos para APIs
├── svg-cuerpo.svg                 # Gráfico SVG del cuerpo
├── logo-clinica-letras.png        # Logo de la clínica
└── README.md                      # Documentación
```

---

## 🚀 **Instalación y Configuración**

### **Requisitos Previos**
- Servidor web (Apache/Nginx)
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Navegador web moderno

### **Configuración de Base de Datos**

Cada formulario maneja su propia configuración de base de datos. Modifica las credenciales en cada archivo:

#### **Para Accidentes Laborales** (`form_accidente_laboral.php`):
```php
$host = 'localhost';
$dbname = 'accidentes_laborales';
$username = 'tu_usuario';
$password = 'tu_contraseña';
```

#### **Para Control de Ausentismo** (`form_control_ausentismo.php`):
```php
$host = 'localhost';
$dbname = 'control_ausentismo';
$username = 'tu_usuario';
$password = 'tu_contraseña';
```

### **Instalación**
1. Clona o descarga el proyecto en tu servidor web
2. Configura las credenciales de base de datos
3. Crea las tablas necesarias según las estructuras en `estructura_json.json`
4. Accede a `index.php` desde tu navegador

---

## 📝 **Uso del Sistema**

### **Registro de Accidente Laboral**
1. Accede al formulario desde la página principal
2. Completa datos de la empresa (CUIT, razón social, domicilio)
3. Ingresa información del empleado (DNI, nombre, contacto)
4. Especifica detalles laborales (puesto, área, antigüedad)
5. Registra datos del accidente (tipo, fecha, descripción)
6. Selecciona partes del cuerpo afectadas usando el selector visual
7. Completa información médica (diagnóstico, tratamiento, gravedad)
8. Haz clic en **"Guardar"** para registrar

### **Control de Ausentismo**
1. Accede al formulario correspondiente
2. Completa datos de empresa y empleado
3. Especifica tipo de licencia (Justificada, Injustificada, ART)
4. Ingresa fechas de certificado médico
5. El sistema calcula automáticamente días de ausentismo
6. Registra información médica y de auditoría
7. Controla aptitudes para reingreso
8. Guarda el registro

### **Selector de Partes del Cuerpo**
- **Click simple**: Selecciona/deselecciona una parte
- **Múltiple selección**: Mantén seleccionadas varias partes
- **Categorías**: Las partes se agrupan por región anatómica
- **Visual**: El SVG se actualiza mostrando las partes seleccionadas

---

## 🔒 **Características de Seguridad**

- ✅ **Validación de campos obligatorios** en cliente y servidor
- ✅ **Sanitización de datos** antes del almacenamiento
- ✅ **Uso de PDO** para prevenir inyecciones SQL
- ✅ **Validación de tipos de datos** en formularios
- ✅ **Manejo de errores** controlado

---

## 📊 **Campos del Sistema**

### **Accidentes Laborales**
| Campo | Tipo | Obligatorio | Descripción |
|-------|------|-------------|-------------|
| CUIT | String | ✅ | Identificación fiscal de la empresa |
| DNI | String | ✅ | Documento del empleado |
| Tipo Accidente | Select | ✅ | Clasificación del accidente |
| Partes Afectadas | Array | ❌ | Partes del cuerpo involucradas |
| Gravedad | Select | ❌ | Leve, Moderada, Grave |
| Fecha Accidente | DateTime | ❌ | Momento del incidente |

### **Control de Ausentismo**
| Campo | Tipo | Obligatorio | Descripción |
|-------|------|-------------|-------------|
| CUIT | String | ✅ | Identificación fiscal de la empresa |
| DNI | String | ✅ | Documento del empleado |
| Tipo Licencia | Select | ✅ | Justificada, Injustificada, ART |
| Inicio Certificado | Date | ❌ | Fecha de inicio de licencia |
| Vencimiento | Date | ❌ | Fecha de fin de licencia |
| Días Ausentismo | Number | ❌ | Calculado automáticamente |

---

## 🔧 **Personalización**

### **Agregar Nuevos Tipos de Accidente**
Modifica el select en `form_accidente_laboral.php`:
```html
<option value="Nuevo_Tipo">Nuevo Tipo de Accidente</option>
```

### **Modificar Partes del Cuerpo**
Edita el componente Vue.js en `partes_cuerpo.php` agregando nuevas partes al array correspondiente.

### **Cambiar Estilos**
El sistema usa Bootstrap 5.3.0. Puedes:
- Modificar las clases CSS existentes
- Agregar CSS personalizado en `header.php`
- Cambiar el tema de Bootstrap

---

## 📋 **API y Integración**

### **Estructura de Datos JSON**
El archivo `estructura_json.json` contiene las estructuras completas de datos para:
- ✅ **Accidentes laborales** con todos los campos y validaciones
- ✅ **Control de ausentismo** con formato completo
- ✅ **Catálogo de partes del cuerpo** organizadas por grupos
- ✅ **Ejemplos de uso** con datos reales
- ✅ **Formatos de fecha** y tipos de datos

Esta estructura permite la integración con sistemas externos o el desarrollo de APIs RESTful.

---

## 🛠️ **Mantenimiento**

### **Backup de Datos**
- Realiza backups regulares de las bases de datos
- Respalda los archivos de configuración
- Mantén copias de seguridad del código personalizado

### **Actualizaciones**
- Revisa regularmente las dependencias (Bootstrap, Vue.js)
- Actualiza PHP y MySQL según sea necesario
- Mantén el navegador compatible con las tecnologías web modernas

### **Monitoreo**
- Verifica el funcionamiento de los formularios
- Revisa los logs de errores del servidor
- Controla el rendimiento de las consultas SQL

---

## 📞 **Soporte y Contacto**

Para soporte técnico o consultas sobre el sistema:

- 📧 **Email**: soporte@clinicasangabriel.com
- 📱 **Teléfono**: +54 (264) 123-4567
- 🌐 **Web**: www.clinicasangabriel.com
- 📍 **Dirección**: San Juan, Argentina

---

## 📜 **Licencia**

Este sistema fue desarrollado específicamente para **Clínica San Gabriel**. 

### Derechos de Uso:
- ✅ Uso interno de la clínica
- ✅ Modificaciones para necesidades específicas
- ✅ Backup y distribución interna
- ❌ Redistribución comercial sin autorización
- ❌ Uso en otras instituciones sin licencia

---

## 🚀 **Versión Actual: 2.0**

### **Changelog**
- **v2.0**: Sistema simplificado con formularios PHP tradicionales
- **v1.5**: Integración de selector de partes del cuerpo con Vue.js
- **v1.0**: Versión inicial con formularios básicos

### **Próximas Mejoras**
- 📊 Dashboard de estadísticas
- 📈 Reportes avanzados en PDF
- 🔍 Sistema de búsqueda y filtros
- 📱 Versión móvil optimizada
- 🔔 Notificaciones automáticas

---

**Desarrollado con ❤️ para Clínica San Gabriel - Sistema de Gestión Médica Laboral**

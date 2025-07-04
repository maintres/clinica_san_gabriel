-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS api;
USE api;

-- Tabla de empresas
CREATE TABLE empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de pacientes
CREATE TABLE pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    dni VARCHAR(20) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de médicos
CREATE TABLE medicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    matricula VARCHAR(50) UNIQUE NOT NULL,
    especialidad VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla principal de accidentes laborales
CREATE TABLE accidentes_laborales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    paciente_id INT NOT NULL,
    
    -- Información del empleado
    puesto VARCHAR(255) NOT NULL,
    area VARCHAR(255) NOT NULL,
    fecha_ingreso DATE NOT NULL,
    antiguedad VARCHAR(100),
    antiguedad_calculada VARCHAR(100),
    antiguedad_anios INT,
    antiguedad_meses INT,
    
    -- Información de obra social
    obra_social VARCHAR(255),
    plan VARCHAR(100),
    nro_afiliado VARCHAR(100),
    
    -- Información del accidente
    testigos TEXT,
    tipo_accidente VARCHAR(255),
    agente_causal VARCHAR(255),
    partes_afectadas JSON, -- Array de partes afectadas
    descripcion TEXT,
    tipo_lesion VARCHAR(255),
    gravedad ENUM('Leve', 'Moderado', 'Grave', 'Muy Grave'),
    derivacion VARCHAR(255),
    intervencion_art BOOLEAN DEFAULT FALSE,
    dias_baja INT,
    diagnostico TEXT,
    prox_ctrl DATE, -- próximo control
    
    -- Información médica
    medico_inicial_id INT,
    observaciones TEXT,
    
    -- Metadatos
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Claves foráneas
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE,
    FOREIGN KEY (medico_inicial_id) REFERENCES medicos(id) ON DELETE SET NULL
);

-- Índices para mejorar el rendimiento
CREATE INDEX idx_accidentes_empresa ON accidentes_laborales(empresa_id);
CREATE INDEX idx_accidentes_paciente ON accidentes_laborales(paciente_id);
CREATE INDEX idx_accidentes_fecha_registro ON accidentes_laborales(fecha_registro);
CREATE INDEX idx_accidentes_tipo_accidente ON accidentes_laborales(tipo_accidente);

-- Insertar datos de ejemplo
INSERT INTO empresas (nombre) VALUES 
('Empresa Ejemplo S.A.'),
('Industrias del Norte'),
('Comercial Sur Ltda.');

INSERT INTO pacientes (nombre, apellido, dni) VALUES 
('Juan', 'Pérez', '12345678'),
('María', 'González', '23456789'),
('Carlos', 'López', '34567890');

INSERT INTO medicos (nombre, apellido, matricula, especialidad) VALUES 
('Roberto', 'Martínez', 'MP-12345', 'Traumatología'),
('Ana', 'García', 'MP-23456', 'Medicina del Trabajo'),
('Luis', 'Rodríguez', 'MP-34567', 'Ortopedia');

-- Ejemplo de inserción de un accidente
INSERT INTO accidentes_laborales (
    empresa_id, paciente_id, puesto, area, fecha_ingreso, 
    antiguedad, antiguedad_calculada, antiguedad_anios, antiguedad_meses,
    obra_social, plan, nro_afiliado, testigos, tipo_accidente, agente_causal,
    partes_afectadas, descripcion, tipo_lesion, gravedad, derivacion,
    intervencion_art, dias_baja, diagnostico, prox_ctrl, medico_inicial_id, observaciones
) VALUES (
    1, 1, 'Operario', 'Producción', '2020-03-15',
    '3 años, 8 meses', '3 años, 8 meses', 3, 8,
    'OSDE', '310', '123456789', 'María González, Carlos López', 'Caída de altura', 'Máquina',
    '["brazo_derecho", "mano_derecha"]', 
    'El empleado se encontraba realizando tareas de mantenimiento en una plataforma elevada cuando perdió el equilibrio y cayó desde aproximadamente 2 metros de altura, golpeándose el brazo derecho contra una máquina.',
    'Fractura', 'Moderado', 'ART', TRUE, 15, 'Fractura de radio distal derecho', '2024-01-15', 1,
    'El paciente presenta buena evolución. Se recomienda fisioterapia post-inmovilización.'
); 
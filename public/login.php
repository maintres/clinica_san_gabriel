<?php
session_start();

// Headers de seguridad para prevenir cacheo
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Procesar logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Destruir todas las variables de sesión
    $_SESSION = array();
    
    // Destruir la cookie de sesión si existe
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Destruir la sesión
    session_destroy();
    
    // Redirigir al login
    header('Location: login.php');
    exit();
}

// Procesar login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validación de credenciales hardcodeadas
    $validUsers = [
        ['username' => 'admin', 'password' => 'admin3842'],
        ['username' => 'usuario', 'password' => 'user444']
    ];
    
    $authenticated = false;
    foreach ($validUsers as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $authenticated = true;
            break;
        }
    }
    
    if ($authenticated) {
        // Establecer sesión
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['login_time'] = time();
        
        echo 'success';
        exit();
    } else {
        echo 'error';
        exit();
    }
}

// Si ya está autenticado, redirigir al dashboard
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Clínica San Gabriel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicon -->
    <link rel="icon" href="assets/img/3.png" type="image/x-icon">
    <style>
        :root {
            --primary-color: #CC1D7C;
            --secondary-color: #e23189;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(204, 29, 124, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-header img:first-child {
            height: 160px;
        }

        .login-header img:last-of-type {
            height: 60px;
        }

        .btn-custom-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
            color: white;
            box-shadow: 0 4px 15px rgba(204, 29, 124, 0.3);
        }

        .btn-custom-primary:hover {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            box-shadow: 0 6px 20px rgba(204, 29, 124, 0.4);
            transform: translateY(-1px);
            color: white;
        }

        .btn-custom-primary:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(204, 29, 124, 0.3);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(204, 29, 124, 0.25);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(204, 29, 124, 0.25);
        }

        .password-toggle {
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .security-note {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 1px solid #dee2e6;
        }

        .security-note i {
            color: var(--primary-color);
        }

        @media (max-width: 576px) {
            body {
                padding: 10px;
            }
            
            .login-container {
                margin: 0;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header p-4 pb-0 text-center">
            <div class="d-flex flex-column align-items-center">
                <img src="assets/img/3.png" alt="Logo Clínica" class="mb-3">
                <img src="assets/img/2.png" alt="Clínica San Gabriel" class="mb-4">
            </div>
        </div>
        
        <div class="p-4">
            <form id="loginForm" novalidate>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required>
                    </div>
                    <div class="invalid-feedback" id="username-error"></div>
                </div>
                
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>                        
                        <span class="input-group-text password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </span>
                    </div>
                    <div class="invalid-feedback" id="password-error"></div>
                </div>
                
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                        Recordar sesión
                    </label>
                </div>
                
                <button type="submit" class="btn btn-custom-primary">
                    <span class="d-none" id="loading">
                        <i class="fas fa-spinner fa-spin me-2"></i>
                    </span>
                    <span id="login-text">Iniciar Sesión</span>
                </button>
            </form>
           
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Función para alternar visibilidad de contraseña
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        // Función para mostrar errores
        function showError(fieldId, message) {
            const errorElement = document.getElementById(fieldId + '-error');
            errorElement.textContent = message;
            document.getElementById(fieldId).classList.add('is-invalid');
        }

        // Función para limpiar errores
        function clearErrors() {
            const errorElements = document.querySelectorAll('.invalid-feedback');
            const inputs = document.querySelectorAll('.form-control');
            
            errorElements.forEach(element => {
                element.textContent = '';
            });
            
            inputs.forEach(input => {
                input.classList.remove('is-invalid');
            });
        }

        // Función para mostrar loading
        function setLoading(loading) {
            const loadingElement = document.getElementById('loading');
            const loginText = document.getElementById('login-text');
            const submitButton = document.querySelector('.btn-custom-primary');
            
            if (loading) {
                loadingElement.classList.remove('d-none');
                loginText.textContent = 'Accediendo...';
                submitButton.disabled = true;
            } else {
                loadingElement.classList.add('d-none');
                loginText.textContent = 'Iniciar Sesión';
                submitButton.disabled = false;
            }
        }

        // Manejo del formulario
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            clearErrors();
            
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            
            // Validaciones básicas
            let hasErrors = false;
            
            if (!username) {
                showError('username', 'El usuario es requerido');
                hasErrors = true;
            }
            
            if (!password) {
                showError('password', 'La contraseña es requerida');
                hasErrors = true;
            }
            
            if (hasErrors) {
                return;
            }
            
            // Proceso de login real con petición POST
            setLoading(true);
            
            // Validación de credenciales hardcodeadas
            const validUsers = [
                { username: 'admin', password: 'admin3842' },
                { username: 'usuario', password: 'user444' }
            ];
            
            const user = validUsers.find(u => u.username === username && u.password === password);
            
            if (user) {
                // Login exitoso - establecer sesión mediante POST
                const formData = new FormData();
                formData.append('action', 'login');
                formData.append('username', username);
                formData.append('password', password);
                
                fetch('login.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (data.includes('success')) {
                        setTimeout(() => {
                            window.location.href = 'index.php';
                        }, 1000);
                    } else {
                        setLoading(false);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de autenticación',
                            text: 'Error al establecer la sesión',
                            confirmButtonColor: '#CC1D7C'
                        });
                    }
                })
                .catch(error => {
                    setLoading(false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error de conexión',
                        confirmButtonColor: '#CC1D7C'
                    });
                });
            } else {
                // Login fallido
                setLoading(false);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de autenticación',
                    text: 'Usuario o contraseña incorrectos',
                    confirmButtonColor: '#CC1D7C'
                });
            }
        });

        // Efectos de entrada
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-control');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });
            
            // Mostrar mensaje si la sesión expiró
            const urlParams = new URLSearchParams(window.location.search);
            const msg = urlParams.get('msg');
            
            if (msg === 'sesion_expirada') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sesión expirada',
                    text: 'Su sesión ha expirado. Por favor, inicie sesión nuevamente.',
                    confirmButtonColor: '#CC1D7C'
                });
            }
        });
    </script>
</body>
</html> 
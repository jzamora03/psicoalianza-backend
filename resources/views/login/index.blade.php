@extends('layouts.app')

@section('content')
<div class="d-flex vh-100">
    <div class="col-6 position-relative  text-left text-white" style="background: url('https://activepmo.com/wp-content/uploads/2022/10/Reuniones-del-Proyecto.png') left top no-repeat; background-size: cover; margin-left: 0;">
        <div class="position-absolute bottom-0 w-100" style="background: linear-gradient(to top, rgba(0, 57, 179, 0.6), transparent); padding: 80px 20px;">
            <h2 class="mb-3">Bienvenidos a la mejor plataforma organizacional online</h2>
            <p class="mb-0">Gestión efectiva del talento humano</p>
        </div>
    </div>

    <div class="col-4 d-flex justify-content-center align-items-center mx-auto">
        <div class="p-5 w-100 d-flex flex-column" style="max-width: 400px; border: none;">
            <div class="text-center mb-5">
                <img src="{{ asset('img/logo-psicoalianza.png') }}" alt="Logo" class="img-fluid mb-4" style="max-height: 80px;">
                <h4 class="fw-bold">Iniciar Sesión</h4>
            </div>
            <form class="w-500">
                <div class="mb-4 text-start">
                    <label for="usuario" class="form-label"><b>Usuario</b></label>
                    <input type="text" class="form-control rounded-5" id="usuario" placeholder="Pruebadesarrollador" style="border: none; border-color: grey;">
                </div>
                <div class="mb-4 text-start">
                    <label for="password" class="form-label"><b>Contraseña</b></label>
                    <div class="position-relative">
                        <input type="password" class="form-control rounded-5" id="password" placeholder="Alianza2025*" style="border: none;" >
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword()">👁️</span>
                    </div>
                </div>
                <div class="form-check mb-4 d-flex justify-content-center">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label ms-2" for="remember">Recordar cuenta</label>
                </div>
                <button type="button" class="btn btn-primary w-100 rounded-5 p-1" onclick="login()">Iniciar sesión</button>
            
                <div class="d-flex justify-content-between mt-3 w-100">
                    <div class="d-flex justify-content-start" style="font-size: 0.75rem; color: grey;">
                        <p href="#" class="text-decoration-none">¿Olvidaste tu usuario?</p>
                    </div>
                    <div class="d-flex justify-content-end" style="font-size: 0.75rem; color: grey;">
                        <p href="#" class="text-decoration-none">¿Olvidaste tu contraseña?</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const password = document.getElementById('password');
        password.type = password.type === 'password' ? 'text' : 'password';
    }

    function login() {
        const user = document.getElementById('usuario').value;
        const pass = document.getElementById('password').value;

        if (user === 'Pruebadesarrollador' && pass === 'Alianza2025*') {
            window.location.href = '/empleados';
        } else {
            alert('Usuario o contraseña incorrectos.');
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.querySelector('.navbar');
        const isLoginPage = window.location.pathname === '/login';
    
        if (navbar && isLoginPage) {
            navbar.style.display = 'none';
        }
    });
    </script>

@endsection

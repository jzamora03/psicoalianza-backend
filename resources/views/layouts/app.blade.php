<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Alianza</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light">
    @if(!Request::is('login'))

    <div class="d-flex justify-content-between align-items-center p-2" style="background-color: rgba(151, 151, 151, 0.534);">
        <div class="ms-3">
            <img src="{{ asset('img/logo-psicoalianza.png') }}" alt="Logo" class="img-fluid" style="max-height: 50px;">
        </div>
        <div class="me-7 text-start text-white d-flex align-items-center" style="margin-right: 120px;">
            <img src="{{ asset('img/perfil.png')}}"  alt="Perfil" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
            <div>
                <strong style="color: rgb(67, 47, 208 );" >Elisa Gómez</strong><br>
                <span style="color: black;">Administradora</span>
            </div>
        </div>
    </div>

    <div class="d-flex">
        <nav class="bg-primary text-white vh-100 p-3" id="sidebar" style="width: 60px; transition: width 0.3s;">
            <button class="btn btn-sm btn-light mb-4 d-block mx-auto" onclick="toggleSidebar()">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <ul class="nav flex-column text-center">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white d-flex align-items-center justify-content-center" href="#" data-bs-toggle="collapse" data-bs-target="#listasMenu">
                        <i class="fas fa-list me-2" style="margin-bottom: 10px;"></i><span class="sidebar-text d-none">Listas</span>
                    </a>
                    <ul class="collapse ps-3" id="listasMenu">
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('empleados.index') }}"><i class="fas fa-user"></i> Empleados</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('cargos.index') }}"><i class="fas fa-briefcase"></i> Cargos</a></li>
                    </ul>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white d-flex align-items-center justify-content-center" href="#" data-bs-toggle="collapse" data-bs-target="#geoMenu">
                        <i class="fas fa-globe me-2"></i><span class="sidebar-text d-none">Geolocalización</span>
                    </a>
                    <ul class="collapse ps-3" id="geoMenu">
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('ciudades.index') }}"><i class="fas fa-city" ></i> Ciudades</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('paises.index') }}"><i class="fas fa-flag"></i> Países</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    @endif

        <div class="container mt-4 flex-grow-1">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>

    @if(!Request::is('login'))
    </div>
    @endif

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const texts = document.querySelectorAll('.sidebar-text');
            const icons = document.querySelectorAll('.nav-link i');
            if (sidebar.style.width === '200px') {
                sidebar.style.width = '60px';
                texts.forEach(t => t.classList.add('d-none'));
                icons.forEach(i => i.classList.remove('me-2'));
            } else {
                sidebar.style.width = '200px';
                texts.forEach(t => t.classList.remove('d-none'));
                icons.forEach(i => i.classList.add('me-2'));
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 



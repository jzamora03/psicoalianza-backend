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

    <div class="d-flex justify-content-between align-items-center p-2" style="background-color: rgba(216, 216, 216, 0.534);">
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
        <nav id="sidebar" class="bg-primary text-white vh-100" 
        style="width: 60px; transition: width 0.3s;" 
        data-state="collapsed">
     
     <!-- Botón Toggle -->
     <button class="btn btn-sm btn-light d-block mx-auto mt-3" onclick="toggleSidebar()">
       <i class="fa fa-bars"></i>
     </button>
   
     <!-- Lista de ítems -->
     <ul class="nav flex-column mt-4">
       
       <!-- Primer ítem -->
       <li class="nav-item mb-2">
         <!-- Enlace que en modo colapsado muestra sólo el ícono, y en modo expandido el ícono + texto -->
         <a href="#" 
            class="nav-link text-white sidebar-link d-flex align-items-center justify-content-center"
            style="height: 60px;" 
            data-bs-toggle="collapse" data-bs-target="#listasMenu">
            <i class="fas fa-list"></i>
            <span class="sidebar-text d-none ms-2">Listas</span>
         </a>
         <ul class="collapse" id="listasMenu">
           <li class="nav-item">
             <a class="nav-link text-white" href="{{ route('empleados.index') }}">
               <i class="fas fa-user"></i> Empleados
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link text-white" href="{{ route('cargos.index') }}">
               <i class="fas fa-briefcase"></i> Cargos
             </a>
           </li>
         </ul>
       </li>
   
       <!-- Segundo ítem -->
       <li class="nav-item mb-2">
         <a href="#"
            class="nav-link text-white sidebar-link d-flex align-items-center justify-content-center"
            style="height: 60px;"
            data-bs-toggle="collapse" data-bs-target="#geoMenu">
            <i class="fas fa-globe"></i>
            <span class="sidebar-text d-none ms-2">Geolocalización</span>
         </a>
         <ul class="collapse" id="geoMenu">
           <li class="nav-item">
             <a class="nav-link text-white" href="{{ route('ciudades.index') }}">
               <i class="fas fa-city"></i> Ciudades
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link text-white" href="{{ route('paises.index') }}">
               <i class="fas fa-flag"></i> Países
             </a>
           </li>
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



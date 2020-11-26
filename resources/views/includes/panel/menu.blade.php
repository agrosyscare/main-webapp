<h6 class="navbar-heading text-muted">Menú Principal</h6>
<!-- Navigation -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="/home">
            <i class="ni ni-tv-2 text-primary"></i> Principal
        </a>
    </li>
</ul>
<!-- Divider -->
@if (auth()->user()->role_id != 3)
<hr class="my-3">
<!-- Gestion de invernaderos -->
<h6 class="navbar-heading text-muted">Gestion de invernaderos</h6>
<!-- Navigation -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="/greenhouses">
            <i class="ni ni-button-pause text-red"></i> Invernaderos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/greenhouse-sections">
            <i class="ni ni-button-pause text-red"></i> Canchas
        </a>
    </li>
</ul>
@endif
@if (auth()->user()->role_id == 1)
<!-- Divider -->
<hr class="my-3">
<!-- Gestion de componentes -->
<h6 class="navbar-heading text-muted">Gestion de Receptores</h6>
<!-- Navigation -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="/arduinos">
            <i class="ni ni-tv-2 text-primary"></i> Arduinos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/sensors">
            <i class="ni ni-button-pause text-red"></i> Sensores
        </a>
    </li>
</ul>
@endif
<!-- Divider -->
<hr class="my-3">
<!-- Gestion de usuarios -->
<h6 class="navbar-heading text-muted">Gestion de Usuarios</h6>
<!-- Navigation -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="/users">
            <i class="ni ni-single-02 text-orange"></i> Usuarios
        </a>
    </li>
    @if (auth()->user()->role_id != 1)
    <li class="nav-item">
        <a class="nav-link" href="/schedule">
            <i class="ni ni-satisfied text-yellow"></i> Gestionar horario
        </a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
            <i class="ni ni-key-25 text-info"></i> Cerrar sesión
        </a>
        <form action="{{ route('logout')}}" method="post" style="display: none;" id="formLogout">
            @csrf
        </form>
    </li>
</ul>
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted">Reportes</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-spaceship"></i> Reportes de temperatura
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-palette"></i> Reportes de humedad ambiental
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-ui-04"></i> Reportes de humedad radicular
        </a>
    </li>
    @if (auth()->user()->role_id != 3)
    <li class="nav-item">
        <a class="nav-link" href="/audits">
            <i class="ni ni-spaceship"></i> Auditoria
        </a>
    </li>
    @endif

</ul>
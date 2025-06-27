{{-- Menú lateral --}}
{{-- <aside style="width: 220px; background: #134074; color: #fff; padding: 24px 0;">
    @auth
        <ul style="list-style: none; padding: 0;">
            @if (auth()->user()->tipo === 'admin')
                <li><a href="/admin" style="color:#fff;">Inicio Admin</a></li>
                <li><a href="/admin/usuarios" style="color:#fff;">Usuarios</a></li>
                <li><a href="/admin/reportes" style="color:#fff;">Reportes</a></li>
            @elseif(auth()->user()->tipo === 'empresa')
                <li><a href="/empresa" style="color:#fff;">Inicio Empresa</a></li>
                <li><a href="/empresa/ofertas" style="color:#fff;">Ofertas</a></li>
            @elseif(auth()->user()->tipo === 'candidato')
                <li><a href="/candidato" style="color:#fff;">Inicio Candidato</a></li>
                <li><a href="/candidato/postulaciones" style="color:#fff;">Mis Postulaciones</a></li>
            @elseif(auth()->user()->tipo === 'hiringGroup')
                <li><a href="/hiringGroup" style="color:#fff;">Panel HiringGroup</a></li>
            @elseif(auth()->user()->tipo === 'contratado')
                <li><a href="/contratado" style="color:#fff;">Panel Contratado</a></li>
            @endif
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:#fff; cursor:pointer;">Cerrar
                        sesión</button>
                </form>
            </li>
        </ul>
    @endauth
</aside> --}}

{{-- resources/views/components/menu-lateral.blade.php --}}
<aside style="width: 220px; background: #134074; color: #fff; padding: 24px 0;">
    @auth
        @php
            $tipo = auth()->user()->tipo;
        @endphp

        @if ($tipo === 'hiringGroup')
            <x-menu-group title="Postulaciones y Ofertas" :items="[
                ['href' => '/hiringGroup/postulaciones', 'label' => 'Revisar Postulaciones', 'highlight' => true],
                ['href' => '/hiringGroup/ofertas', 'label' => 'Ofertas Laborales'],
                ['href' => '/hiringGroup/reportes', 'label' => 'Reportes de Ofertas y Profesiones'],
            ]" :open="true" />
            <x-menu-group title="Empresas y Contrataciones" :items="[
                ['href' => '/hiringGroup/empresas', 'label' => 'Empresas Clientes (CRUD)'],
                ['href' => '/hiringGroup/contrataciones', 'label' => 'Contratación de Postulantes'],
            ]" />
            <x-menu-group title="Nómina" :items="[
                ['href' => '/hiringGroup/nomina-preparacion', 'label' => 'Preparar Nómina Mensual'],
                ['href' => '/hiringGroup/nomina-corrida', 'label' => 'Ejecutar Corrida de Nómina'],
            ]" />
            <x-menu-group title="Data Básica" :items="[['href' => '/hiringGroup/bancos', 'label' => 'Manejo de Bancos y Data Básica']]" />

            {{-- EMPRESA --}}
        @elseif ($tipo === 'empresa')
            <x-menu-group title="Ofertas Laborales" :items="[
                ['href' => '/empresa/ofertas', 'label' => 'Gestionar Ofertas', 'highlight' => true],
                ['href' => '/empresa/ofertas/create', 'label' => 'Crear Nueva Oferta'],
                ['href' => '/empresa/ofertas/activas', 'label' => 'Ofertas Activas'],
                ['href' => '/empresa/ofertas/inactivas', 'label' => 'Ofertas Inactivas'],
            ]" :open="true" />
            <x-menu-group title="Cuenta" :items="[['href' => '/empresa/password', 'label' => 'Cambiar Contraseña']]" />

            {{-- CANDIDATO / POSTULANTE --}}
        @elseif ($tipo === 'candidato')
            <x-menu-group title="Ofertas de Empleo" :items="[
                ['href' => '/candidato/ofertas', 'label' => 'Buscar y Filtrar Ofertas', 'highlight' => true],
                ['href' => '/candidato/aplicadas', 'label' => 'Mis Postulaciones'],
            ]" :open="true" />
            <x-menu-group title="Curriculum" :items="[
                ['href' => '/candidato/perfil/create', 'label' => 'Editar Perfil'],
                ['href' => '/candidato/profesiones', 'label' => 'Gestionar Profesiones'],
                ['href' => '/candidato/experiencias', 'label' => 'Gestionar Experiencias Laborales'],
            ]" />

            {{-- CONTRATADO --}}
        @elseif ($tipo === 'contratado')
            <x-menu-group title="Recibos de Pago" :items="[['href' => '/contratado/recibos', 'label' => 'Ver Recibos de Pago', 'highlight' => true]]" :open="true" />
            <x-menu-group title="Ofertas Laborales" :items="[['href' => '/contratado/ofertas', 'label' => 'Visualizar Ofertas']]" />
            <x-menu-group title="Constancia de Trabajo" :items="[['href' => '/contratado/constancia', 'label' => 'Solicitar Constancia de Trabajo']]" />

            {{-- AMINNISTRADOR --}}
        @elseif ($tipo === 'admin')
            <x-menu-group title="Panel Principal" :items="[['href' => '/admin/dashboard', 'label' => 'Dashboard', 'highlight' => true]]" :open="true" />
            <x-menu-group title="Gestión de Usuarios" :items="[
                ['href' => '/admin/usuarios', 'label' => 'Usuarios del Sistema'],
                ['href' => '/admin/roles', 'label' => 'Roles y Permisos'],
            ]" />
            <x-menu-group title="Empresas y Candidatos" :items="[
                ['href' => '/admin/empresas', 'label' => 'Empresas'],
                ['href' => '/admin/candidatos', 'label' => 'Candidatos'],
            ]" />
            <x-menu-group title="Ofertas y Postulaciones" :items="[
                ['href' => '/admin/ofertas', 'label' => 'Todas las Ofertas'],
                ['href' => '/admin/postulaciones', 'label' => 'Todas las Postulaciones'],
            ]" />
            <x-menu-group title="Reportes y Auditoría" :items="[
                ['href' => '/admin/reportes', 'label' => 'Reportes del Sistema'],
                ['href' => '/admin/auditoria', 'label' => 'Auditoría de Cambios'],
            ]" />
            <x-menu-group title="Configuración" :items="[
                ['href' => '/admin/configuracion', 'label' => 'Parámetros Generales'],
                ['href' => '/admin/bancos', 'label' => 'Bancos y Data Básica'],
            ]" />
        @endif

        {{-- Puedes agregar más bloques @elseif para otros tipos de usuario --}}

        <ul style="list-style: none; padding: 0; margin-top: 20px;">
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:#fff; cursor:pointer;">Cerrar
                        sesión</button>
                </form>
            </li>
        </ul>
    @endauth
</aside>

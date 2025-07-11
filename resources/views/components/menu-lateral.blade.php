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
                ['href' => route('hiringGroup.contrataciones.index'), 'label' => 'Revisar Postulaciones', 'highlight' => true],
                ['href' => route('hiringGroup.ofertas.index'), 'label' => 'Ofertas Laborales'],
                ['href' => route('hiringGroup.reportes.index'), 'label' => 'Reportes de Ofertas y Profesiones'],
            ]" :open="true" />
            <x-menu-group title="Empresas " :items="[
                ['href' => route('hiringGroup.empresas.index'), 'label' => 'Empresas Clientes (CRUD)'],
            ]" />
            <x-menu-group title="Nómina" :items="[
                ['href' => route('hiringGroup.nomina.preparar'), 'label' => 'Preparar Nómina Mensual'],
                ['href' => route('hiringGroup.nomina.historial'), 'label' => 'Historial de Nóminas']
            ]" />
            <x-menu-group title="Data Básica" :items="[
                ['href' =>route('hiringGroup.bancos.index'), 'label' => 'Manejo de Bancos y Data Básica'],
                ['href' => route('hiringGroup.profesiones.index'), 'label' => 'Gestionar Profesiones']
            ]" />


            {{-- EMPRESA --}}
        @elseif ($tipo === 'empresa')
            <x-menu-group title="Ofertas Laborales" :items="[
                ['href' => route('empresa.ofertas.index'), 'label' => 'Gestionar Ofertas', 'highlight' => true],
                ['href' => route('empresa.ofertas.create'), 'label' => 'Crear Nueva Oferta'],
                ['href' => route('empresa.ofertas.activas'), 'label' => 'Ofertas Activas'],
                ['href' => route('empresa.ofertas.inactivas'), 'label' => 'Ofertas Inactivas'],
            ]" :open="true" />
            <x-menu-group title="Cuenta" :items="[
                ['href' => route('empresa.password'), 'label' => 'Cambiar Contraseña'],
                ['href' => route('empresa.perfil.edit'), 'label' => 'Editar Informacion']
            ]" />

            {{-- CANDIDATO / POSTULANTE --}}
        @elseif ($tipo === 'candidato')
            {{-- Nota: Las rutas de 'candidato' deben ser definidas en web.php --}}
            <x-menu-group title="Ofertas de Empleo" :items="[
                ['href' => route('candidato.ofertas.index'), 'label' => 'Buscar y Filtrar Ofertas', 'highlight' => true], 
                ['href' => route('candidato.postulaciones.index') , 'label' => 'Mis Postulaciones'], 
            ]" :open="true" />
            <x-menu-group title="Curriculum" :items="[
                ['href' => route('candidato.perfil.edit'), 'label' => 'Editar Perfil'], 
                ['href' => route('candidato.profesiones.index'), 'label' => 'Gestionar Profesiones'], 
                ['href' => route('candidato.experiencias.index'), 'label' => 'Gestionar Experiencias Laborales'], 
            ]" />

            {{-- CONTRATADO --}}
        @elseif ($tipo === 'contratado')
            <x-menu-group title="Recibos de Pago" :items="[
                ['href' => route('contratado.recibos.index'), 'label' => 'Ver Recibos de Pago', 'highlight' => true]
            ]" :open="true" />
            <x-menu-group title="Ofertas Laborales" :items="[
                ['href' => route('contratado.ofertas.index'), 'label' => 'Visualizar Ofertas']
            ]" />
            <x-menu-group title="Constancia de Trabajo" :items="[
                ['href' => route('contratado.constancia.create'), 'label' => 'Solicitar Constancia de Trabajo']
            ]" />
            <x-menu-group title="Curriculum" :items="[
                ['href' => route('contratado.perfil.curriculum'), 'label' => 'Ver Currículum'],
                ['href' => route('contratado.perfil.edit'), 'label' => 'Editar Perfil'], 
            ]" />

            {{-- AMINNISTRADOR --}}
        @elseif ($tipo === 'admin')
            {{-- Nota: Las rutas de 'admin' deben ser definidas en web.php --}}
            <x-menu-group title="Panel Principal" :items="[['href' => route('admin.dashboard'), 'label' => 'Dashboard', 'highlight' => true]]" :open="true" />
            <x-menu-group title="Gestión de Usuarios" :items="[
                ['href' => '#', 'label' => 'Usuarios del Sistema'], {{-- TODO: route('admin.usuarios.index') --}}
                ['href' => '#', 'label' => 'Roles y Permisos'], {{-- TODO: route('admin.roles.index') --}}
            ]" />
            <x-menu-group title="Empresas y Candidatos" :items="[
                ['href' => '#', 'label' => 'Empresas'], {{-- TODO: route('admin.empresas.index') --}}
                ['href' => '#', 'label' => 'Candidatos'], {{-- TODO: route('admin.candidatos.index') --}}
            ]" />
            <x-menu-group title="Ofertas y Postulaciones" :items="[
                ['href' => '#', 'label' => 'Todas las Ofertas'], {{-- TODO: route('admin.ofertas.index') --}}
                ['href' => '#', 'label' => 'Todas las Postulaciones'], {{-- TODO: route('admin.postulaciones.index') --}}
            ]" />
            <x-menu-group title="Reportes y Auditoría" :items="[
                ['href' => '#', 'label' => 'Reportes del Sistema'], {{-- TODO: route('admin.reportes.index') --}}
                ['href' => '#', 'label' => 'Auditoría de Cambios'], {{-- TODO: route('admin.auditoria.index') --}}
            ]" />
            <x-menu-group title="Configuración" :items="[
                ['href' => '#', 'label' => 'Parámetros Generales'], {{-- TODO: route('admin.configuracion.index') --}}
                ['href' => '#', 'label' => 'Bancos y Data Básica'], {{-- TODO: route('admin.bancos.index') --}}
            ]" />
        @endif

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

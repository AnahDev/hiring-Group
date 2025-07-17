{{-- resources/views/components/menu-lateral.blade.php --}}
<aside
 {{-- background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%); --}}
  {{-- background: linear-gradient(135deg, #5a6eea 0%, #6d4ba2 100%); --}}
    style="width: 250px;  
        background: linear-gradient(135deg, #5a6eea 0%, #6d4ba2 100%); 
        color: #fff; 
        padding: 0; margin: 0; 
        min-height: 100vh; box-shadow: 
        2px 0 10px rgba(0,0,0,0.1); 
        position: relative;">
    @auth 
    
        @php
            $tipo = auth()->user()->tipo;
            $currentRoute = request()->route()->getName();
        @endphp

        <!-- Header del menú -->
        <div style="padding: 24px 16px; border-bottom: 1px solid rgba(255,255,255,0.1); text-align: center;">
            <h3 style="margin: 0; font-size: 18px; font-weight: 700; color: #fff;">
                {{ ucfirst($tipo) }} Panel
            </h3>
        </div>

        <!-- Contenido del menú -->
        <div style="padding: 16px 0; padding-bottom: 100px;">
            @if ($tipo === 'hiringGroup')
                <x-menu-group title="Postulaciones y Ofertas" icon="briefcase" :items="[
                    [
                        'href' => route('hiringGroup.contrataciones.index'),
                        'label' => 'Revisar Postulaciones',
                        'highlight' => $currentRoute === 'hiringGroup.contrataciones.index',
                        'icon' => 'user-check',
                    ],
                    [
                        'href' => route('hiringGroup.ofertas.index'),
                        'label' => 'Ofertas Laborales',
                        'highlight' => $currentRoute === 'hiringGroup.ofertas.index',
                        'icon' => 'briefcase',
                    ],
                    [
                        'href' => route('hiringGroup.reportes.index'),
                        'label' => 'Reportes de Ofertas y Profesiones',
                        'highlight' => $currentRoute === 'hiringGroup.reportes.index',
                        'icon' => 'bar-chart-3',
                    ],
                ]" />

                <x-menu-group title="Empresas" icon="building" :items="[
                    [
                        'href' => route('hiringGroup.empresas.index'),
                        'label' => 'Empresas Clientes (CRUD)',
                        'highlight' => $currentRoute === 'hiringGroup.empresas.index',
                        'icon' => 'building-2',
                    ],
                ]" />

                <x-menu-group title="Nómina" icon="wallet" :items="[
                    [
                        'href' => route('hiringGroup.nomina.preparar'),
                        'label' => 'Preparar Nómina Mensual',
                        'highlight' => $currentRoute === 'hiringGroup.nomina.preparar',
                        'icon' => 'calculator',
                    ],
                    [
                        'href' => route('hiringGroup.nomina.historial'),
                        'label' => 'Historial de Nóminas',
                        'highlight' => $currentRoute === 'hiringGroup.nomina.historial',
                        'icon' => 'history',
                    ],
                ]" />

                <x-menu-group title="Data Básica" icon="database" :items="[
                    [
                        'href' => route('hiringGroup.bancos.index'),
                        'label' => 'Manejo de Bancos y Data Básica',
                        'highlight' => $currentRoute === 'hiringGroup.bancos.index',
                        'icon' => 'landmark',
                    ],
                    [
                        'href' => route('hiringGroup.profesiones.index'),
                        'label' => 'Gestionar Profesiones',
                        'highlight' => $currentRoute === 'hiringGroup.profesiones.index',
                        'icon' => 'graduation-cap',
                    ],
                ]" />
            @elseif ($tipo === 'empresa')
                <x-menu-group title="Ofertas Laborales" icon="briefcase" :items="[
                    [
                        'href' => route('empresa.ofertas.index'),
                        'label' => 'Gestionar Ofertas',
                        'highlight' => $currentRoute === 'empresa.ofertas.index',
                        'icon' => 'settings',
                    ],
                    [
                        'href' => route('empresa.ofertas.create'),
                        'label' => 'Crear Nueva Oferta',
                        'highlight' => $currentRoute === 'empresa.ofertas.create',
                        'icon' => 'plus-circle',
                    ],
                    [
                        'href' => route('empresa.ofertas.activas'),
                        'label' => 'Ofertas Activas',
                        'highlight' => $currentRoute === 'empresa.ofertas.activas',
                        'icon' => 'check-circle',
                    ],
                    [
                        'href' => route('empresa.ofertas.inactivas'),
                        'label' => 'Ofertas Inactivas',
                        'highlight' => $currentRoute === 'empresa.ofertas.inactivas',
                        'icon' => 'x-circle',
                    ],
                ]" />

                <x-menu-group title="Cuenta" icon="user" :items="[
                    [
                        'href' => route('empresa.password'), 
                        'label' => 'Cambiar Contraseña', 
                        'highlight' => $currentRoute === 'empresa.password',
                        'icon' => 'lock'
                    ],
                    [
                        'href' => route('empresa.perfil.edit'), 
                        'label' => 'Editar Información', 
                        'highlight' => $currentRoute === 'empresa.perfil.edit',
                        'icon' => 'edit'
                    ],
                ]" />
            @elseif ($tipo === 'candidato')
                <x-menu-group title="Ofertas de Empleo" icon="search" :items="[
                    [
                        'href' => route('candidato.ofertas.index'),
                        'label' => 'Buscar y Filtrar Ofertas',
                        'highlight' => $currentRoute === 'candidato.ofertas.index',
                        'icon' => 'search',
                    ],
                    [
                        'href' => route('candidato.postulaciones.index'),
                        'label' => 'Mis Postulaciones',
                        'highlight' => $currentRoute === 'candidato.postulaciones.index',
                        'icon' => 'file-text',
                    ],
                ]" />

                <x-menu-group title="Curriculum" icon="file-text" :items="[
                    [
                        'href' => route('candidato.perfil.edit'), 
                        'label' => 'Editar Perfil', 
                        'highlight' => $currentRoute === 'candidato.perfil.edit',
                        'icon' => 'user-edit'
                    ],
                    [
                        'href' => route('candidato.profesiones.index'),
                        'label' => 'Gestionar Profesiones',
                        'highlight' => $currentRoute === 'candidato.profesiones.index',
                        'icon' => 'graduation-cap',
                    ],
                    [
                        'href' => route('candidato.experiencias.index'),
                        'label' => 'Gestionar Experiencias Laborales',
                        'highlight' => $currentRoute === 'candidato.experiencias.index',
                        'icon' => 'briefcase',
                    ],
                ]" />
            @elseif ($tipo === 'contratado')
                <x-menu-group title="Recibos de Pago" icon="receipt" :items="[
                    [
                        'href' => route('contratado.recibos.index'),
                        'label' => 'Ver Recibos de Pago',
                        'highlight' => $currentRoute === 'contratado.recibos.index',
                        'icon' => 'receipt',
                    ],
                ]" />

                <x-menu-group title="Ofertas Laborales" icon="briefcase" :items="[
                    [
                        'href' => route('contratado.ofertas.index'), 
                        'label' => 'Visualizar Ofertas', 
                        'highlight' => $currentRoute === 'contratado.ofertas.index',
                        'icon' => 'eye'
                    ],
                ]" />

                <x-menu-group title="Constancia de Trabajo" icon="file-check" :items="[
                    [
                        'href' => route('contratado.constancia.create'),
                        'label' => 'Solicitar Constancia de Trabajo',
                        'highlight' => $currentRoute === 'contratado.constancia.create',
                        'icon' => 'file-plus',
                    ],
                ]" />

                <x-menu-group title="Curriculum" icon="file-text" :items="[
                    [
                        'href' => route('contratado.perfil.curriculum'), 
                        'label' => 'Ver Currículum', 
                        'highlight' => $currentRoute === 'contratado.perfil.curriculum',
                        'icon' => 'eye'
                    ],
                    [
                        'href' => route('contratado.perfil.edit'), 
                        'label' => 'Editar Perfil', 
                        'highlight' => $currentRoute === 'contratado.perfil.edit',
                        'icon' => 'user-edit'
                    ],
                ]" />
            {{-- @else
                {{-- Admin o cualquier otro tipo --}}
                <x-menu-group title="Panel Principal" icon="layout-dashboard" :items="[
                    [
                        'href' => route('admin.dashboard'), 
                        'label' => 'Dashboard', 
                        'highlight' => $currentRoute === 'admin.dashboard',
                        'icon' => 'home'
                    ],
                ]" />

                <x-menu-group title="Gestión de Usuarios" icon="users" :items="[
                    [
                        'href' => '#', 
                        'label' => 'Usuarios del Sistema', 
                        'highlight' => false,
                        'icon' => 'user-circle'
                    ],
                    [
                        'href' => '#', 
                        'label' => 'Roles y Permisos', 
                        'highlight' => false,
                        'icon' => 'shield'
                    ],
                ]" />

                <x-menu-group title="Empresas y Candidatos" icon="building" :items="[
                    [
                        'href' => '#', 
                        'label' => 'Empresas', 
                        'highlight' => false,
                        'icon' => 'building-2'
                    ],
                    [
                        'href' => '#', 
                        'label' => 'Candidatos', 
                        'highlight' => false,
                        'icon' => 'user-search'
                    ],
                ]" />

                <x-menu-group title="Ofertas y Postulaciones" icon="briefcase" :items="[
                    [
                        'href' => '#', 
                        'label' => 'Todas las Ofertas', 
                        'highlight' => false,
                        'icon' => 'briefcase'
                    ],
                    [
                        'href' => '#', 
                        'label' => 'Todas las Postulaciones', 
                        'highlight' => false,
                        'icon' => 'file-text'
                    ],
                ]" />

                <x-menu-group title="Reportes y Auditoría" icon="bar-chart-3" :items="[
                    [
                        'href' => '#', 
                        'label' => 'Reportes del Sistema', 
                        'highlight' => false,
                        'icon' => 'bar-chart-3'
                    ],
                    [
                        'href' => '#', 
                        'label' => 'Auditoría de Cambios', 
                        'highlight' => false,
                        'icon' => 'activity'
                    ],
                ]" />

                <x-menu-group title="Configuración" icon="settings" :items="[
                    [
                        'href' => '#', 
                        'label' => 'Parámetros Generales', 
                        'highlight' => false,
                        'icon' => 'settings'
                    ],
                    [
                        'href' => '#', 
                        'label' => 'Bancos y Data Básica', 
                        'highlight' => false,
                        'icon' => 'landmark'
                    ],
                ]" />
            {{-- @endif --}} 
            @endif


            <!-- Botón de logout como parte del menú -->
            <div class="menu-group" style="margin-bottom: 16px; margin-top: 24px;">
                <ul class="menu-group-list" style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 2px;">
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit"
                                style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 6px; transition: all 0.3s ease; font-size: 14px; opacity: 0.9; background: none; border: none; cursor: pointer; width: 100%; text-align: left; border-left: 3px solid transparent;"
                                onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'; this.style.transform='translateX(4px)';"
                                onmouseout="this.style.backgroundColor='transparent'; this.style.transform='translateX(0)';">
                                <i data-lucide="log-out" style="width: 16px; height: 16px; margin-right: 12px; opacity: 0.8;"></i>
                                Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    @endauth
</aside>

{{-- Asegurar que Lucide está cargado --}}
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar iconos de Lucide
        lucide.createIcons();

        // Reinicializar iconos después de cualquier cambio dinámico
        const observer = new MutationObserver(function(mutations) {
            lucide.createIcons();
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    });
</script>
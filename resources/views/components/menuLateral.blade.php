{{-- Menú lateral --}}
<aside style="width: 220px; background: #134074; color: #fff; padding: 24px 0;">
    @auth
        <ul style="list-style: none; padding: 0;">
            @if (auth()->user()->tipo === 'admin')
                <li><a href="/admin/dashboard" style="color:#fff;">Inicio Admin</a></li>
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
</aside>

<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
        <img src="{{asset('theme\images\icon\logo-blue.png')}}" alt="IfCert" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>Certificados</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="index.html">Criar Modelos</a>
                        </li>
                        <li>
                            <a href="index2.html">A definir</a>
                        </li>
                        <li>
                            <a href="index3.html"> A derinir </a>
                        </li>
                        <li>
                            <a href="index4.html">A definir</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.evento.lista')}}">
                        <i class="fas fa-chart-bar"></i>Eventos
                    </a>
                </li>
				@hasrole('admin')
                <li>
                    <a href="{{route('admin.usuarios.lista')}}">
                        <i class="far fa-check-square"></i>Usuários
                    </a>
                </li>
				@endhasrole
            </ul>
        </nav>
    </div>
</aside>

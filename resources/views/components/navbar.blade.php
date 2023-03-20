<nav class="navbar navbar-expand-lg bg-white navbar-light p-0">
    <a href="" class="navbar-brand d-block d-lg-none">
        <h1 class="m-0 display-4 text-primary">Klean</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="/" class="nav-item nav-link active">Bosh Sahifa</a>
            <a href="/about" class="nav-item nav-link">Biz haqimizda</a>
            <a href="{{ route('service') }}" class="nav-item nav-link">Xizmatlar</a>
            <a href="/project" class="nav-item nav-link">Portfolio</a>
            <a href=" {{ route('posts.index') }}" class="nav-item nav-link">Blog</a>
            <a href="/contact" class="nav-item nav-link">Aloqa</a>
        </div>
        @auth
        <div>{{auth()->user()->name}}</div>
            <a href="{{ route('posts.create') }}" class="btn btn-primary mr-3 d-none d-lg-block">Post Yaratish</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger mr-3 d-none d-lg-block">Chiqish</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary mr-3 d-none d-lg-block">Kirish</a>
        @endauth
    </div>
</nav>

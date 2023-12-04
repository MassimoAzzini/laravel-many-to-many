<header class="bg-dark opacity-75">
    <nav class="navbar navbar-dark">
        <div class="container-fluid px-5">
          <a href="{{ route('home') }}" target="_blank" class="navbar-brand">Vai al sito</a>
          <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
            @csrf
            <button class="btn btn-light" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
          </form>
        </div>
      </nav>
</header>

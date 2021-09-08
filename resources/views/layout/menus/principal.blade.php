<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container nb-container">
    <a class="navbar-brand" href="{{ URL::to("/") }}">
      <img class="img-fluid d-block m-auto" src="" alt="Navbar">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link text-center" href="{{ URL::to("/") }}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-center" href="{{ URL::to("contact") }}">Contacto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-center" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-center disabled" href="#">Disabled</a>
        </li>
      </ul>

      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

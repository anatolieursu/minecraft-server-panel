<nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark" style="padding: 20px 0; @if(!empty(env("HEADER_COLOR"))) background-color: {{ env("HEADER_COLOR") }} !important; @endif" id="the_navbar">
    <div class="container-fluid">
      <a style="margin-left: 20px;" class="navbar-brand" href="{{ route("welcome") }}">{{ env("MINECRAFT_SERVER_NAME") }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="toggleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse the_navbar" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ route("welcome") }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("forum") }}">Forum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("personal") }}">Staff</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("wiki") }}">Wiki</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("apply.staff") }}">Staff Application</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("dashboard") }}">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("chat.view") }}">Live chat</a>
          </li>
          @if(Auth::user())
            @if(Auth::user()->admin)
              <li class="nav-item">
                <a class="nav-link" href="{{ route("admin") }}">Admin</a>
              </li>
            @endif
          @endif
        </ul>
        <form action="/search" method="get" class="search_form" role="search" style="display: flex">
          <input class="form-control me-2" name="content" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit" style="margin-right: 20px;">Search</button>
        </form>
      </div>
    </div>
</nav>
<script>
  const toggleNavBarBtn = document.getElementById("toggleNavbar");
  const navBar = document.getElementById("navbarSupportedContent")
  toggleNavBarBtn.addEventListener("click", () => {
    if(navBar.style.display === "none" || navBar.style.display === "") {
      navBar.style.display = "flex";
    } else {
      navBar.style.display = "none"
    }
    
  })
</script>
<style>
  @media only screen and (max-width: 990px) {
    .search_form {
      position: absolute;
      bottom: 10px;
      display: block !important;
    }
    .search_form button {
      width: 100%;
      margin-top: 3px;
    }
    .the_navbar {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 70px;
    }
    .the_navbar ul li {
      text-align: center
    }
    .the_navbar ul {
      width: 100%;
    }
  }
</style>
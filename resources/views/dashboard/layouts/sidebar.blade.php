<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/baca/dashboard') ? 'active' : '' }}" aria-current="page" href="/baca/dashboard">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/baca/dashboard/posts*') ? 'active' : '' }}" href="/baca/dashboard/posts">
            <span data-feather="file" class="align-text-bottom"></span>
            My Post
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/baca/dashboard/keyword*') ? 'active' : '' }}" href="/baca/dashboard/keyword">
            <span data-feather="file" class="align-text-bottom"></span>
            Keyword
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/baca/dashboard/keyopenai*') ? 'active' : '' }}" href="/baca/dashboard/keyopenai">
            <span data-feather="file" class="align-text-bottom"></span>
            Key Open AI
          </a>
        </li>
      </ul>

      <hr>

    {{-- @can('admin')
      <h6 class="sidebar-heading d-flex">
        <span>Administrator</span>
      </h6>

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/categories') ? 'active' : '' }}" aria-current="page" href="/dashboard/categories">
            <span data-feather="home" class="align-text-bottom"></span>
            Post Category
          </a>
        </li>
      </ul>
    @endcan --}}
     

    </div>
  </nav>
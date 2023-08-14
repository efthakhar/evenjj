<div class="admin-header">
  <div class="boxed-bg-icon header-menu-icon">
    <i class="ri-menu-3-line"></i>
  </div>
  <div class="ms-auto position-relative svg-icon-style-1 ms-4">
    <span class="cursor-pointer" id="topbar-user-dropdown" data-bs-toggle="dropdown">
      <i class="ri-user-3-line  h3 text-sb1"></i>
    </span>
    <ul class="dropdown-menu p-0" aria-labelledby="topbar-user-dropdown">
      <li>
        <a class="dropdown-item svg-icon-sm-style-1 flex-center" href="{{route('logout')}}">
          <span class="me-2">logout <i class="ri-logout-circle-r-line h5 ms-1 text-danger"></i></span>

        </a>
      </li>
    </ul>
  </div>
  <a href="/demo">
    <div class="boxed-bg-icon ms-2 cursor-pointer">
      <i class="ri-loop-right-line h3 text-sb1 cursor-pointer"></i>
    </div>
  </a>
</div>

<!-- NAVBAR -->

   <nav class="navbar">
    <div class="logo">LaptopStore</div>
    <ul class="nav-menu">
      <li><a href="/">Trang chủ</a></li>
      {{-- <li class="has-submenu">
          <a href="/san-pham">Danh mục <i class="fas fa-chevron-down" style="font-size: 0.8rem; margin-left: 3px;"></i></a>
          @if(isset($categories) && count($categories) > 0)
          <ul class="submenu-nav" style="position: absolute; background: white; list-style: none; padding: 10px 0; border-radius: 4px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); display: none; z-index: 1000; min-width: 150px;">
              @foreach($categories as $category)
              <li><a href="/san-pham?category={{ $category->id }}" style="color: #333; padding: 8px 15px; display: block;">{{ $category->name }}</a></li>
              @endforeach
          </ul>
          @endif
      </li> --}}
      <li><a href="#">Về chúng tôi</a></li>
      <li><a href="#">Tin công nghệ</a></li>
    </ul>
    <div class="search-bar">
      <i class="fas fa-search"></i>
      <input type="text" placeholder="Bạn cần tìm laptop gì?">
    </div>
    <div class="nav-icons">
      <a href="#"><i class="fas fa-shopping-cart"></i><span class="cart-count">3</span></a>
      
      @auth
      <span class="user-name" style="margin: 0 10px; font-weight: 500; color: #ffffffff;">
          Chào, {{ Auth::user()->name }}
      </span>
          <form method="POST" action="{{ route('logout') }}" style="display:inline;" id="logout-form">
              @csrf
              <a href="#" onclick="document.getElementById('logout-form').submit();" title="Đăng xuất" style="margin-right: 10px;">
                <i class="fas fa-sign-out-alt"></i>
              </a>
          </form>
          {{-- <a href="{{ route('dashboard') }}" title="Trang quản trị / Cá nhân"><i class="fas fa-user-check" style="color: var(--primary);"></i></a> --}}
      @else
          <a href="{{ route('login') }}" title="Đăng nhập / Đăng ký"><i class="fas fa-user"></i></a>
      @endauth
    </div>
  </nav>
</header>

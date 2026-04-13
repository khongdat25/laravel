
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
    <form action="{{ route('search') }}" method="GET" class="search-bar">
      <i class="fas fa-search"></i>
      <input type="text" name="query"  placeholder="Bạn cần tìm laptop gì?" value="{{ request('query') }}">
      <button type="submit" style="background:none; border:none; cursor:pointer">
        <i class="fas fa-search"></i>

      </button>
    </form>
    <div class="nav-icons">
      <a href="/cart"><i class="fas fa-shopping-cart"></i><span class="cart-count" id="cart-count">{{ auth()->check() ? \App\Models\Cart::where('user_id', auth()->id())->sum('quantity') : 0 }}</span></a>
      
      @auth
      <a href="{{ route('profile.index') }}" class="user-profile-link" style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: white; margin: 0 10px;">
          @php
              $avatarPath = Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=d10000&color=fff';
          @endphp
          <img src="{{ $avatarPath }}" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 2px solid white;">
          <span class="user-name" style="font-weight: 500;">
              {{ Auth::user()->name }}
          </span>
      </a>
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

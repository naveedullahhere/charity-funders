<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Libs CSS -->


    <!-- Box icons -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/fonts/css/boxicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/theme.min.css') }}" />

<style>
    tbody tr {
        background: #f7f7f7;
    }
    .nav-account .nav-item{
        width: 100%;
    }
</style>
@include('frontend/layouts/header')

<section class="content py-lg-7 " style="background: #4040401a;">
    <section class="py-lg-7 py-5 ">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-3 col-md-4 bg-white rounded-2 shadow-sm py-4">
                    <div class="d-flex align-items-center mb-4 justify-content-center justify-content-md-start">
                        <img src="{{ asset(optional(auth()->user())->profile_image ?? 'users/fallback.jpg') }} " alt="avatar" class="avatar avatar-lg rounded-circle" />
                        <div class="ms-3">
                            <h5 class="mb-0">{{auth()->user()->name}}</h5>
                            <small>{{auth()->user()->email}}</small>
                        </div>
                    </div>
                    <div class="d-md-none text-center d-grid">
                        <button
                                class="btn btn-light mb-3 d-flex align-items-center justify-content-between"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseAccountMenu"
                                aria-expanded="false"
                                aria-controls="collapseAccountMenu">
                            Account Menu
                            <i class="bi bi-chevron-down ms-2"></i>
                        </button>
                    </div>
                    <div class="collapse d-md-block" id="collapseAccountMenu">
                        <ul class="nav flex-column nav-account">
                            <li class="nav-item w-100">
                                <a class="nav-link {{ request()->routeIs('my-account') ? 'active' : '' }}" href="{{ route('my-account') }}">
                                    <i class="align-bottom bx bx-user"></i>
                                    <span class="ms-2">Profile</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link {{ request()->is('my-drive*') ? 'active' : '' }}" href="{{ route('my-drive') }}">
                                    <i class="align-bottom bx bx-credit-card-front"></i>
                                    <span class="ms-2">My Drive</span>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('booking-history*') ? 'active' : '' }}" href="{{ route('booking-history') }}">
                                    <i class="align-bottom bx bx-credit-card-front"></i>
                                    <span class="ms-2">Wishlist</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('change-password') ? 'active' : '' }}" aria-current="page" href="{{ route('change-password') }}">
                                    <i class="align-bottom bx bx-lock-alt"></i>
                                    <span class="ms-2">Security</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <form class="m-0" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="nav-link" href="#" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="align-bottom bx bx-log-out"></i> <span class="ms-2">
                        {{ __('Log Out') }}
                    </span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
</section>

@include('frontend/layouts/footer')


<nav class="navbar navbar-expand-lg mb-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('main.home') }}">وبلاگ من</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link me-2" href="{{ route('main.home') }}">
                        <i class="mdi mdi-home-outline"></i> خانه
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="mdi mdi-grid"></i> پست های وبلاگ
                    </a>
                </li>
            </ul>

            @if(isset($hideAuthLinks) && $hideAuthLinks)
            <div class="ms-auto mb-2 mb-lg-0">
                <span class="badge bg-primary">شما در حال احراز هویت هستید...</span>
            </div>
            @else
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="mdi mdi-account-circle"></i> حساب کاربری
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('auth.login') }}">
                                <i class="mdi mdi-login-variant"></i> ورود
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('auth.register') }}">
                                <i class="mdi mdi-account-plus"></i> ثبت نام
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-power"></i> خروج
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            @endif
        </div>
    </div>
</nav>

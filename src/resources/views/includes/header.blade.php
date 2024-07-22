<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}" width="30" />
                </a>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-3">
                <li>
                    <a href="{{ route('home') }}" class="nav-link px-2 link-body-emphasis">{{ __('Home') }}</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="nav-link px-2 {{ request()->is('dashboard') ? 'link-secondary' : 'link-body-emphasis' }}">{{ __('Dashboard') }}</a>
                </li>
                <li>
                    <a href="{{ route('diary_posts.index') }}"
                       class="nav-link px-2 {{ request()->is('diary_*', 'categories*') ? 'link-secondary' : 'link-body-emphasis' }}">{{ __('Diary') }}</a>
                </li>
                <li>
                    <a href="/"
                       class="nav-link px-2 {{ request()->is('blog') ? 'link-secondary' : 'link-body-emphasis' }}">{{ __('Blog') }}</a>
                </li>
            </ul>

            <div class="dropdown text-end">
                @isset(auth()->user()->avatar)
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Storage::url(config('custom.path.user_avatar') . '/' . auth()->user()->avatar) }}" class="img-thumbnail" width="40" />
                    </a>
                @else
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/avatar.jpg') }}" class="img-thumbnail" width="40" />
                    </a>
                @endisset
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="ps-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-button-primary :value="__('Sign out')" position="start" size="btn-sm" />
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

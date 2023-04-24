<header class="mb-3">
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                </ul>
                <div class="dropdown">
                    <div class="user-menu d-flex">
                        <div class="user-name text-end me-3">
                            <h6 class="mb-0 text-gray-600">{{ auth()->user()->name }}</h6>
                            <p class="mb-0 text-sm text-gray-600">
                                @if(auth()->user()->role == 'tu')
                                    Tata Usaha
                                @elseif(auth()->user()->role == 'kepala')
                                    Kepala
                                @else
                                    Pegawai
                                @endif
                            </p>
                        </div>
                        <div class="user-img d-flex align-items-center">
                            <div class="avatar avatar-md">
                                <img src="{{ asset('assets/images/logo/profile.png') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

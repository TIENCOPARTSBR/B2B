<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/helpers.css') }}">
    <!--<link rel="stylesheet" href="{{ asset('css/main.css') }}">-->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>
<body>
    <div class="app">
        <nav class="sidebar">
            <ul class="si-list">
                <li class="si-logo">
                    <a href="{{ url('/') }}" class="img">
                        <img src="{{ url('https://encoparts.com/wp-content/uploads/2023/02/enco-site.png') }}" alt="">
                    </a>

                    <div class="si-language">
                        <button class="select">
                            @if (app()->getLocale() == 'pt')
                                <img src="https://encoparts.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/pt-br.png" alt="eua">
                            @elseif(app()->getLocale() == 'en')
                                <img src="https://encoparts.com/wp-content/uploads/flags/us.png" alt="bandeira eua">
                            @endif
                        </button>
                    
                        <div class="list">
                            <a href="{{url('/change-language/en')}}" data-src="https://encoparts.com/wp-content/uploads/flags/us.png">
                                <img src="https://encoparts.com/wp-content/uploads/flags/us.png" alt="bandeira brasil">
                            </a>
            
                            <a href="{{url('/change-language/pt')}}" type="submit" data-src="https://encoparts.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/pt-br.png">
                                <img src="https://encoparts.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/pt-br.png" alt="">
                            </a>
                        </div>
                    </div>
                </li>
    
                <li class="si-item">
                    <a href="{{ url('/') }}" class="si-link">
                        <div class="si-icon">
                            <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10.0585C2 9.04936 2 8.54481 2.22166 8.11407C2.44333 7.68334 2.8539 7.39007 3.67505 6.80354L7.83752 3.83034C8.39886 3.42938 8.67953 3.2289 9 3.2289C9.32047 3.2289 9.60114 3.42938 10.1625 3.83034L14.325 6.80354C15.1461 7.39007 15.5567 7.68334 15.7783 8.11407C16 8.54481 16 9.04936 16 10.0585V15C16 15.9428 16 16.4142 15.7071 16.7071C15.4142 17 14.9428 17 14 17H4C3.05719 17 2.58579 17 2.29289 16.7071C2 16.4142 2 15.9428 2 15V10.0585Z" fill="#7E869E" fill-opacity="0.25"/>
                                <path d="M0 8.38661C0 8.65348 0 8.78692 0.0840973 8.82805C0.168195 8.86918 0.273524 8.78726 0.484182 8.62341L7.77212 2.95502C8.36197 2.49625 8.65689 2.26686 9 2.26686C9.34311 2.26686 9.63803 2.49625 10.2279 2.95502L17.5158 8.62341C17.7265 8.78726 17.8318 8.86918 17.9159 8.82805C18 8.78692 18 8.65348 18 8.38661V7.97817C18 7.49782 18 7.25764 17.8983 7.04973C17.7966 6.84182 17.607 6.69437 17.2279 6.39946L10.2279 0.955018C9.63803 0.496247 9.34311 0.266862 9 0.266862C8.65689 0.266862 8.36197 0.496247 7.77212 0.955019L0.772118 6.39946C0.392952 6.69437 0.203369 6.84182 0.101685 7.04973C0 7.25764 0 7.49782 0 7.97817V8.38661Z" fill="#c1c1c1"/>
                                <path d="M9.5 11H8.5C7.39543 11 6.5 11.8954 6.5 13V16.85C6.5 16.9328 6.56716 17 6.65 17H11.35C11.4328 17 11.5 16.9328 11.5 16.85V13C11.5 11.8954 10.6046 11 9.5 11Z" fill="#c1c1c1"/>
                                <rect x="13" y="1" width="2" height="4" rx="0.5" fill="#c1c1c1"/>
                            </svg>
                        </div>
                        <span>{{ __('messages.Home') }}</span>
                    </a>
                </li>
                
                <li class="si-item" data-submenu="subMenuProduct">
                    <button class="si-link">
                        <div class="si-icon">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 5.21111L12 6L12 17.0657C12 17.477 12 17.6826 11.868 17.7533C11.7359 17.824 11.5648 17.7099 11.2226 17.4818L9.27735 16.1849C9.14291 16.0953 9.07569 16.0505 9 16.0505C8.92431 16.0505 8.85709 16.0953 8.72265 16.1849L6.27735 17.8151C6.14291 17.9047 6.07569 17.9495 6 17.9495C5.92431 17.9495 5.85709 17.9047 5.72265 17.8151L3.27735 16.1849C3.14291 16.0953 3.07569 16.0505 3 16.0505C2.92431 16.0505 2.85709 16.0953 2.72265 16.1849L0.77735 17.4818C0.435164 17.7099 0.264071 17.824 0.132035 17.7533C-1.38729e-08 17.6826 -2.28612e-08 17.477 -4.08378e-08 17.0657L-6.11959e-07 4.00001C-6.94382e-07 2.11439 -7.35594e-07 1.17158 0.585786 0.585794C1.17157 7.57818e-06 2.11438 7.53697e-06 4 7.45455e-06L15 8.88107e-06L14.6718 0.218803C13.3639 1.09073 12.71 1.5267 12.355 2.18998C12 2.85326 12 3.63921 12 5.21111Z" fill="#7E869E" fill-opacity="0.25"/>
                                <path d="M12 3C12 1.34315 13.3431 0 15 0V0C16.6569 0 18 1.34315 18 3V5C18 5.55228 17.5523 6 17 6H12.5C12.2239 6 12 5.77614 12 5.5V3Z" fill="#c1c1c1"/>
                                <path d="M2.5 6.5L9.5 6.5" stroke="#c1c1c1" stroke-linecap="round"/>
                                <path d="M2.5 9.5L6.5 9.5" stroke="#c1c1c1" stroke-linecap="round"/>
                                <path d="M2.5 12.5L8.5 12.5" stroke="#c1c1c1" stroke-linecap="round"/>
                            </svg>
                        </div>

                        {{ __('messages.Products') }}

                        <span class="si-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>
                    </button>

                    <ul class="submenu" id="subMenuProduct">
                        <li class="sb-item">
                            <a href="{{ route('direct.distributor.product.index') }}" class="sb-link">{{ __('messages.Search') }}</a>
                        </li>

                        <li class="sb-item">
                            <a href="{{ route('direct.distributor.product.value.general.value.index') }}" class="sb-link">{{ __('messages.Update products') }}</a>
                        </li>

                        <li class="sb-item">
                            <a href="{{ route('direct.distributor.product.report.index') }}" class="sb-link">{{ __('messages.Product report') }}</a>
                        </li>
                    </ul>
                </li>

                <li class="si-item">
                    <a href="{{route('direct.distributor.quotation.index')}}" class="si-link">
                        <div class="si-icon">
                            <svg viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 5C5.18741 7.99101 10.8126 7.99101 15 5V15C10.6624 17.4786 5.33755 17.4786 1 15V5Z" fill="#7E869E" fill-opacity="0.25"/>
                                <ellipse cx="8" cy="4" rx="7" ry="3" stroke-width="1.2"/>
                                <path d="M1 10C1 10 1 12.3431 1 14C1 15.6569 4.13401 17 8 17C11.866 17 15 15.6569 15 14C15 13.173 15 10 15 10"  stroke-width="1.2" stroke-linecap="square"/>
                                <path d="M1 4C1 4 1 7.34315 1 9C1 10.6569 4.13401 12 8 12C11.866 12 15 10.6569 15 9C15 8.17299 15 4 15 4" stroke-width="1.2"/>
                            </svg>
                        </div>
                        <span>{{ __('messages.Quotations') }}</span>
                    </a>
                </li>

                <li class="si-item">
                    <a href="{{ route('direct.distributor.user.index') }}" class="si-link">
                        <div class="si-icon">
                            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="7" cy="4" r="4" fill="#c1c1c1"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.00003 9C3.33033 9 0.320163 11.4204 0.0239538 14.5004C-0.00248174 14.7753 0.223888 15 0.500031 15H13.5C13.7762 15 14.0025 14.7753 13.9761 14.5004C13.6799 11.4204 10.6697 9 7.00003 9Z" fill="#7E869E" fill-opacity="0.25"/>
                            </svg>
                        </div>
                        <span>{{ __('messages.Users') }}</span>
                    </a>
                </li>

                @if (Auth::guard('distributor')->user()->type === 'A')
                    <li class="si-item">
                        <a href="{{ url('/distribuidor') }}" class="si-link">
                            <div class="si-icon">
                                <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 4.3C2 4.15858 2 4.08787 2.04393 4.04393C2.08787 4 2.15858 4 2.3 4H17.7C17.8414 4 17.9121 4 17.9561 4.04393C18 4.08787 18 4.15858 18 4.3V10C18 11.8856 18 12.8284 17.4142 13.4142C16.8284 14 15.8856 14 14 14H6C4.11438 14 3.17157 14 2.58579 13.4142C2 12.8284 2 11.8856 2 10V4.3Z" fill="#7E869E" fill-opacity="0.25"/>
                                    <path d="M0 2C0 0.895431 0.895431 0 2 0H18C19.1046 0 20 0.895431 20 2C20 2.55228 19.5523 3 19 3H1C0.447716 3 0 2.55228 0 2Z" fill="#7E869E" fill-opacity="0.25"/>
                                    <rect x="7" y="7" width="6" height="1" rx="0.5" fill="#222222"/>
                                </svg>
                            </div>
                            <span>{{ __('messages.Distributors') }}</span>
                        </a>
                    </li>
                @endif
            </ul>

            <form action="{{ url('/logout') }}" method="POST">
                <button type="submit" class="logout">
                    @csrf
                    @method('POST')
                    <div class="icon">
                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.6325 2.54415L7.31623 0.438743C6.6687 0.222899 6 0.704869 6 1.38743V14.6126C6 15.2951 6.66869 15.7771 7.31623 15.5613L13.6325 13.4558C14.4491 13.1836 15 12.4193 15 11.5585V4.44152C15 3.58066 14.4491 2.81638 13.6325 2.54415Z" fill="#7E869E" fill-opacity="0.25"/>
                            <path d="M8.5 5.5L11 8M11 8L8.5 10.5M11 8H1" stroke="#222222" stroke-linecap="round"/>
                        </svg>
                    </div>
                    {{ __('messages.Logout') }}
                </button>
            </form>
        </nav>

        <main class="main">
            @yield('content')
        </main>

        @if(session('successfully'))
            <div class="alert alert-success" onshow="alert()">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="8" cy="8" r="8" fill="#3fbd63c4"/>
                    <path d="M4.5 7L7.39393 9.89393C7.45251 9.95251 7.54749 9.95251 7.60607 9.89393L15.5 2" stroke="#fff" stroke-width="1.2"/>
                    <path d="M15.3578 6.54654C15.6899 8.22773 15.4363 9.97195 14.6391 11.4889C13.8419 13.0059 12.5493 14.2041 10.9763 14.8842C9.40333 15.5642 7.64492 15.6851 5.99369 15.2267C4.34247 14.7682 2.89803 13.7582 1.90077 12.3646C0.903508 10.9709 0.413576 9.27783 0.512509 7.56701C0.611442 5.85619 1.29327 4.23085 2.44453 2.96147C3.59578 1.6921 5.14703 0.855265 6.84009 0.590236C8.53315 0.325207 10.2659 0.64797 11.75 1.50481" stroke="#3fbd63c4" stroke-linecap="round"/>
                </svg>
                {{ session('successfully') }}
                <div class="close" id="close-alert">
                    <svg width="30" height="30" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.00009 11.9997L12.0001 5.99966" stroke="#5d6672" stroke-width="1.2"/>
                        <path d="M12 12L6 6" stroke="#5d6672" stroke-width="1.2"/>
                    </svg>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" onshow="alert()">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            <svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="10" cy="10" r="9" stroke="#fff" stroke-width="2"/>
                                <path d="M10.5 5.5C10.5 5.77614 10.2761 6 10 6C9.72386 6 9.5 5.77614 9.5 5.5C9.5 5.22386 9.72386 5 10 5C10.2761 5 10.5 5.22386 10.5 5.5Z" fill="#fff" stroke="#fff"/>
                                <path d="M10 15V8" stroke="#fff" stroke-width="2"/>
                            </svg>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
                <div class="close" id="close-alert">
                    <svg width="30" height="30" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.00009 11.9997L12.0001 5.99966" stroke="#5d6672" stroke-width="1.2"/>
                        <path d="M12 12L6 6" stroke="#5d6672" stroke-width="1.2"/>
                    </svg>
                </div>
            </div>
        @endif

        <div class="modal" id="delete">
            <div class="modal-overlay"></div>
            <div class="modal-content">
                <form method="POST" class="modal-form">
                    @csrf @method('POST')  
                    <input type="hidden" name="id_delete" id="id_delete">
                    
                    <div class="modal-header">
                        <button type="button" data-modal="close"></button>
                    </div>
    
                    <div class="modal-body">
                        <div class="modal-icon"></div>
    
                        <h2 class="modal-title">{{ __('messages.Are you sure you want to delete?') }}</h2>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" data-modal="cancel" >
                            {{ __('messages.Cancel') }}
                        </button>
        
                        <button type="submit" data-modal="submit" >
                            {{ __("messages.Delete") }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>

    <script DEFER src="{{ asset('js/fslightbox.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"> </script>

    @yield('endBody')
</body>
</html>

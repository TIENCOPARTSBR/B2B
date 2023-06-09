<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{__('messages.Administrative area')}} | {{ config('app.name') }}</title>

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
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
</head>
<body>
    <div class="app">
        <header class="header">
            <div class="container">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ url('https://encoparts.com/wp-content/uploads/2023/02/enco-site.png') }}" alt="Logo encoparts">
                </a>

                <div class="hamburguer"></div>

                <nav class="menu">
                    <ul class="list-menu">
                        <li class="item-menu">
                            <a href="{{ url('/admin') }}" class="link-menu">
                                <div class="icon-menu">
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
                        
                        <li class="item-menu">
                            <a href="{{route('direct.distributor.product.index')}}" class="link-menu">
                                <div class="icon-menu">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 5.21111L12 6L12 17.0657C12 17.477 12 17.6826 11.868 17.7533C11.7359 17.824 11.5648 17.7099 11.2226 17.4818L9.27735 16.1849C9.14291 16.0953 9.07569 16.0505 9 16.0505C8.92431 16.0505 8.85709 16.0953 8.72265 16.1849L6.27735 17.8151C6.14291 17.9047 6.07569 17.9495 6 17.9495C5.92431 17.9495 5.85709 17.9047 5.72265 17.8151L3.27735 16.1849C3.14291 16.0953 3.07569 16.0505 3 16.0505C2.92431 16.0505 2.85709 16.0953 2.72265 16.1849L0.77735 17.4818C0.435164 17.7099 0.264071 17.824 0.132035 17.7533C-1.38729e-08 17.6826 -2.28612e-08 17.477 -4.08378e-08 17.0657L-6.11959e-07 4.00001C-6.94382e-07 2.11439 -7.35594e-07 1.17158 0.585786 0.585794C1.17157 7.57818e-06 2.11438 7.53697e-06 4 7.45455e-06L15 8.88107e-06L14.6718 0.218803C13.3639 1.09073 12.71 1.5267 12.355 2.18998C12 2.85326 12 3.63921 12 5.21111Z" fill="#7E869E" fill-opacity="0.25"/>
                                        <path d="M12 3C12 1.34315 13.3431 0 15 0V0C16.6569 0 18 1.34315 18 3V5C18 5.55228 17.5523 6 17 6H12.5C12.2239 6 12 5.77614 12 5.5V3Z" fill="#c1c1c1"/>
                                        <path d="M2.5 6.5L9.5 6.5" stroke="#c1c1c1" stroke-linecap="round"/>
                                        <path d="M2.5 9.5L6.5 9.5" stroke="#c1c1c1" stroke-linecap="round"/>
                                        <path d="M2.5 12.5L8.5 12.5" stroke="#c1c1c1" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <span>{{ __('messages.Products') }}</span>
                            </a>
                        </li>
        
                        <li class="item-menu">
                            <a href="{{ route('admin.user.index') }}" class="link-menu">
                                <div class="icon-menu">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.05847 8.99999C2.02618 8.99999 2 9.02616 2 9.05846V9.05846V16C2 16.9428 2 17.4142 2.29289 17.7071C2.58579 18 3.05719 18 4 18H14C14.9428 18 15.4142 18 15.7071 17.7071C16 17.4142 16 16.9428 16 16V9.05846V9.05846C16 9.02616 15.9738 8.99999 15.9415 8.99999H14.693L14.664 9C14.5229 9.00009 14.3461 9.0002 14.1891 8.9827C13.9962 8.96121 13.7417 8.90587 13.4921 8.73288V8.73288C13.4303 8.69003 13.3475 8.68915 13.2846 8.73052C13.0516 8.88395 12.807 8.94275 12.6188 8.96915C12.3968 9.0003 12.1352 9.00014 11.9104 9L11.8672 8.99999H10.3828L10.3471 9C10.1695 9.00012 9.95366 9.00026 9.7658 8.97632V8.97632C9.33764 8.92178 9.12355 8.8945 9.12073 8.89416C8.67862 8.84039 9.32138 8.84039 8.87927 8.89416C8.87645 8.8945 8.66236 8.92178 8.2342 8.97632V8.97632C8.04634 9.00026 7.83051 9.00012 7.65288 9L7.61722 8.99999H6.13278L6.08955 9C5.86475 9.00014 5.6032 9.0003 5.38121 8.96915C5.19302 8.94275 4.94837 8.88395 4.71535 8.73051C4.65252 8.68914 4.56972 8.69003 4.50789 8.73288V8.73288C4.25826 8.90587 4.00385 8.96121 3.81094 8.9827C3.65394 9.0002 3.47706 9.00009 3.33605 9L3.307 8.99999H2.05847ZM2.93366 7.99999C2.43742 7.99999 1.9946 7.5553 2.22166 7.11406V7.11406C2.44333 6.68332 2.8539 6.39006 3.67505 5.80352L6.67505 3.66067C7.79773 2.85875 8.35907 2.45779 9 2.45779C9.64093 2.45779 10.2023 2.85875 11.325 3.66067L14.325 5.80352C15.1461 6.39006 15.5567 6.68332 15.7783 7.11406V7.11406C16.0054 7.5553 15.5626 7.99999 15.0663 7.99999H14.693C14.3578 7.99999 14.1902 7.99999 14.0617 7.91095C13.9954 7.86503 13.9477 7.80106 13.9009 7.70682C13.8569 7.61832 13.8137 7.50313 13.7567 7.35113L13.7567 7.35111L13.5463 6.7901L13.1132 5.63511L13.1129 5.63438L13.0964 5.59039L13.0964 5.59037C12.8768 5.00475 12.767 4.71193 12.6806 4.7332C12.5943 4.75447 12.6331 5.06478 12.7107 5.6854V5.68541L12.7165 5.73204L12.7166 5.73281L12.8595 6.87595V6.87596C12.9078 7.26253 12.9383 7.50647 12.891 7.67574C12.8807 7.71271 12.8666 7.74612 12.8482 7.77667C12.8367 7.7958 12.8235 7.81382 12.8084 7.83089C12.6592 7.99999 12.3952 7.99999 11.8672 7.99999H10.3828C9.96244 7.99999 9.75227 7.99999 9.61049 7.87483C9.57506 7.84354 9.54685 7.80706 9.52366 7.7634C9.46172 7.64683 9.43554 7.47917 9.40297 7.22321L9.3905 7.12402L9.2104 5.68315L9.20476 5.63803L9.19846 5.58763C9.125 5.00002 9.08828 4.70621 9 4.70621C8.91172 4.70621 8.875 5.00002 8.80154 5.58763L8.79524 5.63803L8.7896 5.68315L8.6095 7.12402L8.59703 7.22321C8.56446 7.47917 8.53828 7.64683 8.47634 7.7634C8.45315 7.80706 8.42494 7.84354 8.38951 7.87483C8.24773 7.99999 8.03756 7.99999 7.61722 7.99999H6.13278C5.60481 7.99999 5.34083 7.99999 5.19155 7.83089C5.17649 7.81382 5.16327 7.7958 5.15176 7.77667C5.13338 7.74612 5.11933 7.71271 5.109 7.67574C5.06169 7.50647 5.09218 7.26253 5.1405 6.87597L5.1405 6.87595L5.2834 5.73281L5.28349 5.73204L5.28932 5.68542L5.28932 5.68541L5.28932 5.6854C5.3669 5.06478 5.40569 4.75447 5.31935 4.7332C5.23302 4.71193 5.12321 5.00475 4.9036 5.59039L4.8871 5.63438L4.88683 5.63511L4.45371 6.7901L4.24333 7.35111C4.18633 7.50312 4.14313 7.61831 4.09914 7.70682C4.05229 7.80106 4.00456 7.86503 3.9383 7.91095C3.80982 7.99999 3.64221 7.99999 3.307 7.99999H2.93366Z" fill="#7E869E" fill-opacity="0.25"/>
                                        <path d="M1.62127 1.51493C1.80316 0.787369 1.8941 0.423589 2.16536 0.211795C2.43663 0 2.8116 0 3.56155 0H14.4384C15.1884 0 15.5634 0 15.8346 0.211795C16.1059 0.423589 16.1968 0.787369 16.3787 1.51493L17.8447 7.37873C17.9162 7.66471 17.9519 7.80771 17.8769 7.90385C17.8018 8 17.6544 8 17.3596 8H14.744C14.3856 8 14.2064 8 14.0736 7.90115C13.9407 7.80229 13.8892 7.63064 13.7862 7.28735L13.0975 4.99155C12.8809 4.26969 12.7726 3.90876 12.6835 3.92642C12.5944 3.94407 12.6319 4.31902 12.7069 5.06892L12.89 6.9005C12.9414 7.41417 12.9671 7.67101 12.8182 7.8355C12.6694 8 12.4112 8 11.895 8H10.405C9.97489 8 9.75984 8 9.61699 7.87073C9.47415 7.74145 9.45275 7.52747 9.40995 7.0995L9.19901 4.99008C9.12667 4.26668 9.0905 3.90499 9 3.90499C8.9095 3.90499 8.87333 4.26668 8.80099 4.99007L8.59005 7.0995C8.54725 7.52747 8.52585 7.74145 8.38301 7.87073C8.24016 8 8.02511 8 7.59501 8H6.10499C5.58875 8 5.33064 8 5.18177 7.8355C5.0329 7.67101 5.05858 7.41417 5.10995 6.9005L5.29311 5.06892C5.3681 4.31902 5.40559 3.94407 5.31648 3.92642C5.22737 3.90876 5.11909 4.26969 4.90254 4.99155L4.2138 7.28735C4.11081 7.63064 4.05931 7.80229 3.92645 7.90115C3.79359 8 3.61438 8 3.25597 8H0.640388C0.345604 8 0.198212 8 0.123143 7.90385C0.0480735 7.80771 0.0838213 7.66471 0.155317 7.37873L1.62127 1.51493Z" fill="#c1c1c1"/>
                                        <path d="M9.5 12H8.5C7.39543 12 6.5 12.8954 6.5 14V17.85C6.5 17.9328 6.56716 18 6.65 18H11.35C11.4328 18 11.5 17.9328 11.5 17.85V14C11.5 12.8954 10.6046 12 9.5 12Z" fill="#c1c1c1"/>
                                    </svg>
                                </div>
                                <span>{{ __('messages.Admin users') }}</span>
                            </a>
                        </li>
        
                        <li class="item-menu">
                            <a href="{{ route('admin.direct.distributor.index') }}" class="link-menu">
                                <div class="icon-menu">
                                    <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 4.3C2 4.15858 2 4.08787 2.04393 4.04393C2.08787 4 2.15858 4 2.3 4H17.7C17.8414 4 17.9121 4 17.9561 4.04393C18 4.08787 18 4.15858 18 4.3V10C18 11.8856 18 12.8284 17.4142 13.4142C16.8284 14 15.8856 14 14 14H6C4.11438 14 3.17157 14 2.58579 13.4142C2 12.8284 2 11.8856 2 10V4.3Z" fill="#7E869E" fill-opacity="0.25"/>
                                        <path d="M0 2C0 0.895431 0.895431 0 2 0H18C19.1046 0 20 0.895431 20 2C20 2.55228 19.5523 3 19 3H1C0.447716 3 0 2.55228 0 2Z" fill="#7E869E" fill-opacity="0.25"/>
                                        <rect x="7" y="7" width="6" height="1" rx="0.5" fill="#222222"/>
                                    </svg>
                                </div>
                                <span>{{ __('messages.Direct Distributor') }}</span>
                            </a>
                        </li>

                        <li class="item-menu">
                            <a href="{{ route('admin.config.index') }}" class="link-menu">
                                <div class="icon-menu">
                                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1361 1.36144C12.0928 0.927766 12.0711 0.710929 11.9838 0.541611C11.8728 0.326558 11.6877 0.159016 11.4627 0.0700478C11.2855 0 11.0676 0 10.6318 0H9.3681C8.93238 0 8.71453 0 8.53741 0.0700092C8.31231 0.158981 8.12712 0.326575 8.01619 0.541704C7.9289 0.710983 7.90722 0.927757 7.86387 1.36131C7.78181 2.18195 7.74077 2.59227 7.56907 2.81742C7.35113 3.10319 6.99661 3.25003 6.64044 3.20207C6.35982 3.16427 6.04061 2.9031 5.4022 2.38076C5.06481 2.10472 4.89612 1.9667 4.71463 1.90872C4.48414 1.8351 4.23478 1.84753 4.01277 1.94373C3.83795 2.01947 3.68385 2.17357 3.37565 2.48177L2.48233 3.37509C2.17403 3.68339 2.01988 3.83754 1.94413 4.01243C1.848 4.23438 1.83557 4.48364 1.90914 4.71405C1.96711 4.89561 2.10516 5.06435 2.38128 5.40182C2.90385 6.04052 3.16514 6.35987 3.20287 6.64066C3.2507 6.99664 3.10395 7.35092 2.81842 7.56881C2.59319 7.74068 2.18264 7.78173 1.36155 7.86384C0.92777 7.90722 0.710878 7.92891 0.541523 8.01628C0.326541 8.12719 0.15905 8.31226 0.0700841 8.53721C0 8.71442 0 8.9324 0 9.36835V10.6318C0 11.0676 0 11.2855 0.0700471 11.4627C0.159016 11.6877 0.326558 11.8728 0.541612 11.9838C0.71093 12.0711 0.927764 12.0928 1.36143 12.1361C2.1823 12.2182 2.59273 12.2593 2.81792 12.4311C3.10357 12.649 3.25037 13.0034 3.20247 13.3594C3.16471 13.6402 2.90351 13.9594 2.3811 14.5979C2.10511 14.9352 1.96711 15.1039 1.90913 15.2854C1.8355 15.5159 1.84794 15.7652 1.94414 15.9873C2.01988 16.1621 2.17398 16.3162 2.48217 16.6243L3.37561 17.5178C3.6838 17.826 3.8379 17.9801 4.01272 18.0558C4.23474 18.152 4.4841 18.1645 4.71458 18.0908C4.89607 18.0329 5.06474 17.8949 5.40208 17.6189C6.04059 17.0964 6.35985 16.8352 6.64057 16.7975C6.99663 16.7496 7.35101 16.8964 7.56892 17.182C7.74072 17.4072 7.78176 17.8176 7.86385 18.6385C7.90722 19.0722 7.92891 19.2891 8.01624 19.4584C8.12716 19.6734 8.31228 19.841 8.53729 19.9299C8.71447 20 8.93239 20 9.36824 20H10.6316C11.0676 20 11.2856 20 11.4628 19.9299C11.6877 19.8409 11.8728 19.6735 11.9837 19.4585C12.0711 19.2891 12.0928 19.0722 12.1362 18.6383C12.2183 17.8173 12.2593 17.4068 12.4311 17.1816C12.649 16.896 13.0034 16.7492 13.3595 16.7971C13.6402 16.8348 13.9594 17.096 14.5979 17.6184C14.9352 17.8944 15.1039 18.0324 15.2854 18.0904C15.5159 18.164 15.7652 18.1516 15.9873 18.0554C16.1621 17.9796 16.3162 17.8255 16.6243 17.5174L17.5179 16.6238C17.826 16.3157 17.98 16.1617 18.0558 15.9869C18.152 15.7648 18.1645 15.5154 18.0908 15.2848C18.0328 15.1034 17.8949 14.9348 17.619 14.5976C17.0968 13.9593 16.8357 13.6402 16.7979 13.3596C16.7499 13.0034 16.8967 12.6489 17.1825 12.4309C17.4077 12.2592 17.818 12.2182 18.6386 12.1361C19.0722 12.0928 19.289 12.0711 19.4583 11.9838C19.6734 11.8729 19.841 11.6877 19.93 11.4626C20 11.2855 20 11.0676 20 10.6319V9.36824C20 8.93239 20 8.71447 19.9299 8.53729C19.841 8.31228 19.6734 8.12716 19.4584 8.01624C19.2891 7.92891 19.0722 7.90722 18.6385 7.86385C17.8176 7.78176 17.4072 7.74072 17.182 7.56893C16.8964 7.35102 16.7496 6.99662 16.7975 6.64056C16.8352 6.35984 17.0964 6.0406 17.6188 5.4021C17.8948 5.06478 18.0328 4.89612 18.0908 4.71464C18.1644 4.48415 18.152 4.23478 18.0558 4.01275C17.98 3.83794 17.8259 3.68385 17.5178 3.37567L16.6243 2.4822C16.3161 2.17402 16.162 2.01994 15.9872 1.94419C15.7652 1.84798 15.5158 1.83555 15.2853 1.90918C15.1038 1.96716 14.9352 2.10515 14.5979 2.38113C13.9594 2.90352 13.6402 3.16472 13.3595 3.20248C13.0034 3.25038 12.649 3.10358 12.4311 2.81793C12.2593 2.59274 12.2182 2.1823 12.1361 1.36144Z" fill="#7E869E" fill-opacity="0.25"/>
                                        <circle cx="10" cy="10" r="3" fill="#222222"/>
                                    </svg>
                                </div>
                                <span>{{ __('messages.Settings') }}</span>
                            </a>
                        </li>
                    </ul>

                    <div class="d-flex">
                        <div class="language">
                            <button class="select">
                                @if (app()->getLocale() == 'pt')
                                    <img src="https://encoparts.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/pt-br.png" alt="BR">
                                @elseif(app()->getLocale() == 'en')
                                    <img src="https://encoparts.com/wp-content/uploads/flags/us.png" alt="EN">
                                @elseif(app()->getLocale() == 'es')
                                    <img src="{{asset('images/es.svg')}}" alt="ES">
                                @endif
                            </button>
                        
                            <div class="list">
                                @if (app()->getLocale() != 'en')
                                    <a href="{{url('/change-language/en')}}" data-src="https://encoparts.com/wp-content/uploads/flags/us.png">
                                        <img src="https://encoparts.com/wp-content/uploads/flags/us.png" alt="EN">
                                    </a>
                                @endif

                                @if (app()->getLocale() != 'pt')
                                    <a href="{{url('/change-language/pt')}}" type="submit" data-src="https://encoparts.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/pt-br.png">
                                        <img src="https://encoparts.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/pt-br.png" alt="BR">
                                    </a>                                
                                @endif

                                @if (app()->getLocale() != 'es')
                                    <a href="{{url('/change-language/es')}}" type="submit" data-src="{{asset('images/es.svg')}}">
                                        <img src="{{asset('images/es.svg')}}" alt="ES">
                                    </a>
                                @endif
                            </div>
                        </div>
        
                        <form action="{{ route('admin.logout') }}" method="POST">
                            <button type="submit" class="logout">
                                @csrf
                                @method('POST')
                                <div class="icon">
                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.6325 2.54415L7.31623 0.438743C6.6687 0.222899 6 0.704869 6 1.38743V14.6126C6 15.2951 6.66869 15.7771 7.31623 15.5613L13.6325 13.4558C14.4491 13.1836 15 12.4193 15 11.5585V4.44152C15 3.58066 14.4491 2.81638 13.6325 2.54415Z" fill="#7E869E" fill-opacity="0.25"/>
                                        <path d="M8.5 5.5L11 8M11 8L8.5 10.5M11 8H1" stroke="#222222" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                {{ __('messages.Sign out') }}
                            </button>
                        </form> 
                    </div>
                </nav>
            </div>
        </header>

        <main class="main">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    
    @component('component.quotation.delete-quotation') @endcomponent

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

    @component('component.quotation.modal-delete') @endcomponent

    <script defer src="{{ asset('js/fslightbox.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"> </script>

    @yield('endBody')
</body>
</html>

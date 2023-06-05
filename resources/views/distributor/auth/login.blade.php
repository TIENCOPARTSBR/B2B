@extends('layouts.login')
@section('content')
    <section class="login">
        <div class="image">
            <img src="https://b2b.encoparts.com/app-assets/images/logo/encoparts_c.png" alt="logo">
        </div>

        <div class="container">
            <div class="card">
                <div class="group">
                    <h1 class="title mb-1"> {{__('messages.Administrative area')}} | {{__('messages.Distributor')}} </h1>

                    <div class="select-language">
                        <button class="select">
                            @if (app()->getLocale() == 'pt')
                                <img src="https://encoparts.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/pt-br.png" alt="BR">
                            @elseif(app()->getLocale() == 'en')
                                <img src="https://encoparts.com/wp-content/uploads/flags/us.png" alt="bandeira EN">
                            @elseif(app()->getLocale() == 'es')
                                <img src="{{asset('images/es.svg')}}" alt="ES">
                            @endif
                        </button>
                    
                        <div class="list">
                            @if (app()->getLocale() !== 'en')
                                <a href="http://127.0.0.1:8000/change-language/en" data-src="https://encoparts.com/wp-content/uploads/flags/us.png">
                                    <img src="https://encoparts.com/wp-content/uploads/flags/us.png" alt="EN">
                                </a>
                            @endif

                            @if (app()->getLocale() !== 'pt')
                                <a href="http://127.0.0.1:8000/change-language/pt" type="submit" data-src="https://encoparts.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/pt-br.png">
                                    <img src="https://encoparts.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/pt-br.png" alt="BR">
                                </a>
                            @endif

                            @if (app()->getLocale() !== 'es')
                                <a href="http://127.0.0.1:8000/change-language/es" type="submit" data-src="{{asset('images/es.svg')}}">
                                    <img src="{{asset('images/es.svg')}}" alt="ES">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <form action="{{route('distributor.distributor.login.store')}}" method="POST">
                    @csrf
                    @method('POST')      

                    <div class="group">
                        <label class="form-label" for="mail">{{ __('messages.Email Address') }}</label>
                        <input class="form-control" autocomplete="true" type="mail" name="mail" placeholder="info@encoparts.com">
                    </div>

                    <div class="group mb-1">
                        <label class="form-label" for="password">{{ __('messages.Password') }}</label>
                        <input class="form-control" type="password" name="password" placeholder="{{ __('messages.Password') }}">
                    </div>

                    <div class="group mb-1">
                        <div class="column">
                            @if(session('login'))
                                <div class="alert-login">
                                    {{ session('login') }}
                                </div>
                            @endif
                        </div>

                        <div class="column text-right">
                            <a href="" class="form-link">{{__('messages.Forgot password')}}?</a>
                        </div>
                    </div>
    
                    <input type="submit" class="form-submit" value="{{ __('messages.Sign in') }}">
                </form>
            </div>
        </div>
    </section>

    <script>
        document.querySelector('.select-language button').onclick = function(e)
        {
            document.querySelector('.select-language .list').classList.toggle('active');
            document.querySelector('.select').innerHTML(document.querySelector('.select-language .list a').data('src'));
        }
    </script>

@endsection

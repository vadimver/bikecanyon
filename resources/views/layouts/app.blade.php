<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BikeCanyon</title>
    <!-- core chosen -->
    <link rel="stylesheet" href="{{ url('chosen/docsupport/style.css') }}">
    <link rel="stylesheet" href="{{ url('chosen/docsupport/prism.css') }}">
    <link rel="stylesheet" href="{{ url('chosen/chosen.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- core CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
    <link href="{{ url('/css/font-awesome.min.css') }}" rel="stylesheet">

    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>

</head>
<body>

  @if (!isset($page))
      <?php $page="non"?>;
  @endif
    <div id="app">

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid" id="hide_search">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span>Меню</span>
                    </button>
                    <a class="navbar-brand" href="/">BikeCanyon</a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                      <li class="{{ $page == 'all' ? 'active' : '' }}"><a href="{{ url('/') }}">Все</a></li>
                      <li class="{{ $page == 'tags' ? 'active' : '' }}"><a href="{{ url('/tags') }}">Теги</a></li>
                      @if (isset(Auth::user()->id))
                      <li class="{{ $page == 'subscribe' ? 'active' : '' }}"><a href="/subscribe">Подписки</a></li>
                      @endif
                      @if (isset(Auth::user()->id))
                      <li class="{{ $page == 'list' ? 'active' : '' }}"><a href="/list">Профили</a></li>
                      @endif
                      @if (isset(Auth::user()->id))
                      <li class="{{ $page == 'add_publication' ? 'active' : '' }}"><a href="/add_publication">Добавить публикацию</a></li>
                      @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->

                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu drop-main-menu" role="menu">
                                    <li><a href="{{ url('/settings') }}"><i class="fa fa-cog" aria-hidden="true"></i> Настройки</a></li>
                                    <li><a href="{{ url('/my_profiles') }}"><i class="fa fa-users" aria-hidden="true"></i> Мои профили</a></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                          <i class="fa fa-user-times" aria-hidden="true"></i>  Выход
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                </ul>

                            </li>

                        @endif
                    </ul>
                    <button @click="show = !show" class="btn btn-primary btn-sm navbar-right btn-nav"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
                  <form v-if="show" action="{{ url('/') }}" method="POST" class="navbar-form nav-search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" name="search" class="form-control" placeholder="Поиск">
                  </form>
            </div>
        </nav>

        <div class="all_content">
        @yield('content')
        </div>
    </div>


    <footer class="footer">
       <div class="container">
         <p class="text-muted">Place sticky footer content here.</p>
       </div>
    </footer>
    <!-- Bootstrap core JavaScript -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/vue_scripts.js" type="text/javascript"></script>
    <script src="/chosen/chosen.jquery.js" type="text/javascript"></script>
    <script src="/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/chosen_script.js" type="text/javascript"></script>

    <script src="/js/app.js"></script>
    <script src="/js/bike.js"></script>



</body>
</html>

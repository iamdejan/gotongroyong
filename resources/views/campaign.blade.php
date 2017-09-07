<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $campaign->title }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('public/css/app.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('public/css/blog-post.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Gotong Royong</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    @auth
                        <li><a href="{{ route('home') }}">Dashboard</a></li>
                        <li><a href="{{ route('mulai') }}">Mulai</a></li>
                        <li><a href="{{ route('ubah') }}">Ubah</a></li>
                        <li><a href="{{ route('sumbangan') }}">Sumbangan</a></li>
                        <li><a href="{{ route('refill') }}">Isi Saldo</a></li>
                    @endauth
                    <li><a href="{{ route('profil') }}">Profil Kami</a></li>
                    <li><a href="{{ route('kontak') }}">Hubungi Kami</a></li>
                    @auth
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @else
                        <li><a href="{{ url('/login') }}">Masuk</a></li>
                        <li><a href="{{ url('/register') }}">Daftar</a></li>
                    @endauth
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{ $campaign->title }}</h1>

                 
                <p class="lead">
                    Oleh: {{ $username }}
                </p>

                <hr>
                <!--<hr>-->

                <!-- Post Content -->
                @if(isset($message))
                    <p>{!! $message !!}</p>
                @endif
                
                <p>Waktu: {{ $campaign->updated_at }}<br /></p>
                <p>{{ $campaign->story }}</p>
                <p>Dana yang Diperlukan: {{ showMoney($campaign->actual_fund) }}</p>
                <p>Dana yang Terkumpul: {{ showMoney($campaign->collected) }}</p>

                <form method="post" action="{{ url('/project').'/'.$campaign->id.'/donate' }}">
                    {{ csrf_field() }}
                    Masukkan jumlah donasi Anda:
                    <input type="input" name="amount">
                    <button type="submit" class="btn btn-primary">Donasi</button>
                </form>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Tinggalkan Komentar:</h4>
                    <form role="form" method="post" action="{{ url('/project').'/'.$campaign->id }}">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                @foreach($campaign->comments as $comment)
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading">{{ $comment->fullname }}
                                <small>{{ $comment->updated_at }}</small>
                            </h4>
                            {{ $comment->content }}
                        </div>
                    </div>
                @endforeach

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="{{ url('public/js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('public/js/app.js') }}"></script>

</body>

</html>

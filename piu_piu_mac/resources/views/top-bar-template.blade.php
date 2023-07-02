<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="{{ url('favicon.ico') }}">
    <title>@yield('title')</title>


    <!--Eshopper shit-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{asset('/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('/css/style2.css')}}" rel="stylesheet">
    <link href="{{asset('/css/style3.css')}}" rel="stylesheet">
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">
    @yield('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/045d1ece88.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

@php
    use App\Models\Favorite;
    use App\Http\Controllers\FavoritesController;
    use App\Models\Product;
@endphp

<body>
    <!-- Topbar Start -->
    <div class="container-fluid light-bg-color">
        <div class="row py-2 px-xl-5">
            <div class="col-lg-6 col-sm-6 d-block d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <span>Magazinul WowDDM se afla in development!</span>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 text-sm-right text-md-righ text-lg-right">
                <div class="align-items-center">
                    <a class="text-dark px-2" href="https://www.facebook.com/profile.php?id=100091510751869" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="https://instagram.com/wowddm_fashion_store?igshid=OGQ5ZDc2ODk2ZA==" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5" style="background-color: #110a29;">
            <div class="col-lg-3 d-none d-lg-block">
            </div>
            <div class="col-lg-6 text-center">
                <a href="{{route('home')}}" class="text-decoration-none">
                    <!--h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1-->
                    <img src="{{asset('/img/wowddm_logo2.jpg')}}" style="height: 120px;" />
                </a>
            </div>

            @guest
            <div class="col-lg-3 text-right align-self-end">
                <span class='nav-item nav-link'><a href="" class='text-on-dark-bg nav-link' data-toggle="modal" data-target="#login-button">Logare/Inregistrare</a></span>
            </div>
            
            @else

            <div class="col-lg-3 text-right align-self-end dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" style='padding-right: 3rem'>
                    <i class='fas fa-circle-user fa-fw' style='color: white'></i>
                    <span class="mr-2 d-none d-lg-inline text-gray-600" style='font-size: 1rem'>{{Auth::user()->name}}</span>
                </a>
                    <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" id='userinfo'>
                    <a class="dropdown-item" href="{{route('account')}}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profil
                    </a>
                    <a class="dropdown-item" href="{{route('cart')}}">
                        <i class="fas fa-cart-shopping mr-2 text-gray-400"></i>
                        Cosul meu
                    </a>
                    <a class="dropdown-item" href="{{route('favorites')}}">
                        <i class="fas fa-heart fa-sm fa-fw mr-2 text-gray-400"></i>
                        Favorite
                    </a>
                    <div class="dropdown-divider"></div>
                    @if(Auth::user()->is_admin)
                    <a class='dropdown-item' href="https://wowddm.ro/admin">
                        <i class='fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400'></i>
                        Admin
                    </a>
                    <div class='dropdown-divider'></div>
                    @endif
                    <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Delogheaza-te
                    </a>
                </div>
                <!--<a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-item nav-link text-on-dark-bg">Delogheaza-te</a> -->
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                @csrf
            </form>

            @endguest
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Items Start -->
    <div class="container-fluid light-bg-color">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-4">
                <nav class="navbar navbar-expand-lg navbar-light py-3 py-lg-0 px-0 d-none d-lg-block">
                    {{-- <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button> --}}
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{route('women-shop')}}" class="nav-item nav-link text-on-light-bg">Femei</a>
                            <a href="{{route('men-shop')}}" class="nav-item nav-link text-on-light-bg">Barbati</a>
                            <a href="detail.html" class="nav-item nav-link text-on-light-bg">Copii</a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-4 col-12">
                <form action="" style="margin-bottom: 0px">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cauta Produse">
                        <div class="input-group-append">
                            <a href="{{route('launch')}}"><span class="input-group-text bg-transparent">
                                <i class="fa fa-search text-on-light-bg"></i>
                            </span></a>
                        </div>
                    </div>
                </form>
            </div>

            @guest

            <div class="dri-utility col-lg-4 col-12 text-right">
                <span class="btn border" id="cart-butt">
                    <i class="fas fa-shopping-cart text-on-light-bg"></i>
                    @if(session('cart'))
                    @php
                        $totals = 0;
                        foreach(session('cart') as $id => $details) {
                            $totals = $totals + $details['quantity'];
                        }
                    @endphp
                    <span class='badge'>{{$totals}}</span>
                    @else
                    <span class="badge">0</span>
                    @endif
                    </span>
            </div>

            @else

            @php
                $fav_tot = sizeof(FavoritesController::fetch_user_favorites());
            @endphp

            <div class="dri-utility col-lg-4 col-12 text-right">
                <span class="btn border" id="fav-butt">
                    <i class="fas fa-heart text-on-light-bg"></i>
                    <span class="badge">{{$fav_tot}}</span>
                </span>
                <span class="btn border" id="cart-butt">
                    <i class="fas fa-shopping-cart text-on-light-bg"></i>
                    @if(session('cart'))
                    @php
                        $totals = 0;
                        foreach(session('cart') as $id => $details) {
                            $totals = $totals + $details['quantity'];
                        }
                    @endphp
                    <span class='badge'>{{$totals}}</span>
                    @else
                    <span class="badge">0</span>
                    @endif
                    </span>
            </div>
            @endguest
        </div>
    </div>

    <div class="container">@yield('top-bar-content')</div>


    <div class="modal fade" id="CartModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">

				<div class="dri-background modal-header" style="text-align:center">
					<h4 class="modal-title" id="myModalLabel2" style="color: white">Cosul Meu</h4>
                    <button style="color: white" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body">
              
                        @php $total = 0 @endphp
                          @if(Session::has('cart'))
                          <div style="border-bottom: 1px solid rgb(220,220,220)">
                            @foreach(session('cart') as $id => $details)
                                <div class="row" style="padding-bottom: 20px;">
                                    <div class="col-md-7 col-6" data-th="Product">
                                        <div class="row">
                                            <div class="col-md-3 col-6 hide-sm"><img src="{{ asset('/uploads/' . $details['image']) }}" class="card-img-top"/></div> 
                                            <div class="col-md-9 col-6" style="display: table; padding: 0px">
                                                <h6 class="nomargin" style="display: table-cell; vertical-align: middle;">{{ $details['name'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-md-3 col-3" class="text-center" style="display: table">
                                        <span style="display: table-cell; vertical-align: middle;">
                                        {{$details['quantity']}}x {{$details['price'] }} RON
                                        </span>
                                    </div>
                                    @php
                                        $total = $total + $details['quantity'] * $details['price'];
                                    @endphp
                                    <!--<td data-th="Subtotal" class="text-center"></td>-->
                                    <div class="col-md-2 col-3" style="display: table">
                                        <div class="actions text-center" style="display: table-cell; vertical-align: middle;">
                                            <a href="https://wowddm.ro/delete-item/{{$id}}" class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                          </div>
                            <div class="row" style="padding-top: 30px; padding-bottom: 10px;">
                                <div class="col-7 pl-3 pl-md-5">
                                    <span style="color: black; font-size: 1.2rem">Total articole: {{$total}} Ron</span>
                                </div>
                                <div class="col-5" style=" text-align: center">
                                    <a href="{{route('cart')}}" style="margin: 0 auto" class="dri-background btn"> mai multe detalii</a>
                                </div>
                            </div>
                          @else
                              <h5 class='robot' style='text-align: center; padding: 3rem; padding-bottom: 10px'>Nu ai adaugat produse in cos</h5>
                          @endif

				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->


    <footer class="text-center text-lg-start text-muted bg-primary mt-3" style="background-color: #110a29!important;">
        <!-- Section: Links  -->
        <section class="">
          <div class="container text-center text-md-start pt-4 pb-4">
            <!-- Grid row -->
            <div class="row mt-3">
              <!-- Grid column -->
              <div class="col-12 col-lg-4 col-sm-12 mb-2">
                <!-- Content -->
                <a href="https://mdbootstrap.com/" target="_blank" class="text-white h2">
                  WowDDM
                </a>
                <p class="mt-1 text-white">
                  © 2023 Copyright: WowDDM.ro
                </p>
              </div>
              <!-- Grid column -->
      
              <!-- Grid column -->
              <div class="col-6 col-sm-6 col-lg-4">
                <!-- Links -->
                <h6 class="text-uppercase text-white fw-bold mb-2">
                  Magazin
                </h6>
                <ul class="list-unstyled mb-4">
                  <li>Adresa email: office@wowddm.ro</li>
                  <li>Numar de telefon:</li> 
                    <li>0747 988 237</li>
                  <li><a class="text-white-50" href="https://goo.gl/maps/41RWQNUpnTCY5XfZ6">Gaseste magazinul</a></li>
                </ul>
              </div>
              <!-- Grid column -->
      
              <!-- Grid column -->
              <div class="col-6 col-sm-6 col-lg-4">
                <!-- Links -->
                <h6 class="text-uppercase text-white fw-bold mb-2">
                  Informatii utile
                </h6>
                <ul class="list-unstyled mb-4">
                  <li><a class="text-white-50" href="#">Contact suport clienti</a></li>
                  <li><a class="text-white-50" href="#">Informatii retur</a></li>
                  <li><a class="text-white-50" href="https://wowddm.ro/anpc">Informatii ANPC</a></li>
                </ul>
              </div>
              <!-- Grid column -->
            </div>
            <!-- Grid row -->
          </div>
        </section>
        <!-- Section: Links  -->
      </footer> 
      

      <div class="modal fade" id="login-button" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cont client</h5>
    <!-- {{--                <h5 class="modal-title" id="register_modal">Creeaza un cont nou</h5>--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-6">--}}
    {{--                        <button style="float: right; width: 60%; text-align: center;" onclick="click_login()">Logare</button>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-6">--}}
    {{--                        <button style="float: left; width: 60%; text-align: center;" onclick="click_register()">Inregistrare</button>--}}
    {{--                    </div>--}}
    {{--                </div>--}} -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form method="post" action="{{route('login')}}" id="login_modal">
                            @csrf
    
                            @if(Session::has('err'))
                            <div class="row" style=" text-align: center; margin: 0 auto; margin-bottom: 1rem; width: 80%; background-color: white; border-radius: 10px; border: 1px solid red; padding: 5px">
                                <div class="col-12">
                                    <p class="text-center" style="color: gray; margin: 0px;">{{Session::get('err')}}</p>
                                </div>
                            </div>
                            @endif
    
                            <div class="form-group row">
                                <label for="login_email" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input id="login_email" type="email" name="email" class="form-control @error('login_email') is-invalid @enderror" value="{{ old('login_email') }}" required autocomplete="email" autofocus>
    
                                    @error('login_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="login_password" class="col-md-4 col-form-label text-md-right">Parola</label>
                                <div class="col-md-6">
                                    <input id="login_password" type="password" name="password" class="form-control @error('login_password') is-invalid @enderror" value="{{ old('login_password') }}" required autocomplete="parola" autofocus>
    
                                    @error('login_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="dri-background btn btn-primary">
                                        Login
                                    </button>
    
                                    <span class='dri-color btn btn-link' id='showReg'>
                                        Inregistreaza un cont!
                                    </span>
    
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Ai uitat parola?
                                        </a>
                                    @endif
                                </div>
                            </div>
    
                        </form>
                        <form method="post" id="register_modal" action="{{route('register')}}" style="display:none">
                            @csrf
    
                            <div class="form-group row">
                                <label for="nameInput" class="col-md-4 col-form-label text-md-right">Nume: </label>
    
                                <div class="col-md-6">
                                    <input id="nameInput" type="text" class="form-control" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
    
                                    <span class="invalid-feedback" role="alert" id="nameError">
                                    <strong></strong>
                                </span>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="emailInput" class="col-md-4 col-form-label text-md-right">Email: </label>
    
                                <div class="col-md-6">
                                    <input id="emailInput" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                    <span class="invalid-feedback" role="alert" id="emailError">
                                    <strong></strong>
                                </span>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="passwordInput" class="col-md-4 col-form-label text-md-right">Parola</label>
    
                                <div class="col-md-6">
                                    <input id="passwordInput" type="password" class="form-control" name="password" required autocomplete="new-password">
    
                                    <span class="invalid-feedback" role="alert" id="passwordError">
                                    <strong></strong>
                                </span>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Parola din nou</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="dri-background btn btn-primary">
                                        Inregistreaza cont
                                    </button>
                                </div>
                            </div>
                            <p style='text-align: center;'><span class='dri-color btn btn-link' id='showLogin'>
                                        Ai deja cont? Logheaza-te!
                            </span>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::check())
    @php
        $favorites = FavoritesController::fetch_user_favorites();
        //$favorites = array();
    @endphp

    <div class="modal fade" id="FavModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">

				<div class="dri-background modal-header" style="text-align:center">
					<h4 class="modal-title" id="myModalLabel2" style="color: white">Produse Salvate</h4>
                    <button style="color: white" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body">
              
                          @if(sizeof($favorites) > 0)
                          <div>
                            @foreach($favorites as $favorite)

                                @php
                                    $product = Product::find($favorite->id_Product);
                                @endphp

                                <div class="row" style="padding-bottom: 20px;">
                                    <div class="col-lg-7 col-6" data-th="Product">
                                        <div class="row">
                                            <div class="col-md-3 col-6 hide-sm"><img src="{{ asset('/uploads/' . $product->image) }}" class="card-img-top"/></div> 
                                            <div class="col-md-9 col-6" style="display: table; padding: 0px">
                                                <h6 class="nomargin" style="display: table-cell; vertical-align: middle;">{{ $product->name }}</h6>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-3 col-3" class="text-center" style="display: table">
                                        <span style="display: table-cell; vertical-align: middle;">
                                        @if($product->discount != 0)
                                        {{apply_discount($product->price, $product->discount)}} RON
                                        @else
                                        {{$product->price }} RON
                                        @endif
                                        </span>
                                    </div>
                                    <!--<td data-th="Subtotal" class="text-center"></td>-->
                                    <div class="col-lg-2 col-3" style="display: table">
                                        <div class="actions text-center" style="display: table-cell; vertical-align: middle;">
                                            <a href="{{route('delete_product_from_fav', ['id' => $favorite->id])}}" class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                          </div>
                          @else
                              <h5 class='robot' style='text-align: center; padding: 3rem; padding-bottom: 10px'>Nu ai adaugat produse in wishlist</h5>
                          @endif

				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal fav -->

    @endif
    
    
    <script>
        var login = document.getElementById("login_modal");
        var register = document.getElementById("register_modal");
    
        document.getElementById('showLogin').onclick = function() {
            login.style.display = "block";
            register.style.display = "none";
        }
    
        document.getElementById('showReg').onclick = function() {
            login.style.display = "none";
            register.style.display = "block";
        }
    </script>

@if(Session::has('err'))
<script>

    $(function() {
        $('#login-button').modal({
            show: true
        });
    });

</script>
@endif



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    @yield('scripts')

    <script>

        @if(Auth::check())
        var userdd = document.getElementById('userinfo');

        document.getElementById('userDropdown').onclick = function() {
            if(userdd.style.display === 'none' || userdd.style.display === '') {
                userdd.style.display = 'block';
            }else {
                userdd.style.display = 'none';
            }
        }
        @endif

        $('#cart-butt').on('click', function() {
            $('#CartModal').modal({
                show: true
            });
        });

        $("#CartModal").on('shown.bs.modal', function() {
            var val = 1.2;
            //alert(1);

            $('.dri-img-cart').each(function() {
                $(this).height(val * $(this).width());
                //alert($(this).width());
            });
        });

        $('#fav-butt').on('click', function() {
            $('#FavModal').modal({
                show: true
            });
        });

    </script>

</body>

</html>
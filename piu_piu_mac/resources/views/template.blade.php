<!DOCTYPE html>
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

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{asset('/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style2.css" rel="stylesheet">
    <link href="css/style3.css" rel="stylesheet">
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/045d1ece88.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">

    @yield('styles')
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
            <div class="col-lg-6 col-6 d-block d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <span>Magazinul WowDDM se afla in development!</span>
                </div>
            </div>
            <div class="col-lg-6 col-6 text-sm-right text-right text-lg-right" style="display:table">
                <div class="align-items-center">
                    <a class="text-dark px-2" style="vertical-align: middle" href="https://www.facebook.com/profile.php?id=100091510751869" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" style="vertical-align: middle" href="https://instagram.com/wowddm_fashion_store?igshid=OGQ5ZDc2ODk2ZA==" target="_blank">
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
                    <img src="img/wowddm_logo2.jpg" style="height: 120px;" />
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

    @php
        use App\Models\Categories;

        $categories = Categories::all();
    @endphp

    <!-- Navbar Items Start -->
    <div class="container-fluid light-bg-color">

        <div class="row py-1 d-lg-none mb-2">
            <div class="col-7 dri-utility">

                
                    <a class="dri-cat-btn btn shadow-none d-flex align-items-center justify-content-between text-white w-100" data-toggle="collapse" href="#navbar-vertical-smol" style="height: 65px; margin-top: -1px; padding: 0 30px; background-color: #110a29;">
                        <h6 class="m-0" style="color: #f3f6fb" ;>Categorii</h6>
                        <i class="fa fa-angle-down" style="color: #f3f6fb"></i>
                    </a>
                    <nav class="dri-categories collapse navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical-smol">
                        <div class="navbar-nav w-100 overflow-hidden">
                            @foreach ($categories as $category)
                            <span id="{{$category->id}}" style="cursor: pointer!important" class="selCat nav-item nav-link text-on-light-bg">{{$category->name}}</span>
                            @endforeach
                        </div>
                    </nav>
                

            </div>
            <div class="dri-utility col-5 text-right">

                @guest
                <span class="btn border" id="cart-butt-smol">
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
                @else

                @php
                    $fav_tot = sizeof(FavoritesController::fetch_user_favorites());
                @endphp

                <span class="btn border" id="fav-butt-smol">
                    <i class="fas fa-heart text-on-light-bg"></i>
                    <span class="badge">{{$fav_tot}}</span>
                </span>
                <span class="btn border" id="cart-butt-smol">
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
                @endguest

            </div>
        </div>

        <div class="row align-items-center py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <nav class="navbar navbar-expand-lg navbar-light py-3 py-lg-0 px-0">
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

        <!-- Navbar Start -->
        <div class="container-fluid mb-5">
            <div class="row border-top px-xl-5">
                <div class="col-lg-3 d-lg-block d-none">
                    <a class="dri-cat-btn btn shadow-none d-flex align-items-center justify-content-between text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px; background-color: #110a29;">
                        <h6 class="m-0" style="color: #f3f6fb" ;>Categorii</h6>
                        <i class="fa fa-angle-down" style="color: #f3f6fb"></i>
                    </a>
                    <nav class="dri-categories collapse navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                        <div class="navbar-nav w-100 overflow-hidden">
                            @foreach ($categories as $category)
                            <span id="{{$category->id}}" style="cursor: pointer!important" class="selCat nav-item nav-link text-on-light-bg">{{$category->name}}</span>
                            @endforeach
                        </div>
                    </nav>
                </div>
                <div class="col-lg-9">
                    <div id="header-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" style="height: 410px;">
                                <img class="img-fluid" src="img/carousel-1.jpg" alt="Image">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">Fii la curent cu noile tendinte!</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Gama variata de articole</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" style="height: 410px;">
                                <img class="img-fluid" src="img/carousel-2.jpg" alt="Image">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">Completeaza-ti garderoba</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Cu cele mai cunoscute Branduri</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-prev-icon mb-n2"></span>
                            </div>
                        </a>
                        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-next-icon mb-n2"></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <div class="container-fluid pt-5">@yield('content')</div>

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
                                    <div class="col-lg-7 col-6" data-th="Product">
                                        <div class="row">
                                            <div class="col-lg-3 col-6 hide-sm"><img src="{{ asset('/uploads/' . $details['image']) }}" class="card-img-top"/></div> 
                                            <div class="col-lg-9 col-6" style="display: table; padding: 0px">
                                                <h6 class="nomargin" style="display: table-cell; vertical-align: middle;">{{ $details['name'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-3 col-3" class="text-center" style="display: table">
                                        <span style="display: table-cell; vertical-align: middle;">
                                        {{$details['quantity']}}x {{$details['price'] }} RON
                                        </span>
                                    </div>
                                    @php
                                        $total = $total + $details['quantity'] * $details['price'];
                                    @endphp
                                    <!--<td data-th="Subtotal" class="text-center"></td>-->
                                    <div class="col-lg-2 col-3" style="display: table">
                                        <div class="actions text-center" style="display: table-cell; vertical-align: middle;">
                                            <a href="https://wowddm.ro/delete-item/{{$id}}" class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                          </div>
                            <div class="row" style="padding-top: 30px; padding-bottom: 10px;">
                                <div class="col-7 pl-3 pl-lg-5">
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
                                        {{$product->price }} RON
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


<!-- START Bootstrap-Cookie-Alert -->
<div class="alert text-center cookiealert" role="alert">
    <b>Vrei un fursec?</b> &#x1F36A; Folosim cookies pentru a-ti asigura o experienta completa! <a style="color: aqua" href="https://cookiesandyou.com/" target="_blank">Vezi aici</a>

    <button type="button" class="dri-background btn btn-primary btn-sm acceptcookies">
        Accept
    </button>
</div>
<!-- END Bootstrap-Cookie-Alert -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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

        @if(Session::has('message'))

        $('#CartModal').modal({
            show: true
        });

        @endif

        $('#cart-butt').on('click', function() {
            $('#CartModal').modal({
                show: true
            });
        });

        $('#fav-butt').on('click', function() {
            $('#FavModal').modal({
                show: true
            });
        });

        $('#cart-butt-smol').on('click', function() {
            $('#CartModal').modal({
                show: true
            });
        });

        $('#fav-butt-smol').on('click', function() {
            $('#FavModal').modal({
                show: true
            });
        });

        $("#CartModal").on('shown.bs.modal', function() {
            var val = 1.2;
            //alert(1);

            $('.dri-img').each(function() {
                $(this).height(val * $(this).width());
                //alert($(this).width());
            });
        });

        $('.selCat').on('click', function() {
            var cat = $(this).attr('id');

            $.ajax({
                type: "POST",
                url: "{{route('set_category')}}",
                data: {"_token": "{{csrf_token()}}", 'type': cat},
                success: function(data, xhr, status) {
                    window.location.href="{{route('all-shop')}}";
                }
            });
        });

        //alert('WowDDM fashion store se afla inca in development, daca intampinati probleme nu ezitati sa ne contactati!');

    </script>

<script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js"></script>

</body>

</html>
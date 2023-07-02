@extends('template')
@section('title', 'wowddm')

@section('styles')
<link href="{{asset('/css/custom.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('/css/elegant-icons.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/css/magnific-popup.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/css/nice-select.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/css/owl.carousel.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/css/slicknav.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/css/styleshop.css')}}" type="text/css">
@endsection

<!--Navbar template-->
@section('content')

<?php

use App\Models\Product;
use App\Http\Controllers\ProductsAlgorithmController;
use App\Http\Controllers\FavoritesController;

$products_new = ProductsAlgorithmController::get_newest_products();
$products_women = ProductsAlgorithmController::get_landing_women();
$products_love = ProductsAlgorithmController::get_landing_love();
$products_des = ProductsAlgorithmController::get_landing_yes();


function apply_discount($price, $discount) {
    return $price - ($price * ($discount / 100));
}

?>

<!-- Featured Start -->
<div class="container-fluid pt-5" style='padding-top: 0px!important; padding-bottom:30px!important; border-bottom: 1px solid rgb(230,230,230)'>
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1" style=''>
            <div class="d-flex align-items-center border mb-4 perks" style="padding: 30px;border: 1px solid grey!important;">
                <h1 class="fas fa-clipboard-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Produse de calitate</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1" style=''>
            <div class="d-flex align-items-center border mb-4 perks" style="padding: 30px;border: 1px solid grey!important;">
                <h1 class="fas fa-arrow-up-right-dots text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Cele mai noi tendinte</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1" style=''>
            <div class="d-flex align-items-center border mb-4 perks" style="padding: 30px;border: 1px solid grey!important;">
                <h1 class="far fa-copyright text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Branduri cunoscute</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1" style=''>
            <div class="d-flex align-items-center border mb-4 perks" style="padding: 30px;border: 1px solid grey!important;">
                <h1 class="fas fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Retur in 14 zile</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->

<div class="site-section site-blocks-2" style='margin-bottom:30px;'>
    <div class="container">
        <h1 class='cat-header'>Articole potrivite pentru fiecare client</h1>
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
          <a class="block-2-item" href="{{route('women-shop')}}">
            <figure class="image">
              <img src="{{asset('/img/women.jpg')}}" alt="" class="img-fluid">
            </figure>
            <div class="text">
              <span class="text-uppercase">Collections</span>
              <h3>Femei</h3>
            </div>
          </a>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
          <a class="block-2-item" href="{{route('men-shop')}}">
            <figure class="image">
              <img src="{{asset('/img/children.jpg')}}" alt="" class="img-fluid">
            </figure>
            <div class="text">
              <span class="text-uppercase">Collections</span>
              <h3>Copii</h3>
            </div>
          </a>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
          <a class="block-2-item" href="{{route('kid-shop')}}">
            <figure class="image">
              <img src="{{asset('/img/men.jpg')}}" alt="" class="img-fluid">
            </figure>
            <div class="text">
              <span class="text-uppercase">Collections</span>
              <h3>Barbati</h3>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

<!-- Categories End -->


<!-- Products Start -->

<div class="text-center mb-4">
    <h2 class="section-title px-5"><span class="px-2">Produse NOI</span></h2>
</div>
<div class="row px-xl-5 pb-3">
    @foreach($products_new as $product)

    @php
    if(Auth::check()) {
        $check = FavoritesController::check_product($product->id);
    }else {
        $check = false;
    }
        //dd($check);

    @endphp

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic">
                {{-- <span class="dri-background label">Redus</span> --}}
                <a href="{{route('product-single', ['id' => $product->id])}}"><img src="{{asset('/uploads/' . $product->image)}}" class="dri-img" style="height:400px; width: 100%; text-align: center"></a>

                <ul class="product__hover">
                    @if($check)
                    <li><i class="fa-solid fa-heart" style="color: #ff0000;"></i> <span>Salvat!</span></li>
                    @else
                    <li><a href="{{route('add-prod-fav', ['id' => $product->id])}}"><i class="fa-regular fa-heart" style="color: #ff0000;"></i> <span>Salveaza</span></a>
                    </li>
                    @endif
                </ul>

            </div>
            <div class="product__item__text">
                <h6>{{$product->name}}</h6>
                <a href="{{route('addCartItem', ['id' => $product->id])}}" class="add-cart" style="color: #110a29">+ Adauga In Cos</a>
                <div class="rating">
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <h5>{{$product->price}} RON</h5>
                <div class="product__color__select">
                    <span id="{{$product->id}}" class="dri-select" style="color: #110a29; font-weight: 600; cursor: pointer">Mai multe detalii<span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Offer Start -->
<div class="container-fluid offer pt-5" style='margin-top: 30px; margin-bottom: 78px;'>
    <div class="row px-xl-5">
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                <img src="img/offer-1.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">10% Reducere</h5>
                    <h2 class="mb-4 font-weight-semi-bold text-primary">La Prima Comanda</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                <img src="img/offer-2.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">Transport Gratuit</h5>
                    <h2 class="mb-4 font-weight-semi-bold text-primary">La Comenzi peste 350 Ron</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->

<div class="text-center mb-4">
    <h2 class="section-title px-5"><span class="px-2">Produse FEMEI</span></h2>
</div>
<div class="row px-xl-5 pb-3">
    @foreach($products_women as $product)

    @php
    if(Auth::check()) {
        $check = FavoritesController::check_product($product->id);
    }else {
        $check = false;
    }
        //dd($check);

    @endphp

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic">
                <a href="{{route('product-single', ['id' => $product->id])}}"><img src="{{asset('/uploads/' . $product->image)}}" class="dri-img" style="height:400px; width: 100%; text-align: center"></a>
                <ul class="product__hover">
                    @if($check)
                    <li><i class="fa-solid fa-heart" style="color: #ff0000;"></i> <span>Salvat!</span></li>
                    @else
                    <li><a href="{{route('add-prod-fav', ['id' => $product->id])}}"><i class="fa-regular fa-heart" style="color: #ff0000;"></i> <span>Salveaza</span></a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="product__item__text">
                <h6>{{$product->name}}</h6>
                <a href="{{route('addCartItem', ['id' => $product->id])}}" class="add-cart" style="color: #110a29">+ Adauga In Cos</a>
                <div class="rating">
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <h5>{{$product->price}} RON</h5>
                <div class="product__color__select">
                    <span id="{{$product->id}}" class="dri-select" style="color: #110a29; font-weight: 600; cursor: pointer">Mai multe detalii<span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- Products End -->

<div class="text-center mb-4">
    <h2 class="section-title px-5"><span class="px-2">Brand: Desigual</span></h2>
</div>
<div class="row px-xl-5 pb-3">
    @foreach($products_des as $product)

    @php
    if(Auth::check()) {
        $check = FavoritesController::check_product($product->id);
    }else {
        $check = false;
    }
        //dd($check);

    @endphp

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic">
                <a href="{{route('product-single', ['id' => $product->id])}}"><img src="{{asset('/uploads/' . $product->image)}}" class="dri-img" style="height:400px; width: 100%; text-align: center"></a>
                <ul class="product__hover">
                    @if($check)
                    <li><i class="fa-solid fa-heart" style="color: #ff0000;"></i> <span>Salvat!</span></li>
                    @else
                    <li><a href="{{route('add-prod-fav', ['id' => $product->id])}}"><i class="fa-regular fa-heart" style="color: #ff0000;"></i> <span>Salveaza</span></a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="product__item__text">
                <h6>{{$product->name}}</h6>
                <a href="{{route('addCartItem', ['id' => $product->id])}}" class="add-cart" style="color: #110a29">+ Adauga In Cos</a>
                <div class="rating">
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <h5>{{$product->price}} RON</h5>
                <div class="product__color__select">
                    <span id="{{$product->id}}" class="dri-select" style="color: #110a29; font-weight: 600; cursor: pointer">Mai multe detalii<span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- Products End -->

<div class="text-center mb-4">
    <h2 class="section-title px-5"><span class="px-2">Brand: Calvin Klein</span></h2>
</div>
<div class="row px-xl-5 pb-3">
    @foreach($products_love as $product)

    @php
    if(Auth::check()) {
        $check = FavoritesController::check_product($product->id);
    }else {
        $check = false;
    }
        //dd($check);

    @endphp

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic">
                <a href="{{route('product-single', ['id' => $product->id])}}"><img src="{{asset('/uploads/' . $product->image)}}" class="dri-img" style="height:400px; width: 100%; text-align: center"></a>
                <ul class="product__hover">
                    @if($check)
                    <li><i class="fa-solid fa-heart" style="color: #ff0000;"></i> <span>Salvat!</span></li>
                    @else
                    <li><a href="{{route('add-prod-fav', ['id' => $product->id])}}"><i class="fa-regular fa-heart" style="color: #ff0000;"></i> <span>Salveaza</span></a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="product__item__text">
                <h6>{{$product->name}}</h6>
                <a href="{{route('addCartItem', ['id' => $product->id])}}" class="add-cart" style="color: #110a29">+ Adauga In Cos</a>
                <div class="rating">
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <h5>{{$product->price}} RON</h5>
                <div class="product__color__select">
                    <span id="{{$product->id}}" class="dri-select" style="color: #110a29; font-weight: 600; cursor: pointer">Mai multe detalii<span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- Products End -->
@endsection

<!-- Modal -->

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

@section('scripts')
<script src="{{asset('/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('/js/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('/js/jquery.slicknav.js')}}"></script>
<script src="{{asset('/js/mixitup.min.js')}}"></script>
<script src="{{asset('/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('/js/mainshop.js')}}"></script>

<script>

var val = 1.3;

    $('.dri-img').each(function() {
        $(this).height(val * $(this).width());
    });

    window.onresize = function() {
        $('.dri-img').each(function() {
            $(this).height(val * $(this).width());
        });
    }

    $(".dri-select").on('click', function() {
        var id = $(this).attr('id');

        window.location.href = "https://wowddm.ro/produs/" + id;
    })

</script>
@parent

    @if(Session::has('err'))
        <script>

            $(function() {
                $('#login-button').modal({
                    show: true
                });
            });

        </script>
    @endif

@endsection
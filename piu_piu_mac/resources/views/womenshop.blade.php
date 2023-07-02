@extends('top-bar-template')

@section('title', 'WowDDM')

@section('styles')
<link rel="stylesheet" href="{{asset('/css/elegant-icons.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/css/magnific-popup.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/css/nice-select.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/css/owl.carousel.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/css/slicknav.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/css/styleshop.css')}}" type="text/css">
@endsection

@section('top-bar-content')

@php
    use App\Http\Controllers\FavoritesController;
    use App\Models\Categories;
    use App\Http\Controllers\ProductsAlgorithmController;

    if($products->count() == 0) {
        $err = true;
    }else {
        $err = false;
    }

    $categories = Categories::all();

    if(Session::has('pref')) {
        $filter = true;
        $pref = Session::get('pref');
    }else {
        $filter = false;
    }

    if(!$err) {
        $noprod = ProductsAlgorithmController::get_women_product_number();

        if(isset($_GET['page'])) {
            $page = intval($_GET['page']);
        }else {
            $page = 1;
        }

        if($noprod % 12 == 0) {
            $pages = intval($noprod / 12);
        }else {
            $pages = intval($noprod / 12) + 1;
        }

        $start = ($page - 1) * 12 + 1;
        if($page == $pages) {
            $end = $noprod;
        }else {
            $end = 12 * $page;
        }
    }else {
        if(isset($_GET['page'])) {
            $page = intval($_GET['page']);
        }else {
            $page = 1;
        }

        $pages = 1;
    }
@endphp

<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @if(isset(Session::get('pref')['price']) || isset(Session::get('pref')['categories']) || isset(Session::get('pref')['sizes']))
                <button id="delPref" class='dri-background btn btn-primary' style="margin: 0 auto;margin-bottom: 20px; ">Elimina Filtre</button>
                @endif
                <div class="shop__sidebar">
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categorii</a>
                                </div>
                                <div id="collapseOne" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                @if($filter && isset(Session::get('pref')['categories']))
                                                @foreach($categories as $data)
                                                    @if($data->gen == '1' || $data->gen == '4')
                                                    <li id="cat_{{$data->id}}" class="selCat" @if(Session::get('pref')['categories'] == $data->id) style="color: black!important" @endif>{{$data->name}}</li>
                                                    @endif
                                                @endforeach
                                                @else
                                                @foreach($categories as $data)
                                                    @if($data->gen == '1' || $data->gen == '4')
                                                    <li id="cat_{{$data->id}}" class="selCat">{{$data->name}}</li>
                                                    @endif
                                                @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filtru Pret</a>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                @if($filter && isset(Session::get('pref')['price']))
                                                <li id="1" class='selPrice' @if(Session::get('pref')['price']['start'] == 0) style="color: black!important" @endif>0.00 Ron - 200 Ron</li>
                                                <li id="2" class='selPrice' @if(Session::get('pref')['price']['start'] == 200) style="color: black!important" @endif>200 Ron - 400 Ron</li>
                                                <li id="3" class='selPrice' @if(Session::get('pref')['price']['start'] == 400) style="color: black!important" @endif>400 Ron - 600 Ron</li>
                                                <li id="4" class='selPrice' @if(Session::get('pref')['price']['start'] == 600) style="color: black!important" @endif>600 Ron - 800 Ron</li>
                                                <li id="5" class='selPrice' @if(Session::get('pref')['price']['start'] == 800) style="color: black!important" @endif>>800 Ron</li>
                                                @else
                                                <li id="1" class='selPrice'>0.00 Ron - 200 Ron</li>
                                                <li id="2" class='selPrice'>200 Ron - 400 Ron</li>
                                                <li id="3" class='selPrice'>400 Ron - 600 Ron</li>
                                                <li id="4" class='selPrice'>600 Ron - 800 Ron</li>
                                                <li id="5" class='selPrice'>>800 Ron</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">Marime</a>
                                </div>
                                <div id="collapseFour" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__size">
                                            <label for="xs">xs
                                                <input type="radio" id="xs">
                                            </label>
                                            <label for="sm">s
                                                <input type="radio" id="sm">
                                            </label>
                                            <label for="md">m
                                                <input type="radio" id="md">
                                            </label>
                                            <label for="xl">l
                                                <input type="radio" id="xl">
                                            </label>
                                            <label for="2xl">xl
                                                <input type="radio" id="2xl">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                @if(!$err)
                                <p>Articolele {{$start}} - {{$end}} din {{ProductsAlgorithmController::get_women_product_number()}}</p>
                                @else
                                <p>Articolele 0 - 0 din 0</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sorteaza dupa pret:</p>
                                <select id="ord">
                                    @if($filter && isset(Session::get('pref')['order']))
                                    <option value="asc" @if($pref['order'] == 'asc') selected @endif>Crescator</option>
                                    <option value="desc" @if($pref['order'] == 'desc') selected @endif>Descrescator</option>
                                    @else
                                    <option value="asc">Crescator</option>
                                    <option value="desc">Descrescator</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    function apply_discount($price, $discount) {
                        return $price - ($price * ($discount / 100));
                    }
                @endphp

                <div class="row">

                    @if(!$err)

                    @foreach($products as $product)

                    @php
                    if(Auth::check()) {
                        $check = FavoritesController::check_product($product->id);
                    }else {
                        $check = false;
                    }
                        //dd($check);

                    @endphp

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic">
                                @if($product->discount != 0)
                                <span class="dri-background label">Articol Redus</span>
                                @endif
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
                                @if($product->discount != 0)
                                <h6 style="text-decoration: line-through;">{{$product->price}} RON</h6>
                                <h5>{{apply_discount($product->price, $product->discount)}} RON</h5>
                                @else
                                <h5>{{$product->price}} RON</h5>
                                @endif
                                <div class="product__color__select">
                                    <span id="{{$product->id}}" class="dri-select" style="color: #110a29; font-weight: 600; cursor: pointer">Mai multe detalii<span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col-12">
                        <h5 class="my-5" style="text-align: center">Momentan nu avem articole pe stock!</h5>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        @if(!$err)
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                              <li class="page-item @if($page == 1) disabled @endif"">
                                <a class="dri-color page-link" @if($page == 1) style="color: rgb(220,220,220)!important" @endif href="https://wowddm.ro/femei?page={{$page-1}}" tabindex="-1">Pagina anterioara</a>
                              </li>
                              <li class="page-item @if($page == $pages) disabled @endif">
                                <a class="dri-color page-link" @if($page == $pages) style="color: rgb(220,220,220)!important" @endif href="https://wowddm.ro/femei?page={{$page+1}}">Pagina urmatoare</a>
                              </li>
                            </ul>
                          </nav>
                          @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

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
var val = 1.4;

$('.dri-img').each(function() {
    $(this).height(val * $(this).width());
});

window.onresize = function() {
    $('.dri-img').each(function() {
        $(this).height(val * $(this).width());
    });
}

$('#ord').on('change', function () {
    var order = document.getElementById('ord').value;

    $.ajax({
        type: "POST",
        url: "{{route('set-ord')}}",
        data: {"_token": "{{csrf_token()}}", "order": order},
        success: function(data, xhr, status) {
            location.reload();
        }
    });

});

$('.selPrice').on('click', function() {

    var price = $(this).attr('id');

    $.ajax({
        type: "POST",
        url: "{{route('set-price')}}",
        data: {"_token": "{{csrf_token()}}", 'price': price},
        success: function(data, xhr, status) {
            location.reload();
        }
    });

});

$('.selCat').on('click', function() {
    var cat = $(this).attr('id').split("_");

    $.ajax({
        type: "POST",
        url: "{{route('set_category')}}",
        data: {"_token": "{{csrf_token()}}", 'type': cat[1]},
        success: function(data, xhr, status) {
            location.reload();
        }
    });
})

@if($filter)
$('#delPref').on('click', function() {
    $.ajax({
        type: "POST",
        url: "{{route('del_pref')}}",
        data: {"_token": "{{csrf_token()}}"},
        success: function(data, xhr, status) {
            location.reload();
        }
    });
});
@endif
</script>
@endsection
@extends('top-bar-template')

@section('title', 'WowDDM')

@section('styles')
@endsection

@section('top-bar-content')

@php
    use App\Models\Categories;
    use App\Http\Controllers\FavoritesController;

    $categories = Categories::find($product->type);
@endphp

<section class="py-5">
    <div class="container">
      <div class="row gx-5">
        <aside class="col-lg-6" style="margin-bottom: 5rem">
          <div class="border rounded-4 mb-3 d-flex justify-content-center">
            <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp">
              <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="{{asset('/uploads/' . $product->image)}}" />
            </a>
          </div>
          {{-- <div class="d-flex justify-content-center mb-3">
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big1.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big1.webp" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big2.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big2.webp" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big3.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big3.webp" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big4.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big4.webp" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp" />
            </a>
          </div> --}}
          <!-- thumbs-wrap.// -->
          <!-- gallery-wrap .end// -->
        </aside>
        <main class="col-lg-6">
          <div class="ps-lg-3" style="padding-left: 1rem">
            <h4 class="title text-dark">
              {{$product->name}}
            </h4>
            <div class="d-flex flex-row my-3">
              {{-- <div class="text-warning mb-1 me-2">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span class="ms-1">
                  4.5
                </span>
              </div>
              <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>154 orders</span> --}}
              @if($product->visible == '1')
                <span class="text-success ms-2">
                    In stock
                </span>
              @else
              <span class="text-danger ms-2">
                Produsul nu este in stock
            </span>
              @endif
            </div>
  
            <div class="mb-3">
              @if($product->discount > 0)
              <span class="h5">{{$product->price - ($product->price * ($product->discount / 100))}} RON</span>
              <span class="h6 text-muted ml-2"><del>{{$product->price}} RON</del></span>
              <span class="h6 ml-2">({{$product->discount}}% off)</span>
              @else
              <span class="h5">{{$product->price}} RON</span>
              @endif
            </div>
  
            <p>
              {{$product->description}}
            </p>
  
            <div class="row">
              <dt class="col-3">Tip:</dt>
              <dd class="col-9">{{$categories->name}}</dd>
  
              <dt class="col-3">Marime</dt>
              <dd class="col-9">{{$product->size}}</dd>
  
              <dt class="col-3">Material</dt>
              <dd class="col-9">{{$product->material}}</dd>
  
              <dt class="col-3">Brand</dt>
              <dd class="col-9">{{$product->brand}}</dd>
            </div>
  
            <hr />
  
            {{-- <div class="row mb-4">
              <div class="col-md-12 col-12">
                <label class="mb-2" style="font-size: 18px"><b>Marimi disponibile: </b></label>
                @if($product->XS == '1')
                <label class="radio-inline" style="margin-left: 20px">
                    <input type="radio" name="optradio">  XS
                  </label>
                @endif
                @if($product->S == '1')
                  <label class="radio-inline" style="margin-left: 10px">
                    <input type="radio" name="optradio">  S
                  </label>
                @endif
                @if($product->M == '1')
                  <label class="radio-inline" style="margin-left: 10px">
                    <input type="radio" name="optradio">  M
                  </label>
                @endif
                @if($product->L == '1')
                  <label class="radio-inline" style="margin-left: 10px">
                    <input type="radio" name="optradio">  L
                  </label>
                @endif
                @if($product->XL == '1')
                  <label class="radio-inline" style="margin-left: 10px">
                    <input type="radio" name="optradio">  XL
                  </label>
                @endif
              </div>
              <!-- col.// -->
            </div> --}}
            <div style="margin-top: 40px">
            <a style=" background-color: #110a29; color: white; border: 0px;" href="https://wowddm.ro/add-item/{{$product->id}}" class="btn btn-primary mb-2 mb-lg-0 shadow-0"> <i class="me-1 fa fa-shopping-basket"></i> Adauga in cos </a>
            @guest
            <a style="" href="{{route('add-prod-fav', ['id' => $product->id])}}" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa-regular fa-heart fa-lg"></i> Salveaza </a>
            @else
            @if(FavoritesController::check_product($product->id))
            <span style="" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa-solid fa-heart fa-lg"></i> Articol Salvat </span>
            @else
            <a style="" href="{{route('add-prod-fav', ['id' => $product->id])}}" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa-regular fa-heart fa-lg"></i> Salveaza </a>
            @endif
            @endguest

            @if(Auth::check())
            @if(Auth::user()->is_admin)
            <a href="{{route('admin-product-single', ['id' => $product->id])}}" class="btn btn-primary shadow-0" style="margin-top:20px; border: 0px; background-color: #110a29; color: white">Editeaza produs</a>
            @endif
            @endif
            </div>
          </div>
        </main>
      </div>
    </div>
  </section>
  <!-- content -->
  
  <section class="bg-light border-top py-4">
    <div class="container">
      <div class="row gx-4">
        <div class="col-lg-12 mb-4">
          <div class="border rounded-2 px-3 py-2 bg-white">
            <!-- Pills navs -->
            {{-- <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
              <li class="nav-item d-flex" role="presentation">
                <a class="nav-link d-flex align-items-center justify-content-center w-100 active" id="ex1-tab-1" data-mdb-toggle="pill" href="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1" aria-selected="true">Specification</a>
              </li>
            </ul> --}}

            <div class="col-lg-4 col-sm-12" style='background-color: #110a29; border-radius: 7px; text-align: center; padding: 5px'>
                <span style=' color: white; font-size: 20px'>Descriere produs</span>
            </div>

            <!-- Pills navs -->
  
            <!-- Pills content -->
            <div class="tab-content" id="ex1-content" style="margin-top: 20px;">
              <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                <p>
                  {{$product->full_description}}
                </p>
              </div>
            </div>
            <!-- Pills content -->
          </div>
        </div>
        {{-- <div class="col-lg-4">
          <div class="px-0 border rounded-2 shadow-0">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title" style='margin-bottom: 25px'>Se potriveste cu: </h5>
                <div class="d-flex mb-3">
                  <a href="#" class="me-3">
                    <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/8.webp" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                  </a>
                  <div class="info">
                    <a href="#" class="nav-link mb-1">
                      Rucksack Backpack Large <br />
                      Line Mounts
                    </a>
                    <strong class="text-dark"> $38.90</strong>
                  </div>
                </div>
  
                <div class="d-flex mb-3">
                  <a href="#" class="me-3">
                    <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/9.webp" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                  </a>
                  <div class="info">
                    <a href="#" class="nav-link mb-1">
                      Summer New Men's Denim <br />
                      Jeans Shorts
                    </a>
                    <strong class="text-dark"> $29.50</strong>
                  </div>
                </div>
  
                <div class="d-flex mb-3">
                  <a href="#" class="me-3">
                    <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/10.webp" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                  </a>
                  <div class="info">
                    <a href="#" class="nav-link mb-1"> T-shirts with multiple colors, for men and lady </a>
                    <strong class="text-dark"> $120.00</strong>
                  </div>
                </div>
  
                <div class="d-flex">
                  <a href="#" class="me-3">
                    <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/11.webp" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                  </a>
                  <div class="info">
                    <a href="#" class="nav-link mb-1"> Blazer Suit Dress Jacket for Men, Blue color </a>
                    <strong class="text-dark"> $339.90</strong>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
  </section>
  
    
@endsection

@section('scripts')
@if(Session::has('success'))
<script>
    $(function() {
        $('#CartModal').modal({
            show: true
        });
    });
</script>
@endif
@endsection
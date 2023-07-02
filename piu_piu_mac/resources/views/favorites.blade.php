@extends('template-top-bar')
@section('title', 'Favorite')

@section('styles')
<link rel="stylesheet" href="{{asset('/css/demo.css')}}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
@endsection

@section('section-title', 'Sectiune Clienti')

@section('top-bar-content')

@php
    use App\Models\Favorite;
    use App\Http\Controllers\FavoritesController;
    use App\Models\Product;

    $favorites = FavoritesController::fetch_user_favorites();

    function apply_discount($price, $discount) {
        return $price - ($price * ($discount / 100));
    }
@endphp

<div class="container-xxl flex-grow-1 container-p-y" style='margin-top: 5rem; margin-bottom: 5rem'>
    {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> --}}

    <div class="row">
      <div class="col-md-8">
        @if(Auth::check())
        <ul class="nav nav-pills mb-3 row">
            <li class="nav-item col-3" style="text-align: center">
              <a class="nav-link" href="{{route('account')}}" style="color:#110a29"><i class="bx bx-user me-1"></i> Setari Cont</a>
            </li>
            <li class="nav-item col-3" style="text-align: center">
              <a class="nav-link" href="{{route('cart')}}" style="color: #110a29"
                ><i class="bx bx-bell me-1"></i> Cos</a
              >
            </li>
            <li class="nav-item col-3" style="text-align: center">
              <a class="nav-link active" href="{{route('favorites')}}" style="background-color:#110a29"
                ><i class="bx bx-link-alt me-1"></i> Favorite</a
              >
            </li>
            <li class="nav-item col-3" style="text-align: center">
              <a class="nav-link" href="{{route('orders-client')}}" style="color:#110a29"
                ><i class="bx bx-link-alt me-1"></i> Comenzi</a
              >
            </li>
          </ul>
        @endif
      </div>
    </div>
    <div class="row">
        <div class="col-12">
        <div class="card mb-4">
          <h5 class="card-header">Produse salvate</h5>
          <!-- Account -->
          <hr class="my-0" />
          <div class="card-body">
            @if(sizeof($favorites) > 0)
            <table id="cart" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="w-50">Produs</th>
                        <th>Pret</th>   
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($favorites as $details)

                    @php
                        $product = Product::find($details->id_Product);
                    @endphp

                        <tr rowId="{{ $details->id }}">
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-3 hidden-xs"><img src="{{ asset('/uploads/' . $product->image) }}" class="card-img-top"/></div> 
                                    <div class="col-sm-9">
                                        <h6 class="nomargin">{{ $product->name }}</h6>
                                    </div>
                                </div>
                            </td>

                            <td data-th="Price" class="text-center">
                                <div style="margin-top: 15px;">
                                    @if($product->discount != 0)
                                    {{ apply_discount($product->price, $product->discount) }} RON
                                    @else
                                    {{$product->price}} RON
                                    @endif
                                </div>
                            </td>
                            
                            <!--<td data-th="Subtotal" class="text-center"></td>-->
                            <td class="actions text-center">
                                <a href="{{route('delete_product_from_fav', ['id' => $details->id])}}" class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <!--tfoot>
                    <tr>
                        <td colspan="5" class="text-right">
                            <a href="{{ route('home') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Inapoi la magazin</a>
                            <button class="btn btn-danger">Checkout</button>
                        </td>
                    </tr>
                </tfoot-->
            </table>
            @else
                <h5 class='robot' style='text-align: center; padding: 3rem; padding-bottom: 10px'>Nu ai adaugat produse in wishlist</h5>
            @endif
          </div>
          <!-- /Account -->
        </div>
      </div>
    </div>
  </div>

@endsection
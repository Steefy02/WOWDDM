@extends('template-top-bar')
@section('title', 'Contul Meu')

@section('styles')

<link rel="stylesheet" href="{{asset('/css/demo.css')}}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">

@endsection

@section('section-title', 'Plaseaza Comanda')

@section('top-bar-content')

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
            <a class="nav-link active" href="{{route('cart')}}" style="background-color: #110a29"
              ><i class="bx bx-bell me-1"></i> Cos</a
            >
          </li>
          <li class="nav-item col-3" style="text-align: center">
            <a class="nav-link" href="{{route('favorites')}}" style="color:#110a29"
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
      <div class="col-md-8">
        <div class="card mb-4">
          <h5 class="card-header">Produse in cos</h5>

          @php $total = 0 @endphp

          <!-- Account -->
          <hr class="my-0" />
          <div class="card-body">
            @if(Session::has('cart'))
            <table id="cart" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="w-50">Produs</th>
                        <th>Pret</th>   
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                        @foreach(session('cart') as $id => $details)
                            <tr rowId="{{ $id }}">
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-3 hidden-xs"><img src="{{ asset('/uploads/' . $details['image']) }}" class="card-img-top"/></div> 
                                        <div class="col-sm-9">
                                            <h6 class="nomargin">{{ $details['name'] }}</h6>
                                        </div>
                                    </div>
                                </td>

                                <td data-th="Price" class="text-center">
                                    <div>
                                        <button class="btn" id="{{$id}}_dec" onclick="upd(this)"><</button>
                                        <span id=''>{{ $details['quantity'] }}</span>
                                        <button class="btn" id="{{$id}}_inc" onclick="upd(this)">></button>
                                    </div>
                                    <div style="margin-top: 15px;">
                                        {{ $details['quantity'] * $details['price'] }} RON
                                    </div>
                                    @php
                                        $total = $total + $details['quantity'] * $details['price'];
                                    @endphp
                                </td>
                               
                                <!--<td data-th="Subtotal" class="text-center"></td>-->
                                <td class="actions text-center">
                                    <a href="https://wowddm.ro/delete-item/{{$id}}" class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-trash-o"></i></a>
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
                <h5 class='robot' style='text-align: center; padding: 3rem; padding-bottom: 10px'>Nu ai adaugat produse in cos</h5>
            @endif
          </div>
          <!-- /Account -->
        </div>
        <div class="row">
        <div class="col-md-6">
        <form class="mb-5" action="">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control p-4" placeholder="Cod Coupon">
                <div class="input-group-append">
                    <button class="btn btn-primary" style='letter-spacing:1px; color:white; background-color: #110a29'>Aplica Coupon</button>
                </div>
            </div>
        </form>
        </div>
        </div>
    </div>

    <div class="col-md-4">

        <div class="card border-secondary mb-4">
            <div class="card-header bg-secondary border-0">
                <h4 class="font-weight-semi-bold m-0">Totalul comenzii</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 pt-1">
                    <h6 class="font-weight-medium">Subtotal</h6>
                    <h6 class="font-weight-medium">{{$total}} RON</h6>
                </div>
                <div class="d-flex justify-content-between">
                    <h6 class="font-weight-medium">Livrare</h6>
                    <h6 class="font-weight-medium">0.00 Lei</h6>
                </div>
            </div>
            <div class="card-footer border-secondary bg-transparent">
                <div class="d-flex justify-content-between mt-2">
                    <h5 class="font-weight-bold">Total</h5>
                    <h5 class="font-weight-bold">{{$total}} RON</h5>
                </div>
                @if($total > 0)
                <a href="{{route('checkout')}}"><button class="btn btn-block btn-primary my-3 py-3" style='letter-spacing: 1px; color:white; background-color: #110a29'>Catre Checkout</button></a>
                @else
                <a href="{{route('home')}}""><button class="btn btn-block btn-primary my-3 py-3" style='letter-spacing: 1px; color:white; background-color: #110a29'>Catre Magazin</button></a>
                @endif
            </div>
        </div>

      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>

// $('#del').click(function (e) {
    
//     $.ajax({
//         url: "{{route('deleteCartItem', ['id' => 2])}}",
//         method: "DELETE",
//         data: {
//             _token: "{{csrf_token()}}"
//         },
//         success: function (data) {
//             window.location.reload();
//         }
//     });

// });

function upd(elem) {
    var stuff = elem.id.split("_");
    var quan = elem.parentNode.children[1].innerHTML;
    if(stuff[1] == 'dec' && quan == 1) {
        alert('cannot');
    }else {
        $.ajax({
            url: "{{route('testUpd')}}",
            method: "POST",
            data: {
                _token: "{{csrf_token()}}",
                id: stuff[0],
                met: stuff[1]
            },
            success: function (data) {
                window.location.reload();
            }
        });
    }
}

</script>
@endsection
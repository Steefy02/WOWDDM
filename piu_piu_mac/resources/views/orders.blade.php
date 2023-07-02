@extends('template-top-bar')
@section('title', 'Favorite')

@section('styles')
<link rel="stylesheet" href="{{asset('/css/demo.css')}}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
@endsection

@section('section-title', 'Comenzile mele')

@section('top-bar-content')

<div class="container-xxl flex-grow-1 container-p-y" style='margin-top: 5rem; margin-bottom: 5rem'>
    {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> --}}

    <div class="row">
      <div class="col-md-8">
        @if(Auth::check())
        <ul class="nav nav-pills mb-3 row">
            <li class="nav-item col-3" style="text-align: center">
              <a class="nav-link " href="{{route('account')}}" style="color:#110a29"><i class="bx bx-user me-1"></i> Setari Cont</a>
            </li>
            <li class="nav-item col-3" style="text-align: center">
              <a class="nav-link" href="{{route('cart')}}" style="color: #110a29"
                ><i class="bx bx-bell me-1"></i> Cos</a
              >
            </li>
            <li class="nav-item col-3" style="text-align: center">
              <a class="nav-link" href="{{route('favorites')}}" style="color:#110a29"
                ><i class="bx bx-link-alt me-1"></i> Favorite</a
              >
            </li>
            <li class="nav-item col-3" style="text-align: center">
              <a class="nav-link active" href="{{route('orders-client')}}" style="background-color:#110a29"
                ><i class="bx bx-link-alt me-1"></i> Comenzi</a
              >
            </li>
          </ul>
        @endif
        </div>
    </div>

    @php
        use App\Models\Order;
        use App\Models\OrderDetails;
        use App\Models\Product;

        $orders = Order::where('user_id', Auth::user()->id)->get();
    @endphp

    <div class="row">
        <div class="col-12">
        <div class="card mb-4">
          <h5 class="card-header">Comenzile Mele</h5>
          <!-- Account -->
          <hr class="my-0" />
          <div class="card-body" style='text-align: center'>
            
            <table id="cart" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Comanda</th>
                        <th>Numar Produse</th>   
                        <th>Status</th>
                        <th>Modalitate plata</th>
                        <th>Pret achitat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)

                        @php
                            $details = OrderDetails::where("id_Order", $order->id)->get();
                        @endphp

                        <tr>
                            <td>DDM_{{$order->id}}</td>
                            <td>{{sizeof($details)}}</td>
                            <td style="color: orange">{{$order->status}}</td>
                            <td>{{$order->type}}</td>
                            <td>{{$order->price}} RON</td>
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

          </div>
          <!-- /Account -->
        </div>
      </div>
    </div>
  </div>

@endsection
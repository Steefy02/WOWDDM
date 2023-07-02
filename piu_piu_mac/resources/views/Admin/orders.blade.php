@extends('Admin.dashboard')

@section('page-name', 'Comenzi')

@section('content')


<?php

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetails;

$orders = Order::all();

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Toate comenzile</h6>
    </div>
    <div class="card-body">
    <div>
        <input type="text" placeholder="Cauta Comanda" id="searchBar" style="float: left; margin-bottom: 15px">
    </div>
        <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr style='text-align: center;'>
                        <th><b>ID Comanda</b></th>
                        <th><b>Numar Produse</b></th>
                        <th><b>Status</b></th>
                        <th><b>Modalitate plata</b></th>
                        <th><b>Pret</b></th>
                        <th><b>Actiuni</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)

                    @php
                        $details = OrderDetails::where("id_Order", $order->id)->get();
                    @endphp

                    <tr style='text-align: center;' class="prod_entry">
                        <td class="prod_name">DDM_{{$order->id}}</td>
                        <td class="prod_brand">{{sizeof($details)}}</td>
                        <td style="color: orange">{{$order->status}}</td>
                        <td>{{$order->type}}</td>
                        <td>{{$order->price}} RON</td>
                        <td class='d-flex justify-content-center'><a href='#' style='background-color: #4e73df; border: 1px solid grey; border-radius:5px; color: white' class='btn'>Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
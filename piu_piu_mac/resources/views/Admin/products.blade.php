@extends('Admin.dashboard')

@section('page-name', 'Produse')

@section('content')

<?php

use App\Models\Product;
$products = Product::all();

?>

<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Toate produsele</h6>
                        </div>
                        <div class="card-body">
                        <div>
                            <input type="text" placeholder="Cauta Produs" id="searchBar" style="float: left; margin-bottom: 15px">
                        </div>
                            <div class="table-responsive">
                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style='text-align: center;'>
                                            <th><b>Nume</b></th>
                                            <th><b>Brand</b></th>
                                            <th><b>Vizibilitate</b></th>
                                            <th><b>Gen</b></th>
                                            <th><b>Actiuni</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr style='text-align: center;' class="prod_entry">
                                            <td class="prod_name">{{$product->name}}</td>
                                            <td class="prod_brand">{{$product->brand}}</td>
                                            <td><select class="visibility form-select form-select-md" style="width: 40%; margin: 0 auto; @if($product->visible) color:green; @else color: red; @endif" id='{{$product->id}}_{{$product->visible}}'>
                                                @if($product->visible == '1')
                                                <option selected>Vizibil</option>
                                                <option>Invizibil</option>
                                                @else
                                                <option>Vizibil</option>
                                                <option selected>Invizibil</option>
                                                @endif
                                            </select></td>
                                            @if($product->category === 1)
                                                <td class="prod_gen">Femei</td>
                                            @elseif($product->category === 2)
                                                <td class="prod_gen">Barbati</td>
                                            @else
                                                <td class="prod_gen">Copii</td>
                                            @endif
                                            <td class='d-flex justify-content-center'><a href='https://wowddm.ro/admin/produse/{{$product->id}}' style='background-color: #4e73df; border: 1px solid grey; border-radius:5px; color: white' class='btn'>Edit</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{route('admin-add-product')}}"><button style='background-color: #4e73df; border: 1px solid grey; border-radius:5px; color: white' class='btn'>Adauga produs nou</button></a>
                        </div>
                    </div>

@endsection

@section('scripts')
<script>

    function hide_all() {
        $('.prod_entry').each(function () {
            $(this).hide();
        });
    }

$(".visibility").on('change', function() {
    var stuff = this.id.split('_');
    $.ajax({
        url: "{{route('admin-change-product-visibility')}}",
        type: "POST",
        data: {'_token': '{{csrf_token()}}','id': stuff[0], 'state': stuff[1]},
        success: function(data, xhr, status) {
            //alert(data);
            location.reload();
        }
    });
});

$("#searchBar").keyup(function() {
    var elem = $(this).val();
    hide_all();
    
    $('.prod_entry').each(function () {
        var name = $(this).children('.prod_name').text();
        var brand = $(this).children('.prod_brand').text();
        var gen = $(this).children('.prod_gen').text();

        if(name.includes(elem) || brand.includes(elem) || gen.includes(elem)) {
            $(this).show();
        }
    });
});

</script>
@endsection
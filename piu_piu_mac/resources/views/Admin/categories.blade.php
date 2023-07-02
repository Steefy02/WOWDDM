@extends('Admin.dashboard')

@section('page-name', "Categorii Produse")

@section('content')
@php
    use App\Models\Categories;
    $categories = Categories::all();
@endphp
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Toate Categoriile</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr style='text-align: center;'>
                        <th><b>Nume</b></th>
                        <th><b>Gen</b></th>
                        <th><b>Actiuni</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr style='text-align: center;'>
                        <td>{{$category->name}}</td>
                        @if($category->gen === 1)
                            <td>Femei</td>
                        @elseif($category->gen === 2)
                            <td>Barbati</td>
                        @elseif($category->gen === 3)
                            <td>Copii</td>
                        @else
                            <td>Toate genurile</td>
                        @endif
                        <td class='d-flex justify-content-center'><a href='{{route('admin-single-category', ['id' => $category->id])}}' style='background-color: #4e73df; border: 1px solid grey; border-radius:5px; color: white' class='btn'>Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{route('admin-add-category')}}"><button style='background-color: #4e73df; border: 1px solid grey; border-radius:5px; color: white' class='btn'>Adauga categorie</button></a>
    </div>
</div>


@endsection
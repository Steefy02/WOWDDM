@extends('Admin.dashboard')

@section('page-name', 'Utilizatori')

@section('content')

<?php

use App\Models\User;
$users = User::all();

?>

<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Utilizatorii inregistrati</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style='text-align: center;'>
                                            <th><b>Nume</b></th>
                                            <th><b>Email</b></th>
                                            <th><b>Rol</b></th>
                                            <th><b>Actiuni</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr style='text-align: center;'>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            @if($user->is_admin)
                                                <td>Administrator</td>
                                            @else
                                                <td>Client</td>
                                            @endif
                                            <td><a href='https://wowddm.ro/admin/utilizatori/{{$user->id}}' class='btn' style='background-color: #4e73df;color:white;'>Edit</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection
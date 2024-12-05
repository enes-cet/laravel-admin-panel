@extends('layouts.admin.panel')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kullanıcılar</h1>
    <p class="mb-4">Bu sayfada kullanıcıların listesi bulunmaktadır. </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kullanıcı Listesi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Ad</th>
                            <th>Email</th>
                            <th>Oluşturulma Tarihi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Ad</th>
                            <th>Email</th>
                            <th>Oluşturulma Tarihi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user )
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$users->links()}}
        </div>
    </div>

</div>
@endsection
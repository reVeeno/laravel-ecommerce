@extends('layouts.template')

@section('page-title')
Detail {{$user->name}}
@endsection


@section('content')

@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i>Oops!, we've detected some errors!</h5>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
  </div>
@endif
{{-- Area Detail Pemilik Toko --}}

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>User Detail</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <th>Nama Lengkap</th>
                                <td width="5%"> : </td>
                                <td width="70%">{{$user->name}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td width="5%"> : </td>
                                <td width="70%">{{$user->email}}</td>
                            </tr>
                        </table>
                    </div>
            </div>
        </div>
        {{-- card-edit --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Data</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{route('user.update',$user->id)}}" method="post">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label>Seller Full Name</label>
                        <input type="text" name="name" required class="form-control" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" required class="form-control">
                        <input type="text" name="level" hidden value="seller" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required class="form-control" placeholder="8 characters minimal">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection
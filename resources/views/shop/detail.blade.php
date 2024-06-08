@extends('layouts.template')

@section('page-title')
Detail {{$data->shop_name}}
@endsection

@section('content')

@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> Sorry, Error</h5>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Area Detai Pemilik Toko --}}
<div class="row">
    <div class="col-md-12 col-sm-12">
        {{-- show data card --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h5>Store Detail</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th>Store Name</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->shop_name}}</td>
                            <td rowspan="7">
                                for image
                            </td>
                        </tr>
                        <tr>
                            <th>Owner Name</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->user->name}}</td>
                        </tr>
                        <tr>
                            <th>Store Status</th>
                            <td width="5%"> : </td>
                            <td width="50%">
                                @if ($data->active_status == TRUE)
                                    <span class="badge badge-success">Store Active</span>
                                @else
                                    <span class="badge badge-danger">Store Non-Active</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->shop_category}}</td>
                        </tr>
                        <tr>
                            <th>Open Day</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->opening_day}}</td>
                        </tr>
                        <tr>
                            <th>Operating Hour</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->opening_time}} - {{$data->closing_time}}</td>
                        </tr>
                        <tr>
                            <th>Store Description</th>
                            <td width="5%"> : </td>
                            <td width="50%">{!! $data->shop_desc !!}</td>
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
                <form action="{{route('shop.update',$data->id)}}" method="post">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label>Seller Full Name</label>
                        <input type="text" name="name" value="{{$data->name}}" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email <Address></Address></label>
                        <input type="email" name="email" value="{{$data->email}}" required class="form-control">
                        <input type="text" name="level" hidden value="seller">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="8 Characters Minimal, A-Z, a-z & symbol">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.template')

@section('page-title')
User Data Page
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title">Store owner data</h3>
                    </div>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-xl">
                        Add Data
                      </button>
                </div>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                        @if($item->level === 'seller')
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                        <a type="button" class="btn btn-outline-info dropdown-toggle dropdown-icon" data-toggle="dropdown">Selection</a>
                                            <div class="dropdown-menu" role="menu">
                                                <a href="{{route('user.show', $item->id)}}" class="dropdown-item">Detail</a>
                                                <form action="{{route('user.destroy', $item->id)}}"  method="post"?>
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" class="dropdown-item" onclick="return confirm">Delete</button>
                                                </form>
                                            </div>
                                </td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add User Data (Seller)</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('user.store')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Seller Full Name</label>
                    <input type="text" name="name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required class="form-control">
                    <input type="text" name="level" hidden value="seller">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required class="form-control" placeholder="8 characters minimal">
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-toggle="modal">
                    Close
                  </button>
                  <button type="submit" class="btn btn-default" data-toggle="modal">
                    Submit
                  </button>
              </div>
        </form>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div
@endsection

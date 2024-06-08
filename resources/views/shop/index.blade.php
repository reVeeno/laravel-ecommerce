@extends('layouts.template')

@section('page-title')
Store Page
@endsection

@section('content')

{{-- ketika ada error --}}
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
                            <th>Store Name</th>
                            <th>Category</th>
                            <th>Store Owner</th>
                            <th>Store Status</th>
                            <th>Choice</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shop as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->shop_category}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>
                                    @if($item->active_status == FALSE)
                                        <span class="badge badge-danger">Store Non-Active</span>
                                    @else
                                        <span class="badge badge-success">Store Active</span>
                                    
                                    @endif
                                </td>
                                <td>
                                        <a type="button" class="btn btn-outline-info dropdown-toggle dropdown-icon" data-toggle="dropdown">Selection</a>
                                            <div class="dropdown-menu" role="menu">
                                                <a href="{{route('shop.show', $item->id)}}" class="dropdown-item">Detail</a>
                                                <form action="{{route('shop.destroy', $item->id)}}"  method="post"?>
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('Delete data?')">Delete</button>
                                                </form>
                                            </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Email</th>
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
        <form action="{{route('shop.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Store Name</label>
                    <input type="text" name="shop_name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Owner Name</label>
                    <select class="form-control" name="id_user">
                        <option value="">Choose</option>
                        @foreach($user as $item)
                        @if($item->level == 'seller')
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label>Store Description</label>
                    <textarea name="shop_desc" id="summernote">
                      </textarea>
                </div>
                <div class="form-group">
                    <label>Store Category</label>
                    <select name="shop_category" class="form-control" id="">
                        <option value=""></option>
                        <option value="electronic">Electronic</option>
                        <option value="automotive">Automotive</option>
                        <option value="groceries">Groceries</option>
                        <option value="fashion">Fashion</option>
                        <option value="foods">Food</option>
                        <option value="medicine">Medicine</option>
                        <option value="accessories">Accessories</option>
                        <option value="furniture">Furniture</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label for="hari_buka" >Open Hour :</label>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="sunday" name="opening_day[]" id="sunday" class="custom-control-input">
                    <label for="sunday" class="custom-control-label" >Sunday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="monday" name="opening_day[]" id="monday" class="custom-control-input">
                    <label for="monday" class="custom-control-label" >Monday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="tuesday" name="opening_day[]" id="tuesday" class="custom-control-input">
                    <label for="tuesday" class="custom-control-label" >Tuesday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="wednesday" name="opening_day[]" id="wednesday" class="custom-control-input">
                    <label for="wednesday" class="custom-control-label" >Wednesday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="thursday" name="opening_day[]" id="thursday" class="custom-control-input">
                    <label for="thursday" class="custom-control-label" >Thursday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="friday" name="opening_day[]" id="friday" class="custom-control-input">
                    <label for="friday" class="custom-control-label" >Friday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="saturday" name="opening_day[]" id="saturday" class="custom-control-input">
                    <label for="saturday" class="custom-control-label" >Saturday</label>
                </div>
              </div>

              <div class="row justify-content-around ">
                <div class="form-group col-md-6">
                    <label>Open Hours</label>
                    <input type="time" class="form-control" name="opening_time">
                </div>
                <div class="form-group col-md-6">
                    <label>Closing Hours</label>
                    <input type="time" class="form-control" name="holiday">
                </div>
              </div>

              <div class="form-group">
                <select name="active_status" class="form-control" required>
                    <option value="0">Non-active</option>
                    <option value="1">Active</option>
                </select>
              </div>

              <div class="form-group">
                <label for="">Shop icon</label>
                <input type="file" name="shop_pic" class="form-control" id="">
              </div>

              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-toggle="modal">
                    Close
                  </button>
                  <button type="submit" class="btn btn-default" data-toggle="modal">
                    Save changes
                  </button>
              </div>
        </form>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div
@endsection

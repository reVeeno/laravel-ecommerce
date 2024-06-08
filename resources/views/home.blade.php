@extends('layouts.template')

@section('page-title')
Homepage
@endsection

@section('content')

@if(Auth::user()->level === 'admin')
{{-- Halaman admin --}}
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
@else
@if(!$profile_data)
<div class="alert alert-warning alert-dismissible">
    <h5><i class="icon fas fa-info"></i>Oops!, <b>{{Auth::user()->name}}</b></h5>
    <p>You have not completed your profile, please complete your profile </p>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-profile-xl">Add Data</button>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
  </div>

  @if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i>Oops!, we've detected some invalid input!</h5>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
  </div>
@endif

  {{-- Modal Profile --}}
  <div class="modal fade" id="modal-profile-xl">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add User Data (Seller)</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('biodata.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="number" name="phone_num" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Birthday</label>
                    <input type="date" name="birth_day" required class="form-control">
                    <input type="text" name="id_user" hidden value="{{Auth::user()->id}}">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" required class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Profile Picture</label>
                    <input type="file" name="profile_pic" class="form-control">
                </div>
                <div class="form-group">
                    <label >Address</label>
                    <textarea required name="address" class="form-control" cols="30" rows="10"></textarea>
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

  @else
  
    {{-- Jika User sudah melengkapi data, maka akan muncul berikut --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Hello, {{Auth::user()->name}}</h5>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Acount Information</h6>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            @foreach($profile_data as $item)
                                            <tr>
                                                <th>Full Name</th>
                                                <td>{{$item->user->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{$item->user->email}}</td>
                                            </tr>
                                            <tr>
                                                <th>Level</th>
                                                <td>{{$item->user->level}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                {{-- Kolom yang ke dua --}}

                                <div class="col-md-4">
                                    <h6>Biodata Detail</h6>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            @foreach($profile_data as $item)
                                            <tr>
                                                <th>Phone Number</th>
                                                <td>{{$item->phone_num}}</td>
                                            </tr>
                                            <tr>
                                                <th>Birthday</th>
                                                <td>{{$item->birth_day}}</td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td>{{$item->gender}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endif


@endif
{{-- jika profile tidak ada --}}
   

@endsection

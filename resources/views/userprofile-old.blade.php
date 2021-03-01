@extends('layouts.app')

@section('content')

<div class="card shadow">

  <div class="card-header bg-white border-0">

    <div class="row align-items-center">

      <div class="col-8">

        <h3 class="mb-0">My account</h3>

      </div>

      <!-- <div class="col-4 text-right">

        <a href="#!" class="btn btn-sm btn-primary">Settings</a>

      </div> -->

    </div>

  </div>

  <div class="card-body">

   <form action="{{route('Viewprofilepost')}}" method="post">

   <input type="hidden" name="user_id" value="{{$user->id}}">

   @csrf

      <h6 class="heading-small text-muted mb-4">User information</h6>

      <div class="pl-lg-4">

        <div class="row">

          <div class="col-lg-6">

            <div class="form-group focused">

              <label class="form-control-label" for="name">Full Name</label>

              <input type="text" id="name" class="form-control form-control-alternative" name="name" placeholder="Full name" value="{{$user->name}}">

            </div>

          </div>

          <div class="col-lg-6">

            <div class="form-group focused">

              <label class="form-control-label" for="phone_number">Phone Number</label>

              <input type="text" id="phone_number" class="form-control form-control-alternative" name="phone_number" placeholder="Phone Number" value="{{$user->phone_number}}">

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-lg-6">

            <div class="form-group focused">

              <label class="form-control-label" for="primary_number">Primary Phone</label>

              <input type="text" id="primary_number" class="form-control form-control-alternative" name="primary_number" placeholder="Primary Phone" value="{{$user->primary_number}}">

            </div>

          </div>

          <div class="col-lg-6">

            <div class="form-group">

              <label class="form-control-label" for="email">Email address</label>

              <input type="email" id="email" class="form-control form-control-alternative" name="email" placeholder="Email address" value="{{$user->email}}">

            </div>

          </div>

        </div>

      </div>

      <hr class="my-4">

      <!-- Address -->

      <h6 class="heading-small text-muted mb-4">Contact information</h6>

      <div class="pl-lg-4">

        <div class="row">

          <div class="col-md-12">

            <div class="form-group focused">

              <label class="form-control-label" for="input-address">Address</label>

              <input id="address" class="form-control form-control-alternative" placeholder="Address" name="address" value="{{$user->address}}" type="text">

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-lg-4">

            <div class="form-group focused">

              <label class="form-control-label" for="city">City</label>

              <input type="text" id="city" class="form-control form-control-alternative"name="city" placeholder="City" value="{{$user->city}}">

            </div>

          </div>

          <div class="col-lg-4">

            <div class="form-group focused">

              <label class="form-control-label" for="country">Country</label>

              <input type="text" id="country" class="form-control form-control-alternative" name="country" placeholder="Country" value="{{$user->country}}">

            </div>

          </div>

          <div class="col-lg-4">

            <div class="form-group">

              <label class="form-control-label" for="postal_code">Postal code</label>

              <input type="text" id="postal_code" class="form-control form-control-alternative" name="postal_code" placeholder="Postal code" value="{{$user->postal_code}}">

            </div>

          </div>

        </div>

        <div class="row">

          <div class="form-group">

            <input type="submit" class="form-control btn btn-primary" >

          </div>

        </div>

      </div>

    </form>

  </div>

</div>

 @endsection
@extends('admin.layouts.app')

@section('content')

<div class="main-panel">

  <div class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-md-12">


            <div class="card">
              <div class="card-header card-header-primary">
                @if(isset($user))
                    <h4 class="card-title ">Update User</h4>
                @else
                    <h4 class="card-title ">Create User</h4>
                @endif
              </div>

              <div class="card-body">



                      @if(isset($user))
                        {{ Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'patch']) }}
                      @else
                        {{ Form::open(['route' => 'admin.users.store']) }}
                      @endif

                        <div class="row">

                          <div class="col-md-6">

                            <label for="name" class="col-form-label">Name</label>

                              {{ Form::text('name',old('name'),['class'=>'form-control','id'=>'name']) }}

                              @if($errors->has('name'))

                                  <div class="error">{{ $errors->first('name') }}</div>

                              @endif

                          </div>

                          <div class="col-md-6">

                            <label for="email" class="col-form-label">Email</label>

                            {{ Form::text('email',old('email'),['class'=>'form-control','id'=>'email']) }}

                            @if($errors->has('email'))

                                <div class="error">{{ $errors->first('email') }}</div>

                            @endif

                          </div>

                          <div class="col-md-6">

                            <label for="user_role" class="col-form-label">User Role</label>

                            {{ Form::select('user_role', $userroles,'',['class'=>'form-control','id'=>'user_role']) }}

                            @if($errors->has('user_role'))

                                <div class="error">{{ $errors->first('user_role') }}</div>

                            @endif

                          </div>



                        @if(isset($user))

                            <div class="col-md-6">

                            <label for="password" class="col-form-label">Password</label>

                              {{ Form::password('password',['class'=>'form-control','id'=>'password', 'disabled'=>true]) }}

                              @if($errors->has('password'))

                                  <div class="error">{{ $errors->first('password') }}</div>

                              @endif

                          </div>

                        @else

                          <div class=" col-md-6">

                            <label for="passowrd" class="col-form-label">Password</label>

                              {{ Form::password('password',['class'=>'form-control','id'=>'password']) }}

                              @if($errors->has('password'))

                                  <div class="error">{{ $errors->first('password') }}</div>

                              @endif

                          </div>

                        @endif

                        </div>

                        <div class="row">

                          <div class="col-md-12">

                            @foreach($moduleroute as $module => $routes)

                            <ul>

                              <li class="main-parent"><label><input class="main-checkbox" type="checkbox"/>{{$module}}</label>

                                @foreach($routes as $id => $route)

                                <ul class="accounts">

                                  @php 

                                    $checked =''; 

                                    if(in_array($id,$permissions)){

                                      $checked ='checked';

                                    }

                                  @endphp

                                  

                                  <li><label><input class="sub-checkbox" type="checkbox"name="permission[]" value="{{$id}}" {{$checked}} />{{$route}}</label>

                                  </li>

                                </ul>

                                @endforeach

                              </li>

                            </ul>

                            @endforeach

                          </div>

                        </div>

                        <div class="row">

                          <div class="form-group col-md-6">

                             {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

                          </div>

                        </div>

                    </form>



                </div>
            </div>



          </div>

        </div>

      </div>

  </div>

</div>

@endsection



@push('styles')

<style type="text/css">

  ul {

    list-style: none;

  }


</style>

@endpush

@push('scripts')

<script type="text/javascript">

$(function () {

    $('input:checkbox.main-checkbox').click(function () {

        var array = [];

        var parent = $(this).closest('.main-parent');

        //check or uncheck sub-checkbox

        $(parent).find('.sub-checkbox').prop("checked", $(this).prop("checked"))

        //push checked sub-checkbox value to array

        $(parent).find('.sub-checkbox:checked').each(function () {

            array.push($(this).val());

        })

    });



    $('input:checkbox.sub-checkbox').click(function () {

      var ii = $(this).closest('.main-parent').find('input:checked.sub-checkbox').length;

      var jj = $(this).closest('.main-parent').find('.sub-checkbox').length;

        if(ii==jj){

          $(this).closest('.main-parent').find('.main-checkbox').prop('checked', true);

        }else{

          $(this).closest('.main-parent').find('.main-checkbox').prop('checked', false);

        }

    });

})

</script>

@endpush
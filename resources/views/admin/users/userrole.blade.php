@extends('admin.layouts.app')

@section('content')

<div class="main-panel">

  <div class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-md-12">


            <div class="card">
                <div class="card-header card-header-primary">
                  @if(isset($userrole))
                      <h4 class="card-title ">Update User Role</h4>
                  @else
                      <h4 class="card-title ">Create User Role</h4>
                  @endif
                </div>
                
                <div class="card-body">

                      @if(isset($userrole))
                        {{ Form::model($userrole, ['route' => ['admin.editrolepost', $userrole->id], 'method' => 'post']) }}
                      @else
                        {{ Form::open(['route' => 'admin.addrolepost']) }}
                      @endif

                        <div class="row">

                          <div class="col-md-6">

                            <label for="role_name" class="col-form-label">User Role Name</label>

                              {{ Form::text('role_name',old('role_name'),['class'=>'form-control','id'=>'role_name']) }}

                              @if($errors->has('role_name'))

                                  <div class="error">{{ $errors->first('role_name') }}</div>

                              @endif

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



@push('scripts')

@endpush
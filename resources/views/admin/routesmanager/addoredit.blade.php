@extends('admin.layouts.app')

@section('content')

<div class="main-panel">

  <div class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-md-12">

            
            <div class="card">
              <div class="card-header card-header-primary">
                @if(isset($route))
                    <h4 class="card-title ">Update Features</h4>
                @else
                    <h4 class="card-title ">Create Features</h4>
                @endif

              </div>
              <div class="card-body">
                


            @if(isset($route))
              {{ Form::model($route, ['route' => ['admin.routesmanager.update', $route->id], 'method' => 'patch']) }}
            @else
              {{ Form::open(['route' => 'admin.routesmanager.store']) }}
            @endif

              <div class="row">

                <div class="col-md-6">

                  <label for="route_name" class="col-form-label">Route Name</label>

                    {{ Form::text('route_name',old('route_name'),['class'=>'form-control','id'=>'route_name']) }}

                    @if($errors->has('route_name'))

                        <div class="error">{{ $errors->first('route_name') }}</div>

                    @endif

                </div>

                <div class="col-md-6">

                  <label for="route_url" class="col-form-label">Route Url</label>

                  {{ Form::text('route_url',old('route_url'),['class'=>'form-control','id'=>'route_url']) }}

                  @if($errors->has('route_url'))
                      <div class="error">{{ $errors->first('route_url') }}</div>
                  @endif
                </div>
                {{--
                  <div class="form-group col-md-6">
                  <label for="route_slag" class="col-form-label">Route Slag</label>
                  {{ Form::text('route_slag',old('route_slag'),['class'=>'form-control','id'=>'route_slag']) }}
                  @if($errors->has('route_slag'))
                      <div class="error">{{ $errors->first('route_slag') }}</div>
                  @endif
                </div> 
                --}}

              </div>

              <div class="row">

                <div class="col-md-6">

                  <label for="module_name" class="col-form-label">Module Name</label>

                  {{ Form::text('module_name',old('module_name'),['class'=>'form-control','id'=>'module_name']) }}

                  @if($errors->has('module_name'))

                      <div class="error">{{ $errors->first('module_name') }}</div>

                  @endif

                </div>

                <div class=" col-md-6">

                  <label for="route_action" class="col-form-label">Route Action</label>

                  {{ Form::select('route_action', ['View'=>'View', 'Delete'=>'Delete','Edit'=>'Edit','Add'=>'Add'],old('route_action'),['class'=>'form-control','id'=>'route_action']) }}

                  @if($errors->has('route_action'))

                      <div class="error">{{ $errors->first('route_action') }}</div>

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
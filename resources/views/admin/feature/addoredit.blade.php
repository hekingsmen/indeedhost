@extends('admin.layouts.app')
<style type="text/css"> img { display: block; max-width:180px; max-height:180px; width: auto; height: auto; } </style>
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
                    {{ Form::model($route, ['route' => ['admin.feature.update', $route->id], 'method' => 'patch','files'=>'true']) }}
                  @else
                      {{ Form::open(['route' => 'admin.feature.save','files'=>'true']) }}
                  @endif

                  <div class="row">
                    <div class="  col-md-12">
                      <label for="title" class="col-form-label">Title</label>
                        {{ Form::text('title',null,['class'=>'form-control','id'=>'title']) }}
                        @if($errors->has('title'))
                            <div class="error">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    
                  </div>

                    <div class="row">
                        <div class=" col-md-12">
                            <label for="description" class="col-form-label">Text Here</label>
                            {{ Form::textarea('description',null,['class'=>'form-control','id'=>'description','rows'=>'4', 'cols'=>'200']) }}
                            @if($errors->has('description'))
                                <div class="error">{{ $errors->first('description') }}</div>
                            @endif
                        </div> 
                    </div>

                 
                    <div class="row">
                        <div class=" col-md-12">
                            <label for="image" class="col-form-label">Slider Image</label>

                        </div>
                    </div>

                    {{Form::file('image',null,['class'=>'form-control'])}}
                    @if($errors->has('image'))
                        <div class="error">{{ $errors->first('image') }}</div>
                    @endif
                    
                    @if(!empty($route->image))
                      <div class="row">
                        <div class=" col-md-12 " style="height: 28%">
                            <img width="400" height="400" src="{{ asset('features') }}/{{$route->image}}">
                        </div>
                      </div>
                    @endif
                    
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
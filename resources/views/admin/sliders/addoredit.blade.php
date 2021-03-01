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
                      <h4 class="card-title ">Update Slider</h4>
                  @else
                      <h4 class="card-title ">Create Slider</h4>
                  @endif
                </div>
                    <div class="card-body">

                        @if(isset($route))
                          {{ Form::model($route, ['route' => ['admin.slider.update', $route->id], 'method' => 'patch','files'=>'true']) }}
                        @else
                            {{ Form::open(['route' => 'admin.slider.save','files'=>'true']) }}
                        @endif
                        <div class="row">
                          <div class=" col-md-6">
                            <label for="heading_first" class="col-form-label">First Heading</label>
                              {{ Form::text('heading_first',null,['class'=>'form-control','id'=>'heading_first']) }}
                              @if($errors->has('heading_first'))
                                  <div class="error">{{ $errors->first('heading_first') }}</div>
                              @endif
                          </div>
                          <div class=" col-md-6">
                            <label for="heading_second" class="col-form-label">Second Heading</label>
                            {{ Form::text('heading_second',null,['class'=>'form-control','id'=>'heading_second']) }}
                            @if($errors->has('heading_second'))
                                <div class="error">{{ $errors->first('heading_second') }}</div>
                            @endif
                          </div>
                          
                        </div>

                          <div class="row">
                              <div class=" col-md-12">
                                  <label for="text" class="col-form-label">Text Here</label>
                                  {{ Form::textarea('text',null,['class'=>'form-control','id'=>'text','rows'=>'4', 'cols'=>'200']) }}
                                  @if($errors->has('text'))
                                      <div class="error">{{ $errors->first('text') }}</div>
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
                                <div class="form-group col-md-12 " style="height: 28%">
                                    <img width="400" height="400" src="{{ asset('sliders') }}/{{$route->image}}">
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
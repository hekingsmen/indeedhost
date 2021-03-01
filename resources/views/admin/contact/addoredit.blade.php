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
                      <h4 class="card-title ">Update Contact Details</h4>
                </div>
                    <div class="card-body">

{{--                        @if(isset($route))--}}
                        {{ Form::model($data, ['route' => ['admin.save.contact.page.detail'], 'method' => 'post','files'=>'true']) }}
{{--                        @else--}}
{{--                            {{ Form::open(['route' => 'admin.slider.save','files'=>'true']) }}--}}
{{--                        @endif--}}

                        <div class="row">

                          <div class=" col-md-4">
                            <label for="phone" class="col-form-label">Phone Number</label>
                              {{ Form::text('phone',null,['class'=>'form-control','id'=>'heading_first']) }}
                              @if($errors->has('phone'))
                                  <div class="error" style="color: red;" >{{ $errors->first('phone') }}</div>
                              @endif
                          </div>

                          <div class=" col-md-4">
                            <label for="heading_second" class="col-form-label">Email Address</label>
                            {{ Form::email('email',null,['class'=>'form-control','id'=>'heading_second']) }}
                            @if($errors->has('email'))
                                <div class="error" style="color: red;" >{{ $errors->first('email') }}</div>
                            @endif
                          </div>
                            <div class=" col-md-4">
                                <label for="website" class="col-form-label">website URL</label>
                                {{ Form::url('website',null,['class'=>'form-control','id'=>'heading_second']) }}
                                {{ Form::hidden('id',null) }}
                                @if($errors->has('website'))
                                    <div class="error" style="color: red;" >{{ $errors->first('website') }}</div>
                                @endif
                            </div>
                          
                        </div>

                          <div class="row">
                              <div class=" col-md-12">
                                  <label for="text" class="col-form-label">Text Here</label>
                                  {{ Form::textarea('address',null,['class'=>'form-control','id'=>'text','rows'=>'3', 'cols'=>'200']) }}
                                  @if($errors->has('address'))
                                      <div class="error" style="color: red;" >{{ $errors->first('address') }}</div>
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
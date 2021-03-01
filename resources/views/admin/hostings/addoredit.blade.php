@extends('admin.layouts.app')
<style>
    .error { color: red; font-weight: bold; }
    .row.gap-me { margin-top: 10px; }
</style>
@section('content')


<div class="main-panel">
  <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="card">
                <div class="card-header card-header-primary">
                  @if(isset($plan))
                      <h4 class="card-title ">Update Hosting Plan</h4>
                  @else
                      <h4 class="card-title ">Create Hosting Plan</h4>
                  @endif
                </div>

                <div class="card-body">

                        @if(isset($plan))
                          {{ Form::model($plan, ['route' => ['admin.hostings.update', $plan->id], 'method' => 'patch']) }}
                        @else
                          {{ Form::open(['route' => 'admin.hostings.store']) }}
                        @endif

                        <div class="row">
                            <div class=" col-md-6">
                                <label for="name" class="col-form-label">Plan Title</label>
                                {{ Form::text('title',old('title'),['class'=>'form-control ','id'=>'title']) }}
                                @if($errors->has('title'))
                                    <div class="error">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                            <div class=" col-md-6">
                                <label for="name" class="col-form-label">Support</label>
                                {{ Form::text('support',old('support'),['class'=>'form-control ','id'=>'support']) }}
                                @if($errors->has('support'))
                                    <div class="error">{{ $errors->first('support') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-6">
                                <label for="name" class="col-form-label">Number of Website</label>
                                {{ Form::number('website',old('website'),['class'=>'form-control ','id'=>'website']) }}
                                @if($errors->has('website'))
                                    <div class="error">{{ $errors->first('website') }}</div>
                                @endif
                            </div>
                            <div class=" col-md-6">
                                <label for="name" class="col-form-label">Storage in GB</label>
                                {{ Form::number('storage',old('storage'),['class'=>'form-control ','id'=>'storage']) }}
                                @if($errors->has('storage'))
                                    <div class="error">{{ $errors->first('storage') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-6">
                                <label for="name" class="col-form-label">Bandwidth in GB</label>
                                {{ Form::number('bandwidth',old('bandwidth'),['class'=>'form-control ','id'=>'bandwidth']) }}
                                @if($errors->has('bandwidth'))
                                    <div class="error">{{ $errors->first('bandwidth') }}</div>
                                @endif
                            </div>
                            <div class=" col-md-6">
                                <label for="name" class="col-form-label">RAM in GB</label>
                                {{ Form::number('ram',old('ram'),['class'=>'form-control ','id'=>'ram']) }}
                                @if($errors->has('ram'))
                                    <div class="error">{{ $errors->first('ram') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-6">
                                <label for="name" class="col-form-label">Number of Database</label>
                                {{ Form::number('db',old('db'),['class'=>'form-control ','id'=>'db']) }}
                                @if($errors->has('db'))
                                    <div class="error">{{ $errors->first('db') }}</div>
                                @endif
                            </div>
                            <div class=" col-md-6">
                                <label for="name" class="col-form-label">RAM in GB</label>
                                {{ Form::number('emails',old('emails'),['class'=>'form-control ','id'=>'emails']) }}
                                @if($errors->has('emails'))
                                    <div class="error">{{ $errors->first('emails') }}</div>
                                @endif
                            </div>
                        </div>

{{--                            Plan manage--}}



                    <div class="row gap-me">
                        <div class=" col-md-3">
                            <label for="name" class="col-form-label">Plan Duration ( Months )</label>
                        </div>

                        <div class=" col-md-3">
                            <label for="name" class="col-form-label">Actual Price</label>
                        </div>

                        <div class=" col-md-3">
                            <label for="name" class="col-form-label">Discount type</label>
                        </div>

                        <div class=" col-md-3">
                            <label for="name" class="col-form-label">Discount</label>
                        </div>
                    </div>


                    @foreach($months as $index => $month)

                        <div class="row gap-me ">
                            <div class=" col-md-3">

                                {{ Form::number('plan_duration[]',$month,['class'=>'form-control','readonly'=>true ]) }}
                                @if($errors->has('plan_duration'))
                                    <div class="error">{{ $errors->first('plan_duration') }}</div>
                                @endif
                            </div>

                            <div class=" col-md-3">
                                @if( $plan->price[$index] == 0  || $plan->price[$index] == null)
                                    {{ Form::number('price[]',0,['class'=>'form-control']) }}
                                @else
                                    {{ Form::number('price[]',$plan->price[$index],['class'=>'form-control']) }}
                                @endif
                                    @if($errors->has('price'))
                                        <div class="error">{{ $errors->first('price') }}</div>
                                    @endif
                            </div>

                            <div class=" col-md-3">

                                <select class="form-control DiscountType" name="type[]"  >
                                    <option value="percentage" @if($plan->type[$index]=='percentage') selected @endif >Percentage</option>
                                    <option value="flat" @if($plan->type[$index]=='flat') selected @endif >Flat</option>
                                </select>
                                @if($errors->has('type'))
                                    <div class="error">{{ $errors->first('type') }}</div>
                                @endif
                            </div>

                            <div class=" col-md-3">

                                @if( $plan->price[$index] == 0  || $plan->price[$index] == null)
                                    {{ Form::text('discount[]',0,['class'=>'form-control discount']) }}
                                @else
                                    {{ Form::text('discount[]',$plan->discount[$index],['class'=>'form-control discount']) }}
                                @endif
                            @if($errors->has('discount'))
                                    <div class="error">{{ $errors->first('discount') }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach






















                        <div class="row">
                          <div class="form-group col-md-6">
                             {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                          </div>
                        </div>

                    {{ Form::close() }}

              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

</div>

@endsection

@push('scripts')

    <script>
        $('.discount').keypress (function( e ) {
            if(!/[0-9]/.test(String.fromCharCode(e.which))){
                return false;
            }
        });
        $('.discount').keyup(function(){
			var distype = $(this).parents('.gap-me').find('.DiscountType').val();
			if(distype =='percentage' && $(this).val() > 100){
				alert("No numbers above 100");
                $(this).val('100');
			}
        });

    </script>

@endpush
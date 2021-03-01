@extends('admin.layouts.app')
@section('content')
<div class="main-panel">
  <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @if(isset($plan))
              {{ Form::model($plan, ['route' => ['admin.hostings.update', $plan->id], 'method' => 'patch']) }}
          @else
              {{ Form::open(['route' => 'admin.hostings.store']) }}
          @endif
            <form>
              <div class="row">
                <div class="form-group col-md-5">
                  <div class="row">
                    <label for="title" class="col-form-label col-md-3">Plan Title</label>
                    {{ Form::text('title',old('title'),['class'=>'form-control col-md-7','id'=>'title']) }}
                  </div>
                </div>
                <div class="form-group col-md-7">
                  <div class="row">
                    <label for="price" class="col-form-label col-md-2">Price</label>
                    {{ Form::text('price',old('price'),['class'=>'form-control col-md-4','id'=>'price']) }}
                    
                    <label for="per" class="col-form-label col-md-2">Per</label>
                    {{ Form::select('per', ['1'=>'Month', '2'=>'Year'],'1',['class'=>'form-control col-md-4','id'=>'per']) }}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <div class="row">
                    <label for="website" class="col-form-label col-md-4">Number of Website</label>
                    {{ Form::text('website',old('website'),['class'=>'form-control col-md-8','id'=>'website']) }}
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="row">
                    <label for="storage" class="col-form-label col-md-4">Storage</label>
                    {{ Form::text('storage',old('storage'),['class'=>'form-control col-md-8','id'=>'storage']) }}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <div class="row">
                    <label for="bandwidth" class="col-form-label col-md-4">Bandwidth</label>
                    {{ Form::text('bandwidth',old('bandwidth'),['class'=>'form-control col-md-8','id'=>'bandwidth']) }}
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="row">
                    <label for="ram" class="col-form-label col-md-4">RAM</label>
                    {{ Form::text('ram',old('ram'),['class'=>'form-control col-md-8','id'=>'ram']) }}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <div class="row">
                    <label for="db" class="col-form-label col-md-4">Database</label>
                    {{ Form::text('db',old('db'),['class'=>'form-control col-md-8','id'=>'db']) }}
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="row">
                    <label for="ram" class="col-form-label col-md-4">Emails</label>
                    {{ Form::text('emails',old('emails'),['class'=>'form-control col-md-8','id'=>'emails']) }}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <div class="row">
                    <label for="support" class="col-form-label col-md-4">Support</label>
                    {{ Form::text('support',old('support'),['class'=>'form-control col-md-8','id'=>'support']) }}
                  </div>
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
@endsection

@push('scripts')
@endpush
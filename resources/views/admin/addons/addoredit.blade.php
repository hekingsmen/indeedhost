@extends('admin.layouts.app')
@section('content')
<div class="main-panel">
  <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @if(isset($user))
              {{ Form::model($user, ['route' => ['admin.addons.update', $user->id], 'method' => 'patch']) }}
          @else
              {{ Form::open(['route' => 'admin.addons.store']) }}
          @endif
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="title" class="col-form-label">Addon Name</label>
                    {{ Form::text('name',old('name'),['class'=>'form-control','id'=>'name']) }}
                    @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-6">
                  <label for="addon_key" class="col-form-label">Addon Key</label>
                  {{ Form::text('addon_key',old('addon_key'),['class'=>'form-control','id'=>'addon_key']) }}
                  @if($errors->has('addon_key'))
                      <div class="error">{{ $errors->first('addon_key') }}</div>
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="title" class="col-form-label">Addon Title</label>
                  {{ Form::text('title',old('title'),['class'=>'form-control','id'=>'title']) }}
                  @if($errors->has('title'))
                      <div class="error">{{ $errors->first('title') }}</div>
                  @endif
                </div>
                <div class="form-group col-md-6">
                  <label for="status" class="col-form-label">Status</label>
                  {{ Form::select('status', ['1'=>'Active', '0'=>'Un-Active'],'1',['class'=>'form-control','id'=>'status']) }}
                  @if($errors->has('status'))
                      <div class="error">{{ $errors->first('status') }}</div>
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="visibility" class="col-form-label">Visibility</label>
                  {{ Form::select('visibility', ['1'=>'Published', '0'=>'Unpublished'],'1',['class'=>'form-control','id'=>'visibility']) }}
                  @if($errors->has('visibility'))
                      <div class="error">{{ $errors->first('visibility') }}</div>
                  @endif
                </div>
                <div class="form-group col-md-6">
                  <label for="db_table" class="col-form-label">Modules</label>
                  {{ Form::select('db_table',$tables,'',['class'=>'form-control select2','id'=>'db_table']) }}
                  @if($errors->has('db_table'))
                      <div class="error">{{ $errors->first('db_table') }}</div>
                  @endif
                </div>
              </div>
              	<div class="row">
	              	<div class="form-group col-md-12">
	                  <label for="permission" class="col-form-label">Module Permission</label>
	                  {{ Form::select('permission',['View'=>'View','Add'=>'Add','Edit'=>'Edit','Delete'=>'Delete'],'',['class'=>'form-control select2','id'=>'permission','multiple'=>'multiple']) }}
	                  @if($errors->has('permission'))
	                      <div class="error">{{ $errors->first('permission') }}</div>
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
@endsection
@push('styles')
@endpush
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
@push('scripts')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script type="text/javascript">
  $('.select2').select2({

  });
</script>
@endpush
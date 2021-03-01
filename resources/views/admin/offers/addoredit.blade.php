@extends('admin.layouts.app')
<style type="text/css"> img { display: block; max-width:180px; max-height:180px; width: auto; height: auto; } .error { color: red; } </style>
@section('content')
<div class="main-panel">
  <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="card">
                <div class="card-header card-header-primary">
                  @if(isset($route))
                      <h4 class="card-title ">Update Offer</h4>
                  @else
                      <h4 class="card-title ">Create Offer</h4>
                  @endif
                </div>

                    <div class="card-body">
                        @if(isset($route))
                          {{ Form::model($route, ['route' => ['admin.offers.update', $route->id], 'method' => 'patch','files'=>'true']) }}
                        @else
                            {{ Form::open(['route' => 'admin.offers.save','files'=>'true']) }}
                        @endif

                        <div class="row">
                          <div class=" col-md-12">
                            <label for="name" class="col-form-label">Offer Name</label>
                              {{ Form::text('name',null,['class'=>'form-control','id'=>'name']) }}
                              @if($errors->has('name'))
                                  <div class="error">{{ $errors->first('name') }}</div>
                              @endif
                          </div>
                        </div>

                        <div class="row">
                          <div class=" col-md-12">
                              <label for="description" class="col-form-label">Offer Description</label>
                              {{ Form::textarea('description',null,['class'=>'form-control','id'=>'description','rows'=>'4', 'cols'=>'200']) }}
                              @if($errors->has('description'))
                                  <div class="error">{{ $errors->first('description') }}</div>
                              @endif
                          </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-6">
                                <label for="type" class="col-form-label">Offer Type</label>
                                <select class = "form-control" name="type" id="type" >
                                    <option value="fixed" @if(isset($type) && $type== "fixed") selected @endif >Fixed Type</option>
                                    <option value="percentage" @if(isset($type) && $type== "percentage") selected @endif >Percentage Type</option>
                                </select>

                                @if($errors->has('type'))
                                    <div class="error">{{ $errors->first('type') }}</div>
                                @endif
                            </div>
                            <div class=" col-md-6">
                                <label for="code" class="col-form-label">Offer Code</label>
                                {{ Form::text('code',null,['class'=>'form-control','id'=>'code']) }}
                                <div class="isValidCodeOrNot"  id="isValidCodeOrNot"></div>
                                @if($errors->has('code'))
                                    <div class="error">{{ $errors->first('code') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-6">
                                <label for="start_date" class="col-form-label">Offer Start Date</label>
                                {{ Form::date('start_date',null,['class'=>'form-control','id'=>'start_date']) }}
                                {{ Form::hidden('id',null) }}
                                @if($errors->has('start_date'))
                                    <div class="error">{{ $errors->first('start_date') }}</div>
                                @endif
                            </div>
                            <div class=" col-md-6">
                                <label for="expiry_date" class="col-form-label">Offer Expiry Date</label>
                                {{ Form::date('expiry_date',null,['class'=>'form-control','id'=>'expiry_date	']) }}
                                @if($errors->has('expiry_date'))
                                    <div class="error">{{ $errors->first('expiry_date') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-6">
                                <label for="min_package_amount" class="col-form-label">Minimum Package Amount ( ₹ )</label>
                                {{ Form::text('min_package_amount',null,['class'=>'form-control','id'=>'min_package_amount']) }}
                                @if($errors->has('min_package_amount'))
                                    <div class="error">{{ $errors->first('min_package_amount') }}</div>
                                @endif
                            </div>
                            <div class=" col-md-6">
                                <label for="max_discount" class="col-form-label Discountlabel">Offer Maximum Discount ( % )</label>
                                {{ Form::text('max_discount',null,['class'=>'form-control','id'=>'max_discount']) }}
                                @if($errors->has('max_discount'))
                                    <div class="error">{{ $errors->first('max_discount') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-6">
                                <label for="specific_item" class="col-form-label">Specific Item</label>
                                <select class="specific_item form-control" name="specific_item[]" id="specific_item" multiple="true">
                                    @if(!empty($plans) && isset($plans) )
                                        @foreach($plans as $plan)
                                            <option value="{{$plan->id}}"
                                                    @if(!empty($specific_item)) @if(in_array($plan->id,$specific_item)) selected @endif @endif
                                            >{{$plan->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('specific_item	'))
                                    <div class="error">{{ $errors->first('specific_item') }}</div>
                                @endif
                            </div>

                            <div class=" col-md-6">
                                <label for="restricted_item" class="col-form-label">Restricted Item</label>
                                <select class="restricted_item form-control" name="restricted_item[]" id="restricted_item" multiple="true">
                                    @if(!empty($plans) && isset($plans) )
                                        @foreach($plans as $plan)
                                            <option value="{{$plan->id}}"
                                                    @if(!empty($restricted_item)) @if(in_array($plan->id,$restricted_item)) selected @endif @endif
                                            >{{$plan->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('restricted_item'))
                                    <div class="error">{{ $errors->first('restricted_item') }}</div>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <script>

        $('#max_discount').keypress (function( e ) {
            if(!/[0-9]/.test(String.fromCharCode(e.which))){
                return false;
            }
        });

        $('#max_discount').keyup(function(){
			var selected = $('#type').val();
			if(selected!='fixed' && $(this).val() > 100){
				alert("No numbers above 100");
				$(this).val('100');
			}
				
        });

        $(document).ready(function(){
            $(".specific_item").select2({
                placeholder: "Specific Item", //placeholder
                tags: true,
                tokenSeparators: ['/',',',';'," "]
            });
        });

        $(document).ready(function(){
            $(".restricted_item").select2({
                placeholder: " Restricted Item", //placeholder
                tags: true,
                tokenSeparators: ['/',',',';'," "]
            });
        });

        $('#code').keypress (function( e ) {

            if(!/[0-9a-zA-Z-]/.test(String.fromCharCode(e.which)))
                return false;
        });

        $('#code').keyup(function(){
            this.value = this.value.toUpperCase();
            var code = this.value;
            checkForValid(code);
        });

        function checkForValid(code){

            var route ="{{ route('admin.check.valid.offer.code')  }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                route,
                {code:code},
                function (data) {
                    if(data.success==true){
                        $("#isValidCodeOrNot").empty();
                        $( "#isValidCodeOrNot" ).append( "<strong style='color: green;' > "+ data.msg +" </strong>" );
                        removeMsg();

                    }else{
                        $("#isValidCodeOrNot").empty();
                        $( "#isValidCodeOrNot" ).append( "<strong style='color: red;' > "+ data.msg +" </strong>" );
                        removeMsg();
                    }

                }
            );

        }

        function removeMsg(){
            setTimeout(function(){
                $("#isValidCodeOrNot").empty();
            }, 2000);
        }
		
	$(document).ready(function(){
		var restricted = $('#restricted_item').val();
		if(restricted != null){
			for(var i in restricted) {
				$("#specific_item option[value='"+restricted[i]+"']").prop('disabled', true);
			}
			$('#specific_item').select2();
		}
		
		var specific = $('#specific_item').val();
		if(specific != null){
			for(var i in specific) {
				$("#restricted_item option[value='"+specific[i]+"']").prop('disabled', true);
			}
			$('#restricted_item').select2();
		}
	});

	$('#restricted_item').change(function () {
		var selected = $(this).val();
		$.map($('#specific_item option'), function(ele) {
			$("#specific_item option[value='" + ele.value + "']").prop("disabled", false);
		});
		if(selected != null){
			for(var i in selected) {
				$("#specific_item option[value='"+selected[i]+"']").prop('disabled', true);
			}
		}
		$('#specific_item').select2();
		
	});

	$('#specific_item').change(function () {
		var selected = $(this).val();
		$.map($('#restricted_item option'), function(ele) {
			$("#restricted_item option[value='" + ele.value + "']").prop("disabled", false);
		});

		if(selected != null){
			for(var i in selected) {
				$("#restricted_item option[value='"+selected[i]+"']").prop('disabled', true);
			}
		}
		$('#restricted_item').select2();
	});
	
	$('#type').change(function () {
		var selected = $(this).val();
		if(selected=='fixed'){
			$('.Discountlabel').html('Offer Maximum Discount ( &#8377; )');
		}else{
			$('.Discountlabel').html('Offer Maximum Discount ( % )');
		}
	});

    </script>
@endpush

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
                                <h4 class="card-title ">My Profile</h4>
                            </div>

                            <div class="card-body">

                                {{ Form::model($user, ['route' => ['Viewprofilepost'], 'method' => 'post']) }}

                                <div class="row">

                                    <div class=" col-md-6">
                                        <label for="name" class="col-form-label">Full Name</label>
                                        {{ Form::text('name',null,['class'=>'form-control','id'=>'name']) }}

                                        @if($errors->has('name'))
                                            <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class=" col-md-6">
                                        <label for="phone_number" class="col-form-label">Phone Number</label>
                                        {{ Form::text('phone_number',null,['class'=>'form-control','id'=>'phone_number']) }}
                                        @if($errors->has('phone_number'))
                                            <div class="error">{{ $errors->first('phone_number') }}</div>
                                        @endif
                                    </div>

                                </div>


                                <div class="row">

                                    <div class=" col-md-6">
                                        <label for="primary_number" class="col-form-label">Primary Number</label>
                                        {{ Form::text('primary_number',null,['class'=>'form-control','id'=>'primary_number']) }}

                                        @if($errors->has('primary_number'))
                                            <div class="error">{{ $errors->first('primary_number') }}</div>
                                        @endif
                                    </div>

                                    <div class=" col-md-6">
                                        <label for="email" class="col-form-label">Email Address</label>
                                        {{ Form::text('email',null,['class'=>'form-control','id'=>'email']) }}

                                        @if($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>

                                </div>


                                <div class="row">

                                    <div class=" col-md-12">
                                        <label for="address" class="col-form-label">Address</label>
                                        {{ Form::textarea('address',null,['class'=>'form-control','id'=>'address','rows'=>'4', 'cols'=>'200']) }}
                                        @if($errors->has('address'))
                                            <div class="error">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>

                                </div>

                                <div class="row">

                                    <div class=" col-md-4">
                                        <label for="city" class="col-form-label">City</label>
                                        {{ Form::text('city',null,['class'=>'form-control','id'=>'city']) }}

                                        @if($errors->has('city'))
                                            <div class="error">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>

                                    <div class=" col-md-4">
                                        <label for="country" class="col-form-label">Country</label>
                                        {{ Form::text('country',null,['class'=>'form-control','id'=>'email']) }}

                                        @if($errors->has('email'))
                                            <div class="error">{{ $errors->first('country') }}</div>
                                        @endif
                                    </div>

                                    <div class=" col-md-4">
                                        <label for="postal_code" class="col-form-label">Postal Code</label>
                                        {{ Form::text('postal_code',null,['class'=>'form-control','id'=>'postal_code']) }}
                                        @if($errors->has('postal_code'))
                                            <div class="error">{{ $errors->first('postal_code') }}</div>
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

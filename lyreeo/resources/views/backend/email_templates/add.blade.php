@extends('backend.layouts.master')
@section('content')

    <div class="container" >
        <div class="row">
            <h2>{{ __('sentence.email_template_lang.email_template')}}</h2>
            <div class="loader"></div>
            <div class="col-md-9">
                {{Form::model($emailTemplateDetail, array('url'=>route('emailTemplateSave'), 'class'=>'ajax-submit', 'id'=>'email_template'))}}
                    <div class="row">
                        <div class="col-md-4">{{ __('sentence.email_template_lang.template_name')}}</div>
                        <div class="col-md-8">{{Form::text('template_name', null, array('class'=>'form-control'))}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">{{ __('sentence.email_template_lang.template_subject')}}</div>
                        <div class="col-md-8">{{Form::text('template_subject', null, array('class'=>'form-control'))}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">{{ __('sentence.email_template_lang.template_content')}} </div>
                        <div class="col-md-8">{{Form::textarea('template_content', null, array('class'=>'form-control editor'))}}</div>
                    </div>
                    {{ Form::hidden('id', null) }}
                    <button type="submit">{{ __('sentence.email_template_lang.save')}}</button>
                {{Form::close()}}
            </div>
        </div>
    </div>

    <script src="{{ asset('js/custom/script.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/tvw6vw44ubj93wgcej662z7qhm9eoqhlk2a4biwpq4z2237c/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({ selector:'textarea.editor',
            height:300,
            menubar: true,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code',
                'wordcount',
                'code'
            ],
            toolbar: 'insertfile  undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent| link image code',
            relative_urls: false,
            image_advtab: true,
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype == 'image') {
                    $('#upload').trigger('click');
                    $('#upload').on('change', function() {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            callback(e.target.result, {
                                alt: ''
                            });
                        };
                        reader.readAsDataURL(file);
                    });
                }
            },

            templates: [{
                title: 'Test template 1',
                content: 'Test 1'
            }, {
                title: 'Test template 2',
                content: 'Test 2'
            }]
        });
    </script>
@endsection
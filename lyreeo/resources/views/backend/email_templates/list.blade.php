@extends('backend.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <h2> {{ __('sentence.email_template_lang.email_template')}}</h2>
            <div class="loader"></div>
            <div class="col-md-9">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('sentence.email_template_lang.code')}}</th>
                    <th scope="col">{{ __('sentence.email_template_lang.name')}}</th>
                    <th scope="col">{{ __('sentence.email_template_lang.subject')}}</th>
                    <th scope="col">{{ __('sentence.email_template_lang.view')}}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($emailTemplates as $key =>$emailTemplate)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{!! $emailTemplate['template_code'] !!}</td>
                            <td>{!! $emailTemplate['template_name'] !!}</td>
                            <td>{!! $emailTemplate['template_subject'] !!}</td>
                            <td> <a href="{{route('template_detail', $emailTemplate['id'])}}">{{ __('sentence.email_template_lang.view_details')}} </a> </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
       </div>
    </div>
@endsection
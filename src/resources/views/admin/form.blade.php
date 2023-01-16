@extends('twill::layouts.form')

@php
    use A17\TwillSecurityHeaders\Support\Facades\TwillSecurityHeaders;
@endphp

@section('contentFields')
    @formField('input', [
        'type' => 'textarea',
        'rows' => 6,
        'name' => 'protected',
        'label' => 'Protected',
        'required' => true,
        'disabled' => TwillSecurityHeaders::hasDotEnv(),
    ])

    @formField('input', [
        'type' => 'textarea',
        'rows' => 6,
        'name' => 'unprotected',
        'label' => 'Unprotected',
        'required' => true,
        'disabled' => TwillSecurityHeaders::hasDotEnv(),
    ])
@stop

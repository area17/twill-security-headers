@extends('twill::layouts.form', ['disableContentFieldset' => true])

@section('fieldsets')
    <a17-fieldset title="Unwanted headers" id="unwanted-headers" :open="true">
        @formField('input', [
            'name' => 'unwanted_headers',
            'label' => 'Unwanted headers',
            'note' => 'List all separated by comma (,)',
        ])
    </a17-fieldset>

    @foreach ($form_fields['headers'] as $header)
        <a17-fieldset title="{{ $header['form']['title'] }}" id="id-{{ $header['type'] }}" :open="true">
            @include('twill-security-headers::admin.form-' . $header['type'])
        </a17-fieldset>
    @endforeach
@stop

{{--@extends('errors::minimal')--}}

{{--@section('title', __('Forbidden'))--}}
{{--@section('code', '403')--}}
{{--@section('message', __($exception->getMessage() ?: 'Forbidden'))--}}

<link rel="stylesheet" href="{{ asset('css/error.less') }}">
<div class="container">
    <h1>ببخشید دوستان صفحه ممنوعه</h1>
    <p>{{  __($exception->getMessage() ?: 'Forbidden') }}</p>
</div>

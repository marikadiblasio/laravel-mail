@extends('errors::minimal')
<div style="color:red">
@section('title', __('Not Found'))
@section('code')
    <span style="color:red">404</span>
@endsection
@section('message')
<span style="color:red; text-transform:capitalize">Oops... We couldn't find the page. Make sure the url is correct!!</span>
@endsection
</div>

{{-- <div class="page404">
    Ops... We could not find the page. Make sure the url is correct!!
</div> --}}

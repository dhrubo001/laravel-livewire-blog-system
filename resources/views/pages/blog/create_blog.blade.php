@extends('layouts.app')
@section('content')
    <!--  Top Header -->
    @include('includes.after_auth_header')


    <!--  Livewire Component -->
    @livewire('create-post')
@endsection

@extends('layouts.app')
@section('content')
    @include('includes.after_auth_header')
    @livewire('update-post', ['postId' => $postId])
@endsection

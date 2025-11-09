@extends('layouts.app')
@section('content')
    <div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Login to Your Account</h2>
        @include('includes.flashMessages')
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-gray-700 mb-1">Email Address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block text-gray-700 mb-1">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">Login</button>
            </div>
        </form>

        <p class="text-center text-gray-600 mt-6">Don't have an account?
            <a href="{{ route('getRegister') }}" class="text-blue-600 hover:underline font-medium">Register here</a>
        </p>
    </div>
@endsection

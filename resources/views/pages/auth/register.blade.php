@extends('layouts.app')
@section('content')
    <div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Create an Account</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('postRegister') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 mb-1">Full Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block text-gray-700 mb-1">Email Address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="mobile" class="block text-gray-700 mb-1">Mobile Number</label>
                <input id="mobile" name="mobile" type="text" value="{{ old('mobile') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block text-gray-700 mb-1">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-700 mb-1">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">Register</button>
            </div>
        </form>

        <p class="text-center text-gray-600 mt-6">Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Login here</a>
        </p>
    </div>

@endsection

@extends('layout.main_layout')

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-slate-800 shadow-md rounded-lg p-8 w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">{{ __('Login') }}</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email or Username -->
                <div class="relative z-0 w-full mb-6 group">
                    <input id="login" type="text" name="login" value="{{ old('login') }}" required
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('login') is-invalid @enderror"
                           placeholder=" " autofocus>
                    <label for="login"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Email or Username') }}
                    </label>
                    @error('login')
                    <span class="text-red-500 text-sm">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="relative z-0 w-full mb-6 group">
                    <input id="password" type="password" name="password" required
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('password') is-invalid @enderror"
                           placeholder=" ">
                    <label for="password"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Password') }}
                    </label>
                    @error('password')
                    <span class="text-red-500 text-sm">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <!-- Role -->
                <div class="relative z-0 w-full mb-6 group">
                    <label for="role" class="block text-sm text-gray-500 mb-2">{{ __('Role') }}</label>
                    <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                    <span class="text-red-500 text-sm">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Admin Code -->
                <div class="relative z-0 w-full mb-6 group" id="admin-code-container" style="display: none;">
                    <input id="adminCode" type="text" name="adminCode"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('adminCode') is-invalid @enderror"
                           placeholder=" ">
                    <label for="adminCode"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Admin Code') }}
                    </label>
                    @error('adminCode')
                    <span class="text-red-500 text-sm">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="remember" class="ml-2 text-sm text-gray-900">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <!-- Login Button -->
                <div class="flex justify-between items-center">
                    <button type="submit"
                            class="bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none focus:ring-4 focus:ring-blue-300">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:underline"
                           href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function () {
            const adminCodeContainer = document.getElementById('admin-code-container');
            if (this.value === 'admin') {
                adminCodeContainer.style.display = 'block';
            } else {
                adminCodeContainer.style.display = 'none';
            }
        });
    </script>
@endsection

@extends('layout.main_layout')

@section('content')
    <div class="flex items-center justify-center min-h-screen ">
        <div class="bg-slate-800 shadow-lg rounded-lg w-full max-w-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{ __('Register') }}</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- First Name -->
                <div class="relative z-0 w-full mb-5 group">
                    <input id="firstname" type="text" name="firstname"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('firstname') border-red-500 @enderror"
                           value="{{ old('firstname') }}" required autocomplete="firstname" autofocus placeholder=" " />
                    <label for="firstname" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('First Name') }}
                    </label>
                    @error('firstname')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="relative z-0 w-full mb-5 group">
                    <input id="lastname" type="text" name="lastname"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('lastname') border-red-500 @enderror"
                           value="{{ old('lastname') }}" required autocomplete="lastname" placeholder=" " />
                    <label for="lastname" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Last Name') }}
                    </label>
                    @error('lastname')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="relative z-0 w-full mb-5 group">
                    <input id="phonenumber" type="text" name="phonenumber"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('phonenumber') border-red-500 @enderror"
                           value="{{ old('phonenumber') }}" required autocomplete="phonenumber" placeholder=" " />
                    <label for="phonenumber" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Phone Number') }}
                    </label>
                    @error('phonenumber')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="relative z-0 w-full mb-5 group">
                    <input id="email" type="email" name="email"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('email') border-red-500 @enderror"
                           value="{{ old('email') }}" required autocomplete="email" placeholder=" " />
                    <label for="email" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Email Address') }}
                    </label>
                    @error('email')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <input id="username" type="text" name="username"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('username') border-red-500 @enderror"
                           value="{{ old('username') }}" required autocomplete="username" placeholder=" " />
                    <label for="username" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Username') }}
                    </label>
                    @error('username')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="relative z-0 w-full mb-5 group">
                    <input id="password" type="password" name="password"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('password') border-red-500 @enderror"
                           required autocomplete="new-password" placeholder=" " />
                    <label for="password" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Password') }}
                    </label>
                    @error('password')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="relative z-0 w-full mb-5 group">
                    <input id="password-confirm" type="password" name="password_confirmation"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                           required autocomplete="new-password" placeholder=" " />
                    <label for="password-confirm" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Confirm Password') }}
                    </label>
                </div>
                <div class="row mb-3">
                    <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                
                    <div class="col-md-6">
                        <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3" id="admin-code-container" style="display: none;">
                    <label for="adminCode" class="col-md-4 col-form-label text-md-end">{{ __('Admin Code') }}</label>
                
                    <div class="col-md-6">
                        <input id="adminCode" type="text" class="form-control @error('adminCode') is-invalid @enderror" name="adminCode" value="{{ old('adminCode') }}">
                
                        @error('adminCode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ __('Register') }}
                    </button>
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

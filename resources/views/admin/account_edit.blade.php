@extends('layout.layout')

@section('content')
<main id="mainAccount" class="p-6 bg-gray-100 min-h-screen flex flex-col items-center">
    @if(session('success'))
        <div class="alert alert-success bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Admin-accountinformatie (Gaby) -->
    <div class="account-info bg-white shadow-md rounded-lg p-6 w-full max-w-md mb-6">
        <h1 class="text-xl font-bold mb-4">Admin Account</h1>
        <div class="info-block text-gray-700">
            <p><strong>Naam:</strong> {{ $admin->name }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
        </div>
        <button id="editButton" 
                onclick="toggleEdit()" 
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">
            Account bewerken
        </button>
    </div>

    <!-- Bewerken formulier met admincodevalidatie (Gaby) -->
    <div class="edit-info bg-white shadow-md rounded-lg p-6 w-full max-w-md hidden">
        <h1 class="text-xl font-bold mb-4">Gegevens bewerken</h1>
        <form id="changeInfoForm" action="{{ route('admin.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block font-medium text-gray-700">Nieuwe Naam:</label>
                <input type="text" id="name" name="name" value="{{ $admin->name }}" 
                       class="mt-1 block w-full px-3 py-2 border rounded focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="email" class="block font-medium text-gray-700">Nieuwe Email:</label>
                <input type="email" id="email" name="email" value="{{ $admin->email }}" 
                       class="mt-1 block w-full px-3 py-2 border rounded focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="adminCode" class="block font-medium text-gray-700">Bevestig Admincode:</label>
                <input type="password" id="adminCode" name="admin_code" 
                       class="mt-1 block w-full px-3 py-2 border rounded focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="flex space-x-4">
                <button type="submit" 
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none">
                    Wijzigingen opslaan
                </button>
                <button type="button" 
                        onclick="toggleEdit()" 
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none">
                    Annuleer
                </button>
            </div>
        </form>
    </div>
</main>

<script>
    // Toggle tussen weergave van info en bewerkingsformulier (Gaby)
    function toggleEdit() {
        const infoBlock = document.querySelector('.info-block');
        const editBlock = document.querySelector('.edit-info');
        const editButton = document.getElementById('editButton');

        if (editBlock.classList.contains('hidden')) {
            infoBlock.classList.add('hidden');
            editBlock.classList.remove('hidden');
            editButton.classList.add('hidden');
        } else {
            infoBlock.classList.remove('hidden');
            editBlock.classList.add('hidden');
            editButton.classList.remove('hidden');
        }
    }
</script>
@endsection

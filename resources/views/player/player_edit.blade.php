@extends('layout.main_layout')

@section('content')
<div class="container mx-auto mt-10">
    <div class="">
        <h1 class="">Profiel Bewerken</h1>

        <!-- Succesbericht (Gaby) -->
        @if(session('success'))
            <div class="">
                {{ session('success') }}
            </div>
        @endif

        <form id="editProfileForm" method="POST" action="{{ route('user.update') }}" class="">
            @csrf
            @method('PUT')

            <!-- Naamveld  (Gaby)-->
            <div>
                <label for="firstname" class="">Voornaam:</label>
                <input type="text" id="firstname" name="firstname" value="{{ $user->firstname }}" 
                       class="" required>
            </div>

            <!-- Achternaamveld (Gaby)-->
            <div>
                <label for="lastname" class="">Achternaam:</label>
                <input type="text" id="lastname" name="lastname" value="{{ $user->lastname }}" 
                       class="" required>
            </div>

            <!-- Telefoonnummer  (Gaby) -->
            <div>
                <label for="phonenumber" class="">Telefoonnummer:</label>
                <input type="text" id="phonenumber" name="phonenumber" value="{{ $user->phonenumber }}" 
                       class="" required>
            </div>

            <!-- Email  (Gaby) -->
            <div>
                <label for="email" class="">Email:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" 
                       class="" required>
            </div>

            <!-- Bevestigingsmelding (Gaby)-->
            <div id="confirmationMessage" class="">
                Weet je zeker dat je jouw profiel wilt wijzigen? Klik dan op Bevestigen!
            </div>


            <!-- Bevestigingsknoppen (Gaby) -->
            <div id="" class="">
                <button type="submit" 
                        class="">
                    Bevestigen
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Bevestigingsmelding tonen (Gaby)
    function showConfirmation() {
        document.getElementById('confirmationMessage').classList.remove('hidden');
        document.getElementById('confirmationButtons').classList.remove('hidden');
    }

    // Bevestigingsmelding verbergen (Gaby)
    function hideConfirmation() {
        document.getElementById('confirmationMessage').classList.add('hidden');
        document.getElementById('confirmationButtons').classList.add('hidden');
    }
</script>
@endsection

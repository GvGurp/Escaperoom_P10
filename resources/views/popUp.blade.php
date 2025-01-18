<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Instellen van tekencodering (Gaby) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsieve weergave op mobiele apparaten (Gaby) -->
    <title>Word Game - Level 1</title> <!-- Titel van de pagina (Gaby) -->
    <link rel="stylesheet" href="styles.css"> <!-- Verwijzing naar de externe stylesheet (Gaby) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 library voor mooie pop-ups (Gaby) -->
</head>
<body style="background-color: #000; color: #fff; padding: 20px; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh; font-family: Arial, sans-serif;">
    <!-- Inline styling om de body te stylen (Gaby) -->

    <h1>Level 1</h1> <!-- Titel van het level (Gaby) -->
    <p>Form words from the given letters and complete this level.</p> <!-- Beschrijving van het doel van het spel (Gaby) -->
    <div id="game-area">
        <!-- Spelinteracties worden hier geladen (Gaby) -->
    </div>

    <script>
        /**
         * Functie om de introductie van het spel te tonen (Gaby)
         */
        function showGameIntro() {
            Swal.fire({
                title: 'Welcome to the Game!', <!-- Titel van de popup (Gaby) -->
                html: `
                    <p>Welcome to the exciting word game! Before you begin, let's go through the rules:</p>
                    <ul style="list-style-type: disc; padding-left: 20px;"> <!-- Opgesomde lijst van spelregels (Gaby) -->
                        <li>You will have a set time to complete each level.</li> <!-- Regel over tijdslimiet (Gaby) -->
                        <li>Use your skills to form words from the given letters.</li> <!-- Regel over het maken van woorden (Gaby) -->
                        <li>Complete as many levels as you can!</li> <!-- Regel over het doel van het spel (Gaby) -->
                    </ul>
                `,
                icon: 'info', <!-- Informatie-icoon in de popup (Gaby) -->
                showCancelButton: false, <!-- Annuleerknop uitgeschakeld (Gaby) -->
                confirmButtonText: 'Start the Game Now', <!-- Tekst van de bevestigingsknop (Gaby) -->
            }).then((result) => {
                if (result.isConfirmed) { <!-- Als de gebruiker op bevestigen klikt (Gaby) -->
                    Swal.close(); <!-- Sluit de popup (Gaby) -->
                    window.location.href = '{{ url('/level1_woordcode') }}'; <!-- Redirect naar level 1 (Gaby) -->
                }
            });
        }

        /**
         * Eventlistener om ervoor te zorgen dat de functie wordt uitgevoerd
         * zodra de DOM volledig is geladen (Gaby)
         */
        document.addEventListener('DOMContentLoaded', (event) => {
            showGameIntro(); <!-- Aanroepen van de introductiefunctie (Gaby) -->
        });
    </script>
</body>
</html>

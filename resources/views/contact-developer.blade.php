<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacter le développeur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .card {
            transition: all 0.3s ease;
        }
        .btn-copy, .btn-send {
            transition: all 0.2s ease;
        }
        .copied-feedback {
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center h-screen">

    <div id="card" class="card bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 md:p-12 max-w-md w-full text-center border border-gray-200 dark:border-gray-700">
        <div class="mb-6">
            <svg class="w-16 h-16 mx-auto text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Madieye</h1>
        <p class="text-gray-500 dark:text-gray-400 mb-6">Développeur Web & Mobile</p>

        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 mb-6">
            <p id="email" class="text-lg text-indigo-600 dark:text-indigo-400 font-semibold">madieyepro@gmail.com</p>
        </div>

        <div class="flex flex-col md:flex-row gap-4">
            <button id="copy-btn" class="btn-copy w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                Copier l'email
            </button>
            <a href="mailto:madieyepro@gmail.com" class="btn-send w-full bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Envoyer un email
            </a>
        </div>
    </div>

    <div id="copied-feedback" class="copied-feedback fixed bottom-5 right-5 bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg opacity-0 transform translate-y-2">
        Email copié dans le presse-papiers !
    </div>

    <script>
        const copyBtn = document.getElementById('copy-btn');
        const emailText = document.getElementById('email').innerText;
        const feedback = document.getElementById('copied-feedback');

        copyBtn.addEventListener('click', () => {
            navigator.clipboard.writeText(emailText).then(() => {
                feedback.classList.remove('opacity-0', 'translate-y-2');
                feedback.classList.add('opacity-100', 'translate-y-0');

                setTimeout(() => {
                    feedback.classList.remove('opacity-100', 'translate-y-0');
                    feedback.classList.add('opacity-0', 'translate-y-2');
                }, 2000);
            });
        });

        // Effet de "flottement" sur la carte
        const card = document.getElementById('card');
        document.addEventListener('mousemove', (e) => {
            const { clientX, clientY } = e;
            const { innerWidth, innerHeight } = window;
            const x = (clientX / innerWidth - 0.5) * 2;
            const y = (clientY / innerHeight - 0.5) * 2;
            card.style.transform = `rotateY(${x * 5}deg) rotateX(${-y * 5}deg)`;
        });
    </script>

</body>
</html>

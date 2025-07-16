<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ton Avis Compte !</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Baloo 2', cursive;
            background-color: #F0F4F8;
        }
        .form-container {
            background-color: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }
        .form-container:hover {
            transform: translateY(-5px);
        }
        .btn-cool {
            border-radius: 50px;
            padding: 0.8rem 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-cool:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating label {
            font-size: 2.5rem;
            color: #d1d5db;
            cursor: pointer;
            transition: color 0.2s;
        }
        .star-rating input[type="radio"]:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f59e0b;
        }
        .ts-dropdown {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }
        .ts-control {
            border-radius: 12px !important;
            padding: 0.9rem !important;
            border: 1px solid #d1d5db !important;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-gray-50">

    <header class="bg-indigo-600 text-white shadow-lg w-full">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
            <h1 class="text-xl sm:text-2xl font-bold text-center tracking-wider">Colonie Trésor 2025</h1>
        </div>
    </header>

    <main class="w-full max-w-2xl mx-auto p-4 sm:p-8 flex-grow flex items-center justify-center">
        <div class="w-full">

            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800">Salut le Colon ! 👋</h1>
                <p class="text-lg text-gray-600 mt-2">Donne-nous ton avis, ça nous aide beaucoup !</p>
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                <p class="font-bold">Super !</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="child_id" class="block text-lg font-bold text-gray-700 mb-2">C'est qui ?</label>
                                        <select name="child_id" id="child_id" placeholder="Recherche ton nom ici...">
                        <option value="">Choisis ton nom dans la liste...</option>
                        @foreach($children as $child)
                            <option value="{{ $child->id }}">{{ $child->first_name }} {{ $child->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-8">
                    <p class="block text-lg font-bold text-gray-700 mb-3">Tu veux faire quoi ?</p>
                    <div class="flex justify-center space-x-4">
                        <button type="button" id="btn-review" class="btn-cool bg-blue-500 text-white">Noter une activité</button>
                        <button type="button" id="btn-wish" class="btn-cool bg-purple-500 text-white">Faire un souhait</button>
                        <input type="hidden" name="feedback_type" id="feedback_type" value="">
                    </div>
                </div>

                <!-- Formulaire pour noter une activité -->
                <div id="form-review" class="hidden space-y-6">
                    <div>
                        <label for="activity_name" class="block text-lg font-bold text-gray-700 mb-2">Quelle activité ?</label>
                        <input type="text" name="activity_name" id="activity_name" class="block w-full p-4 text-lg border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Ex: Le grand jeu de piste">
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-gray-700 mb-2">C'était comment ?</label>
                        <div class="star-rating flex flex-row-reverse justify-center items-center">
                            <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
                            <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                            <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                            <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                            <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
                        </div>
                    </div>
                    <div>
                        <label for="comment" class="block text-lg font-bold text-gray-700 mb-2">Raconte-nous ! (pas obligatoire)</label>
                        <textarea name="comment" id="comment" rows="4" class="block w-full p-4 text-lg border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Dis-nous tout ce que tu veux..."></textarea>
                    </div>
                </div>

                <!-- Formulaire pour faire un souhait -->
                <div id="form-wish" class="hidden space-y-6">
                    <div>
                        <label for="wish_category" class="block text-lg font-bold text-gray-700 mb-2">C'est un souhait pour...</label>
                        <select name="wish_category" id="wish_category" class="block w-full p-4 text-lg border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="Repas">Un repas 🍕</option>
                            <option value="Activité">Une activité ⚽</option>
                            <option value="Autre">Autre chose ✨</option>
                        </select>
                    </div>
                    <div>
                        <label for="wish_description" class="block text-lg font-bold text-gray-700 mb-2">Quel est ton souhait ?</p>
                        <textarea name="wish_description" id="wish_description" rows="4" class="block w-full p-4 text-lg border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="J'aimerais trop qu'on ait..."></textarea>
                    </div>
                </div>

                <div id="submit-button-container" class="text-center mt-8 hidden">
                    <button type="submit" class="btn-cool bg-green-500 text-white text-xl">Envoyer !</button>
                </div>
            </form>
        </div>
    </div>

        </div>
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new TomSelect('#child_id',{
				create: false,
				sortField: {
					field: "text",
					direction: "asc"
				}
			});

            const btnReview = document.getElementById('btn-review');
            const btnWish = document.getElementById('btn-wish');
            const formReview = document.getElementById('form-review');
            const formWish = document.getElementById('form-wish');
            const feedbackTypeInput = document.getElementById('feedback_type');
            const submitContainer = document.getElementById('submit-button-container');

            function showForm(formToShow, feedbackType) {
                formReview.classList.add('hidden');
                formWish.classList.add('hidden');
                formToShow.classList.remove('hidden');
                feedbackTypeInput.value = feedbackType;
                submitContainer.classList.remove('hidden');
            }

            btnReview.addEventListener('click', () => {
                showForm(formReview, 'review');
                btnReview.classList.add('ring-4', 'ring-blue-300');
                btnWish.classList.remove('ring-4', 'ring-purple-300');
            });

            btnWish.addEventListener('click', () => {
                showForm(formWish, 'wish');
                btnWish.classList.add('ring-4', 'ring-purple-300');
                btnReview.classList.remove('ring-4', 'ring-blue-300');
            });
        });
    </script>

</body>
</html>

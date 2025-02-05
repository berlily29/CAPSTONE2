<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Setup - Select Your Interests</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .category-box {
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            background-color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
        }

        /* Active state when clicked */
        .category-box.active {
            background-color: #38a169;
            border-color: transparent;
        }

        /* Hover effect */
        .category-box:hover {
            transform: scale(1.05);
        }

        /* Ensure h4 and img change color in active state */
        .category-box.active h4 {
            color: white;
        }

        /* Hide the checkbox */
        input[type="checkbox"] {
            display: none;
        }

        /* Ensure flex behavior */
        .category-box .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .category-box img {
            max-width: 100px;
            max-height: 100px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="bg-gray-50">

    <form action="{{route('auth.preferences.store')}}" method="POST">
        @csrf

        <input type="text" name="user_id" value="{{$uid}}" hidden>
        <div class="min-h-screen p-8">

            <section class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Select Your Interests</h2>
                <p class="text-lg text-gray-600 mb-8">Choose the categories you are most interested in:</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 px-24">
                    @foreach ($categories as $category)
                    <label class="category-box" data-category="{{ $category->name }}">
                        <input type="checkbox" name="preferences[]" value="{{ $category->name }}">
                        <div class="content">
                            <img src="{{ asset('images/icons/preferences/' . $category->name . '.png') }}" alt="{{ $category->name }} Icon">
                            <h4 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h4>
                        </div>
                    </label>
                    @endforeach
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-pink-500 text-white p-3 rounded-lg hover:bg-pink-600 transition-colors text-sm" id="submitButton" disabled>
                        Save Your Preferences
                    </button>
                </div>
            </section>

        </div>
    </form>

    <script>
        // Handle the category box click to toggle active class and checkbox state
        document.querySelectorAll('.category-box').forEach(box => {
            box.addEventListener('click', function(event) {
                // Prevent click from triggering twice when clicking child elements
                if (event.target.tagName === 'INPUT') return;

                const checkbox = this.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
                this.classList.toggle('active');
                toggleSubmitButton();
            });
        });

        // Check if any checkbox is selected and enable/disable the submit button
        function toggleSubmitButton() {
            const submitButton = document.getElementById('submitButton');
            const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            submitButton.disabled = checkboxes.length === 0;
        }

        // Initially check if any checkbox is selected when the page loads
        document.addEventListener('DOMContentLoaded', toggleSubmitButton);
    </script>

</body>
</html>

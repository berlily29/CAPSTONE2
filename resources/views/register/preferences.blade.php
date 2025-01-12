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
        }

        /* Active state when clicked */
        .category-box.active {
            background-color: #38a169; /* Green background */
            border-color: transparent;
            color: white;
        }

        /* Hover effect */
        .category-box:hover {
            transform: scale(1.05); /* Slightly enlarge the box on hover */
        }

        /* Icon and label color change in active state */
        .category-box.active h4 {
            color: white;
        }

        /* Image styling */
        .category-box img {
            max-width: 150px;
            max-height: 150px;
            margin-bottom: 10px;
        }

        /* Checkbox visibility */
        input[type="checkbox"] {
            display: none;
        }

        /* Box styling */
        .category-box {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .category-box .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        /* Active checkbox styling */
        input[type="checkbox"]:checked + .category-box {
            background-color: #38a169; /* Green background */
            border-color: transparent;
        }

        /* Active state for the label h4 */
        input[type="checkbox"]:checked + .category-box h4 {
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50">

    <form action="{{route('auth.preferences.store')}}" method="POST">
        @csrf



        <input type="text" name = "user_id" value = "{{$uid}}" hidden>
        <div class="min-h-screen p-8">

            <!-- Category Selection -->
            <section class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Select Your Interests</h2>
                <p class="text-lg text-gray-600 mb-8">Choose the categories you are most interested in:</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 px-24 ">
                    @foreach ($categories as $category)
                    <label class="category-box py-12 px-6 bg-white rounded-lg border border-gray-200 flex flex-col items-center justify-center"
                        data-category="{{ $category->name }}">

                        <!-- Entire box content is clickable -->
                        <div class="content">
                            <!-- Icon Image (replace with your images) -->
                            <a href="#" class="">
                                <img src="{{ asset('images/icons/preferences/' . $category->name . '.png') }}" alt="{{ $category->name }} Icon" class="w-[150px] h-[150px]">
                            </a>

                            <h4 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h4>
                        </div>

                        <input type="checkbox" name="preferences[]" value="{{ $category->name }}" class="hidden">

                    </label>
                    @endforeach
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="bg-pink-500 text-white p-3 rounded-lg hover:bg-pink-600 transition-colors text-sm">
                        Save Your Preferences
                    </button>
                </div>
            </section>

        </div>
    </form>

    <script>
        // JavaScript to toggle active state on click (for the whole box)
        document.querySelectorAll('.category-box').forEach(item => {
            item.addEventListener('click', function() {
                // Find the checkbox inside the clicked box
                const checkbox = this.querySelector('input[type="checkbox"]');

                // Toggle the checkbox state
                checkbox.checked = !checkbox.checked;

                // Toggle the 'active' class on the label (category box)
                this.classList.toggle('active');
            });
        });
    </script>

</body>
</html>

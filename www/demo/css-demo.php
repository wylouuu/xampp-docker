<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS & Framework Demo</title>
    
    <!-- Tailwind CSS via CDN (for quick testing) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- jQuery via CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Custom CSS -->
    <style>
        .custom-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .5;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header with Tailwind -->
        <div class="custom-gradient text-white p-6 rounded-lg shadow-lg mb-6">
            <h1 class="text-4xl font-bold mb-2">🎨 CSS & Framework Demo</h1>
            <p class="text-lg">Everything works like XAMPP - CSS, Tailwind, jQuery, and more!</p>
        </div>
        
        <!-- CSS Test -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-semibold mb-4">✅ Custom CSS Test</h2>
            <div class="pulse-animation bg-blue-500 text-white p-4 rounded">
                This box uses custom CSS animation - it's pulsing!
            </div>
        </div>
        
        <!-- Tailwind CSS Test -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-semibold mb-4">🎨 Tailwind CSS Test</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-500 text-white p-4 rounded-lg hover:bg-blue-600 transition">
                    Card 1
                </div>
                <div class="bg-green-500 text-white p-4 rounded-lg hover:bg-green-600 transition">
                    Card 2
                </div>
                <div class="bg-purple-500 text-white p-4 rounded-lg hover:bg-purple-600 transition">
                    Card 3
                </div>
            </div>
        </div>
        
        <!-- jQuery Test -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-semibold mb-4">⚡ jQuery Test</h2>
            <button id="jquery-btn" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                Click Me (jQuery)
            </button>
            <div id="jquery-result" class="mt-4 p-4 bg-gray-100 rounded hidden">
                jQuery is working! Clicked at: <span id="timestamp"></span>
            </div>
        </div>
        
        <!-- PHP Integration Test -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-semibold mb-4">🐘 PHP Integration</h2>
            <p class="text-gray-700 mb-2">PHP Version: <strong><?php echo phpversion(); ?></strong></p>
            <p class="text-gray-700 mb-2">Current Time: <strong><?php echo date('Y-m-d H:i:s'); ?></strong></p>
            <p class="text-gray-700">Server: <strong><?php echo $_SERVER['SERVER_SOFTWARE']; ?></strong></p>
        </div>
        
        <!-- Auto-Reload Script -->
        <script src="/_auto-reload.js"></script>
        
        <!-- jQuery Scripts -->
        <script>
            $(document).ready(function() {
                $('#jquery-btn').on('click', function() {
                    const now = new Date().toLocaleTimeString();
                    $('#timestamp').text(now);
                    $('#jquery-result').removeClass('hidden').addClass('block');
                    
                    // Animate the result
                    $('#jquery-result').hide().fadeIn(500);
                    
                    // Change button text
                    $(this).text('Clicked! ✓').addClass('bg-green-600');
                });
            });
        </script>
    </div>
</body>
</html>


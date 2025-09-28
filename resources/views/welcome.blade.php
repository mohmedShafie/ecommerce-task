<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-Commerce Store') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .category-card {
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <h1 class="text-2xl font-bold text-gray-900">ShopEase</h1>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-lg mx-8">
                    <div class="relative">
                        <input type="text" placeholder="Search products..."
                            class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Categories</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Deals</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">About</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Contact</a>
                </div>

                <!-- User Actions -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-700 hover:text-blue-600">
                        <i class="fas fa-user text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 relative">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">
                        <i class="fas fa-heart text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl font-bold mb-6">Discover Amazing Products</h1>
                    <p class="text-xl mb-8 text-gray-100">Shop the latest trends and find everything you need in one
                        place. Quality products at unbeatable prices.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button
                            class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                            Shop Now
                        </button>
                        <button
                            class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                            Learn More
                        </button>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                        alt="Shopping" class="rounded-lg shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Shop by Category</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <div class="category-card text-center p-6 bg-gray-50 rounded-lg cursor-pointer">
                    <i class="fas fa-tshirt text-4xl text-blue-600 mb-4"></i>
                    <h3 class="font-semibold text-gray-900">Fashion</h3>
                </div>
                <div class="category-card text-center p-6 bg-gray-50 rounded-lg cursor-pointer">
                    <i class="fas fa-laptop text-4xl text-green-600 mb-4"></i>
                    <h3 class="font-semibold text-gray-900">Electronics</h3>
                </div>
                <div class="category-card text-center p-6 bg-gray-50 rounded-lg cursor-pointer">
                    <i class="fas fa-home text-4xl text-purple-600 mb-4"></i>
                    <h3 class="font-semibold text-gray-900">Home</h3>
                </div>
                <div class="category-card text-center p-6 bg-gray-50 rounded-lg cursor-pointer">
                    <i class="fas fa-gamepad text-4xl text-red-600 mb-4"></i>
                    <h3 class="font-semibold text-gray-900">Gaming</h3>
                </div>
                <div class="category-card text-center p-6 bg-gray-50 rounded-lg cursor-pointer">
                    <i class="fas fa-dumbbell text-4xl text-orange-600 mb-4"></i>
                    <h3 class="font-semibold text-gray-900">Sports</h3>
                </div>
                <div class="category-card text-center p-6 bg-gray-50 rounded-lg cursor-pointer">
                    <i class="fas fa-book text-4xl text-indigo-600 mb-4"></i>
                    <h3 class="font-semibold text-gray-900">Books</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Featured Products</h2>
                <button class="text-blue-600 font-semibold hover:text-blue-800">View All</button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Product 1 -->
                <div class="product-card bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                        alt="Product" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Premium Sneakers</h3>
                        <p class="text-gray-600 text-sm mb-3">Comfortable and stylish</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-gray-900">$99.99</span>
                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="product-card bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                        alt="Product" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Wireless Headphones</h3>
                        <p class="text-gray-600 text-sm mb-3">High quality sound</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-gray-900">$149.99</span>
                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="product-card bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2099&q=80"
                        alt="Product" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Smart Watch</h3>
                        <p class="text-gray-600 text-sm mb-3">Track your fitness</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-gray-900">$199.99</span>
                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="product-card bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2126&q=80"
                        alt="Product" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Gaming Laptop</h3>
                        <p class="text-gray-600 text-sm mb-3">High performance</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-gray-900">$1299.99</span>
                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shipping-fast text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Free Shipping</h3>
                    <p class="text-gray-600">Free shipping on orders over $50</p>
                </div>
                <div class="text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-undo text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Easy Returns</h3>
                    <p class="text-gray-600">30-day return policy</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Customer support anytime</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
            <p class="text-xl text-gray-300 mb-8">Subscribe to our newsletter for the latest deals and updates</p>
            <div class="max-w-md mx-auto flex">
                <input type="email" placeholder="Enter your email"
                    class="flex-1 px-4 py-3 rounded-l-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button class="bg-blue-600 px-6 py-3 rounded-r-lg hover:bg-blue-700 transition duration-300">
                    Subscribe
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">ShopEase</h3>
                    <p class="text-gray-400 mb-4">Your one-stop shop for everything you need. Quality products at great
                        prices.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i
                                class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i
                                class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i
                                class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i
                                class="fab fa-linkedin text-xl"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Support</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Categories</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Electronics</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Fashion</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Home & Garden</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Sports</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-map-marker-alt mr-2"></i>123 Store Street, City</li>
                        <li><i class="fas fa-phone mr-2"></i>+1 (555) 123-4567</li>
                        <li><i class="fas fa-envelope mr-2"></i>info@shopease.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 ShopEase. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for interactivity -->
    <script>
        // Simple cart counter animation
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('button[class*="bg-blue-600"]');
            const cartCounter = document.querySelector('.bg-red-500');

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Add animation effect
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);

                    // Update cart counter (simple example)
                    if (cartCounter) {
                        let count = parseInt(cartCounter.textContent);
                        cartCounter.textContent = count + 1;
                    }
                });
            });
        });
    </script>
</body>

</html>

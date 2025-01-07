<footer class="bg-gray-900">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- About Section -->
            <div class="space-y-4">
                <h3 class="text-white text-lg font-semibold">About ShopApp</h3>
                <p class="text-gray-400 text-sm">Your one-stop shop for all your needs. Quality products at affordable prices.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4">
                <h3 class="text-white text-lg font-semibold">Quick Links</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-white text-sm flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white text-sm flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i> Products
                        </a>
                    </li>
                    <li>
                        <a href="/about" class="text-gray-400 hover:text-white text-sm flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i> About Us
                        </a>
                    </li>
                    <li>
                        <a href="/contact" class="text-gray-400 hover:text-white text-sm flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i> Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div class="space-y-4">
                <h3 class="text-white text-lg font-semibold">Customer Service</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="/shipping" class="text-gray-400 hover:text-white text-sm flex items-center">
                            <i class="fas fa-truck text-xs mr-2"></i> Shipping Info
                        </a>
                    </li>
                    <li>
                        <a href="/returns" class="text-gray-400 hover:text-white text-sm flex items-center">
                            <i class="fas fa-undo text-xs mr-2"></i> Returns
                        </a>
                    </li>
                    <li>
                        <a href="/faq" class="text-gray-400 hover:text-white text-sm flex items-center">
                            <i class="fas fa-question-circle text-xs mr-2"></i> FAQ
                        </a>
                    </li>
                    <li>
                        <a href="/privacy" class="text-gray-400 hover:text-white text-sm flex items-center">
                            <i class="fas fa-shield-alt text-xs mr-2"></i> Privacy Policy
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="space-y-4">
                <h3 class="text-white text-lg font-semibold">Newsletter</h3>
                <p class="text-gray-400 text-sm">Subscribe to receive updates, access to exclusive deals, and more.</p>
                <form class="flex flex-col space-y-2">
                    <input type="email" placeholder="Enter your email" class="px-4 py-2 bg-gray-800 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i> Subscribe
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-gray-800">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} ShopApp. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="/terms" class="text-gray-400 hover:text-white text-sm">Terms & Conditions</a>
                    <a href="/privacy" class="text-gray-400 hover:text-white text-sm">Privacy Policy</a>
                    <a href="/sitemap" class="text-gray-400 hover:text-white text-sm">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>

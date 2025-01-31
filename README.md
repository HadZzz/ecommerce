# Laravel E-Commerce Application

A modern e-commerce application built with Laravel, featuring AI-powered recommendations, responsive design, secure payment processing, and comprehensive product management.

## Features

- 🤖 **AI-Powered Features**
  - Smart product recommendations using TF-IDF algorithm
  - Similarity-based product suggestions
  - Personalized shopping experience
  - Real-time recommendation updates

- 🛍️ **Product Management**
  - Categories and subcategories
  - Product variants and attributes
  - Stock management
  - Image handling with media library
  - Detailed product pages with rich information

- 🛒 **Shopping Experience**
  - User-friendly product browsing
  - Advanced search and filtering
  - Shopping cart functionality
  - Wishlist management
  - Product reviews and ratings with interactive star system
  - Related products suggestions

- 💳 **Checkout Process**
  - Multiple payment methods (Cash on Delivery, Bank Transfer)
  - Order tracking
  - Email notifications
  - Order history

- 👤 **User Management**
  - User authentication
  - Admin and customer roles
  - Profile management
  - Address management
  - Review management

- 📱 **Modern UI/UX**
  - Responsive design for all devices
  - Intuitive navigation system
  - Clean and modern interface with Tailwind CSS
  - Interactive product galleries
  - Dynamic rating system
  - Toast notifications
  - Loading states and animations

## Tech Stack

- **Framework:** Laravel 10
- **Database:** MySQL
- **Frontend:** 
  - Blade Templates
  - Tailwind CSS
  - Alpine.js
  - Font Awesome Icons
- **Authentication:** Laravel Breeze
- **File Storage:** Laravel Media Library
- **Machine Learning:** PHP-ML for TF-IDF implementation
- **Additional Libraries:**
  - Livewire for dynamic components
  - Spatie Media Library for image management

## Quick Start

1. Clone the repository
```bash
git clone https://github.com/yourusername/ecom.git
cd ecom
```

2. Install dependencies
```bash
composer install
npm install
```

3. Copy environment file and set your configuration
```bash
cp .env.example .env
```

4. Generate application key
```bash
php artisan key:generate
```

5. Run migrations and seeders
```bash
php artisan migrate --seed
```

6. Start the development server
```bash
php artisan serve
npm run dev
```

## Default Users

### Admin User
- Email: admin@example.com
- Password: password

### Regular User
- Email: user@example.com
- Password: password

## Key Features Implementation

### AI Recommendation System
The system uses TF-IDF (Term Frequency-Inverse Document Frequency) algorithm to:
- Analyze product descriptions and categories
- Calculate similarity scores between products
- Generate personalized recommendations
- Update suggestions in real-time

### Interactive Reviews
- Star rating system with hover effects
- Real-time rating updates
- User-friendly review form
- Review history and management

### Product Management
- Comprehensive product details
- Multiple product images
- Stock tracking
- Category management
- Related products functionality

## Database Structure

The application uses several key tables:
- `users` - User management
- `categories` - Product categories
- `products` - Product information
- `orders` - Order management
- `order_items` - Order details
- `carts` - Shopping cart
- `wishlists` - User wishlists
- `reviews` - Product reviews and ratings
- `media` - Product images and media files

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'feat: add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Commit Convention

We follow the [Conventional Commits](https://www.conventionalcommits.org/) specification:

- `feat:` - New features
- `fix:` - Bug fixes
- `docs:` - Documentation changes
- `style:` - Code style changes (formatting, etc)
- `refactor:` - Code refactoring
- `test:` - Adding or updating tests
- `chore:` - Maintenance tasks

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support, please create an issue in the GitHub repository or contact the development team.

## Acknowledgments

- [Laravel](https://laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [PHP-ML](https://php-ml.readthedocs.io/)
- [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary)

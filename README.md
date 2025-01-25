# Laravel E-Commerce Application

A modern e-commerce application built with Laravel, featuring a responsive design, secure payment processing, and comprehensive product management.

## Features

- 🛍️ **Product Management**
  - Categories and subcategories
  - Product variants and attributes
  - Stock management
  - Image handling with media library

- 🛒 **Shopping Experience**
  - User-friendly product browsing
  - Advanced search and filtering
  - Shopping cart functionality
  - Wishlist management
  - Product reviews and ratings

- 💳 **Checkout Process**
  - Multiple payment methods (Cash on Delivery, Bank Transfer, Stripe)
  - Order tracking
  - Email notifications
  - Order history

- 👤 **User Management**
  - User authentication
  - Admin and customer roles
  - Profile management
  - Address management

- 📱 **Responsive Design**
  - Mobile-first approach
  - Modern UI with Tailwind CSS
  - Smooth user experience

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
- **Payment Processing:** Stripe Integration (optional)

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

## Database Structure

The application uses several key tables:
- `users` - User management
- `categories` - Product categories
- `products` - Product information
- `orders` - Order management
- `order_items` - Order details
- `carts` - Shopping cart
- `wishlists` - User wishlists
- `reviews` - Product reviews

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support, please create an issue in the GitHub repository or contact the development team.

## Acknowledgments

- [Laravel](https://laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [Font Awesome](https://fontawesome.com)

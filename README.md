# 📖 PHP & Vue Journal

A beautiful, modern journaling web application built with PHP, Laravel, and Vue.js. Write, organize, and reflect on your thoughts with a sleek interface featuring dark/light themes, elegant typography, and sunset-inspired gradients.

## ✨ Features

- **📝 Journal Entries**: Create, read, update, and delete journal entries
- **🏷️ Tagging System**: Organize entries with custom tags
- **🎨 Dark/Light Theme**: Toggle between themes with persistent preference
- **✍️ Handwriting Font**: Beautiful brush script font for journal content
- **🌅 Gradient Backgrounds**: Subtle sunset-inspired gradients
- **🔐 User Authentication**: Secure login, registration, and password reset
- **📱 Responsive Design**: Works perfectly on desktop and mobile devices
- **🎯 Modern UI**: Clean, intuitive interface with smooth animations

## 🛠️ Technologies Used

### Backend
- **PHP 8.2+**
- **Laravel 12** - Full-stack framework
- **Laravel Sanctum** - API authentication
- **Laravel Breeze** - Authentication scaffolding

### Frontend
- **Vue 3** - Progressive JavaScript framework
- **Inertia.js** - SPA without API complexity
- **Tailwind CSS** - Utility-first CSS framework
- **Vite** - Fast build tool and dev server

### Database
- **SQLite** (default, for development)
- **PostgreSQL/MySQL** (production-ready)

### Development Tools
- **Laravel Sail** - Docker development environment
- **Composer** - PHP dependency management
- **NPM** - Node.js dependency management

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- **PHP 8.2 or higher**
- **Composer** - PHP dependency manager
- **Node.js 18+ and NPM**
- **Git**

### Optional (for Docker development)
- **Docker & Docker Compose**

## 🚀 Installation

### Option 1: Standard Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/php-lvl-vue-journal.git
   cd php-lvl-vue-journal
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   # For SQLite (default)
   touch database/database.sqlite

   # Or configure your preferred database in .env file
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

### Option 2: Laravel Sail (Docker)

1. **Clone and enter directory**
   ```bash
   git clone https://github.com/yourusername/php-lvl-vue-journal.git
   cd php-lvl-vue-journal
   ```

2. **Start Sail**
   ```bash
   ./vendor/bin/sail up -d
   ```

3. **Run setup commands**
   ```bash
   ./vendor/bin/sail composer install
   ./vendor/bin/sail npm install
   ./vendor/bin/sail artisan migrate
   ```

## 🎯 Running the Application

### Standard Development
```bash
# Start PHP server
php artisan serve

# Start Vite dev server (in another terminal)
npm run dev
```

Visit `http://localhost:8000`

### Laravel Sail
```bash
./vendor/bin/sail up
```

Visit `http://localhost`

### Production
```bash
# Build assets for production
npm run build

# Configure web server to serve public/ directory
```

## 📖 Usage

1. **Register/Login**: Create an account or sign in
2. **Create Entry**: Click "New Entry" to write a journal entry
3. **Add Tags**: Use comma-separated tags to organize entries
4. **View Entries**: Browse all your journal entries on the main page
5. **Edit/Delete**: Use the action buttons to modify or remove entries
6. **Theme Toggle**: Switch between light and dark themes in the navigation

## 📁 Project Structure

```
├── app/                    # Laravel application code
│   ├── Http/Controllers/   # Controllers
│   ├── Models/            # Eloquent models
│   └── Policies/          # Authorization policies
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/           # Database seeders
├── public/                # Public assets
├── resources/
│   ├── css/              # Stylesheets
│   ├── js/               # Vue.js components
│   │   ├── Components/   # Reusable Vue components
│   │   ├── Layouts/      # Page layouts
│   │   └── Pages/        # Inertia.js pages
│   └── views/            # Blade templates
├── routes/                # Route definitions
├── tests/                 # PHPUnit tests
└── config/                # Configuration files
```

## 🧪 Testing

```bash
# Run PHP tests
php artisan test

# With Sail
./vendor/bin/sail test
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙏 Acknowledgments

- [Laravel](https://laravel.com/) - The PHP framework
- [Vue.js](https://vuejs.org/) - The JavaScript framework
- [Inertia.js](https://inertiajs.com/) - SPA without APIs
- [Tailwind CSS](https://tailwindcss.com/) - Utility-first CSS
- [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze) - Authentication starter kit

## 📞 Support

If you find this project helpful, please give it a ⭐️!

For issues or questions, please open an issue on GitHub.
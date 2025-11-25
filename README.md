# DragonSphere

> Fullstack PHP Laravel Starter

**Made by Jerome Edica**

---

## Installation

### Prerequisites
- PHP 8.0+
- Composer
- Node.js & npm
- XAMPP (with Apache on port 80 and MySQL on port 3306)

### Setup Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/system-intelligence/dragon_sphere.git
   cd dragon_sphere
   ```

2. **Install dependencies:**
   ```bash
   composer require livewire/livewire
   npm i
   npm install -D tailwindcss postcss autoprefixer
   npm install -D @tailwindcss/postcss
   npm install alpinejs
   ```

---

## Configuration

Before running `npm run build`, ensure the following files are properly configured:

### postcss.config.js
```javascript
export default {
    plugins: {
        '@tailwindcss/postcss': {},
        autoprefixer: {},
    },
}
```

### tailwind.config.js
```javascript
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/**/*.php",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}
```

### resources/css/app.css
```css
@import "tailwindcss";

@source '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php';
@source '../../storage/framework/views/*.php';
@source '../**/*.blade.php';
@source '../**/*.js';

@theme {
    --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji',
        'Segoe UI Symbol', 'Noto Color Emoji';
}
```

### resources/js/app.js
```javascript
import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
```

---

## Running the Project

### Local Development
```bash
php artisan serve
npm run build
```

Access the project at: **http://localhost:8000**

### Local Network Access

To run the project on your local network:

1. **Find your IP address:**
   ```powershell
   ipconfig
   ```
   Look for the **IPv4 Address**

2. **Run the server on your IP:**
   ```bash
   php -S 192.168.1.201:8000 -t public
   ```
   *(Replace `192.168.1.201` with your actual IPv4 Address)*

3. **Access the project:**
   **http://192.168.1.201:8000**

---

## Requirements

- **Apache:** Port 80
- **MySQL:** Port 3306

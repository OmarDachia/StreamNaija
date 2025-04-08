<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Got it! If you're **cloning a Laravel 12 project that uses Vite from a repository**, here are the **setup instructions** step-by-step:

---

## ✅ 1. Clone the Repository

git clone https://github.com/your-username/your-laravel-project.git
cd your-laravel-project


## ✅ 2. Install PHP Dependencies

Make sure you have PHP ≥ 8.2 and Composer installed.

composer install

## ✅ 3. Install Node Dependencies

Make sure you have Node.js ≥ 16 and npm or yarn.


npm install
# or
yarn install

## ✅ 4. Copy and Configure `.env` File

cp .env.example .env
php artisan key:generate

Update `.env` with your database and app settings.

## ✅ 5. Run Database Migrations

Make sure your database is set up and running:

php artisan migrate

## ✅ 6. Build Frontend Assets with Vite

For development:

npm run dev

For production build:

npm run build


## ✅ 7. Start the Laravel Development Server

php artisan serve

Your app should now be running at [http://localhost:8000](http://localhost:8000)

## ✅ 8. If Using Vue or React

Make sure the correct frontend framework is installed:

- For Vue:
  
  npm install vue
 
  

And ensure your `vite.config.js` is set up accordingly.

## ✅ 9. Check for `@vite` in Blade

In your layout/view file (`resources/views/layouts/app.blade.php` or similar), ensure this is present:

@vite(['resources/css/app.css', 'resources/js/app.js'])

## 🛠 Optional: Run Vite in Hot Reload Mode (in another terminal)

npm run dev

Or use:

vite


## Features implemented
Below are Feature implemented

## Task 1.1: Video Platform Core

## Backend Development with Laravel

1. Database Design: 
○ migrations for Users, Videos, and Categories 
○ Implement proper relationships between tables 
○ Create seeders with sample data (5+ videos, 3+ users) 
2. API Implementation: 
○ RESTful API endpoints for videos: 
■ GET /api/videos - List videos with pagination 
■ GET /api/videos/{id} - Get single video details 
■ POST /api/videos - Create a new video entry 
■ PUT /api/videos/{id} - Update video details 
○ RESTful API endpoints for Categories:
■ GET /api/Categories - List videos with pagination 
■ GET /api/Categories/{id} - Get single video details 
■ POST /api/Categories - Create a new video entry 
■ PUT /api/Categories/{id} - Update video details
○ Implement proper request validation 
○ Structure API responses consistently 
3. Authentication: 
○ Implement Laravel Sanctum for API authentication 
○ Create login endpoint 
○ Secure appropriate routes with authentication 
4. Admin site with filament

## Task 1.2: Video Processing
 ○ a basic queue job that simulates video processing


## Frontend Development with Vue.js

Task 2.1: Application Setup 
1. Set up a Vue 3 application with the Composition API 
2. Implement Vue Router with appropriate routes 
3. Set up state management (Pinia or Vuex) 
4. Create a responsive layout with navigation 

## Task 2.2: Video Browsing Interface 
1. Home Page: 
○ Featured video section with eye-catching design 
○ Category-based video listings 
○ Responsive grid layout 
2. Video Listing Features: 
○ Implement grid view with hover effects 
○ Add filtering by category 
○ Include search functionality 
○ Create smooth loading states and transitions

## Task 2.3: Video Player

a custom video player component with: 
1. Core Player Controls: 
○ Play/Pause functionality with smooth animations 
○ Volume control with visual feedback 
○ Progress bar with seeking capability 
○ Fullscreen toggle 
○ Modern, visually appealing control styling 
2. Enhanced Features: 
○ Custom-styled player UI that stands out visually 
○ Responsive design for different screen sizes 
○ Smooth transitions and animations 
○ Keyboard shortcuts for main controls 

## Technologies used
1. Laravel 12
2. vite/Vue
3. filament
4. jquery
5. javascript

## Explanation of key architecture decisions 
because of it flexiblity and portablity

## Note any incomplete features and how you would have completed them given more time 
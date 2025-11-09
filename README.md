📰 Laravel Livewire Blog System

A modern blog management system built using Laravel 11 and Livewire 3, providing a smooth, dynamic user experience without needing a full page reload. This project demonstrates role-based access, activity logging, soft deletes, encrypted route parameters, and real-time interactivity.

🚀 Features 🧑‍💻 Authentication System

Custom login and registration pages built using Tailwind CSS.

Authentication powered by Custom authentication code logic (but fully customized).

Flash messages for login/logout actions.

👥 Role-Based Access

User Roles:

Admin: Full control over all posts and users.

User: Can create, update, read, and soft-delete their own posts.

Custom middleware (RoleMiddleware) ensures that:

/user/\* routes are only accessible to users with role user.

/admin/\* routes are only accessible to users with role admin.

📝 Blog Management

Create, Read, Update, and Delete (Soft Delete) blog posts.

Each post includes:

Title

Content

Author (linked to user)

Posts are soft deleted using Eloquent’s SoftDeletes trait.

Secure delete actions using Laravel Encryption for post IDs.

💬 Comments (if enabled)

Each post supports multiple comments.

Uses withCount('comments') for efficient comment count display.

⚙️ Livewire Components Post Component

Displays a single post.

Handles delete actions with confirmation.

Logs activities such as post deletion.

UpdatePost Component

Enables users to update their posts.

Includes real-time validation rules.

Logs activities for updates.

Flash messages on success/error.

DashboardStats Component

Shows quick statistics:

Total users (role: user)

Total posts

Total comments

🧾 Activity Logging

Trait: LivewireActivityLogger

Automatically logs important actions like:

Post created

Post updated

Post deleted

Stored in activity_logs table (or log file depending on configuration).

🔐 Encryption

Post IDs are encrypted in Livewire buttons and URLs to enhance security.

Example:

wire:click="deletePost('{{ encrypt($post->id) }}')"

🛡️ Middleware RoleMiddleware

Custom middleware to verify authenticated users’ roles.

if (Auth::check() && Auth::user()->role === $role) { return $next($request); } abort(403);

LogActivity Middleware

Logs each user’s action (visiting routes, performing CRUD operations).

🧩 Service Provider

A custom service provider is included to encapsulate business logic like:

Activity logging

Role-based access logic

Event handling for post creation/deletion

Registered in config/app.php:

App\Providers\BlogServiceProvider::class,

🧠 Route Organization Public (Guest) /login /register

Authenticated /logout

User Routes (prefix: user) /user/dashboard /user/post/create /user/post/{slug} /user/post/update/{slug}

Admin Routes (prefix: admin) /admin/dashboard /admin/post/create /admin/post/{slug} /admin/post/update/{slug}

Each route group uses:

auth

role:user or role:admin

log.activity

📦 Tech Stack

Backend: Laravel 11

Frontend: Tailwind CSS

Interactivity: Livewire 3

Database: MySQL

Auth: Laravel Auth Guards

Logs: Laravel Logging System

Encryption: Laravel Crypt

🧰 Setup Instructions

Clone the Repository

git clone https://github.com/dhrubo001/laravel-livewire-blog-system.git cd laravel-livewire-blog-system

Install Dependencies

composer install npm install && npm run dev

Environment Setup

cp .env.example .env php artisan key:generate

Database Setup

Create a new MySQL database.

Update .env with credentials.

Run migrations:

php artisan migrate

Run the Application

php artisan serve

Login

Register a new user.

Change the role field in users table manually to 'admin' for admin access.

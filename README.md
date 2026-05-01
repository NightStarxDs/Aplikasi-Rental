
```
Aplikasi-Rental
├─ .editorconfig
├─ app
│  ├─ Http
│  │  ├─ Controllers
│  │  │  ├─ Admin
│  │  │  │  ├─ Admin.php
│  │  │  │  ├─ BarangController.php
│  │  │  │  ├─ PelangganController.php
│  │  │  │  └─ TransaksiController.php
│  │  │  ├─ Auth
│  │  │  │  ├─ AuthenticatedSessionController.php
│  │  │  │  ├─ ConfirmablePasswordController.php
│  │  │  │  ├─ EmailVerificationNotificationController.php
│  │  │  │  ├─ EmailVerificationPromptController.php
│  │  │  │  ├─ NewPasswordController.php
│  │  │  │  ├─ PasswordController.php
│  │  │  │  ├─ PasswordResetLinkController.php
│  │  │  │  ├─ RegisteredUserController.php
│  │  │  │  └─ VerifyEmailController.php
│  │  │  ├─ BarangController.php
│  │  │  ├─ Controller.php
│  │  │  ├─ DataBarang.php
│  │  │  ├─ HomeController.php
│  │  │  ├─ LoginController.php
│  │  │  ├─ Profil.php
│  │  │  ├─ ProfileController.php
│  │  │  └─ User
│  │  │     ├─ GuestController.php
│  │  │     ├─ PenjualanController.php
│  │  │     └─ UserController.php
│  │  ├─ Middleware
│  │  │  └─ EnsureUserHasRole.php
│  │  └─ Requests
│  │     ├─ Auth
│  │     │  └─ LoginRequest.php
│  │     └─ ProfileUpdateRequest.php
│  ├─ Models
│  │  ├─ Rental.php
│  │  └─ User.php
│  ├─ Providers
│  │  └─ AppServiceProvider.php
│  └─ View
│     └─ Components
│        ├─ AppLayout.php
│        └─ GuestLayout.php
├─ artisan
├─ bootstrap
│  ├─ app.php
│  ├─ cache
│  │  ├─ packages.php
│  │  └─ services.php
│  └─ providers.php
├─ buat.txt
├─ catatan_ruben.txt
├─ composer.json
├─ composer.lock
├─ config
│  ├─ app.php
│  ├─ auth.php
│  ├─ cache.php
│  ├─ database.php
│  ├─ filesystems.php
│  ├─ logging.php
│  ├─ mail.php
│  ├─ queue.php
│  ├─ services.php
│  └─ session.php
├─ database
│  ├─ factories
│  │  └─ UserFactory.php
│  ├─ migrations
│  │  ├─ 0001_01_01_000000_create_users_table.php
│  │  ├─ 0001_01_01_000001_create_cache_table.php
│  │  └─ 0001_01_01_000002_create_jobs_table.php
│  └─ seeders
│     └─ DatabaseSeeder.php
├─ package-lock.json
├─ package.json
├─ phpunit.xml
├─ postcss.config.js
├─ public
│  ├─ .htaccess
│  ├─ favicon.ico
│  ├─ images
│  ├─ index.php
│  └─ robots.txt
├─ README63.md
├─ resources
│  ├─ css
│  │  └─ app.css
│  ├─ js
│  │  ├─ app.js
│  │  └─ bootstrap.js
│  └─ views
│     ├─ admin
│     ├─ auth
│     ├─ barang.blade.php
│     ├─ components
│     ├─ dashboard.blade.php
│     ├─ DataBarang.blade.php
│     ├─ LandingPage.blade.php
│     ├─ layouts
│     ├─ login.blade.php
│     ├─ profile
│     │  ├─ edit.blade.php
│     │  └─ partials
│     ├─ user
│     └─ welcome.blade.php
├─ routes
│  ├─ auth.php
│  ├─ console.php
│  └─ web.php
├─ storage
│  ├─ app
│  │  ├─ private
│  │  └─ public
│  ├─ framework
│  │  ├─ cache
│  │  │  └─ data
│  │  ├─ sessions
│  │  ├─ testing
│  │  └─ views
│  └─ logs
│     └─ laravel.log
├─ tailwind.config.js
├─ test63.PHP
├─ tests
│  ├─ Feature
│  │  ├─ Auth
│  │  │  ├─ AuthenticationTest.php
│  │  │  ├─ EmailVerificationTest.php
│  │  │  ├─ PasswordConfirmationTest.php
│  │  │  ├─ PasswordResetTest.php
│  │  │  ├─ PasswordUpdateTest.php
│  │  │  └─ RegistrationTest.php
│  │  ├─ ExampleTest.php
│  │  └─ ProfileTest.php
│  ├─ TestCase.php
│  └─ Unit
│     └─ ExampleTest.php
└─ vite.config.js

```
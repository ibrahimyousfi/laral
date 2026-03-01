# Laral

Laravel application with an **App** layout: sidebar, users (CRUD + pagination), expenses, settings (currency, logo, timezone), and authentication.

---

## Requirements

- PHP 8.2+
- Composer
- Node.js (optional, for frontend build if needed)
- MySQL, SQLite, or PostgreSQL

---

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/ibrahimyousfi/laral.git
cd laral
```

### 2. Install dependencies

```bash
composer install
```

### 3. Environment file

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database and `APP_URL`:

```env
APP_NAME="Laral"
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# or MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_DATABASE=laral
# DB_USERNAME=root
# DB_PASSWORD=
```

For SQLite, create the database file:

```bash
touch database/database.sqlite
```

### 4. Run migrations

```bash
php artisan migrate
```

### 5. Seed data (optional)

```bash
php artisan db:seed --class=SettingSeeder
php artisan db:seed --class=UserSeeder
```

Create the storage link for uploaded files (logo, icon):

```bash
php artisan storage:link
```

### 6. Run the application

```bash
php artisan serve
```

Open **http://127.0.0.1:8000** in your browser.

---

## Main URLs

| URL | Description |
|-----|-------------|
| `/` | Home (welcome) |
| `/login` | Login |
| `/register` | Register |
| `/app` | App home (requires auth) |
| `/app/users` | Users list (12 per page, pagination) |
| `/app/users/create` | Create user |
| `/app/users/{id}/edit` | Edit user |
| `/app/expenses` | Expenses list |
| `/app/settings` | App settings (name, logo, icon, currency, timezone) |

---

## Project structure

- **Layout:** `resources/views/layouts/app.blade.php` — main layout for all app pages (sidebar + header + content). Fallback title: "App".
- **Routes:** Split by section in `routes/` — `web.php`, `auth.php`, `dashboard.php`, and `routes/dashboard/*.php` for users, expenses, settings. All app routes use prefix **`/app`**.
- **Views:** One Blade file per page under `resources/views/` (e.g. `users/index.blade.php`, `settings/index.blade.php`).
- **Reusable components:** In `resources/views/components/`:
  - `button`, `navbar-add-button` — buttons (including icon-only with border)
  - `card-row` — horizontal card wrapper
  - `card-row-body` — card content (title, subtitle, image, badges)
  - `card-actions` — edit/delete icon buttons for cards
  - `pagination` — pagination links (previous, page numbers, next)
  - `badge` — small badges (default, success, danger, warning)

---

## Deployment (cPanel)

1. Upload the full project (e.g. in a folder outside `public_html`).
2. Set **Document Root** to the project’s **`public`** folder (e.g. `/home/username/laral/public`).
3. Set permissions: `storage` and `bootstrap/cache` writable (e.g. 775).
4. Copy `.env.example` to `.env`, set `APP_ENV=production`, `APP_DEBUG=false`, and production `APP_URL` and database.
5. Run `php artisan migrate --force`, seeders if needed, and `php artisan storage:link`.

See **CPANEL_DEPLOY.md** for detailed steps.

---

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).

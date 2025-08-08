# 📝 Laravel Complaints Lodge System

A modern, elegant, and responsive complaint management system built using Laravel and Bootstrap. It allows users to lodge complaints, view their statuses, and manage records efficiently through a clean and interactive interface.

## 🚀 Features

- User-friendly interface with elegant UI/UX
- Lodge complaints with title and description
- View all personal complaints and their status (e.g., In Progress, Resolved)
- Responsive design using Bootstrap
- Hover effects and animated buttons for better interactivity
- Blade templating with Laravel backend

## 📸 UI Preview

> [Insert screenshots or GIFs of your interface here – optional but helpful]

---

## 🛠️ Installation & Setup

### Prerequisites

- PHP >= 8.1
- Composer
- Laravel >= 10
- MySQL / SQLite
- Node.js & npm (for assets if needed)

### 🔧 Steps to Clone and Run Locally

1. **Clone the Repository**

```bash
git clone https://github.com/yourusername/complaints-system.git
cd complaints-system
````

2. **Install Dependencies**

```bash
composer install
```

3. **Create `.env` File**

```bash
cp .env.example .env
```

4. **Generate Application Key**

```bash
php artisan key:generate
```

5. **Set Up Database**

* Configure your `.env` database section:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

* Then run migrations:

```bash
php artisan migrate
```

6. **(Optional) Seed Dummy Data**

```bash
php artisan db:seed
```

7. **Run the Development Server**

```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

---

## 📂 Project Structure Overview

```
├── app/
├── bootstrap/
├── database/
├── public/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── admin/
│   │   │   └── show.blade.php
│   │   └── complaints/
├── routes/
│   └── web.php
├── .env
└── composer.json
```

---

## 💡 Contribution

Pull requests and suggestions are welcome. For major changes, please open an issue first to discuss what you would like to change.

---


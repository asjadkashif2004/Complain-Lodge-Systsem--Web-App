# 📝 Laravel Complaints Lodge System

A modern, elegant, and responsive complaint management system built using Laravel and Bootstrap. It allows users to lodge complaints, view their statuses, and manage records efficiently through a clean and interactive interface.

It is a full stack web app with front end html,css and bootstrap along with backend laravel serve and mysql database managment.

## 🚀 Features

- User-friendly interface with elegant UI/UX
- Lodge complaints with title and description
- View all personal complaints and their status (e.g., In Progress, Resolved)
- Responsive design using Bootstrap
- Hover effects and animated buttons for better interactivity
- Blade templating with Laravel backend

## 📸 UI Preview
<img width="938" height="394" alt="image" src="https://github.com/user-attachments/assets/50b33973-8afe-4510-8d92-a896c5a1f1d7" />

<img width="715" height="575" alt="image" src="https://github.com/user-attachments/assets/c2bbb3a4-5726-4c96-8620-377842b541c4" />
<img width="1091" height="491" alt="image" src="https://github.com/user-attachments/assets/52e3e44d-3af6-499b-a6db-29b8b94f2364" />
<img width="992" height="505" alt="image" src="https://github.com/user-attachments/assets/1892f48d-b7aa-41a0-a882-ab0d19a04011" />


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


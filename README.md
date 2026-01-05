# User Management System (Laravel)

A simple and scalable **User Management System** built with **Laravel**, designed to handle user CRUD operations, authentication-ready structure, and modern frontend tooling.

---

## 📌 Features

* User creation, update, and deletion
* Clean and structured Laravel project setup
* Database migrations
* Environment-based configuration
* User authentication implemented using Laravel Passport

---

## 🛠 Tech Stack

* **Backend:** Laravel
* **Frontend:** Blade / Vite (NPM)
* **Database:** MySQL (configurable)
* **Package Manager:** Composer, NPM

---

## 🚀 Installation & Setup

Follow the steps below to set up the project locally.

### 1️⃣ Clone the Repository

* git clone https://github.com/anjalimevada97/User-Management.git
* cd User-Management

---

### 2️⃣ Install Backend Dependencies

* composer install

---

### 3️⃣ Install Frontend Dependencies

* npm install

---

### 4️⃣ Environment Configuration

Create the environment file and generate the application key:
- cp .env.example .env
- php artisan key:generate

Update the `.env` file with your database credentials:
- DB_DATABASE=your_database_name
- DB_USERNAME=your_database_username
- DB_PASSWORD=your_database_password

---

### 5️⃣ Run Database Migrations
* php artisan migrate

### Install API Authentication (Laravel Passport)

* php artisan install:api --passport
* php artisan passport:client --personal

### Clear Cache

- php artisan cache:clear
- php artisan config:clear
- php artisan route:clear
- php artisan view:clear

---

### 6️⃣ Start Development Servers

Run the Laravel development server:
* php artisan serve

The application will be available at:
* http://127.0.0.1:8000

---

## 📂 Project Structure (Overview)

User-Management/
├── app/
├── database/
│   └── migrations/
├── resources/
├── routes/
├── public/
├── .env.example
├── composer.json
├── package.json
└── README.md

---

## ✅ Requirements

* PHP >= 8.2
* Composer
* Node.js & NPM
* MySQL

---

## 🧪 Useful Commands

- php artisan migrate:fresh --seed      # Reset and seed database
- php artisan cache:clear                # Clear application cache
- php artisan config:clear               # Clear config cache
- php artisan route:clear                # Clear route cache
- php artisan view:clear                 # Clear view cache
- php artisan route:list                 # List all routes
- php artisan passport:install           # Install Laravel Passport
- php artisan passport:client --personal # Create personal access client


---

## 👤 Author

**Anjali Mevada**
GitHub: [anjalimevada97](https://github.com/anjalimevada97)

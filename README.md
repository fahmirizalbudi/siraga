<div align="center">
<a href="https://github.com/fahmirizalbudi/siraga" target="blank">
<img src="https://raw.githubusercontent.com/JjagoKoding/icon/1050df4e0e543d6d8ec531a8a1ad9836b9d19c1f/siraga.svg" width="280" alt="Logo" />
</a>

<br />
<br />

![](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![](https://img.shields.io/badge/Filament-FAA02E?style=for-the-badge&logo=laravel&logoColor=white)
![](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

</div>

<br />

## 🏀 SiRAGA

SiRAGA <i>(Sistem Informasi Peminjaman Alat Olahraga)</i> is a web-based application for managing sports equipment loans. Built with Laravel Filament, and database using MySQL. Key features include:

## 🖼️ Preview

![](siraga.png)

## ✨ Features

- **📊 Admin Dashboard:** Comprehensive dashboard provided by Filament to monitor overall activity.
- **🏸 Equipment Management:** CRUD (Create, Read, Update, Delete) operations for sports equipment data (stock, condition, categories).
- **📝 Loan Transaction:** Manage borrowing and returning processes efficiently.

## 👩‍💻 Tech Stack

- **Laravel**: A PHP web application framework with expressive, elegant syntax.
- **Filament**: A collection of beautiful full-stack components for Laravel, used here for the Admin Panel.
- **MySQL**: An open-source relational database management system.

## 📦 Getting Started

To get a local copy of this project up and running, follow these steps.

### 🚀 Prerequisites

- **PHP** (v8.2 or higher) & **Composer**.
- **MySQL** (or another supported SQL database).

## 🛠️ Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/fahmirizalbudi/siraga.git
   cd siraga
   ```

2. **Install dependencies:**

   ```bash
   composer install
   cp .env .env.example
   php artisan key:generate
   ```

3. **Run migration:**

   ```bash
   php artisan migrate
   ```

4. **Start the development server:**

   ```bash
   php artisan serve
   ```

## 📖 Usage

### ✔ Running the Website

- **Website development:** `php artisan serve`.

> Open [http://localhost:8000](http://localhost:8000) to view it in the browser.

## 📜 License

All rights reserved. This project is for educational purposes only and cannot be used or distributed without permission.

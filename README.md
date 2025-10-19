# 🎉 Victorias Event Fiesta

<img width="2499" height="1272" alt="FireShot Capture 192 - Victorias Event Fiesta -  victorias-event-fiesta test" src="https://github.com/user-attachments/assets/9aa52990-3bd1-4c52-b165-4af3e7eb18d5" />

## 👥 Researchers
- **Absalon, Rey F.**  
- **Dela Cruz, Fergie P.**  
- **Sayam, Arnel P.**

---

## 📝 Description

**Victorias Event Fiesta** is a web-based management system built to organize, schedule, and monitor events during the Victorias City Fiesta celebration.  
The system aims to simplify event coordination by providing tools for administrators, organizers, and participants to manage event details efficiently.  

### ✨ Features
- **Role-Based Access Control (RBAC)**
  - Admin, Brgy Captain, and Victoriasanon roles
  - Custom permission and role management
- **Interactive Event Calendar** powered by **Guava Calendar**
  - Create, edit, and view events on a user-friendly calendar interface
- **Modern Admin Interface** using **FilamentPHP v3**
  - Dashboard, forms, tables, and widgets
- **Built with Laravel 12**
  - Secure, scalable, and easy-to-maintain backend framework

---

## ⚙️ System Installation Guide

Follow these steps to install and set up the **Victorias Event Fiesta System** on your local environment.

### 🧩 Requirements
- PHP 8.3 or higher  
- Composer  
- Node.js & npm  
- MySQL / MariaDB  
- Git  

---

### 🚀 Step 1: Clone the Repository
```bash
git clone https://github.com/yourusername/victorias-event-fiesta.git
cd victorias-event-fiesta
```

### ⚙️ Step 2: Install Dependencies
```bash
composer install
npm install
npm run build
```
### 🗃️ Step 3: Environment Setup
Copy **.env.example** to **.env** and configure your database and app settings:
```bash
cp .env.example .env
```
Then generate the application key:
```bash
php artisan key:generate
```

### 🧱 Step 4: Run Database Migrations and Seeders
```bash
php artisan migrate --seed
```

### 🛡️ Step 5: Set Up Filament Admin and Shield
```bash
php artisan shield:install
```
This command installs and configures the Role-Based Access Control system.

### 📅 Step 6: Configure Guava Calendar
```bash
composer require guava/filament-calendar
php artisan vendor:publish --tag="filament-calendar-config"
```

### 🖥️ Step 7: Serve the Application
```bash
npm run build
npm run dev
```
Open your browser and go to:
```bash
https://victorias-event-fiesta.test/
```

## SCRENSHOTS
### Home Page
<img width="2499" height="3468" alt="image" src="https://github.com/user-attachments/assets/5ab2346f-cdfb-4dfa-a099-712cadbf6839" />

### Barangay Page
<img width="2499" height="1272" alt="image" src="https://github.com/user-attachments/assets/eedbae23-5af6-46a6-a6c7-4153aaa95c8b" />

### Fiesta & Eventos Page
<img width="2499" height="2314" alt="image" src="https://github.com/user-attachments/assets/9dc86dea-5bd3-4eae-b1de-42f6edcc5591" />

### Contact Page
<img width="2499" height="1931" alt="image" src="https://github.com/user-attachments/assets/e9ed590c-b194-4b4a-b8be-9acf62ec0ae5" />

---

### Dashboard Page
<img width="2499" height="2737" alt="image" src="https://github.com/user-attachments/assets/23f846a8-8b56-4138-bda8-1db21fed4d39" />

### Fiesta
<img width="2499" height="1272" alt="image" src="https://github.com/user-attachments/assets/eaafdb5b-070d-43d0-8456-462b88a3f348" />




# 📖 Readme
The system's goal is to replace the clinic's manual, paper-based workflow with a completely digital, paperless one. It makes it possible for university staff and students to schedule dental and medical appointments online, cutting down on wait times and doing away with the necessity for in-person booking. The software increases productivity for patients, clinic employees, physicians, and dentists by digitizing records and automating appointment scheduling. It unifies schedules, medical findings, services, and patient data into one easily accessible system. Overall, the project improves service delivery by streamlining clinic operations.

---

## 🏥 SLSU Clinic Management System
A Laravel-based web application designed to digitize and streamline the operations of the Southern Leyte State University (SLSU) Clinic. 

---

## 📌 Features
- 📅 Online Appointment Booking
  - ✅ Patients can schedule appointments without visiting the clinic.
- 👨‍⚕️ Specialist Scheduling
  - ✅ Doctors and dentists can manage their available schedules.
- 🧾 Patient Information Management
  - ✅ Centralized storage of patient records and personal details.
- 📊 Appointment Tracking
  - ✅ Monitor appointment statuses (pending, approved, completed, etc.).
- 📝 Medical Findings
  - ✅ Record diagnoses and notes for each appointment.
- ⭐ Ratings & Feedback
  - ✅ Patients can rate services and provide feedback.
- 🔐 Role-Based Access Control
  - ✅ Supports Admins, Patients, and Specialists.
 
---

## 🧱 System Architecture
Built using:
- Laravel (PHP Framework)
- MySQL Database will migrate to PostgreSQL
- MVC Architecture

---

## 🗂️ Database Structure (ERD Overview)
erDiagram

    USERS {
        int id PK
        string username
        string password
        int user_id FK
        string account_type
    }

    PATIENTS {
        int id PK
        string id_number
    }

    SPECIALISTS {
        int id PK
        string employee_id
        string position
    }

    ADMINS {
        int id PK
        string avatar
        string first_name
        string last_name
        string display_name
    }

    INFORMATION {
        int id PK
        int user_id FK
        string avatar
        string account_type
        string first_name
        string middle_name
        string last_name
        string email
        string gender
        string contact_number
        string barangay
        string municipality
        string province
    }

    SERVICES {
        int id PK
        string image
        string name
        string description
    }

    SCHEDULES {
        int id PK
        int service_id FK
        int specialist_id FK
        string time_start
        string time_end
        date date
        string flag
    }

    APPOINTMENTS {
        int id PK
        int patient_id FK
        int schedule_id FK
        string status
        string first_name
        string middle_name
        string last_name
        string email
        string gender
        string contact_number
        string address
        datetime created_at
        datetime updated_at
    }

    FINDINGS {
        int id PK
        int appointment_id FK
        string description
    }

    RATINGS {
        int id PK
        int appointment_id FK
        int rate
        string description
    }

    USERS ||--|| PATIENTS : has
    USERS ||--|| SPECIALISTS : has
    USERS ||--|| ADMINS : has
    USERS ||--|| INFORMATION : has

    SERVICES ||--o{ SCHEDULES : includes
    SPECIALISTS ||--o{ SCHEDULES : assigned_to

    PATIENTS ||--o{ APPOINTMENTS : books
    SCHEDULES ||--o{ APPOINTMENTS : scheduled_for

    APPOINTMENTS ||--o{ FINDINGS : generates
    APPOINTMENTS ||--o{ RATINGS : receives

## ⚙️ Installation Guide
1. Clone the repository:
```bash
git clone https://github.com/Erzan12/slsu-clinic-system.git
```
2. Navigate into the project folder:
```bash
cd slsu-clinic-system
```
3. Install dependencies:
```bash
composer install
npm install && npm run dev
```
4. Copy .env file:
```bash
cp .env.example .env
```
5. Configure your database in .env
6. Generate app key:
```bash
php artisan key:generate
```
7. Run Migrations: 
```bash
php artisan migrate
```
8. Link storage to support images:
```bash
php artisan storage:link
```
9. Start the server:
```bash
php artisan serve
```

---

## 🔐 User Roles
#### Admin
 - Manage users, services, and system data.
#### Patient
 - Book appointments and view records.
#### Specialist (Doctor/Dentist)
 - Manage schedules and provide medical findings.

---

## 🎯 Objectives
- Eliminate manual, paper-based processes
- Reduce patient waiting time
- Improve clinic workflow efficiency
- Provide centralized and secure data management

---

## 📈 Future Improvements
- SMS/Email Notifications
- Mobile App Integration
- Analytics Dashboard
- Telemedicine Support

---

## 🛢 Database Schema
https://lucid.app/lucidchart/75038d9c-e75c-4d05-9500-691f67928e85/edit?invitationId=inv_a6109d96-8b96-4663-98e7-450c96bb4e38&page=0_0#

---

## 📋 Task
https://app.clickup.com/31613932/v/b/li/900800098665

---

## 👨‍💻 Author

Capstone Project developed for Southern Luzon State University (SLSU)

---

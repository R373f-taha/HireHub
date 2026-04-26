# 💛 HireHub - The Complete Freelance Marketplace Platform

## 🎯 About The Project

**HireHub** is a complete freelance marketplace platform that connects **Clients** with **Freelancers**. Built to solve the problem of finding reliable clients and skilled freelancers, it provides a professional environment for managing projects, proposals, and reviews with full transparency.

---

## 🚀 Problems This Project Solves

| Problem | HireHub Solution |
| :--- | :--- |
| ❌ Difficulty finding clients | Dedicated space for freelancers to showcase skills and access real projects |
| ❌ Finding reliable freelancers | Freelancer verification system + genuine reviews from previous clients |
| ❌ Project & proposal chaos | Complete system for managing projects, proposals, and reviews in one place |
| ❌ Lack of trust between parties | Freelancer verification system (Verified Badge) for full transparency |

---

🔐 Authentication Accounts

👑 Admin Account

Email: admin@hirehub.com'
Password: admin123

👤 Client Account

Email: client@hirehub.com
Password: client123

👤 Freelancer Account

Email: freelancer@hirehub.com
Password: freelancer123

---

## ✨ Key Features

- ✅ **Complete Project Management** (Create, Edit, Delete, Search & Filter)
- ✅ **Proposals System** with accept/reject functionality
- ✅ **Freelancer Verification System** managed by Admin
- ✅ **Reviews & Ratings System** after project completion
- ✅ **Role-Based Access Control** (Admin, Client, Freelancer) with custom Middleware
- ✅ **Separate Dashboards** for Admin, Client, and Freelancer
- ✅ **Production-Ready API** with Postman Collection
- ✅ **Optimized Performance** with N+1 query fixes

---

## 🗺️ API Routes Guide

### 🌐 Public Routes (with Login Required)

| Method | URI | Description |
| :--- | :--- | :--- |
| `GET` | `/api/V1/offer/{offerId}` | Show offer details |
| `GET` | `/api/V1/projects` | List all projects |
| `GET` | `/api/V1/projects/{id}` | Show specific project details |
| `GET` | `/api/V1/bid/{f}` | Get bid information |
| `POST` | `/api/V1/users/register` | Register new user |
| `POST` | `/api/V1/users/login`    | Login |
| `POST` | `/api/V1/users/logout`    | Logout |
| `GET` | `/api/V1/offers` | List all offers |
| `GET` | `/api/V1/freelancer/{freelancerId}/reviews` | Get freelancer reviews |
| `GET` | `/api/V1/project/{projectId}/reviews` | Get project reviews |
| `GET` | `/api/V1/client/{clientId}/reviews` | Get client reviews |
| `GET` | `/api/V1/freelancers/available/verified` | List available & verified freelancers |
| `GET` | `/api/V1/freelancers/available/verified/sorted` | List available & verified freelancers (sorted) |
| `GET` | `/api/V1/freelancers/active` | List active freelancers |

### 🔐 Authenticated Routes (Requires Login)

| Method | URI | Role Required | Description |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/V1/admin/panel` | Admin | Admin dashboard panel |

### ✅ Verified Freelancer Routes (Requires: auth + verified freelancer)

| Method | URI | Description |
| :--- | :--- | :--- |
| `POST` | `/api/V1/profile` | Create profile |
| `PATCH` | `/api/V1/profile/{id}` | Update profile |
| `POST` | `/api/V1/offer` | Create new offer |
| `POST` | `/api/V1/freelancer/offer/submit` | Submit offer as freelancer |
| `POST` | `/api/V1/skill/with/{years_of_experience}` | Add skill with years of experience |
| `PATCH` | `/api/V1/skill/{id}/with/{years_of_experience}` | Update skill with years of experience |

### 👑 Client Routes (Requires: auth + client role)

| Method | URI | Description |
| :--- | :--- | :--- |
| `POST` | `/api/V1/project/` | Create new project |
| `POST` | `/api/V1/projects/{project_id}/offers/{offer_id}/accept` | Accept an offer |
| `POST` | `/api/V1/projects` | Create project (alternative) |
| `PUT` | `/api/V1/projects/{id}` | Update project |
| `DELETE` | `/api/V1/projects/{id}` | Delete project |
| `POST` | `/api/V1/reviews` | Submit a review |

---

## 📊 Database Schema

```
├── users                 # Users (client, freelancer, admin)
├── profiles              # User profiles
├── projects              # Posted projects
├── offers                # Offers submitted on projects
├── skills                # Available skills
├── freelancer_skill      # Many-to-many relationship (freelancers ↔ skills)
├── project_tag           # Project tags/categories
├── reviews               # Reviews and ratings after project completion
├── attachments           # Polymorphic attachments for projects & tags

```

---

## 🧱 Technical Architecture

```
HireHub/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/V1/    # AdminController, ClientController, FreelancerController, OffersController, ProfileController, ProjectController, ReviewController, SkillController, UserController
│   │   └── Middleware/     # is_admin, is_client, is_verified_freelancer
│   ├── Models/V1/          # User, Project, Offer, Review, Skill, Tag, Profile, Attachment, Country, City, Client, Freelancer
│   ├── Actions/V1/         # Business logic actions
│   ├── Services/V1/        # Service layer
│   └── Http/Requests/V1/   # Form requests with validation
├── database/
│   ├── migrations/         # All schema migrations
│   ├── factories/          # Model factories
│   └── seeders/            # Dummy data for testing
├── routes/
│   └── api.php             # All API routes
├── composer.json           # PHP dependencies
└── package.json            # Node.js dependencies
```

---

## ⚙️ Installation & Setup

```bash
# 1. Clone the repository
git clone https://github.com/R373f-taha/HireHub.git
cd HireHub

# 2. Install PHP dependencies
composer install

# 3. Setup environment file
cp .env.example .env
php artisan key:generate

# 4. Configure database in .env file, then run migrations & seeders
php artisan migrate --seed

# 5. Start the development server
php artisan serve
```

---

To activate the email responsible for sending emails:

Prerequisites💛:

The email must have two-factor authentication enabled.

Access Gmail settings and navigate to "App Passwords" under security settings.

Generate a new app password by specifying the app name and copying the generated password.

Email Configuration Settings:

and in {.env} file : 

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587 MAIL_USERNAME=[Your Email] 
MAIL_PASSWORD=[Generated App Password Here]
MAIL_ENCRYPTION=tls MAIL_FROM_ADDRESS=[Your Email]
MAIL_FROM_NAME=[App Name]

---

## 📬 API Collection

For developers who want to integrate HireHub with external applications (mobile apps, separate frontends):

**Postman Documentation:** https://documenter.getpostman.com/view/50321677/2sBXqDtPXQ

---





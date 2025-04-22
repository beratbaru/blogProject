Blog Project - Laravel + Filament

📌 Introduction

This is a Dockerized Laravel Blog Project built with Filament. Follow the steps below to set up and run the project on your local machine.

🛠️ Prerequisites

Make sure you have the following installed:

Docker & Docker Compose

Git

🚀 Installation

1️⃣ Clone the Repository

git clone https://github.com/beratbaru/blogProject
cd blogProject

2️⃣ Copy Environment File

cp .env.example .env

3️⃣ Start Docker Containers

docker compose up -d --build

4️⃣ Install Dependencies

docker exec -it api_app bash
cd html
composer install

5️⃣ Generate Application Key

docker exec -it api_app bash
cd html
php artisan key:generate

6️⃣ Run Migrations & Seed Database

docker exec -it api_app bash
cd html
php artisan migrate --seed

7️⃣ Set Permissions (For Storage & Cache)

docker exec -it api_app bash
cd html
chmod -R 777 storage bootstrap/cache

8️⃣ Setup Filament Admin Panel

You can access the Filament admin panel at:

http://localhost:8000/panel

(Default login details are set in the database seeder.)

🏃 Running the Project

To start the project in the future, simply run:

docker compose up -d

📌 Stopping the Project

To stop the running containers, use:

docker compose down

📢 Notes

If you make changes to the .env file, run:

docker compose exec api_app php artisan config:clear

To check running containers:

docker ps

Don't forget to run "npm run dev" in the terminal(frontend) for the design to load properly.

I tested mails using mailtrap and queues using horizon.

🎯 Features

User authentication (Login/Register)

Role-based access (Spatie Laravel Permission)

Filament Admin Panel

Blog Post Creation with Tagging

Fully Dockerized Setup

<!--\Artisan::call('posts:update-status'); (run in tinker to test post scheduling after publishing a post from the panel.) -->
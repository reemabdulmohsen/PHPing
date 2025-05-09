# 📝 Laravel ToDo API with Weekly RoastBot🤖

ToDo API with authentication, authorization, ownership enforcement, and background jobs.
But we didn’t stop there. Every week, you will get an AI-generated roast email summarizing your productivity (or lack of it).

### 📬 RoastBot once said...

> Congratulations on completing... absolutely nothing! At this rate, you’re on track to become the world champion of procrastination. If they gave out medals for sitting around, you’d have a gold medal!
> 
> — RoastBot 🤖

## 🚀 Features

- ✅ User Authentication (Login via Laravel Sanctum)
- 📋 CRUD for Tasks (Create, Read, Update, Delete)
- 🔐 Authorization (Policies to ensure task ownership)
- 📦 Background Jobs (Queued emails using Laravel Jobs)
- ⏰ Scheduled Tasks (Weekly recap using Task Scheduler)
- 🤖 AI Roast Recaps (Generated by GPT-based model via OpenAI)

## 👩🏻‍💻 Tech Stack

- Laravel 12
- Sanctum for API authentication
- Policies for authorization
- Jobs & Queues for background tasks
- Scheduler for weekly task
- OpenAI API for roast generation
- Mailhog for email testing

## 🐳 Docker Setup

1. clone the repository
```bash
git clone https://github.com/yourusername/laravel-todo-api.git
```

2. build the docker container
```bash
docker compose up --build
```

3. run the migrations
```bash
docker compose exec api php artisan migrate
```

4. Run the queue worker (for emails):
```bash
docker compose exec api php artisan queue:work
```
to run the test
```bash
docker compose exec api php artisan test
```



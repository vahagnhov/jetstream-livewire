✔️ Laravel Developer Test
======================
>  Laravel Cashier For Stripe Integration.

# Laravel Cashier For Stripe Integration

## Why did I choose the Laravel Cashier package to integrate Stripe into my development task application?

In my opinion, this package is most suitable for our task. Laravel Cashier is a package specifically designed for
Laravel applications to simplify subscription billing with Stripe. It provides a higher-level abstraction that
integrates seamlessly with Laravel's ecosystem.
I chose Laravel Cashier for its seamless integration with Laravel, which simplified our payment processing implementation.
With Laravel Cashier, we could easily manage subscriptions, handle payment methods, and automate tasks like invoicing
and dunning. This package not only streamlines the Stripe integration but also aligns perfectly with Laravel's
developer-friendly ecosystem, making it a natural choice for our project.

**When using this test app try using up with the following credentials to test it out:**

      Credit Card Number: 4242 4242 4242 4242 
      Expires: 02/28
      CVC Code: 123
      Zip: 10004

## 🔌 Requirements

- PHP version: >= 8.0
- Composer
- Node.js

## 🧰 Built with

- Laravel 10
- Jetstream Livewire
- Laravel Cashier
- spatie/laravel-permission
- Bootstrap 5

## Installation

### 1. Clone the repository

This step involves cloning the project's Git repository to your local machine using the provided Git clone command.

```
git clone https://github.com/vahagnhov/laravel-spatie-stripe-task.git
```

### 2. Install Dependencies

After cloning the repository, navigate to the project directory and install PHP and JavaScript dependencies using
Composer and npm(or yarn).

```
cd laravel-spatie-stripe-task
composer install
npm install
npm run dev
```

### 3. Create .env File

Copy the .env.example file to create a .env file and configure it with your environment-specific
settings, including database credentials.

```
cp .env.example .env
```

### 4. Generate Laravel Application Key

Use this command to generate a unique application key for your Laravel application.

```
php artisan key:generate
```

### 5. Change to your database credentials

Then you'll need to **create a new database** and add your database credentials to the `.env` file.:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Stripe Configuration

Configure Stripe integration by setting your Stripe API keys and webhook secret key in the .env file.

```
STRIPE_KEY=your_publishable_key
STRIPE_SECRET=your_secret_key
STRIPE_WEBHOOK_SECRET=your-stripe-webhook-secret
```

Additionally, set up a secure webhook URL for Stripe events(example you can install and run ngrok).
Inside your Stripe dashboard, create webhook using your secure Webhook URL or use this command from your
project directory.

```
ngrok http 8000
php artisan cashier:webhook --url "https://your-ngrok-url.com/stripe/webhook"
```

Now, your Laravel project is configured to use your Stripe for payment processing and subscriptions, and webhooks are
set up to handle Stripe events securely.

**Note:** Ensure that keep your `.env` file secure and do not share it publicly, as it contains sensitive information.

### 7. Create 2 New Stripe Products

Inside your Stripe dashboard, go to **Billing->Products**, create two products and update the .env file with
the corresponding product IDs.

```
STRIPE_PRODUCT_1=your_product_1_price_api_id
STRIPE_PRODUCT_2=your_product_2_price_api_id
```  

### 8. Run Database Migrations and Seeders
Migrate the database schema and seed the database with initial data using this commands

```
php artisan migrate
php artisan db:seed
```

### 9. Email Configuration

Update the .env file with your email credentials for email-related configuration.

```
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 10. Run Development Server

This command is commonly used in Laravel projects to serve the application locally.

```
php artisan serve
```

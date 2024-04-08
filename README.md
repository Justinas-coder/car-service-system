## Car Service Booking System

## Description


As a service client, after you create your account, 
you can pre-order an appointment. Choose your service 
type, and the system will calculate the total price for you. 
You can follow the status of your order. When your car is ready, 
the order status will be changed. You can pay instantly or 
receive an invoice at your email address.


### Stack:

- Laravel 10x
- Tailwind CSS
- Alpine JS
- Stripe
- Choices-js



### How to launch it:

1. Clone this repo
```
git@github.com:Justinas-coder/car-service-system.git
```
2. Navigate to the project directory:

```
cd project-directory

```
3. Install dependencies:
```
   composer install
```

4. Copy the .env.example file and rename it to .env:
```
cp .env.example .env
```

5. Generate app encryption key:
```
php artisan key:generate
```
6. Create a new database for the application:

7. Make migrations:

```
php artisan migrate
```
8. Seed database:
```
php artisan db:seed
```
9. Application use external payment service https://stripe.com/en-lt  so you need to get you API KEY and create
   fill in .env variable, as bellow:
```
STRIPE_SECRET_KEY="YOUR KEY = Your Key."
STRIPE_WEBHOOK_SECRET="YOUR KEY = Your Key."
```
10. Start the development server:
```
php artisan serve
```

11. Visit http://localhost:8000 in your browser to view the application.


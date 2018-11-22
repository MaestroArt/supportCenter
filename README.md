# supportCenter
This is an example of simple website with Laravel.

## Before first launch:
1. add variable 'EMAIL_MANAGER' to .env and specify email for manager
2. execute php artisan migrate:refresh --seed

## Features:
- Login/Register user
- Create a feedback. The interval between feedbacks is minimum 5 minutes.
- List of feedbacks. (Manager can see feedbacks from all users)
- Manager and user can reply on feedback
- Send email to Manager after create feedback or user reply

## Used technologies:
- Laravel 5.7 (migrations, seeders, controllers, forms, requests, mail, auth, views)
- PHP 7
- Vue.js

## Manager credentials:
- Login - need to add variable 'EMAIL_MANAGER' to .env
- Password: secret

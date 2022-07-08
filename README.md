## Introduction

- Project __Online Support System on Laravel 9.19.__

- Framework __Laravel V 9.19.__

---
## Author

- Author __Shan Khan__

- Email __shankhantanoli1@gmail.com__

- Mobile __+971 58 309 6267__

---

## Humble Request

- __If you want me to change/modify anything then please let me know, I will change it asap__

- __Please give me chance to join your team, I will improve myself and I will try my best__

- __I want to learn more and I want to get experience, Please kindly give me chance to join your team__

---

## Installation

- Clone the repository with __git clone__

- Copy __.env.example__ file to __.env__ and edit following credentials there

- Run __composer install or composer update__

- Run __php artisan key:generate__

- Run __php artisan migrate or migrate:fresh__ (it has some users with their role defined)

- Next Step: Now you need to configure few more things.
---
## For Algolia

- __ALGOLIA_APP_ID="YOUR APP ID"__

- __ALGOLIA_SECRET="YOUR KEY"__

- __ALGOLIA_INDEX_NAME="YOUR INDEX NAME"__

- __SCOUT_QUEUE=true__

---
## For Database
- __DB_DATABASE="YOUR DB"__

- __DB_USERNAME="DB USERNAME"__

- __DB_PASSWORD="DB PASSWORD"__

---
## For Sending Email

- __MAIL_MAILER=smtp__

- __MAIL_HOST=YOUR MAIL HOST__

- __MAIL_PORT=Your Mail Port__

- __MAIL_USERNAME=Your Mail Username__

_ __MAIL_PASSWORD=Your Mail Password__

- __You can also update other values__

---

## Login Api

- Login __(POST REQUEST)__ __http://127.0.0.1:8000/api/login__.

- It expectes __Email__ and __Password__ otherwise __VALIDATION ERROR__.

- Use any __EMAIL__ from __USERS TABLE__ and __PASSWORD__ will be __"password"__ in lowercase.

- It will return you user details with __token__.

---

## Register Api (Only customer can register)

- Register __(POST REQUEST)__ __http://127.0.0.1:8000/api/register__.

- It expectes __Name , Email__ and __Password__ otherwise __VALIDATION ERROR__.

- It will return you user details with __token__. 

---

## Customer Api

- It is using a Route __PREFIX__ with __MIDDLEWARE__ and __GROUP__

- Example __Route::middleware(['auth:sanctum'])->prefix('customer')->group();__

- Base __API__ will be __http://127.0.0.1:8000/api/customer__

- It will return you user details and __token__ 

---
## Api usage for customer

- __MAIL_MAILER=smtp__

- __MAIL_HOST=YOUR MAIL HOST__

- __MAIL_PORT=Your Mail Port__

- __MAIL_USERNAME=Your Mail Username__

_ __MAIL_PASSWORD=Your Mail Password__

- You can also update other values as well.

---

## Email Screenshot
![Email Notification](https://laraveldaily.com/wp-content/uploads/2019/11/Screen-Shot-2019-11-15-at-6.17.59-PM.png)

---

## License (FREE)

Basically, feel free to use and re-use any way you want.

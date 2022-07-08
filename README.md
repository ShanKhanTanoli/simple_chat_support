## Introduction

- Project __Online Support System on Laravel 9.19.__
- Framework __Laravel V 9.19.__

---
## Author

- Author __Shan Khan__
- Email __shankhantanoli1@gmail.com__
- Run __composer install__

---

## Humble Request

- __If you want me to change/modify anything then please let me know, I will change it asap__
- __Please give me chance to join your team, I will improve myself__
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

## Api for login

- Login __http://127.0.0.1:8000/api/login__ It expectes __Email__ and __Password__

- Use any __EMAIL__ from users table__ and __PASSWORD__ will be "password".

- It will return you User details and __token__ 

- __EXAMPLE RETURN__
{
    "user": {
        "id": 1,
        "name": "Agent1",
        "email": "agent1@gmail.com",
        "created_at": "2022-07-08T11:47:00.000000Z",
        "updated_at": "2022-07-08T11:47:00.000000Z"
    },
    "token": "3|PAkAWDJyG5gx71lMIk6D8c1ySYz90r0w9naAzuwu",
    "message": "Successfully logged in"
}

---
## Api usage for customer

- __MAIL_MAILER=smtp__
- __MAIL_HOST=YOUR MAIL HOST__
- __MAIL_PORT=Your Mail Port__
- __MAIL_USERNAME=Your Mail Username__
_ __MAIL_PASSWORD=Your Mail Password__

- __You can also update other values__

---

![Email Notification](https://laraveldaily.com/wp-content/uploads/2019/11/Screen-Shot-2019-11-15-at-6.17.59-PM.png)

---

## License

Basically, feel free to use and re-use any way you want.

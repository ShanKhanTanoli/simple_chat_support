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

- __Although this is not good enough but Please give me chance to join your team, I will improve myself__

- __If you want me to change/modify anything then please let me know, I will change it asap__

- __Please give me chance to join your team, I will improve myself and I will try my best__

- __I want to learn more and I want to get experience, Please kindly give me chance to join your team__

- __I can make this task more better and also I can use a different logic__
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

- Login __(POST REQUEST)__ __YourURL/api/login__.

- It expectes __Email__ and __Password__ otherwise __VALIDATION ERROR__.

- Use any __EMAIL__ from __USERS TABLE__ and __PASSWORD__ will be __"password"__ in lowercase.

- It will return you user details with __token__.

---

## Register Api (Only customer can register)

- Register __(POST REQUEST)__ __YourURL/api/register__.

- It expectes __Name , Email__ and __Password__ otherwise __VALIDATION ERROR__.

- It will return you user details with __token__. 

---

## Customer Api

- It is using a Route __PREFIX__ with __MIDDLEWARE__ and __GROUP__

- Example __Route::middleware(['auth:sanctum'])->prefix('customer')->group();__

- Base __API__ will be __YourURL/api/customer__

---

## Customer Api Operations

- __View tickets__

- __(GET REQUEST)__ __YourURL/api/customer/{token}__.

- __Ask question on a ticket__

- __(POST REQUEST)__ __YourURL/api/customer/askquestion/{ticket}/{token}__.

- __Answer on a ticket to specific question__

- __(POST REQUEST)__ __YourURL/api/customer/giveanswer/{ticket}/{question}/{token}__.

- __View asked questions on a specific ticket__

- __(GET REQUEST)__ __YourURL/api/customer/questions/{ticket}/{token}__.

- __View answers on a specific question__

- __(GET REQUEST)__ __YourURL/api/customer/answers/{question}/{token}__.

---

## Support Api

- It is using a Route __PREFIX__ with __MIDDLEWARE__ and __GROUP__

- Example __Route::middleware(['auth:sanctum'])->prefix('support')->group();__

- Base __API__ will be __YourURL/api/support__

---
## Support Api Operations

- __Can view all tickets__

- __(GET REQUEST)__ __YourURL/api/support/{token}__.

- __Ask Question on a specific ticket__

- __(POST REQUEST)__ __YourURL/api/support/askquestion/{ticket}/{token}__.

- __Answer on a ticket to a specific question__

- __(POST REQUEST)__ __YourURL/api/support/giveanswer/{ticket}/{question}/{token}__.

- __View asked questions on a specific ticket__

- __(GET REQUEST)__ __YourURL/api/support/questions/{ticket}/{token}__.

- __View answers on a specific question__

- __(GET REQUEST)__ __YourURL/api/support/answers/{question}/{token}__.

- __Marked as answered__

- __(POST REQUEST)__ __YourURL/api/support/markanswered/{ticket}/{token}__.

- __Marked as not answered__

- __(POST REQUEST)__ __YourURL/api/support/marknotanswered/{ticket}/{token}__.

- __Marked as spam__

- __(POST REQUEST)__ __YourURL/api/support/markspam/{ticket}/{token}__.

- __Mark in progress__

- __(POST REQUEST)__ __YourURL/api/support/markinprogress/{ticket}/{token}__.

- __Search ticket__

- __(GET REQUEST)__ __YourURL/api/support/searchticket/{token}__.

- __Search question__

- __(GET REQUEST)__ __YourURL/api/support/searchquestion/{token}__.

- __Search answer__

- __(GET REQUEST)__ __YourURL/api/support/searchanswer/{token}__.

---

## Auto Update Status (Task Scheduling)

- There are a lot of ways that we can archieve this goal

- One way is to use __CRON JOB__.

- I am using __CRON JOB__ here. I have created a __METHOD__ that will check if there is a __TICKET__ on which the __CUSTOMER__ did not reply for __24 hours__ then change __STATUS__ to __ANSWERED__.

- You can run this command __php artisan que:work__ It will update the __Tickets STATUS__ to __ANSWERED__ where __CUSTOMER__ did not reply for __24 hours__.
---

## Helpers Methods

- __Helpers__ are available in this __namespace App\Helpers;__.

- Available __Helpers__ are __Answer , Question , Ticket__.

- You can use Helper Methods.

---

## Email Notification

- When __Support__ will mark a __Ticket__ as  __Answered__ then an __Email__ will be sent to the customer.

- Available __Helpers__ are __Answer , Question , Ticket__.

- __TicketAnswered__ class is used for sending Email Notification.

- An __Email__ template __notification-email.blade.php__ is available inside __views/emails__.

---

## Email Screenshot
![Email Notification](https://spirtualstore.prosolpk.com/wp-content/uploads/2022/07/Email.png)

---

## License (FREE)

Basically, feel free to use and re-use any way you want.

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

- Login __(POST REQUEST)__ __URL/api/login__.

- It expectes __Email__ and __Password__ otherwise __VALIDATION ERROR__.

- Use any __EMAIL__ from __USERS TABLE__ and __PASSWORD__ will be __"password"__ in lowercase.

- It will return you __CUSTOMER/SUPPORT__ with __TOKEN__.

---

## Register Api (Only customer can register)

- Register __(POST REQUEST)__ __URL/api/register__.

- It expectes __Name , Email__ and __Password__ otherwise __VALIDATION ERROR__.

- It will return you __CUSTOMER__ with __TOKEN__. 

---

## Customer Api

- It is using a Route __PREFIX__ with __MIDDLEWARE__ and __GROUP__

- Example __Route::middleware(['auth:sanctum'])->prefix('customer')->group();__

- Base __API__ will be __URL/api/customer__

---

## Customer Ticket Api (Unregistered)

- If it is a new customer or customer is not registered

- __Open a new ticket__

- __(POST REQUEST)__ URL/api/customer/newticket

- It will __VALIDATE NAME , EMAIL and PASSWORD__ and It will __OPEN NEW TICKET__.

- It will __REGISTER__ the __CUSTOMER__ and __PASSWORD => "password"__ in lowercase.

---

## Customer Ticket Api (Registered and Authenticated)

- __View tickets__

- __(GET REQUEST)__ URL/api/customer/tickets/{token}

- __Open a ticket__

- __(POST REQUEST)__ URL/api/customer/openticket/{token}

---

## Customer Chat Api (Registered and Authenticated)

- __View chat on a specific ticket__

- __(GET REQUEST)__ URL/api/customer/chat/{ticket}/{token}

- __Message on a specific ticket__

- __(POST REQUEST)__ URL/api/customer/message/{ticket}/{token}

- __Reply on a ticket to specific message__

- __(POST REQUEST)__ URL/api/customer/reply/{message}/{ticket}/{token}

---

## Support Api

- It is using a Route __PREFIX__ with __MIDDLEWARE__ and __GROUP__

- Example __Route::middleware(['auth:sanctum'])->prefix('support')->group();__

- Base __API__ will be __URL/api/support__

---
## Support Ticket Api (Authenticated)

- __View tickets__

- __(GET REQUEST)__ URL/api/support/tickets/{token}

- __Open a ticket__

- __(POST REQUEST)__ URL/api/support/openticket/{token}

- __Mark ticket as spam__

- __(POST REQUEST)__ URL/api/support/markspam/{ticket}/{token}

- __Mark ticket as answered__ It will also __SEND NOTIFICATION EMAIL__ to __CUSTOMER__

- __(POST REQUEST)__ URL/api/support/markanswered/{ticket}/{token}

- __Mark ticket as not answered__

- __(POST REQUEST)__ URL/api/support/marknotanswered/{ticket}/{token}

- __Mark ticket as in progress__

- __(POST REQUEST)__ URL/api/support/markinprogress/{ticket}/{token}

- __Search ticket__ Powered by __ALGOLIA__

- It will expect __query__ for __SEARCH__ and __VALIDATE__

- __(GET REQUEST)__ URL/api/support/ticketsearch/{token}

---

## Support Chat Api (Authenticated)

- __View chat on a specific ticket__

- __(GET REQUEST)__ URL/api/support/chat/{ticket}/{token}

- __Message on a specific ticket__

- __(POST REQUEST)__ URL/api/support/message/{ticket}/{token}

- __Reply on a ticket to specific message__

- __(POST REQUEST)__ URL/api/support/reply/{message}/{ticket}/{token}

- __Search chat__ Powered by __ALGOLIA__

- It will expect __query__ for __SEARCH__ and __VALIDATE__

- __(GET REQUEST)__ URL/api/support/chatsearch/{token}

---

## Auto Update Status (Task Scheduling)

- There are a lot of ways that we can archieve this goal.

- One way is to use __CRON JOB__.

- I am using __CRON JOB__ here. I have created a __METHOD__ that will check if there is a __TICKET__ on which the __CUSTOMER__ did not reply for __24 hours__ then __STATUS__ will be changed to __ANSWERED__ automatically.

- You can run this command __php artisan que:work__.

- It will update the __Ticket STATUS__ to __ANSWERED__ where __CUSTOMER__ did not reply for __24 hours__.

---

## Helpers Methods

- __Helpers__ are available in this __namespace App\Helpers;__.

- __Helpers =>__ Chat , Message , Reply , Support and Ticket.

- Various __METHODS__ are available on __Helpers__.

- You can use __Helper METHODS__.

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

# How to Build a Marketplace Site with Vue and Laravel (Etsy Clone)

Read the full tutorial here:

> > Not yet published

This application detailed the step by step guide on how to build a market place site similar to Etsy using Laravel, Vue.js and CometChat.

## Technology

This demo uses:

-   [CometChat](https://cometchat.com/)
-   [Laravel](https://laravel.com/)
-   [Vuejs](https://vuejs.org/)

## Running the demo

To run the demo follow these steps:

1. Head to the [CometChat dashboard](https://app.cometchat.com/) (you'll need to create a free account if you haven't already)
2. From the dashboard, create a new app called "lara-market-place" or use any name you prefer
3. Click **API & Auth Keys** on the left-hand-side and note the automatically-generated REST API Key and the application ID as well
4. Download the repository [here](https://github.com/yemiwebby/lara-market-place/archive/master.zip) or by running `git clone https://github.com/yemiwebby/lara-market-place.git`
5. Run `composer install` to install all the dependencies for the backend (Laravel)
6. Run `npm install` to install all the dependencies for the frontend (Vuejs)
7. Create a `.env` file with the root folder of the project, then copy the content `.env.example` and paste it in the newly created file.
8. Next, locate the following variables within the `.env` file and replace the placeholders with the appropriate credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=YOUR_DB_USERNAME
DB_PASSWORD=YOUR_DB_PASSWORD

MIX_COMMETCHAT_API_KEY=YOUR_COMMETCHAT_API_KEY
MIX_COMMETCHAT_APP_ID=YOUR_COMMETCHAT_APP_ID
MIX_COMMETCHAT_APP_REGION=YOUR_COMETCHAT_APP_REGION
```

9. Next, run the following command to create tables for your database:

```bash
php artisan migrate
```

10. Open the project in two separate terminal. From one of the terminals, run `php artisan serve` to start the backend and `npm run watch` from the other to start the frontend application in watch mode.

11. You can go ahead and register two different users. Once you are done, log in from two different browsers with the credentials of the users created and create a product.

## Useful links

-   🏠 [CometChat Homepage](https://www.cometchat.com/pro)
-   🚀 [Create your free account](https://app.cometchat.com/#/apps)
-   📚 [Documentation](https://prodocs.cometchat.com/docs)
-   👾 [GitHub](https://github.com/CometChat-Pro)

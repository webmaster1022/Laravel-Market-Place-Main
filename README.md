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

require('./bootstrap');

window.Vue = require('vue').default;

import { CometChat } from "@cometchat-pro/chat/CometChat";

Vue.component('login-component', require('./views/Login.vue').default);
Vue.component('register-component', require('./views/Register.vue').default);
Vue.component('products-component', require('./views/Products.vue').default);
Vue.component('product-component', require('./views/Product.vue').default);
Vue.component('create-product-component', require('./views/CreateProduct.vue').default);
Vue.component('inbox-component', require('./views/Inbox.vue').default);


let cometChatAppSetting = new CometChat.AppSettingsBuilder()
    .subscribePresenceForAllUsers()
    .setRegion(process.env.MIX_COMMETCHAT_APP_REGION)
    .build();

CometChat.init(process.env.MIX_COMMETCHAT_APP_ID, cometChatAppSetting).then(
    () => {
        console.log("Initialization completed successfully");

        const app = new Vue({
            el: '#app',
        });
    },
    (error) => {
        console.log("Initialization failed with error:", error);
    }
);

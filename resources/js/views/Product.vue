<template>
    <div>
        <div class="row">
            <div class="col-md-8">
                <img width="100%" height="500" :src="product.product_url" :alt="product.description" />

                <div class="product-container">
                    <div class="video-description">
                        <h4 class="text-left">{{ product.name }}</h4>
                        <span class="date sub-text">{{ getCreatedDate(product.created_at) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-5">
                <div v-if="this.owner === this.uid">
                    <button class="btn btn-outline-dark" v-on:click="viewInbox"> View Inbox </button>
                </div>

                <div v-else>
                    <button class="btn btn-outline-dark" v-on:click="messageTheSeller"> {{ messageSeller ? 'Close Chat' : 'Meet your seller' }} </button>
                    <div id="chat-box" v-if="messageSeller">
                        <comet-chat-messages type="user" :logged-in-user="authUser" :item="productOwner"></comet-chat-messages>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import  { CometChatMessages }  from "../cometchat-pro-vue-ui-kit/";
import {CometChat} from "@cometchat-pro/chat";
import moment from "moment"

export default {
    name: "Product",
    props: ['id', 'uid', 'user','owner'],
    components: {
        CometChatMessages,
    },
    data() {
        return {
            product: {},
            authUser: {},
            productOwner: {},
            messageSeller: false
        }
    },
    async mounted() {
        this.authUser = await CometChat.getUser(this.uid);
        this.productOwner = await CometChat.getUser(this.owner);

        console.log(this.owner, this.uid, "result");

        axios.get(`http://localhost:8000/product/${this.id}`)
            .then((response) => {
                console.log(response.data.product);
                this.product = response.data.product;
            })
            .catch((error) => {
                console.log(error);
            });
    },
    methods: {
        messageTheSeller() {
            this.messageSeller = !this.messageSeller;
        },
        viewInbox() {
            window.location.href = `/inbox`
        },
        getCreatedDate(date) {
            return moment(date).format('MMMM d, Y')
        }
    }
}
</script>

<style scoped>
#chat-box {
    width: 100%;
    position: absolute;
    height: 100%;
}
.product-container{
    display:flex;
    flex-direction:row;
    justify-content:space-between;
    border-bottom:1px solid #ececec;
    padding:10px 0
}
.sub-text{
    color:#909090
}
.icon-container .fab{
    font-size:45px
}
</style>

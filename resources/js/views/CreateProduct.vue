<template>
    <div class="login-page">
        <div class="login">
            <div class="register-container auth-container">
                <div class="register-image-column">
                    <div class="image-holder">
                        <img src="#" alt="">
                    </div>
                </div>

                <div class="register-form-column">
                    <form v-on:submit.prevent="createProduct">
                        <h3>Create a Product </h3>
                        <div class="form-wrapper">
                            <label for="name"> Name </label>
                            <input type="text" name="name" id="name" v-model="name" placeholder="Enter name of product" class="form-control" required>
                        </div>

                        <div class="form-wrapper">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" v-model="description" placeholder="Enter Description" class="form-control" required>
                        </div>

                        <div class="form-wrapper">
                            <label for="quantity">Quantity</label>
                            <input type="text" name="quantity" id="quantity" v-model="quantity" placeholder="Enter Quantity" class="form-control" required>
                        </div>

                        <div class="form-wrapper">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="price" v-model="price" placeholder="Enter Quantity" class="form-control" required>
                        </div>
                        <button type="submit" class="mt-3">CREATE &nbsp;&nbsp;<span v-if="showSpinner" class="fa fa-spin fa-spinner"></span> </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
export default {
    name: "CreateProduct",
    data() {
        return {
            name: "",
            description: "",
            quantity: "",
            price: "",
            showSpinner: false,
        };
    },
    methods: {
        createProduct() {
            if (this.name && this.description && this.quantity && this.price) {
                this.showSpinner = true;

                let data = {
                    name: this.name,
                    description: this.description,
                    quantity: this.quantity,
                    price: this.price,
                }

                axios.post(`http://localhost:8000/create`, data)
                    .then(response => {
                        console.log("Product created successfully", response.data);
                        this.redirect();
                    }).catch(error => {
                    console.log(error.response.data.message);
                })
            } else {
                alert("Please fill all the fields")
            }
        },
        redirect() {
            window.location.href = '/home';
        }
    }
};
</script>

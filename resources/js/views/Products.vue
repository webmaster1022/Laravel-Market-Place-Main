<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4" :key="product.id" v-for="product in products">
                <a href="#" class="inner" v-on:click.prevent="redirectAndViewProduct(product.id)">
                    <figure class="card card-product">
                        <div class="img-wrap"><img :src="product.product_url" :alt="product.description"></div>
                        <figcaption class="info-wrap">
                            <h4 class="title"> {{product.name}} </h4>
                            <p class="desc"> {{product.description}} </p>
                            <div class="rating-wrap">
                                <div class="label-rating">132 reviews</div>
                                <div class="label-rating">154 orders </div>
                            </div>
                        </figcaption>
                        <div class="bottom-wrap">
                            <a href="" class="btn btn-sm btn-primary float-right">Order Now</a>
                            <div class="price-wrap h5">
                                <span class="price-new">$1280</span> <del class="price-old">$1980</del>
                            </div>
                        </div>
                    </figure>
                </a>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    name: "Products",
    data() {
        return {
            products: [],
            showSpinner: false,
        };
    },
    created() {
        axios.get(`http://localhost:8000/products`)
            .then((response) => {
                this.products = response.data.products;
                console.log(response.data.products);
            })
            .catch((error) => {
                console.log(error);
            })
    },
    methods: {
        async redirectAndViewProduct(id) {
            window.location.href = `view-single-product/${id}`
        }
    }
}
</script>


<style scoped>

.card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 220px;
    text-align: center;
}
.card-product .img-wrap img {
    max-height: 100%;
    max-width: 100%;
    object-fit: cover;
}
.card-product .info-wrap {
    overflow: hidden;
    padding: 15px;
    border-top: 1px solid #eee;
}
.card-product .bottom-wrap {
    padding: 15px;
    border-top: 1px solid #eee;
}

.label-rating { margin-right:10px;
    color: #333;
    display: inline-block;
    vertical-align: middle;
}

.card-product .price-old {
    color: #999;
}
</style>

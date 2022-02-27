<template>
    <div class="col-3">
        <div class="card mb-4" style="width: 18rem;">
            <img :src="`/storage/${product.picture}`" class="card-img-top" :alt="product.name">
            <div class="card-body">
                <h5 class="card-title">
                    {{product.name}}
                </h5>
                <p class="card-text">
                    {{ product.description }}
                </p>
                <div class="product-price">
                    {{ product.price }} руб.
                </div>
                <div class="product-buttons">
                    <button v-if='cartQuantity' @click="cartAction('removeFrom')" class="btn btn-danger">-</button>
                    <button v-else disabled class="btn btn-danger">-</button>
                    {{ cartQuantity }}
                    <button @click="cartAction('addTo')" class="btn btn-success">+</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['product'],
    data () {
        return {
            cartQuantity: this.product.quantity
        }
        }, 
         methods: {
        cartAction (type) {
            const params = {
                id: this.product.id
            }
            axios.post(`/cart/${type}Cart`, params)
                .then(response => {
                    this.cartQuantity = response.data
                    let quantity = localStorage.cartProductsQuantity
                    if (type == 'removeFrom') quantity -= 1
                    else quantity += 1
                    localStorage.cartProductsQuantity = quantity
                })
        }
    }
    
}
</script>

<style>
</style>
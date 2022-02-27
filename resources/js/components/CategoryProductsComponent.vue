  <template>
    <div class="row" :class="{'m-top': !products.length}">
        <div v-if="!products.length" class="spinner-border text-info" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <product-component 
            v-else
            v-for='product in products' :key='product.id'
            :product="product">
        </product-component>
    </div>
</template>

<script>
import ProductComponent from './ProductComponent.vue'
export default {
    props: ['category'],
    components: {ProductComponent},
    data () {
        return {
            products: []
        }
    },
    mounted () {
        debugger
        axios.get(`/category/${this.category}/getProducts`)
            .then(response => {
                this.products = response.data
                debugger
            })
    }
}
</script>

<style scoped>
    .row {
        justify-content: space-around;
    }
    .m-top {
        margin-top: 40%;
    }
</style>
<template>
    <div>
        <h1>{{pageTitle}}</h1>

        <div class="row">

            <category-component
                v-for='category in categories'
                :key="category.id"
                :category='category'
                :route-category="routeCategory"
                @buttonClicked='buttonClicked'
            >
            </category-component>
        </div>
    </div>
</template>

<script>
    import CategoryComponent from './CategoryComponent.vue'
    
    export default {
        props: ['pageTitle', 'categories', 'routeAdminCategories', 'routeCategory'],
        components: {CategoryComponent},
        methods: {
            buttonClicked (data) {
                console.log(`клик в дочернем компоненте (${data})`)
            }
        },
        mounted () {
            debugger
            console.log(this.routeCategory)
            let quantity = cartProductsQuantity.textContent.split('(')[1]
            quantity = quantity.split(')')[0]
            localStorage.cartProductsQuantity = quantity
        }
    }
</script>

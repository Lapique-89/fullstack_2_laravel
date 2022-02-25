<template>
<div>
    <h1> {{pageTitle}} </h1>
    <div class="row">        
        <category-component
            v-for='category in categories'
            :key="category.id"
            :category='category'
            :rout-category='routeCategory'
            @buttonClicked='buttonClicked'>
        </category-component>
    </div>
</div>
</template>

<script>
import CategoryComponent from './CategoryComponent.vue'
    export default {
        props: [
            'test' , 'pageTitle'  , 'categories'  , 'routeCategory'       
        ],
        components: {CategoryComponent},

        data () {
            return {               
            }
        },
        methods: {  
buttonClicked(data) {
    console.log(`клик в дочернем компоненте (${data})`)
}
        },       
        created () {
         
            console.log(this.test,  this.categories)
        }
    }
</script>
<style scoped>

</style>

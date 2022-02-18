<template>
    <div >
     {{ name }}
     <br>
     Counter: {{ counter }}
     <br>
    <button @click="counterPlus" type="btn btn-info">Click</button>
    
    <span v-if="counter < 10">Значение count меньше 10</span>
    <span v-else-if="counter < 15">Значение count меньше 15</span>
    <span v-else>Значение count больше или равно 15</span>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Категория</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(category, index) in categories" :key="category.id">
                <td>
                    {{ index +1  }}
                </td >
                <td>
                    <a :href="`/category/${category.id}`">
                    {{ category.name}} ({{category.id}})
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    {{fullName}}
    </div>
</template>

<script>
    export default {
        data () {
            return {
                name:'Lena',
                lastName: 'Lapik',
                counter:0,
                categories: [
                    {
                        id: 5,
                        name: 'Видеокарты'
                    },
                    {
                        id: 6,
                        name: 'Жесткие диски'
                    },
                ],
            }
        },
        methods: {
            counterPlus () {
                this.counter+=1
            }
        },
        computed: {
            fullName () {
                this.name + ' '+ this. lastName
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>

</style>

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
    <!-- <select v-model='selected' @change="selectChanged" class="form-control">
        <option :value='null' selected disabled>--Выберите значение--</option>
        <option  v-for="(option, idx) in options" :key="idx" :value="option">
            {{ option}}
        </option>
    </select> -->
    <select v-model='selected'  class="form-control mb-5">
        <option :value='null' selected disabled>--Выберите значение--</option>
        <option  v-for="(option, idx) in options" :key="idx" :value="option">
            {{ option}}
        </option>
    </select>
    <button :disabled="!selected" class="btn mt-5" :class="buttonClass">Сохранить</button>
    
    <button @click='getData' class="btn btn-info mt-5">Получить данные</button>
     <table class="table  table-bordered">
  
  <tbody>
    <tr v-for="user in users" :key="user.id">
      
      <td>{{ user.id }}</td>
      <td>{{ user.name }}</td>
      <td>{{ user.email }}</td>
    </tr>
     <tr v-if="!users.length">
        <td class="text-center" colspan="3">
            <em>Данные пока не получены
            </em>    
        </td>
    </tr> 
  </tbody>
</table>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                name:'Lena',
                lastName: 'Lapik',
                counter:0,
                options: [
                    1,2,3,4
                ],
                selected:null,
                text: 'Hello',
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
                users:[]
            }
        },
        methods: {
            getData ( ) {
                const params = {
                    id:1
                }
                
                axios.get('/api/test', {params})
                .then(response => {
                    this.users = response.data
                })
            },
            counterPlus () {
                this.counter+=1
            },
           
           /*  selectChanged () {
                console.log(this.selected)
            } */
        },
        watch: {
            selected: function (newValue, oldValue) {
                console.log(`новое значение: ${newValue}, старое значение: ${oldValue}`)
            
        }
        },
        computed: {
            fullName () {
               return this.name + ' '+ this. lastName
            },
             reversedText () {
                return this.text.split('').reverse().join('')
            },
            buttonClass () {
                return this.selected ? 'btn-success' : 'btn-primary'
            }
            
        },
        mounted () {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>

</style>

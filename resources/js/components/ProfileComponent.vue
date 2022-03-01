<template>
  <div>   
        
   <div class="col-sm-8">
    <div class="card" >   
      <div class="card-body">
                <h5 class="card-title">
                     Профиль
                </h5>
        
        <div class="mb-3">
            <label class="form-label">Изображение</label>
             <img class="user-picture" :src="`/storage/${picture}`" :alt="name"> 
            <input type="file" class="form-control" id="file" ref="file" v-on:change="handleFileUpload()">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Почта</label>
            <input placeholder="Почта" class="form-control" type="email" name='email' v-model="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input name="name" v-model="name" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Текущий пароль</label>
            <input type="password" autocomplete="off" name="current_password" v-model="current_password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Новый пароль</label>
            <input type="password" name="password"  v-model="password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Повторите новый пароль</label>
            <input type="password" name="password_confirmation" v-model="password_confirmation" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Список адресов</label>
            <ul>
                <div v-for='address in addressesform' :key='address.id'>
                    
                    <input  :id="`main_address${address.id}`" type="radio" name='main_address'  :value="address.id" v-model="selectedaddress">
                    <label :for="`main_address${address.id}`">{{address.address}}</label> 
                </div>   
                <div v-if='!addresses.length'>
                    Данных нет   
                </div>             
            </ul>
        </div>
       

    <div class="mb-3">
            <label class="form-label">Новый адрес</label>
            <input 
                name="new_address" 
                class="form-control" 
                v-model="new_address">
        </div>
        <div 
            class="mb-3"
            v-if="new_address.length>0">
        <input 
            id='is_Main' 
            name='is_Main' 
            type="checkbox"             
            v-model="checked">          
        <label for="is_Main">Сделать основным</label> 
        </div> 
        <div class="row">
            <div class="col-sm-2">
                <div class="mb-3">
                    <button v-if='loading' class="btn btn-primary" type="button" disabled>
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Сохраняем профиль...
                    </button>
                    <button v-else @click='profileSaved' class="btn btn-success">Сохранить</button>
                </div>               

            </div>
            <div class="col-sm-10">
                <div v-if='errors.length' class="alert alert-warning" role="alert">
                <span v-for='(error, idx) in errors' :key='idx'>{{error}}<br></span>        
                </div>
            </div>
        </div>
  </div>
  </div>
  </div>   
  </div>
</template>

<script>
export default {
props: ['user', 'addresses'],
data () {
        return {
            name:'',
            email:'',
            addressesform:[],
            current_password:'',
            password:'',
            password_confirmation:'',            
            errors: [],
            loading: false,
            selectedaddress:0,
            new_address:'',
            checked:true,
            file:'', 
            errors: [],
            picture:'', 
            loading: false
        }
},
methods: {
        handleFileUpload(){
        this.file = this.$refs.file.files[0];
        },
        profileSaved () {
            this.loading = true
            this.errors = []
            let formData = new FormData();
            formData.append('file', this.file);
            formData.append('name', this.name);
            formData.append('email', this.email);
            formData.append('new_address', this.new_address);
            
            formData.append('userId', this.user.id);
            formData.append('is_Main', this.checked);
            formData.append('current_password', this.current_password);
            formData.append('password_confirmation', this.password_confirmation);
            formData.append('password', this.password);
            formData.append('main_address', this.selectedaddress);
            debugger
            axios.post( `/profile/save`,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                ).then(response => {
                console.log(response.data.user);
                
                this.name=response.data.user.name;
                this.email =response.data.user.email;
                this.current_password = response.data.user.password;
                const index = response.data.addresses.find((address) => {
                    if (address.main==1)
                                    return address
                                })  
                this.selectedaddress = index.id 
                this.picture=response.data.user.picture;
                this.addressesform=response.data.addresses;
                this.new_address='';
                })
                .catch(error => {
                const errors = error.response.data.errors
                for (let err in errors) 
                    {
                        errors[err].forEach(e => {
                            this.errors.push(e) 
                        })
                    
                    }
                    console.log(errors)
                }).finally(() => {
                this.loading = false
            })
        }
},
mounted () {

    console.log(this.user)
    this.name=this.user.name;
    this.email = this.user.email;
    this.current_password = this.user.password
    const index = this.addresses.find((address) => {
        if (address.main==1)
                        return address
                    })  
    this.selectedaddress = index.id    
                  this.picture=this.user.picture 
                  this.addressesform=this.addresses       
    }
}
</script>

<style>
.user-picture {
        width: 60px;
        border-radius: 100px;
        display: block;
    }
</style>
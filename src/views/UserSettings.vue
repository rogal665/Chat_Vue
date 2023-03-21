<script setup>

import {useUserStore} from '@/stores/user'
const storeUser = useUserStore();

</script>



<template >
  <div  class="settings">
    <div id="error" >{{ storeUser.info }}</div>
      <form id="myform"> 
        Imię: <br> <input type="text" v-model="data.username"  name="username" placeholder="Username"><br>
        E-mail: <br><input type="text" v-model="data.email" name="email" placeholder="Email"><br><br>
        <div style="padding: 10px;">
        Płeć:<br>
        <input type="radio" id="Male" value="Male" v-model="data.gender" />
        <label for="Male">Mężczyzna</label>
          <br>
        <input type="radio" id="Female" value="Female" v-model="data.gender" />
        <label for="Female">Kobieta</label>
        <br><br>
        </div>
        Nowe Hasło:<br>
        <input type="password" v-model="data.password" name="password" placeholder="Password"><br>
        <input type="password" v-model="data.password2"  name="password2" placeholder="Retype Password"><br>             
        <div ><img @dragover="dragover" @drop="drop" @dragleave="dragleave"  :src=storeUser.my_image  /></div>
        <div>

        <input style="display:none" ref="fileInput" id="change_image_input" @change="uploadFile"  type="file"  ><br>
        <button type="button" @click="$refs.fileInput.click()">Wybierz Zdjęcie</button>        
        </div>

        <button  type="button" :class="[btnClass]"  id="login_button" @click="collect_data();this.foto_changed= true;" >{{save_settings}}</button> 
      </form>
      <br>
      <span id="info_text">
        Formularz przyjmuje zdjęcia w formacie jpg. Możesz zarówno kliknąć "Wybierz Zdjęcie" jak i przesunąć zdjęcie do formularza za pomocą funkcji "drag and drop"
      </span>
    </div>
</template>



<script>


export default {
  name: 'LoginPage',
  data() {
    return{
      data: {
        userid:'',
          email:'',
          image:'',
          username:'',
          password:'',
          password2:'',
          gender:'',
         },
     
      isDragging: false,
    
      btnClass: String,
      save_settings: 'Zapisz Zmiany',
      info: '',
      
      selectedFile: null,
      
      }
      
  },


methods:{  
  dragover(e) {
    e.preventDefault();
    this.isDragging = true;   
    },
    dragleave() {
      this.isDragging = false;
    },

    drop(e) {
      e.preventDefault();
      const storeUser = useUserStore();   
      storeUser.selectedFile = e.dataTransfer.files[0];
      this.isDragging = false;
      storeUser.onUpdate();
      this.foto_changed = true
    },


    
    collect_data: function (){ 
      const storeUser = useUserStore();    
      storeUser.send_data(this.data,"save_settings");
      if (this.selectedFile){
        
        storeUser.onUpdate() 
        this.foto_changed = true
      }
      
    },

  

    uploadFile:function(event){
      const storeUser = useUserStore()
      storeUser.selectedFile = event.target.files[0];
      storeUser.onUpdate();  
    },

      
  },
  created: function(){
    const storeUser = useUserStore()
    storeUser.send_data({},"user_info")  
    this.data.userid= storeUser.my_userid;
    this.data.email= storeUser.my_email;
    this.data.image= storeUser.my_image;
    this.data.username= storeUser.my_username;
    this.data.password= storeUser.my_password;
    this.data.password2= storeUser.my_password2;
    this.data.gender= storeUser.my_gender;
    },
}

</script>

data.

<style scoped>

.settings{
  
  padding: 20px;
  padding-top: 30px;  
  margin: auto;
  margin-top: 10px;
  min-height: 350px;
  max-width: 500px;
  min-height: 350px;
  background-color: rgb(54, 54, 58);
  border-radius: 15px;
}

button{
  background-color: #575757;
  font-size: 15px;
  color: rgb(255, 255, 255);
  text-decoration: solid;
  padding: 7px;
  padding-left: 15px;
  padding-right: 15px;
  margin: 5px;
  border:none;
  border-radius: 5px;
  cursor: pointer;
}

input{
  border-radius: 5px;
  padding: 5px;
}

#info_text{
  font-size: 16px;
  color: rgb(170, 169, 169);
}

img{
  width:200px;
  height:200px;
  margin:10px;
  border-radius: 15px;
}



</style>
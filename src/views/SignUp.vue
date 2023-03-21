<script setup>


import {useUserStore} from '@/stores/user'


const storeUser = useUserStore();




</script>


<template>
  <div   class="login">
    <div id="wrapper">
      
        <div style="font-size: 20px;">Signup</div>
          </div>
          
          <div id="error" >{{ storeUser.info }}</div>
            <form id="myform">
              <input type="text" v-model="data.username" name="username" placeholder="Imię"><br>
              <input type="text" v-model="data.email" name="email" placeholder="Email"><br>
              <div style="padding: 10px;">
              Płeć:<br>
                              

              <input type="radio" id="Male" value="Male" v-model="data.gender" />
              <label for="Male">Mężczyzna</label>
                <br>
              <input type="radio" id="Female" value="Female" v-model="data.gender" />
              <label for="Female">Kobieta</label>

              </div>
              <input type="password" v-model="data.password" name="password" placeholder="Hasło"><br>
              <input type="password" v-model="data.password2"  name="password2" placeholder="Powtórz Hasło"><br>
              <button type="button" :class="[btnClass]"  id="login_button" @click="storeUser.signup(data)" >{{signup_button}}</button>

              <br>
              <router-link to="/login">Posiadasz już konto? Zaloguj się!</router-link>
            </form>
            <br><span id="info_text">
            Podczas rejestracji możesz użyć fikcyjnego adresu e-mail. Nie używaj też hasła, którego używasz do logowania się winnych serwisach. Autor nie bierze odpowiedzialności za bezpieczeństwo wprowadzonych danych.
          </span>
  </div>  
</template>


<script>




import axios from 'axios';




export default {
  name: 'LoginPage',
  

  data() {
    return{
      data: {
        find: '',
        data_type: ''
      },
      
      btnClass: String,
      signup_button: 'Zarejestruj się',
      info: '',
      response: '',
      password2: '',
      gender: ''
      }
      
  },


  methods:{
    
    collect_data: function (){

      //disabling button
      this.btnClass = "not_active_button";
      this.signup_button = 'Loading...Please wait..';
      
     
      
      this.send_data(this.data,"signup");
      
      
      

    },

  send_data: function(data,type){

    
    
    data.data_type = type; 
    axios.post('http://lumoschat.pl/api.php', data)
    .then(response => {
    //console.log(response.data);
    if (response.data.data_type == "error"){
      this.info = response.data.message;
    }else{
      this.info = "";
      this.$router.push('/login');
      setTimeout(() => window.location.reload() , 500);
    }

    
    this.btnClass = "";
    this.signup_button = 'Zarejestruj się';
    
     
    
    
  });    
  }


}
}

</script>





<style>

  
.not_active_button {
  background: rgb(133, 133, 133);
 }

#error{

  text-align: center;
  padding: 0.5em;
  color: rgb(255, 0, 0);
  
}

.login{
  
  padding: 20px;
  padding-top: 70px;  
  margin: auto;
  margin-top: 10px;
  min-width: 400px;
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
}

input{
  border-radius: 5px;
  padding: 5px;
}


#info_text{
  font-size: 16px;
  color: rgb(170, 169, 169);
}

</style>
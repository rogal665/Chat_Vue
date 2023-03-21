<script setup>


import {useUserStore} from '@/stores/user'


const storeUser = useUserStore();




</script>


<template v-if="this.data">
  <div  class="login">
    <div id="wrapper">
      
        <div style="font-size: 20px;">Zaloguj się</div>
          </div>
          
          <div id="error" >{{ storeUser.info }}</div>
            <form id="myform">
              <input type="text" v-model="data.email" placeholder="Email"><br>
              <input type="password" v-model="data.password" placeholder="Hasło"><br>
              <button type="button" :class="[btnClass]"  id="login_button" @click="storeUser.login(data)" >{{login_button}}</button><br/>

              
              
              <router-link to="/signup">Nie posiadasz jeszcze konta? Zarejestruj się!</router-link>
                
              
            </form>

            <span id="info_text">
            Strona ma charakter demonstracyjny i nie służy jako faktyczny chat. Możesz założyć własne konto, aby przetestować działanie formularza albo użyj jednego z kont demonstracyjnych np.:<br>
            john@gmail.com hasło: password<br>
            merry@gmail.com hasło: password</span>
  
      
  </div>
</template>








<script>




export default {
  name: 'LoginPage',
  

  data() {
    return{
      data: {
        
      },
      
      btnClass: String,
      login_button: 'Zaloguj się',
      info: '',
      }
      
  },


 
}

</script>





<style scope>

  
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
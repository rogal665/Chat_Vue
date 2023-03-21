<script setup>
import {useUserStore} from '@/stores/user'

const storeUser = useUserStore();
storeUser.send_data({},"user_info")
</script>


<template>
    <div id="menu_container">
        
        <nav id="menu">
          <div><img :src="logo" ></div>  
          <div v-if="storeUser.my_userid" class="menu_button"><router-link custom v-slot="{ navigate }" to="/"><button class="button" @click="navigate" role="link">Chat</button></router-link> </div>
          <div v-if="storeUser.my_userid" class="menu_button"><router-link custom v-slot="{ navigate }" to="/contacts"><button class="button" @click="navigate" role="link">Kontakty</button></router-link></div> 
          <div v-if="storeUser.my_userid" class="menu_button"><router-link custom v-slot="{ navigate }" to="/settings"><button class="button" @click="navigate" role="link">Ustawienia Konta</button></router-link></div>
          <div v-if="!storeUser.my_userid"  class="menu_button"><router-link custom v-slot="{ navigate }" to="/login"><button class="button" @click="navigate" role="link">Zaloguj się</button></router-link></div>
          <div class="menu_button"><router-link custom v-slot="{ navigate }" to="/author"><button class="button" @click="navigate" role="link">O Autorze</button></router-link></div>
          <div v-if="storeUser.my_userid"><button class="button" @click="storeUser.log_out()" >Wyloguj się</button></div>
                 
        </nav>
      </div>
</template>


<script>
export default {
    
    name: 'AppMenu',
    data: function() {
        return {                           
            logo: require("../ui/icons/logo.png"),       
        }
    
    },

    
    }
</script>



<style scoped>

img {
       display:none
    }

@media (max-width:768px) { 
    img {
        display:inline;
        height: 35px;
        padding: 0px
    }

@media (max-width:400px) { 
   

    #menu{
        display:grid;
        grid-template-columns: auto auto ;
    }


    

    .button{
        
        
    }
    
}
}

</style>
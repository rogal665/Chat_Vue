<script setup>
import {useUserStore} from '@/stores/user'

const storeUser = useUserStore();
</script>



           
          


<template>    
    <div class="user_info">    
      <img v-if="storeUser.my_image" id="profile_image"  :src=storeUser.my_image style="height: 100px;width: 100px;">
      <img v-else id="profile_image"  :src="profile_image" style="height: 100px;width: 100px;">
      <br>
      <span  v-if="storeUser.my_username" style="font-weight: bold; font-size:20px">{{ storeUser.my_username }}</span>
      <span  v-else>Nie jesteś zalogowany</span><br>
      <span> {{ storeUser.my_email }}</span>    
    </div>
  </template>







  
<script >

  
  
  export default {
    
    name: 'UserInfo',
       
    data: function() {
       return {
                         
          profile_image: require('../ui/images/user_male.jpg'),
          

        }

    },

  props:{
    data: {
    
      
    }
  },


  
}
  
  
  
  </script>
  

  <style scoped>
    #profile_image{

      width: 50%;
      border: solid thin rgb(0, 0, 0);
      border-radius: 50%;
      margin-top:20px;
      margin-bottom:50px;

}

    

@media (max-width:1050px) { 
  .user_info{
    font-size: 13px;
  }
}
  </style>
  
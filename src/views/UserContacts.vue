<template >
 <div  style="text-align: center;" class="container" >
  <div :key="item" v-for="item in storeUser.friends_list " id='contact' style='position:relative;'>
    <a @click="storeUser.set_current_chat_user(item.src,item.userid,item.username,); storeChat.start_chat()"  > 
    <img :src=item.src >
    </a>
      <div >{{ item.username }}</div>
      <div v-if="item.msgs" id="msgs" >{{ item.msgs }}</div>     
  </div>  
    
  </div>

    
    

  
</template>

<script setup>

import {useUserStore} from '@/stores/user'
import {useChatStore} from '@/stores/chat'

const storeUser = useUserStore()
const storeChat = useChatStore()


</script>


<script>




export default {
  name: 'UserContacts',
  
  data: function() {
       return {                       
          message: '',            
        data: {},
        }
    },


  methods: {
    start_chat:function(){
      
      this.$router.push('/'); 
      },

  },




  created: function(){
    const storeUser = useUserStore()
    storeUser.send_data({},"contacts_vue")
      
    },

}
</script>


<style>

/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  
  
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: rgb(138, 137, 137);
  border:2px rgb(49, 49, 49) solid;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}


.container{
  padding: 20px;
  padding-top: 30px;  
  margin: auto;
  margin-top: 10px;
  max-width: 500px;
  padding: 20px;
  background-color: rgb(54, 54, 58);
  border-radius: 15px;
}

#contact{

width: 100px;
height: 120px;
margin: 10px;
display: inline-block;
vertical-align: top;
}

#contact img{

width: 100px;
height: 100px;
}

#active_contact{

height: 70px;
margin: 10px;
border: solid thin #aaa;
border-radius: 10px;
padding:2px;
background-color: #eee;
color: #444;
}

#active_contact img{
border-radius: 5px;
border: 2px solid black;
width: 70px;
height: 70px;
float:left;
margin:2px;
}

#msgs {
  width:20px;
  height:20px;
  border-radius:50%;
  background-color:orange;
  color:white;
  position:absolute;
  left:0px;top:0px;
}



  @keyframes appear{

    0%{opacity:0;transform: translateY(50px)}
    100%{opacity:1;transform: translateY(0px)}
  }

  #contact{
    cursor:pointer;
    transition: all .5s cubic-bezier(0.68, -2, 0.265, 1.55);
  }

  #contact:hover{
    transform: scale(1.1);
  }

	


</style>
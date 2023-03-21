<script setup>


import {useUserStore} from '@/stores/user'
import {useChatStore} from '@/stores/chat'

const storeUser = useUserStore();
const storeChat = useChatStore();
           
setInterval(function(){storeChat.refresh();},5000);



</script>


<template>
  <div   class="chat_container"  >
    <div v-if="storeUser.my_username" @click="scroll(500)" @mouseover="hover = true" @mouseleave="hover = false"  class="contacts_chat" >    
      <span v-if="hover===false" class="contacts_text">KONTAKTY</span>
      <span v-else><Contacts /></span> 
    </div> 

    <div  v-if="storeUser.curren_chat_user != 'No user selected'" id="active_contact" >
        <img  :src=storeUser.current_chat_user_image>
        <span >Twój obecny rozmówca to: {{storeUser.current_chat_user_name}}</span> <br>             
    </div>

    <div id="info_text" v-else>
      <div v-if="storeUser.my_username"><h1>Wybierz użytkownika z którym chcesz porozmawiać.</h1></div>
      <div v-else><h1 >Jeśli chcesz przetestować chat, zaloguj się. <br> Jeśli chcesz dowiedzieć się więcej o autorze kliknij "O Autorze" </h1></div>
    </div>

    <div  style=" overflow-y: scroll;  grid-area: chat;">      
      <div   id='messages_holder_parent'   @click='storeChat.set_seen()'>   
        <div  id='messages_holder'  >               
            <div  v-for="item in storeChat.current_chat_view.messages" :number="0"   :key="item.id"  >
                  
              <div  v-if="!item[4]" ></div>
              <div  v-else >
                <div  v-if="item[4]==='right'" id='message_right'>               
                  <RightMessage :item="item" :tick_grey="tick_grey" :tick="tick" :my_image="storeUser.my_image" :my_username="storeUser.my_username" :trash="trash"/>            
                </div>

                <div v-else id='message_left'>        
                   <LeftMessage :item="item" :current_chat_user_image="storeUser.current_chat_user_image" :current_chat_user_name="storeUser.current_chat_user_name" :trash="trash"/>
                </div>
              </div>               
            </div>           
          <div @change="scroll(0)" ref='last_message' id='last_message' ></div>
        </div>
      </div>   
    </div> 
            
    <div  @click="scroll(0)" v-if="storeUser.curren_chat_user != 'No user selected'" class="message_controller" >
        <div  style="text-align: center; font-size: 14px ; padding: 5px; ">
          <label @click="$refs.fileInput.click()" ><img :src=clip style='opacity:0.8;width:30px;margin:5px;cursor:pointer;' ></label>          
          <input type='file' ref="fileInput" id='message_file' name='file' style='display:none'  @change='storeUser.send_image'/><br>
          <span>wyślij plik</span>
        </div>
        <div style="text-align: left; padding: 15px;">
          <input @focus="$event.target.select()"  id='message_text' v-model="message_box" v-on:keyup.enter="storeChat.send_message(message_box);message_box='';scroll();"  type='text' placeHolder='Wpisz swoja wiadomość tutaj'/>
          <input class="button_controller" style=';cursor:pointer;' type='button' value='Wyślij' @click="storeChat.set_seen();storeChat.send_message(message_box);message_box='';scroll();"/>
        </div>    
    </div>       
</div>
  
  
</template>








<script>



import Contacts from '@/views/UserContacts.vue'
import RightMessage from '@/components/RightMessage.vue'
import LeftMessage from '@/components/LeftMessage.vue'

export default {
  name: 'HomeView',
  components: {
        RightMessage,
        LeftMessage    
        },
  
  data() {
    return{
    
    data: {},
    message: '',
    message_box: '',
    selectedFile: null,
    hover: false,
    tick_grey: '/ui/images/tick_grey.png',
    tick: '/ui/images/tick.png',
    trash: '/ui/icons/trash.png',
    clip: '/ui/icons/clip.png',
    
    }
    
  },

 

  methods: {
    scroll: function(time) {
      setTimeout(()=>this.$refs["last_message"].scrollIntoView({ behavior: "smooth" }),time);
  
    }
    },
  
  
    
  
  
  }

   
    
  



</script>


<style>

#message_text{
  font-size:18px;
  padding:7px;
  width: 70%;
  margin-right: 20px;
}

.message_controller{
  background-color: rgb(45, 48, 78);
  border-radius: 15px;
  color: white;
  display:grid;
  grid-template-columns: 80px auto;  
  overflow: none;
  grid-area: controler;
 
}

.chat_container{
  display: grid;
  grid-template-areas: 
  "contacts active"
  "contacts chat"
  "contacts controler";
  gap: 0px;
  grid-template-columns: max-content auto; 
  grid-template-rows: 100px auto 80px; 
  height: calc(100vh - 110px);
  padding: 0px;
  
}

#info_text{
  grid-area: chat;
}

.contacts_text{
  writing-mode: vertical-rl;
  text-orientation: upright;
  margin: 0px;
  margin-top: 300px;
  font-weight: bold;
}

.contacts_chat{
  
  transition-duration: 500ms;
  padding: 0px;
  overflow:hidden; 
  width: 25px;
  background-color: rgb(54, 54, 58);
  border-radius: 25px; 
  grid-area: contacts; 
  margin: 0px; 
  height: calc(100vh - 110px);
}

.contacts_chat:hover{
  transition-duration: 1000ms;
  padding: 0px;
  overflow-y: scroll;
  width: 160px; 
  background-color: rgb(54, 54, 58);
  border-radius: 25px; 
  grid-area: contacts; 
  margin: 0px; 
  height: calc(100vh - 110px);
}

.contacts_chat:hover a span.contacts_text {
  display: none;
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

width: 300px;
margin: 10px;
border: solid thin #aaa;
padding:2px;
background-color: #eee;
color: #444;
height:80px; 
grid-area: active
}

#active_contact img{

width: 70px;
height: 70px;
float:left;
margin:2px;
}

#last_message{

color: white4;
float:left;

border-bottom-left-radius: 50%;
border-top-right-radius: 30%;
width:60%;
min-width: 200px;
}


#message_left{

margin: 10px;
padding:20px;
padding-right:10px;
background-color: rgb(54, 54, 58);
color: white4;
float:left;
border-radius: 25px;
position: relative;
width:60%;
min-width: 200px;
}

#message_left #prof_img{

width: 70px;
height: 70px;
float:left;
margin:2px;
border-radius: 50%;
border: solid 2px white;
}



.message_image{
  max-width: 400px;
  max-height: 300px;
}

#message_right{
min-width: 200px;
 margin: 10px;
 padding:20px;
 padding-right:10px;
 background-color: #eee;
color: #444;
float:right;
border-radius: 25px;
position: relative;
width:60%;
 
 
 
}

#message_right #prof_img{

width: 70px;
height: 70px;
float:left;
margin:2px;
border-radius: 50%;
border: solid 2px white;
}

#message_right div img{

width: 25px;
height: 18px;
float:none;
margin:0px;
border-radius: 50%;
border: none;
position:absolute;
top:30px;
right:10px;
}

#message_right #trash{

width: 20px;
height: 20px;
position:absolute;
top:15px;
left:-10px;
cursor: pointer;
}

#message_left #trash{

width: 20px;
height: 20px;
position:absolute;
top:15px;
right:-10px;
cursor: pointer;
}



#message_right div{

width: 20px;
height: 20px;
background-color: #34474f;
border: solid 2px white;
border-radius: 50%;
position: absolute;
right:-10px;
top:20px;
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
  margin-right: 0px;
  border:none;
  border-radius: 5px;
}

@media (max-width:1050px) { 

  #message_text{
  font-size:14px;
  padding:7px;
  width: 60%;
  margin:5px;
}


.message_image{
  max-width: 200px;
  max-height: 150px;
}

}

.button_controller{
  background-color: #575757;
  font-size: 15px;
  color: rgb(255, 255, 255);
  padding: 7px;
  padding-left: 15px;
  padding-right: 15px;
  margin: 5px;
  border:none;
  border-radius: 5px;
  width: 80px;
  cursor: pointer;
}


@media (max-width:768px) { 
  .contacts_chat{
  display: none;
  }

  .button_controller{
  font-size: 12px;
  text-decoration: solid;
  padding: 2px;
  margin-right: 2px; 
  border:none;
  border-radius: 5px;
  width: 50px;
  margin-top: 15px;
}

#message_text{
  font-size:12px;
  padding:2px;
  width: 70%;
  margin: 2px;
  margin-top: 15px;
}

#active_contact{

display: none;
}

.chat_container{
  display: grid;
  grid-template-areas: 
  "contacts active"
  "contacts chat"
  "contacts controler";
  gap: 0px;
  grid-template-columns: max-content auto; 
  grid-template-rows: 0px auto 80px; 
  height: calc(100vh - 210px);
  padding: 0px;
}

h1{
  max-width: 600px;
}
}


</style>
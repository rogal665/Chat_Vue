import {defineStore} from 'pinia'
import axios from 'axios';
import {useUserStore} from '@/stores/user'





export const useChatStore = 
defineStore({


    id: 'chat',
    state: () =>({
      userid: '',
      data: '',
      message: '',
      seen: false,
      current_chat_view: [],
      
    }),

    actions: {

      
      set_seen:function(){
        const storeUser = useUserStore();
        this.seen = true;
        this.send_data({userid:storeUser.curren_chat_user,seen:this.seen},'chats_refresh_vue')
      },


      send_message: function(message_box){
        var message_text = message_box;         
          if(message_text == undefined){          
          alert("musisz coś napisać");         
        return;
        }
        const storeUser = useUserStore();
        this.send_data({ 
        message:message_text,
        userid :storeUser.curren_chat_user
        },"send_message_vue");
        

      },

      delete_message:function(e){
        if(confirm("Are you sure you want to delete this message??")){
        this.send_data({
        rowid:e
        },"delete_message");       
        }
    },

      

      refresh(){
        if(this.curren_chat_user != 'No user selected'){
          const storeUser = useUserStore();
          this.send_data(storeUser.curren_chat_user,"chats_vue");
          
          
          
        }    
    },

      

      start_chat(){
        
        this.$router.push('/');
        const storeUser = useUserStore();
        this.send_data(storeUser.curren_chat_user,"chats_vue");
      
      },



      send_data(user,type){   
                
        var find = Object();
        var data = Object();
        
        if(type==='send_message_vue'){
          find = user;               
          data.find = find;
          data.data_type = type;              
        }else if(type==='delete_message'){      
            find = user;               
            data.find = find;
            data.data_type = type;   
        }else if(type==='chats_refresh_vue'){              
          data.find = user
          data.data_type = type;
        }else{find.userid = user;               
            data.find = find;
            data.data_type = type;}  

        

        //axios.post('http://localhost:8080/api.php', data)
        axios.post('/api.php', data)
        .then(response => {  
                  
          if (response.data.data_type == "error"){
            this.info = response.data.message;
            }else{
            this.info = "";
            }
                 
            this.current_chat_view = response.data;
                     
        

        });},
     

              
    },
    
    
})
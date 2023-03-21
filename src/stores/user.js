import {defineStore} from 'pinia'
import axios from 'axios';

import {useChatStore} from '@/stores/chat'

export const useUserStore = 
defineStore({


    id: 'user',
    state: () =>({
        my_userid: '',
        my_email: '',
        my_image: '',
        my_username: '',
        my_password: '',
        my_password2: '',
        my_gender: '',  
        curren_chat_user: 'No user selected',
        current_chat_user_name: '',
        current_chat_user_image: '',
        friends_list: [],
        seen: false,
        info:'',
        selectedFile: null,
    }),
    actions: {


      login: function(data){
        this.send_data(data,"login");
        
        
      },

      signup: function(data){
        this.send_data(data,"signup");
        
        
      },
      log_out: function(){
        var answer = confirm("Czy jesteś pewny, że chcesz się wylogować?");
        if(answer){
          this.send_data({},"logout");
          this.$router.push({ path: '/login'})
          this.$reset();
          const storeChat = useChatStore();
          storeChat.$reset();
        }
      },
    
      send_data(user,type){   
                
          var find = Object();
          var data = Object()
          if(type==='login'){              
              data = user
              data.data_type = type;                       
          }else if(type==='signup'){              
            data = user
            data.data_type = type;                       
          }else if(type==='send_message_vue'){
            find = user;               
            data.find = find;
            data.data_type = type;              
          }else if(type==='chats_refresh_vue'){              
            data.find = user
            data.data_type = type;
          }else if(type==='delete_message'){      
            find = user;               
            data.find = find;
            data.data_type = type;   
          }
          else if(type==='save_settings'){ 
            data = user;    
            data.data_type = type;   
          }else{
            find.userid = user;               
            data.find = find;
            data.data_type = type;  
          }
          
          //axios.post('http://localhost:8080/api.php', data)
          axios.post('/api.php', data)
          .then(response => {       
            if (response.data.data_type == "error"){
              this.info = response.data.message;
              }else{
              this.info = "";
              if(type === 'user_info'){          
                this.my_userid = response.data.userid;
                this.my_email = response.data.email;
                this.my_image = response.data.image;
                this.my_username = response.data.username;
                this.my_password = response.data.password;
                this.my_password2 = response.data.password;
                this.my_gender = response.data.gender;
              }else if(type === 'logout'){
                this.$reset()
              }else if(type==='login'){              
                this.$router.push({ path: '/contacts'})      
                this.send_data({},"user_info");                
              }else if(type==='signup'){              
                this.$router.push({ path: '/login'})                         
              }else if(type === 'contacts_vue'){
                  this.friends_list = response.data.message;
              }else if(type==='save_settings'){ 
                location.reload();
                }
                
              }
          });},

          onUpdate:function(){  
            
            const myform = new FormData();    
            myform.append('file', this.selectedFile);
            myform.append('data_type', "change_profile_image");
            axios.post('/uploader.php',myform,{
              onUploadProgress: uploadEvent => {
                console.log('Upload Progress: ' + Math.round(uploadEvent.loaded / uploadEvent.total * 100) + '%')
              }
            })
              .then(res => {
                console.log(res)
                this.send_data({},"user_info")
                   
              })
                   
             
            },
            


          
          set_current_chat_user(current_image,current_user,current_username){
            this.curren_chat_user = current_user;
            this.current_chat_user_name = current_username;
            this.current_chat_user_image = current_image;                                   
            
        },

        send_image:function(event){   
          this.selectedFile = event.target.files[0];   
          if(['image/png','image/jpeg','image/svg'].includes(this.selectedFile['type'])){
            const myform = new FormData();
            myform.append('file', this.selectedFile);
            myform.append('data_type', "send_image");
            myform.append('userid',this.curren_chat_user);
            //axios.post('http://localhost:8080/uploader.php',myform,{
            axios.post('/uploader.php',myform,{
              onUploadProgress: uploadEvent => {
                console.log('Upload Progress: ' + Math.round(uploadEvent.loaded / uploadEvent.total * 100) + '%')
            }})
        }else{
          alert('Wybierz poprawny format(png, jpg lub svg)')
        }           
          return;            
      },

              
    },
    
    
})
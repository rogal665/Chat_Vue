<script setup>
import { RouterView } from 'vue-router'
import {useUserStore} from '@/stores/user'

const storeUser = useUserStore();
storeUser.send_data({},"user_info")
</script>

<template > 
  <div class="wrapper" >  
    <div class="left_pannel" id="left_pannel" >
    <div id="user_info" >
        <UserInfo :data="data"/>
    </div>     
      <AppMenu/>  
    </div >
    <div class="up_pannel" id="up_pannel">       
      <AppMenu />
    </div>
      <AppHeader/>  
    <div  class="right_pannel" id="right_pannel">
    <router-view/>
    </div>
  </div>
  

</template>

<script>
import UserInfo from "./components/UserInfo.vue"
import AppHeader from "./components/AppHeader.vue"
import AppMenu from "./components/AppMenu.vue"
export default {
  name: 'HomeView',
  components: {
    UserInfo,
    AppHeader,
    AppMenu   
  },

  data: function() {
       return {                     
          userid:'',
          logo: require("./ui/icons/logo.png"),      
          data: {    
                 
          },
          
          
        }
      
  },

  

  
  }
</script>

<style scope>

#menu{
  
  background-color: rgb(54, 54, 58);
  margin:20px;
  border-radius: 5px;
  padding: 5px;
  box-shadow: inset 0 0 3px 2px  rgb(45, 48, 78);
  padding-top: 30px;
  padding-bottom: 30px;
}





.button{
  background-color: #575757;
  font-size: 15px;
  color: rgb(255, 255, 255);
  padding: 7px;
  padding-left: 15px;
  padding-right: 15px;
  margin: 5px;
  border:none;
  border-radius: 5px;
  width: 150px;
  cursor: pointer;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #ffffff;
  
  margin: 0 px;
}





.left_pannel {
  background-color: rgb(45, 48, 78);
  grid-area: left;
  border-radius: 25px;
  margin: 5px;
  box-shadow: inset 0 0 3px 2px rgba(19, 18, 18, 0.75);
  padding-top: 30px;
}

#user_info {
  height: 200px;
  margin-bottom: 100px;
}



.wrapper {  
  display: grid;
  grid-template-areas:
  "left header"
  "left content";
  grid-template-columns: 250px 800px;
  grid-template-rows: 100px auto;
  margin: 0px;
  height: 100vh;
  max-height: 100vh;
  justify-content: center;
  
}



#header_text {
  padding-top: 0px;
  min-width: 350px;
}

#content {
  
  margin: 0 px;
  
}

.right_pannel {
  box-shadow: inset 0 0 3px 2px rgba(19, 18, 18, 0.75);
  background-color: #575757;
  grid-area: content;  
  border-radius: 25px;
  margin: 5px;
  
  
}



html {
    height: 100%;
}

html, body {
    height:100%; 
}
body {
    margin: 0; 
}

.up_pannel{
  display:none;
}
@media (max-width:1050px) { 

  .wrapper {  
  display: grid;
  grid-template-areas:
  "left header"
  "left content";
  grid-template-columns: 200px 600px;
  grid-template-rows: 100px auto;
  margin: 0px;
  height: 100vh;
  max-height: 100vh;
  justify-content: center;
  
}







.button{
  background-color: #575757;
  font-size: 15px;
  color: rgb(255, 255, 255);
  text-decoration: solid;
  padding: 7px;
  padding-left: 5px;
  padding-right: 5px;
  border:none;
  border-radius: 5px;
  width: 130px
}

#menu{
  background-color: rgb(54, 54, 58);
  margin:15px;
  border-radius: 5px;
  padding: 0px;
  
}
  
}

@media (max-width:768px) { 

  .wrapper {  
  display: grid;
  grid-template-areas:
  "header header"
  "top top"
  "content content";
  grid-template-columns: auto auto;
  grid-template-rows: 100px 100px auto;
  
  margin: 0px;
  height: 100vh;
  max-height: 100vh;
  max-width: 100%;
  

  }

  .left_pannel {
  display: none;
  }

  .up_pannel {
  
  display:grid;
  text-justify: center;
  background-color: rgb(45, 48, 78);
  grid-area: top;
  border-radius: 25px;
  margin: 5px;
  margin-top: 0px;
  margin-bottom: 0px;
  height: 100px;
  box-shadow: inset 0 0 3px 2px rgba(19, 18, 18, 0.75);
}

.header img{
  display: none;
}

#menu{
  display:grid;
  grid-template-columns: auto auto auto;
  border-radius: 5px;
  
  background-color: rgb(45, 48, 78);
}

.button{
  
  padding: 5px;
  border:none;
  border-radius: 5px;
  width: 130px;
  
}

.header{
  display:flex; 
  margin-top: 0px;
  
}

}

@media (max-width:400px) { 
  .wrapper {  
  display: grid;
  grid-template-areas:
  "header"
  "top"
  "content";
  grid-template-columns: 350px;
  grid-template-rows: 100px 150px auto;
  
  margin: 0px;
  height: 100vh;
  max-height: 100vh;
  max-width: 100%;
}



.up_pannel { 
  display:block;
  text-justify: center;
  background-color: rgb(45, 48, 78);
  grid-area: top;
  border-radius: 25px;
  margin: 5px;
  margin-top: 0px;
  margin-bottom: 0px;
  height: 150px;
  box-shadow: inset 0 0 3px 2px rgba(19, 18, 18, 0.75);
}


}


</style>

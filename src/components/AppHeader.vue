<template>
    <div class="header" id="header">
        <div><img :src="logo" style="height:80px; margin:5px"></div>
        <div id="header_text">Lumos Chat</div>
    </div>
</template>


<script>
export default {
    
    name: 'UserInfo',
data: function() {
    return {                           
       logo: require("../ui/icons/logo.png")      
     }
   
},
}
</script>



<style>

.header {
  display:grid;
  grid-template-columns: 50px auto 50px;
  background-color: rgb(45, 48, 78);
  grid-area: header;
  font-size: 55px;
  font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  font-weight: bold;
  font-style: italic;
  border-radius: 25px;
  margin: 5px;
  border: #fffcfc;
  box-shadow: inset 0 0 3px 2px rgba(19, 18, 18, 0.75);

}

@media (max-width:768px) { 
    .header img{
        display: none;
    }
    .header{
        display:inline; 
        margin-top: 0px;
      
  

}

    

    
}


</style>
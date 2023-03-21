


<template>
     <div><img v-if="item[6]==='received'" :src='tick_grey' /><img v-else-if="item[6]==='seen'" :src='tick' /></div> 
    <img id='prof_img' :src=my_image style='float:right'>
    <b>{{my_username}}</b><br> 
    <img v-if="item[5]" :src="item[5]" class="message_image"><br>           
    <span >{{item[1]}}</span><br>
    <span style='font-size:11px;color:#888;'>{{item[3]}}</span>
    <img id='trash' :src='trash' @click='storeUser.delete_message(item[2])'  />  
</template>


<script>
export default {
    
    name: 'RightMessage',

   


    props: {
        item: {},
        tick_grey: String,
        tick: String,
        my_image: String,
        my_username: String,
        trash: String
    }

    
    }


  
</script>



<style scoped>



</style>
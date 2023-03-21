


<template>
    <img id='prof_img' :src=current_chat_user_image>
        <b>{{current_chat_user_name}}</b><br>  
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
        current_chat_user_image: String,
        current_chat_user_name: String,
        trash: String
    }

    
    }


  
</script>



<style scoped>



</style>
<template>
  <div  id="UserInfo" class="author">
    <img :src=this.foto><br><br><br>
    <div id="info_text_author"><p1>
      <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nazywam się Paweł Rogala. Od dzieciństwa pasjonuję się elektroniką, a od liceum programowaniem. Łącząc te dwie dziedziny wykonałem kilka projektów opartych na mikrokomputerach rapberry pi oraz nano pi. Były to: gogle IR, domowy serwer NAS, moduł Android Auto do samochodu oraz odtwarzacz auto na systemie volumio. W związku z kulinarną pasją mojej narzeczonej, od 8 lat prowadzimy jedną z najpopularniejszych pizzerii w Świdnicy, zatrudniając w sumie 18 osób. Tu również staram się wykorzystywać swoje umiejętności techniczne tworząc np własną aplikację do obliczania foodcostu oraz system zarządzania czasem pracy (oba projekty są obecnie w fazie implementacji)
      </div>
        <br>
      <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Zarządzanie odnoszącą sukcesy firmą w branży gastronomicznej dało mi duże doświadczenie związane z rozwijaniem marki, własnych produktów, zarządzania zespołem, a przede wszystkim - nauczyło solidności i tego, że do sukcesu dochodzi się systematyczną pracą.
      </div>
        <br>
      <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Obecnie zdecydowałem aby przekierować moją karierę na branżę bardziej związaną z moimi zainteresowaniami - szeroko rozumianą branżą informatyczną.
      </div>
        W tym celu rozwijam swoje umiejętności programistyczne w pythonie, javascript i php. Strona na której właśnie się znajdujesz to napisany przeze mnie czat. Frontend napisany został w vue.js, backend w php a baza danych z której serwis korzysta to mysql. Będę wdzięczny jeśli zaprosicie mnie na rozmowę kwalifikacyjną do swojej firmy. Wtedy będę mógł opowiedzieć o sobie więcej.
      <br>
      <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Zapraszam na mojego <a href="https://github.com/rogal665">GITHUBA</a> gdzie znajdziesz kod źródłowy tej strony.
      </div>
        <br>
      <div>Zapraszam do kontaktu:<br>
        telefon: 666894430<br>
      email: pawel.rogala05@gmail.com<br>
      Link do mojego   <a href="cv/CV_Pawel_Rogala_v2.pdf" download>CV</a>
    </div>

    </p1></div>
  
      
  </div>
</template>







<script>









export default {
  name: 'AboutAuthor',
  
  data() {
    return{
      foto: '/uploads/DSC0423sad6.jpg',
    }
  }


  
}




</script>





<style>

  


.author{
  
  padding: 20px;
  padding-top: 70px;  
  margin: auto;
  margin-top: 10px;
  min-width: 350px;
  max-width: 500px;
  min-height: 350px;
  background-color: rgb(54, 54, 58);
  border-radius: 15px;
}

img{
  max-height: 200px;
  border-radius: 15px;
}


#info_text_author{
  font-size: 18px;
  color: rgb(255, 255, 255);
  text-align: left;
}

a{
  color: rgb(91, 91, 218);
}

</style>
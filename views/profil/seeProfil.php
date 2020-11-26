<div class="cover_img"></div>


<div class="container" id="seeProfil">
  <div class="center-align">
    <h1> Nom de l'user </h1>
    <img src="ressources/img/talin.jpg" alt="Photo de profil" class="profile_img circle">
  </div>

  <div class="row">
    <div class="col s5 m5 background-lighter-grey z-depth-1" id="presentation_profile">
      <h2 class="blue-text bold-text center-align"> Présentation </h2>
      <p>Le texte de présentation devra être modifiable.</p>
    </div>

    <div class="col s5 m5 offset-m2 background-lighter-grey z-depth-1 flex-row justify-content-spacearound">
      <div class="information_profile" id="info_border">
        <h2 class="blue-text bold-text"> Technologies </h2>
        <ul>
          <li>Tech 1</li>
          <li>Tech 2</li>
          <li>Tech 3</li>
        </ul>
      </div>
      <div class="information_profile">
        <h2 class="blue-text bold-text"> Hobbies </h2>
        <ul>
          <li>Hobby 1</li>
          <li>Hobby 2</li>
          <li>Hobby 3</li>
        </ul>
      </div>

    </div>
  </div>
  <div class="row">
    <div class="col s10 m10 offset-m1">
      <form class="post_profile p-2 background-lighter-grey z-depth-1" action="seeProfil.php" method="post">
        <textarea class="background-lighter-grey" name="post" placeholder=" Ecrire une publication..."></textarea>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col s10 m10 offset-m1">
      <div class="col s1 m1">
        <img class="circle miniature_img" src="ressources/img/talin.jpg" alt="Photo de profil">
        <p>Nom Prénom</p>
      </div>
      <div class="col s8 m8 offset-m1 z-depth-1 background-lighter-grey">
        Ici apparaîtront les publications de l'utilisateur
      </div>

    </div>

  </div>

</div>

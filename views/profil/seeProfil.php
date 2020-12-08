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
        <form class="form_tech" action="#" method="post">
          <ul>
            <li><input type="text" name="" value=""></input></li>
            <li><input type="text" name="" value=""></input></li>
            <li><input type="text" name="" value=""></input></li>
          </ul>
          <button type="submit" name="button">Submit</button>
        </form>
      </div>
      <div class="information_profile">
        <h2 class="blue-text bold-text"> Hobbies </h2>
        <form class="form_hobbies" action="#" method="post">
          <ul>
            <li><input type="text" name="" value=""></input></li>
            <li><input type="text" name="" value=""></input></li>
            <li><input type="text" name="" value=""></input></li>
          </ul>
          <button type="submit" name="button">Submit</button>
        </form>

      </div>

    </div>
  </div>
  <div class="row">
    <div class="col s10 m10 offset-m1">
      <form class="form_profile p-2 background-lighter-grey z-depth-1" action="addPostForm" method="post">
        <textarea class="background-lighter-grey" name="post" placeholder=" Ecrire une publication..."></textarea>
        <button class="btn-floating waves-effect waves-light" type="submit" name="button"><i class="material-icons">send</i></button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col s10 m10 offset-m1">
        <?php foreach($posts as $post): ?>
          <?php //var_dump($post); ?>
          <div class="col s1 m1">
            <img class="circle miniature_img" src="<?= "ressources/img/". $post['picture_profil'] ?>" alt="Photo de profil">
            <p><?= $post["last_name"] . " " .$post["first_name"] ?></p>
          </div>

          <div class="col s9 m9 offset-m1 z-depth-1 background-lighter-grey m-1">
            <p><?= $post['12'] ?> </p>
            <p id="<?= "posts_" . $post['0'] ?>" class="post post_profile p-1 z-depth-1"> <?= $post["content"] ?> </p>
          </div>
        <?php endforeach; ?>


    </div>

  </div>

</div>

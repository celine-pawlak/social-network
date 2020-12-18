<button id="modif_profil">Go to set your Profil</button>

<div class="cover_img">
  <img src="<?= URL."/ressources/img/". $infosUser[0]['picture_cover'] ?>" alt="Photo de couverture" id="cover_picture">
</div>

<div class="container" id="seeProfil">
  <div class="center-align">
    <h1> <?php echo $infosUser[0]['first_name'] . " " . $infosUser[0]['last_name']; ?> </h1>
    <img src="<?= URL."/ressources/img/". $infosUser[0]['picture_profil'] ?>" alt="Photo de profil" class="profile_img circle">
  </div>

<div class="row center-align">
  <a id="scale-infos" href="#!" class="btn btn-large">
   Mes informations
  </a>
</div>

  <div class="row scale-transition scale-out display-none" id="infos-toggle">
    <div class="col s5 m5 background-lighter-grey z-depth-1" id="presentation_profile">
      <h2 class="blue-text bold-text center-align"> Présentation </h2>

      <form id="form_presentation" method="post">
        <textarea id="update_presentation" rows="8" cols="80" name="presentation"><?= $presentation['presentation'] ?></textarea>
        <button type="submit" name="button">Submit</button>
      </form>
    </div>

    <div class="col s5 m5 offset-m2 background-lighter-grey z-depth-1 flex-row justify-content-spacearound">
      <div class="information_profile" id="info_border">
        <h2 class="blue-text bold-text"> Technologies </h2>
        <form class="form_tech" id="form_tech" method="post">
          <ul>
            <li><input type="text" name="tech1" value="<?= $technologies["tech1"] ?>"></input></li>
            <li><input type="text" name="tech2" value="<?= $technologies["tech2"] ?>"></input></li>
            <li><input type="text" name="tech3" value="<?= $technologies["tech3"] ?>"></input></li>
          </ul>
          <button type="submit" name="button">Submit</button>
        </form>
      </div>

      <div class="information_profile">
        <h2 class="blue-text bold-text"> Hobbies </h2>
        <form class="form_hobbies" id="form_hobbies" method="post">
          <ul>
            <li><input type="text" name="hobby1" value="<?= $hobbies["hobby1"] ?>"></input></li>
            <li><input type="text" name="hobby2" value="<?= $hobbies["hobby2"] ?>"></input></li>
            <li><input type="text" name="hobby3" value="<?= $hobbies["hobby3"] ?>"></input></li>
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
            <img class="circle miniature_img" src="<?= URL . "ressources/img/". $post['picture_profil'] ?>" alt="Photo de profil">
            <p class="bold-text"><?= $post["first_name"] . " " .$post["last_name"] ?></p>
          </div>

          <div class="col s9 m9 offset-m1 z-depth-1 background-lighter-grey m-1">
            <p><?= $post['13'] ?> </p>
            <div class="post post_profile p-1 z-depth-1">
              <p class="right-align">
                <i id="fa-heart" class="fas fa-heart"></i>
                <i id="fa-thumbs-up" class="fas fa-thumbs-up"></i>
                <i id="fa-laugh-squint" class="fas fa-laugh-squint"></i>
                <i id="fa-sign-language" class="fas fa-sign-language"></i>
              </p>
              <p id="<?= "posts_" . $post['0'] ?>" class="">
                <?= $post["content"] ?>

                <?php foreach($reacts as $react):
                  echo "<br> Ici se trouve l'id de la réaction: " . $react['posts_id'];
                  //var_dump($react);
                  endforeach;
                  ?>
              </p>

            </div>

            <?php foreach($commentaires["post_".$post['0']] as $commentaire): ?>
              <div class="post comment_profile p-1 z-depth-1">
                <img class="circle miniature_img" src="<?= URL.'/ressources/img/'. $commentaire['picture'] ?>">
                <p class="bold-text"><?= $commentaire["first_name"] . " " . $commentaire["last_name"] ?></p>
                <p><?= $commentaire["comment"] ?></p>
                <p class="grey-text right-align"><?= $commentaire["date"] ?></p>
              </div>
            <?php endforeach; ?>


              <p>
                <form class = "form_commentaire" method="post">
                  <input type="hidden" name="id_user" value="<?= $id_user ?>">
                  <input type="hidden" name="id_post" value="<?= $post['0'] ?>">
                  <input type="text" name="content" value="">
                  <input type="submit" name="" value="Commenter">
                </form>
              </p>


          </div>
        <?php endforeach; ?>


    </div>

  </div>

</div>

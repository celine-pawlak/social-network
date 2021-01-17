<div class="cover_img">
  <img src="<?= URL."/ressources/img/". $infosUser[0]['picture_cover'] ?>" alt="Photo de couverture" id="cover_picture">
</div>

<div class="container" id="seeProfil">
  <div class="center-align">
    <h1> <?php echo $infosUser[0]['first_name'] . " " . $infosUser[0]['last_name']; ?> </h1>
    <p> <?php echo $age?> ans </p>
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

      <form id="form_presentation" class="right-align" method="post">
        <textarea id="update_presentation" rows="8" cols="80" name="presentation"><?= $presentation['presentation'] ?></textarea>
        <button type="submit" class="btn-floating" name="button"><i class="material-icons right">send</i></button>
      </form>
    </div>

    <div class="col s5 m5 offset-m2 background-lighter-grey z-depth-1 flex-row justify-content-spacearound">
      <div class="information_profile" id="info_border">
        <h2 class="blue-text bold-text"> Technologies </h2>
        <form class="form_tech center-align" id="form_tech" method="post">
          <ul>
            <li><input type="text" name="tech1" value="<?= $technologies["tech1"] ?>"></input></li>
            <li><input type="text" name="tech2" value="<?= $technologies["tech2"] ?>"></input></li>
            <li><input type="text" name="tech3" value="<?= $technologies["tech3"] ?>"></input></li>
          </ul>
          <button type="submit" class="btn-floating" name="button"><i class="material-icons right">send</i></button>
        </form>
      </div>

      <div class="information_profile">
        <h2 class="blue-text bold-text"> Hobbies </h2>
        <form class="form_hobbies center-align" id="form_hobbies" method="post">
          <ul>
            <li><input type="text" name="hobby1" value="<?= $hobbies["hobby1"] ?>"></input></li>
            <li><input type="text" name="hobby2" value="<?= $hobbies["hobby2"] ?>"></input></li>
            <li><input type="text" name="hobby3" value="<?= $hobbies["hobby3"] ?>"></input></li>
          </ul>
          <button type="submit" class="btn-floating" name="button"><i class="material-icons right">send</i></button>
        </form>

      </div>

    </div>
  </div>
  <div class="row">
    <div class="col s10 m10 offset-m1">
      <form class="form_profile p-2 background-lighter-grey z-depth-1" action="addPostForm" method="POST">
        <textarea class="background-lighter-grey" id="post_profil" name="post_profil" placeholder=" Ecrire une publication..."></textarea>
        <button class="btn-floating waves-effect waves-light" type="submit" id="add_post_profil"><i class="material-icons">send</i></button>
      </form>
    </div>
  </div>

  <div class="row">
    <h2 class="h2_posts bold-text center-align">Les dernières publications</h2>
    <div class="col s10 m10 offset-m1">
        <?php foreach($posts as $post): ?>
          <?php //var_dump($post); ?>
          <div class="col s1 m1">
            <img class="circle miniature_img" src="<?= URL . "ressources/img/". $post['picture_profil'] ?>" alt="Photo de profil">
            <p class="bold-text"><?= $post["first_name"] . " " .$post["last_name"] ?></p>
          </div>

          <div class="flex-column relative background-lighter-grey border-radius-25px all_posts mx-auto content-fit-height box-shadow my-1">
            <p class="ml-1 mt-05 mb-1 grey-text font-smile-small"><?= $post['13'] ?> </p>
            <div class="post post_profile border-radius-10px box-shadow background-blue-grey black-text mx-1 p-1">
              <p class="right-align">
                <i id="fa-heart" class="fas fa-heart"></i>
                <i id="fa-thumbs-up" class="fas fa-thumbs-up"></i>
                <i id="fa-laugh-squint" class="fas fa-laugh-squint"></i>
                <i id="fa-sign-language" class="fas fa-sign-language"></i>
              </p>
              <p id="<?= "posts_" . $post['0'] ?>" class="post_content m-0 font-normal">
                <?= $post["content"] ?>

                <?php foreach($reacts as $react):
                  echo "<br> Ici se trouve l'id de la réaction: " . $react['posts_id'];
                  //var_dump($react);
                  endforeach;
                  ?>
              </p>

            </div>

            <?php if(!empty($commentaires["post_".$post['0']])): ?>
              <div class="messages_show_or_hide">
                        <p class="clickable grey-text mb-1 font-smile-small text-right mx-1 mt-0 show-comments" id="see_comments_from_post_<?= $post['0'] ?>">Voir
                            les commentaires (<?= count($commentaires["post_" . $post['0']]) ?>) <i class="fas fa-chevron-down"></i></p>
                        <p class="clickable grey-text mb-1 font-smile-small text-right mx-1 mt-0 hide-comments" id="hide_comments_from_post_<?= $post['0'] ?>">Cacher
                            les commentaires <i class="fas fa-chevron-up"></i></p>

                    </div>

            <div id="commentaires_post_<?= $post['0'] ?>" class="mb-1 px-05 self-align-flexend w-90 commentaires_posts">
            <?php foreach($commentaires["post_".$post['0']] as $commentaire): ?>
              <div class="post comment_profile border-radius-10px box-shadow background-white black-text m-1 p-05 flex-row  ml-1">
                <img class="circle miniature_img" src="<?= URL.'/ressources/img/'. $commentaire['picture'] ?>">  
                <div class="flex-1 flex-column">
                  <div class="flex-row justify-content-spacebetween">
                    <p class="bold-text font-smile-small pl-05 m-0"><?= $commentaire["first_name"] . " " . $commentaire["last_name"] ?></p>
                    <p class="grey-text right-align font-smile-small m-0"><?= $commentaire["date"] ?></p>
                  </div>
                  <p class="pl-05 m-0 content-fit-height word-break-all"><?= $commentaire["comment"] ?></p>
                </div> 
              </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

          <form class="form_comment center-align px-1 flex-row self-align-flexend w-90" method="post">
                    <div class="flex-1">
                        <input type="hidden" name="id_user" value="<?= $id_user ?>">
                        <input type="hidden" name="id_post" value="<?= $post['0'] ?>">
                        <textarea id="comment_post_<?= $post['0'] ?>" class="py-05 w-90 no-border mx-1 no-resize"
                                  type="text" name="content" placeholder="Commenter..."
                                  onkeyup="textAreaAdjust(this)"></textarea>
                    </div>
                    <button type="submit" class="btn btn-small btn-floating waves-effect waves-light">
                        <input type="hidden" name="" value="Commenter">
                        <i class="material-icons btn" id="add_post">send</i>
                    </button>
                </form>
          </div>
        <?php endforeach; ?>


    </div>

  </div>

</div>

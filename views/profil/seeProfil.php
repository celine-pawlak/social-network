<div class="cover_img">
  <img src="<?= URL. "ressources/img/". $infosUser[0]['picture_cover'] ?>" alt="Photo de couverture" id="cover_picture">
</div>

<div class="container" id="seeProfil">
  <div class="center-align">
    <h1> <?php echo $infosUser[0]['first_name'] . " " . $infosUser[0]['last_name']; ?> </h1>
    <p> <?php echo $age?> ans </p>
    <img src="<?= URL."ressources/img/". $infosUser[0]['picture_profil'] ?>" alt="Photo de profil" class="profile_img circle">
  </div>

<div class="row center-align">
  <a id="scale-infos" href="#!" class="btn btn-large">
   Plus d'informations
  </a>
</div>

  <div class="row scale-transition scale-out display-none" id="infos-toggle">
    <div class="col s5 m5 background-lighter-grey z-depth-1 tab_profil_radius" id="presentation_profile">
      <h2 class="blue-text bold-text center-align"> Présentation </h2>
      <p>
        <?= $presentation['presentation'] ?>
      </p>
    </div>

    <div class="col s5 m5 offset-m2 background-lighter-grey z-depth-1 flex-row justify-content-spacearound tab_profil_radius my-1">
      <div class="information_profile" id="info_border">
        <h2 class="blue-text bold-text"> Technologies </h2>
          <ul>
            <li><?= $technologies["tech1"] ?></li>
            <li><?= $technologies["tech2"] ?></li>
            <li><?= $technologies["tech3"] ?></li>
          </ul>
      </div>

      <div class="information_profile">
        <h2 class="blue-text bold-text"> Hobbies </h2>
          <ul>
            <li><?= $hobbies["hobby1"] ?></li>
            <li><?= $hobbies["hobby2"] ?></li>
            <li><?= $hobbies["hobby3"] ?></li>
          </ul>
      </div>
    </div>
  </div>

  <div class="row">
    <h2 class="h2_posts bold-text center-align">Les dernières publications</h2>
    <div class="col s10 m10 offset-m1">
        <?php foreach($posts as $post): ?>

          <div class="flex-column relative background-lighter-grey border-radius-25px all_posts mx-auto content-fit-height box-shadow my-1">
            <div class="flex-column align-items-center justify-content-center absolute author_of_post">
                <a href="profil&id=<?php echo $post['users_id'] ?>"><img class="circle author_image"
                                                                          src="<?= URL . "ressources/img/" . $post['picture_profil'] ?>"
                                                                          alt="Photo de profil"></a>
                <a href="profil&id=<?php echo $post['users_id'] ?>"><p
                            class="m-0 text-center bold-text font-smile-small"><?= $post["first_name"] . " " . $post["last_name"] ?></p>
                </a>
            </div>

            <div class="p-05 content-fit-height mb-1 flex-column">
              <p class="ml-1 mt-05 mb-1 grey-text font-smile-small"><?= $post['13'] ?> </p>
              <div class="post post_profile border-radius-10px box-shadow background-blue-grey black-text mx-1 p-1">
                <p class="right-align">
                  <i id="fa-heart" class="fas fa-heart"></i>
                  <i id="fa-thumbs-up" class="fas fa-thumbs-up"></i>
                  <i id="fa-laugh-squint" class="fas fa-laugh-squint"></i>
                  <i id="fa-sign-language" class="fas fa-sign-language"></i>
                </p>
                <p id="<?= "posts_" . $post['0'] ?>" class="post_content">
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

              <div id="<?= 'commentaires_post_'.$post['0'] ?>" class="mb-1 px-05 self-align-flexend w-90 commentaires_posts">
              <?php foreach($commentaires["post_".$post['0']] as $commentaire): ?>
                <div class="post comment_profile border-radius-10px box-shadow background-white black-text m-1 p-05 flex-row  ml-1">
                  <img class="circle miniature_img" src="<?= URL.'ressources/img/'. $commentaire['picture'] ?>">
                  <div class="flex-1 flex-column">
                    <div class="flex-row justify-content-spacebetween">
                      <p class="bold-text ml-05"><?= $commentaire["first_name"] . " " . $commentaire["last_name"] ?></p>
                      <p class="grey-text right-align"><?= $commentaire["date"] ?></p>
                    </div>
                    <p class="pl-05 m-0 content-fit-height word-break-all"><?= $commentaire["comment"] ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
              </div>

              <?php endif; ?>

              <form class ="form_comment center-align px-1 flex-row self-align-flexend w-90" method="post">
                <input type="hidden" name="id_user" value="<?= $id_user ?>">
                <input type="hidden" name="id_post" value="<?= $post['0'] ?>">
                <input type="text" name="content" value="">
                <input type="submit" class="btn" name="" value="Commenter">
              </form>
            </div>
          </div>  
        <?php endforeach; ?>
    </div>

  </div>

</div>

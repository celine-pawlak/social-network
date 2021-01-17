<div class="cover_img">
    <img src="<?= URL . "/ressources/img/" . $userInformations['picture_cover'] ?>" alt="Photo de couverture"
         id="cover_picture">
</div>

<div class="container" id="seeProfil">
    <div class="center-align">
        <h1> <?php echo $userInformations['first_name'] . " " . $userInformations['last_name']; ?> </h1>
        <p> <?php echo $age ?> ans </p>
        <img src="<?= URL . "/ressources/img/" . $userInformations['picture_profil'] ?>" alt="Photo de profil"
             class="profile_img circle">
    </div>

    <div class="row center-align">
        <a id="scale-infos" href="#!" class="btn btn-large">
            Mes informations
        </a>
    </div>

    <div class="row scale-transition scale-out display-none" id="infos-toggle">
    <div class="col s5 m5 background-lighter-grey z-depth-1 tab_profil_radius my-1" id="presentation_profile">
      <h2 class="blue-text bold-text center-align"> Présentation </h2>

            <form id="form_presentation" class="right-align" method="post">
                <textarea id="update_presentation" rows="8" cols="80"
                          name="presentation"><?= $presentation['presentation'] ?></textarea>
                <button type="submit" class="btn-floating" name="button"><i class="material-icons right hover_yellow">send</i>
                </button>
            </form>
        </div>

<div class="col s5 m5 offset-m2 background-lighter-grey z-depth-1 flex-row justify-content-spacearound tab_profil_radius my-1">
      <div class="information_profile" id="info_border">
        <h2 class="blue-text bold-text"> Technologies </h2>
        <form class="form_tech center-align" id="form_tech" method="post">
          <ul>
            <li><input type="text" name="tech1" value="<?= $technologies["tech1"] ?>"></input></li>
            <li><input type="text" name="tech2" value="<?= $technologies["tech2"] ?>"></input></li>
            <li><input type="text" name="tech3" value="<?= $technologies["tech3"] ?>"></input></li>
          </ul>
          <button type="submit" class="btn-floating" name="button"><i class="material-icons right hover_yellow">send</i></button>
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
          <button type="submit" class="btn-floating" name="button"><i class="material-icons right hover_yellow">send</i></button>
        </form>

      </div>

    </div>
  </div>
  <div class="row">
    <div class="col s10 m10 offset-m1">
      <form class="form_profile pl-2 pr-1 py-1 background-lighter-grey z-depth-1 border-radius-25px flex-row all_posts" action="addPostForm" method="POST">
        <textarea class="h-100 flex-1 background-lighter-grey no-border blue-text no-resize" id="post_profil" name="post_profil" placeholder=" Ecrire une publication..."></textarea>
        <button class="btn-floating waves-effect waves-light" type="submit" id="add_post_profil"><i class="material-icons hover_yellow">send</i></button>
      </form>
    </div>
  </div>

  <div class="row">
    <h2 class="h2_posts bold-text center-align">Mes dernières publications</h2>
    <div class="col s10 m10 offset-m1">
        <?php foreach($posts as $post): ?>
          <?php //var_dump($post); ?>

        <div class="flex-column relative background-lighter-grey border-radius-25px all_posts mx-auto content-fit-height box-shadow my-1">
          <div class="flex-column align-items-center justify-content-center absolute author_of_post">
              <a href="profil&id=<?php echo $post['users_id'] ?>"><img class="circle author_image"
                                                                        src="<?= URL . "ressources/img/" . $post['picture_profil'] ?>"
                                                                        alt="Photo de profil"></a>
              <a href="profil&id=<?php echo $post['users_id'] ?>"><p
                          class="m-0 text-center bold-text font-smile-small"><?= $post["first_name"] . " " . $post["last_name"] ?></p>
              </a>
          </div>

                    <!-- post content -->
                    <div class="p-05 content-fit-height mb-1 flex-column">
                        <p class="ml-1 mt-05 mb-1 grey-text font-smile-small"><?= $post['creation_date'] ?></p>
                        <div class="hover-parent relative post post_profile border-radius-10px box-shadow background-blue-grey black-text mx-1 p-1"
                             id="posts_<?= $post[0] ?>">
                            <!-- <p class="right-align">
                              <i id="fa-heart" class="fas fa-heart"></i>
                              <i id="fa-thumbs-up" class="fas fa-thumbs-up"></i>
                              <i id="fa-laugh-squint" class="fas fa-laugh-squint"></i>
                              <i id="fa-sign-language" class="fas fa-sign-language"></i>
                            </p> -->

                            <!-- Ajouter une réaction -->
                            <div class="hover-child absolute position-right-up mr-05">
                                <div class="m-0 box-shadow background-white grey-text p-025 border-radius-30 no-border clickable relative hover-parent">
                                    <i class="fas fa-smile"></i><span>+</span>
                                    <div class="absolute position-top hover-child m-0 position-left-outside pr-05">
                                        <section
                                                class="reactions background-white border-radius-10 grid column-2 p-025 box-shadow z-index-3">
                                            <?php foreach ($smileys as $smiley): ?>
                                                <button class="clickable background-white no-border hover-blue-grey border-radius-50px m-02"
                                                        name="add_reaction_post"
                                                        value="<?= $post[0] ?>.<?= $smiley['id'] ?>">
                                                    <i class="<?= $smiley['emoji'] ?>"></i>
                                                </button>
                                            <?php endforeach; ?>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <!-- Voir les réactions -->
                            <div class="reactions absolute position-right-down mr-05">
                                <?php if (!empty($post['reactions'])): ?>
                                    <?php foreach ($post['reactions'] as $reaction): ?>
                                        <?php if (isset($emojis_count) && array_key_exists($reaction['emoji'], $emojis_count)) {
                                            $emojis_count[$reaction['emoji']]['count']++;
                                            $emojis_count[$reaction['emoji']]['phrase'][] = $reaction['first_name'] . ' ' . $reaction['last_name'] . ' ' . $reaction['type'];
                                            $emojis_count[$reaction['emoji']]['id'] = $reaction['id'];
                                        } else {
                                            $emojis_count[$reaction['emoji']]['count'] = 1;
                                            $emojis_count[$reaction['emoji']]['phrase'][] = $reaction['first_name'] . ' ' . $reaction['last_name'] . ' ' . $reaction['type'];
                                            $emojis_count[$reaction['emoji']]['id'] = $reaction['id'];
                                        } ?>
                                    <?php endforeach; ?>
                                    <?php foreach ($emojis_count as $emoji_key => $emoji): ?>
                                        <button class="box-shadow background-yellow p-025 border-radius-30 no-border clickable relative m-01 hover-parent"
                                                name="add_reaction_post"
                                                value="<?= $post[0] ?>.<?= $emoji['id'] ?>">
                                            <div class="absolute position-top-outside hover-child m-0 position-right">
                                                <p class="w-max-content font-smile-small background-white likes_right">
                                                    <?php foreach ($emoji['phrase'] as $phrase): ?>
                                                        <span><?= $phrase ?></span><br>
                                                    <?php endforeach; ?>
                                                </p>
                                            </div>
                                            <i class="<?= $emoji_key ?>"></i> <?= $emoji['count'] ?>
                                        </button>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <p class="post_content m-0 font-normal">
                                <?= $post["content"] ?>
                            </p>
                        </div>

                        <?php if (!empty($commentaires["post_" . $post['0']])): ?>
                            <div class="messages_show_or_hide">
                                <p class="clickable grey-text m-1 font-smile-small text-right show-comments"
                                   id="see_comments_from_post_<?= $post['0'] ?>">Voir
                                    les commentaires (<?= count($commentaires["post_" . $post['0']]) ?>) <i
                                            class="fas fa-chevron-down"></i></p>
                                <p class="clickable grey-text m-1 font-smile-small text-right hide-comments"
                                   id="hide_comments_from_post_<?= $post['0'] ?>">Cacher
                                    les commentaires <i class="fas fa-chevron-up"></i></p>
                            </div>
                            <div class="mb-1 px-05 self-align-flexend w-90 commentaires_posts"
                                 id="commentaires_post_<?= $post['0'] ?>">
                                <?php foreach ($commentaires["post_" . $post['0']] as $commentaire): ?>
                                    <div class="post comment_profile border-radius-10px box-shadow background-white black-text m-1 p-05 flex-row  ml-1">
                                        <img class="circle miniature_img self-align-center"
                                             src="<?= URL . '/ressources/img/' . $commentaire['picture'] ?>">
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
                        <?php else: ?>
                            <p class="grey-text m-1 font-smile-small text-right">Aucun commentaire</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php $emojis_count = []; ?>
            <?php endforeach; ?>
        </div>

    </div>

</div>

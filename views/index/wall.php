<div class="row">
    <h2 class="h2_posts bold-text center-align">Fil d'actualités</h2>
    <div class="">
        <form class="form_profile pl-2 pr-1 py-1 background-lighter-grey z-depth-1 border-radius-25px flex-row all_posts"
              action="addPostFormWall" method="post">
            <textarea class="h-100 flex-1 background-lighter-grey no-border blue-text" name="post"
                      placeholder="Ecrire une publication..."></textarea>
            <button class="my-auto btn-floating waves-effect waves-light" type="submit" name="button"><i
                        class="material-icons" id="add_post">send</i></button>
        </form>
    </div>
</div>

<div class="flex-column">
    <h2 class="h2_posts bold-text text-center">Les dernières publications</h2>

    <div class="flex-column">
        <?php foreach ($posts as $post): ?>
            <div class="flex-column relative background-lighter-grey border-radius-25px all_posts mx-auto content-fit-height box-shadow my-1">
                <!-- Author of post -->
                <div class="flex-column align-items-center justify-content-center absolute author_of_post">
                    <a href="profil&id=<?php echo $post['users_id'] ?>"><img class="circle author_image"
                                                                             src="<?= URL . "ressources/img/" . $post['picture_profil'] ?>"
                                                                             alt="Photo de profil"></a>
                    <a href="profil&id=<?php echo $post['users_id'] ?>"><p
                                class="m-0 text-center bold-text font-smile-small"><?= $post["first_name"] . " " . $post["last_name"] ?></p>
                    </a>
                </div>

                <!-- post content -->
                <div class="p-05 content-fit-height mb-1">
                    <p class="ml-1 mt-05 mb-1 grey-text font-smile-small"><?= $post['date_post'] ?> </p>
                    <div class="post post_profile border-radius-10px box-shadow background-blue-grey black-text mx-1 p-1">
                        <!-- <p class="right-align">
                          <i id="fa-heart" class="fas fa-heart"></i>
                          <i id="fa-thumbs-up" class="fas fa-thumbs-up"></i>
                          <i id="fa-laugh-squint" class="fas fa-laugh-squint"></i>
                          <i id="fa-sign-language" class="fas fa-sign-language"></i>
                        </p> -->
                        <p class="post_content m-0 font-normal">
                            <?= $post["content"] ?>
                        </p>
                    </div>
                </div>

                <!-- REACTIONS A FAIRE -->

                <!--            <div id="posts_--><? //= $post['id'] ?><!--" class="d-row">-->
                <!--                <button class="react">test</button>-->
                <!--                <div id="reaction_post_--><? //= $post['id'] ?><!--">-->
                <!--                    --><?php //foreach ($reacts as $react):
                //                        if ($react['posts_id'] == $post['id']) {
                //                            ?>
                <!--                            <i class="--><? //= $react['emoji']; ?><!--"></i>-->
                <!--                            --><?php
                //                        }
                //                    endforeach; ?>
                <!--                </div>-->
                <!--            </div>-->
                <?php if (!empty($commentaires["post_" . $post['0']])): ?>
                    <div class="px-05 self-align-flexend w-90" id="commentaires_post_<?= $post['0'] ?>">
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
                <?php endif; ?>

                <form class="form_comment_wall center-align" method="post">
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">
                    <input type="hidden" name="id_post" value="<?= $post['0'] ?>">
                    <input type="text" name="content" value="">
                    <input type="submit" class="btn" name="" value="Commenter">
                </form>

            </div>
        <?php endforeach; ?>

    </div>
</div>

<div class="row">
  <h2 class="h2_posts bold-text center-align">Fil d'actualités</h2>
  <div class="col s8 m8 offset-m2">
    <form class="form_profile p-2 background-lighter-grey z-depth-1" action="addPostFormWall" method="post">
      <textarea class="background-lighter-grey" name="post" placeholder=" Ecrire une publication..."></textarea>
      <button class="btn-floating waves-effect waves-light" type="submit" name="button"><i class="material-icons">send</i></button>
    </form>
  </div>
</div>

<div class="row">
  <h2 class="h2_posts bold-text center-align">Les dernières publications</h2>
  <div class="col s10 m10 offset-m1">
    <?php //var_dump($posts); ?>
      <?php foreach($posts as $post): ?>
        <?php //var_dump($post['id']); ?>
        <div class="col s1 m1">
          <img class="circle miniature_img" src="<?= URL . "ressources/img/". $post['picture_profil'] ?>" alt="Photo de profil">
          <p class="bold-text"><?= $post["first_name"] . " " .$post["last_name"] ?></p>
        </div>
        
        <div class="col s9 m9 offset-m1 z-depth-1 background-lighter-grey m-1">
          <p><?= $post['date_post'] ?> </p>          
          <div class="post post_profile p-1 z-depth-1">
            <!-- <p class="right-align">
              <i id="fa-heart" class="fas fa-heart"></i>
              <i id="fa-thumbs-up" class="fas fa-thumbs-up"></i>
              <i id="fa-laugh-squint" class="fas fa-laugh-squint"></i>
              <i id="fa-sign-language" class="fas fa-sign-language"></i>
            </p> -->
            <p class="post_content">
              <?= $post["content"] ?>

              <?php foreach($reacts as $react):                
                // var_dump($react);
                endforeach;
                ?>
            </p>

          </div>
          <div id="posts_<?= $post['id']?>" class="d-row">
            <button class="react">test</button>
            <div id="reaction_post_<?= $post['id']?>"></div>            
          </div>
          <?php if(!empty($commentaires["post_".$post['0']])): ?>

          <div id="commentaires_post_<?= $post['0'] ?>">
          <?php foreach($commentaires["post_".$post['0']] as $commentaire): ?>
            <div class="post comment_profile p-1 z-depth-1">
              <div class="flex-row">
                <img class="circle miniature_img" src="<?= URL.'/ressources/img/'. $commentaire['picture'] ?>">
                <p class="bold-text ml-05"><?= $commentaire["first_name"] . " " . $commentaire["last_name"] ?></p>
              </div>

              <p><?= $commentaire["comment"] ?></p>
              <p class="grey-text right-align"><?= $commentaire["date"] ?></p>
            </div>
          <?php endforeach; ?>
        </div>

      <?php endif; ?>

          <form class = "form_comment_wall center-align" method="post">
            <input type="hidden" name="id_user" value="<?= $id_user ?>">
            <input type="hidden" name="id_post" value="<?= $post['0'] ?>">
            <input type="text" name="content" value="">
            <input type="submit" class="btn" name="" value="Commenter">
          </form>
        </div>
      <?php endforeach; ?>
    </div>
</div>

<?php
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
?>
<div id="info_perso" class="row container">
    <h1 id="titre_setprofil" class="text-center">Informations Personnelles</h1>
    <form action="" method="POST" enctype="multipart/form-data" id="form_setprofil" class="col l12 s12 card formulaire">
        <div id="" class="row" id="avatar_last_first_name">
            <div class="file-field input-field col s12 m8 l6 offset-l3 offset-m2 img_profil">
                <img src="ressources/img/<?php echo $infos_user['picture_profil']; ?>" alt="Photo de profil" id="image_avatar">
                <div id="change_file" class="btn">
                    <span>Changer</span>
                    <input type="file" id="update_avatar" name="avatar" accept="image/png, image/jpeg" value="" style='color:lightgrey'>
                </div>
                <div class="file-path-wrapper">
                    <input id="fichier" class="file-path validate" type="text">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="input-field col l3 m5 s12 offset-l3 offset-m1">
                    <input type="text" id="first_name" value="<?php echo $infos_user['first_name']; ?>">
                    <label for="first_name">Prénom</label>
                </div>
                <div class="input-field col l3 s12 m5">
                    <input type="text" id="last_name" value="<?php echo $infos_user['last_name']; ?>">
                    <label for="last_name">Nom</label>
                </div>
            </div>
        <div>
            <div class="input-field col l6 m8 s12 offset-l3 offset-m2">
                <input type="text" id="mail" value="<?php echo $infos_user['mail']; ?>">
                <label for="mail">Email</label>
            </div>
            <div class="input-field col l6 m8 s12 offset-l3 offset-m2">
                <input type="password" id="current_password" autocomplete>
                <label for="current_password">Mot de Passe Actuel</label>
            </div>
            <div class="row">
                <div class="input-field col l5 m6 s12 offset-l1">
                    <input type="password" id="new_password" autocomplete>
                    <label for="new_password">Nouveau Mot de passe</label>
                </div>
                <div class="input-field col l5 m6 s12">
                    <input type="password" id="conf_new_password" autocomplete>
                    <label for="conf_new_password">Confirmation du Nouveau Mot de passe</label>
                </div>
            </div>
        </div>
        <div id="recommandation" class="align-items-center">Pour valider les modifications rentrez votre mot de passe actuel et cliquez ci-dessous</div>
        <div>
            <button id="submit_modif" class="btn waves-effect waves-light col s6 offset-s3 bouton" type="submit">Modifier
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>
<?php
    } else {
        header('location:index.php');
    }
?>
<?php
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
?>
<div id="info_perso" class="row container">
    <h3>Informations Personnelles</h3>
    <form method="POST" enctype="multipart/form-data" id="form_setprofil" class="col l12 s12 card formulaire">
        <div id="align_down" class="row" id="avatar_last_first_name">
            <div class="file-field input-field col s3 img_profil">
                <img src="ressources/img/<?php echo $infos_user['picture_profil']; ?>" alt="Photo de profil" id="image_avatar">
                <div id="change_file" class="btn">
                    <span>Changer</span>
                    <input type="file" id="update_avatar" name="avatar" accept="image/png, image/jpeg" value="" style='color:lightgrey'>
                </div>
                <div class="file-path-wrapper">
                    <input id="fichier" class="file-path validate" type="text">
                </div>
            </div>
            <div class="input-field col s3">
                <input type="text" id="first_name" value="<?php echo $infos_user['first_name']; ?>">
                <label for="first_name">Prénom</label>
            </div>
            <div class="input-field col s3">
                <input type="text" id="last_name" value="<?php echo $infos_user['last_name']; ?>">
                <label for="last_name">Nom</label>
            </div>
        </div>
        <div>
            <div class="input-field col s6 offset-s3">
                <input type="text" id="mail" value="<?php echo $infos_user['mail']; ?>">
                <label for="mail">Email</label>
            </div>
            <div class="input-field col s6 offset-s3">
                <input type="password" id="current_password" autocomplete>
                <label for="current_password">Mot de Passe Actuel</label>
            </div>
            <div class="row">
                <div class="input-field col s4 offset-s2">
                    <input type="password" id="new_password" autocomplete>
                    <label for="new_password">Nouveau Mot de passe</label>
                </div>
                <div class="input-field col s4">
                    <input type="password" id="conf_new_password" autocomplete>
                    <label for="conf_new_password">Confirmation du Nouveau Mot de passe</label>
                </div>
            </div>
        </div>
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
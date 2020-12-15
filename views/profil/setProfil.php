
<div id="info_perso" class="row container">
    <h3>Informations Personnelles</h3>
    <form id="form_setprofil" class="col s12 card">
        <div class="row" id="avatar_last_first_name">
            <div class="input-field col s4">
                <input type="file" id="avatar">
                <label for="">Votre Avatar</label>
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
                <input type="text" id="current_password">
                <label for="current_password">Mot de Passe Actuel</label>
            </div>
            <div class="row">
                <div class="input-field col s4 offset-s2">
                    <input type="text" id="current_password">
                    <label for="new_password">Nouveau Mot de passe</label>
                </div>
                <div class="input-field col s4">
                    <input type="text" id="conf_new_password">
                    <label for="conf_new_password">Confirmation du Nouveau Mot de passe</label>
                </div>
            </div>
        </div>
    </form>
</div>
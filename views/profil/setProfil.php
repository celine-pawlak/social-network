<?php //include 'ressources/PHP/infos_profil.php'; ?>
<div id="all_set">
    <div id="info_perso">
        <h3></h3>
        <div class="row">
            <div>
                <input type="file" id="avatar" value="<?php //$infos['picture_profil']; ?>">
                <label for="">Votre Avatar</label>
            </div>
            <div>
                <input type="text" id="first_name" value="<?php //$infos['first_name']; ?>">
                <label for="first_name">Prénom</label>
            </div>
            <div>
                <input type="text" id="last_name" value="<?php //$infos['last_name']; ?>">
                <label for="last_name">Nom</label>
            </div>
        </div>
        <div>
            <div>
                <input type="text" id="mail" value="<?php //$infos['mail']; ?>">
                <label for="mail">Email</label>
            </div>
            <div>
                <input type="text" id="current_password">
                <label for="current_password">Mot de Passe Actuel</label>
            </div>
            <div>
                <div>
                    <input type="text" id="current_password">
                    <label for="new_password">Nouveau Mot de passe</label>
                </div>
                <div>
                    <input type="text" id="conf_new_password">
                    <label for="conf_new_password">Confirmation du Nouveau Mot de passe</label>
                </div>
            </div>
        </div>
    </div>
    <div id="info_gen">
        <div>
            <h3></h3>
            <input type="text" id="new_hobby" placeholder="Ajouter un hobby...">
            <div id="checkbox_hobbies">
            <?php
                foreach($infos as $hobby) {
                    echo '<p>
                            <label>
                                <input type="checkbox" checked="checked" />
                                <span>' $hobby['name_hobby'] '</span>
                            </label>
                        </p>';
                };
            ?>
            </div>
        </div>
        <div>
            <h3></h3>
            <input type="text" id="new_technology" placeholder="Ajouter une technologie...">
            <div id="checkbox_techno">
            </div>
        </div>
    </div>
</div>
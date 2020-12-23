<div class="row">
    <form id="form_reset" class="col l6 s8 offset-l3 offset-s2 card formulaire">
        <div class="erreurs d-none">
        </div>
        <div class="row">
            <div class="input-field col s8 offset-s2">
                <input id="email" type="email" class="validate">
                <label for="email">Adresse Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s8 offset-s2">
                <input id="reset_password" type="password" class="validate" autocomplete>
                <label for="reset_password">Nouveau Mot De Passe</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s8 offset-s2">
                <input id="conf_reset_password" type="password" class="validate" autocomplete>
                <label for="conf_reset_password">Confirmation du nouveau Mot De Passe</label>
            </div>
        </div>
        <div class="flex-column">
            <button id="submit_reset" class="btn waves-effect waves-light col s6 offset-s3 bouton" type="submit">Réinitialiser
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>
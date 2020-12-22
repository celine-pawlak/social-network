<div class="row">
    <form id="form_connexion" class="col l4 s10 offset-l4 offset-s1 card formulaire">
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
                <input id="password" type="password" class="validate" autocomplete>
                <label for="password">Mot De Passe</label>
            </div>
            <div>
                <p class="col s8 offset-s4 redirection clickable" id="oublier">Mot de passe oublié</p>
            </div>
        </div>
        <div class="flex-column">
            <button id="submit_co" class="btn waves-effect waves-light col s6 offset-s3 bouton" type="submit">Se Connecter
                <i class="material-icons right">send</i>
            </button>
            <p class="col s8 offset-s5 redirection">Pas encore inscrit ? <span id="page_inscription" class="clickable">Cliquez Ici</span></p>
        </div>
    </form>
</div>
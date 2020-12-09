<?php if(!isset($_SESSION['login']) || empty($_SESSION['login'])){ ?>
    <div class="row container">
        <form id="form_inscription" class="col s4 offset-s4 card">
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="first_name" type="text" class="validate">
                    <label for="first_name">First Name</label>
                </div>
                <div class="input-field col s6">
                    <input id="last_name" type="text" class="validate">
                    <label for="last_name">Last Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="date" class="" id="birthday">
                    <label for="birthday">Date d'Anniversaire</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" class="validate" autocomplete>
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="conf_password" type="password" class="validate" autocomplete>
                    <label for="conf_password">Password Confirmation</label>
                </div>
            </div>
            <div class='column'>
            <button id="submit_ins" class="btn waves-effect waves-light col s6 offset-s3" type="submit" name="action">S'inscrire
                <i class="material-icons right">send</i>
            </button>
            <p class="col s8 offset-s5">Déjà inscrit ? <span id="page_connexion">Cliquez Ici</span></p>
        </div>
        </form>
    </div>
<?php } else{
    header('Location: http://localhost/social-network/index');
} ?>

<script src="ressources/JS/inscription.js"></script>
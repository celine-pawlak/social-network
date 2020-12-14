<h4 class="blue-text" id="titre_header">Social Network</h4>
<div class="row">
    <div class="col s12">
        <div class="row">
            <div class="input-field col s12">                
                <input type="text" id="autocomplete-input" class="autocomplete">
                <label for="autocomplete-input">Autocomplete</label>
                <i class="material-icons prefix">search</i>
            </div>
        </div>
    </div>
</div>
<div id="profil_header" class="<?php  ?>">
    <!-- A changer par le bon chemin (bdd) -->
    <img src="<?php $_SESSION['user']['picture_profil'] ?>" alt="photo de profil" class="border-radius-50 w-3vw">
    <!-- Mettre plus grand le chevron -->
    <a class='dropdown-trigger' href='#' data-target='dropdown1'><i class="fas fa-chevron-down"></i></a>
    <ul id='dropdown1' class='dropdown-content'>
        <!-- Changer les liens -->
        <li><a href="#!">Profil</a></li>
        <li><a href="#!">Messagerie</a></li>
        <li class="divider" tabindex="-1"></li>
        <li><a href="#!">Modifier profil</a></li>        
    </ul>
</div>
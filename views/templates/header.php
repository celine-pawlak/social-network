<h4 class="blue-text" id="titre_header">Social Network</h4>

<section id="profil_header" class="<?= isset($_SESSION['user']['id']) ? '' : 'd-none'?>">
    <!-- Barre de recherche -->
    <div class="row m-0">
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
    <!-- Partie profil -->
    <div>
        <!-- Image de profil -->    
        <img src="<?= $_SESSION['user']['picture_profil'] ?>" alt="photo de profil" id="pp_header">        
        <!-- Menu dropdown -->
        <a class='dropdown-trigger' href='#' data-target='dropdown1'><i class="fas fa-chevron-down"></i></a>
        <ul id='dropdown1' class='dropdown-content'>            
            <li><a href="profil?id=<?= $_SESSION['user']['id'] ?>" id="profil_h">Profil</a></li>
            <li><a href="messagerie" id="message_h">Messagerie</a></li>
            <li class="divider" tabindex="-1"></li>
            <li><a href="modifier_profil" id="modif_h">Modifier profil</a></li>        
        </ul>
        <i class="fas fa-power-off"></i>
    </div>
</section>
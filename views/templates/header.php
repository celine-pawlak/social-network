<h4 class="blue-text" id="titre_header">Social Network</h4>

<section id="connect_header" class="<?= isset($_SESSION['user']['id']) ? 'd-flex' : 'd-none'?>">
    <!-- Barre de recherche -->
    <div class="row" id="barre_recherche">
        <div class="col s12">
            <div class="row m-0">
                <div class="input-field col s12 m-0">                
                    <input type="text" id="autocomplete-input" class="autocomplete" placeholder="Rechercher une personne...">                    
                    <!-- <i class="material-icons prefix">search</i> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Partie profil -->
    <div id="profil_header">
        <!-- Image de profil -->          
        <img src="<?= isset($_SESSION['user']) ? $_SESSION['user']['picture_profil'] : '' ?>" alt="photo de profil" id="pp_header">        
        <!-- Menu dropdown -->
        <a class='dropdown-trigger' href='#' data-target='dropdown1'><i class="fas fa-chevron-down blue-text"></i></a>
        <ul id='dropdown1' class='dropdown-content'>            
            <li><a href="profil?id=<?= $_SESSION['user']['id'] ?>">Profil</a></li>
            <li><a href="messagerie">Messagerie</a></li>
            <li class="divider" tabindex="-1"></li>
            <li><a href="modifier_profil">Modifier profil</a></li>        
        </ul>
        <i class="fas fa-power-off"></i>
    </div>
</section>

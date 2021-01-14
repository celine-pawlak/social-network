<section id="connect_header" class="flex-row align-items-center justify-content-spacebetween w-100 box-shadow">
    <div class="max-width-content w-100 mx-auto flex-row justify-content-spacebetween">
        <a href="index.php"><h4 class="text-center blue-text my-1" id="titre_header">Social Network</h4></a>
        <!-- Barre de recherche -->
        <div class="row <?= isset($_SESSION['user']) ? '' : 'd-none' ?>" id="barre_recherche">
            <div class="col l12 m12 s4">
                <div class="m-0">
                    <div class="input-field col s12 m-0">
                        <input type="text" id="autocomplete-input" class="autocomplete"
                               placeholder="Rechercher une personne...">
                        <!-- <i class="material-icons prefix">search</i> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Partie profil -->
        <div id="profil_header" class="<?= isset($_SESSION['user']) ? '' : 'd-none' ?>">

            <!-- Image de profil : ajouter un lien qui mène à la page perso  -->
            <a href="monprofil">
                <img src="<?= isset($_SESSION['user']) ? "ressources/img/" . $_SESSION['user']['picture_profil'] : '' ?>"
                     alt="photo de profil" id="pp_header">
            </a>

            <!-- Menu dropdown -->
            <a class='dropdown-trigger' href='#' data-target='dropdown1'><i
                        class="fas fa-chevron-down blue-text"></i></a>
            <ul id='dropdown1' class='dropdown-content'>
                <li><a href="profil?id=<?= $_SESSION['user']['id'] ?>">Profil</a></li>
                <li><a href="messagerie">Messagerie</a></li>
                <li class="divider" tabindex="-1"></li>
                <li><a href="modifier_profil">Modifier profil</a></li>
            </ul>

            <i class="fas fa-power-off clickable"></i>
        </div>
    </div>
</section>
<!-- Responsive -->
<a href="#" id="ilestpasdedans" data-target="slide-out"
   class="sidenav-trigger <?= isset($_SESSION['user']['id']) ? 'd-flex' : 'd-none' ?>"><i
            class="material-icons">menu</i></a>
<ul id="slide-out" class="sidenav">
    <div class="row" id="barre_recherche">
        <div class="col s12">
            <div class="row m-0">
                <div class="input-field col s12 m-0">
                    <input type="text" id="autocomplete-reponsive" class="autocomplete"
                           placeholder="Rechercher une personne...">
                    <!-- <i class="material-icons prefix">search</i> -->
                </div>
            </div>
        </div>
    </div>
    <li class="divider" tabindex="-1"></li>
    <li>
        <div class="user-view">
            <img src="ressources/img/<?= isset($_SESSION['user']['picture_profil']) ? 'd-flex' : 'd-none' ?>"
                 alt="photo de profil" id="pp_header">
            <span class="name"><?= isset($_SESSION['user']['first_name']) ? 'd-flex' : 'd-none' ?></span>
            <span class="email"><?= isset($_SESSION['user']['mail']) ? 'd-flex' : 'd-none' ?></span>
        </div>
    </li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="profil?id=<?= $_SESSION['user']['id'] ?>">Profil</a></li>
    <li><a href="messagerie">Messagerie</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="modifier_profil">Modifier profil</a></li>
</ul>

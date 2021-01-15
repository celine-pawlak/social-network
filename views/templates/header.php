<div class="max-width-content">
    <section id="connect_header" class="flex-row align-items-center justify-content-spacebetween w-100">
        <a href="/social-network" class="<?= isset($_SESSION['user']) ? '' : 'flex-1' ?>">
            <h4 class="text-center white-text my-1" id="titre_header">Social Network</h4>
        </a>
        <!-- Barre de recherche -->
        <div class="z-index-3 box-shadow border-radius-25px background-white barre_recherche_header <?= isset($_SESSION['user']) ? '' : 'd-none' ?>"
             id="barre_recherche">
            <div class="flex-row input-field m-0 h-100 align-items-center">
                <input class="grey-text autocomplete flex-row align-items-center pl-1 w-100 h-100 m-0 no-border no-border-focus"
                       type="text"
                       id="autocomplete-input"
                       placeholder="Rechercher une personne...">
                <i class="material-icons blue-text pr-1">search</i>
            </div>
        </div>
        <!-- Partie profil -->

        <div id="profil_header" class="flex-row align-items-center <?= isset($_SESSION['user']) ? '' : 'd-none' ?>">
            <!-- Lien Messagerie -->
            <a href="messagerie"><i class="fas fa-comment"></i></a>
            <!-- Image de profil : ajouter un lien qui mène à la page perso  -->
            <a href="profil&id=<?= $_SESSION['user']['id'] ?>" class="flex-row align-items-center z-index-3">
                <img class="avatar"
                     src="<?= isset($_SESSION['user']) ? "ressources/img/" . $_SESSION['user']['picture_profil'] : '' ?>"
                     alt="photo de profil" id="pp_header">
                <p id="name_on_header" class="mx-1 white-text"><?= $_SESSION['user']['first_name'] ?></p>
            </a>

            <!-- Menu dropdown -->
            <a class='dropdown-trigger flex-row justify-content-center' href='#' data-target='dropdown1'>
                <i class="fas fa-sort-down blue-text z-index-3"></i>
            </a>
            <ul id='dropdown1' class='dropdown-content'>
                <li><a class="semi-bold-text blue-text" href="profil&id=<?= $_SESSION['user']['id'] ?>">Profil</a></li>
                <li class="divider" tabindex="-1"></li>
                <li><a class="semi-bold-text blue-text" href="modifier_profil">Modifier profil</a></li>
            </ul>

            <i class="fas fa-power-off clickable yellow-text pl-2 z-index-3"></i>
        </div>
    </section>
    <!-- Responsive -->
    <a href="#" id="ilestpasdedans" data-target="slide-out"
       class="sidenav-trigger <?= isset($_SESSION['user']['id']) ? 'd-flex' : 'd-none' ?>"><i
                class="material-icons">menu</i></a>
    <ul id="slide-out" class="sidenav">
        <div class="row border-radius-25px background-white w-100" id="barre_recherche">
            <div class="col s12">
                <div class="row m-0">
                    <div class="input-field col s12 m-0" id="autocomplete-on-side">
                        <input type="text" id="autocomplete-reponsive" class="autocomplete"
                               placeholder="Rechercher une personne...">
                        <!-- <i class="material-icons prefix">search</i> -->
                    </div>
                </div>
            </div>
        </div>
        <li class="divider" tabindex="-1"></li>
        <li>
            <div class="user-view <?= isset($_SESSION['user']) ? 'd-flex' : 'd-none' ?>">
                <img class="" src="ressources/img/<?= $_SESSION['user']['picture_profil'] ?>"
                     alt="photo de profil" id="pp_header">
                <span class="name"></span>
                <span class="email"></span>
            </div>
        </li>
        <li class="divider" tabindex="-1"></li>
        <li><a href="profil&id=<?= $_SESSION['user']['id'] ?>">Profil</a></li>
        <li><a href="messagerie">Messagerie</a></li>
        <li class="divider" tabindex="-1"></li>
        <li><a href="modifier_profil">Modifier profil</a></li>
    </ul>
</div>
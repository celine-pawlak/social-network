/**
 * Vérifie si le mail est au bon format
 * - change la couleur de la bordure et outline
 * - a sera remplacé par b si match avec le regex
 * @param balise $('nom') de la balise à comparer
 * @param a nom d'une classe
 * @param b nom d'une autre classe
 */
function regexMailValide(balise, a, b) {
    var regex_mail = /^[a-z]{1,}\.+[a-z]{1,}@laplateforme.io$/g;
    var valeur = $(balise).val();

    if (valeur.match(regex_mail))
        {
            $(balise).removeClass(a).addClass(b);
        }
    else
        {
            $(balise).removeClass(b).addClass(a);
        }
}

/**
 * Vérifie si le password est au bon format
 * - change la couleur de la bordure et outline
 * - a sera remplacé par b si match avec le regex
 * @param balise $('nom') de la balise à comparer
 * @param a nom d'une classe
 * @param b nom d'une autre classe
 */
function regexPasswordValide(balise, a, b) {
    var regex_mdp = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,30}/;
    var valeur = $(balise).val();
    if (valeur.match(regex_mdp)) {
        $(balise).removeClass(a).addClass(b);
        // document.getElementById("erreur").innerHTML = "Sécurité du mot de passe FORT";
    } else {
        $(balise).removeClass(b).addClass(a);
        // document.getElementById("erreur").innerHTML = "Pour plus de sécurité, votre mot de passe doit contenir au moins : MAJUSCULE, minuscule, caractère spécial, chiffre";
    }
}

/**
 * Compare deux valeurs
 * Si les valeurs sont différentes, a remplace b (et inversement)
 *
 * @param balise $('nom') de la balise à comparer
 * @param verif $('nom') de la balise avec laquelle on veut comparer la valeur
 * @param a nom d'une classe
 * @param b nom d'une autre classe
 */
function isTheSame(balise, verif, a, b) {
    var valeur = $(balise).val();
    var valeur_verif = $(verif).val();
    if (valeur !== valeur_verif) {
        $(balise).removeClass(b).addClass(a);
    } else {
        $(balise).removeClass(a).addClass(b);
    }
}





// // verif php mail bon format
// if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-z]{1,}\.+[a-z]{1,}@laplateforme.io$/', $mail)) {
// array_push($errors, "Le mail n'est pas au bon format (prenom.nom@laplateforme.io)");
// }
// // verif php pw et cf_pw identiques
// if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,30}/', $password)) {
//     array_push($errors, "Le mot de passe n'est pas assez sécurisé");
// }
<?php
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        require 'Database/Database.php';
        $db = new Database;
        $pdo = $db->getPDO();

        $id_user = $_SESSION['user']['id'];

        // recup all info setProfil
        $query = $pdo->prepare("SELECT * FROM ((((users_hobbies INNER JOIN hobbies on hobbies_id = hobbies.id) INNER JOIN users_technologies on users_hobbies.users_id = users_technologies.users_id) INNER JOIN technologies on technologies_id = technologies.id) INNER JOIN users on users_hobbies.users_id = users.id) WHERE users.id = ? ");
        $query->execute([$id_user]);
        $infos = $query->fetch(PDO::FETCH_ASSOC);

        var_dump($infos);
    }
?>
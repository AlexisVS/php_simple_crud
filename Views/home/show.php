<?php

use Source\Helper;

?>
<h1>Voici l'utilisateur <?= $user['name'] ?></h1>
<?php Helper::beautifful_print($user); ?>
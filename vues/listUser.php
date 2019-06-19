<?php
foreach($resAction['users'] as $user) {
    ?>
    <div>
    <h2>
    <?=$user->getLogin();?>
    </h2>
    <h3>
    <?=$user->getPassword();?>
    </h3>
    </div>
    <?php
}
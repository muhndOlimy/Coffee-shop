<?php
global $appState;

$isAuth = $appState->isAuthenticated;
$currentHome = basename($_SERVER['SCRIPT_NAME']);
$links = [
    "Home" => "index.php",
    "Menu" => "menu.php",
    "About" => "about.php",
    "Contact" => "contact.php"
];
if (!$isAuth) {
    $links = array_merge($links, [
        "Register" => "register.php",
        "Login" => "login.php"
    ]);
} else {
    $links = array_merge($links, [
        "Logout" => "logout.php"
    ]);
}
?>
<menu class="nav-links">
    <?php foreach ($links as $text => $file): ?>
        <li>
            <a class="<?= $file === $currentHome ? "active" : "" ?>" href="../public/<?= $file ?>">
                <?= $text ?>
            </a>
        </li>
    <?php endforeach ?>
</menu>

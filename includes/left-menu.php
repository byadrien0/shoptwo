<div class="section-menu-left" style="padding-bottom: 180px;">
    <div class="admin_active" id="header_admin" style="display: flex; justify-content: center;">
        <div class="popup-user relative">
            <div class="user">
                <img src="<?php echo isset($user_id) ? $acc_avatar : '/assets/images/avatar/avatar-anonyme.png'; ?>"
                    alt="">
                <span><?php echo isset($user_id) ? $acc_username : "Non-Connecté"; ?><i
                        class="icon-keyboard_arrow_down"></i></span>
            </div>
        </div>
    </div>

    <div class="connect">
        <?php if (isset($user_id)) { ?>
            <a class="tf-button style-1 type-1 tablinks" href="/purchases/market-form.php" data-tabs="create">
                <span>Publier</span>
                <i class="icon-create"></i>
            </a>
        <?php } else { ?>
            <a class="tf-button style-1 type-1 tablinks" href="/auth/auth-form.php" data-tabs="connexion">
                <span>Connexion</span>
                <i class="icon-create"></i>
            </a>
        <?php } ?>
    </div>

    <div class="list-menu over-content">
        <ul class="menu-content">
            <li
                class="<?php echo ($_SERVER['REQUEST_URI'] == "/index.php" || $_SERVER['REQUEST_URI'] == "/" || $_SERVER['REQUEST_URI'] == "/index") ? 'active' : ''; ?>">
                <a href="/"><i class="icon-home-alt"></i> Accueil</a>
            </li>
            <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/infos/about-us.php") ? 'active' : ''; ?>">
                <a href="/infos/about-us.php"><i class="icon-gem-1"></i> À propos de nous</a>
            </li>

            <li
                class="has-item <?php echo ($_SERVER['REQUEST_URI'] == "/purchases/market-form.php" || $_SERVER['REQUEST_URI'] == "/purchases/market-our-ressources.php") ? 'active' : ''; ?>">
                <a class="button-sub-item"><i class="icon-link"></i> Ressources</a>
                <ul
                    class="sub-item <?php echo ($_SERVER['REQUEST_URI'] == "/purchases/market-form.php" || $_SERVER['REQUEST_URI'] == "/purchases/market-our-ressources.php") ? 'active' : ''; ?>">
                    <li><a href="<?php echo isset($user_id) ? "/purchases/market-form.php" : "/auth/auth-form.php"; ?>">Créer
                            une Ressource</a></li>
                    <li><a
                            href="<?php echo isset($user_id) ? "/purchases/market-our-ressources.php" : "/auth/auth-form.php"; ?>">Mes
                            Ressources</a></li>
                </ul>
            </li>
            <li
                class="has-item <?php echo ($_SERVER['REQUEST_URI'] == "/account/market-account.php") ? 'active' : ''; ?>">
                <a class="button-sub-item"><i class="icon-pages"></i> Mes Paramètres</a>
                <ul
                    class="sub-item <?php echo ($_SERVER['REQUEST_URI'] == "/account/market-account.php") ? 'active' : ''; ?>">
                    <li><a
                            href="<?php echo isset($user_id) ? "/account/market-account.php" : "/auth/auth-form.php"; ?>">Mon
                            Compte</a></li>
                </ul>
            </li>
            <li
                class="has-item <?php echo ($_SERVER['REQUEST_URI'] == "/account/market-wallet.php" || $_SERVER['REQUEST_URI'] == "/account/market-downloads.php") ? 'active' : ''; ?>">
                <a class="button-sub-item"><i class="icon-receipt"></i> Financier</a>
                <ul
                    class="sub-item <?php echo ($_SERVER['REQUEST_URI'] == "/account/market-wallet.php" || $_SERVER['REQUEST_URI'] == "/account/market-downloads.php") ? 'active' : ''; ?>">
                    <li><a
                            href="<?php echo isset($user_id) ? "/account/market-downloads.php" : "/auth/auth-form.php"; ?>">Mes
                            Achats</a></li>
                    <li><a
                            href="<?php echo isset($user_id) ? "/account/market-wallet.php" : "/auth/auth-form.php"; ?>">Retraits</a>
                    </li>
                </ul>
            </li>

            <li class="has-item">
                <a class="button-sub-item"><i class="icon-link"></i> Nos Politiques</a>
                <ul class="sub-item">
                    <li><a target="_blank"
                            href="https://docs.google.com/document/d/15quMKyz_wK3rJthdQqFZR1jA75KPvOONLqoc5FEXIVs/edit?usp=drive_link">P.C</a>
                    </li>
                    <li><a target="_blank"
                            href="https://docs.google.com/document/d/1Qw2DAjbi4GUM5l6lcF3Z_O5OAJiTGMwQWFm60Xy_cVA/edit?usp=drive_link">C.G.V</a>
                    </li>
                    <li><a target="_blank"
                            href="https://docs.google.com/document/d/1-8wUaLvY0TUp4j5cUxI7Ht6B_taAvZF6_hpCTecEEB4/edit?usp=drive_link">C.G.U</a>
                    </li>
                    <li><a target="_blank"
                            href="https://docs.google.com/document/d/1Fj-w9gkvFVPTlrDuQy6IGhdiZ_mnC5zh_lyk1KQ3M6I/edit?usp=drive_link">Cookies</a>
                    </li>
                    <li><a target="_blank"
                            href="https://docs.google.com/document/d/11zS5XVb_9OOv7WVaJM4uROKaDOjLDzVaDbuDw8vyyYc/edit?usp=sharing">M.L</a>
                    </li>
                    <li><a target="_blank"
                            href="https://docs.google.com/document/d/1wdMB5fGYApZPFfbOoOe_PvTXGOlBGB637tJ99NntAq0/edit?usp=sharing">R.P.R.N</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="list-menu wrap-bottom">
        <ul class="menu-bottom">
            <?php if (isset($user_id)) { ?>
                <li>
                    <a href="/account/logout.php"><i class="icon-sign-out-1"></i> Déconnexion</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
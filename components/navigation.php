<?php $depth = method_exists('General', 'getDepth') ? General::getDepth() : './'; ?>
<div class="navigation">
    <nav>
        <a href="<?= $depth; ?>" class="logo">
            <img src="<?= $depth; ?>img/logo.png" alt="H4H">
        </a>
        <input id="navigationDropdown" type="checkbox" class="navigation-checkbox">
        <label for="navigationDropdown" class="navigation-toogle">
            <span></span>
            <span></span>
            <span></span>
        </label>
        <ul>
            <li><a href="<?= $depth; ?>">Home</a></li>
            <li><span></span></li>
            <?php if (!empty($user) && is_a($user, 'User')): ?>
            <li><a href="<?= $depth; ?>profile.php">Profile</a></li>
            <li><a href="<?= $depth; ?>About.php">About</a></li>
            <li><a href="<?= $depth; ?>Contact.php">Contact</a></li>
            <?php if ($user->getRole() == 1): ?>
            <li><a href="<?= $depth; ?>users/">Users</a></li>
            <li><span></span></li>
            <li><a href="<?= $depth; ?>roles/">Roles</a></li>
            <li><span></span></li>
            <?php endif; ?>
            <li>
                <form method="post" action="<?= $depth; ?>php/sign_out.php">
                    <input type="submit" value="Sign Out" class="navigation-submit">
                </form>
            </li>
            <?php else: ?>

            <li><a href="<?= $depth; ?>register.php">Register</a></li>
            <li><span></span></li>
            <li><a href="<?= $depth; ?>sign_in.php">Sign In</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
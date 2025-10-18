<nav class="navbar container-fluid">
    <a href="<?= home_url(); ?>" class="navbar-brand">
        <img src="<?= esc_url(Theme()->assets('images/logo.png')); ?>" alt="" 
        width="230" height="107" loading="lazy" />
    </a>
    <?php get_template_part("parts/navbar/navigation"); ?>
    <button class="navbar-button" aria-label="Ouvrir le menu">
        <span></span>
    </button>
</nav>
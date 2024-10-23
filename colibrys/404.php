<?php get_header(); 
 wp_safe_redirect( home_url() );
?>
    <section class="page-erreur">
        <h1>Erreur 404</h1>
        <p>La page que vous recherchez n'existe pas.</p>
        <a href="/" title="Retourner à l'accueil" >Retour à l'accueil</a>
    </section>
<?php get_footer(); ?>
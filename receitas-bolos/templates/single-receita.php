<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="receita-detalhe">
        <h1><?php the_title(); ?></h1>

        <?php if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'large' );
        } ?>

        <p><strong>Tempo de Preparo:</strong> <?php the_field( 'tempo_preparo' ); ?> horas</p>


        <div class="ingredientes">
            <h2>Ingredientes</h2>
            <?php the_field( 'ingredientes' ); ?>
        </div>

        <div class="preparo">
            <h2>Modo de Preparo</h2>
            <?php the_content(); ?>
        </div>
    </div>

<?php endwhile; endif;

get_footer();

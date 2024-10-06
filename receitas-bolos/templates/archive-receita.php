<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div class="receitas-archive">
    <h1>Receitas de Bolos</h1>

    <?php
    // Filtro por Categoria
    $categorias = get_terms( 'categoria_receita' );
    if ( $categorias && ! is_wp_error( $categorias ) ) :
    ?>
        <form method="get">
            <select name="categoria" onchange="this.form.submit()">
                <option value="">Todas as Categorias</option>
                <?php foreach ( $categorias as $categoria ) : ?>
                    <option value="<?php echo esc_attr( $categoria->slug ); ?>" <?php selected( get_query_var( 'categoria' ), $categoria->slug ); ?>>
                        <?php echo esc_html( $categoria->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    <?php endif; ?>

    <?php
    // Consulta Personalizada
    $args = array(
        'post_type' => 'receita',
        'paged' => get_query_var( 'paged' ),
    );

    if ( get_query_var( 'categoria' ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'categoria_receita',
                'field' => 'slug',
                'terms' => get_query_var( 'categoria' ),
            ),
        );
    }

    $loop = new WP_Query( $args );

    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <div class="receita-item">
                <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'medium' );
                    } ?>
                    <h2><?php the_title(); ?></h2>
                    <p>Tempo de Preparo: <?php the_field( 'tempo_preparo' ); ?> horas</p>
                </a>
            </div>
        <?php endwhile;

        // Paginação
        the_posts_pagination();

    else :
        echo '<p>Nenhuma receita encontrada.</p>';
    endif;
    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>

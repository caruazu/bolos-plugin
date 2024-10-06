<?php
/*
Plugin Name: Receitas de Bolos
Description: Plugin para cadastro e exibição de receitas de bolos.
Version: 1.0
Author: Seu Nome
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Evita acesso direto
}

// Registra o Post Type Personalizado
function rb_registrar_post_type() {
    $labels = array(
        'name' => 'Receitas',
        'singular_name' => 'Receita',
        'menu_name' => 'Receitas',
        'name_admin_bar' => 'Receita',
        'add_new' => 'Adicionar Nova',
        'add_new_item' => 'Adicionar Nova Receita',
        'new_item' => 'Nova Receita',
        'edit_item' => 'Editar Receita',
        'view_item' => 'Ver Receita',
        'all_items' => 'Todas as Receitas',
        'search_items' => 'Pesquisar Receitas',
        'not_found' => 'Nenhuma receita encontrada.',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'receitas' ),
        'show_in_rest' => true,
    );

    register_post_type( 'receita', $args );
}
add_action( 'init', 'rb_registrar_post_type' );

// Registra a Taxonomia Personalizada
function rb_registrar_taxonomia() {
    $labels = array(
        'name' => 'Categorias',
        'singular_name' => 'Categoria',
        'search_items' => 'Buscar Categorias',
        'all_items' => 'Todas as Categorias',
        'edit_item' => 'Editar Categoria',
        'update_item' => 'Atualizar Categoria',
        'add_new_item' => 'Adicionar Nova Categoria',
        'new_item_name' => 'Nova Categoria',
        'menu_name' => 'Categorias',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'rewrite' => array( 'slug' => 'categorias' ),
        'show_in_rest' => true,
    );

    register_taxonomy( 'categoria_receita', 'receita', $args );
}
add_action( 'init', 'rb_registrar_taxonomia' );

// Adiciona Campos Personalizados com ACF
if ( function_exists( 'acf_add_local_field_group' ) ) {

    acf_add_local_field_group( array(
        'key' => 'group_receita',
        'title' => 'Detalhes da Receita',
        'fields' => array(
            array(
                'key' => 'field_tempo_preparo',
                'label' => 'Tempo de Preparo',
                'name' => 'tempo_preparo',
                'type' => 'time_picker',
                'instructions' => 'Selecione o tempo de preparo.',
                'required' => 1,
                'display_format' => 'H:i',
                'return_format' => 'H:i',
            ),            
            array(
                'key' => 'field_ingredientes',
                'label' => 'Ingredientes',
                'name' => 'ingredientes',
                'type' => 'textarea',
                'instructions' => 'Liste os ingredientes necessários.',
                'required' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'receita',
                ),
            ),
        ),
    ) );
}

// Carrega os Templates Personalizados
function rb_templates( $template ) {
    if ( is_post_type_archive( 'receita' ) ) {
        $theme_files = array( 'archive-receita.php' );
        $exists_in_theme = locate_template( $theme_files, false );
        if ( $exists_in_theme != '' ) {
            return $exists_in_theme;
        } else {
            return plugin_dir_path( __FILE__ ) . 'templates/archive-receita.php';
        }
    } elseif ( is_singular( 'receita' ) ) {
        $theme_files = array( 'single-receita.php' );
        $exists_in_theme = locate_template( $theme_files, false );
        if ( $exists_in_theme != '' ) {
            return $exists_in_theme;
        } else {
            return plugin_dir_path( __FILE__ ) . 'templates/single-receita.php';
        }
    }
    return $template;
}
add_filter( 'template_include', 'rb_templates' );

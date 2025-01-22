<?php

namespace ImageAndText\Controllers;

class PostTypeController
{
    /**
     * Construtor da classe PostTypeController.
     *
     * Registra os ganchos de ação necessários para o plugin:
     * - 'init' para registrar o tipo de post 'image_and_text'.
     * - 'add_meta_boxes' para adicionar a meta box para 'image_and_text'.
     * - 'save_post' para salvar os dados da meta box 'image_and_text'.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        add_action('init', [$this, 'iat_register_post_type_image_and_text']);
        add_action('add_meta_boxes', [$this, 'iat_add_meta_box_image_and_text']);
        add_action('save_post', [$this, 'iat_save_meta_box_image_and_text']);
    }

    /**
     * Registra o tipo de post 'image_and_text' com os seguintes atributos:
     * - labels: nome e singular_name para o tipo de post
     * - public: true para que o tipo de post seja visvel no WordPress
     * - menu_icon: dashicons-format-image para o icon do tipo de post
     * - supports: title, editor e thumbnail para que o tipo de post tenha
     *   um campo de t tulo, um editor de texto e um campo de imagem
     *
     * @since 1.0.0
     */
    public function iat_register_post_type_image_and_text()
    {
        register_post_type(
            'image_and_text',
            [
                'labels' => [
                    'name' => __('Images and Texts', 'image-and-text'),
                    'singular_name' => __('Image and Text', 'image-and-text'),
                ],
                'public' => true,
                'menu_icon' => 'dashicons-format-image',
                'supports' => ['title', 'editor', 'thumbnail']
            ]
        );
    }

    /**
     * Adiciona uma meta box para o tipo de post 'image_and_text'.
     *
     * A meta box permite que o usuário insira informações adicionais
     * no post, como texto personalizado, que serão salvas e exibidas
     * junto com o post.
     *
     * @since 1.0.0
     */

    public function iat_add_meta_box_image_and_text()
    {
        add_meta_box(
            'image_and_text_meta_box',
            __('Image and Text', 'image-and-text'),
            [$this, 'iat_meta_box_callback_image_and_text'],
            'image_and_text',
            'normal',
            'default'
        );
    }

    /**
     * Renderiza a meta box para o tipo de post 'image_and_text'.
     *
     * A meta box permite que o usu rio insira informa es adicionais
     * no post, como texto personalizado, que ser o salvas e exibidas
     * junto com o post.
     *
     * @param WP_Post $post O post que esta sendo editado.
     *
     * @since 1.0.0
     */
    public function iat_meta_box_callback_image_and_text($post)
    {
        require_once plugin_dir_path(__FILE__) . '../views/admin/iatMetaBoxCallbackImageAndTextViews.php';
    }

    /**
     * Salva as informa es inseridas na meta box do tipo de post
     * 'image_and_text' para o post que esta sendo editado.
     *
     * Verifica se o campo 'iat_text' existe e o valor do campo
     *   iat_text   est  sido enviado na requisi o atual.
     * Caso o valor exista, salva o valor do campo no post meta
     * com o nome 'iat_text' utilizando a fun o update_post_meta.
     *
     * @param int $post_id O ID do post que esta sendo editado.
     *
     * @since 1.0.0
     */
    public function iat_save_meta_box_image_and_text($post_id)
    {
        if (!isset($_POST['iat_text'])) {
            return;
        }
        update_post_meta($post_id, 'iat_text', $_POST['iat_text']);
    }
}
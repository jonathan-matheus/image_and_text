<?php

use ImageAndText\Controllers\PostTypeController;
/**
 * Plugin Name: Image and Text
 * Description: A simple image and text block.
 * Version: 1.0
 * Author: Jonathan Matheus da Silva
 * Author URI: https://github.com/jonathan-matheus
 * License: MIT
 * Text Domain: image-and-text
 */


require_once __DIR__ . '/vendor/autoload.php';

new PostTypeController();

register_activation_hook(__FILE__, function () {
});

register_deactivation_hook(__FILE__, function () {
    unregister_post_type('image_and_text');
});
<?php
namespace wpixel;

class Plugin_Core {

    public static $includes = array(
        'admin/admin-core.class.php',
    );

    public static function init() {
        Plugin_Core::register_scripts();
        if(Plugin_Core::load_dependencies()) {
            Plugin_Core::define_admin_hooks();
        }
    }

    public static function load_dependencies() {
        foreach(Plugin_Core::$includes as $include) {
            require_once WPIXEL_BASE_DIR . "includes/{$include}";
        }
        return true;
    }

    private static function define_admin_hooks() {
        add_action('load-upload.php', array('wpixel\admin\Admin_Core', 'add_wpixel_action'));
        add_action('wp_ajax_base_img_url', array('wpixel\admin\Admin_Core', 'get_base_img_url'));
        add_action('wp_ajax_wpixel_save', array('wpixel\admin\Admin_Core', 'save'));
    }

    public static function get_image_sizes() {
        global $_wp_additional_image_sizes;
        $sizes = array();
        foreach(get_intermediate_image_sizes() as $size) {
            if(in_array($size, array('thumbnail', 'medium', 'large'))) {
                $sizes[$size]['width'] = get_option("{$size}_size_w");
                $sizes[$size]['height'] = get_option("{$size}_size_h");
                $sizes[$size]['crop'] = (bool) get_option("{$size}_crop");
            } elseif (isset($_wp_additional_image_sizes[$size])) {
                $sizes[$size] = array(
                    'width' => $_wp_additional_image_sizes[$size]['width'],
                    'height' => $_wp_additional_image_sizes[$size]['height'],
                    'crop' =>  $_wp_additional_image_sizes[$size]['crop']
                );
            }
        }
        return $sizes;
    }

    public static function register_scripts() {
        wp_register_script(WPIXEL_SLUG . '_feather', WPIXEL_BASE_URL . 'js/feather.min.js');
        wp_register_script(WPIXEL_SLUG . '_wpixel', WPIXEL_BASE_URL . 'js/wpixel.js', array(WPIXEL_SLUG . '_feather', 'jquery'));
    }
}
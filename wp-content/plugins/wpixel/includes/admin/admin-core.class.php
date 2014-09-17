<?php
namespace wpixel\admin;

class Admin_Core {

    function __constructor() {
        $this::enqueue_scripts();
    }

    public static function add_wpixel_action() {
        Admin_Core::enqueue_scripts();

    }

    public static function enqueue_scripts() {
        wp_enqueue_script(WPIXEL_SLUG . "_feather");
        wp_enqueue_script(WPIXEL_SLUG . "_wpixel");
    }

} 
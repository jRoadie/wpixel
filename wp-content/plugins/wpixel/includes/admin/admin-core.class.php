<?php
namespace wpixel\admin;

class Admin_Core {

    function __constructor() {
        $this::enqueue_scripts();
    }

    public static function add_wpixel_action() {
        Admin_Core::enqueue_scripts();

    }

    public static function get_base_img_url() {
        $id = intval($_GET['attachmentId']);
        $post = get_post($id);
        echo $post->guid;
        die();
    }

    public static function save() {
        $content = $_POST['content'];
        $img = substr($content, strpos($content, 'base64,') + 7);
        echo $img;
        die();
    }

    public static function enqueue_scripts() {
        wp_enqueue_script(WPIXEL_SLUG . "_feather");
        wp_enqueue_script(WPIXEL_SLUG . "_wpixel");
    }

} 
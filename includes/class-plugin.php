<?php
namespace ESS_3D_Logo;

defined('ABSPATH') || exit;

class Plugin {
    private static ?self $instance = null;

    public static function instance(): self {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_fonts']);
    }

    public function register_widgets($widgets_manager): void {
        require_once ESS_3D_LOGO_PATH . 'includes/class-elementor-widget.php';
        $widgets_manager->register(new Elementor_Widget());
    }

    public function enqueue_fonts(): void {
        wp_enqueue_style(
            'ess-3d-logo-fonts',
            'https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap',
            [],
            null
        );
    }

    /**
     * Enqueue JS + CSS for the widget. Called by the widget via get_script_depends / get_style_depends.
     */
    public static function enqueue_widget_assets(): void {
        if (!wp_script_is('ess-3d-logo', 'registered')) {
            wp_register_script(
                'ess-3d-logo',
                ESS_3D_LOGO_URL . 'assets/dist/ess-3d-logo.js',
                [],
                ESS_3D_LOGO_VERSION,
                true
            );
            wp_localize_script('ess-3d-logo', 'essLogoConfig', [
                'modelPath' => ESS_3D_LOGO_URL . 'assets/models/logo.glb',
                'earthImg'  => ESS_3D_LOGO_URL . 'assets/images/earth.jpg',
            ]);
        }
        if (!wp_style_is('ess-3d-logo', 'registered')) {
            wp_register_style(
                'ess-3d-logo',
                ESS_3D_LOGO_URL . 'assets/dist/ess-3d-logo.css',
                [],
                ESS_3D_LOGO_VERSION
            );
        }
    }
}

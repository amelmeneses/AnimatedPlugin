<?php
namespace ESS_3D_Logo;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined('ABSPATH') || exit;

class Elementor_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        Plugin::enqueue_widget_assets();
    }

    public function get_name(): string { return 'ess_3d_logo'; }
    public function get_title(): string { return 'ESS 3D Logo'; }
    public function get_icon(): string { return 'eicon-globe'; }
    public function get_categories(): array { return ['general']; }
    public function get_keywords(): array { return ['3d', 'logo', 'ess', 'space']; }
    public function get_style_depends(): array { return ['ess-3d-logo']; }
    public function get_script_depends(): array { return ['ess-3d-logo']; }

    protected function register_controls(): void {
        $this->start_controls_section('content_section', [
            'label' => 'Content',
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control('hero_heading', [
            'label'   => 'Hero Heading',
            'type'    => Controls_Manager::TEXTAREA,
            'default' => 'Impulsamos la innovación y el conocimiento en la industria espacial de Ecuador.',
        ]);
        $this->add_control('hero_body', [
            'label'   => 'Hero Body Text',
            'type'    => Controls_Manager::TEXTAREA,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.',
        ]);
        $this->end_controls_section();
    }

    protected function render(): void {
        $s = $this->get_settings_for_display();
        $hero_heading = esc_html($s['hero_heading']);
        $hero_body = esc_html($s['hero_body']);
        $earth_img = ESS_3D_LOGO_URL . 'assets/images/earth.jpg';
        ?>
        <div class="ess-3d-logo-widget">

            <!-- ═══ HERO + NAVBAR (navbar overlays the earth image) ═══ -->
            <section class="ess-hero" id="hero-section">
                <div class="ess-hero-earth" style="background-image:url('<?php echo esc_url($earth_img); ?>')"></div>

                <!-- Navbar — transparent, on top of earth -->
                <nav class="ess-navbar" id="ess-navbar">
                    <div class="ess-navbar-inner">
                        <div class="ess-navbar-brand">
                            <span class="ess-brand-text">Ecuador<br>Space<br>Society</span>
                        </div>
                        <div class="ess-navbar-logo" id="header-canvas"></div>
                        <div class="ess-navbar-coords">
                            <div class="ess-navbar-you-wrap">
                                <span class="ess-navbar-you">YOU ARE<br>HERE</span>
                            </div>
                            <div class="ess-navbar-data">
                                <div class="ess-navbar-col">
                                    <span class="coord-row"><span class="coord-label">Dec</span> <span class="coord-value" id="header-dec">&mdash;</span></span>
                                    <span class="coord-row"><span class="coord-label">AR</span> <span class="coord-value" id="header-ar">&mdash;</span></span>
                                </div>
                                <div class="ess-navbar-col">
                                    <span class="coord-row"><span class="coord-label">Lat</span> <span class="coord-value" id="header-lat">&mdash;</span></span>
                                    <span class="coord-row"><span class="coord-label">Long</span> <span class="coord-value" id="header-lng">&mdash;</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="ess-navbar-right">
                            <div class="ess-navbar-links">
                                <a href="#about-section" class="ess-nav-link"><span class="nav-num">01</span> ABOUT US</a>
                                <a href="#locations-section" class="ess-nav-link"><span class="nav-num">02</span> MORE LOCATIONS</a>
                                <a href="#news-section" class="ess-nav-link"><span class="nav-num">03</span> NEWS</a>
                                <a href="#" class="ess-nav-link"><span class="nav-num">04</span> CONTACT</a>
                            </div>
                            <button class="ess-hamburger" id="ess-hamburger" aria-label="Menu">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </nav>
            </section>

            <!-- ═══ MENU OVERLAY ═══ -->
            <div class="ess-menu-overlay" id="ess-menu-overlay">
                <button class="ess-menu-close" id="ess-menu-close" aria-label="Close">&times;</button>
                <div class="ess-menu-content">
                    <div class="ess-menu-brand">
                        <svg class="ess-menu-logo-svg" viewBox="0 0 60 60" fill="none"><circle cx="30" cy="30" r="28" stroke="white" stroke-width="1.5"/><path d="M15 30 Q30 12 45 30 Q30 48 15 30Z" stroke="white" stroke-width="1.5" fill="none"/></svg>
                        <span class="ess-menu-brand-text">Ecuador<br>Space<br>Society</span>
                    </div>
                    <nav class="ess-menu-nav">
                        <a href="#about-section" class="ess-menu-link"><span class="ess-menu-num">01.</span>About us</a>
                        <a href="#news-section" class="ess-menu-link"><span class="ess-menu-num">02.</span>News</a>
                        <a href="#locations-section" class="ess-menu-link"><span class="ess-menu-num">03.</span>More locations</a>
                        <a href="#" class="ess-menu-link"><span class="ess-menu-num">04.</span>Contact</a>
                    </nav>
                </div>
            </div>

            <!-- ═══ ABOUT US ═══ -->
            <section class="ess-about" id="about-section">
                <div class="ess-about-inner">
                    <span class="ess-section-tag">01 ABOUT US</span>
                    <div class="ess-about-content">
                        <div class="ess-about-left">
                            <h2 class="ess-about-heading"><span class="ess-about-prefix">ESS</span> <?php echo $hero_heading; ?></h2>
                        </div>
                        <div class="ess-about-right">
                            <p class="ess-about-body"><?php echo $hero_body; ?></p>
                        </div>
                    </div>
                    <div class="ess-about-coords">
                        <span class="ess-about-coord" id="header-breadcrumb"></span>
                    </div>
                </div>
            </section>

            <!-- ═══ NEWS ═══ -->
            <section class="ess-news" id="news-section">
                <div class="ess-news-inner">
                    <!-- Decorative circle — left side -->
                    <div class="ess-deco-circle">
                        <svg viewBox="0 0 500 500" fill="none"><circle cx="250" cy="250" r="240" stroke="#222" stroke-width="0.5"/><circle cx="250" cy="250" r="160" stroke="#222" stroke-width="0.5"/><circle cx="250" cy="250" r="80" stroke="#222" stroke-width="0.5"/><line x1="250" y1="0" x2="250" y2="500" stroke="#222" stroke-width="0.5"/><line x1="0" y1="250" x2="500" y2="250" stroke="#222" stroke-width="0.5"/></svg>
                    </div>
                    <span class="ess-section-tag">01 NEWS</span>
                    <div class="ess-news-cards">
                        <div class="ess-news-card">
                            <div class="ess-news-img"></div>
                            <span class="ess-news-date">FEB 12 / 2025</span>
                            <h3 class="ess-news-title">This is a headline</h3>
                            <p class="ess-news-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                            <a href="#" class="ess-news-more">> LEER MÁS</a>
                        </div>
                        <div class="ess-news-card">
                            <div class="ess-news-img"></div>
                            <span class="ess-news-date">JAN 8 / 2026</span>
                            <h3 class="ess-news-title">This is a headline</h3>
                            <p class="ess-news-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                            <a href="#" class="ess-news-more">> LEER MÁS</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ═══ MORE LOCATIONS ═══ -->
            <section class="ess-locations" id="locations-section">
                <div class="ess-locations-inner">
                    <span class="ess-section-tag">01 MORE LOCATIONS</span>
                    <div id="locations-list"></div>
                </div>
            </section>

        </div>
        <?php
    }
}

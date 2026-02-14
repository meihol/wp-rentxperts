<?php
namespace ArolaxEssentialApp\Importer;

/**
 * demo import.
 */
class Wcf_Theme_Demos
{
    public $_metas = array(        
        'arolax_lic_Key',
        'arolax_lic_email',
    );
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function __construct()
	{
       
       add_action( 'fw:ext:backups:tasks:success', [$this,'success'] );
       
        if( !arolax_theme_service_pass() ){
            return;
        }
       
       add_filter( 'fw:ext:backups-demo:demos', [$this,'backups_demos'] );     
 	}
	
    function backups_demos( $demos ) {
        
        $demo_content_installer	 = 'https://themecrowdy.com/demo-content/arolax';
        
        $demos_array			 = array(
            'branding-agency' => array(
                'title'        => esc_html__( 'Branding Agency', 'arolax-essential' ),
                'category'     => [ 'agency' ],
                'screenshot'   => esc_url( $demo_content_installer ) . '/branding-agency/sc.png',
                'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/branding-agency/' ),
            ),

            'web-agency' => array(
                'title'        => esc_html__( 'Web Design & Development Agency', 'arolax-essential' ),
                'category'     => [ 'agency' ],
                'screenshot'   => esc_url( $demo_content_installer ) . '/web-agency/sc.png',
                'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/web-design-agencey/' ),
            ),

            'seo-agency' => array(
	            'title'        => esc_html__( 'SEO Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/seo-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/seo-agency/' ),
            ),

            'design-studio' => array(
	            'title'        => esc_html__( 'Design Studio', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/design-studio/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/design-studio/' ),
            ),

            'video-production' => array(
	            'title'        => esc_html__( 'Video Production', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/video-production/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/video-production/' ),
            ),

            'ai-agency' => array(
	            'title'        => esc_html__( 'AI Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/ai-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/ai-agency/' ),
            ),

			'digital-agency-two' => array(
	            'title'        => esc_html__( 'Digital Agency Two', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/digital-agency-two/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/digital-agency-two/' ),
            ),

			'creative-agency-three' => array(
	            'title'        => esc_html__( 'Creative Agency Three', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/creative-agency-three/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-agency-three/' ),
            ),

			'startup-agency-two' => array(
	            'title'        => esc_html__( 'Startup Agency Two', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/startup-agency-two/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/startup-agency-two/' ),
            ),

			'design-studio-two' => array(
	            'title'        => esc_html__( 'Digital Studio Two', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/design-studio-two/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/design-studio-two/' ),
            ),

			'creative-branding-agency' => array(
	            'title'        => esc_html__( 'Creative Branding Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/creative-branding-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-branding-agency/' ),
            ),

            'creative-agency-classic' => array(
	            'title'        => esc_html__( 'Creative Agency Classic', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/creative-agency-classic/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-agency-classic/' ),
            ),
            
            'marketing-agency' => array(
	            'title'        => esc_html__( 'Marketing Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/marketing-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/marketing-agency/' ),
            ),
            
            'corporate-agency' => array(
	            'title'        => esc_html__( 'Corporate Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/corporate-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/corporate-agency/' ),
            ),
            
            'startup-agency' => array(
	            'title'        => esc_html__( 'Startup Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/startup-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/startup-agency/' ),
            ),
            
            'modern-agency' => array(
	            'title'        => esc_html__( 'Modern Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/modern-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/modern-agency/' ),
            ),
            
            'photography-studio' => array(
	            'title'        => esc_html__( 'Photography Studio', 'arolax-essential' ),
	            'category'     => [ 'agency', 'personal' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/photography-studio/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/photography-studio/' ),
            ),

            'creative-agency' => array(
	            'title'        => esc_html__( 'Creative Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/creative-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-agency/' ),
            ),

            'creative-agency-two' => array(
	            'title'        => esc_html__( 'Creative Agency Two', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/creative-agency-two/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-agency-two/' ),
            ),

            'digital-agency' => array(
	            'title'        => esc_html__( 'Digital Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/digital-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/digital-agency/' ),
            ),

            'law-firm-agency' => array(
	            'title'        => esc_html__( 'Law Firm Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/law-firm-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/law-firm-agency/' ),
            ),

            'web-developer' => array(
	            'title'        => esc_html__( 'Web Developer', 'arolax-essential' ),
	            'category'     => [ 'personal' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/web-developer/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/arolax-developer/' ),
            ),

            'photographer' => array(
	            'title'        => esc_html__( 'Photographer', 'arolax-essential' ),
	            'category'     => [ 'personal' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/photographer/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/photographer/' ),
            ),

            'film-production-agency' => array(
	            'title'        => esc_html__( 'Film Production Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/film-production-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/film-production-agency/' ),
            ),
            
            'health-coach' => array(
	            'title'        => esc_html__( 'Health Coach', 'arolax-essential' ),
	            'category'     => [ 'health' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/health-coach/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/health-coach/' ),
            ),
            
						'freelancer' => array(
	            'title'        => esc_html__( 'Freelancer', 'arolax-essential' ),
	            'category'     => [ 'personal' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/freelancer/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/freelancer/' ),
            ),
            
							'content-writer' => array(
	            'title'        => esc_html__( 'Content Writer', 'arolax-essential' ),
	            'category'     => [ 'personal' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/content-writer/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/content-writer/' ),
            ),
            
            'event-planner' => array(
	            'title'        => esc_html__( 'Event Planner', 'arolax-essential' ),
	            'category'     => [ 'personal' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/event-planner/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/event-planner/' ),
            ),
            
						'digital-marketer' => array(
	            'title'        => esc_html__( 'Digital Marketer', 'arolax-essential' ),
	            'category'     => [ 'personal' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/digital-marketer/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/digital-marketer/' ),
            ),

            'travel-agency' => array(
	            'title'        => esc_html__( 'Travel Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/travel-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/travel-agency/' ),
            ),

						'personal-portfolio' => array(
	            'title'        => esc_html__( 'Personal Portfolio', 'arolax-essential' ),
	            'category'     => [ 'personal' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/personal-portfolio/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/personal-portfolio/' ),
            ),

						'marketing-consultancy-agency' => array(
	            'title'        => esc_html__( 'Marketing Consultancy Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/marketing-consultancy-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/marketing-consultancy-agency/' ),
            ),

						'busienss-consultant-agency' => array(
	            'title'        => esc_html__( 'Business Consultancy Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/busienss-consultant-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/busienss-consultant-agency/' ),
            ),

            'it-consultancy-agency' => array(
	            'title'        => esc_html__( 'IT Consultancy Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/it-consultancy-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/it-consultancy-agency/' ),
            ),

            'insurance-consultancy-agency' => array(
	            'title'        => esc_html__( 'Insurance Consultancy Agency', 'arolax-essential' ),
	            'category'     => [ 'business', 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/insurance-consultancy-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/insurance-consultancy-agency/' ),
            ),

            'consultant-management-agency' => array(
	            'title'        => esc_html__( 'Consultant Management Agency', 'arolax-essential' ),
	            'category'     => [ 'agency', 'business' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/consultant-management-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/consultant-management-agency/' ),
            ),

            'digital-product-agency' => array(
	            'title'        => esc_html__( 'Digital Product Agency', 'arolax-essential' ),
	            'category'     => [ 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/digital-product-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/digital-product-agency/' ),
            ),

            'resume' => array(
	            'title'        => esc_html__( 'Resume', 'arolax-essential' ),
	            'category'     => [ 'personal' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/resume/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/resume/' ),
            ),

            'image-generator-agency' => array(
	            'title'        => esc_html__( 'AI Image Generator', 'arolax-essential' ),
	            'category'     => [ 'technology' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/image-generator-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/image-generator-agency/' ),
            ),

            'ai-conetnt-writer' => array(
	            'title'        => esc_html__( 'AI  Content Writer', 'arolax-essential' ),
	            'category'     => [ 'technology' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/ai-conetnt-writer/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/ai-conetnt-writer/' ),
            ),

            'mobileapps' => array(
	            'title'        => esc_html__( 'Mobile Apps', 'arolax-essential' ),
	            'category'     => [ 'technology' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/mobileapps/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/mobileapps/' ),
            ),

            'ai-software' => array(
	            'title'        => esc_html__( 'AI Software', 'arolax-essential' ),
	            'category'     => [ 'technology' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/ai-software/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/ai-software/' ),
            ),

            'ai-chatbot' => array(
	            'title'        => esc_html__( 'AI Chatbot', 'arolax-essential' ),
	            'category'     => [ 'technology' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/ai-chatbot/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/ai-chatbot/' ),
            ),


            // Advanced Portfolio
            'full-width-spring-slider' => array(
	            'title'        => esc_html__( 'Full Width Spring Slider', 'arolax-essential' ),
	            'category'     => [ 'portfolio' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/full-width-spring-slider/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio/full-width-spring-slider/' ),
            ),

            'full-width-slicer-slider' => array(
	            'title'        => esc_html__( 'Full Width Slicer Slider', 'arolax-essential' ),
	            'category'     => [ 'portfolio' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/full-width-slicer-slider/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio/full-width-slicer-slider/' ),
            ),

            'full-width-shutters-slider' => array(
	            'title'        => esc_html__( 'Full Width Shutters Slider', 'arolax-essential' ),
	            'category'     => [ 'portfolio' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/full-width-shutters-slider/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio/full-width-shutters-slider/' ),
            ),

            'full-width-fashion-slider' => array(
	            'title'        => esc_html__( 'Full Width Fashion Slider', 'arolax-essential' ),
	            'category'     => [ 'portfolio' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/full-width-fashion-slider/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio/full-width-fashion-slider/' ),
            ),

            'full-width-carousel-slider' => array(
	            'title'        => esc_html__( 'Full Width Carousel Slider', 'arolax-essential' ),
	            'category'     => [ 'portfolio' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/full-width-carousel-slider/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio/full-width-carousel-slider/' ),
            ),

            'full-width-shaders-slider' => array(
	            'title'        => esc_html__( 'Full Width Shaders Slider', 'arolax-essential' ),
	            'category'     => [ 'portfolio' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/full-width-shaders-slider/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio/full-width-shaders-slider/' ),
            ),

            'card-slider' => array(
	            'title'        => esc_html__( 'Card Slider', 'arolax-essential' ),
	            'category'     => [ 'portfolio' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/card-slider/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio/card-slider/' ),
            ),

            'portfolio-masonry' => array(
	            'title'        => esc_html__( 'Portfolio Masonry', 'arolax-essential' ),
	            'category'     => [ 'portfolio' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/portfolio-masonry/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio/portfolio-masonry/' ),
            ),

            'agency-portfolio' => array(
	            'title'        => esc_html__( 'Agency Portfolio', 'arolax-essential' ),
	            'category'     => [ 'agency', 'portfolio' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/agency-portfolio/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio/agency-portfolio/' ),
            ),

            // RTL Demos
            'seo-agency-rtl' => array(
	            'title'        => esc_html__( 'SEO Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'rtl', 'agency' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/seo-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/seo-agency-rtl/?d=rtl' ),
            ),

            'startup-agency-rtl' => array(
	            'title'        => esc_html__( 'Startup Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/startup-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/startup-agency-rtl/?d=rtl' ),
            ),

            'modern-agency-rtl' => array(
	            'title'        => esc_html__( 'Modern Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/modern-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/modern-agency-rtl/?d=rtl' ),
            ),

            'design-studio-rtl' => array(
	            'title'        => esc_html__( 'Design Studio RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/design-studio-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/design-studio-rtl/?d=rtl' ),
            ),

			'web-design-agency-rtl' => array(
	            'title'        => esc_html__( 'Web Design Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/web-design-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/web-design-agency-rtl/' ),
            ),
            
            'video-production-agency-rtl' => array(
	            'title'        => esc_html__( 'Video Production Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/video-production-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/video-production-agency-rtl/' ),
            ),
            
			'ai-agency-rtl' => array(
	            'title'        => esc_html__( 'AI Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/ai-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/ai-agency-rtl/' ),
            ),
            
            'creative-agency-classic-rtl' => array(
	            'title'        => esc_html__( 'Creative Agency Classic RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/creative-agency-classic-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-agency-classic-rtl/' ),
            ),
            
			'marketing-agency-rtl' => array(
	            'title'        => esc_html__( 'Marketing Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/marketing-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/marketing-agency-rtl/' ),
            ),
            
            'corporate-agency-rtl' => array(
	            'title'        => esc_html__( 'Corporate Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/corporate-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/corporate-agency-rtl/' ),
            ),

            'creative-agency-02-rtl' => array(
	            'title'        => esc_html__( 'Creative Agency 02 RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/creative-agency-02-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-agency-02-rtl/' ),
            ),

            'digital-agency-rtl' => array(
	            'title'        => esc_html__( 'Digital Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/digital-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/digital-agency-rtl/' ),
            ),

            'law-firm-agency-rtl' => array(
	            'title'        => esc_html__( 'Law Firm Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/law-firm-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/law-firm-agency-rtl/' ),
            ),

            'film-production-agency-rtl' => array(
	            'title'        => esc_html__( 'Film Production Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/film-production-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/film-production-agency-rtl/' ),
            ),

            'travel-agency-rtl' => array(
	            'title'        => esc_html__( 'Travel Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/travel-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/travel-agency-rtl/' ),
            ),

            'marketing-consultancy-agency-rtl' => array(
	            'title'        => esc_html__( 'Marketing Consulting Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/marketing-consultancy-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/marketing-consultancy-agency-rtl/' ),
            ),

            'branding-agency-rtl' => array(
	            'title'        => esc_html__( 'Branding Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/branding-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/branding-agency-rtl/' ),
            ),

            'photography-studio-rtl' => array(
	            'title'        => esc_html__( 'Photography Studio RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/photography-studio-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/photography-studio-rtl/' ),
            ),

            'creative-agency-rtl' => array(
	            'title'        => esc_html__( 'Creative Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/creative-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-agency-rtl/' ),
            ),

            'busienss-consultant-agency-rtl' => array(
	            'title'        => esc_html__( 'Business Consulting Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'business','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/busienss-consultant-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/busienss-consultant-agency-rtl/' ),
            ),

            'it-consultancy-agency-rtl' => array(
	            'title'        => esc_html__( 'IT Consulting Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/it-consultancy-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/it-consultancy-agency-rtl/' ),
            ),

            'digital-product-agency-rtl' => array(
	            'title'        => esc_html__( 'Digital Product Agency  RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/digital-product-agency-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/digital-product-agency-rtl/' ),
            ),

            'portfolio-masonry-rtl' => array(
	            'title'        => esc_html__( 'Portfolio Masonry RTL', 'arolax-essential' ),
	            'category'     => [ 'portfolio','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/portfolio-masonry-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio-rtl/portfolio-masonry/' ),
            ),

            'full-width-spring-slider-rtl' => array(
	            'title'        => esc_html__( 'Full Width Spring Slider RTL', 'arolax-essential' ),
	            'category'     => [ 'portfolio','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/full-width-spring-slider-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio-rtl/full-width-spring-slider/' ),
            ),

            'full-width-slicer-slider-rtl' => array(
	            'title'        => esc_html__( 'Full Width Slicer Slider RTL', 'arolax-essential' ),
	            'category'     => [ 'portfolio','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/full-width-slicer-slider-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio-rtl/full-width-slicer-slider/' ),
            ),

            'full-width-shutters-slider-rtl' => array(
	            'title'        => esc_html__( 'Full Width Shutters Slider RTL', 'arolax-essential' ),
	            'category'     => [ 'portfolio','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/full-width-shutters-slider-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio-rtl/full-width-shutters-slider/' ),
            ),

            'full-width-shaders-slider-rtl' => array(
	            'title'        => esc_html__( 'Full Width Shaders Slider RTL', 'arolax-essential' ),
	            'category'     => [ 'portfolio','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/full-width-shaders-slider-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio-rtl/full-width-shaders-slider/' ),
            ),

            'full-width-fashion-slider-rtl' => array(
	            'title'        => esc_html__( 'Full Width Fashion Slider RTL', 'arolax-essential' ),
	            'category'     => [ 'portfolio','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/full-width-fashion-slider-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio-rtl/full-width-fashion-slider/' ),
            ),

            'full-width-carousel-slider-rtl' => array(
	            'title'        => esc_html__( 'Full Width Carousel Slider RTL', 'arolax-essential' ),
	            'category'     => [ 'portfolio','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/full-width-carousel-slider-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio-rtl/full-width-carousel-slider/' ),
            ),

            'card-slider-rtl' => array(
	            'title'        => esc_html__( 'Card Slider RTL', 'arolax-essential' ),
	            'category'     => [ 'portfolio','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/card-slider-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio-rtl/card-slider/' ),
            ),

            'agency-portfolio-rtl' => array(
	            'title'        => esc_html__( 'Agency Portfolio RTL', 'arolax-essential' ),
	            'category'     => [ 'portfolio','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/agency-portfolio-rtl/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/creative-portfolio-rtl/agency-portfolio/' ),
            ),

            'insurance-consultancy-agency-rtl' => array(
	            'title'        => esc_html__( 'Insurance Consultancy Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/insurance-consultancy-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/insurance-consultancy-agency-rtl/' ),
            ),

            'consultant-management-agency-rtl' => array(
	            'title'        => esc_html__( 'Consultant Management Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/consultant-management-agency/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/consultant-management-agency-rtl/' ),
            ),

            'photographer-rtl' => array(
	            'title'        => esc_html__( 'Photographer RTL', 'arolax-essential' ),
	            'category'     => [ 'personal','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/photographer/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/photographer-rtl/' ),
            ),

            'digital-marketer-rtl' => array(
	            'title'        => esc_html__( 'Digital Marketer RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/digital-marketer/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/digital-marketer-rtl/' ),
            ),

            'event-planner-rtl' => array(
	            'title'        => esc_html__( 'Insurance Consultancy Agency RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/event-planner/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/event-planner-rtl/' ),
            ),

            'content-writer-rtl' => array(
	            'title'        => esc_html__( 'Content Writer RTL', 'arolax-essential' ),
	            'category'     => [ 'personal','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/content-writer/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/content-writer-rtl/' ),
            ),

            'freelancer-rtl' => array(
	            'title'        => esc_html__( 'Freelancer RTL', 'arolax-essential' ),
	            'category'     => [ 'personal','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/freelancer/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/freelancer-rtl/' ),
            ),

            'web-developer-rtl' => array(
	            'title'        => esc_html__( 'Web Developer RTL', 'arolax-essential' ),
	            'category'     => [ 'personal','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/web-developer/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/arolax-developer-rtl/' ),
            ),

            'health-coach-rtl' => array(
	            'title'        => esc_html__( 'Health Coach RTL', 'arolax-essential' ),
	            'category'     => [ 'personal','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/health-coach/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/health-coach-rtl/' ),
            ),

            'resume-rtl' => array(
	            'title'        => esc_html__( 'Resume RTL', 'arolax-essential' ),
	            'category'     => [ 'personal','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/resume/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/resume-rtl/' ),
            ),

            'personal-portfolio-rtl' => array(
	            'title'        => esc_html__( 'Personal Portfolio RTL', 'arolax-essential' ),
	            'category'     => [ 'agency','rtl' ],
	            'screenshot'   => esc_url( $demo_content_installer ) . '/personal-portfolio/sc.png',
	            'preview_link' => esc_url( 'https://crowdytheme.com/wp/arolax/personal-portfolio-rtl/' ),
            ),
        );

        $download_url = esc_url( $demo_content_installer ) . '/download.php';
        try {
            foreach ( $demos_array as $id => $data ) {
                $demo		 = new \FW_Ext_Backups_Demo( $id, 'piecemeal', array(
                    'url'		 => $download_url,
                    'file_id'	 => $id,
                ) );
                $category = isset($data[ 'category' ]) ? $data[ 'category' ] : [];
                $demo->set_title( $data[ 'title' ] );
                $demo->set_screenshot( $data[ 'screenshot' ] );
                $demo->set_preview_link( $data[ 'preview_link' ] );
                $demo->set_category( $category );
                $demos[ $demo->get_id() ]	 = $demo;
                unset( $demo );
            }
        } catch (\Exception $e) {
            
        }  
        

        return $demos;
    }
    
    public function success(){
       
        foreach($this->_metas as $key) {
            $value = get_user_meta(1, $key, true);
            update_option( $key, $value );
        }
    }

}

new Wcf_Theme_Demos();





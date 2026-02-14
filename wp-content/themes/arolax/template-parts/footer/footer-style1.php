<?php
  
  $copyright_text = arolax_option('copyright_text','© 2022 - 2024 | Alrights reserved <br> by crowdyTheme');
  $logo           = arolax_option('footer_logo',AROLAX_ASSETS.'imgs/logo/site-logo-white.png');
  
  if($logo == ''){
      $logo = AROLAX_ASSETS.'imgs/logo/site-logo-white.png';
  }
  
  $is_sidebar_active = is_active_sidebar('footer-one') || is_active_sidebar('footer-two');
  
 ?>
 <!-- Footer section start -->
 <footer class="footer__area jfooter-wrapper <?php echo esc_attr($is_sidebar_active ? 'pt-120 pb-50' :'pt-20 pb-20'); ?>">
    <div class="container">
       <div class="row">
         <?php if(is_active_sidebar('footer-one')): ?>
             <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3">
               <?php dynamic_sidebar( 'footer-one' ); ?>
             </div>
         <?php endif; ?>
         <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9">
           <?php if(is_active_sidebar('footer-two')): ?>
           <div class="footer__info-3">
             <?php dynamic_sidebar( 'footer-two' ); ?>
           </div>
           <?php endif; ?>
           <div class="footer__btm-3">
            <?php if($logo): ?>
                 <div class="footer__logo-3">
                   <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url($logo) ?>" alt="<?php echo esc_attr__('Footer Logo','arolax') ?>"></a>
                 </div>
             <?php endif; ?>
             <div class="copyright jcopyright">
               <p><?php echo arolax_kses($copyright_text); ?></p>
             </div>
           </div>
         </div>
       </div>
    </div>
</footer>
 <!-- Footer section end -->
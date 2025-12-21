<?php
/* Smarty version 3.1.48, created on 2025-10-27 11:57:30
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_68ff501a033769_66284320',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0986be76243f6fbd6c9ae6b5398f16f3000afc05' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/footer.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ff501a033769_66284320 (Smarty_Internal_Template $_smarty_tpl) {
?> <?php if ($_smarty_tpl->tpl_vars['filename']->value != 'cloud-hosting' && $_smarty_tpl->tpl_vars['filename']->value != 'dedicated-server' && $_smarty_tpl->tpl_vars['filename']->value != 'domain-search' && $_smarty_tpl->tpl_vars['filename']->value != 'legal-agreement' && $_smarty_tpl->tpl_vars['filename']->value != 'privacy-policy' && $_smarty_tpl->tpl_vars['filename']->value != 'reseller-hosting' && $_smarty_tpl->tpl_vars['filename']->value != 'shared-hosting' && $_smarty_tpl->tpl_vars['filename']->value != 'transfer-domain' && $_smarty_tpl->tpl_vars['filename']->value != 'vps-server' && $_smarty_tpl->tpl_vars['filename']->value != 'wordpress-hosting' && $_smarty_tpl->tpl_vars['filename']->value != 'business-email' && $_smarty_tpl->tpl_vars['filename']->value != 'codeguard' && $_smarty_tpl->tpl_vars['filename']->value != 'domain-promos' && $_smarty_tpl->tpl_vars['filename']->value != 'enterprise-email' && $_smarty_tpl->tpl_vars['filename']->value != 'google-workspace' && $_smarty_tpl->tpl_vars['filename']->value != 'sitelock' && $_smarty_tpl->tpl_vars['filename']->value != 'about-us' && $_smarty_tpl->tpl_vars['filename']->value != 'contact' && $_smarty_tpl->tpl_vars['filename']->value != 'ssl-certificates') {
if ($_smarty_tpl->tpl_vars['templatefile']->value == 'homepage') {
} else { ?>
</div>
<!-- /.main-content -->

<div class="clearfix"></div>
</div>
</div>
</section>
<?php }
}?>





<?php if ($_smarty_tpl->tpl_vars['filename']->value != 'cloud-hosting' && $_smarty_tpl->tpl_vars['filename']->value != 'dedicated-server' && $_smarty_tpl->tpl_vars['filename']->value != 'domain-search' && $_smarty_tpl->tpl_vars['filename']->value != 'legal-agreement' && $_smarty_tpl->tpl_vars['filename']->value != 'privacy-policy' && $_smarty_tpl->tpl_vars['filename']->value != 'reseller-hosting' && $_smarty_tpl->tpl_vars['filename']->value != 'shared-hosting' && $_smarty_tpl->tpl_vars['filename']->value != 'transfer-domain' && $_smarty_tpl->tpl_vars['filename']->value != 'vps-server' && $_smarty_tpl->tpl_vars['filename']->value != 'wordpress-hosting' && $_smarty_tpl->tpl_vars['filename']->value != 'business-email' && $_smarty_tpl->tpl_vars['filename']->value != 'codeguard' && $_smarty_tpl->tpl_vars['filename']->value != 'domain-promos' && $_smarty_tpl->tpl_vars['filename']->value != 'enterprise-email' && $_smarty_tpl->tpl_vars['filename']->value != 'google-workspace' && $_smarty_tpl->tpl_vars['filename']->value != 'sitelock' && $_smarty_tpl->tpl_vars['filename']->value != 'about-us' && $_smarty_tpl->tpl_vars['filename']->value != 'contact' && $_smarty_tpl->tpl_vars['filename']->value != 'ssl-certificates') {
if ($_smarty_tpl->tpl_vars['templatefile']->value == 'homepage') {
} else { ?>
<div id="fullpage-overlay" class="hidden">
  <div class="outer-wrapper">
    <div class="inner-wrapper"> <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/assets/img/overlay-spinner.svg"> <br>
      <span class="msg"></span> </div>
  </div>
</div>
<div class="modal system-modal fade" id="modalAjax" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">&times;</span> <span class="sr-only"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['close'];?>
</span> </button>
      </div>
      <div class="modal-body"> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['loading'];?>
 </div>
      <div class="modal-footer">
        <div class="pull-left loader"> <i class="fas fa-circle-notch fa-spin"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['loading'];?>
 </div>
        <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['close'];?>
 </button>
        <button type="button" class="btn btn-primary-two modal-submit"> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['submit'];?>
 </button>
      </div>
    </div>
  </div>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/generate-password.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}?>

<?php echo $_smarty_tpl->tpl_vars['footeroutput']->value;?>




<footer class="footer-main">
   <div class="container">
       <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-5 g-3 gy-4">
           <div class="col">
               <div class="footer-list">
                   <h5>Domains</h5>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/domain-search.php">Domain Search</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php?action=domains">My Domains</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart/domain/renew">Renew Domains</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/transfer-domain.php">Transfer your Domain</a>
                   
                   
               </div>
           </div>
           <div class="col">
               <div class="footer-list">
                   <h5>Hosting</h5>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/shared-hosting.php">Linux Hosting</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/wordpress-hosting.php">WordPress Hosting</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/reseller-hosting.php">Linux Reseller Hosting</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/dedicated-server.php">Dedicated Servers</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cloud-hosting.php">Cloud Hosting</a>
                   
               </div>
           </div>
           <div class="col">
               <div class="footer-list">
                   <h5>Email & Security</h5>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/business-email.php">Business Email</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/enterprise-email.php">Enterprices Email</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/google-workspace.php">Google Workspace</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/ssl-certificates.php">SSl Certificate</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/sitelock.php">Sitelock</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/codeguard.php">Codeguard Website Backup</a>
               </div>
           </div>

           <div class="col">
               <div class="footer-list">
                   <h5>Infrastructure</h5>
                   <a href="#">Datacenter Details</a>
                   <a href="#">Hosting Security</a>
                   <a href="#">24 x 7 Servers Monitoring</a>
                   <a href="#">Backup and Recovery</a>
               </div>
           </div>
           <div class="col">
               <div class="footer-list">
                   <h5>Support</h5>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/knowledgebase">View Knowledge Base</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php">Contact Support</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php">Report Abuse</a>
                   <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php">Join Reseller Program</a>
                   
               </div>
           </div>
       </div>
       <div class="row">
           <div class="col-12 mt-5 mb-3 py-3 border-top border-bottom">
               <div class="row justify-content-between align-items-center gy-3 gy-lg-0">
                   <div class="col-lg-4">
                       <!-- logo -->
                       <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/index.php" class="footer-logo">
                           <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/logo_white.png" alt="logo">
                       </a>
                       <!-- company info -->
                       <p class="company-info">Unlimited Domain & Hosting in One Platform A ton of website hosting options, 99.9% uptime guarantee, free SSL certificate, easy WordPress installs.</p>
                   </div>
                   <div class="col-lg-6">
                       <div
                           class="align-items-center footer-social-media justify-content-center justify-content-lg-end">
                           <!-- Facebook icon -->
                           <a href="" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" height="16"
                                   width="10" viewBox="0 0 320 512">
                                   <path
                                       d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z">
                                   </path>
                               </svg></a>
                               <!-- Twitter icon -->
                           <a href="" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" height="16"
                                   width="16" viewBox="0 0 512 512">
                                   <path
                                       d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z">
                                   </path>
                               </svg></a>
                               <!-- Instagram icon -->
                           <a href="" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" height="16"
                                   width="14" viewBox="0 0 448 512">
                                   <path
                                       d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                   </path>
                               </svg></a>
                               <!-- Youtube icon -->
                           <a href="" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" height="16"
                                   width="18" viewBox="0 0 576 512">
                                   <path
                                       d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z">
                                   </path>
                               </svg></a>
                               <!-- Linkedin icon -->
                           <a href="" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" height="16"
                                   width="14" viewBox="0 0 448 512">
                                   <path
                                       d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z">
                                   </path>
                               </svg></a>
                               <!-- Blogger icon -->
                           <a href="" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" height="16"
                                   width="14" viewBox="0 0 448 512">
                                   <path
                                       d="M446.6 222.7c-1.8-8-6.8-15.4-12.5-18.5-1.8-1-13-2.2-25-2.7-20.1-.9-22.3-1.3-28.7-5-10.1-5.9-12.8-12.3-12.9-29.5-.1-33-13.8-63.7-40.9-91.3-19.3-19.7-40.9-33-65.5-40.5-5.9-1.8-19.1-2.4-63.3-2.9-69.4-.8-84.8 .6-108.4 10C45.9 59.5 14.7 96.1 3.3 142.9 1.2 151.7 .7 165.8 .2 246.8c-.6 101.5 .1 116.4 6.4 136.5 15.6 49.6 59.9 86.3 104.4 94.3 14.8 2.7 197.3 3.3 216 .8 32.5-4.4 58-17.5 81.9-41.9 17.3-17.7 28.1-36.8 35.2-62.1 4.9-17.6 4.5-142.8 2.5-151.7zm-322.1-63.6c7.8-7.9 10-8.2 58.8-8.2 43.9 0 45.4 .1 51.8 3.4 9.3 4.7 13.4 11.3 13.4 21.9 0 9.5-3.8 16.2-12.3 21.6-4.6 2.9-7.3 3.1-50.3 3.3-26.5 .2-47.7-.4-50.8-1.2-16.6-4.7-22.8-28.5-10.6-40.8zm191.8 199.8l-14.9 2.4-77.5 .9c-68.1 .8-87.3-.4-90.9-2-7.1-3.1-13.8-11.7-14.9-19.4-1.1-7.3 2.6-17.3 8.2-22.4 7.1-6.4 10.2-6.6 97.3-6.7 89.6-.1 89.1-.1 97.6 7.8 12.1 11.3 9.5 31.2-4.9 39.4z">
                                   </path>
                               </svg></a>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="row align-items-center">
           <div class="col-12">
               <ul class="legal-link my-2 mb-3">
                   <li><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/about-us.php">About us</a></li>
                   <li><a href="#">Blog</a></li>
                   <li><a href="#">Sitemap</a></li>
                   <li><a href="#">Careers</a></li>
                   <li><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/legal-agreement.php">Legal Agreements</a></li>
                   <li><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/privacy-policy.php">Privacy Policy</a></li>
                   <li><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/index.php?rp=/login">Login</a></li>
                   <li><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php">Contact Us</a></li>
                   <li><a href="#">Payment Option</a></li>
               </ul>
           </div>
       </div>
       <div class="row align-items-center pt-2">
           <div class="col-12 text-center copyright-text"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"copyrightFooterNotice",'year'=>$_smarty_tpl->tpl_vars['date_year']->value,'company'=>$_smarty_tpl->tpl_vars['companyname']->value),$_smarty_tpl ) );?>
</div>
           <div class="col-12 col-lg-6">
           </div>
       </div>
   </div>
</footer>

<!-- Back to top button -->
<button id="scrolltoTop" class="scroll-top d-flex align-items-center justify-content-center"><i
       class="bi bi-arrow-up-short"></i></button>
<!-- loader -->
<div id="preloader">
   <div class="custom-loader"></div>
</div>



<!-- carousel js -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/vendor/swiper/swiper-bundle.min.js"><?php echo '</script'; ?>
>
<!-- pure counter JS File -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/vendor/purecounter/purecounter_vanilla.js"><?php echo '</script'; ?>
>
<!-- Main JS File -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/js/theme.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/js/main.js"><?php echo '</script'; ?>
>


<!-- WHMCS Custom js -->

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/js/custom.js"><?php echo '</script'; ?>
>
<!-- End WHMCS Custom js -->



</body></html>

<?php }
}

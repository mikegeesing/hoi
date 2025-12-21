 {if $filename != 'cloud-hosting'
&& $filename != 'dedicated-server'
&& $filename != 'domain-search'
&& $filename != 'legal-agreement'
&& $filename != 'privacy-policy'
&& $filename != 'reseller-hosting'
&& $filename != 'shared-hosting'
&& $filename != 'transfer-domain'
&& $filename != 'vps-server'
&& $filename != 'wordpress-hosting'
&& $filename != 'business-email'
&& $filename != 'codeguard'
&& $filename != 'domain-promos'
&& $filename != 'enterprise-email'
&& $filename != 'google-workspace'
&& $filename != 'sitelock'
&& $filename != 'about-us'
&& $filename != 'contact'
&& $filename != 'ssl-certificates'}
{if $templatefile == 'homepage'}
{else}
</div>
<!-- /.main-content -->

<div class="clearfix"></div>
</div>
</div>
</section>
{/if}{/if}





{if $filename != 'cloud-hosting'
&& $filename != 'dedicated-server'
&& $filename != 'domain-search'
&& $filename != 'legal-agreement'
&& $filename != 'privacy-policy'
&& $filename != 'reseller-hosting'
&& $filename != 'shared-hosting'
&& $filename != 'transfer-domain'
&& $filename != 'vps-server'
&& $filename != 'wordpress-hosting'
&& $filename != 'business-email'
&& $filename != 'codeguard'
&& $filename != 'domain-promos'
&& $filename != 'enterprise-email'
&& $filename != 'google-workspace'
&& $filename != 'sitelock'
&& $filename != 'about-us'
&& $filename != 'contact'
&& $filename != 'ssl-certificates'}
{if $templatefile == 'homepage'}
{else}
<div id="fullpage-overlay" class="hidden">
  <div class="outer-wrapper">
    <div class="inner-wrapper"> <img src="{$WEB_ROOT}/assets/img/overlay-spinner.svg"> <br>
      <span class="msg"></span> </div>
  </div>
</div>
<div class="modal system-modal fade" id="modalAjax" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">&times;</span> <span class="sr-only">{$LANG.close}</span> </button>
      </div>
      <div class="modal-body"> {$LANG.loading} </div>
      <div class="modal-footer">
        <div class="pull-left loader"> <i class="fas fa-circle-notch fa-spin"></i> {$LANG.loading} </div>
        <button type="button" class="btn btn-default" data-dismiss="modal"> {$LANG.close} </button>
        <button type="button" class="btn btn-primary-two modal-submit"> {$LANG.submit} </button>
      </div>
    </div>
  </div>
</div>
{include file="$template/includes/generate-password.tpl"}
{/if}{/if}

{$footeroutput}



<footer class="footer-main">
   <div class="container">
       <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-5 g-3 gy-4">
           <div class="col">
               <div class="footer-list">
                   <h5>Domeinen</h5>
                   <a href="{$WEB_ROOT}/domain-search.php">Domein zoeken</a>
                   <a href="{$WEB_ROOT}/clientarea.php?action=domains">Mijn domeinen</a>
                   <a href="{$WEB_ROOT}/cart/domain/renew">Domeinen verlengen</a>
                   <a href="{$WEB_ROOT}/transfer-domain.php">Domein verhuizen</a>
                   
                   
               </div>
           </div>
           <div class="col">
               <div class="footer-list">
                   <h5>Hosting</h5>
                   <a href="{$WEB_ROOT}/shared-hosting.php">Linux-hosting</a>
                   <a href="{$WEB_ROOT}/wordpress-hosting.php">WordPress hosting</a>
                   <a href="{$WEB_ROOT}/reseller-hosting.php">Linux-reseller hosting</a>
                   <a href="{$WEB_ROOT}/dedicated-server.php">Dedicated servers</a>
                   <a href="{$WEB_ROOT}/cloud-hosting.php">Cloud hosting</a>
                   
               </div>
           </div>
           <div class="col">
               <div class="footer-list">
                   <h5>E-mail & beveiliging</h5>
                   <a href="{$WEB_ROOT}/business-email.php">Zakelijke e-mail</a>
                   <a href="{$WEB_ROOT}/enterprise-email.php">Enterprise e-mail</a>
                   <a href="{$WEB_ROOT}/google-workspace.php">Google Workspace</a>
                   <a href="{$WEB_ROOT}/ssl-certificates.php">SSL-certificaat</a>
                   <a href="{$WEB_ROOT}/sitelock.php">Sitelock</a>
                   <a href="{$WEB_ROOT}/codeguard.php">CodeGuard website back-up</a>
               </div>
           </div>

           <div class="col">
               <div class="footer-list">
                   <h5>Infrastructuur</h5>
                   <a href="#">Datacenter details</a>
                   <a href="#">Hosting beveiliging</a>
                   <a href="#">24 x 7 servers monitoring</a>
                   <a href="#">Back-up en herstel</a>
               </div>
           </div>
           <div class="col">
               <div class="footer-list">
                   <h5>Ondersteuning</h5>
                   <a href="{$WEB_ROOT}/knowledgebase">Bekijk kennisbank</a>
                   <a href="{$WEB_ROOT}/contact.php">Contacteer ondersteuning</a>
                   <a href="{$WEB_ROOT}/contact.php">Misbruik rapporteren</a>
                   <a href="{$WEB_ROOT}/contact.php">Doe mee aan reseller-programma</a>
                   
               </div>
           </div>
       </div>
       <div class="row">
           <div class="col-12 mt-5 mb-3 py-3 border-top border-bottom">
               <div class="row justify-content-between align-items-center gy-3 gy-lg-0">
                   <div class="col-lg-4">
                       <!-- logo -->
                       <a href="{$WEB_ROOT}/index.php" class="footer-logo">
                           <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/logo_white.png" alt="logo">
                       </a>
                       <!-- company info -->
                       <p class="company-info">Onbeperkte domeinen & hosting in één platform. Veel webhostingopties, 99,9% uptime garantie, gratis SSL-certificaat, eenvoudig WordPress installeren.</p>
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
                   <li><a href="{$WEB_ROOT}/about-us.php">Over ons</a></li>
                   <li><a href="#">Blog</a></li>
                   <li><a href="#">Sitemap</a></li>
                   <li><a href="#">Carrières</a></li>
                   <li><a href="{$WEB_ROOT}/legal-agreement.php">Juridische overeenkomsten</a></li>
                   <li><a href="{$WEB_ROOT}/privacy-policy.php">Privacybeleid</a></li>
                   <li><a href="{$WEB_ROOT}/index.php?rp=/login">Inloggen</a></li>
                   <li><a href="{$WEB_ROOT}/contact.php">Neem contact met ons op</a></li>
                   <li><a href="#">Betalingsoptie</a></li>
               </ul>
           </div>
       </div>
       <div class="row align-items-center pt-2">
           <div class="col-12 text-center copyright-text">{lang key="copyrightFooterNotice" year=$date_year company=$companyname}</div>
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
<script src="{$WEB_ROOT}/templates/{$template}/custom/assets/vendor/swiper/swiper-bundle.min.js"></script>
<!-- pure counter JS File -->
<script src="{$WEB_ROOT}/templates/{$template}/custom/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<!-- Main JS File -->
<script src="{$WEB_ROOT}/templates/{$template}/custom/assets/js/theme.js"></script>
<script src="{$WEB_ROOT}/templates/{$template}/custom/assets/js/main.js"></script>


<!-- WHMCS Custom js -->

<script src="{$WEB_ROOT}/templates/{$template}/js/custom.js"></script>
<!-- End WHMCS Custom js -->



</body></html>


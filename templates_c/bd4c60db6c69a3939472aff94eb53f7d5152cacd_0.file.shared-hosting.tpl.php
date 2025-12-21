<?php
/* Smarty version 3.1.48, created on 2025-12-21 16:03:27
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/shared-hosting.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69481a4fdee682_16437211',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd4c60db6c69a3939472aff94eb53f7d5152cacd' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/shared-hosting.tpl',
      1 => 1766333006,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69481a4fdee682_16437211 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1>Shared Hosting - Eenvoudig en betrouwbaar</h1>
            <ul class="banner-list mb-2">
              <li>Flexibel, gebruiksvriendelijk controlepaneel</li>
              <li>Onbeperkte bandbreedte</li>
              <li>99% uptime garantie</li>
              <li>30 dagen geld-terug-garantie</li>
            </ul> <?php if (count($_smarty_tpl->tpl_vars['sharedhostingproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['sharedhostingproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['sharedhostingproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['sharedhostingproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['sharedhostingproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sharedhostingproducts']->value, 'myproduct', false, 'productKey');
$_smarty_tpl->tpl_vars['myproduct']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['productKey']->value => $_smarty_tpl->tpl_vars['myproduct']->value) {
$_smarty_tpl->tpl_vars['myproduct']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['productKey']->value == 0) {?> <h4>Vanaf <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['monthly'];?>
/mnd</h4> <?php }?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?> <div class="inline-btns mt-3">
              <a class="btn-01" onclick="document.getElementById('Plans').scrollIntoView();">Nu starten</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
          <div class="text-center text-lg-end">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/8.svg" alt="Banner image" width="500">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="top-up-banner pb-4" id="Plans">
  <div class="container upside rounded bg-white shadow p-4">
    <div class="row justify-content-center">
      <div class="col-10 col-sm-8 col-md-7">
        <div class="text-center mb-4 radio-box-wrap billingCycle">
          <div class="single-radio-box">
            <input name="billingPlan" id="monthly-plan" value="monthly" class="radio" type="radio" checked>
            <label for="monthly-plan">
              <span class="custom-check"></span> Maandelijks </label>
          </div>
          <div class="single-radio-box">
            <input name="billingPlan" id="yearly-plan" value="yearly" class="radio" type="radio">
            <label for="yearly-plan">
              <span class="custom-check"></span> Jaarlijks </label>
          </div>
          <div class="single-radio-box">
            <input name="billingPlan" id="biannual-plan" value="biannual" class="radio" type="radio">
            <label for="biannual-plan">
              <span class="custom-check"></span> Tweejaarlijks </label>
          </div>
          <div class="single-radio-box">
            <input name="billingPlan" id="triennial-plan" value="triennial" class="radio" type="radio">
            <label for="triennial-plan">
              <span class="custom-check"></span> Driejaarlijks </label>
          </div>
        </div>
      </div>
    </div>
    <div class="row gy-4 gy-xl-0 justify-content-between"> <?php if (count($_smarty_tpl->tpl_vars['sharedhostingproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['sharedhostingproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['sharedhostingproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['sharedhostingproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['sharedhostingproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sharedhostingproducts']->value, 'myproduct', false, 'productKey');
$_smarty_tpl->tpl_vars['myproduct']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['productKey']->value => $_smarty_tpl->tpl_vars['myproduct']->value) {
$_smarty_tpl->tpl_vars['myproduct']->do_else = false;
?> <div class="col-lg-5 col-xl-4 col-md-6">
        <div class="pricing-item">
          <div class="pricing-heading">
            <div class="name"><?php echo $_smarty_tpl->tpl_vars['myproduct']->value['name'];?>
 </div>
            <div class="monthly-price">
              <h4 class="title "> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['monthly'];?>
 <span class="durection">/maand</span>
              </h4>
            </div>
            <div class="yearly-price">
              <h4 class="title "> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['annually'];?>
 <span class="durection">/jaar</span>
              </h4>
            </div>
            <div class="biannual-price">
              <h4 class="title "> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['biennially'];?>
 <span class="durection">/2 jaar</span>
              </h4>
            </div>
            <div class="triennial-price">
              <h4 class="title "> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['triennially'];?>
 <span class="durection">/3 jaar</span>
              </h4>
            </div>
          </div>
          <div class="pricing_body">
            <ul> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['description'];?>
 </ul>
            <a class="btn-01 d-block mt-3 w-100" href="cart.php?a=add&pid=<?php echo $_smarty_tpl->tpl_vars['myproduct']->value['relid'];?>
">Selecteer pakket</a>
          </div>
        </div>
      </div> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> <?php }?> </div>
  </div>
</section>
<section class="section-gap">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-8 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2> Just what you need for a Basic Web Presence</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Unlimited storage, unmetered bandwidth, unbeatable hosting. This gator's got ya covered. And we'll throw in a free domain for a year, too. </p>
        </div>
      </div>
    </div>
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>01</span>
          </div>
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/page_optimization.png" alt="services icon">
          </div>
          <h4>Lightning Fast Website</h4>
          <p>Our web application accelerator, powered by Varnish Cache, ensures the maximum performance of your website at all times!</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>02</span>
          </div>
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/mail.png" alt="services icon">
          </div>
          <h4>Email included</h4>
          <p>Advanced email management features in cPanel allow you manage your emails, mailing lists and more without any hassles.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>03</span>
          </div>
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/tools.png" alt="services icon">
          </div>
          <h4>cPanel for Management</h4>
          <p>cPanel, an intuitive and powerful control panel, is available on all plans which makes your hosting package management a breeze!</p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-gap">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-7 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2>Why choose Linux Shared Web Hosting</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Linux Shared Web Hosting offers cost-effective, reliable hosting with robust security, customizable features, and compatibility with popular web technologies.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <ul class="feature-list">
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/page_optimization.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Lightning Fast Websites</h3>
              <p>Super-quick page loads</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/tools.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Free DirectAdmin</h3>
              <p>Linux Web Hosting Management simplified</p>
            </div>
          </li>
          <li class="list-item ">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/html.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>SNI enabled</h3>
              <p>SSL certificate installation made easy</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/helpdesk.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>24x7 Support</h3>
              <p>Your websites are our priority, we are here to serve you</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/click.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Easy 1-click-installer</h3>
              <p>400+ ready-to-install apps powered by Softaculous </p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/internet.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Enhanced Security</h3>
              <p>CloudFlare Protection for your business from threats</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/discount.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Easy Upgrades</h3>
              <p>Increase resources as per your need</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/settings_icon.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Secure Shell Access</h3>
              <p>Access your Linux Shared Hosting over an encrypted channel</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/server.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>PHP, MySQL, Ruby &amp; more</h3>
              <p>Supports leading Server Scripting languages &amp; frameworks</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/website.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Free Website Migrations</h3>
              <p>Move your web hosting to us, with help from our experts</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section class="section-gap section-bg bg1">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-8 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2> Install a Shopping Cart, Photo Gallery</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>a Blog or any other module in just 1 click 50+ Plugins - Powered by Softaculous</p>
        </div>
      </div>
    </div>
    <div class="overflow-auto pt-3 pb-2 pb-sm-3 pb-lg-4">
      <div class="just-one-click-images">
        <div class="just-one-click">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/wordpress_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/joomla_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/limeservey_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/coppermine_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/phpbb_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/zencart_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/osticket_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/drupal_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/phplist_image.png" alt="Just one click image">
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-gap">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-8 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2>Technical Specifications</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Linux Shared Hosting Technical Specifications</p>
        </div>
      </div>
    </div>
    <div class="row gy-4 gy-lg-0">
      <div class="col-lg-3 col-md-6">
        <div class="underhood-content">
          <h4>Software</h4>
          <ul>
            <li>Softaculous</li>
            <li>Perl</li>
            <li>Python 2.7 and 3.6</li>
            <li>PHP 8.3, 8.2 & 8.1</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="underhood-content">
          <h4>Databases</h4>
          <ul>
            <li>MySQL Client</li>
            <li>phpMyAdmin 5.2.1</li>
            <li>MySQL admin tools</li>
            <li>MSSQL Stored Procedures</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="underhood-content">
          <h4>Additional Software</h4>
          <ul>
            <li>Zend Engine</li>
            <li>Zend Optimizer</li>
            <li>Zend Guard Loader</li>
            <li>ionCube Loader</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="underhood-content">
          <h4>Security</h4>
          <ul>
            <li>Password protected folders</li>
            <li>Hotlink Protection</li>
            <li>Leech Protection</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <button class="btn-01 mt-4" data-bs-toggle="modal" data-bs-target="#underhoodModal">View All Tech Specs</button>
        <div class="modal fade" id="underhoodModal" tabindex="-1" aria-labelledby="underhoodModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title fs-5" id="underhoodModalLabel">Technical Specifications</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row gy-4 gy-lg-0">
                  <div class="col-lg-3 col-md-6">
                    <div class="underhood-content">
                      <h4>Software</h4>
                      <ul>
                        <li>Softaculous</li>
                        <li>Perl</li>
                        <li>Python 2.7 and 3.6</li>
                        <li>PHP 8.3, 8.2 & 8.1</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="underhood-content">
                      <h4>Databases</h4>
                      <ul>
                        <li>MySQL Client</li>
                        <li>phpMyAdmin 5.2.1</li>
                        <li>MySQL admin tools</li>
                        <li>MSSQL Stored Procedures</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="underhood-content">
                      <h4>Additional Software</h4>
                      <ul>
                        <li>Zend Engine</li>
                        <li>Zend Optimizer</li>
                        <li>Zend Guard Loader</li>
                        <li>ionCube Loader</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="underhood-content">
                      <h4>Security</h4>
                      <ul>
                        <li>Password protected folders</li>
                        <li>Hotlink Protection</li>
                        <li>Leech Protection</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-gap section-bg bg1">
  <div class="container">
    <div class="d-none d-lg-block px-lg-5">
      <div class="row">
        <div class="col-12">
          <div class="big-screen-tab six-coloumn">
            <button class="tabing-buttons active" data-target="tab1">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/tools.png" alt="img">Free DirectAdmin </button>
            <button class="tabing-buttons" data-target="tab2">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/click.png" alt="img">400+ Apps </button>
            <button class="tabing-buttons" data-target="tab3">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/website.png" alt="img">Free Website Transfers </button>
            <button class="tabing-buttons" data-target="tab4">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/mail.png" alt="img">Email Hosting included </button>
            <button class="tabing-buttons" data-target="tab5">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/page_optimization.png" alt="img">Boost website speed </button>
            <button class="tabing-buttons" data-target="tab6">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/server.png" alt="img">Build in PHP/MySQL </button>
          </div>
        </div>
      </div>
    </div>
    <div class="mob-screen-tabs px-lg-5">
      <div class="items">
        <button class="tabing-buttons active" data-target="tab1">Shared Web Hosting with Free DirectAdmin</button>
        <div class="tabing-contents active" id="tab1">
          <div class="row align-items-center gy-4 gy-lg-0 justify-content-between">
            <div class="col-lg-6">
              <div class="section-head">
                <h2 class="d-none d-lg-block">Shared Web Hosting with Free DirectAdmin</h2>
                <p class="mb-3 mb-lg-0 text-start">All Linux Shared Hosting Plans come with DirectAdmin, to make hosting easy for everyone. Setting-up addon domains, Emails, FTP and Databases is convenient with our FREE DirectAdmin.</p>
              </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
              <div class="text-center">
                <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/9.svg" alt="images" width="350">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="items">
        <button class="tabing-buttons" data-target="tab2">400+ Apps on your Linux Hosting</button>
        <div class="tabing-contents" id="tab2">
          <div class="row align-items-center gy-4 gy-lg-0 justify-content-between">
            <div class="col-lg-6">
              <div class="section-head">
                <h2 class="d-none d-lg-block">400+ Apps on your Linux Hosting</h2>
                <p class="mb-3 mb-lg-0 text-start">Installing, updating or even rolling back changes to your blog, website or E-commerce site was never this easy! Our Linux Shared web hosting comes installed with Softaculus that powers 1-click install of over 400 applications. Here are some of our popular CMS platforms: WordPress, Joomla, Drupal. </p>
              </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
              <div class="text-center">
                <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/10.svg" alt="images" width="350">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="items">
        <button class="tabing-buttons" data-target="tab3">Free Website Transfers</button>
        <div class="tabing-contents" id="tab3">
          <div class="row align-items-center gy-4 gy-lg-0 justify-content-between">
            <div class="col-lg-6">
              <div class="section-head">
                <h2 class="d-none d-lg-block">Free Website Transfers</h2>
                <p class="mb-3 mb-lg-0 text-start">Moving your website from another Web Host? Chat with us and our Account Manager will do the cPanel to cPanel website migration for you, completely Free of charge! Also, you can upgrade between plans on Linux Shared Hosting by yourself from your panel.</p>
              </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
              <div class="text-center">
                <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/11.svg" alt="images" width="350">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="items">
        <button class="tabing-buttons" data-target="tab4">Free email with Linux Shared Hosting</button>
        <div class="tabing-contents" id="tab4">
          <div class="row align-items-center gy-4 gy-lg-0 justify-content-between">
            <div class="col-lg-6">
              <div class="section-head">
                <h2 class="d-none d-lg-block">Free email with Linux Shared Hosting</h2>
                <p class="mb-3 mb-lg-0 text-start">Access your emails from anywhere as it comes with POP3 and IMAP support along with a sleek webmail interface on all our Linux Shared Hosting plans. Our email hosting is compatible with all desktop clients.</p>
              </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
              <div class="text-center">
                <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/12.svg" alt="images" width="350">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="items">
        <button class="tabing-buttons" data-target="tab5">Boost website speed</button>
        <div class="tabing-contents" id="tab5">
          <div class="row align-items-center gy-4 gy-lg-0 justify-content-between">
            <div class="col-lg-6">
              <div class="section-head">
                <h2 class="d-none d-lg-block">Boost website speed</h2>
                <p class="mb-3 mb-lg-0 text-start">Make your website up to 1000% faster with Varnish Caching. Varnish gives your website a performance boost using state-of-the-art caching layer for static websites. With Varnish caching enabled on our Linux Hosting Plans, you can Increase the chances of your website moving up in ranking on search engines due to faster load times.</p>
              </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
              <div class="text-center">
                <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/13.svg" alt="images" width="450">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="items">
        <button class="tabing-buttons" data-target="tab6">Build in PHP/MySQL</button>
        <div class="tabing-contents" id="tab6">
          <div class="row align-items-center gy-4 gy-lg-0 justify-content-between">
            <div class="col-lg-6">
              <div class="section-head">
                <h2 class="d-none d-lg-block">Build in PHP/MySQL</h2>
                <p class="mb-3 mb-lg-0 text-start">Code in a wide array of languages like PHP, Ruby, PERL, Python, MySQL and more to build your websites. Our Linux Shared Web hosting enables you to build scalable, powerful applications that delight your audience. If you are looking to code in Windows OS, you can also choose our Windows Shared Hosting plans.</p>
              </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
              <div class="text-center">
                <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/14.svg" alt="images" width="450">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php echo '<script'; ?>
>
  $(document).ready(function() {
    $('.tabing-buttons').on('click', function() {
      var target = $(this).data('target');
      $('.tabing-buttons').removeClass('active');
      $(this).addClass('active');
      $('.tabing-contents').slideUp();
      $('#' + target).slideDown();
    });
  });
<?php echo '</script'; ?>
>
<section class="section-gap">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-7 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2>Frequently Asked Question</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Answers to Your Most Commonly Asked Questions (FAQs) – Find Help Here!</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <ul class="accordion">
          <li>
            <a> What is Shared Web hosting? </a>
            <p>In Shared Web Hosting, multiple clients are hosted on a single server i.e. the clients share the server's resources. This helps reduce the cost, since the cost of the server and its resources are spread over all the clients/packages hosted on the server. Shared Hosting is perfect for personal websites, small and mid-sized businesses that do not require all the resources of a server. </p>
          </li>
          <li>
            <a> Can I host multiple Web sites within one Shared Hosting plan? </a>
            <p>Yes! Our Pro and Business shared hosting plans allow you to host more than one Website, by adding secondary domains through your hosting control panel i.e. cPanel. </p>
          </li>
          <li>
            <a> Is there a Money Back Guarantee? </a>
            <p>Yes, we offer a 100% Risk Free, 30 day Money Back Guarantee. </p>
          </li>
          <li>
            <a> Is Email hosting included in my package? </a>
            <p>Yes, all our Hosting packages come with Unlimited Email Hosting. </p>
          </li>
          <li>
            <a> Can I upgrade to a higher plan? </a>
            <p>Yes, you can easily upgrade to one of our higher plans at any time. </p>
          </li>
          <li>
            <a> Is my data safe? Do you take backups?</a>
            <p>Yes, your data is a 100% secure and is backed-up every 5 days. </p>
          </li>
          <li>
            <a> Do you include protection from viruses? </a>
            <p>Yes, all our servers are protected by Clam AV. </p>
          </li>
          <li>
            <a> Can I divide my Shared Hosting package and resell it? </a>
            <p>While a Shared Hosting package cannot be used for this purpose, you can easily resell custom packages with our Reseller Hosting. To view our Reseller Hosting plans, <a href="reseller-hosting.html">click here.</a>
            </p>
          </li>
          <li>
            <a> Do you offer SSH access? </a>
            <p>Yes, we provide SSH access to your domain. Because this is a shared environment, you will not get root access. However, you will be able to achieve most of your requirements by having the rights to access only the files relevant to your domain. </p>
          </li>
          <li>
            <a> Who do I get in touch with if I need help? </a>
            <p>Our Support team is always at hand to assist you. You can take a look at all our contact details <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php">here.</a>
            </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section><?php }
}

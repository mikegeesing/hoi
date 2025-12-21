<?php
/* Smarty version 3.1.48, created on 2025-12-21 16:06:42
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/wordpress-hosting.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69481b129935d2_85628078',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '39c7e371df3433a3949d212306e978588f2df01f' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/wordpress-hosting.tpl',
      1 => 1766333063,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69481b129935d2_85628078 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1>
              <span class="hrline">WordPress</span> powered by our Cloud Hosting
            </h1>
            <ul class="banner-list mb-2">
              <li>Ready-made Themes</li>
              <li>SEO-friendly</li>
              <li>Mobile Compatible</li>
              <li>Blazing-Fast Load Time</li>
            </ul> <?php if (count($_smarty_tpl->tpl_vars['wprdpressroducts']->value) > 0 && ($_smarty_tpl->tpl_vars['wprdpressroducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['wprdpressroducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['wprdpressroducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['wprdpressroducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['wprdpressroducts']->value, 'myproduct', false, 'productKey');
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
/custom/assets/images/17.svg" alt="Banner image" width="450">
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
    <div class="row gy-4 gy-lg-0"> <?php if (count($_smarty_tpl->tpl_vars['wprdpressroducts']->value) > 0 && ($_smarty_tpl->tpl_vars['wprdpressroducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['wprdpressroducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['wprdpressroducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['wprdpressroducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['wprdpressroducts']->value, 'myproduct');
$_smarty_tpl->tpl_vars['myproduct']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['myproduct']->value) {
$_smarty_tpl->tpl_vars['myproduct']->do_else = false;
?> <div class="col-lg-4 col-md-6">
        <div class="pricing-item-two">
          <h3><?php echo $_smarty_tpl->tpl_vars['myproduct']->value['name'];?>
</h3>
          <div class="price-box">
            <div class="monthly-price">
              <div class="price"> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['monthly'];?>
 </div>
              <div class="duretion">Per Month</div>
            </div>
            <div class="yearly-price">
              <div class="price"> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['annually'];?>
 </div>
              <div class="duretion">Per Year</div>
            </div>
            <div class="biannual-price">
              <div class="price"> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['biennially'];?>
 </div>
              <div class="duretion">Per 2 Year</div>
            </div>
            <div class="triennial-price">
              <div class="price"> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['triennially'];?>
 </div>
              <div class="duretion">Per 3 Year</div>
            </div>
          </div>
          <div class="pricing-body">
            <ul> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['description'];?>
 </ul>
          </div>
          <a class="pricing-item-btn" href="cart.php?a=add&pid=<?php echo $_smarty_tpl->tpl_vars['myproduct']->value['relid'];?>
">Purchase Now</a>
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
          <h2> It just works Auto-magically</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>A secure, reliable and powerful platform crafted for WordPress</p>
        </div>
      </div>
    </div>
    <div class="row gy-4 justify-content-center">
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>01</span>
          </div>
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/service_tools.png" alt="services icon">
          </div>
          <h4>Auto-Setup</h4>
          <p>No need for any legwork - Your WordPress hosting comes pre-configured with the latest version of WordPress and is ready-to-use the moment you buy it.</p>
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
/custom/assets/images/rocket.png" alt="services icon">
          </div>
          <h4>Auto-Updates</h4>
          <p>Any patches or version upgrades released by WordPress are automatically installed for your packages, not only making your sites future-proof but also more secure.</p>
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
/custom/assets/images/html.png" alt="services icon">
          </div>
          <h4>Auto-Caching</h4>
          <p>Get the best-performing WordPress sites with our Cloud Hosting. With cache and CDN auto-configured on all your packages, pages load much faster with the least amount of resources.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>04</span>
          </div>
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/download.png" alt="services icon">
          </div>
          <h4>Auto-Backups</h4>
          <p>Get a time machine for all your WordPress sites. With CodeGuard automatically set up for any site you create, your data is always protected and regularly backed up.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>05</span>
          </div>
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/internet.png" alt="services icon">
          </div>
          <h4>Auto-Secured</h4>
          <p>No need to worry about viruses or hacking attempts. All your WordPress sites will be regularly scanned for malware with SiteLock's advanced security tools.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-gap section-bg bg1">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-9 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2>WordPress powers 27% of websites on the Internet</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Build anything - a blog, a static website or an ecommerce shop</p>
        </div>
      </div>
    </div>
    <div class="row g-4 gy-lg-5">
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/html.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>Ready-made Themes</h3>
            <p>Choose from over 25,000+ themes available for any type of business, portfolio, or blog. </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/magnifying_glass.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>SEO-friendly</h3>
            <p>With pre-integrated SEO friendly module, drive maximum traffic to your site through search engines. </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/coding.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>Diversified Plugins</h3>
            <p>Add features to your websites by installing plugins in a few clicks. </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/responsive.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>Mobile Compatible</h3>
            <p>Create and even edit your site on any mobile device seamlessly. </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-gap">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-9 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2>Your WordPress Site - powered by our Cloud Hosting</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Experience seamless performance and reliability with our Cloud Hosting powering your WordPress site today!</p>
        </div>
      </div>
    </div>
    <div class="row gy-4 justify-content-center">
      <div class="col-lg-3 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>01</span>
          </div>
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/rocket.png" alt="services icon">
          </div>
          <h4>Blazing-Fast Load Time</h4>
          <p>With top-of-the-line hardware and caching - which stores your site’s most used pages, and a globally distributed CDN, your site is served upto 2x faster.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>02</span>
          </div>
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/service_tools.png" alt="services icon">
          </div>
          <h4>Instant Scaling</h4>
          <p>No need to move your hosting as your traffic grows. Ramp up your resources at the click of a button - instantly add RAM and CPU without a reboot.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>03</span>
          </div>
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/internet.png" alt="services icon">
          </div>
          <h4>Your Data - Safeguarded</h4>
          <p>Our industry-leading Ceph-based storage system stores your website data across 3 distinct devices to ensure redundancy and safety.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>04</span>
          </div>
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/download.png" alt="services icon">
          </div>
          <h4>Automatic Failover</h4>
          <p>If we detect a hardware issue, we automatically move your site to another server, ensuring that your site is always up and you never lose traffic.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-gap section-bg bg3">
  <div class="container">
    <div class="row align-items-center justify-content-between gy-4">
      <div class="col-lg-6">
        <div class="section-head white">
          <h2>Create Hosting Website In Minutes</h2>
          <p>Effortlessly create your hosting website in minutes with our intuitive platform. No coding skills required. Launch your site quickly and efficiently with our user-friendly tools.</p>
          <ul class="list-check white two-min-992 mt-3">
            <li>Assured Speed</li>
            <li>24/7 Full Support</li>
            <li>Numerous Domains</li>
            <li>Advanced Storage</li>
            <li>Ideal Protection</li>
            <li>Secured Databases</li>
          </ul>
          <div class="inline-btns mt-3">
            <a class="btn-02" href="website-builder.html">Creat Website <i class="ri-window-line"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="text-center">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/websitebuilder.png" alt="Website Builder">
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
            <a> Can I upgrade my WordPress Hosting plan? </a>
            <p>No, You cannot change upgrade or downgrade plans, however the amount of RAM and CPU cores for your plan can be upgraded.</p>
          </li>
          <li>
            <a> Can I add more WordPress installations to an existing plan? </a>
            <p>No, you cannot add more WordPress installations to any plan. The number of WordPress installations will remain fixed. </p>
          </li>
          <li>
            <a> Can SiteLock and CodeGuard packages be upgraded? </a>
            <p>Currently, the included SiteLock and CodeGuard plans cannot be upgraded.</p>
          </li>
          <li>
            <a>Can I use an external email service with WordPress Hosting? </a>
            <p>Yes, you can use any 3rd party email service for your domain. In case you are using the default name servers provided with WordPress Hosting, please contact our Support team to update the relevant DNS records for your blog.</p>
          </li>
          <li>
            <a> Can I use an existing certificate with my blog?</a>
            <p>No, you cannot use an existing certificate. You will need to generate a CSR from the WordPress Hosting panel and get a certificate issued which can be installed from the panel. </p>
          </li>
          <li>
            <a>Will WordPress be updated automatically?</a>
            <p>Yes, WordPress core updates will be enabled by default.</p>
          </li>
          <li>
            <a> Is there a money back period for WordPress Hosting?</a>
            <p>No, WordPress Hosting does not have a money back period.</p>
          </li>
          <li>
            <a> Is Multisite supported with WordPress Hosting?</a>
            <p>No, Multisite is not supported.</p>
          </li>
          <li>
            <a> Can I access the cPanel for my hosting plan? </a>
            <p>No, cPanel access is not provided with WordPress Hosting.</p>
          </li>
          <li>
            <a> Is an SSL Certificate included with the plan?</a>
            <p>Yes. When you purchase a WordPress Hosting order, Free SSL powered by Let's Encrypt, is automatically generated and installed for all domains associated with the package</p>
          </li>
          <li>
            <a> What is the difference between "WordPress Hosting" and "WordPress Hosting + Security Suite" plans?</a>
            <p>WordPress Hosting plans are economical plans without automatic backups and anti-malware. WordPress Hosting + Security plans have the same specifications as that of the WordPress hosting plans, including automatic cloud backups and anti-malware at a cost difference.</p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section><?php }
}

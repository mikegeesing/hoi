<?php
/* Smarty version 3.1.48, created on 2025-11-03 18:47:49
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/dedicated-server.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6908eac59a0e51_94650504',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f236fdd02a943cdc1d04cb68aa15881a2ca76ae3' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/dedicated-server.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6908eac59a0e51_94650504 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- banner start -->
<div class="banner-one">
    <div class="banner-section bottom-up">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col-lg-6">
            <div class="banner-heading">
              <h1>
                <span class="hrline">Dedicated</span> Server Hosting
              </h1>
              <ul class="banner-list mb-2">
                <li>Choose from SSD or HDD plans</li>
                <li>High-memory servers</li>
                <li>New Generation Processors</li>
                <li>Get started within minutes</li>
              </ul> <?php if (count($_smarty_tpl->tpl_vars['dedicatedproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['dedicatedproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['dedicatedproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['dedicatedproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['dedicatedproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dedicatedproducts']->value, 'myproduct', false, 'productKey');
$_smarty_tpl->tpl_vars['myproduct']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['productKey']->value => $_smarty_tpl->tpl_vars['myproduct']->value) {
$_smarty_tpl->tpl_vars['myproduct']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['productKey']->value == 0) {?> <h4>Starting Price <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['monthly'];?>
/mo</h4> <?php }?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?> <div class="inline-btns mt-3">
                <a class="btn-01" onclick="document.getElementById('Plans').scrollIntoView();">View Plans</a>
              </div>
            </div>
          </div>
          <div class="col-lg-5 d-none d-lg-block">
            <div class="text-center text-lg-end">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/20.svg" alt="Banner image" width="400">
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
                <span class="custom-check"></span> Monthly </label>
            </div>
            <div class="single-radio-box">
              <input name="billingPlan" id="yearly-plan" value="yearly" class="radio" type="radio">
              <label for="yearly-plan">
                <span class="custom-check"></span> Yearly </label>
            </div>
            <div class="single-radio-box">
              <input name="billingPlan" id="biannual-plan" value="biannual" class="radio" type="radio">
              <label for="biannual-plan">
                <span class="custom-check"></span> Biannual </label>
            </div>
            <div class="single-radio-box">
              <input name="billingPlan" id="triennial-plan" value="triennial" class="radio" type="radio">
              <label for="triennial-plan">
                <span class="custom-check"></span> Triennial </label>
            </div>
          </div>
        </div>
      </div>
      <div class="row gy-4 gy-lg-0"> <?php if (count($_smarty_tpl->tpl_vars['dedicatedproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['dedicatedproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['dedicatedproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['dedicatedproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['dedicatedproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dedicatedproducts']->value, 'myproduct');
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
                <div class="duretion">Yr</div>
              </div>
              <div class="biannual-price">
                <div class="price"> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['biennially'];?>
 </div>
                <div class="duretion">2 Yr</div>
              </div>
              <div class="triennial-price">
                <div class="price"> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['triennially'];?>
 </div>
                <div class="duretion">3 Yr</div>
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
        <div class="col-12 col-xl-7 col-lg-8">
          <div class="section-head gap-bottom center with-line">
            <h2>Maximum Performance, Total Control</h2>
            <div class="lines">
              <span></span>
            </div>
            <p>Achieve peak performance: Harness complete control over configurations and resources to optimize speed, efficiency, and reliability for unparalleled performance. </p>
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
/custom/assets/images/settings_icon.png" alt="services icon">
            </div>
            <h4>Powerful Configurations</h4>
            <p>Our servers are powered by SSD storage, DDR4 Memory and Xenon D processors, and can smoothly handle any type of workload — from a critical business application to a high-traffic website.</p>
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
/custom/assets/images/customer_experience.png" alt="services icon">
            </div>
            <h4>Quick Provisioning</h4>
            <p>We get you online quickly. Your server is provisioned within minutes.</p>
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
/custom/assets/images/discount.png" alt="services icon">
            </div>
            <h4>Server Administration Panel</h4>
            <p>Never lose access to your server. Our Server Administration Panel gives you total control at all times. With features like Rebuild, Web-based VNC, Restart, Shutdown and Resource Monitoring you can manage your server easily.</p>
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
/custom/assets/images/service_tools.png" alt="services icon">
            </div>
            <h4>Additional Storage*</h4>
            <p>Our HDD servers come with the flexibility of additional storage. You can easily scale the storage as your business grows.</p>
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
/custom/assets/images/server.png" alt="services icon">
            </div>
            <h4>Easily Configurable</h4>
            <p>Choose from multiple Linux flavours and hosting panels. You can even add WHMCS add-on to have a complete billing solution.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
          <div class="services-one">
            <div class="number-box">
              <span>06</span>
            </div>
            <div class="icon">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/customer_experience.png" alt="services icon">
            </div>
            <h4>99.99% uptime</h4>
            <p>Our servers are located a top-tier data centres which are backed by redundant ISP links and Neustar DDoS protection to ensure your site is up and available all the time.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-gap section-bg bg1">
    <div class="container">
      <div class="row align-items-center gy-4 gy-lg-0">
        <div class="col-lg-6">
          <div class="section-head">
            <h2>We Are Here For You</h2>
            <p>We're dedicated to supporting you in any way we can. From answering questions to offering guidance, our goal is to make your experience as smooth as possible. Don't hesitate to reach out whenever you need assistance. Your satisfaction is our priority, and we're here to help!</p>
            <div class="inline-btns mt-3">
              <a class="btn-01" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php">Get Started Now <i class="fas fa-long-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="text-center text-lg-end d-block w-100">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/26.svg" alt="Website migrate">
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
              <a> Which hosting control panels do you offer?</a>
              <p>You can buy Plesk or cPanel license during the server purchase, or at a later time when the need arises. </p>
            </li>
            <li>
              <a> Which billing panels do you offer? </a>
              <p>We offer WHMCS as a billing panel for your dedicated server. You can purchase the license from us at a minimal cost and install the application on your dedicated server. </p>
            </li>
            <li>
              <a> What are the functions of the Server Administration Panel? </a>
              <p>Every server comes with its Server Administration Panel by default. This panel allows you to carry out crucial server administration tasks and monitor resource consumption like <em style="font-style: italic;">GUI-based CPU, Memory, Storage &amp; Inodes utilisation, IPs and Storage (for HDD servers only) details and functions to Rebuild, Restart, Web-based VNC and reset access credentials.</em>
              </p>
            </li>
            <li>
              <a> Can I configure my own RAID for drives? </a>
              <p>The Dedicated Servers come pre-configured with RAID 1. At present, we don’t allow customisation of RAID level.Would love to hear about such <a href="https://supersite2.com/dedicated-servers.html#" class="letusknowmore">new features requests</a> to help us serve you better. </p>
            </li>
            <li>
              <a> Can I use a Dedicated Server for email marketing? </a>
              <p>Dedicated Servers can be used for Websites, Databases, Custom Applications, Ecommerce, DNS, File Storage and Emails. Emails, however, must be restricted to personal, organisational or professional purposes. The use of Dedicated Servers to send out mass emails/marketing is NOT recommended and can attract penalties. </p>
            </li>
            <li>
              <a> Can I use virtualisation software on the server?</a>
              <p>YOur Dedicated Servers are virtualised (1:1). Thus, nested virtualisation will not work due to network restrictions on the host system. </p>
            </li>
            <li>
              <a> Do you provide any backup service? </a>
              <p>We don’t have any backup solution at the moment. Yet, we strongly recommend that you maintain a remote backup to avoid any hassles during any ill-fated incident. </p>
            </li>
            <li>
              <a> Can I Upgrade from SSD-based to NVMe-based Plan or Vice-Versa? </a>
              <p>Currently, we support upgrades within the same storage type only. This means upgrades are permissible from one SSD plan to a higher-tier SSD plan. Upgrades between SSD and NVMe plans are not supported at this time.</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section><?php }
}

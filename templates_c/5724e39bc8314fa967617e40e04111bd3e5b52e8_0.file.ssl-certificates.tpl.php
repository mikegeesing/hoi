<?php
/* Smarty version 3.1.48, created on 2025-10-27 13:09:44
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/ssl-certificates.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_68ff61087bbd86_21150637',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5724e39bc8314fa967617e40e04111bd3e5b52e8' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/ssl-certificates.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ff61087bbd86_21150637 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1> Secure <span class="hrline"> your website</span> and customer data </h1>
            <ul class="banner-list mb-2">
              <li>Protect your customer's personal data</li>
              <li>Credit cards and identity information</li>
              <li>Getting an SSL certificate is the easiest way</li>
              <li>Increase your customer's confidence</li>
            </ul> <?php if (count($_smarty_tpl->tpl_vars['sslproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['sslproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['sslproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['sslproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['sslproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sslproducts']->value, 'myproduct', false, 'productKey');
$_smarty_tpl->tpl_vars['myproduct']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['productKey']->value => $_smarty_tpl->tpl_vars['myproduct']->value) {
$_smarty_tpl->tpl_vars['myproduct']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['productKey']->value == 0) {?> <h4>Starting Price <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['annually'];?>
/yr</h4> <?php }?> <?php
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
/custom/assets/images/29.svg" alt="Banner image" width="500">
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
            <input name="billingPlan" id="yearly-plan" value="yearly" class="radio" type="radio" checked>
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
    <div class="row gy-4 gy-lg-0"> <?php if (count($_smarty_tpl->tpl_vars['sslproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['sslproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['sslproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['sslproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['sslproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sslproducts']->value, 'myproduct');
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
          <h2>Why buy an SSL certificate</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>An SSL certificate secures your website, encrypting data, enhancing trust, improving SEO, and ensuring a safer browsing experience for visitors.</p>
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
/custom/assets/images/internet.png" alt="services icon">
          </div>
          <h4>Rock-solid security</h4>
          <p>Comodo's SSL certificates provide upto 128 or 256-bit encryption for maximum security of your website visitors' data</p>
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
          <h4>Boost customer confidence</h4>
          <p>Many customers actively look for the SSL lock icon before handing over sensitive data. Get an SSL certificate to increase your customer's trust in your online business.</p>
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
          <h4>Better SEO rankings</h4>
          <p>Google gives higher rankings to websites secured with SSL certificates. Which means SSL certificates are critical if you're serious about your online business.</p>
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
          <h4>Comodo Secure Seal</h4>
          <p>Your certificate comes with a Comodo Secure Seal that serves as a constant reminder to customers that your site is protected</p>
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
/custom/assets/images/money_bag.png" alt="services icon">
          </div>
          <h4>30-day money back guarantee</h4>
          <p>All our SSL certificates come with a 30-day Money Back Guarantee. No questions asked.</p>
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
    <div class="row align-items-center gy-4 gy-lg-0 flex-lg-row-reverse">
      <div class="col-lg-6">
        <div class="section-head">
          <h2>Host your website at the right place, secure, and fast. </h2>
          <p>Choose the perfect hosting solution for your website: secure, reliable, and blazing-fast servers ensure optimal performance. With top-notch security measures, your data is safe. Enjoy seamless integration, expert support, and lightning-fast speeds, providing visitors with an exceptional browsing experience. Elevate your online presence today!.</p>
          <div class="inline-btns mt-3">
            <a class="btn-01" onclick="document.getElementById('Plans').scrollIntoView();">Get Started Now <i class="fas fa-long-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="text-center text-lg-start d-block w-100">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/3.svg" alt="Host your website">
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
            <a> What is an SSL Certificate?</a>
            <p>An SSL Certificate is a digital certificate issued for a domain by a central authority called the Certificate Authority. To be issued an SSL Certificate, you must purchase an SSL Certificate and then go through a verification process conducted by the Certificate Authority. </p>
          </li>
          <li>
            <a> Why should I buy an SSL Certificate? </a>
            <p>An SSL Certificate does 2 things: a. Encrypt the information sent from your user's browser to your website b. Authenticate your website's identity. <br> By doing these 2 things, an SSL Certificate protects your customers and in turn increases their trust in your online business. This is especially important if your website requires users to login using passwords or enter sensitive information such as credit card details. </p>
          </li>
          <li>
            <a> Do SSL Certificates work in all browsers? </a>
            <p>SSL Certificates are compatible with all major browsers.</p>
          </li>
          <li>
            <a> Can I upgrade my SSL Certificates? </a>
            <p>Unfortunately, we don't support upgrades/downgrades at the moment. If required you can purchase a new certificate and install it on the same web server as the old certificate</p>
          </li>
          <li>
            <a> Do I need technical expertise to set up an SSL Certificate on my website? </a>
            <p>While it isn't difficult to install an SSL Certificate, it does involve following a series of steps. You can find more information in our KnowledgeBase. </p>
          </li>
          <li>
            <a> Is my data safe? Do you take backups?</a>
            <p>Yes, your data is a 100% secure and is backed-up every 5 days. </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section><?php }
}

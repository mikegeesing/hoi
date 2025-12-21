<?php
/* Smarty version 3.1.48, created on 2025-12-21 17:24:42
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/sitelock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69482d5a48c8f4_30752939',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a945c6bfc341956befbb692c03e18ca072d8ae8' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/sitelock.tpl',
      1 => 1766333101,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69482d5a48c8f4_30752939 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1>
              <span class="hrline">Sitelock</span> Malware Detector
            </h1>
            <ul class="banner-list mb-2">
              <li>Scans Daily</li>
              <li>Identifies Threats</li>
              <li>Instantly Notifies and Fixes</li>
              <li>Increase your customer's confidence</li>
            </ul> <?php if (count($_smarty_tpl->tpl_vars['sitelockproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['sitelockproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['sitelockproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['sitelockproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['sitelockproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sitelockproducts']->value, 'myproduct', false, 'productKey');
$_smarty_tpl->tpl_vars['myproduct']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['productKey']->value => $_smarty_tpl->tpl_vars['myproduct']->value) {
$_smarty_tpl->tpl_vars['myproduct']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['productKey']->value == 0) {?> <h4>Vanaf <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['monthly'];?>
/mnd</h4><?php }?> <?php
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
/custom/assets/images/31.svg" alt="Banner image" width="500">
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
    <div class="row gy-4 gy-xl-0 justify-content-between"> <?php if (count($_smarty_tpl->tpl_vars['sitelockproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['sitelockproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['sitelockproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['sitelockproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['sitelockproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sitelockproducts']->value, 'myproduct', false, 'productKey');
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
      <div class="col-12 col-xl-7 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2>Protect your website from</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Safeguard your website from threats, malware, hackers, and data breaches with robust security measures and regular updates and monitoring.</p>
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
/custom/assets/images/viruses.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Viruses</h3>
              <p>Protect against harmful computer viruses.</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/tools.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Bot Attacks</h3>
              <p>Defend against malicious bot attacks.</p>
            </div>
          </li>
          <li class="list-item ">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/hacker.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Hackers</h3>
              <p>Safeguard your systems against hackers.</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/internet.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Identity Theft</h3>
              <p>Prevent identity theft with vigilance.</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/block_user.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Search Engine Blacklists</h3>
              <p>Avoid search engine blacklisting. </p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section class="section-gap">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-7 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2>Sitelock is easy, economical and effective</h2>
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
          <h4>Automatically Prevents Attacks</h4>
          <p>SiteLock monitors your website 24x7 for vulnerabilities and attacks, which means you can worry less about your website and more about your business.</p>
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
          <h4>Boosts Customer Trust</h4>
          <p>Over 70% Customers look for a sign of security before providing personal details online. The SiteLock Trust Seal not only re-assures customers but also boosts sales.</p>
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
          <h4>Starts Working Instantly</h4>
          <p>You don't need technical expertise to install and set up SiteLock for your website. SiteLock is cloud-based and starts scanning your website and email instantly.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-gap testmonilas-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-7 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2>What happy clients says about us?</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Delighted customers rave about our exceptional service and support.</p>
        </div>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-12">
        <div class="swiper swiper-testimonilas">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="testimonilas_item">
                <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/quote.svg" alt="testimonilas icon" class="icon">
                <p>Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality.</p>
              </div>
              <div class="testimonial-author">
                <div class="author-thumb">
                  <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/testi1.jpg" alt="testimonial-author">
                </div>
                <div class="author-content">
                  <h5>Ribeiro Nicolas</h5>
                  <span>HR, Envato</span>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonilas_item">
                <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/quote.svg" alt="testimonilas icon" class="icon">
                <p>Operational podcasting change management inside of workflows to establish a framework . Keeping your eye on the ball while performing a deep dive on the start-up mentality. Taking seamless key performance indicators offline to maximize the long tail.</p>
              </div>
              <div class="testimonial-author">
                <div class="author-thumb">
                  <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/testi2.jpg" alt="testimonial-author">
                </div>
                <div class="author-content">
                  <h5>Taylor Matthew</h5>
                  <span>SEO & Founder, Facebook</span>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonilas_item">
                <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/quote.svg" alt="testimonilas icon" class="icon">
                <p>Operational establish to Podcasting change management inside of workflows a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality.</p>
              </div>
              <div class="testimonial-author">
                <div class="author-thumb">
                  <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/testi3.jpg" alt="testimonial-author">
                </div>
                <div class="author-content">
                  <h5>Howard Esther</h5>
                  <span>CEO, Bribbble LLC</span>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide"></div>
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
            <a> What is SiteLock? </a>
            <p>SiteLock is a comprehensive website security solution that offers malware detection, vulnerability identification, and automated removal, ensuring a secure online presence.</p>
          </li>
          <li>
            <a> Do you get Money-Back Guarantee with SiteLock website security? </a>
            <p>Yes, SiteLock website security comes with a money-back guarantee, providing confidence and assurance in the effectiveness of its comprehensive security solutions. </p>
          </li>
          <li>
            <a> Why will just a SSL certificate not suffice for your website? </a>
            <p>While an SSL certificate provides secure data transmission, SiteLock complements it by offering complete website security, protecting against malware, vulnerabilities, and other threats.</p>
          </li>
          <li>
            <a> What types of scan are available with SiteLock Website Security? </a>
            <p>SiteLock offers malware, vulnerability, and OWASP scans to comprehensively assess and secure your website against various threats and potential vulnerabilities.</p>
          </li>
          <li>
            <a> How are the SiteLock security plans billed?</a>
            <p>SiteLock security plans are billed on a subscription basis. Choose a plan that suits your needs, and enjoy continuous website protection with flexible billing. </p>
          </li>
          <li>
            <a> How do you install SiteLock Website Security? </a>
            <p>SiteLock installation is easy. Simply sign up for a plan, verify your domain ownership, and SiteLock will automatically scan, detect, and protect your website without any manual installation required. </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section><?php }
}

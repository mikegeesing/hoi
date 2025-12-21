<?php
/* Smarty version 3.1.48, created on 2025-11-06 17:34:54
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/codeguard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690cce2e7e8707_11544879',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '66cb3e9fb04eab98a8cfd8c351cd28e50ae18c8d' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/codeguard.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690cce2e7e8707_11544879 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1>
              <span class="hrline"> CodeGuard</span> Cloud backup for your website
            </h1>
            <ul class="banner-list mb-2">
              <li>Connect your website</li>
              <li>Get regular backup updates</li>
              <li>Restore from any point</li>
              <li>Increase your customer's confidence</li>
            </ul> <?php if (count($_smarty_tpl->tpl_vars['codeguardproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['codeguardproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['codeguardproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['codeguardproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['codeguardproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['codeguardproducts']->value, 'myproduct', false, 'productKey');
$_smarty_tpl->tpl_vars['myproduct']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['productKey']->value => $_smarty_tpl->tpl_vars['myproduct']->value) {
$_smarty_tpl->tpl_vars['myproduct']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['productKey']->value == 0) {?> <h4>Starting Price <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['monthly'];?>
/mo</h4><?php }?> <?php
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
/custom/assets/images/30.svg" alt="Banner image" width="500">
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
    <div class="row gy-4 gy-lg-0"> <?php if (count($_smarty_tpl->tpl_vars['codeguardproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['codeguardproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['codeguardproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['codeguardproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['codeguardproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['codeguardproducts']->value, 'myproduct');
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
              <div class="duretion">Mo</div>
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
/custom/assets/images/Monitoring.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Daily Monitoring</h3>
              <p>Continuous oversight ensures optimal performance and security.</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/data_backup.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Automatic Website Backup</h3>
              <p>Seamless backups for your website's security and peace-of-mind.</p>
            </div>
          </li>
          <li class="list-item ">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/website.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Easy Setup</h3>
              <p>Straightforward setup for hassle-free initiation and convenience.</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/internet.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Easy Website Restore</h3>
              <p>Effortless website restoration for seamless recovery and peace.</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/download.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Infinite Backup Retention</h3>
              <p>Endless backup retention for ultimate data security. </p>
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
          <h2>Website backup that just works</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Since CodeGuard is cloud-based, setting it up is a snap – simply add your website connection details to start the backup process.</p>
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
          <h4>Automatic backups</h4>
          <p>CodeGuard works behind the scenes. Which means you can turn it on and sit back while CodeGuard takes regular backups of your data.</p>
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
          <h4>Hassle-free setup</h4>
          <p>Since CodeGuard is cloud-based, setting it up is a snap – simply add your website connection details to start the backup process.</p>
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
          <h4>30-day Money-back guarantee</h4>
          <p>Try out CodeGuard and see how easy it is to secure your website. With our 30-day Money-back period, you've got nothing to lose.</p>
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
            <a> What is CodeGuard? </a>
            <p>CodeGuard is a website backup and version control service, ensuring data security and easy recovery.</p>
          </li>
          <li>
            <a> Does CodeGuard have Money-Back Guarantee? </a>
            <p>Yes, CodeGuard comes with a money-back guarantee, providing confidence in its website backup and security services.</p>
          </li>
          <li>
            <a> Why will just a SSL cer Is it possible to switch between CodeGuard plans? </a>
            <p>Yes, you can easily switch between CodeGuard plans to match your changing website backup needs.</p>
          </li>
          <li>
            <a> Can I backup multiple websites if I have to? </a>
            <p>Yes, CodeGuard allows you to backup and secure multiple websites for comprehensive data protection and peace of mind.</p>
          </li>
          <li>
            <a> Where is the website backup stored? </a>
            <p>CodeGuard stores website backups securely in the cloud, ensuring reliable and accessible data protection for your website. </p>
          </li>
          <li>
            <a> Will I have to set up cron jobs for website backup? </a>
            <p>No, CodeGuard eliminates the need for manual cron jobs. It automates the website backup process seamlessly for you. </p>
          </li>
          <li>
            <a> What credentials would I need for the CodeGuard Website Backup Service? </a>
            <p>For CodeGuard, you'll need your website FTP/SFTP credentials and database credentials for optimal website backup and security. </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section><?php }
}

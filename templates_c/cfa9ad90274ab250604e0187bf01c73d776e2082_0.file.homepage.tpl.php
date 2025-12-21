<?php
/* Smarty version 3.1.48, created on 2025-10-27 11:46:14
  from '/home/onlineh/domains/onlinehoster.nl/public_html/whmcs/templates/closterv2/homepage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_68ff4d763ee724_55663843',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cfa9ad90274ab250604e0187bf01c73d776e2082' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/whmcs/templates/closterv2/homepage.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ff4d763ee724_55663843 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <p>Everything you need to launch a website.</p>
            <h1>Shared Web Hosting</h1>
            <ul class="banner-list mb-2">
              <li>Fast, Secure & Always Up</li>
              <li>Zero-Risk, 100% Money-Back Guarantee</li>
              <li>4.5 Million Websites Choose Closter v <sup>2</sup>
              </li>
              <li>24/7 Support and much more!</li>
            </ul> <?php if (count($_smarty_tpl->tpl_vars['sharedhostingproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['sharedhostingproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['sharedhostingproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['sharedhostingproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['sharedhostingproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sharedhostingproducts']->value, 'myproduct', false, 'productKey');
$_smarty_tpl->tpl_vars['myproduct']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['productKey']->value => $_smarty_tpl->tpl_vars['myproduct']->value) {
$_smarty_tpl->tpl_vars['myproduct']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['productKey']->value == 0) {?> <h4>Starting Price <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['monthly'];?>
/mo</h4> <?php }?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?> <div class="inline-btns mt-3">
              <a class="btn-01" onClick="document.getElementById('Plans').scrollIntoView();">Get Started Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
          <div class="text-center text-lg-end">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/1.svg" alt="Banner image">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- banner end -->
<section class="top-up-banner pb-4" id="Plans">
  <div class="container upside rounded bg-white shadow p-4">
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
            <h4 class="title"> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['monthly'];?>
 <span class="durection">/month</span>
            </h4>
          </div>
          <div class="pricing_body">
            <ul> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['description'];?>
 </ul>
            <a class="btn-01 d-block mt-3 w-100" href="cart.php?a=add&pid=<?php echo $_smarty_tpl->tpl_vars['myproduct']->value['relid'];?>
">Select Plan</a>
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
          <h2>Closter v2 Powerful Features</h2>
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
/custom/assets/images/settings_icon.png" alt="services icon">
          </div>
          <h4>Everything You Need to Design a Site</h4>
          <p>learn design principles, UX fundamentals, coding basics, and essential tools for creating stunning and effective websites.</p>
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
          <h4>Customer Automation</h4>
          <p>Customer automation streamlines processes, enhances engagement, and boosts efficiency, leveraging technology to optimize interactions and deliver personalized experiences.</p>
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
          <h4>Proven Scale and Expertise</h4>
          <p>Backed by proven expertise and scalable solutions, we deliver reliable, efficient, and effective results tailored to your business needs.</p>
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
          <h4>Easy Setup and Integration</h4>
          <p>Simplify your workflow with easy setup and seamless integration, ensuring swift implementation and smooth operation across your existing systems.</p>
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
/custom/assets/images/price.png" alt="services icon">
          </div>
          <h4>Best Price Guarantee</h4>
          <p>Our best price guarantee ensures you get the most competitive rates without compromising on quality or service excellence. Satisfaction guaranteed!</p>
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
/custom/assets/images/helpdesk.png" alt="services icon">
          </div>
          <h4>Award-Winning 24/7 Support</h4>
          <p>Experience award-winning 24/7 support, ensuring prompt assistance, expert guidance, and peace of mind whenever you need assistance.</p>
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
          <h2>Free Website Migration</h2>
          <p>Switching your web host is always a bother and requires special attention as your website’s data is precious. We understand that very well, which is why we offer to do it for you without charging any fees. Our expert support team will provide you their complete assistance while you migrate your website to Our server. We take extra care of your data so that you could have your website the way it was, but with much better hosting than before. </p>
          <div class="inline-btns mt-3">
            <a class="btn-01" onClick="document.getElementById('Plans').scrollIntoView();">Get Started Now <i class="fas fa-long-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="text-center text-lg-end d-block w-100">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/2.svg" alt="Website migrate">
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
            <a class="btn-01" onClick="document.getElementById('Plans').scrollIntoView();">Get Started Now <i class="fas fa-long-arrow-right"></i>
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
<section class="section-gap section-bg bg2">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-7 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2>World Data Centers</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Easily organise your infrastructure with Projects. And with Teams, everyone can get their own account, with just the privileges they need to do their jobs.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="text-center">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/datacenter_location.png" alt="Data center">
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
            <a> What is website hosting? </a>
            <p>Website hosting is a service that provides storage space and infrastructure for individuals and organizations to make their websites accessible on the internet. Hosting ensures websites are available and functional.</p>
          </li>
          <li>
            <a> What types of website hosting are available? </a>
            <p>Common types of website hosting include Shared Hosting, Virtual Private Server (VPS) Hosting, Dedicated Hosting, Cloud Hosting, and Managed WordPress Hosting. Each serves different needs in terms of performance and control.</p>
          </li>
          <li>
            <a> What is shared hosting? </a>
            <p>Shared hosting is a type of web hosting where multiple websites share resources on a single server. It's cost-effective but may have limitations on performance and customization due to shared resources.</p>
          </li>
          <li>
            <a> What is Reseller hosting? </a>
            <p>Reseller hosting involves purchasing hosting resources in bulk and reselling them to clients. Resellers act as intermediaries, managing and providing hosting services to multiple individual clients. It allows entrepreneurs to start their hosting business without managing the infrastructure directly.</p>
          </li>
          <li>
            <a> What is VPS hosting? </a>
            <p>VPS hosting, or Virtual Private Server hosting, involves dividing a physical server into virtual compartments, providing dedicated resources to each user. It offers more control, flexibility, and customization than shared hosting, making it suitable for websites with moderate to high traffic or specific technical requirements. </p>
          </li>
          <li>
            <a> What is dedicated hosting? </a>
            <p>Dedicated hosting involves having an entire physical server exclusively for one user or organization. This type of hosting provides maximum control, customization, and performance, making it ideal for high-traffic websites or specific applications.</p>
          </li>
          <li>
            <a> What is cloud hosting? </a>
            <p>Cloud hosting utilizes a network of interconnected virtual and physical servers to host websites. It offers scalability, flexibility, and reliability as resources can be dynamically allocated, ensuring optimal performance and uptime.</p>
          </li>
          <li>
            <a> What is managed hosting? </a>
            <p>Managed hosting is a service where the hosting provider takes care of server maintenance tasks, security, updates, and technical support. This allows clients to focus on their websites or applications without the need for in-depth server management, making it convenient and hassle-free.</p>
          </li>
        </ul>
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
</section><?php }
}

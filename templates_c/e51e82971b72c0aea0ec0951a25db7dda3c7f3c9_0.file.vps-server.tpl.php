<?php
/* Smarty version 3.1.48, created on 2025-12-21 16:08:52
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/vps-server.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69481b94b510e2_86627879',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e51e82971b72c0aea0ec0951a25db7dda3c7f3c9' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/vps-server.tpl',
      1 => 1766333063,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69481b94b510e2_86627879 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1> Linux KVM <span class="hrline">VPS</span> Hosting </h1>
            <ul class="banner-list mb-2">
              <li>High-speed NVMe Storage</li>
              <li>Instant Provisioning</li>
              <li>Full Root Access</li>
              <li>Virtualized computing resources</li>
            </ul> <?php if (count($_smarty_tpl->tpl_vars['vpsproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['vpsproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['vpsproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['vpsproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['vpsproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vpsproducts']->value, 'myproduct', false, 'productKey');
$_smarty_tpl->tpl_vars['myproduct']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['productKey']->value => $_smarty_tpl->tpl_vars['myproduct']->value) {
$_smarty_tpl->tpl_vars['myproduct']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['productKey']->value == 0) {?> <h4>Vanaf <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['monthly'];?>
/mnd</h4> <?php }?> <?php
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
/custom/assets/images/18.svg" alt="Banner image" width="500">
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
    <div class="row gy-4 gy-xl-0 justify-content-between"> <?php if (count($_smarty_tpl->tpl_vars['vpsproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['vpsproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['vpsproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['vpsproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['vpsproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vpsproducts']->value, 'myproduct');
$_smarty_tpl->tpl_vars['myproduct']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['myproduct']->value) {
$_smarty_tpl->tpl_vars['myproduct']->do_else = false;
?> <div class="col-lg-4 col-xl-3 col-md-6">
        <div class="pricing-item">
          <div class="pricing-heading">
            <div class="name"><?php echo $_smarty_tpl->tpl_vars['myproduct']->value['name'];?>
 </div>
            <div class="monthly-price">
              <h4 class="title "> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['monthly'];?>
 <span class="durection">/mo</span>
              </h4>
            </div>
            <div class="yearly-price">
              <h4 class="title "> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['annually'];?>
 <span class="durection">/Yr</span>
              </h4>
            </div>
            <div class="biannual-price">
              <h4 class="title "> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['biennially'];?>
 <span class="durection">/2 Yr</span>
              </h4>
            </div>
            <div class="triennial-price">
              <h4 class="title "> <?php echo $_smarty_tpl->tpl_vars['myproduct']->value['prefix'];
echo $_smarty_tpl->tpl_vars['myproduct']->value['triennially'];?>
 <span class="durection">/3 Yr</span>
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
    <div class="d-none d-lg-block px-lg-5">
      <div class="row">
        <div class="col-12">
          <div class="big-screen-tab six-coloumn">
            <button class="tabing-buttons active" data-target="tab1">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/tools.png" alt="img">Deploy </button>
            <button class="tabing-buttons" data-target="tab2">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/storage.png" alt="img">Additional Storage </button>
            <button class="tabing-buttons" data-target="tab3">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/website.png" alt="img"> Manage </button>
            <button class="tabing-buttons" data-target="tab4">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/internet.png" alt="img">Secure </button>
            <button class="tabing-buttons" data-target="tab5">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/helpdesk.png" alt="img">Get Support </button>
          </div>
        </div>
      </div>
    </div>
    <div class="mob-screen-tabs px-lg-5">
      <div class="items">
        <button class="tabing-buttons active" data-target="tab1">Choose your Operating System</button>
        <div class="tabing-contents active" id="tab1">
          <div class="row align-items-center gy-4 gy-lg-0 justify-content-between">
            <div class="col-lg-6">
              <div class="section-head">
                <h2 class="d-none d-lg-block">Choose your Operating System</h2>
                <p class="mb-3 mb-lg-0 text-start">Select OS: Ubuntu, AlmaLinux, or Rocky Linux. Tailor your choice to software compatibility, user interface preferences, and specific development or operational needs</p>
              </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
              <div class="text-center">
                <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/19.svg" alt="images" width="350">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="items">
        <button class="tabing-buttons" data-target="tab2">Additional Storage</button>
        <div class="tabing-contents" id="tab2">
          <div class="row align-items-center gy-4 gy-lg-0 justify-content-between">
            <div class="col-lg-6">
              <div class="section-head">
                <h2 class="d-none d-lg-block">Additional Storage</h2>
                <p class="mb-3 mb-lg-0 text-start">Expand storage: Scale your data capacity effortlessly. Choose additional SSD or HDD storage options to accommodate growing files and applications, ensuring seamless performance and uninterrupted workflow for your virtual server </p>
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
        <button class="tabing-buttons" data-target="tab3">Manage</button>
        <div class="tabing-contents" id="tab3">
          <div class="row align-items-center gy-4 gy-lg-0 justify-content-between">
            <div class="col-lg-6">
              <div class="section-head">
                <h2 class="d-none d-lg-block">Manage</h2>
                <p class="mb-3 mb-lg-0 text-start">Effortlessly control website content: Update, modify, and organize web pages with user-friendly interfaces and intuitive content management systems (CMS), empowering seamless customization and efficient maintenance of your online presence.</p>
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
        <button class="tabing-buttons" data-target="tab4">Secure</button>
        <div class="tabing-contents" id="tab4">
          <div class="row align-items-center gy-4 gy-lg-0 justify-content-between">
            <div class="col-lg-6">
              <div class="section-head">
                <h2 class="d-none d-lg-block">Secure</h2>
                <p class="mb-3 mb-lg-0 text-start">Safeguard website content: Employ robust security measures, including SSL encryption, firewalls, and regular security audits, to protect data integrity, mitigate vulnerabilities, and ensure a safe browsing experience for visitors.</p>
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
        <button class="tabing-buttons" data-target="tab5">Get Support</button>
        <div class="tabing-contents" id="tab5">
          <div class="row align-items-center gy-4 gy-lg-0 justify-content-between">
            <div class="col-lg-6">
              <div class="section-head">
                <h2 class="d-none d-lg-block">Get Support</h2>
                <p class="mb-3 mb-lg-0 text-start">Access reliable support: Reach out to our dedicated team for prompt assistance with any technical issues or inquiries. Benefit from comprehensive guidance and timely resolutions to ensure optimal performance and seamless operation of your website.</p>
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
            <a> What is a KVM VPS?</a>
            <p>A KVM VPS Server leverages Kernel-based Virtual Machine technology to partition a single physical server into multiple isolated virtual servers, each with allocated resources like CPU, memory, and storage. This architecture ensures that each VPS operates independently, providing a stable and secure environment without the higher cost of a dedicated server. </p>
          </li>
          <li>
            <a> Why choose a VPS server? </a>
            <p>VPS Hosting provides complete isolation for your server. Each virtual server operates independently with its own environment such that the actions of one server does not impact others. You gain full control with root access, providing you with the flexibility to install any applications or configurations that you need. Ideal for users needing reliable performance with the flexibility for customization, KVM VPS serves as a balanced hosting solution that offers an isolated, customizable and secure hosting environment. </p>
          </li>
          <li>
            <a> What is the Difference Between SSD and NVMe Servers? </a>
            <p>SSD (Solid State Drive) servers are designed for enhanced performance, offering faster disk read/write speeds than traditional HDDs, suitable for websites and applications with high-performance demands. NVMe (Non-Volatile Memory Express) technology, an advancement over standard SSDs, provides superior read/write speeds, further boosting performance for even the most demanding applications. </p>
          </li>
          <li>
            <a> What Hosting Panels are Supported? </a>
            <p>While purchasing an SSD or NVMe VPS Server, you have the option to add a cPanel or Plesk license. These options are only available to plans that fulfill the minimum system requirements of the respective panel, ensuring a compatible and secure environment for your server. </p>
          </li>
          <li>
            <a> Is a Dedicated IP Available? </a>
            <p>Yes, additional Dedicated IP’s are available for purchase at an additional fee. </p>
          </li>
          <li>
            <a> Is my data safe? Do you take backups?</a>
            <p>Yes, your data is a 100% secure and is backed-up every 5 days. </p>
          </li>
          <li>
            <a> Can I Increase or Decrease Resources on My VPS Server? </a>
            <p>Resource adjustments on your VPS server are facilitated through plan upgrades within the same category. At this time, it is not feasible to decrease resources or downgrade your service plan, ensuring consistent performance and stability for your applications. </p>
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

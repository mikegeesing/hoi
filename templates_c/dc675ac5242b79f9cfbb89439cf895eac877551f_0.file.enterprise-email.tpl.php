<?php
/* Smarty version 3.1.48, created on 2025-11-03 10:45:06
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/enterprise-email.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690879a294fd39_38284595',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dc675ac5242b79f9cfbb89439cf895eac877551f' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/enterprise-email.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690879a294fd39_38284595 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1>
              <span class="hrline">Enterprise</span> Email
            </h1>
            <ul class="banner-list mb-2">
              <li>Professional Email for Power </li>
              <li>Users with Extra Storage</li>
              <li>Get Additional Storage</li>
            </ul> <?php if (count($_smarty_tpl->tpl_vars['enterpriseemailproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['enterpriseemailproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['enterpriseemailproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['enterpriseemailproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['enterpriseemailproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['enterpriseemailproducts']->value, 'myproduct', false, 'productKey');
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
/custom/assets/images/27.svg" alt="Banner image" width="500">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="top-up-banner pb-4" id="Plans">
  <div class="container upside rounded bg-white shadow p-4">
    <div class="row gy-4 gy-xl-0 justify-content-between"> <?php if (count($_smarty_tpl->tpl_vars['enterpriseemailproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['enterpriseemailproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['enterpriseemailproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['enterpriseemailproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['enterpriseemailproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['enterpriseemailproducts']->value, 'myproduct');
$_smarty_tpl->tpl_vars['myproduct']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['myproduct']->value) {
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
          <h2>Why Choose Enterprise Email</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Get over $100 worth of Free Services with every Domain you Register</p>
        </div>
      </div>
    </div>
    <div class="row g-4 gy-lg-5">
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/mail.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>More than Enough Mailbox Space</h3>
            <p>With 30GB of Email storage, you will never run out of space. Powered by our state-of-the-art webmail platform, it is all backed-up in our high-end mail storage infrastructure. </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/storage.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>Get Additional Storage @ Rs. 21.71/5GB</h3>
            <p>No more worrying about running out of storage space. You can now increase storage for individual accounts by buying additional storage blocks of 5 GB. </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/website.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>Stay Organised</h3>
            <p>Quick sharing of Calendars and Contacts only means one thing - you get more done. Easier, better & faster! </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/smart.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>Smart Widgets</h3>
            <p>View customized news feeds, stay updated on the weather and keep your emails secured with last login IP details.</p>
          </div>
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
          <h2>What's amazing about Enterprise Email</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Boost professionalism: Gain branded email addresses, advanced security features, and reliable communication tools for seamless business correspondence. </p>
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
/custom/assets/images/mail.png" alt="services icon">
          </div>
          <h4>Email at Enterprise Scale</h4>
          <p>Beautifully designed state of the art webmail platform. You can also access your email on your smartphone or tablet.</p>
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
/custom/assets/images/smart.png" alt="services icon">
          </div>
          <h4>Sidebar Widget</h4>
          <p>Our advanced anti-virus technology secured your inbox and ensures that you are protected from downloading malware and viruses.</p>
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
/custom/assets/images/responsive.png" alt="services icon">
          </div>
          <h4>Intuitive and Responsive Design </h4>
          <p>In addition to 5GB mail storage, your emails are backed up in our state-of-the-art infrastructure so that you never lose important mails.</p>
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
/custom/assets/images/settings_icon.png" alt="services icon">
          </div>
          <h4>Auto-Responder</h4>
          <p>Our high-end mail storage infrastructure guarantees zero data loss and redundancy, along with 100% network uptime.</p>
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
/custom/assets/images/storage.png" alt="services icon">
          </div>
          <h4>Abundant Storage with Enterprise</h4>
          <p>Our high-end mail storage infrastructure guarantees zero data loss and redundancy, along with 100% network uptime.</p>
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
/custom/assets/images/coding.png" alt="services icon">
          </div>
          <h4>Calendars and Contacts</h4>
          <p>Manage contacts and keep track of all your meetings in one place with advanced productivity tools.</p>
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
            <a> How will purchasing Enterprise Email benefit me?</a>
            <p>By purchasing an Enterprise Email package you take advantage of our advanced email technology, to give you the least latency and industry best uptime, scalability and reliability. An email service being served out of the cloud also means no IT hardware, software, bandwidth or people costs, and a simple pay-as-you-grow model. </p>
          </li>
          <li>
            <a> What typical features does an Enterprise Email provide over Personal Email? </a>
            <p>Enterprise Email supports a number of features that aren't available in Personal email. Shared calendaring, global contacts, push synchronization for mobile devices, MS Outlook & Mac OSX. </p>
          </li>
          <li>
            <a> Which Email Clients and protocols are supported? </a>
            <p>You can send and receive emails using any desktop-based email client such as Microsoft Outlook, Outlook Express, Mozilla Thunderbird, Eudora, Entourage 2004, Windows Mail, etc. We also have a guide on how you can configure different email clients to send/receive emails. The enterprise email product supports the POP, IMAP and MAPI protocols. </p>
          </li>
          <li>
            <a> How do I use my Webmail Interface? </a>
            <p>To access your Webmail Interface, you can use the white-labelled URL: http://webmail.yourdomainname.com. Once on the login page, you would need to login with your email address and the corresponding password. </p>
          </li>
          <li>
            <a> Which mobile phones can I access my mail from? </a>
            <p>Your email can be accessed using any Smartphone or Tablet. Our responsive webmail, is compatible on all major Operating systems such as iOS, Android, Windows Mobile, Symbian and Blackberry. </p>
          </li>
          <li>
            <a> What is the space provided per Email Account?</a>
            <p>Each email account comes with 30 GB space dedicated to your emails and attachments.</p>
          </li>
          <li>
            <a> What ports do I need to use for Email Hosting? </a>
            <p>Usually, the port used for the Outgoing Mail Server/SMTP Service is 25. However, there might be a situation where your ISP might be blocking the use of port 25 for SMTP service. To circumvent this you can use an alternate port 587 for sending mails. </p>
          </li>
          <li>
            <a> Can I create mailing lists? </a>
            <p>Yes, you can create mailing lists and add/delete users, select a moderator, restrict people from joining a list or even ban users from a list. More information on this can be found in our knowledgebase </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section><?php }
}

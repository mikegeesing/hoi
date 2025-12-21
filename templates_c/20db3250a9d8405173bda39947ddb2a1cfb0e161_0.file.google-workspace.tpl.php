<?php
/* Smarty version 3.1.48, created on 2025-11-07 01:32:58
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/google-workspace.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690d3e3a2b0ca7_58802376',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '20db3250a9d8405173bda39947ddb2a1cfb0e161' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/google-workspace.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690d3e3a2b0ca7_58802376 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1>
              <span class="hrline">Google Workspace</span> Intelligent tools your business can depend on
            </h1>
            <ul class="banner-list mb-2">
              <li>Collaboration, Productivity, Communication, Integration </li>
              <li>Users with Extra Storage</li>
              <li>Get Additional Storage</li>
            </ul> <?php if (count($_smarty_tpl->tpl_vars['googleworkspaceproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['googleworkspaceproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['googleworkspaceproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['googleworkspaceproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['googleworkspaceproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['googleworkspaceproducts']->value, 'myproduct', false, 'productKey');
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
/custom/assets/images/28.svg" alt="Banner image" width="500">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="top-up-banner pb-4" id="Plans">
  <div class="container upside rounded bg-white shadow p-4">
    <div class="row gy-4 gy-xl-0 justify-content-between"> <?php if (count($_smarty_tpl->tpl_vars['googleworkspaceproducts']->value) > 0 && ($_smarty_tpl->tpl_vars['googleworkspaceproducts']->value[0]['monthly'] > 0 || $_smarty_tpl->tpl_vars['googleworkspaceproducts']->value[0]['annually'] > 0 || $_smarty_tpl->tpl_vars['googleworkspaceproducts']->value[0]['biennially'] > 0 || $_smarty_tpl->tpl_vars['googleworkspaceproducts']->value[0]['triennially'] > 0)) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['googleworkspaceproducts']->value, 'myproduct');
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
      <div class="col-12 col-xl-8 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2>What's amazing about GoogleWorkspace Email</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Google Workspace empowers efficient collaboration, productivity, and communication with seamless integration and advanced security features for enhanced workflow management. </p>
        </div>
      </div>
    </div>
    <div class="row justify-content-center gy-4">
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>01</span>
          </div>
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/website.png" alt="services icon">
          </div>
          <h4>More than Enough Mailbox Space</h4>
          <p>With 30GB of Email storage, you will never run out of space. Powered by our state-of-the-art webmail platform, it is all backed-up in our high-end mail storage infrastructure.</p>
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
/custom/assets/images/responsive.png" alt="services icon">
          </div>
          <h4>Get Additional Storage @ Rs. 21.67/5GB</h4>
          <p>No more worrying about running out of storage space. You can now increase storage for individual accounts by buying additional storage blocks of 5 GB.</p>
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
/custom/assets/images/coding.png" alt="services icon">
          </div>
          <h4>Stay Organised </h4>
          <p>Quick sharing of Calendars and Contacts only means one thing - you get more done. Easier, better & faster!</p>
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
          <h4>Smart Widgets</h4>
          <p>View customized news feeds, stay updated on the weather and keep your emails secured with last login IP details.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-gap section-bg bg1">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-8 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2>Effectively Communicate !</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Google Workspace empowers efficient collaboration, productivity, and communication with seamless integration and advanced security features for enhanced workflow management. </p>
        </div>
      </div>
    </div>
    <div class="row align-items-center gy-4 gy-lg-0 flex-lg-row-reverse">
      <div class="col-lg-6">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="feature-style-ten">
              <div class="icon">
                <i class="bi bi-database"></i>
              </div>
              <div class="content">
                <h5>Server Management</h5>
                <p>You can Start, Stop, Restart, Rebuild your VPS from the Server Management Panel.</p>
              </div>
            </div>
          </div>
          <div class="col-12 mt-3">
            <div class="feature-style-ten">
              <div class="icon">
                <i class="bi bi-hdd-rack"></i>
              </div>
              <div class="content">
                <h5>Full Root Access</h5>
                <p>With full root access, you get complete control to manage your server resources.</p>
              </div>
            </div>
          </div>
          <div class="col-12 mt-3">
            <div class="feature-style-ten">
              <div class="icon">
                <i class="bi bi-globe2"></i>
              </div>
              <div class="content">
                <h5>VNC Access</h5>
                <p>VNC allows you quick access to your VPS for easy management.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="text-center text-lg-start d-block w-100">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/performance.svg" alt="Host your website" width="500">
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
          <h2>Seamlessly Collaborate !</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Google Workspace empowers efficient collaboration, productivity, and communication with seamless integration and advanced security features for enhanced workflow management. </p>
        </div>
      </div>
    </div>
    <div class="row align-items-center gy-4 gy-lg-0">
      <div class="col-lg-6">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="feature-style-ten">
              <div class="icon">
                <i class="bi bi-hand-thumbs-up"></i>
              </div>
              <div class="content">
                <h5>Intelligent Collaboration</h5>
                <p>Collaborate in real time, store your files on the cloud, share and access them from anywhere.</p>
              </div>
            </div>
          </div>
          <div class="col-12 mt-3">
            <div class="feature-style-ten">
              <div class="icon">
                <i class="bi bi-cloud-check"></i>
              </div>
              <div class="content">
                <h5>Smart Cloud search</h5>
                <p>Search across all your organizations content. From Gmail and Drive to Docs, Sheets, Slides, Calendar, and more. </p>
              </div>
            </div>
          </div>
          <div class="col-12 mt-3">
            <div class="feature-style-ten">
              <div class="icon">
                <i class="bi bi-gear"></i>
              </div>
              <div class="content">
                <h5>Stay updated </h5>
                <p>Discuss new ideas, engage in meaningful conversations and stay up to date with Currents.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="text-center text-lg-start d-block w-100">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/collabration.svg" alt="Host your website" width="500">
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
      <div class="col-12 col-xl-8 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2> Easily Manage !</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Google Workspace empowers efficient collaboration, productivity, and communication with seamless integration and advanced security features for enhanced workflow management. </p>
        </div>
      </div>
    </div>
    <div class="row align-items-center gy-4 gy-lg-0">
      <div class="col-lg-6">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="feature-style-ten">
              <div class="icon">
                <i class="bi bi-hand-index-thumb"></i>
              </div>
              <div class="content">
                <h5>Efficient control from a single place</h5>
                <p>Manage users, groups, permissions and migrate existing accounts to Google Workspace easily from the Admin Console.</p>
              </div>
            </div>
          </div>
          <div class="col-12 mt-3">
            <div class="feature-style-ten">
              <div class="icon">
                <i class="bi bi-hdd-rack"></i>
              </div>
              <div class="content">
                <h5>Archive your data with ease</h5>
                <p>Retain and manage how your organizations data is stored and save what's important with Vault. </p>
              </div>
            </div>
          </div>
          <div class="col-12 mt-3">
            <div class="feature-style-ten">
              <div class="icon">
                <i class="bi bi-fingerprint"></i>
              </div>
              <div class="content">
                <h5>Stay Secure </h5>
                <p>Manage and give access to your employees on their devices while keeping your data secure with Endpoint Management.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="text-center text-lg-start d-block w-100">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/manage.svg" alt="Host your website" width="500">
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-gap ">
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
            <a> Can I use my existing domain with Google Workspace?</a>
            <p>Yes, you can use an existing domain with your Google Workspace order. </p>
          </li>
          <li>
            <a> What happens to my existing mail, contacts, and calendar data when I move to Google Workspace?</a>
            <p>When switching to Google Workspace from another program or web service, you and your users can bring your existing mail, contacts, and calendar data with you. You have a variety of options for migrating data into Google Workspace, depending on the size of your organization and the system you're migrating from. Tools are available for migration from Microsoft Exchange, Lotus Notes, IMAP servers and other Google accounts. </p>
          </li>
          <li>
            <a> What is the space provided per Email Account? </a>
            <p>Each email account comes with 30 GB space. </p>
          </li>
          <li>
            <a> Is Google Workspace compatible with the email client I use today? </a>
            <p>In addition to accessing Google Workspace mail from the Gmail web interface, you can send and receive mail from your favorite desktop client. Depending on the client, you can use either the IMAP or POP mail protocol. If you're switching to Google Workspace from Microsoft Exchange or some other Outlook service, you can use Google Workspace Sync. This is a plug-in for Outlook 2003, 2007, 2010 or 2013 that lets you use Outlook to manage your Google Workspace mail, calendar and contacts—along with your Outlook notes, tasks and journal entries. </p>
          </li>
          <li>
            <a> Can I create mailing lists? </a>
            <p>Yes, you can create mailing lists and add/delete users, select a moderator, restrict people from joining a list or even ban users from a list. </p>
          </li>
          <li>
            <a> Can I transfer my existing Google Workspace?</a>
            <p>Yes. During the transfer, we move all your email accounts from the old provider to us by keeping the data intact. However, your existing tenure with the other provider, if any does not get moved to us. You can click <a href="javascript:void(0);" id="tt_faq" class="gapps-transfer-token-link">here</a> to initiate the transfer process. </p>
          </li>
          <li>
            <a> Which Email Clients and protocols are supported? </a>
            <p>You can send and receive emails using any desktop-based email client such as Microsoft Outlook, Outlook Express, Mozilla Thunderbird, Eudora, Entourage 2004, Windows Mail, etc. We also have a guide on how you can configure different email clients to send/receive emails. The enterprise email product supports the POP, IMAP and MAPI protocols.</p>
          </li>
          <li>
            <a> Can I manage multiple domains with Google Workspace?</a>
            <p>If your organization acquires a new domain name or does business at multiple domains, you can add all your domains to your account at no extra cost. Users can then have identities at one or more of your domains while sharing services as part of a single organization. And you manage your domains from the same Admin console. You add a domain as either a separate domain or domain alias, depending on how you plan to use it. </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section><?php }
}

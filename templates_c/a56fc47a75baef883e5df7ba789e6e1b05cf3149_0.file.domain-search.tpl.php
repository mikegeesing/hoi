<?php
/* Smarty version 3.1.48, created on 2025-10-27 11:59:21
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/domain-search.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_68ff5089056c22_40547308',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a56fc47a75baef883e5df7ba789e6e1b05cf3149' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/domain-search.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ff5089056c22_40547308 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-start justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1>Find Best Unique <span class="hrline">Domains</span> Use Domain Checker! </h1>
            <p>Web hosting made easy & affordable, choose a fine-tuned web hosting services solution for successful personal and business websites.</p>
            <div class="domain-checker-wrap mt-3" id="Domain">
              <form class="domain-search-form" method="post" action="domainchecker.php">
                <input class="input" type="search" name="domain" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['exampledomain'];?>
" id="domainsearch">
                <button class="submit" type="submit">
                  <i class="fas fa-search"></i>
                  <span>Search</span>
                </button>
              </form><?php if (count($_smarty_tpl->tpl_vars['pricetable']->value) > 0) {?> <div class="domain-search-list"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pricetable']->value, 'price');
$_smarty_tpl->tpl_vars['price']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['price']->value) {
$_smarty_tpl->tpl_vars['price']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.com') {?> <div class="items">
                  <span class="name">.Com</span>
                  <span class="price"><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</span>
                </div> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.in') {?> <div class="items">
                  <span class="name">.in</span>
                  <span class="price"><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</span>
                </div> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.store') {?> <div class="items">
                  <span class="name">.store</span>
                  <span class="price"><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</span>
                </div> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.org') {?> <div class="items">
                  <span class="name">.org</span>
                  <span class="price"><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</span>
                </div> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.info') {?> <div class="items">
                  <span class="name">.info</span>
                  <span class="price"><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</span>
                </div> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.tech') {?> <div class="items">
                  <span class="name">.tech</span>
                  <span class="price"><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</span>
                </div><?php }?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </div><?php }?>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
          <div class="text-center text-lg-end">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/4.svg" alt="Banner image" width="400">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- banner end -->
<!-- Domain Pricing table -->
<div class="top-up-banner pb-4" id="Plans">
  <div class="container upside rounded bg-white shadow p-4">
    <div class="row"><?php if (count($_smarty_tpl->tpl_vars['pricetable']->value) > 0) {?> <div class="col-12">
        <div class="table-responsive domain-tld-table">
          <table>
            <thead>
              <tr>
                <th>TLDs</th>
                <th>Years</th>
                <th>Register</th>
                <th>Transfer</th>
                <th>Renew</th>
              </tr>
            </thead>
            <tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pricetable']->value, 'price');
$_smarty_tpl->tpl_vars['price']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['price']->value) {
$_smarty_tpl->tpl_vars['price']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.com') {?> <tr>
                <td>.com</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.in') {?> <tr>
                <td>.in</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.co.in') {?> <tr>
                <td>.co.in</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.in') {?> <tr>
                <td>.info</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.info') {?> <tr>
                <td>.info</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.in') {?> <tr>
                <td>.biz</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.biz') {?> <tr>
                <td>.biz</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.xyz') {?> <tr>
                <td>.xyz</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.online') {?> <tr>
                <td>.online</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.org') {?> <tr>
                <td>.org</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr>
            </tbody> <?php }?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </table>
        </div>
      </div><?php }?> </div>
  </div>
</div>
<!-- Domain Pricing table end -->
<section class="section-gap">
  <div class="container">
    <div class="row align-items-center gy-4 gy-lg-0">
      <div class="col-lg-6">
        <div class="section-head">
          <h2>Free Private Registration</h2>
          <p>Enhance your online security with our complimentary Domain Privacy Protection. Shield sensitive information associated with your domain from public access, preventing spam and safeguarding against identity theft. Rest easy knowing your privacy is prioritized. Register now to fortify your online presence with confidence and peace of mind.</p>
          <div class="inline-btns mt-3">
            <a class="btn-01" onClick="document.getElementById('Domain').scrollIntoView();">Get Started Now <i class="fas fa-long-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="text-center text-lg-center d-block w-100">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/5.svg" alt="Free Private Registration" width="400">
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-gap section-bg bg1">
  <div class="container">
    <div class="row align-items-center gy-4 gy-lg-0 flex-row-reverse">
      <div class="col-lg-6">
        <div class="section-head">
          <h2>Free Subdomains</h2>
          <p>Unlock the power of subdomains for free! Expand your online presence with our complimentary subdomain service. Create unique web addresses under your main domain, perfect for organizing content or launching new projects. Enjoy the flexibility and convenience without any extra cost. Get started today and harness the full potential of your domain with our user-friendly subdomain feature.</p>
          <div class="inline-btns mt-3">
            <a class="btn-01" onClick="document.getElementById('Domain').scrollIntoView();">Get Started Now <i class="fas fa-long-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="text-center text-lg-center d-block w-100">
          <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/4.svg" alt="Free Private Registration" width="400">
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
          <h2>FREE Add-ons with every Domain Name!</h2>
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
            <h3>Free Email Account</h3>
            <p>Receive 2 personalized Email Addresses such as mail@yourdomain.com with free fraud, spam and virus protection. </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/worldwide.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>Domain Forwarding</h3>
            <p>Point your domain name to another website for free! Redirect users when they type your domain name into a browser (with/without domain masking & SEO) </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/html.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>DNS Management</h3>
            <p>Free lifetime DNS service which allows you to manage your DNS records on our globally distributed and highly redundant DNS infrastructure. </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/internet.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>Domain Theft Protection</h3>
            <p>Protect your Domain from being transferred out accidentally or without your permission with our free Domain Theft Protection.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/message.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>Free Mail Forwards</h3>
            <p>Create free email forwards and automatically redirect your email to existing email accounts. </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/tools.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>Easy to use Control Panel</h3>
            <p>Use our intuitive Control Panel to manage your domain name, configure email accounts, renew your domain name and buy more services.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="services-two">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/settings.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>Bulk Tools</h3>
            <p>Easy-to-use bulk tools to help you Register, Renew, Transfer and make other changes to several Domain Names in a single step.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><?php }
}

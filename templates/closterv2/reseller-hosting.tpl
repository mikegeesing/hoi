{*
 **********************************************************
 * Developed by: RedCheap Theme Team
 * Website: https://www.rctheme.com
 **********************************************************
*}
<!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1>Powerful Linux <span class="hrline">Reseller</span> Hosting </h1>
            <ul class="banner-list mb-2">
              <li>State-of-the-Art Hosting Infrastructure</li>
              <li>99.9% Uptime Guarantee</li>
              <li>30-Day Money-Back Guarantee</li>
              <li>Get started within minutes</li>
            </ul> {if count($resellerhosting) gt 0 && ($resellerhosting.0.monthly gt 0 || $resellerhosting.0.annually gt 0 || $resellerhosting.0.biennially gt 0 || $resellerhosting.0.triennially gt 0)} {foreach $resellerhosting as $productKey => $myproduct} {if $productKey eq 0} <h4>Starting Price {$myproduct.prefix}{$myproduct.monthly}/mo</h4> {/if} {/foreach}{/if} <div class="inline-btns mt-3">
              <a class="btn-01" onclick="document.getElementById('Plans').scrollIntoView();">View Plans</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
          <div class="text-center text-lg-end">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/23.svg" alt="Banner image" width="450">
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
    <div class="row gy-4 gy-lg-0"> {if count($resellerhosting) gt 0 && ($resellerhosting.0.monthly gt 0 || $resellerhosting.0.annually gt 0 || $resellerhosting.0.biennially gt 0 || $resellerhosting.0.triennially gt 0)} {foreach $resellerhosting as $myproduct} <div class="col-lg-3 col-md-6">
        <div class="pricing-item-two">
          <h3>{$myproduct.name}</h3>
          <div class="price-box">
            <div class="monthly-price">
              <div class="price"> {$myproduct.prefix}{$myproduct.monthly} </div>
              <div class="duretion">Mo</div>
            </div>
            <div class="yearly-price">
              <div class="price"> {$myproduct.prefix}{$myproduct.annually} </div>
              <div class="duretion">Yr</div>
            </div>
            <div class="biannual-price">
              <div class="price"> {$myproduct.prefix}{$myproduct.biennially} </div>
              <div class="duretion">2 Yr</div>
            </div>
            <div class="triennial-price">
              <div class="price"> {$myproduct.prefix}{$myproduct.triennially} </div>
              <div class="duretion">3 Yr</div>
            </div>
          </div>
          <div class="pricing-body">
            <ul> {$myproduct.description} </ul>
          </div>
          <a class="pricing-item-btn" href="cart.php?a=add&pid={$myproduct.relid}">Purchase Now</a>
        </div>
      </div> {/foreach} {/if} </div>
  </div>
</section>
<section class="section-gap">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-7 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2>Why choose Reseller Hosting</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>Opt for Reseller Hosting to effortlessly manage multiple websites, enjoy customizable plans, and capitalize on potential revenue streams through hosting services for clients.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <ul class="feature-list">
          <li class="list-item">
            <div class="feature-img">
              <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/page_optimization.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>High Perfomance</h3>
              <p>Minimal page load time, maximum delight</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/tools.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Easy SSL Installation</h3>
              <p>Server Name Identification (SNI) available for SSL</p>
            </div>
          </li>
          <li class="list-item ">
            <div class="feature-img">
              <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/html.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Plesk Onyx Panel</h3>
              <p>Intuitive & Feature rich panel for your convenience</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/helpdesk.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Reliable Support</h3>
              <p>Our team is on call for any questions you may have</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/discount.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Instant Upgrades</h3>
              <p>Change to any Windows Shared Hosting plans when needed</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/internet.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Maximum Security</h3>
              <p>Infrastructure & Monitoring to protect your website</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/click.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Parallels Panel</h3>
              <p>1-Click App Installer</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/money_bag.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Money Back Guarante</h3>
              <p>Refunds - No questions asked within first 30 days</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/rocket.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Secure Webmail</h3>
              <p>Fast, Secure email included</p>
            </div>
          </li>
          <li class="list-item">
            <div class="feature-img">
              <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/website.png" alt="features icon">
            </div>
            <div class="feature-content">
              <h3>Build in ASP / .NET</h3>
              <p>Perfect for ASP.NET, PHP & MS SQL web development?</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section class="section-gap section-bg bg1">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-8 col-lg-8">
        <div class="section-head gap-bottom center with-line">
          <h2> Install a Shopping Cart, Photo Gallery</h2>
          <div class="lines">
            <span></span>
          </div>
          <p>a Blog or any other module in just 1 click 50+ Plugins - Powered by Softaculous</p>
        </div>
      </div>
    </div>
    <div class="overflow-auto pt-3 pb-2 pb-sm-3 pb-lg-4">
      <div class="just-one-click-images">
        <div class="just-one-click">
          <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/wordpress_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/joomla_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/limeservey_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/coppermine_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/phpbb_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/zencart_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/osticket_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/drupal_image.png" alt="Just one click image">
        </div>
        <div class="just-one-click">
          <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/phplist_image.png" alt="Just one click image">
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
          <h2>Reseller Hosting Powerful Features</h2>
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/settings_icon.png" alt="services icon">
          </div>
          <h4>WHM (Admin Control Panel) Features</h4>
          <ul class="banner-list mb-2">
            <li>Create Hosting Plans</li>
            <li>Set up and Modify Customer Accounts</li>
            <li>Receive Server Downtime Alerts </li>
            <li>Install 250+ applications and programming language modules</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>02</span>
          </div>
          <div class="icon">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/customer_experience.png" alt="services icon">
          </div>
          <h4>cPanel (Client Control Panel) Features</h4>
          <ul class="banner-list mb-2">
            <li>Upload and Manage Web Pages</li>
            <li>View Website Statistics with AWstats</li>
            <li>Brandable with your Company's Logo </li>
            <li>Install Over 250 Scripts with the Softaculous Script Library</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>03</span>
          </div>
          <div class="icon">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/discount.png" alt="services icon">
          </div>
          <h4>Programming Support</h4>
          <ul class="banner-list mb-2">
            <li>PHP: 8.3, 8.2 & 8.1</li>
            <li>Perl, Python, RoR, GD, cURL, CGI, mcrypt3</li>
            <li>Ruby On Rails </li>
            <li>Zend Optimizer, Zend Engine, ionCube Loader</li>
          </ul>
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
            <a class="btn-01" href="{$WEB_ROOT}/contact.php">Get Started Now <i class="fas fa-long-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="text-center text-lg-end d-block w-100">
          <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/26.svg" alt="Website migrate">
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
            <a> What is reseller hosting?</a>
            <p>Reseller Hosting allows you to create sub-packages within the allotted Disk Space and Bandwidth of your main Hosting package. You can use WHM to create Individual Custom packages (each with cPanel) and provision them to your Customers. Additionally, you can use WHMCS for billing (Not supported on the base plan). </p>
          </li>
          <li>
            <a> Which Control Panels do I get with a Reseller Hosting package? </a>
            <p>All Reseller Hosting packages come with 2 separate Control Panels - WHM and cPanel. WHM gives you administrative control of your Reseller Hosting package and cPanel allows your Customers to manage their individual Hosting packages. </p>
          </li>
          <li>
            <a> How can I create Sub-Packages and manage them? </a>
            <p>Your WHM Control Panel allows you to create individual Hosting packages and completely manage them. </p>
          </li>
          <li>
            <a> Does Linux Reseller Hosting come with any client billing solution? </a>
            <p>WHMCS can be purchased as an addon with our Reseller hosting, it's an all-in-one client management, support, and billing solution for online web hosting businesses. You can manage your clients successfully with the robust automation and support that WHMCS offers. </p>
          </li>
          <li>
            <a> How can my Customers manage their Individual Packages? </a>
            <p>Your Customers will be able to manage their own packages using cPanel. </p>
          </li>
          <li>
            <a> What are the advantages of reseller hosting?</a>
            <p>If you're a Web Designer/Developer you can host and manage all your websites/clients with one Reseller Hosting package instead of going through the hassle of managing multiple shared Hosting packages. This also lowers your Web Hosting costs significantly. Additionally, you can resell hosting as a value added feature to your existing business or as a separate entity. </p>
          </li>
          <li>
            <a> Can I upgrade between plans? </a>
            <p>Yes, you can upgrade your existing plan to a higher plan at any time. </p>
          </li>
          <li>
            <a> Do your Reseller Hosting plans include a One-Click Installer? </a>
            <p>Yes, all our Reseller Hosting plans come integrated with Softaculous - a popular and easy to use One-Click Installer. </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
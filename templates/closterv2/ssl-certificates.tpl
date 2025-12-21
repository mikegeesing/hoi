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
            <h1> Secure <span class="hrline"> your website</span> and customer data </h1>
            <ul class="banner-list mb-2">
              <li>Protect your customer's personal data</li>
              <li>Credit cards and identity information</li>
              <li>Getting an SSL certificate is the easiest way</li>
              <li>Increase your customer's confidence</li>
            </ul> {if count($sslproducts) gt 0 && ($sslproducts.0.monthly gt 0 || $sslproducts.0.annually gt 0 || $sslproducts.0.biennially gt 0 || $sslproducts.0.triennially gt 0)} {foreach $sslproducts as $productKey => $myproduct} {if $productKey eq 0} <h4>Vanaf {$myproduct.prefix}{$myproduct.annually}/yr</h4> {/if} {/foreach}{/if} <div class="inline-btns mt-3">
              <a class="btn-01" onclick="document.getElementById('Plans').scrollIntoView();">View Plans</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
          <div class="text-center text-lg-end">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/29.svg" alt="Banner image" width="500">
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
    <div class="row gy-4 gy-lg-0"> {if count($sslproducts) gt 0 && ($sslproducts.0.monthly gt 0 || $sslproducts.0.annually gt 0 || $sslproducts.0.biennially gt 0 || $sslproducts.0.triennially gt 0)} {foreach $sslproducts as $myproduct} <div class="col-lg-4 col-md-6">
        <div class="pricing-item-two">
          <h3>{$myproduct.name}</h3>
          <div class="price-box">
            <div class="monthly-price">
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/internet.png" alt="services icon">
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/rocket.png" alt="services icon">
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/discount.png" alt="services icon">
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/service_tools.png" alt="services icon">
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/money_bag.png" alt="services icon">
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
            <a class="btn-01" href="{$WEB_ROOT}/contact.php">Nu starten <i class="fas fa-long-arrow-right"></i>
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
    <div class="row align-items-center gy-4 gy-lg-0 flex-lg-row-reverse">
      <div class="col-lg-6">
        <div class="section-head">
          <h2>Host your website at the right place, secure, and fast. </h2>
          <p>Choose the perfect hosting solution for your website: secure, reliable, and blazing-fast servers ensure optimal performance. With top-notch security measures, your data is safe. Enjoy seamless integration, expert support, and lightning-fast speeds, providing visitors with an exceptional browsing experience. Elevate your online presence today!.</p>
          <div class="inline-btns mt-3">
            <a class="btn-01" onclick="document.getElementById('Plans').scrollIntoView();">Nu starten <i class="fas fa-long-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="text-center text-lg-start d-block w-100">
          <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/3.svg" alt="Host your website">
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
</section>
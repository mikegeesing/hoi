{* ********************************************************** * Developed by: RedCheap Theme Team * Website: https://www.rctheme.com ********************************************************** *}
<!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-start justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1>Domain Name <span class="hrline">Transfer</span>
            </h1>
            <p>Browse our step-by-step guide for domain transfers to ensure a quick and easy transfer. </p>
            <div class="domain-transfer-wrap mt-3 ps-0" id="Domain">
              <form class="domain-transfer-form domaintrans-form" id="frmDomainTransfer" method="post" action="cart.php?a=add&domain=transfer">
                <label class="label text-start" for="domainsearch">Domain Name</label>
                <input class="input" type="text" name="sld" id="domainsearch" placeholder="{$LANG.exampledomain}">
                <label class="label text-start" for="domaintld">Domain TLDS</label>
                <select id="domaintld" class="input">
                  <option value>.com</option>
                  <option value>.net</option>
                  <option value>.info</option>
                  <option value>.store</option>
                </select>
                <!-- <label class="label" for="youthcode">Transfer Auth Code</label><input class="input" type="text" id="youthcode" placeholder="EPP Auth Code" data-toggle="tooltip" data-placement="right" title="EPP Auth Code" data-original-title="EPP Auth Code"><span class="input-text">The Domain Transfer Auth Code needs to be obtained from the current Registrar of the domain name that you wish to transfer. <a href="">Learn More »</a></span> -->
                <button class="submit">
                  <span>Tranfer</span>
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
          <div class="text-center text-lg-end">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/6.svg" alt="Banner image" width="400">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- banner end -->
<div class="top-up-banner pb-4">
  <div class="container upside rounded bg-white shadow p-4"> {if count($pricetable) gt 0} <div class="row gy-4"> {foreach $pricetable as $price} {if $price.extension == '.com'} <div class="col-lg-3 col-md-6 col-12">
        <div class="domain-tld-price">
          <h3 class="name">.com</h3>
          <p class="content">Get the world’s most popular domain</p>
          <div class="price">
            <span class="starting">Starting at:</span>
            <h4 class="tldprice">{$price.prefix}{$price.msetupfee} /mo</h4>
          </div>
          <a class="link" href="{$WEB_ROOT}/transfer-domain.php">Order Now <i class="far fa-long-arrow-alt-right"></i>
          </a>
        </div>
      </div> {elseif $price.extension == '.in'} <div class="col-lg-3 col-md-6 col-12">
        <div class="domain-tld-price">
          <h3 class="name">.in</h3>
          <p class="content">Get the world’s most popular domain</p>
          <div class="price">
            <span class="starting">Starting at:</span>
            <h4 class="tldprice">{$price.prefix}{$price.msetupfee} /mo</h4>
          </div>
          <a class="link" href="{$WEB_ROOT}/transfer-domain.php">Order Now <i class="far fa-long-arrow-alt-right"></i>
          </a>
        </div>
      </div> {elseif $price.extension == '.co.in'} <div class="col-lg-3 col-md-6 col-12">
        <div class="domain-tld-price">
          <h3 class="name">.co.in</h3>
          <p class="content">Get the world’s most popular domain</p>
          <div class="price">
            <span class="starting">Starting at:</span>
            <h4 class="tldprice">{$price.prefix}{$price.msetupfee}/mo</h4>
          </div>
          <a class="link" href="{$WEB_ROOT}/transfer-domain.php">Order Now <i class="far fa-long-arrow-alt-right"></i>
          </a>
        </div>
      </div> {elseif $price.extension == '.info'} <div class="col-lg-3 col-md-6 col-12">
        <div class="domain-tld-price">
          <h3 class="name">.info</h3>
          <p class="content">Get the world’s most popular domain</p>
          <div class="price">
            <span class="starting">Starting at:</span>
            <h4 class="tldprice">{$price.prefix}{$price.msetupfee} /mo</h4>
          </div>
          <a class="link" href="{$WEB_ROOT}/transfer-domain.php">Order Now <i class="far fa-long-arrow-alt-right"></i>
          </a>
        </div>
      </div> {elseif $price.extension == '.biz'} <div class="col-lg-3 col-md-6 col-12">
        <div class="domain-tld-price">
          <h3 class="name">.biz</h3>
          <p class="content">Get the world’s most popular domain</p>
          <div class="price">
            <span class="starting">Starting at:</span>
            <h4 class="tldprice">{$price.prefix}{$price.msetupfee} /mo</h4>
          </div>
          <a class="link" href="{$WEB_ROOT}/transfer-domain.php">Order Now <i class="far fa-long-arrow-alt-right"></i>
          </a>
        </div>
      </div> {elseif $price.extension == '.xyz'} <div class="col-lg-3 col-md-6 col-12">
        <div class="domain-tld-price">
          <h3 class="name">.xyz</h3>
          <p class="content">Get the world’s most popular domain</p>
          <div class="price">
            <span class="starting">Starting at:</span>
            <h4 class="tldprice">{$price.prefix}{$price.msetupfee} /mo</h4>
          </div>
          <a class="link" href="{$WEB_ROOT}/transfer-domain.php">Order Now <i class="far fa-long-arrow-alt-right"></i>
          </a>
        </div>
      </div> {elseif $price.extension == '.online'} <div class="col-lg-3 col-md-6 col-12">
        <div class="domain-tld-price">
          <h3 class="name">.online</h3>
          <p class="content">Get the world’s most popular domain</p>
          <div class="price">
            <span class="starting">Starting at:</span>
            <h4 class="tldprice">{$price.prefix}{$price.msetupfee} /mo</h4>
          </div>
          <a class="link" href="{$WEB_ROOT}/transfer-domain.php">Order Now <i class="far fa-long-arrow-alt-right"></i>
          </a>
        </div>
      </div> {elseif $price.extension == '.org'} <div class="col-lg-3 col-md-6 col-12">
        <div class="domain-tld-price">
          <h3 class="name">.org</h3>
          <p class="content">Get the world’s most popular domain</p>
          <div class="price">
            <span class="starting">Starting at:</span>
            <h4 class="tldprice">{$price.prefix}{$price.msetupfee} /mo</h4>
          </div>
          <a class="link" href="{$WEB_ROOT}/transfer-domain.php">Order Now <i class="far fa-long-arrow-alt-right"></i>
          </a>
        </div>
      </div>{/if} {/foreach} </div> {/if} </div>
</div>
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/mail.png" alt="serices icon">
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/worldwide.png" alt="serices icon">
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/html.png" alt="serices icon">
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/internet.png" alt="serices icon">
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/message.png" alt="serices icon">
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/tools.png" alt="serices icon">
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/settings.png" alt="serices icon">
          </div>
          <div class="content">
            <h3>Bulk Tools</h3>
            <p>Easy-to-use bulk tools to help you Register, Renew, Transfer and make other changes to several Domain Names in a single step.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
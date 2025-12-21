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
            <h1>Simple, Powerful <span class="hrline">Email</span> for Small Businesses </h1>
            <ul class="banner-list mb-2">
              <li>5GB Storage Per Account</li>
              <li>Inbuilt Virus Protection</li>
              <li>Additional Storage Available</li>
            </ul> {if count($businessemailproducts) gt 0 && ($businessemailproducts.0.monthly gt 0 || $businessemailproducts.0.annually gt 0 || $businessemailproducts.0.biennially gt 0 || $businessemailproducts.0.triennially gt 0)} {foreach $businessemailproducts as $productKey => $myproduct} {if $productKey eq 0} <h4>Starting Price {$myproduct.prefix}{$myproduct.monthly}/mo</h4>{/if} {/foreach}{/if} <div class="inline-btns mt-3">
              <a class="btn-01" onclick="document.getElementById('Plans').scrollIntoView();">View Plans</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
          <div class="text-center text-lg-end">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/25.svg" alt="Banner image" width="500">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="top-up-banner pb-4" id="Plans">
  <div class="container upside rounded bg-white shadow p-4">
    <div class="row gy-4 gy-xl-0 justify-content-between"> {if count($businessemailproducts) gt 0 && ($businessemailproducts.0.monthly gt 0 || $businessemailproducts.0.annually gt 0 || $businessemailproducts.0.biennially gt 0 || $businessemailproducts.0.triennially gt 0)} {foreach $businessemailproducts as $myproduct} <div class="col-lg-5 col-xl-4 col-md-6">
        <div class="pricing-item">
          <div class="pricing-heading">
            <div class="name">{$myproduct.name}</div>
            <h4 class="title"> {$myproduct.prefix}{$myproduct.monthly} <span class="durection">/month</span>
            </h4>
          </div>
          <div class="pricing_body">
            <ul> {$myproduct.description} </ul>
            <a class="btn-01 d-block mt-3 w-100" href="cart.php?a=add&pid={$myproduct.relid}">Select Plan</a>
          </div>
        </div>
      </div> {/foreach} {/if} </div>
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
            <p>Point your domain name to another website for free! Redirect users when they type your domain name into a browser (with/without domain masking &amp; SEO) </p>
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
          <h2>What's amazing about Business Email</h2>
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
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/responsive.png" alt="services icon">
          </div>
          <h4>Intuitive and Responsive Design</h4>
          <p>Beautifully designed state of the art webmail platform. You can also access your email on your smartphone or tablet.</p>
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
          <h4>Inbuilt Virus Protection</h4>
          <p>Our advanced anti-virus technology secured your inbox and ensures that you are protected from downloading malware and viruses.</p>
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
          <h4>5GB Storage Plus Backup </h4>
          <p>In addition to 5GB mail storage, your emails are backed up in our state-of-the-art infrastructure so that you never lose important mails.</p>
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
          <h4>Get Additional Storage @ Rs. 44.21/5GB</h4>
          <p>Simplify your workflow with easy setup and seamless integration, ensuring swift implementation and smooth operation across your existing systems.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>05</span>
          </div>
          <div class="icon">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/price.png" alt="services icon">
          </div>
          <h4>100% Uptime and Security</h4>
          <p>Our high-end mail storage infrastructure guarantees zero data loss and redundancy, along with 100% network uptime.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="number-box">
            <span>06</span>
          </div>
          <div class="icon">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/helpdesk.png" alt="services icon">
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
            <a> How will purchasing Business Email benefit me?</a>
            <p>As opposed to free email solutions, you can give your business a more professional image with Business Email by getting email that is branded with your company's domain name (ex. sales@mybrand.com). In addition, you also benefit from our advanced email technology that gives you the least latency and industry-best uptime, scalability and reliability. An email service being served out of the cloud also means no IT, hardware, software, bandwidth or people costs. And the best part is that you can add email accounts as and when your team grows. </p>
          </li>
          <li>
            <a> Which Email Clients and protocols are supported? </a>
            <p>You can send and receive emails using any desktop-based email client such as Microsoft Outlook, Outlook Express, Mozilla Thunderbird, Eudora, Entourage 2004, Windows Mail, etc. We also have a guide on how you can configure different email clients to send/receive emails. The enterprise email product supports the POP, IMAP and MAPI protocols. </p>
          </li>
          <li>
            <a> How do I use my Webmail Interface? </a>
            <p>To access your Webmail Interface, you can use the white-labelled <strong>URL: http://webmail.yourdomainname.com</strong>. Once on the log in page, you would need to login with your email address and the corresponding password. </p>
          </li>
          <li>
            <a> Which mobile phones can I access my mail from? </a>
            <p>Your email can be accessed using any Smartphone or Tablet. Our fluidic webmail, built on HTML 5 & Javascript, is compatible on all major Operating systems such as iOS, Android, Windows Mobile, Symbian and Blackberry. </p>
          </li>
          <li>
            <a> What is the space provided per Email Account? </a>
            <p>Each email account comes with 5 GB space dedicated to emails. </p>
          </li>
          <li>
            <a> What ports do I need to use for Email Hosting?</a>
            <p>Usually, the port used for the Outgoing Mail Server/SMTP Service is 25. However, there might be a situation where your ISP might be blocking the use of port 25 for SMTP service. To circumvent this you can use an alternate port 587 for sending mails.</p>
          </li>
          <li>
            <a> Can I create mailing lists? </a>
            <p>Yes, you can create mailing lists and add/delete users, select a moderator, restrict people from joining a list or even ban users from a list. More information on this can be found in our knowledgebase. </p>
          </li>
          <li>
            <a> What is your SPAM policy? </a>
            <p>We take a zero tolerance stance against sending of unsolicited email, bulk emailing, and spam. "Safe lists", purchased lists, and selling of lists will be treated as spam. Any user who sends out spam will have their account terminated with or without notice. </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
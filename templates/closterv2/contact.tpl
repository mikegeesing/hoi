{if $sent} {include file="$template/includes/alert.tpl" type="success" msg=$LANG.contactsent textcenter=true} {/if} {if $errormessage} {include file="$template/includes/alert.tpl" type="error" errorshtml=$errormessage} {/if} {if !$sent}
<!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1>
              <span class="hrline"> Contact!</span> Reach out. We're here.
            </h1>
            <ul class="banner-list mb-2">
              <li>Locate the "Contact Us" section</li>
              <li>Fill out the provided form</li>
              <li>Submit your inquiry</li>
              <li>Await our prompt response</li>
            </ul>
            <div class="inline-btns mt-3">
              <a class="btn-01" onclick="document.getElementById('contact').scrollIntoView();">View Plans</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
          <div class="text-center text-lg-end">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/32.svg" alt="Banner image" width="400">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="top-up-banner pb-4" id="contact">
  <div class="container upside rounded bg-white shadow p-4">
    <div class="row text-center">
      <div class="section-head gap-bottom center">
        <h2>Contact Us</h2>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8 ">
        <form method="post" action="contact.php" role="form" class="php-email-form form">
          <input type="hidden" name="action" value="send" />
          <div class="contact-form">
            <div class="row justify-content-between g-4">
              <div class="col-lg-6">
                <input class="input form-control" type="text" name="name" value="{$name}" id="inputName" placeholder="Enter Name">
              </div>
              <div class="col-lg-6">
                <input class="input form-control" id="inputEmail" type="email" name="email" value="{$email}" placeholder="Enter Email">
              </div>
              <div class="col-12">
                <input class="input form-control" type="subject" name="subject" value="{$subject}" id="inputSubject" placeholder="subject">
              </div>
              <div class="col-12">
                <textarea class="input form-control" name="message" rows="7" style="height:unset;" id="inputMessage" placeholder="Enter Message"></textarea>
              </div> {if $captcha} <div class="text-center margin-bottom col-12"> {include file="$template/includes/captcha.tpl"} </div> {/if} <div class="col-12">
                <button class="btn-01 mt-4 {$captcha->getButtonClass($captchaForm)}" type="submit"> Submit Comment </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<section class="section-gap">
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="icon">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/home_address.png" alt="services icon">
          </div>
          <h4>Address</h4>
          <p>12 Gautam Street, Vaishalinagar, Jaipur Pin-303804 ,Country-INDIA</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="icon">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/mail.png" alt="services icon">
          </div>
          <h4>Email </h4>
          <p>demo@gmail.com <br>xyz@gmail.com </p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="icon">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/helpdesk.png" alt="services icon">
          </div>
          <h4>Phone</h4>
          <p>+91-9876543210 <br>+0141-9876543210 </p>
        </div>
      </div>
    </div>
  </div>
</section> {/if} <style>
  #main-body {
    background-color: #ffffff !important;
    padding: 0 !important;
  }

  label {
    font-weight: 500;
  }
</style>
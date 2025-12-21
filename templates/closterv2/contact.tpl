{if $sent} {include file="$template/includes/alert.tpl" type="success" msg=$LANG.contactsent textcenter=true} {/if} {if $errormessage} {include file="$template/includes/alert.tpl" type="error" errorshtml=$errormessage} {/if} {if !$sent}
<!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1>
              <span class="hrline"> Contact!</span> Stuur ons een bericht. We zijn hier.
            </h1>
            <ul class="banner-list mb-2">
              <li>Vind de sectie 'Contact met ons'</li>
              <li>Vul het formulier in</li>
              <li>Dien je vraag in</li>
              <li>Wacht op ons snelle antwoord</li>
            </ul>
            <div class="inline-btns mt-3">
              <a class="btn-01" onclick="document.getElementById('contact').scrollIntoView();">Bekijk plannen</a>
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
        <h2>Neem contact met ons op</h2>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8 ">
        <form method="post" action="contact.php" role="form" class="php-email-form form">
          <input type="hidden" name="action" value="send" />
          <div class="contact-form">
            <div class="row justify-content-between g-4">
              <div class="col-lg-6">
                <input class="input form-control" type="text" name="name" value="{$name}" id="inputName" placeholder="Voer naam in">
              </div>
              <div class="col-lg-6">
                <input class="input form-control" id="inputEmail" type="email" name="email" value="{$email}" placeholder="Voer e-mail in">
              </div>
              <div class="col-12">
                <input class="input form-control" type="subject" name="subject" value="{$subject}" id="inputSubject" placeholder="onderwerp">
              </div>
              <div class="col-12">
                <textarea class="input form-control" name="message" rows="7" style="height:unset;" id="inputMessage" placeholder="Voer bericht in"></textarea>
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
          <h4>Adres</h4>
          <p>Online Hoster, Nederland</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="icon">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/mail.png" alt="services icon">
          </div>
          <h4>E-mail</h4>
          <p><a href="mailto:Sales@onlinehoster.nl">Sales@onlinehoster.nl</a> <br><a href="mailto:Support@onlinehoster.nl">Support@onlinehoster.nl</a> </p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="icon">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/helpdesk.png" alt="services icon">
          </div>
          <h4>Telefoon</h4>
          <p>Contacteer via e-mail <br>voor snel antwoord </p>
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
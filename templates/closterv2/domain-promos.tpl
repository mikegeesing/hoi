{* ********************************************************** * Developed by: RedCheap Theme Team * Website: https://www.rctheme.com ********************************************************** *}
<!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <p>Currently Running Promos</p>
            <h1>Domain Promos</h1>
            <ul class="banner-list mb-2">
              <li>Discounted Registrations</li>
              <li>Free Privacy Protection</li>
              <li>Multi-Year Discounts</li>
              <li>Bonus Add-ons</li>
            </ul>
            <h4>Don't miss out, check our promos today!</h4>
            <div class="inline-btns mt-3">
              <a class="btn-01" onclick="document.getElementById('Plans').scrollIntoView();">Get Started Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
          <div class="text-center text-lg-end">
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/7.svg" alt="Banner image" width="400">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Domain Pricing table -->
<div class="top-up-banner pb-4" id="Plans">
  <div class="container upside rounded bg-white shadow p-4">
    <div class="row">{if count($pricetable) gt 0} <div class="col-12">
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
            <tbody>{foreach $pricetable as $price} {if $price.extension == '.com'} <tr>
                <td>.com</td>
                <td>1 Year</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
              </tr> {elseif $price.extension == '.in'} <tr>
                <td>.in</td>
                <td>1 Year</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
              </tr> {elseif $price.extension == '.co.in'} <tr>
                <td>.co.in</td>
                <td>1 Year</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
              </tr> {elseif $price.extension == '.in'} <tr>
                <td>.info</td>
                <td>1 Year</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
              </tr> {elseif $price.extension == '.info'} <tr>
                <td>.info</td>
                <td>1 Year</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
              </tr> {elseif $price.extension == '.in'} <tr>
                <td>.biz</td>
                <td>1 Year</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
              </tr> {elseif $price.extension == '.biz'} <tr>
                <td>.biz</td>
                <td>1 Year</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
              </tr> {elseif $price.extension == '.xyz'} <tr>
                <td>.xyz</td>
                <td>1 Year</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
              </tr> {elseif $price.extension == '.online'} <tr>
                <td>.online</td>
                <td>1 Year</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
              </tr> {elseif $price.extension == '.org'} <tr>
                <td>.org</td>
                <td>1 Year</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
                <td>{$price.prefix}{$price.msetupfee}</td>
              </tr>
            </tbody> {/if} {/foreach}
          </table>
        </div>
      </div>{/if} </div>
  </div>
</div>
<!-- Domain Pricing table end -->
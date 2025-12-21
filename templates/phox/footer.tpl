{if file_exists("templates/$template/packages/overwrites/footer.tpl")}
  {include file="{$template}/packages/overwrites/footer.tpl"}
{else}
  </div><!-- /.main-content -->
  <div class="clearfix"></div>
  </div>
  </div>
  </section>

  {if $Phox['pages']['global-settings']['show-footer']['value'] == true}
    <section id="footer">
      <div class="container">
        <div class="wdes-footer-wrapper">
          {* Copyrights *}
          <p class="copyrights">{lang key="copyrightFooterNotice" year=$date_year company=$companyname}</p>

          {* Languages *}
          {if $languagechangeenabled && count($locales) > 1}
            <div class="languages-list">
                <button type="button" class="dropdown-toggle choose-language btn" data-toggle="dropdown">
                    {$activeLocale.localisedName}
                    <i class="fas fa-chevron-up"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li class="language-search-dropdown">
                    <i class="far fa-search"></i>
                    <input type="text" class="form-control dropdown-search" placeholder="{$LANG.search}...">
                  </li>
                  {foreach $locales as $locale}
                    <li>
                      <a href="{$currentpagelinkback}language={$locale.language}" class="{if $activeLocale.language == $locale.language}active{/if}">
                        <span class="language-flag-icon {$locale.language}"></span>
                        <span>{$locale.localisedName}</span>
                      </a>
                    </li>
                  {/foreach}
                </ul>
            </div>
          {/if}

          {* Back to top *}
          <a href="#" class="wdes-back-to-top"><i class="fad fa-arrow-to-top"></i></a>
        </div>
      </div>
    </section>
  {/if}
  <div id="fullpage-overlay" class="hidden">
    <div class="outer-wrapper">
      <div class="inner-wrapper">
        <img src="{$WEB_ROOT}/assets/img/overlay-spinner.svg">
        <br>
        <span class="msg"></span>
      </div>
    </div>
  </div>

  <div class="modal system-modal fade" id="modalAjax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content panel-primary">
        <div class="modal-header panel-heading">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">{$LANG.close}</span>
          </button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body panel-body">
          {$LANG.loading}
        </div>
        <div class="modal-footer panel-footer">
          <div class="pull-left loader">
            <i class="fas fa-circle-notch fa-spin"></i>
            {$LANG.loading}
          </div>
          <button type="button" class="btn btn-default" data-dismiss="modal">
            {$LANG.close}
          </button>
          <button type="button" class="btn btn-primary modal-submit">
            {$LANG.submit}
          </button>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  {include file="$template/includes/generate-password.tpl"}
  <script>
    $('strong:contains("Dev License")').closest('div').css('display', 'none');
  </script>
  <script src="{$WEB_ROOT}/templates/{$template}/wdes/js/custom.js"></script>
  {$footeroutput}

  </body>

  </html>
{/if}
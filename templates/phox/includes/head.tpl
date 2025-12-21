{if file_exists("templates/$template/packages/overwrites/includes/head.tpl")}
  {include file="{$template}/packages/overwrites/includes/head.tpl"}
{else}
  <!-- Styling -->
  {\WHMCS\View\Asset::fontCssInclude('open-sans-family.css')}
  {\WHMCS\View\Asset::fontCssInclude('raleway-family.css')}
  <link href="//fonts.googleapis.com/css?family={$wdes_phox_typo.fonts_family}:100,200,300,400,500,600,700,800,900"
    rel="stylesheet">
  <link href="{assetPath file='all.min.css'}?v={$versionHash}" rel="stylesheet">
  {if $language == 'arabic' || $language == 'hebrew' || $language == 'farsi'}
    <link href="{assetPath file='bootstrap-rtl.min.css'}?v={$versionHash}" rel="stylesheet">
  {/if}
  <link href="{$WEB_ROOT}/assets/css/fontawesome-all.min.css" rel="stylesheet">
  <link href="{assetPath file='core.css'}?v={$versionHash}" rel="stylesheet">
  {if ! empty($phoxTemplateName) && file_exists("{$smarty.const.ROOTDIR}/templates/{$phoxName}/wdes/css/{$phoxTemplateName}.css")
    eq true}
    <link href="{$WEB_ROOT}/templates/phox/wdes/css/{$phoxTemplateName}.css" rel="stylesheet">
  {/if}
  {if $language == 'arabic' || $language == 'hebrew' || $language == 'farsi'}
    <link href="{assetPath file='custom-rtl.css'}?v={$versionHash}" rel="stylesheet">
  {/if}
  {assetExists file="custom.css"}
  <link href="{$__assetPath__}" rel="stylesheet">
  {/assetExists}
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

  <script type="text/javascript">
    var csrfToken = '{$token}',
    markdownGuide = '{lang|addslashes key="markdown.title"}',
    locale = '{if !empty($mdeLocale)}{$mdeLocale}{else}en{/if}',
    saved = '{lang|addslashes key="markdown.saved"}',
    saving = '{lang|addslashes key="markdown.saving"}',
    whmcsBaseUrl = "{\WHMCS\Utility\Environment\WebHelper::getBaseUrl()}";
  {if $captcha}{$captcha->getPageJs()}{/if}
  </script>
  <script src="{assetPath file='scripts.min.js'}?v={$versionHash}"></script>

  {* Style Vars *}
  <style>
    :root {
      --main-clr: {$wdes_phox_color.primary};
      --domain-btn: {$wdes_phox_color.secondary};
      --main-font: {$wdes_phox_typo.fonts_family};
      --heading-weight: {$wdes_phox_typo.heading.weight};
      --heading-size: {$wdes_phox_typo.heading.size}px;
      --buttons-weight: {$wdes_phox_typo.buttons.weight};
      --buttons-size: {$wdes_phox_typo.buttons.size}px;
      --description-weight: {$wdes_phox_typo.description.weight};
      --description-size: {$wdes_phox_typo.description.size}px;
    }
  </style>
{/if}
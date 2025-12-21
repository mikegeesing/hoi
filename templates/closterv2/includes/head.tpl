<!-- Styling -->
<!--{\WHMCS\View\Asset::fontCssInclude('open-sans-family.css')}
{\WHMCS\View\Asset::fontCssInclude('raleway-family.css')}-->
<link href="{assetPath file='all.min.css'}?v={$versionHash}" rel="stylesheet">
<link href="{$WEB_ROOT}/assets/css/fontawesome-all.min.css" rel="stylesheet">
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

{if $templatefile == "viewticket" && !$loggedin}
  <meta name="robots" content="noindex" />
{/if}

<link rel="shortcut icon" type="image/x-icon" href="{$WEB_ROOT}/templates/{$template}/custom/assets/images/favicon.png">


<!-- Google Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link
         href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
         rel="stylesheet">
      <!-- bootstrap CSS -->
      <link href="{$WEB_ROOT}/templates/{$template}/custom/assets/vendor/bootstrap/css/bootstrap.min.css"
         rel="stylesheet">
      <!-- bootstrap icons -->
      <link href="{$WEB_ROOT}/templates/{$template}/custom/assets/vendor/bootstrap-icons/bootstrap-icons.css"
         rel="stylesheet">
      <!-- remix Icons -->
      <link href="{$WEB_ROOT}/templates/{$template}/custom/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
      <!-- swiper-slider CSS -->
      <link href="{$WEB_ROOT}/templates/{$template}/custom/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
      <!-- Main Style CSS -->
      <link href="{$WEB_ROOT}/templates/{$template}/custom/assets/css/main.css" rel="stylesheet">



      <link rel="stylesheet" type="text/css" href="{$WEB_ROOT}/templates/{$template}/css/whmcs.css">
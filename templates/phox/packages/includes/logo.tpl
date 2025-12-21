<a href="{if $wdes_phox_brand.logo_switcher && !empty($wdes_phox_brand.logo_link)}{$wdes_phox_brand.logo_link}{else}{$WEB_ROOT}/index.php{/if}"
    class="logo">
    {* Dark Logo *}
    <img src="{$WEB_ROOT}/templates/{$template}/img/logo-dark.png" class="phox-logo phox-logo-default phox-logo--dark"
        alt="{$companyname}" />

    {* Light Logo *}
    <img src="{$WEB_ROOT}/templates/{$template}/img/logo-light.png" class="phox-logo phox-logo-default phox-logo--light"
        alt="{$companyname}" />

    {* Dark Logo Icon *}
    <img src="{$WEB_ROOT}/templates/{$template}/img/logo-dark-icon.png"
        class="phox-logo phox-logo-icon phox-logo-icon--dark" alt="{$companyname}" />

    {* Light Logo Icon *}
    <img src="{$WEB_ROOT}/templates/{$template}/img/logo-light-icon.png"
        class="phox-logo phox-logo-icon phox-logo-icon--light" alt="{$companyname}" />
</a>
{include file="$template/includes/network-issues-notifications.tpl"}

<!--for single navbar include this "tt-single-navbar.tpl" file
and for double navbar then include this "tt-double-navbar.tpl" file-->
{include file="$template/includes/tt/hostlar/tt-single-navbar.tpl"}

<!--light dark mode switcher-->
{include file="$template/includes/tt/hostlar/tt-light-dark-switcher.tpl"}

{if $templatefile != 'homepage'}
    {include file="$template/includes/tt/hostlar/tt-page-header.tpl"}
{/if}

{include file="$template/includes/validateuser.tpl"}
{include file="$template/includes/verifyemail.tpl"}

{if $templatefile == 'homepage'}
    {include file="$template/includes/tt/hostlar/tt-hero.tpl"}
    {include file="$template/includes/tt/hostlar/tt-promo.tpl"}
{/if}

{if $templatefile == 'homepage'}
    {include file="$template/includes/tt/hostlar/tt-pricing.tpl"}
{/if}


{if $templatefile == 'homepage'}
    {include file="$template/includes/tt/hostlar/tt-services.tpl"}
    {include file="$template/includes/tt/hostlar/tt-testimonial.tpl"}
    {include file="$template/includes/tt/hostlar/tt-account-link.tpl"}
{/if}


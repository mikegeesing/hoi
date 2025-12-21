
{if !in_array($templatefile, ['login', 'clientregister', 'password-reset-container', 'logout', 'store/ox/index', 'store/sitelockvpn/index', 'store/sitelock/index'])}
<div class="banner-one">
    <div class="banner-section">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8">
                    <div class="banner-heading text-center">
                        <h1>{if $clientareaaction === '' && $clientareaaction !== NULL}
        {lang key="My Dashboard"}
        {else}
        {$displayTitle}
        {/if}</h1>{if $tagline}
                        <p>{$tagline}</p>
                        {/if}
                        <ol class="d-inline-block bg-transparent list-inline py-0 pl-0 w-100 text-center mt-3">
          {foreach $breadcrumb as $item}
          <li class="list-inline-item color-body breadcrumb-item{if $item@last} active{/if}"> {if !$item@last}<a href="{$item.link}" class="color-primary">{/if}
            {$item.label}
            {if !$item@last}</a> {/if} </li>
          {/foreach}
         </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{/if}



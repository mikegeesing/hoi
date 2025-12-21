<section class="bg-gradient">
    <div class="ptb-60">
        <div class="container">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="tt-hero text-white">
                        <h1 class="text-white font-weight-bold">{$LANG.homebegin}</h1>
                        <p class="lead mt-3 mb-4">{$LANG.homebegininfo}</p>

                        {if $registerdomainenabled || $transferdomainenabled}
                            {include file="$template/includes/tt/hostlar/tt-domain-search.tpl"}
                        {/if}
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="tt-animated-img-wrap">
                        <img src="{$WEB_ROOT}/templates/{$template}/img/tt-servers.svg" class="hero-img img-fluid" alt="server image">
                        <img src="{$WEB_ROOT}/templates/{$template}/img/tt-animate-icon-1.png" class="tt-animated-icon tt-a-icon-1" alt="animated">
                        <img src="{$WEB_ROOT}/templates/{$template}/img/tt-animate-icon-2.png" class="tt-animated-icon tt-a-icon-2" alt="animated">
                        <img src="{$WEB_ROOT}/templates/{$template}/img/tt-animate-icon-3.png" class="tt-animated-icon tt-a-icon-3" alt="animated">
                        <img src="{$WEB_ROOT}/templates/{$template}/img/tt-animate-icon-4.png" class="tt-animated-icon tt-a-icon-4" alt="animated">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tt-shape position-relative text-center">
        <img src="{$WEB_ROOT}/templates/{$template}/img/hero-bottom-shape-1.svg" class="img-fluid" alt="support image">
    </div>
</section>

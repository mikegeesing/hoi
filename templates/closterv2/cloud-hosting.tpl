{*
**********************************************************
* Developed by: RedCheap Theme Team
* Website: https://www.rctheme.com
**********************************************************
*}

<!-- banner start -->
<div class="banner-one">
    <div class="banner-section bottom-up">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6">
                    <div class="banner-heading">
                        <h1>Simplicity of Shared Hosting with the Power of <span
                                class="hrline">Cloud</span></h1>
                        <ul class="banner-list mb-2">
                            <li>Full SSD servers</li>
                            <li>Scales with your traffic</li>
                            <li>Scalable resources, reliable performance,
                                flexibility.</li>
                            <li>Scalability and reliability for optimal
                                performance.</li>
                        </ul>
                        {if count($cloudproducts) gt 0 && ($cloudproducts.0.monthly gt 0 || $cloudproducts.0.annually gt 0 || $cloudproducts.0.biennially gt 0 || $cloudproducts.0.triennially gt 0)}

{foreach $cloudproducts as $productKey => $myproduct}

{if $productKey eq 0}
                        <h4>Vanaf {$myproduct.prefix}{$myproduct.monthly}/mnd</h4>{/if}

{/foreach}{/if}
                        <div class="inline-btns mt-3">
                            <a class="btn-01"
                                onclick="document.getElementById('Plans').scrollIntoView();">View
                                Plans</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="text-center text-lg-end">
                        <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/40.svg" alt="Banner image"
                            width="500">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="top-up-banner pb-4" id="Plans">
    <div class="container upside rounded bg-white shadow p-4">
        <div class="row gy-4 gy-xl-0 justify-content-between">
            {if count($cloudproducts) gt 0 && ($cloudproducts.0.monthly gt 0 || $cloudproducts.0.annually gt 0 || $cloudproducts.0.biennially gt 0 || $cloudproducts.0.triennially gt 0)}

{foreach $cloudproducts as $myproduct}
            <div class="col-lg-5 col-xl-4 col-md-6">
                <div class="pricing-item">
                    <div class="pricing-heading">
                        <div class="name">{$myproduct.name}</div>
                        <h4 class="title">
                            {$myproduct.prefix}{$myproduct.monthly} <span class="durection">/mo</span>
                        </h4>
                    </div>
                    <div class="pricing_body">
                        <ul>
                            {$myproduct.description}
                        </ul>
                        <a class="btn-01 d-block mt-3 w-100" href="cart.php?a=add&pid={$myproduct.relid}">Select
                            Plan</a>
                    </div>
                </div>
            </div>
            {/foreach}

{/if}
        </div>
    </div>
</section>

<section class="section-gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-8 col-lg-8">
                <div class="section-head gap-bottom center with-line">
                    <h2>Technical Specifications</h2>
                    <div class="lines"> <span></span> </div>
                    <p>Cloud Hosting Technical Specifications</p>
                </div>
            </div>
        </div>
        <div class="row gy-4 gy-lg-0">
            <div class="col-lg-3 col-md-6">
                <div class="underhood-content">
                    <h4>Software</h4>
                    <ul>
                        <li>CentOS 7.x*</li>
                        <li>Latest cPanel stable release</li>
                        <li>PHP - 8.3, 8.2 & 8.1</li>
                        <li>Perl, Ruby, Zend</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="underhood-content">
                    <h4>Databases</h4>
                    <ul>
                        <li>MySql Server 5.7</li>
                        <li>phpMyAdmin 5.2.1</li>
                        <li>InnoDB</li>
                        <li>SFTP for security</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="underhood-content">
                    <h4>Additional Software</h4>
                    <ul>
                        <li>Secure Shell Access</li>
                        <li>jQuery</li>
                        <li>RubyOnRails</li>
                        <li>Zend Optimizer</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="underhood-content">
                    <h4>Security</h4>
                    <ul>
                        <li>Hotlink Protection</li>
                        <li>Leech Protection</li>
                        <li>DDoS Protection</li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button class="btn-01 mt-4" data-toggle="modal"
                    data-target="#underhoodModal">View All Tech
                    Specs</button>

               
            </div>
             <div class="modal fade" id="underhoodModal" tabindex="-1"
                    aria-labelledby="underhoodModalLabel" style="display: none;"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5"
                                    id="underhoodModalLabel">Technical
                                    Specifications</h1>
                                <button type="button" class="btn-close"
                                    data-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row gy-4 gy-lg-0">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="underhood-content">
                                            <h4>Software</h4>
                                            <ul>
                                                <li>CentOS 7.x*</li>
                                                <li>Latest cPanel stable
                                                    release</li>
                                                <li>PHP - 8.3, 8.2 & 8.1</li>
                                                <li>Perl, Ruby, Zend</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="underhood-content">
                                            <h4>Databases</h4>
                                            <ul>
                                                <li>MySql Server 5.7</li>
                                                <li>phpMyAdmin 5.2.1</li>
                                                <li>InnoDB</li>
                                                <li>SFTP for security</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="underhood-content">
                                            <h4>Additional Software</h4>
                                            <ul>
                                                <li>Secure Shell Access</li>
                                                <li>jQuery</li>
                                                <li>RubyOnRails</li>
                                                <li>Zend Optimizer</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="underhood-content">
                                            <h4>Security</h4>
                                            <ul>
                                                <li>Hotlink Protection</li>
                                                <li>Leech Protection</li>
                                                <li>DDoS Protection</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>

<section class="section-gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-7 col-lg-8">
                <div class="section-head gap-bottom center with-line">
                    <h2>What Does Cloud Hosting mean for your Website?</h2>
                    <div class="lines"> <span></span> </div>
                    <p>Next-level Performance and Reliability with Simplified
                        Management</p>
                </div>
            </div>
        </div>
        <div class="row g-4 gy-lg-5">
            <div class="col-lg-6">
                <div class="services-two">
                    <div class="icon">
                        <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/page_optimization.png"
                            alt="serices icon">
                    </div>
                    <div class="content">
                        <h3>Blazing-Fast Load Time</h3>
                        <p>With full SSD storage, highly optimized servers, and
                            state of the art NGINX caching, host websites at
                            best-in-class speeds. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="services-two">
                    <div class="icon">
                        <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/coding.png" alt="serices icon">
                    </div>
                    <div class="content">
                        <h3>Instant Scaling</h3>
                        <p>No need to move your hosting as your traffic grows.
                            Ramp up your resources at the click of a button -
                            instantly add RAM and CPU without a reboot. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="services-two">
                    <div class="icon">
                        <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/tools.png" alt="serices icon">
                    </div>
                    <div class="content">
                        <h3>cPanel for Management</h3>
                        <p>Just like Shared Hosting - manage your website and
                            associated services like Email and sub-domains with
                            the simplicity and ease of cPanel. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="services-two">
                    <div class="icon">
                        <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/server.png" alt="serices icon">
                    </div>
                    <div class="content">
                        <h3>Fully managed servers </h3>
                        <p>Server management, patches and bug fixes are handled
                            by our experts to ensure you can focus on building
                            and running your website.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="services-two">
                    <div class="icon">
                        <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/settings_icon.png"
                            alt="serices icon">
                    </div>
                    <div class="content">
                        <h3>Quick Setup</h3>
                        <p>You can use your Cloud Hosting package from the
                            moment you have completed your purchase - no delays,
                            no elaborate setups! </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="services-two">
                    <div class="icon">
                        <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/click.png" alt="serices icon">
                    </div>
                    <div class="content">
                        <h3>1-click Application installer</h3>
                        <p>Choose between 100+ applications and CMSes to quickly
                            start setting up your website.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-7 col-lg-8">
                <div class="section-head gap-bottom center with-line">
                    <h2>Frequently Asked Question</h2>
                    <div class="lines"> <span></span> </div>
                    <p>Answers to Your Most Commonly Asked Questions (FAQs) –
                        Find Help Here!</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="accordion">
                    <li><a> What is Cloud Hosting? </a>
                        <p>Cloud Hosting is a faster and more advanced form of
                            Shared Hosting. It gives you access to the simple
                            and familiar cPanel, and is powered by robust Cloud
                            Technologies. Cloud Hosting gives you the power to
                            scale your RAM and CPU resources, and is run on a
                            full SSD server. </p>
                    </li>
                    <li><a> What is the difference between Cloud Hosting and
                            Shared Hosting? </a>
                        <p>The basic difference between Cloud Hosting and Shared
                            Hosting is the underlying technology that powers
                            both products. With Cloud hosting, you get
                            everything that Shared Hosting offers along with the
                            ability to scale your CPU and RAM, and an extra
                            boost for your website with an all SSD server stack.
                        </p>
                    </li>
                    <li><a> What is SSD, and how is it different from the
                            existing server? </a>
                        <p>SSD (Solid State Drives) are a form of storage
                            technology. It is a much faster storage than the
                            existing HDD (Hard Disk Drive) storage. Faster
                            storage means your data gets written to and read
                            from your storage faster. This means that your
                            websites will load much faster if they are running
                            on SSD storage. </p>
                    </li>
                    <li><a> What is Caching? </a>
                        <p>Website caching is a service that helps load your web
                            pages faster, without having to overload the server
                            during situations of high traffic. We use NGINX Plus
                            caching to ensure that your visitors don't get any
                            lag while loading your website. </p>
                    </li>
                    <li><a> What is the limit for additional CPU and RAM? </a>
                        <p>Upto 8 GB RAM and 8 cores can be added with any Cloud
                            Hosting Plan.
                        </p>
                    </li>
                    <li><a> Is a Dedicated IP available?</a>
                        <p>For Cloud Hosting (US) packages, you can purchase a
                            Dedicated IP for an additional cost by raising a
                            support ticket. Unfortunately, for Cloud Hosting
                            (IN) packages, we do not provide a Dedicated IP </p>
                    </li>
                    <li><a> How do I install an SSL certificate on my Website?
                        </a>
                        <p>To install SSL on your cloud server, you need to get
                            in touch with our support team and we will get it
                            installed for you. </p>
                    </li>
                    <li><a> Do you provide any one click install scripts along
                            with Cloud Hosting? </a>
                        <p>Yes - we provide 'Quick Install' which is accessible
                            from your cPanel. Quick Install allows you to plug
                            and play various scripts like WordPress, Drupal,
                            Joomla, shopping carts like Zencart, Magento and
                            various other billing, social networking, support
                            and chat modules.</p>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</section>
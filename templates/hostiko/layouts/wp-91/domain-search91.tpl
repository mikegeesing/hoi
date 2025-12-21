<section class="hostiko-domain-search">
    {if $registerdomainenabled || $transferdomainenabled}
        <form method="post" action="domainchecker.php" id="frmDomainHomepage">
            <input type="hidden" name="token" value="b0037d84a01aab66eb3c8ef872ec296b3eebe05f">
                <div class="home-domain-search bg-white">
                    <div class="container">
                        <div class="clearfix">
                            <h2 class="text-center">Secure your domain name</h2>
                            <input type="hidden" name="transfer">
                            <div class="input-group-wrapper">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="domain" placeholder="eg. example.com" autocapitalize="none">
                                    <span class="input-group-append d-none d-sm-block">
                                        <button type="submit" class="btn btn-primary" id="btnDomainSearch">
                                                Search
                                            </button>
                                            <button type="submit" id="btnTransfer" data-domain-action="transfer" class="btn btn-success">
                                                Transfer
                                            </button>
                                            </span>
                                </div>
                            </div>
                            <div class="row d-sm-none">
                                                        <div class="col-6">
                                        <button type="submit" class="btn btn-primary btn-block" id="btnDomainSearch2">
                                            Search
                                        </button>
                                    </div>
                                                                            <div class="col-6">
                                        <button type="submit" id="btnTransfer2" data-domain-action="transfer" class="btn btn-success btn-block">
                                            Transfer
                                        </button>
                                    </div>
                                                </div>
                                                <ul class="tld-logos">
                                                    <li>             
                                                        <img src="{$WEB_ROOT}/templates/{$template}/layouts/wp-{$layoutnotset}/assets/images/com.png"> 
                                                        <span class="value">USD 18.99 / yr</span> 
                                                        <span class="previous">Previously 22.99</span> 
                                                    </li>
                                                    <li>
                                                        <img src="{$WEB_ROOT}/templates/{$template}/layouts/wp-{$layoutnotset}/assets/images/net.png">  
                                                        <span class="value">USD 12.99 / yr</span> 
                                                        <span class="previous">Previously 22.99</span> 
                                                    </li>
                                                    <li>
                                                        <img src="{$WEB_ROOT}/templates/{$template}/layouts/wp-{$layoutnotset}/assets/images/org1.png">  
                                                        <span class="value">USD 15.99 / yr</span> 
                                                        <span class="previous">Previously 22.99</span> 
                                                    </li>
                                                    <li>                                                                                                 
                                                        <img src="{$WEB_ROOT}/templates/{$template}/layouts/wp-{$layoutnotset}/assets/images/co.png"> 
                                                        <span class="value">USD 29.99 / yr</span> 
                                                        <span class="previous">Previously 22.99</span> 
                                                    </li>
                                                    <li>                                                                                                                           
                                                        <img src="{$WEB_ROOT}/templates/{$template}/layouts/wp-{$layoutnotset}/assets/images/online.png">  
                                                        <span class="value">USD 49.99 / yr</span> 
                                                        <span class="previous">Previously 22.99</span>                                                                                                                                      
                                                    </li>
                                                    <li>                                                                                                                           
                                                        <img src="{$WEB_ROOT}/templates/{$template}/layouts/wp-{$layoutnotset}/assets/images/tv.png">  
                                                        <span class="value">USD 89.99 / yr</span> 
                                                        <span class="previous">Previously 22.99</span>                                                                                                                                      
                                                    </li>
                                                    <li>                                                                                                                           
                                                        <img src="{$WEB_ROOT}/templates/{$template}/layouts/wp-{$layoutnotset}/assets/images/site.png">  
                                                        <span class="value">USD 19.99 / yr</span> 
                                                        <span class="previous">Previously 22.99</span>                                                                                                                                      
                                                    </li>
                                                    <li>                                                                                                                           
                                                        <img src="{$WEB_ROOT}/templates/{$template}/layouts/wp-{$layoutnotset}/assets/images/org2.png">  
                                                        <span class="value">USD 39.99 / yr</span> 
                                                        <span class="previous">Previously 22.99</span>                                                                                                                                      
                                                    </li>
                                                </ul>
                            
                            <a href="{$WEB_ROOT}/index.php?rp=/domain/pricing" class="btn btn-link btn-sm float-right">View all pricing</a>
                        </div>
                    </div>
                </div>
        </form>
    {/if}
</section>
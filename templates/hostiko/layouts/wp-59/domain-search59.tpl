<section class="hostiko-domain-search">
    {if $registerdomainenabled || $transferdomainenabled}
        <form method="post" action="domainchecker.php" id="frmDomainHomepage">
            <input type="hidden" name="token" value="b0037d84a01aab66eb3c8ef872ec296b3eebe05f">
                <div class="home-domain-search bg-white">
                    <div class="container">
                        <div class="p-5 clearfix">
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
                                                    <span class="icons">.com</span>
                                                    <span class="number">$4.45</span>
                                                </li>
                                                <li>
                                                    <span class="icons">.info</span>
                                                    <span class="number">$3.75</span>
                                                </li>
                                                <li>
                                                    <span class="icons">.store</span>
                                                    <span class="number">$5.50</span>
                                                </li>
                                                <li>
                                                    <span class="icons">.co</span>
                                                    <span class="number">$1.39</span>
                                                </li>
                                                <li>
                                                    <span class="icons">.net</span>
                                                    <span class="number">$6.85</span>
                                                </li>
                                                <li>
                                                    <span class="icons">.biz</span>
                                                    <span class="number">$7.52</span>
                                                </li>
                                                <li>
                                                    <span class="icons">.me</span>
                                                    <span class="number">$27.00</span>
                                                </li>
                                            </ul>
                            
                            <a href="{$WEB_ROOT}/index.php?rp=/domain/pricing" class="btn btn-link btn-sm float-right">View all pricing<i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
        </form>
    {/if}
</section>
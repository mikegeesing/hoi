<section class="hostiko-domain-search">
    {if $registerdomainenabled || $transferdomainenabled}
        <form method="post" action="domainchecker.php" id="frmDomainHomepage">
            <input type="hidden" name="token" value="b0037d84a01aab66eb3c8ef872ec296b3eebe05f">
                <div class="home-domain-search bg-white">
                    <div class="container">
                        <div class="py-5 clearfix">
                            <h2 class="text-center">Secure your domain name</h2>
                            <input type="hidden" name="transfer">
                            <div class="input-group-wrapper">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="domain" placeholder="eg. example.com" autocapitalize="none">
                                    <span class="input-group-append d-none d-sm-block">
                                        <button type="submit" class="btn btn-primary" id="btnDomainSearch">
                                                <i class="fas fa-search"></i> Search
                                            </button>
                                            <button type="submit" id="btnTransfer" data-domain-action="transfer" class="btn btn-success">
                                                <i class="fas fa-random"></i> Transfer
                                            </button>
                                            </span>
                                </div>
                            </div>
                            <div class="row d-sm-none">
                                                        <div class="col-6">
                                        <button type="submit" class="btn btn-primary btn-block" id="btnDomainSearch2">
                                            <i class="fas fa-search"></i> Search
                                        </button>
                                    </div>
                                                                            <div class="col-6">
                                        <button type="submit" id="btnTransfer2" data-domain-action="transfer" class="btn btn-success btn-block">
                                           <i class="fas fa-random"></i> Transfer
                                        </button>
                                    </div>
                                                </div>
                                                <div class="domain-outer-con">
                                    <ul class="tld-logos">
                                                    <li>
                                                            <span class="name">.com</span> 
                                                            <span class="value">$2.99.yr</span> 
                                                    </li>
                                                    <li>
                                                            <span class="name">.net</span> 
                                                            <span class="value">$2.99.yr</span> 
                                                    </li>
                                                    <li> 
                                                            <span class="name">.org</span> 
                                                            <span class="value">$13.99.yr</span> 
                                                    </li>
                                                    <li>
                                                            <span class="name">.co.uk</span> 
                                                            <span class="value">$11.75.yr</span> 
                                                    </li>
                                                    <li>
                                                            <span class="name">.eu</span> 
                                                            <span class="value">$4.99.yr</span> 
                                                    </li>
                                                    <li>
                                                            <span class="name">.us</span> 
                                                            <span class="value">$7.45.yr</span> 
                                                    </li>
                                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    {/if}
</section>
{if empty($dlcats) }
    {include file="$template/includes/alert.tpl" type="info" msg=$LANG.downloadsnone textcenter=true}
{else}
<div class="p-lg-5 p-md-5 p-3 bg-gray-light tt-rounded mb-4">
    <form role="form" method="post" action="{routePath('download-search')}">
    <div class="input-group kb-search tt-kb-search">
        <div class="tt-search-field">
            <i class="far fa-search text-primary"></i>
            <input type="text" id="inputDownloadsSearch" name="search" class="form-control" placeholder="{$LANG.downloadssearch}" />
        </div>
        <input type="submit" id="btnDownloadsSearch" class="btn btn-primary btn-input-padded-responsive" value="{$LANG.search}" />
    </div>
</form>
</div>

<div class="tt-new-content">
<p>{$LANG.downloadsintrotext}</p>
</div>


    <div class="row kbcategories">
        {foreach $dlcats as $dlcat}
            <div class="col-xl-6">
                <div class="card kb-category mb-4">
                   <a href="{routePath('download-by-cat', $dlcat.id, $dlcat.urlfriendlyname)}" class="card-body mb-0">
                    
        
                    <span class="h6 m-0">
                            <span class="badge bg-primary-lights float-right p-2 fs-12">
                                ({$dlcat.numarticles}) Article
                            </span>
                            <i class="far fa-folder fa-fw"></i>
                            {$dlcat.name}
                    </span>

                <p class="m-0 text-muted">{$dlcat.description}</p>

                </a> 
                </div>
            </div>

            {foreachelse}

            <div class="col-12 tt-new-content">
                <p>{$LANG.downloadsnone}</p>
            </div>
           
        {/foreach}
    </div>

     <div class="card">
        <div class="card-body">
            <h3 class="m-0 h5">
                <i class="far fa-star fa-fw"></i>
               {$LANG.downloadspopular}
            </h3>
        </div>
        <div class="list-group list-group-flush">
        {foreach $mostdownloads as $download}
       <a href="{$download.link}" class="list-group-item kb-article-item">
                    <i class="fad fa-file-alt fa-fw text-black-50"></i>
                    {$download.title}
        <small>{$download.description}</small>
        </a>
        {foreachelse}
            <span class="list-group-item text-center">
                {$LANG.downloadsnone}
            </span>
    {/foreach}

    </div>
    </div>

{/if}
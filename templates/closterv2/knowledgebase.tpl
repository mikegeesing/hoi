{$kb_quickfind}
<div class="p-lg-5 p-md-5 p-3 bg-gray-light tt-rounded mb-4">
    <form role="form" method="post" action="{routePath('knowledgebase-search')}">
    <div class="input-group kb-search tt-kb-search">
        <div class="tt-search-field">
            <i class="far fa-search text-primary"></i>
            <input type="text" id="inputKnowledgebaseSearch" name="search" class="form-control" placeholder="{$LANG.clientHomeSearchKb}" />
        </div>
        <input type="submit" id="btnKnowledgebaseSearch" class="btn btn-primary btn-input-padded-responsive" value="{$LANG.search}" />
      
    </div>
</form>
</div>



{if $kbcats}
    <div class="row kbcategories">
        {foreach from=$kbcats name=kbcats item=kbcat}
            <div class="col-xl-6">
                <div class="card kb-category mb-4">
                   <a href="{routePath('knowledgebase-category-view', {$kbcat.id}, {$kbcat.urlfriendlyname})}" class="card-body mb-0">
                    
        
                    <span class="h6 m-0">
                            <span class="badge bg-primary-lights float-right p-2 fs-12">
                                ({$kbcat.numarticles}) Article
                            </span>
                            <i class="far fa-folder fa-fw"></i>
                            {$kbcat.name}
                    </span>

                     {if $kbcat.editLink}
                    <a href="{$kbcat.editLink}" class="admin-inline-edit">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                        {$LANG.edit}
                    </a>
                {/if}

                <p class="m-0 text-muted">{$kbcat.description}</p>

                </a> 
                </div>
               
                
            </div>
            {if $smarty.foreach.kbcats.iteration mod 4 == 0}
                </div><div class="row kbcategories">
            {/if}
        {/foreach}
    </div>
{else}
    {include file="$template/includes/alert.tpl" type="info" msg=$LANG.knowledgebasenoarticles textcenter=true}
{/if}

{if $kbmostviews}

    <div class="card">
        <div class="card-body">
            <h3 class="m-0 h5">
                <i class="far fa-star fa-fw"></i>
               {$LANG.knowledgebasepopular}
            </h3>
        </div>
        <div class="list-group list-group-flush">
        {foreach from=$kbmostviews item=kbarticle}
       <a href="{routePath('knowledgebase-article-view', {$kbarticle.id}, {$kbarticle.urlfriendlytitle})}" class="list-group-item kb-article-item">
                    <i class="fad fa-file-alt fa-fw text-black-50"></i>
                    {$kbarticle.title}
        <small>{$kbarticle.article|truncate:100:"..."}</small>

        {if $kbarticle.editLink}
                <a href="{$kbarticle.editLink}" class="admin-inline-edit">
                    <i class="fas fa-pencil-alt fa-fw"></i>
                    {$LANG.edit}
                </a>
            {/if}

                </a>
    {/foreach}

    </div>
    </div>

    


{/if}

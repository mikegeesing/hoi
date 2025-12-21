<div class="mb-spacer-6x">
  <form role="form" method="post" action="{routePath('knowledgebase-search')}">
    <div class="input-group input-group-lg kb-search">
      <input type="text" id="inputKnowledgebaseSearch" name="search" class="form-control"
        placeholder="{$LANG.clientHomeSearchKb}" />
      <span class="input-group-btn">
        <input type="submit" id="btnKnowledgebaseSearch" class="btn btn-primary btn-input-padded-responsive"
          value="{$LANG.search}" />
      </span>
    </div>
  </form>
</div>


<div class="mb-spacer-6x">
  <div class="section-header">
      <h2 class="section-title">{$LANG.knowledgebasecategories}</h2>
  </div>
  {if $kbcats}
    <div class="section-body-kb">
      <div class="kbcategories">
        {foreach from=$kbcats name=kbcats item=kbcat}
          <div class="wdes-kb-item">
            <a class="wdes-title-kb" href="{routePath('knowledgebase-category-view', {$kbcat.id}, {$kbcat.urlfriendlyname})}">
              <i class="fad fa-folder-open"></i>
              {$kbcat.name} ({$kbcat.numarticles})
            </a>
            {if $kbcat.editLink}
              <a href="{$kbcat.editLink}" class="admin-inline-edit">
                <i class="fad fa-pencil-alt fa-fw"></i>
              </a>
            {/if}
            <p>{$kbcat.description}</p>
          </div>
          {if $smarty.foreach.kbcats.iteration mod 3 == 0}
          </div>
          <div class="kbcategories">
          {/if}
        {/foreach}
      </div>
    </div>
  {else}
    {include file="$template/includes/alert.tpl" type="info" msg=$LANG.knowledgebasenoarticles textcenter=true}
  {/if}
</div>

{if $kbmostviews}
<div class="mb-spacer-6x">
  <div class="section-header">
      <h2 class="section-title">{$LANG.knowledgebasepopular}<h2>
  </div>
  <div class="kbarticles">
    {foreach from=$kbmostviews item=kbarticle}
      <div class="wdes-kb-article-item">
        <a class="wdes-title"
          href="{routePath('knowledgebase-article-view', {$kbarticle.id}, {$kbarticle.urlfriendlytitle})}">
          <span class="fad fa-file"></span>&nbsp;{$kbarticle.title}
        </a>
        {if $kbarticle.editLink}
          <a href="{$kbarticle.editLink}" class="admin-inline-edit">
            <i class="fad fa-pencil-alt fa-fw"></i>
          </a>
        {/if}
        <p>{$kbarticle.article|truncate:100:"..."}</p>
      </div>
    {/foreach}
  </div>
</div>
{/if}
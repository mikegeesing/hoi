<form class="mb-spacer-6x" role="form" method="post" action="{routePath('knowledgebase-search')}">
  <div class="input-group input-group-lg kb-search">
    <input type="text" id="inputKnowledgebaseSearch" name="search" class="form-control"
      placeholder="{$LANG.clientHomeSearchKb}" value="{$searchterm}" />
    <span class="input-group-btn">
      <input type="submit" id="btnKnowledgebaseSearch" class="btn btn-primary btn-input-padded-responsive"
        value="{$LANG.search}" />
    </span>
  </div>
</form>

{if $kbcats}
  <div class="section-header">
    <h2 class="section-title">{$LANG.knowledgebasecategories}</h2>
  </div>

  <div class="row kbcategories">
    {foreach name=kbasecats from=$kbcats item=kbcat}
      <div class="col-sm-4 wdes-kb-item">
        <a class="wdes-title-kb" href="{routePath('knowledgebase-category-view',{$kbcat.id},{$kbcat.urlfriendlyname})}">
          <i class="fad fa-folder-open"></i>{$kbcat.name} ({$kbcat.numarticles})
        </a>
        {if $kbcat.editLink}
          <a href="{$kbcat.editLink}" class="admin-inline-edit">
            <i class="fad fa-pencil-alt fa-fw"></i>
            {$LANG.edit}
          </a>
        {/if}
        <p>{$kbcat.description}</p>
      </div>
    {/foreach}
  </div>
{/if}

{if $kbarticles || !$kbcats}
  {if $tag}
    <div class="section-header">
      <h2 class="section-title">{$LANG.kbviewingarticlestagged} '{$tag}'</h2>
    </div>
  {else}
    <div class="section-header">
      <h2 class="section-title">{$LANG.knowledgebasearticles}</h2>
    </div>
  {/if}

  <div class="kbarticles">
    {foreach from=$kbarticles item=kbarticle}
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
    {foreachelse}
      {include file="$template/includes/alert.tpl" type="info" msg=$LANG.knowledgebasenoarticles textcenter=true}
    {/foreach}
  </div>
{/if}
<div class="wdes-article-block">

  {if $kbarticle.editLink}
    <a href="{$kbarticle.editLink}" class="admin-inline-edit">
      <i class="fad fa-pencil-alt fa-fw"></i>
    </a>
  {/if}

  <div class="wdes-article-title">
    <h2>{$kbarticle.title}</h2>
  </div>

  {if $kbarticle.voted}
    {include file="$template/includes/alert.tpl" type="success alert-bordered-left" msg="{lang key="knowledgebaseArticleRatingThanks"}"
    textcenter=true}
  {/if}

  <div class="wdes-article-content">{$kbarticle.text}</div>

  <ul class="wdes-article-meta">
    {if $kbarticle.tags }
      <li><i class="fas fa-tag"></i> {$kbarticle.tags}</li>
    {/if}

    <li><i class="fas fa-star"></i> {$kbarticle.useful} {$LANG.knowledgebaseratingtext}</li>

    <li class="flex-1 justify-end">
      <a href="#" class="btn btn-link btn-print wdes-kb-print-btn" onclick="window.print();return false"><i class="fad fa-print"></i></a>
    </li>
  </ul>
</div>

<div class="clearfix"></div>

<div class="kb-rate-article hidden-print">
  <form class="wdes-kb-form-articles"
    action="{routePath('knowledgebase-article-view', {$kbarticle.id}, {$kbarticle.urlfriendlytitle})}" method="post">
    <input type="hidden" name="useful" value="vote">
    {if $kbarticle.voted}{$LANG.knowledgebaserating}{else}{$LANG.knowledgebasehelpful}{/if}
    {if $kbarticle.voted}
      {$kbarticle.useful} {$LANG.knowledgebaseratingtext} ({$kbarticle.votes} {$LANG.knowledgebasevotes})
    {else}
      <div class="wdes-btns">
        <button type="submit" name="vote" value="yes" class="btn btn-lg btn-link like"><i class="fad fa-thumbs-up"></i>
          {$LANG.knowledgebaseyes}</button>
        <button type="submit" name="vote" value="no" class="btn btn-lg btn-link dislike"><i class="fad fa-thumbs-down"></i>
          {$LANG.knowledgebaseno}</button>
      </div>
    {/if}
  </form>
</div>

{if $kbarticles}
  <div class="kb-also-read mb-spacer-6x">
    <div class="section-header">
      <h3 class="section-title">{$LANG.knowledgebaserelated}</h3>
    </div>
    <div class="kbarticles">
      {foreach key=num item=kbarticle from=$kbarticles}
        <div class="wdes-kb-article-item">
          <a class="wdes-title"
            href="{routePath('knowledgebase-article-view', {$kbarticle.id}, {$kbarticle.urlfriendlytitle})}">
            <i class="fad fa-file"></i> {$kbarticle.title}
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
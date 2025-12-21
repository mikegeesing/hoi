{if empty($dlcats) }
  {include file="$template/includes/alert.tpl" type="info" msg=$LANG.downloadsnone textcenter=true}
{else}
  <form class="mb-spacer-6x" role="form" method="post" action="{routePath('download-search')}">
    <div class="input-group input-group-lg kb-search margin-bottom">
      <input type="text" name="search" id="inputDownloadsSearch" class="form-control"
        placeholder="{$LANG.downloadssearch}" />
      <span class="input-group-btn">
        <input type="submit" id="btnDownloadsSearch" class="btn btn-primary btn-input-padded-responsive"
          value="{$LANG.search}" />
      </span>
    </div>
  </form>

  <div class="section-header">
    <h2 class="section-title">{$LANG.downloadscategories}</h2>
    <p class="section-description">{$LANG.downloadsintrotext}</p>
  </div>

  <div class="kbcategories mb-spacer-6x">
    {foreach $dlcats as $dlcat}
      <div class="col-sm-4 wdes-kb-item wdes-ticket-dept">
        <a class="wdes-title-kb" href="{routePath('download-by-cat', $dlcat.id, $dlcat.urlfriendlyname)}">
          <i class="fad fa-folder-open"></i>
          <strong>{$dlcat.name}</strong>
          ({$dlcat.numarticles})
        </a>
        <p>{$dlcat.description}</p>
      </div>
    {foreachelse}
      <div class="col-sm-12">
        <p class="text-center fontsize3">{$LANG.downloadsnone}</p>
      </div>
    {/foreach}
  </div>

  <div class="section-header">
    <h2 class="section-title">{$LANG.downloadspopular}</h2>
  </div>

  <div class="list-group list-group-item--downloads-wrapper">
    {foreach $mostdownloads as $download}
      <a href="{$download.link}" class="list-group-item list-group-item--download">
        <strong>
          <i class="fas fa-download"></i>
          {$download.title}
          {if $download.clientsonly}
            <i class="fad fa-lock text-muted"></i>
          {/if}
        </strong>
        <br>
        {$download.description}
        <br>
        <small>{$LANG.downloadsfilesize}: {$download.filesize}</small>
      </a>
    {foreachelse}
      <span class="list-group-item text-center">
        {$LANG.downloadsnone}
      </span>
    {/foreach}
  </div>
{/if}
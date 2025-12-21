<form class="mb-spacer-6x" role="form" method="post" action="{routePath('download-search')}">
  <div class="input-group input-group-lg kb-search margin-bottom">
    <input type="text" name="search" id="inputDownloadsSearch" class="form-control"
      placeholder="{$LANG.downloadssearch}" value="{$search}" />
    <span class="input-group-btn">
      <input type="submit" id="btnDownloadsSearch" class="btn btn-primary btn-input-padded-responsive"
        value="{$LANG.search}" />
    </span>
  </div>
</form>

<div class="section">
  <div class="section-header">
    <p class="section-description">{$LANG.downloadsintrotext}</p>
  </div>
</div>

{if $dlcats}
  <div class="section">
    <div class="section-header">
      <h2 class="section-title">{$LANG.knowledgebasecategories}</h2>
    </div>
    <div class="section-body">
      <div class="kbcategories">
        {foreach $dlcats as $dlcat}
          <div class="col-sm-4 wdes-kb-item wdes-ticket-dept">
            <a href="{routePath('download-by-cat', $dlcat.id, $dlcat.urlfriendlyname)}">
              <i class="fad fa-folder-open"></i>
              <strong>{$dlcat.name}</strong>
            </a>
            ({$dlcat.numarticles})
            <br>
            <p>{$dlcat.description}</p>
          </div>
        {foreachelse}
          <div class="col-sm-12">
            <p class="text-center fontsize3">{$LANG.downloadsnone}</p>
          </div>
        {/foreach}
      </div>
    </div>
  </div>
{/if}

<div class="section">
  <div class="section-header">
    <h2 class="section-title">{$LANG.downloadsfiles}</h2>
  </div>
  <div class="section-body">
    <div class="list-group">
      {foreach $downloads as $download}
        <a href="{$download.link}" class="list-group-item">
          <strong>
            <i class="fad fa-download"></i>
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
  </div>
</div>
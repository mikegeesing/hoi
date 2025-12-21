{if $announcementsFbRecommend}
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) {
        return;
      }
      js = d.createElement(s);
      js.id = id;
      js.src = "//connect.facebook.net/{$LANG.locale}/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
{/if}
{foreach from=$announcements item=announcement}

  <div class="wdes-phox-announcement-block">
    <a href="{routePath('announcement-view', $announcement.id, $announcement.urlfriendlytitle)}"
      class="announcement-single">

      <div class="date">
        <i class="far fa-calendar-alt fa-fw"></i>
        {$carbon->createFromTimestamp($announcement.timestamp)->format('jS M Y')}
      </div>

      <h4 class="title">
        {$announcement.title}
      </h4>

      {if $announcement.text|strip_tags|strlen < 350} <div class="description">{$announcement.text}</div>
      {else}
        <div class="description">{$announcement.summary}</div>
        <div class="btn btn-primary-faded wdes-read-more-btn-announcement">{$LANG.readmore}</div>
      {/if}

      {if $announcementsFbRecommend}
        <div class="fb-like hidden-sm hidden-xs" data-layout="button"
          data-href="{fqdnRoutePath('announcement-view', $announcement.id, $announcement.urlfriendlytitle)}"
          data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>
        <div class="fb-like hidden-lg hidden-md" data-layout="button"
          data-href="{fqdnRoutePath('announcement-view', $announcement.id, $announcement.urlfriendlytitle)}"
          data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>
      {/if}

    </a>

    {if $announcement.editLink}
      <a href="{$announcement.editLink}" class="admin-inline-edit">
        <i class="fad fa-pencil-alt fa-fw"></i>
      </a>
    {/if}

  </div>

{foreachelse}

  {include file="$template/includes/alert.tpl" type="info" msg="{$LANG.noannouncements}" textcenter=true}

{/foreach}

{if $prevpage || $nextpage}

<form role="form">
  <ul class="pagination">
    {foreach $pagination as $item}
      <li>
        <a href="{$item.link}" class="{if $item.active} active{/if}" {if $item.disabled}
        disabled="disabled" {/if}>{$item.text}</a>
      </li>
    {/foreach}
  </ul>
</form>
<div class="clearfix"></div>
{/if}
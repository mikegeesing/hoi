{if $announcementsFbRecommend}
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/{$LANG.locale}/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
{/if}

<h2 class="card-title">Announcements</h2>
<div class="announcements tt-news-wrap bg-white rounded mb-3">
{foreach from=$announcements item=announcement}


<div class="announcement tt-news-single p-4">
    <h2 class="h6">
        <a href="{routePath('announcement-view', $announcement.id, $announcement.urlfriendlytitle)}">
            {$announcement.title}
        </a>
    </h2>
    <ul class="list-inline mb-2">
                <li class="list-inline-item text-muted pr-3">
                    <i class="fad fa-calendar-alt fa-fw"></i>
                    {$carbon->createFromTimestamp($announcement.timestamp)->format('jS M Y')}
                </li>
    </ul>
    {if $announcement.text|strip_tags|strlen < 350}
    <article>
        {$announcement.text}
    </article>
    {else}
    <article>
        {$announcement.summary}
    </article>
    {/if}
    <a href="{routePath('announcement-view', $announcement.id, $announcement.urlfriendlytitle)}" class="tt-read-more">
        Continue reading
        <i class="fad fa-arrow-right"></i>
    </a>

    {if $announcement.editLink}
                <a href="{$announcement.editLink}" class="admin-inline-edit">
                    <i class="fas fa-pencil-alt fa-fw"></i>
                    {$LANG.edit}
                </a>
            {/if}

    {if $announcementsFbRecommend}
            <div class="fb-like hidden-sm hidden-xs" data-layout="standard" data-href="{fqdnRoutePath('announcement-view', $announcement.id, $announcement.urlfriendlytitle)}" data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>
            <div class="fb-like hidden-lg hidden-md" data-layout="button_count" data-href="{fqdnRoutePath('announcement-view', $announcement.id, $announcement.urlfriendlytitle)}" data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>
        {/if}

</div>
 

{foreachelse}

    {include file="$template/includes/alert.tpl" type="info" msg="{$LANG.noannouncements}" textcenter=true}

{/foreach}

 </div>  

{if $prevpage || $nextpage}
    <div class="col-xs-12 margin-bottom">
        <form class="form-inline" role="form">
            <div class="form-group">
                <div class="input-group">
                    <span class="btn-group">
                        {foreach $pagination as $item}
                            <a href="{$item.link}" class="btn btn-default{if $item.active} active{/if}"{if $item.disabled} disabled="disabled"{/if}>{$item.text}</a>
                        {/foreach}
                    </span>
                </div>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>
{/if}

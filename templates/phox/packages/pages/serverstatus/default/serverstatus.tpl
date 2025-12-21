{* Issues *}
{foreach from=$issues item=issue}
  <div class="panel {if $issue.clientaffected}panel-warning{else}panel-info{/if}">

    <div class="panel-heading">
      <h3 class="panel-title">
        {$issue.title} ({$issue.status})
        <span id="issuePriorityLabel" class="network-status-issue-label {if $issue.rawPriority == 'Critical'}list-group-item-danger{elseif $issue.rawPriority == 'High'}list-group-item-warning{elseif $issue.rawPriority == 'Low'}list-group-item-success{else}list-group-item-info{/if}"><i class="fas fa-info-circle"></i> {$LANG.networkissuespriority} - {$issue.priority}</span>
      </h3>
    </div>
    <div class="panel-body">
      {if $issue.server or $issue.affecting}
        <div class="network-status-issue-affecting">
          <i class="fas fa-info-circle"></i>
          {$LANG.networkissuesaffecting} {$issue.type} - 
          {if $issue.type eq $LANG.networkissuestypeserver}
            {$issue.server}
          {else}
            {$issue.affecting}
          {/if}
        </div>
      {/if}
      {* Description *}
      <div class="network-status-issue-description">{$issue.description}</div>
    </div>

    {* Meta *}
    <div class="network-status-issue-meta">
      <ul>
        <li><i class="fas fa-clock"></i> {$LANG.networkissueslastupdated} - {$issue.lastupdate}</li>
        <li><i class="fas fa-calendar-alt"></i> {$LANG.networkissuesdate} - {$issue.startdate}{if $issue.enddate} - {$issue.enddate}{/if}</li>
      </ul>
    </div>
  </div>
{foreachelse}
  {include file="$template/includes/alert.tpl" type="success" msg=$noissuesmsg textcenter=true}
{/foreach}

<div class="section">
  <div class="btn-group">
    <a href="{if $prevpage}{$smarty.server.PHP_SELF}?{if $view}view={$view}&amp;{/if}page={$prevpage}{else}#{/if}" class="btn btn-default {if !$prevpage}disabled{/if}">&lt; {$LANG.previouspage}</a>
    <a href="{if $nextpage}{$smarty.server.PHP_SELF}?{if $view}view={$view}&amp;{/if}page={$nextpage}{else}#{/if}" class="btn btn-default {if !$nextpage}disabled{/if}">{$LANG.nextpage} &gt;</a>
  </div>
</div>

{if $servers}
  <div class="section">
    {include file="$template/includes/tablelist.tpl" tableName="ServersList"}
    <script type="text/javascript">
      jQuery(document).ready(function() {
        var table = jQuery('#tableServersList').removeClass('hidden').DataTable();
        table.draw();
        jQuery('#tableLoading').addClass('hidden');
      });
    </script>
    <div class="section-header">
      <h2 class="section-title">{$LANG.serverstatustitle}</h2>
      <p class="section-description">{$LANG.serverstatusheadingtext}</p>
    </div>

    <div class="section-body">
      <div class="table-container clearfix">
        <table id="tableServersList" class="table table-list display responsive nowrap">
          <thead>
            <tr>
              <th>{$LANG.servername}</th>
              <th class="text-center">HTTP</th>
              <th class="text-center">FTP</th>
              <th class="text-center">POP3</th>
              <th class="text-center">{$LANG.serverstatusphpinfo}</th>
              <th class="text-center">{$LANG.serverstatusserverload}</th>
              <th class="text-center">{$LANG.serverstatusuptime}</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$servers key=num item=server}
            <tr>
              <td>{$server.name}</td>
              <td class="text-center" id="port80_{$num}">
                <span class="fad fa-spinner fa-spin"></span>
              </td>
              <td class="text-center" id="port21_{$num}">
                <span class="fad fa-spinner fa-spin"></span>
              </td>
              <td class="text-center" id="port110_{$num}">
                <span class="fad fa-spinner fa-spin"></span>
              </td>
              <td class="text-center"><a href="{$server.phpinfourl}" target="_blank">{$LANG.serverstatusphpinfo}</a></td>
              <td class="text-center" id="load{$num}">
                <span class="fad fa-spinner fa-spin"></span>
              </td>
              <td class="text-center" id="uptime{$num}">
                <span class="fad fa-spinner fa-spin"></span>
                <script>
                  jQuery(document).ready(function() {
                    checkPort({$num}, 80);
                    checkPort({$num}, 21);
                    checkPort({$num}, 110);
                    getStats({$num});
                  });
                </script>
              </td>
            </tr>
            {foreachelse}
            <tr>
              <td colspan="7">{$LANG.serverstatusnoservers}</td>
            </tr>
            {/foreach}
          </tbody>
        </table>
      </div>
    </div>
  </div>
{/if}
{if isset($RSThemes['pages'][$templatefile]) && file_exists($RSThemes['pages'][$templatefile]['fullPath'])}
    {include file=$RSThemes['pages'][$templatefile]['fullPath']}
{else}  
    {assign var=iconsPages value=['clientareadomains', 'supportticketslist', 'clientareainvoices', 'clientareaproducts']}
    {if $tickets}
        {include file="$template/includes/tablelist.tpl" tableName="TicketsList" filterColumn="2"}
        <script type="text/javascript">
            jQuery(document).ready( function ()
            {
                var table = jQuery('#tableTicketsList').removeClass('hidden').DataTable();
                {if $orderby == 'did' || $orderby == 'dept'}
                    table.order(0, '{$sort}');
                {elseif $orderby == 'subject' || $orderby == 'title'}
                    table.order(1, '{$sort}');
                {elseif $orderby == 'status'}
                    table.order(2, '{$sort}');
                {elseif $orderby == 'lastreply'}
                    table.order(3, '{$sort}');
                {/if}
                table.draw();
                jQuery('.table-container').removeClass('loading');
                jQuery('#tableLoading').addClass('hidden');

            });
        </script>
        <div class="table-container loading clearfix">
            <div class="table-top">
                <div class="d-flex">
                    <label>{$LANG.clientareahostingaddonsview}</label>
                    <div class="dropdown view-filter-btns {if $RSThemes.addonSettings.show_status_icon == 'displayed'}iconsEnabled{/if}">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            {if $RSThemes.addonSettings.show_status_icon == 'displayed'}
                                {if file_exists("templates/$template/assets/img/status-icons/status-all.tpl")}
                                    <span class="status-icon status-ticket status-status-all" style="font-size: 0;">
                                        {include file="$template/assets/img/status-icons/status-all.tpl"}      
                                    </span>
                                {/if}
                            {else}
                                <span class="status hidden"></span>
                            {/if}
                            <span class="filter-name">{$rslang->trans('generals.all_entries')}</span>
                            <i class="ls ls-caret"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="#">
                                    <span data-value="all">
                                        {if $RSThemes.addonSettings.show_status_icon == 'displayed'}
                                            {if file_exists("templates/$template/assets/img/status-icons/status-all.tpl")}
                                                <span class="status-icon status-ticket status-status-all">
                                                    {include file="$template/assets/img/status-icons/status-all.tpl"}      
                                                </span>
                                            {/if}
                                            <span class="filter-name">{$rslang->trans('generals.all_entries')}</span>
                                        {else}
                                            {$rslang->trans('generals.all_entries')}
                                        {/if}
                                    </span>
                                </a>
                            </li>
                            {foreach key=num item=status from=$RSTicketsStatuses}
                                {assign var="statusColor" value='style="color:'|explode:$status.status} 
                                {assign var="statusColor" value='">'|explode:$statusColor[1]} 
                                {if $RSThemes.addonSettings.show_status_icon == 'displayed' && in_array($templatefile, $iconsPages)}
                                    <li>
                                        <a href="#" data-status-color="{$statusColor[0]}">
                                            <span class="status status-{$status.statusClass} {if $RSThemes.addonSettings.show_status_icon == 'displayed'}dot-hidden{/if}" data-value="{$status.statustext}" data-status-class="{$status.statusClass}" data-status="ticket">
                                                {if $RSThemes.addonSettings.show_status_icon == 'displayed'}
                                                    {if file_exists("templates/$template/assets/img/status-icons/{$status.statusClass}.tpl")}
                                                        <span class="status-icon status-ticket status-{$status.statusClass}" data-status="ticket">
                                                            {include file="$template/assets/img/status-icons/{$status.statusClass}.tpl" statusColor={$statusColor[0]}}      
                                                        </span>
                                                    {else}
                                                        <span class="status-icon status-icon-ticket status-{$status.statusClass}">
                                                            {include file="$template/assets/img/status-icons/default.tpl"}      
                                                        </span>
                                                    {/if}  
                                                    <span class="filter-name">
                                                        {$status.status|replace:'style="color':'class="status dot-hidden" data-status="ticket"'}
                                                    </span>
                                                {else}                   
                                                    <span class="filter-name">
                                                        {$status.status|replace:'style="color':'class="status" style="--status-color'}
                                                    </span>
                                                {/if}
                                            </span>
                                        </a>
                                    </li>
                                    {else}
                                        <li><a href="#" data-status-color="{$statusColor[0]}">{$status.status|replace:'style="color':'class="status" style="--status-color'}</a></li>
                                    {/if}
                            {/foreach}
                        </ul>
                        
                    </div>
                </div> 
            </div>
                
            <table id="tableTicketsList" class="table table-list">
                <thead>
                    <tr>
                        <th><button type="button" class="btn-table-collapse"></button>{$LANG.supportticketsdepartment}<span class="sorting-arrows"></span></th>
                        <th>{$LANG.supportticketssubject}<span class="sorting-arrows"></span></th>
                        <th>{$LANG.supportticketsstatus}<span class="sorting-arrows"></span></th>
                        <th>{$LANG.supportticketsticketlastupdated}<span class="sorting-arrows"></span></th>
                        {if isset($RSThemes['pages'][$templatefile]) && $RSThemes['pages'][$templatefile]['config']['showManageButton'] == "1"}
                            <th></th>
                        {/if}
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$tickets item=ticket}
                    {if $RSThemes.addonSettings.show_status_icon == 'displayed' && in_array($templatefile, $iconsPages)}
                        {assign var="ticketColor" value='style="color:'|explode:$ticket.status} 
                        {assign var="ticketColor" value='">'|explode:$ticketColor[1]}
                    {/if}
                        <tr data-url="viewticket.php?tid={$ticket.tid}&amp;c={$ticket.c}">
                            <td><button type="button" class="btn-table-collapse"></button>
                                {$ticket.department}
                            </td>
                            <td>
                                <div class="text-primary">#{$ticket.tid}
                                    {if $ticket.sensitiveData === true}
                                        <span class="" data-toggle="tooltip" data-placement="top" title="{$rslang->trans('support.sensitive_data_tooltip')}">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_9219_3103)">
                                            <path d="M10.6875 0.000244141H1.3125C1.1375 0.000244141 1 0.146911 1 0.333577V6.66691C1 9.60691 3.24375 12.0002 6 12.0002C8.75625 12.0002 11 9.60691 11 6.66691V0.333577C11 0.146911 10.8625 0.000244141 10.6875 0.000244141ZM7 1.52691L2.49375 6.00024H2V1.00024H7V1.52691Z" fill="var(--brand-success)"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_9219_3103">
                                            <rect width="12" height="12" fill="white" transform="translate(0 0.000244141)"/>
                                            </clipPath>
                                            </defs>
                                            </svg>
                                        </span>
                                    {/if}
                                </div>
                                <span class="small">{$ticket.subject}</span>
                            </td>
                            <td>
                                {if $RSThemes.addonSettings.show_status_icon == 'displayed' && in_array($templatefile, $iconsPages)}
                                    {if file_exists("templates/$template/assets/img/status-icons/{$ticket.statusClass}.tpl")}
                                        <span class="status-icon status-icon-ticket {$ticketColor[0]}">
                                            {include file="$template/assets/img/status-icons/{$ticket.statusClass}.tpl" statusColor={$ticketColor[0]}}      
                                        </span>
                                        {$ticket.status|replace:'style="color':'class="status status-ticket dot-hidden" style="--status-color'}
                                    {else}
                                        <span class="status-icon status-icon-ticket">
                                            {include file="$template/assets/img/status-icons/default.tpl"}      
                                        </span>
                                        {$ticket.status|replace:'style="color':'class="status status-ticket dot-hidden" style="--status-color'}
                                    {/if}     
                                {else}                
                                    {$ticket.status|replace:'style="color':'class="status" style="--status-color'}
                                {/if}  
                                {* <span class="{if $RSThemes.addonSettings.show_status_icon == 'displayed'}status status-{$ticket.statusClass} dot-hidden{/if}" style="color: --status-color">
                                    {$ticket.status|replace:'style="color':'class="status" style="--status-color'}
                                </span> *}
                            </td>
                            <td class="text-center sorting_1 text-nowrap">
                                <span class="hidden">{$ticket.normalisedLastReply}</span>
                                {$ticket.lastreply}
                            </td>
                            {if isset($RSThemes['pages'][$templatefile]) && $RSThemes['pages'][$templatefile]['config']['showManageButton'] == "1"}
                                <td class="cell-action">
                                    <a href="viewticket.php?tid={$ticket.tid}&amp;c={$ticket.c}"
                                        class="btn btn-default btn-sm btn-manage">{$_LANG['manage']}</a>
                                </td>
                            {/if}
                        </tr>
                    {/foreach}
                </tbody>
            </table>
            <div class="loader loader-table" id="tableLoading">
                {include file="$template/includes/common/loader.tpl"}   
            </div>
        </div>            
    {else}
        <div class="message message-no-data">
            <div class="message-image">
                {include file="$template/includes/common/svg-icon.tpl" icon="ticket"}      
            </div>
            <h6 class="message-title">{$rslang->trans('nodata.no_recent_tickets')}</h6>
            <div class="message-action">
                <a class="btn btn-primary" href="{$WEB_ROOT}/submitticket.php">
                    {$LANG.supportticketssubmitticket}
                </a>
            </div>
        </div>
    {/if}
{/if}
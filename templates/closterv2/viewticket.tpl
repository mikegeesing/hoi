{if $invalidTicketId}
    {include file="$template/includes/alert.tpl" type="danger" title=$LANG.thereisaproblem msg=$LANG.supportticketinvalid textcenter=true}
{else}
    {if $closedticket}
        {include file="$template/includes/alert.tpl" type="warning" msg=$LANG.supportticketclosedmsg textcenter=true}
    {/if}

    {if $errormessage}
        {include file="$template/includes/alert.tpl" type="error" errorshtml=$errormessage}
    {/if}
{/if}

{if !$invalidTicketId}
    <div class="card view-ticket mb-4">
        <div class="card-body p-3 bg-primary-lights">
            <h3 class="h6">
                View Ticket {$tid}
                <div class="ticket-actions float-sm-right mt-3 mt-sm-0">
                    <button id="ticketReply" type="button" class="btn btn-success btn-sm" onclick="smoothScroll('#ticketReplyContainer')">
                        <i class="fad fa-reply fa-fw"></i>
                        {$LANG.supportticketsreply}
                    </button>
                    <button class="btn btn-danger btn-sm" disabled="disabled">
                        <i class="fad fa-times fa-fw"></i>
                            Closed
                    </button>
                </div>
            </h3>
            <p class="mb-0">
                <strong>Subject :</strong>
                {$subject}
            </p>
        </div>

         {foreach $descreplies as $reply}
        <div class="card-body">
                <div class="ticket-reply markdown-content{if $reply.admin} staff{/if}">
                    <div class="posted-by">
                        Posted by <span class="posted-by-name">{$reply.requestor.name}</span> on <span class="posted-on">{$reply.date}</span> <span class="label requestor-badge requestor-type-{$reply.requestor.type_normalised} float-md-right">{if $reply.requestor.type_normalised eq 'operator'}
                            {lang key='support.requestor.operator'}
                        {elseif $reply.requestor.type_normalised eq 'owner'}
                            {lang key='support.requestor.owner'}
                        {elseif $reply.requestor.type_normalised eq 'authorizeduser'}
                            {lang key='support.requestor.authorizeduser'}
                        {elseif $reply.requestor.type_normalised eq 'registereduser'}
                            {lang key='support.requestor.registereduser'}
                        {elseif $reply.requestor.type_normalised eq 'subaccount'}
                            {lang key='support.requestor.subaccount'}
                        {elseif $reply.requestor.type_normalised eq 'guest'}
                            {lang key='support.requestor.guest'}
                        {/if}</span>
                    </div>
                    <div class="message p-3">
                        <p>{$reply.message}</p>
                        {if $reply.ipaddress}
                    <hr>
                    {lang key='support.ipAddress'}: {$reply.ipaddress}
                {/if}

                    {if $reply.id && $reply.admin && $ratingenabled}
                    <div class="clearfix">
                        {if $reply.rating}
                            <div class="rating-done">
                                {for $rating=1 to 5}
                                    <span class="star{if (5 - $reply.rating) < $rating} active{/if}"></span>
                                {/for}
                                <div class="rated">{$LANG.ticketreatinggiven}</div>
                            </div>
                        {else}
                            <div class="rating" ticketid="{$tid}" ticketkey="{$c}" ticketreplyid="{$reply.id}">
                                <span class="star" rate="5"></span>
                                <span class="star" rate="4"></span>
                                <span class="star" rate="3"></span>
                                <span class="star" rate="2"></span>
                                <span class="star" rate="1"></span>
                            </div>
                        {/if}
                    </div>
                {/if}

                    </div>

                    {if $reply.attachments}
                <div class="attachments p-3">
                    <strong>{$LANG.supportticketsticketattachments} ({$reply.attachments|count})</strong>
                    {if $reply.attachments_removed}({lang key='support.attachmentsRemoved'}){/if}
                    <ul>
                        {foreach $reply.attachments as $num => $attachment}
                            {if $reply.attachments_removed}
                                <li>
                                    <i class="far fa-file-minus"></i>
                                    {$attachment}
                                </li>
                            {else}
                                <li>
                                    <i class="far fa-file"></i>
                                    <a href="dl.php?type={if $reply.id}ar&id={$reply.id}{else}a&id={$id}{/if}&i={$num}">
                                        {$attachment}
                                    </a>
                                </li>
                            {/if}

                        {/foreach}
                    </ul>
                </div>
            {/if}

                </div>
               
            </div>
             {/foreach}

    </div>

    <h3 class="card-title">{$LANG.supportticketsreply}</h3>

    <div class="card d-print-none bg-gray-light tt-custom-card" id="ticketReplyContainer">
        <div class="card-body">
            <form method="post" action="{$smarty.server.PHP_SELF}?tid={$tid}&amp;c={$c}&amp;postreply=true" enctype="multipart/form-data" role="form" id="frmReply">
             <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputName">{$LANG.supportticketsclientname}</label>
                        <input class="form-control" type="text" name="replyname" id="inputName" value="{$replyname}"{if $loggedin} disabled="disabled"{/if}>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail">{$LANG.supportticketsclientemail}</label>
                        <input class="form-control" type="text" name="replyemail" id="inputEmail" value="{$replyemail}"{if $loggedin} disabled="disabled"{/if}>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputMessage">{$LANG.contactmessage}</label>
                    <textarea name="replymessage" id="inputMessage" rows="12" class="form-control markdown-editor" data-auto-save-name="ctr{$tid}">{$replymessage}</textarea>
                </div>

                <div class="form-group">
                    <label for="inputAttachments">{$LANG.supportticketsticketattachments}</label>
                    <div class="input-group mb-2 attachment-group">
                        <div class="custom-file">
                            <label class="custom-file-label text-truncate">
                                Choose file
                            </label>
                            <input type="file" name="attachments[]" id="inputAttachments" class="form-control custom-file-input" />
                        </div>

                        <div class="input-group-append">
                         
                            <button type="button" class="btn btn-default btn-sm" id="btnTicketAttachmentsAdd">
                                <i class="fas fa-plus"></i> {$LANG.addmore}
                            </button>
                        </div>
                        
                    </div>

                    <div class="file-upload w-hidden">
                        <div class="input-group mb-2 attachment-group">
                            <div class="custom-file">
                                <label class="custom-file-label text-truncate">
                                    Choose file
                                </label>
                                <input type="file" class="form-control custom-file-input" name="attachments[]">
                            </div>
                        </div>
                    </div>
                    <div id="fileUploadsContainer"></div>

                    <div class="text-muted">
                        <small>{$LANG.supportticketsallowedextensions}: {$allowedfiletypes} ({lang key="maxFileSize" fileSize="$uploadMaxFileSize"})</small>
                    </div>

                    

                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="save" value="{$LANG.supportticketsticketsubmit}" />
                    <input class="btn btn-default" type="reset" value="{$LANG.cancel}" onclick="jQuery('#ticketReply').click()" />
                </div>
            </form>
        </div>
    </div>

{/if}

{if file_exists("templates/$template/packages/overwrites/error/unknown-routepath.tpl")}
    {include file="{$template}/packages/overwrites/error/unknown-routepath.tpl"}
{else}
    <div class="alert alert-danger">
        <strong><i class="fas fa-times-circle"></i> Sorry, but the previous page (<a
                href="{$referrer|escape}">{$referrer|escape}</a>) provided an invalid page link.</strong>
    </div>
{/if}
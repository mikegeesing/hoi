{if file_exists("templates/$template/packages/overwrites/oauth/error.tpl")}
    {include file="{$template}/packages/overwrites/oauth/error.tpl"}
{else}
    <div class="container">
        <div class="alert alert-warning text-center">
            <i class="fas fa-exclamation-circle"></i>
            {$error}
        </div>
    </div>
{/if}
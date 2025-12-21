{if file_exists("templates/$template/packages/overwrites/includes/pageheader.tpl")}
    {include file="{$template}/packages/overwrites/includes/pageheader.tpl"}
{else}
    <div class="header-lined">
        <h1>{$title}</h1>
        {if $desc} <small>{$desc}</small>{/if}
        {if $showbreadcrumb}{include file="$template/includes/breadcrumb.tpl"}{/if}
    </div>
{/if}
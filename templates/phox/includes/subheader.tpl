{if file_exists("templates/$template/packages/overwrites/includes/subheader.tpl")}
    {include file="{$template}/packages/overwrites/includes/subheader.tpl"}
{else}
    <h2>{$title}</h2>
{/if}
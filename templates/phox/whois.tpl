{if file_exists("templates/$template/packages/overwrites/whois.tpl")}
    {include file="{$template}/packages/overwrites/whois.tpl"}
{else}
    {$whois}
{/if}
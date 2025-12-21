<title>
    {if isset($Phox['pages']['seo']['title']) && !empty($Phox['pages']['seo']['title'])}
        {$Phox['pages']['seo']['title']}
    {elseif $kbarticle.title}
        {$kbarticle.title}
    {elseif $templatefile == "viewinvoice" || $templatefile == "viewquote" || $templatefile == "clientareahome"}
        {$pagetitle}
    {elseif $templatefile == "products"}
        {$groupname}
    {else}
        {$displayTitle}
    {/if} - {$companyname}
</title>

{if $templatefile == "knowledgebasearticle" || $templatefile == "viewannouncement" || $templatefile == "knowledgebasecat"}
    <meta name="description"
        content="{if $templatefile == "viewannouncement"}{$summary|replace:'"':''|strip:" "|truncate:155:"..."}{elseif $templatefile == "knowledgebasearticle"}{$kbarticle.text|strip_tags|replace:'"':''|strip:" "|truncate:155:"..."}{elseif $templatefile == "knowledgebasecat"}{$catname|strip_tags|replace:'"':''|strip:" "|truncate:155:"..."}{/if}">

{elseif $templatefile == "products"}
{if $productGroup.tagline}
<meta name="description" content="{$productGroup.tagline|replace:'"':''|truncate:155:"..."}">
{/if}

{/if}

{if isset($Phox['pages']['seo']['description'])  && !empty($Phox['pages']['seo']['description'])}
<meta name="description" content="{$Phox['pages']['seo']['description']}">{/if}

{if $templatefile == "viewticket" && !$loggedin}
    <meta name="robots" content="noindex" />
{/if}

<meta name="og:type" content="{if $templatefile == 'homepage'}website{else}article{/if}">
<meta name="og:title"
    content="{if isset($Phox['pages']['seo']['title']) && !empty($Phox['pages']['seo']['title'])}{$Phox['pages']['seo']['title']}{else}{$displayTitle}{/if}">
{if isset($Phox['pages']['seo']['description'])  && !empty($Phox['pages']['seo']['description'])}
<meta name="og:description" content="{$Phox['pages']['seo']['description']}">{/if}
<meta name="og:url" content="{$systemurl}{$smarty.server.REQUEST_URI|ltrim:$WEB_ROOT}">
<meta name="twitter:title"
    content="{if isset($Phox['pages']['seo']['title']) && !empty($Phox['pages']['seo']['title'])}{$Phox['pages']['seo']['title']}{else}{$displayTitle}{/if}">
{if isset($Phox['pages']['seo']['description']) && !empty($Phox['pages']['seo']['description'])}
<meta name="twitter:description" content="{$Phox['pages']['seo']['description']}">{/if}
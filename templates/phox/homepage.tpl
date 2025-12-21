{if isset($Phox['pages'][$templatefile]) && file_exists($Phox['pages']['fullPath'])}
  {include file=$Phox['pages']['fullPath']}
{else}
  {include file=$Phox['pages']['fullPathDefault']}
{/if}
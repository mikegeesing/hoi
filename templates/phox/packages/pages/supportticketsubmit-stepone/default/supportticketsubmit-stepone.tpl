<div class="section">
  <div class="section-header">
    <p class="section-description">{$LANG.supportticketsheader}</p>
  </div>
  <div class="section-body">
    <div class="kbcategories wdes-tickets-deps">
      {foreach from=$departments key=num item=department}
        <a class="col-md-4 wdes-kb-item wdes-ticket-dept"
          href="{$smarty.server.PHP_SELF}?step=2&amp;deptid={$department.id}">
          <div class="wdes-title-kb">
            <i class="fad fa-envelope"></i>
            {$department.name}
          </div>
          {if $department.description}
            <p>{$department.description}</p>
          {/if}
        </a>
      {foreachelse}
        {include file="$template/includes/alert.tpl" type="info" msg=$LANG.nosupportdepartments textcenter=true}
      {/foreach}
    </div>
  </div>
</div>



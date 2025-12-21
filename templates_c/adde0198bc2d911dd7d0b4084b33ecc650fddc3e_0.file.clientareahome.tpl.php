<?php
/* Smarty version 3.1.48, created on 2025-10-27 15:23:29
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/clientareahome.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_68ff80619fff73_03130318',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'adde0198bc2d911dd7d0b4084b33ecc650fddc3e' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/clientareahome.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ff80619fff73_03130318 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'outputHomePanels' => 
  array (
    'compiled_filepath' => '/home/onlineh/domains/onlinehoster.nl/public_html/templates_c/adde0198bc2d911dd7d0b4084b33ecc650fddc3e_0.file.clientareahome.tpl.php',
    'uid' => 'adde0198bc2d911dd7d0b4084b33ecc650fddc3e',
    'call_name' => 'smarty_template_function_outputHomePanels_77267990268ff80619e8856_36662539',
  ),
));
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/flashmessage.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
<div class="tiles clearfix">
  <div class="row">
    <div class="col-6 col-xl-3" onclick="window.location='clientarea.php?action=services'"> <a href="clientarea.php?action=services" class="tile tt-custom-radius tt-single-box"> <i class="fad fa-server"></i>
      <div class="tt-box-info">
        <div class="stat"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['productsnumactive'];?>
</div>
        <div class="title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navservices'];?>
</div>
      </div>
      </a> </div>
    <?php if ($_smarty_tpl->tpl_vars['clientsstats']->value['numdomains'] || $_smarty_tpl->tpl_vars['registerdomainenabled']->value || $_smarty_tpl->tpl_vars['transferdomainenabled']->value) {?>
    <div class="col-6 col-xl-3" onclick="window.location='clientarea.php?action=domains'"> <a href="clientarea.php?action=domains" class="tile tt-custom-radius tt-single-box"> <i class="fad fa-globe-americas"></i>
      <div class="tt-box-info">
        <div class="stat"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numactivedomains'];?>
</div>
        <div class="title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navdomains'];?>
</div>
      </div>
      </a> </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['condlinks']->value['affiliates'] && $_smarty_tpl->tpl_vars['clientsstats']->value['isAffiliate']) {?>
    <div class="col-6 col-xl-3" onclick="window.location='affiliates.php'"> <a href="affiliates.php" class="tile tt-custom-radius tt-single-box"> <i class="fas fa-shopping-cart"></i>
      <div class="tt-box-info">
        <div class="stat"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numaffiliatesignups'];?>
</div>
        <div class="title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['affiliatessignups'];?>
</div>
      </div>
      </a> </div>
    <?php } else { ?>
    <div class="col-6 col-xl-3" onclick="window.location='clientarea.php?action=quotes'"> <a href="clientarea.php?action=quotes" class="tile tt-custom-radius tt-single-box"> <i class="far fa-file-alt"></i>
      <div class="tt-box-info">
        <div class="stat"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numquotes'];?>
</div>
        <div class="title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['quotes'];?>
</div>
      </div>
      </a> </div>
    <?php }?>
    <div class="col-6 col-xl-3" onclick="window.location='supporttickets.php'"> <a href="supporttickets.php" class="tile tt-custom-radius tt-single-box"> <i class="fad fa-ticket-alt"></i>
      <div class="tt-box-info">
        <div class="stat"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numactivetickets'];?>
</div>
        <div class="title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navtickets'];?>
</div>
      </div>
      </a> </div>
    <div class="col-6 col-xl-3" onclick="window.location='clientarea.php?action=invoices'"> <a href="clientarea.php?action=invoices" class="tile tt-custom-radius tt-single-box"> <i class="fas fa-credit-card"></i>
      <div class="tt-box-info">
        <div class="stat"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numunpaidinvoices'];?>
</div>
        <div class="title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navinvoices'];?>
</div>
      </div>
      </a> </div>
  </div>
</div>
<form role="form" method="post" action="clientarea.php?action=kbsearch">
  <div class="row">
    <div class="col-md-12 home-kb-search">
      <input type="text" name="search" class="form-control input-lg" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientHomeSearchKb'];?>
" />
      <i class="fas fa-search"></i> </div>
  </div>
</form>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addons_html']->value, 'addon_html');
$_smarty_tpl->tpl_vars['addon_html']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['addon_html']->value) {
$_smarty_tpl->tpl_vars['addon_html']->do_else = false;
?>
<div> <?php echo $_smarty_tpl->tpl_vars['addon_html']->value;?>
 </div>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['captchaError']->value) {?>
    <div class="alert alert-danger">
        <?php echo $_smarty_tpl->tpl_vars['captchaError']->value;?>

    </div>
<?php }?>
<div class="client-home-cards tt-client-home-cards">
  <div class="row">
    <div class="col-12"> 
      
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['panels']->value, 'item');
$_smarty_tpl->tpl_vars['item']->iteration = 0;
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
$_smarty_tpl->tpl_vars['item']->iteration++;
$__foreach_item_8_saved = $_smarty_tpl->tpl_vars['item'];
?>
      <?php if ($_smarty_tpl->tpl_vars['item']->value->getExtra('colspan')) {?>
      <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'outputHomePanels', array(), true);?>

      <?php $_smarty_tpl->_assignInScope('panels', $_smarty_tpl->tpl_vars['panels']->value->removeChild($_smarty_tpl->tpl_vars['item']->value->getName()));?>
      <?php }?>
      <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_8_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </div>
    <div class="col-md-6"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['panels']->value, 'item');
$_smarty_tpl->tpl_vars['item']->iteration = 0;
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
$_smarty_tpl->tpl_vars['item']->iteration++;
$__foreach_item_9_saved = $_smarty_tpl->tpl_vars['item'];
?>
      <?php if ((1 & $_smarty_tpl->tpl_vars['item']->iteration)) {?>
      <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'outputHomePanels', array(), true);?>

      <?php }?>
      <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_9_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </div>
    <div class="col-md-6"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['panels']->value, 'item');
$_smarty_tpl->tpl_vars['item']->iteration = 0;
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
$_smarty_tpl->tpl_vars['item']->iteration++;
$__foreach_item_10_saved = $_smarty_tpl->tpl_vars['item'];
?>
      <?php if (!(1 & $_smarty_tpl->tpl_vars['item']->iteration)) {?>
      <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'outputHomePanels', array(), true);?>

      <?php }?>
      <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_10_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </div>
  </div>
</div>
<?php }
/* smarty_template_function_outputHomePanels_77267990268ff80619e8856_36662539 */
if (!function_exists('smarty_template_function_outputHomePanels_77267990268ff80619e8856_36662539')) {
function smarty_template_function_outputHomePanels_77267990268ff80619e8856_36662539(Smarty_Internal_Template $_smarty_tpl,$params) {
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

      <div menuItemName="<?php echo $_smarty_tpl->tpl_vars['item']->value->getName();?>
" class="card  card-default card-accent-<?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('color');
if ($_smarty_tpl->tpl_vars['item']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['item']->value->getClass();
}?>"<?php if ($_smarty_tpl->tpl_vars['item']->value->getAttribute('id')) {?> id="<?php echo $_smarty_tpl->tpl_vars['item']->value->getAttribute('id');?>
"<?php }?>>
        <div class="card-header">
          <h3 class="card-title m-0"> <?php if ($_smarty_tpl->tpl_vars['item']->value->getExtra('btn-link') && $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-text')) {?>
            <div class="float-right"> <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-link');?>
" class="btn btn-default bg-color-<?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('color');?>
 btn-xs"> <?php if ($_smarty_tpl->tpl_vars['item']->value->getExtra('btn-icon')) {?><i class="<?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-icon');?>
"></i><?php }?>
              <?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-text');?>
 </a> </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['item']->value->hasIcon()) {?><i class="<?php echo $_smarty_tpl->tpl_vars['item']->value->getIcon();?>
"></i>&nbsp;<?php }?>
            <?php echo $_smarty_tpl->tpl_vars['item']->value->getLabel();?>

            <?php if ($_smarty_tpl->tpl_vars['item']->value->hasBadge()) {?>&nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['item']->value->getBadge();?>
</span><?php }?> </h3>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['item']->value->hasBodyHtml()) {?>
        <div class="card-body"> <?php echo $_smarty_tpl->tpl_vars['item']->value->getBodyHtml();?>
 </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?>
        <div class="list-group<?php if ($_smarty_tpl->tpl_vars['item']->value->getChildrenAttribute('class')) {?> <?php echo $_smarty_tpl->tpl_vars['item']->value->getChildrenAttribute('class');
}?>"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value->getChildren(), 'childItem');
$_smarty_tpl->tpl_vars['childItem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['childItem']->value) {
$_smarty_tpl->tpl_vars['childItem']->do_else = false;
?>
          <?php if ($_smarty_tpl->tpl_vars['childItem']->value->getUri()) {?> <a menuItemName="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getName();?>
" href="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getUri();?>
" class="list-group-item list-group-item-action<?php if ($_smarty_tpl->tpl_vars['childItem']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getClass();
}
if ($_smarty_tpl->tpl_vars['childItem']->value->isCurrent()) {?> active<?php }?>"<?php if ($_smarty_tpl->tpl_vars['childItem']->value->getAttribute('dataToggleTab')) {?> data-toggle="tab"<?php }
if ($_smarty_tpl->tpl_vars['childItem']->value->getAttribute('target')) {?> target="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getAttribute('target');?>
"<?php }?> id="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getId();?>
">
          <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasIcon()) {?><i class="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getIcon();?>
"></i>&nbsp;<?php }?>
          <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getLabel();?>

          <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasBadge()) {?>&nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['childItem']->value->getBadge();?>
</span><?php }?> </a> <?php } else { ?>
          <div menuItemName="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getName();?>
" class="list-group-item list-group-item-action<?php if ($_smarty_tpl->tpl_vars['childItem']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getClass();
}?>" id="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getId();?>
"> <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasIcon()) {?><i class="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getIcon();?>
"></i>&nbsp;<?php }?>
            <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getLabel();?>

            <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasBadge()) {?>&nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['childItem']->value->getBadge();?>
</span><?php }?> </div>
          <?php }?>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['item']->value->hasFooterHtml()) {?>
        <div class="card-footer"> <?php echo $_smarty_tpl->tpl_vars['item']->value->getFooterHtml();?>
 </div>
        <?php }?> </div>
      <?php
}}
/*/ smarty_template_function_outputHomePanels_77267990268ff80619e8856_36662539 */
}

<?php
/* Smarty version 3.1.48, created on 2025-10-28 01:51:40
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/clientareadomains.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6900139c5f4ad0_66707638',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bfdc3af7db7cf59799a543974dba426b7a0e53a7' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/clientareadomains.tpl',
      1 => 1761561845,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6900139c5f4ad0_66707638 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['warnings']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"warning",'msg'=>$_smarty_tpl->tpl_vars['warnings']->value,'textcenter'=>true), 0, true);
}?>
<div class="tab-content">
    <div class="tab-pane fade in active" id="tabOverview">
        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/tablelist.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('tableName'=>"DomainsList",'noSortColumns'=>"0, 1, 6",'startOrderCol'=>"2",'filterColumn'=>"6"), 0, true);
?>
        <?php echo '<script'; ?>
 type="text/javascript">
            jQuery(document).ready( function ()
            {
                var table = jQuery('#tableDomainsList').removeClass('hidden').DataTable();
                <?php if ($_smarty_tpl->tpl_vars['orderby']->value == 'domain') {?>
                    table.order(2, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
                <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'regdate' || $_smarty_tpl->tpl_vars['orderby']->value == 'registrationdate') {?>
                    table.order(3, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
                <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'nextduedate') {?>
                    table.order(4, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
                <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'autorenew') {?>
                    table.order(5, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
                <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'status') {?>
                    table.order(6, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
                <?php }?>
                table.draw();
                jQuery('#tableLoading').addClass('hidden');
            });
        <?php echo '</script'; ?>
>
        <form id="domainForm" method="post" action="clientarea.php?action=bulkdomain">
            <input id="bulkaction" name="update" type="hidden" />

            <div class="table-container clearfix">
                <table id="tableDomainsList" class="table table-list hidden">
                    <thead>
                        <tr>
                            <th width="20"></th>
                            <th></th>
                            <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderdomain'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['regdate'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['nextdue'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenew'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainstatus'];?>
</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['domains']->value, 'domain', false, 'num');
$_smarty_tpl->tpl_vars['domain']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['domain']->value) {
$_smarty_tpl->tpl_vars['domain']->do_else = false;
?>
                        <tr onclick="clickableSafeRedirect(event, 'clientarea.php?action=domaindetails&amp;id=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
', false)">
                            <td>
                                <input type="checkbox" name="domids[]" class="domids stopEventBubble" value="<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
" />
                            </td>
                            <td class="text-center ssl-info" data-element-id="<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
" data-type="domain" data-domain="<?php echo $_smarty_tpl->tpl_vars['domain']->value['domain'];?>
">
                                <?php if ($_smarty_tpl->tpl_vars['domain']->value['sslStatus']) {?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value['sslStatus']->getImagePath();?>
" data-toggle="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['domain']->value['sslStatus']->getTooltipContent();?>
" class="<?php echo $_smarty_tpl->tpl_vars['domain']->value['sslStatus']->getClass();?>
"/>
                                <?php } elseif (!$_smarty_tpl->tpl_vars['domain']->value['isActive']) {?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_IMG']->value;?>
/ssl/ssl-inactive-domain.png" data-toggle="tooltip" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'sslState.sslInactiveDomain'),$_smarty_tpl ) );?>
">
                                <?php }?>
                            </td>
                            <td><a href="http://<?php echo $_smarty_tpl->tpl_vars['domain']->value['domain'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['domain']->value['domain'];?>
</a></td>
                            <td><span class="hidden"><?php echo $_smarty_tpl->tpl_vars['domain']->value['normalisedRegistrationDate'];?>
</span><?php echo $_smarty_tpl->tpl_vars['domain']->value['registrationdate'];?>
</td>
                            <td><span class="hidden"><?php echo $_smarty_tpl->tpl_vars['domain']->value['normalisedNextDueDate'];?>
</span><?php echo $_smarty_tpl->tpl_vars['domain']->value['nextduedate'];?>
</td>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['domain']->value['autorenew']) {?>
                                    <i class="fas fa-fw fa-check text-success"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenewenabled'];?>

                                <?php } else { ?>
                                    <i class="fas fa-fw fa-times text-danger"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenewdisabled'];?>

                                <?php }?>
                            </td>
                            <td>
                                <span class="label status status-<?php echo $_smarty_tpl->tpl_vars['domain']->value['statusClass'];?>
"><?php echo $_smarty_tpl->tpl_vars['domain']->value['statustext'];?>
</span>
                                <span class="hidden">
                                    <?php if ($_smarty_tpl->tpl_vars['domain']->value['expiringSoon']) {?><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"domainsExpiringSoon"),$_smarty_tpl ) );?>
</span><?php }?>
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" style="width:60px;">
                                    <a href="clientarea.php?action=domaindetails&id=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
" class="btn btn-default"><i class="fas fa-wrench"></i></a>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu text-left dropdown-menu-right" role="menu">
                                        <?php if ($_smarty_tpl->tpl_vars['domain']->value['status'] == 'Active') {?>
                                            <li><a href="clientarea.php?action=domaindetails&id=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
#tabNameservers"><i class="glyphicon glyphicon-globe"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainmanagens'];?>
</a></li>
                                            <li><a href="clientarea.php?action=domaincontacts&domainid=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
"><i class="glyphicon glyphicon-user"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaincontactinfoedit'];?>
</a></li>
                                            <li><a href="clientarea.php?action=domaindetails&id=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
#tabAutorenew"><i class="glyphicon glyphicon-globe"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainautorenewstatus'];?>
</a></li>
                                            <li class="divider"></li>
                                        <?php }?>
                                        <li><a href="clientarea.php?action=domaindetails&id=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
"><i class="glyphicon glyphicon-pencil"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['managedomain'];?>
</a></li>
                                        <?php if ($_smarty_tpl->tpl_vars['allowrenew']->value) {?>
                                            <?php if ($_smarty_tpl->tpl_vars['domain']->value['canDomainBeManaged']) {?>
                                                <li><a href="<?php echo routePath('domain-renewal',$_smarty_tpl->tpl_vars['domain']->value['domain']);?>
"><i class="glyphicon glyphicon-refresh"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'domainsrenew'),$_smarty_tpl ) );?>
</a></li>
                                            <?php } else { ?>
                                                <li class="disabled"><a href="#" onclick="return false;" class="disabled" disabled="disabled"><i class="glyphicon glyphicon-refresh"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'domainsrenew'),$_smarty_tpl ) );?>
</a></li>
                                            <?php }?>

                                        <?php }?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
                <div class="text-center" id="tableLoading">
                    <p><i class="fas fa-spinner fa-spin"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['loading'];?>
</p>
                </div>
            </div>
        </form>

        <div class="btn-group margin-bottom">
            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-folder-open"></span> &nbsp; <?php echo $_smarty_tpl->tpl_vars['LANG']->value['withselected'];?>
 <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#" id="nameservers" class="setBulkAction"><i class="glyphicon glyphicon-globe"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainmanagens'];?>
</a></li>
                <li><a href="#" id="autorenew" class="setBulkAction"><i class="glyphicon glyphicon-refresh"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainautorenewstatus'];?>
</a></li>
                <li><a href="#" id="reglock" class="setBulkAction"><i class="glyphicon glyphicon-lock"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainreglockstatus'];?>
</a></li>
                <li><a href="#" id="contactinfo" class="setBulkAction"><i class="glyphicon glyphicon-user"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaincontactinfoedit'];?>
</a></li>
                <?php if ($_smarty_tpl->tpl_vars['allowrenew']->value) {?>
                    <li><a href="#" id="renewDomains" class="setBulkAction"><i class="glyphicon glyphicon-refresh"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'domainmassrenew'),$_smarty_tpl ) );?>
</a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>
<?php }
}

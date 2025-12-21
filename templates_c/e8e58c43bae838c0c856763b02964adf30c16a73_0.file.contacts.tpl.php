<?php
/* Smarty version 3.1.48, created on 2025-10-28 22:24:16
  from '/home/onlineh/domains/onlinehoster.nl/public_html/modules/registrars/MijnHostRegistrar/contacts.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69013480dba545_84944604',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8e58c43bae838c0c856763b02964adf30c16a73' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/modules/registrars/MijnHostRegistrar/contacts.tpl',
      1 => 1761682934,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69013480dba545_84944604 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="card">
    <div class="card-body">
        <h3 class="card-title"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get('assignContactProfilesToDomain');?>
</h3>
        <form method="POST" action="clientarea.php?action=domaindetails&id=<?php echo $_smarty_tpl->tpl_vars['domainId']->value;?>
&modop=custom&a=Contacts&mhr-action=assignProfile">
            <div class="form-group row">
                <label for="assignProfileOwnerSelect" class="col-sm-4 col-form-label"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get('ownerProfile');?>
</label>
                <div class="col-md-7">
                    <select class="form-control" id="assignProfileOwnerSelect" name="assignProfileOwnerSelect">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['profiles']->value, 'profile', false, 'key');
$_smarty_tpl->tpl_vars['profile']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['profile']->value) {
$_smarty_tpl->tpl_vars['profile']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['key']->value == $_smarty_tpl->tpl_vars['ownerContactId']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['profile']->value['alias'];?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="assignProfileAdminSelect" class="col-sm-4 col-form-label"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get('adminProfile');?>
</label>
                <div class="col-md-7">
                    <select class="form-control" id="assignProfileAdminSelect" name="assignProfileAdminSelect">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['profiles']->value, 'profile', false, 'key');
$_smarty_tpl->tpl_vars['profile']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['profile']->value) {
$_smarty_tpl->tpl_vars['profile']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['key']->value == $_smarty_tpl->tpl_vars['adminContactId']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['profile']->value['alias'];?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="assignProfileTechSelect" class="col-sm-4 col-form-label"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get('techProfile');?>
</label>
                <div class="col-md-7">
                    <select class="form-control" id="assignProfileTechSelect" name="assignProfileTechSelect">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['profiles']->value, 'profile', false, 'key');
$_smarty_tpl->tpl_vars['profile']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['profile']->value) {
$_smarty_tpl->tpl_vars['profile']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['key']->value == $_smarty_tpl->tpl_vars['techContactId']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['profile']->value['alias'];?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="assignProfileBillingSelect" class="col-sm-4 col-form-label"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get('billingProfile');?>
</label>
                <div class="col-md-7">
                    <select class="form-control" id="assignProfileBillingSelect" name="assignProfileBillingSelect">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['profiles']->value, 'profile', false, 'key');
$_smarty_tpl->tpl_vars['profile']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['profile']->value) {
$_smarty_tpl->tpl_vars['profile']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['key']->value == $_smarty_tpl->tpl_vars['billingContactId']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['profile']->value['alias'];?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 offset-sm-4">
                    <button id="assignProfileButton" type="submit" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get('assignContactProfile');?>
</button>
                </div>
            </div>
        </form>
    </div>
</div><?php }
}

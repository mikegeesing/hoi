<?php
/* Smarty version 3.1.48, created on 2025-10-28 22:22:28
  from '/home/onlineh/domains/onlinehoster.nl/public_html/modules/registrars/MijnHostRegistrar/nameservers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69013414491e40_35072613',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a8b6f4aca16bfc75e366c6e75ff13774677c576' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/modules/registrars/MijnHostRegistrar/nameservers.tpl',
      1 => 1761682934,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69013414491e40_35072613 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="card">
    <div class="card-body">
        <h3 class="card-title"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get('assignNameserverProfileToDomain');?>
</h3>
        <form method="POST" action="clientarea.php?action=domaindetails&id=<?php echo $_smarty_tpl->tpl_vars['domainId']->value;?>
&modop=custom&a=Nameservers&mhr-action=assignProfile">
            <div class="form-group row">
                <label for="assignProfileSelect" class="col-sm-4 col-form-label"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get('nameserverProfile');?>
</label>
                <div class="col-md-7">
                    <select class="form-control" id="assignProfileSelect" name="assignProfileSelect">
                        <option value="current"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get('current');?>
</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nameserversProfiles']->value, 'profile', false, 'key');
$_smarty_tpl->tpl_vars['profile']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['profile']->value) {
$_smarty_tpl->tpl_vars['profile']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
            </div>
            <div class="assignProfileNameserverProfile" id="assignProfileNameserverProfile_current">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currentNameservers']->value, 'nameserver', false, 'key');
$_smarty_tpl->tpl_vars['nameserver']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['nameserver']->value) {
$_smarty_tpl->tpl_vars['nameserver']->do_else = false;
?>
                    <div class="form-group row">
                        <label for="assignProfileNameserverProfile_current_ns<?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
" class="col-sm-4 col-form-label"><?php ob_start();
echo $_smarty_tpl->tpl_vars['key']->value+1;
$_prefixVariable1 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['lang']->value->get('nameserver',array('key'=>$_prefixVariable1));?>
</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" id="assignProfileNameserverProfile_current_ns<?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
" value="<?php echo $_smarty_tpl->tpl_vars['nameserver']->value;?>
" disabled>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nameserversProfiles']->value, 'profile', false, 'key');
$_smarty_tpl->tpl_vars['profile']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['profile']->value) {
$_smarty_tpl->tpl_vars['profile']->do_else = false;
?>
                <div class="assignProfileNameserverProfile" id="assignProfileNameserverProfile_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" style="display: none;">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['profile']->value, 'nameserver', false, 'keyNameserver');
$_smarty_tpl->tpl_vars['nameserver']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['keyNameserver']->value => $_smarty_tpl->tpl_vars['nameserver']->value) {
$_smarty_tpl->tpl_vars['nameserver']->do_else = false;
?>
                        <div class="form-group row">
                            <label for="assignProfileNameserverProfile_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
_ns<?php echo $_smarty_tpl->tpl_vars['keyNameserver']->value+1;?>
" class="col-sm-4 col-form-label"><?php ob_start();
echo $_smarty_tpl->tpl_vars['keyNameserver']->value+1;
$_prefixVariable2 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['lang']->value->get('nameserver',array('key'=>$_prefixVariable2));?>
</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="assignProfileNameserverProfile_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
_ns<?php echo $_smarty_tpl->tpl_vars['keyNameserver']->value+1;?>
" value="<?php echo $_smarty_tpl->tpl_vars['nameserver']->value;?>
" disabled>
                            </div>
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <div class="row">
                <div class="col-sm-8 offset-sm-4">
                    <button id="assignProfileButton" disabled type="submit" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['lang']->value->get('assignNameserverProfile');?>
</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php echo '<script'; ?>
>
    $(document).ready(function () {
        $('#assignProfileSelect').on('change', function () {
            $('.assignProfileNameserverProfile').hide();
            $('#assignProfileNameserverProfile_' + $(this).val()).show();

            if($(this).val() === "current") {
                $('#assignProfileButton').prop('disabled', true);
            } else {
                $('#assignProfileButton').prop('disabled', false);
            }
        });
    });
<?php echo '</script'; ?>
><?php }
}

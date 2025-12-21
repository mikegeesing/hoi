<?php
/* Smarty version 3.1.48, created on 2025-10-28 22:10:51
  from 'mailMessage:plaintext' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6901315b370266_82246257',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dac51ccee8dbecedf9afb805fb153d5c6bf41d7a' => 
    array (
      0 => 'mailMessage:plaintext',
      1 => 1761685851,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901315b370266_82246257 (Smarty_Internal_Template $_smarty_tpl) {
?>Beste <?php echo $_smarty_tpl->tpl_vars['client_name']->value;?>
,


Dit is een bericht dat er een factuur is aangemaakt op <?php echo $_smarty_tpl->tpl_vars['invoice_date_created']->value;?>
.


Uw betaalmethode is: <?php echo $_smarty_tpl->tpl_vars['invoice_payment_method']->value;?>



Factuurnummer: <?php echo $_smarty_tpl->tpl_vars['invoice_num']->value;?>

Te betalen bedrag: <?php echo $_smarty_tpl->tpl_vars['invoice_total']->value;?>

Vervaldatum: <?php echo $_smarty_tpl->tpl_vars['invoice_date_due']->value;?>



Factuuritems


<?php echo $_smarty_tpl->tpl_vars['invoice_html_contents']->value;?>

------------------------------------------------------


U kunt inloggen op uw klantportaal om de factuur te bekijken en te betalen via <?php echo $_smarty_tpl->tpl_vars['invoice_link']->value;?>



<?php echo $_smarty_tpl->tpl_vars['signature']->value;
}
}

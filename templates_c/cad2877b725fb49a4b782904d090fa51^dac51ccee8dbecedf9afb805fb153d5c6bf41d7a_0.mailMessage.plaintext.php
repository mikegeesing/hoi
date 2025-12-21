<?php
/* Smarty version 3.1.48, created on 2025-11-27 18:05:38
  from 'mailMessage:plaintext' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_692892f2b78d49_15636987',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dac51ccee8dbecedf9afb805fb153d5c6bf41d7a' => 
    array (
      0 => 'mailMessage:plaintext',
      1 => 1764266738,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_692892f2b78d49_15636987 (Smarty_Internal_Template $_smarty_tpl) {
?>Beste <?php echo $_smarty_tpl->tpl_vars['client_name']->value;?>
,


Dit is een betalingsbevestiging voor factuur <?php echo $_smarty_tpl->tpl_vars['invoice_num']->value;?>
, verzonden op <?php echo $_smarty_tpl->tpl_vars['invoice_date_created']->value;?>
.


<?php echo $_smarty_tpl->tpl_vars['invoice_html_contents']->value;?>



Bedrag: <?php echo $_smarty_tpl->tpl_vars['invoice_last_payment_amount']->value;?>

Transactie #: <?php echo $_smarty_tpl->tpl_vars['invoice_last_payment_transid']->value;?>

Totaal Betaald: <?php echo $_smarty_tpl->tpl_vars['invoice_amount_paid']->value;?>

Resterend Saldo: <?php echo $_smarty_tpl->tpl_vars['invoice_balance']->value;?>

Status: <?php echo $_smarty_tpl->tpl_vars['invoice_status']->value;?>



U kunt uw factuurgeschiedenis op elk moment bekijken door in te loggen op uw klantportaal.


Opmerking: Deze e-mail dient als officieel bewijs van betaling.


<?php echo $_smarty_tpl->tpl_vars['signature']->value;
}
}

<?php
/* Smarty version 3.1.48, created on 2025-10-28 22:11:49
  from 'mailMessage:plaintext' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69013195239035_96655344',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dac51ccee8dbecedf9afb805fb153d5c6bf41d7a' => 
    array (
      0 => 'mailMessage:plaintext',
      1 => 1761685909,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69013195239035_96655344 (Smarty_Internal_Template $_smarty_tpl) {
?>Dear <?php echo $_smarty_tpl->tpl_vars['client_name']->value;?>
, 

Thank you for your domain transfer order. Your order has been received and we have now initiated the transfer process. The details of the domain purchase are below: 

Domain: <?php echo $_smarty_tpl->tpl_vars['domain_name']->value;?>

Registration Length: <?php echo $_smarty_tpl->tpl_vars['domain_reg_period']->value;?>

Transfer Price: <?php echo $_smarty_tpl->tpl_vars['domain_first_payment_amount']->value;?>

Renewal Price: <?php echo $_smarty_tpl->tpl_vars['domain_recurring_amount']->value;?>

Next Due Date: <?php echo $_smarty_tpl->tpl_vars['domain_next_due_date']->value;?>
 

You may login to your client area at <?php echo $_smarty_tpl->tpl_vars['whmcs_url']->value;?>
 to manage your domain. 

<?php echo $_smarty_tpl->tpl_vars['signature']->value;
}
}

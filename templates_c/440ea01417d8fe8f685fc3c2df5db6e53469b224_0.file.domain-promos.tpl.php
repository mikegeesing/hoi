<?php
/* Smarty version 3.1.48, created on 2025-10-27 15:45:26
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/domain-promos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_68ff8586c937c5_45805124',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '440ea01417d8fe8f685fc3c2df5db6e53469b224' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/domain-promos.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ff8586c937c5_45805124 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <p>Currently Running Promos</p>
            <h1>Domain Promos</h1>
            <ul class="banner-list mb-2">
              <li>Discounted Registrations</li>
              <li>Free Privacy Protection</li>
              <li>Multi-Year Discounts</li>
              <li>Bonus Add-ons</li>
            </ul>
            <h4>Don't miss out, check our promos today!</h4>
            <div class="inline-btns mt-3">
              <a class="btn-01" onclick="document.getElementById('Plans').scrollIntoView();">Get Started Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
          <div class="text-center text-lg-end">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/7.svg" alt="Banner image" width="400">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Domain Pricing table -->
<div class="top-up-banner pb-4" id="Plans">
  <div class="container upside rounded bg-white shadow p-4">
    <div class="row"><?php if (count($_smarty_tpl->tpl_vars['pricetable']->value) > 0) {?> <div class="col-12">
        <div class="table-responsive domain-tld-table">
          <table>
            <thead>
              <tr>
                <th>TLDs</th>
                <th>Years</th>
                <th>Register</th>
                <th>Transfer</th>
                <th>Renew</th>
              </tr>
            </thead>
            <tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pricetable']->value, 'price');
$_smarty_tpl->tpl_vars['price']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['price']->value) {
$_smarty_tpl->tpl_vars['price']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.com') {?> <tr>
                <td>.com</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.in') {?> <tr>
                <td>.in</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.co.in') {?> <tr>
                <td>.co.in</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.in') {?> <tr>
                <td>.info</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.info') {?> <tr>
                <td>.info</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.in') {?> <tr>
                <td>.biz</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.biz') {?> <tr>
                <td>.biz</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.xyz') {?> <tr>
                <td>.xyz</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.online') {?> <tr>
                <td>.online</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr> <?php } elseif ($_smarty_tpl->tpl_vars['price']->value['extension'] == '.org') {?> <tr>
                <td>.org</td>
                <td>1 Year</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['price']->value['prefix'];
echo $_smarty_tpl->tpl_vars['price']->value['msetupfee'];?>
</td>
              </tr>
            </tbody> <?php }?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </table>
        </div>
      </div><?php }?> </div>
  </div>
</div>
<!-- Domain Pricing table end --><?php }
}

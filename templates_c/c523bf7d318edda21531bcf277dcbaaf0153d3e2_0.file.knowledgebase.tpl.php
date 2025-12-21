<?php
/* Smarty version 3.1.48, created on 2025-11-07 06:32:07
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/knowledgebase.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690d845732ff63_92023119',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c523bf7d318edda21531bcf277dcbaaf0153d3e2' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/knowledgebase.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690d845732ff63_92023119 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/onlineh/domains/onlinehoster.nl/public_html/vendor/smarty/smarty/libs/plugins/modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
echo $_smarty_tpl->tpl_vars['kb_quickfind']->value;?>

<div class="p-lg-5 p-md-5 p-3 bg-gray-light tt-rounded mb-4">
    <form role="form" method="post" action="<?php echo routePath('knowledgebase-search');?>
">
    <div class="input-group kb-search tt-kb-search">
        <div class="tt-search-field">
            <i class="far fa-search text-primary"></i>
            <input type="text" id="inputKnowledgebaseSearch" name="search" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientHomeSearchKb'];?>
" />
        </div>
        <input type="submit" id="btnKnowledgebaseSearch" class="btn btn-primary btn-input-padded-responsive" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['search'];?>
" />
      
    </div>
</form>
</div>



<?php if ($_smarty_tpl->tpl_vars['kbcats']->value) {?>
    <div class="row kbcategories">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kbcats']->value, 'kbcat', false, NULL, 'kbcats', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['kbcat']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['kbcat']->value) {
$_smarty_tpl->tpl_vars['kbcat']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_kbcats']->value['iteration']++;
?>
            <div class="col-xl-6">
                <div class="card kb-category mb-4">
                   <a href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['kbcat']->value['id'];
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['kbcat']->value['urlfriendlyname'];
$_prefixVariable2 = ob_get_clean();
echo routePath('knowledgebase-category-view',$_prefixVariable1,$_prefixVariable2);?>
" class="card-body mb-0">
                    
        
                    <span class="h6 m-0">
                            <span class="badge bg-primary-lights float-right p-2 fs-12">
                                (<?php echo $_smarty_tpl->tpl_vars['kbcat']->value['numarticles'];?>
) Article
                            </span>
                            <i class="far fa-folder fa-fw"></i>
                            <?php echo $_smarty_tpl->tpl_vars['kbcat']->value['name'];?>

                    </span>

                     <?php if ($_smarty_tpl->tpl_vars['kbcat']->value['editLink']) {?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['kbcat']->value['editLink'];?>
" class="admin-inline-edit">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['edit'];?>

                    </a>
                <?php }?>

                <p class="m-0 text-muted"><?php echo $_smarty_tpl->tpl_vars['kbcat']->value['description'];?>
</p>

                </a> 
                </div>
               
                
            </div>
            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_kbcats']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_kbcats']->value['iteration'] : null) % 4 == 0) {?>
                </div><div class="row kbcategories">
            <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
<?php } else { ?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['knowledgebasenoarticles'],'textcenter'=>true), 0, true);
}?>

<?php if ($_smarty_tpl->tpl_vars['kbmostviews']->value) {?>

    <div class="card">
        <div class="card-body">
            <h3 class="m-0 h5">
                <i class="far fa-star fa-fw"></i>
               <?php echo $_smarty_tpl->tpl_vars['LANG']->value['knowledgebasepopular'];?>

            </h3>
        </div>
        <div class="list-group list-group-flush">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kbmostviews']->value, 'kbarticle');
$_smarty_tpl->tpl_vars['kbarticle']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['kbarticle']->value) {
$_smarty_tpl->tpl_vars['kbarticle']->do_else = false;
?>
       <a href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['kbarticle']->value['id'];
$_prefixVariable3 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['kbarticle']->value['urlfriendlytitle'];
$_prefixVariable4 = ob_get_clean();
echo routePath('knowledgebase-article-view',$_prefixVariable3,$_prefixVariable4);?>
" class="list-group-item kb-article-item">
                    <i class="fad fa-file-alt fa-fw text-black-50"></i>
                    <?php echo $_smarty_tpl->tpl_vars['kbarticle']->value['title'];?>

        <small><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['kbarticle']->value['article'],100,"...");?>
</small>

        <?php if ($_smarty_tpl->tpl_vars['kbarticle']->value['editLink']) {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['kbarticle']->value['editLink'];?>
" class="admin-inline-edit">
                    <i class="fas fa-pencil-alt fa-fw"></i>
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['edit'];?>

                </a>
            <?php }?>

                </a>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    </div>
    </div>

    


<?php }
}
}

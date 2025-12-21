<?php
/* Smarty version 3.1.48, created on 2025-11-05 06:00:40
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/downloads.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690ad9f822ca18_42101814',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6cd9c993b6362f442a71411d081a458ad279e267' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/downloads.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ad9f822ca18_42101814 (Smarty_Internal_Template $_smarty_tpl) {
if (empty($_smarty_tpl->tpl_vars['dlcats']->value)) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['downloadsnone'],'textcenter'=>true), 0, true);
} else { ?>
<div class="p-lg-5 p-md-5 p-3 bg-gray-light tt-rounded mb-4">
    <form role="form" method="post" action="<?php echo routePath('download-search');?>
">
    <div class="input-group kb-search tt-kb-search">
        <div class="tt-search-field">
            <i class="far fa-search text-primary"></i>
            <input type="text" id="inputDownloadsSearch" name="search" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadssearch'];?>
" />
        </div>
        <input type="submit" id="btnDownloadsSearch" class="btn btn-primary btn-input-padded-responsive" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['search'];?>
" />
    </div>
</form>
</div>

<div class="tt-new-content">
<p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadsintrotext'];?>
</p>
</div>


    <div class="row kbcategories">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dlcats']->value, 'dlcat');
$_smarty_tpl->tpl_vars['dlcat']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['dlcat']->value) {
$_smarty_tpl->tpl_vars['dlcat']->do_else = false;
?>
            <div class="col-xl-6">
                <div class="card kb-category mb-4">
                   <a href="<?php echo routePath('download-by-cat',$_smarty_tpl->tpl_vars['dlcat']->value['id'],$_smarty_tpl->tpl_vars['dlcat']->value['urlfriendlyname']);?>
" class="card-body mb-0">
                    
        
                    <span class="h6 m-0">
                            <span class="badge bg-primary-lights float-right p-2 fs-12">
                                (<?php echo $_smarty_tpl->tpl_vars['dlcat']->value['numarticles'];?>
) Article
                            </span>
                            <i class="far fa-folder fa-fw"></i>
                            <?php echo $_smarty_tpl->tpl_vars['dlcat']->value['name'];?>

                    </span>

                <p class="m-0 text-muted"><?php echo $_smarty_tpl->tpl_vars['dlcat']->value['description'];?>
</p>

                </a> 
                </div>
            </div>

            <?php
}
if ($_smarty_tpl->tpl_vars['dlcat']->do_else) {
?>

            <div class="col-12 tt-new-content">
                <p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadsnone'];?>
</p>
            </div>
           
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>

     <div class="card">
        <div class="card-body">
            <h3 class="m-0 h5">
                <i class="far fa-star fa-fw"></i>
               <?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadspopular'];?>

            </h3>
        </div>
        <div class="list-group list-group-flush">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mostdownloads']->value, 'download');
$_smarty_tpl->tpl_vars['download']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['download']->value) {
$_smarty_tpl->tpl_vars['download']->do_else = false;
?>
       <a href="<?php echo $_smarty_tpl->tpl_vars['download']->value['link'];?>
" class="list-group-item kb-article-item">
                    <i class="fad fa-file-alt fa-fw text-black-50"></i>
                    <?php echo $_smarty_tpl->tpl_vars['download']->value['title'];?>

        <small><?php echo $_smarty_tpl->tpl_vars['download']->value['description'];?>
</small>
        </a>
        <?php
}
if ($_smarty_tpl->tpl_vars['download']->do_else) {
?>
            <span class="list-group-item text-center">
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadsnone'];?>

            </span>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    </div>
    </div>

<?php }
}
}

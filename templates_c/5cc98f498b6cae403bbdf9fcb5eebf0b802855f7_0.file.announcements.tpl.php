<?php
/* Smarty version 3.1.48, created on 2025-10-31 13:47:51
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/announcements.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6904aff71847c2_83679730',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5cc98f498b6cae403bbdf9fcb5eebf0b802855f7' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/announcements.tpl',
      1 => 1761561845,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6904aff71847c2_83679730 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['announcementsFbRecommend']->value) {?>
    <?php echo '<script'; ?>
>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/<?php echo $_smarty_tpl->tpl_vars['LANG']->value['locale'];?>
/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    <?php echo '</script'; ?>
>
<?php }?>

<h2 class="card-title">Announcements</h2>
<div class="announcements tt-news-wrap bg-white rounded mb-3">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['announcements']->value, 'announcement');
$_smarty_tpl->tpl_vars['announcement']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['announcement']->value) {
$_smarty_tpl->tpl_vars['announcement']->do_else = false;
?>


<div class="announcement tt-news-single p-4">
    <h2 class="h6">
        <a href="<?php echo routePath('announcement-view',$_smarty_tpl->tpl_vars['announcement']->value['id'],$_smarty_tpl->tpl_vars['announcement']->value['urlfriendlytitle']);?>
">
            <?php echo $_smarty_tpl->tpl_vars['announcement']->value['title'];?>

        </a>
    </h2>
    <ul class="list-inline mb-2">
                <li class="list-inline-item text-muted pr-3">
                    <i class="fad fa-calendar-alt fa-fw"></i>
                    <?php echo $_smarty_tpl->tpl_vars['carbon']->value->createFromTimestamp($_smarty_tpl->tpl_vars['announcement']->value['timestamp'])->format('jS M Y');?>

                </li>
    </ul>
    <?php if (strlen(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['announcement']->value['text'])) < 350) {?>
    <article>
        <?php echo $_smarty_tpl->tpl_vars['announcement']->value['text'];?>

    </article>
    <?php } else { ?>
    <article>
        <?php echo $_smarty_tpl->tpl_vars['announcement']->value['summary'];?>

    </article>
    <?php }?>
    <a href="<?php echo routePath('announcement-view',$_smarty_tpl->tpl_vars['announcement']->value['id'],$_smarty_tpl->tpl_vars['announcement']->value['urlfriendlytitle']);?>
" class="tt-read-more">
        Continue reading
        <i class="fad fa-arrow-right"></i>
    </a>

    <?php if ($_smarty_tpl->tpl_vars['announcement']->value['editLink']) {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['announcement']->value['editLink'];?>
" class="admin-inline-edit">
                    <i class="fas fa-pencil-alt fa-fw"></i>
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['edit'];?>

                </a>
            <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['announcementsFbRecommend']->value) {?>
            <div class="fb-like hidden-sm hidden-xs" data-layout="standard" data-href="<?php echo fqdnRoutePath('announcement-view',$_smarty_tpl->tpl_vars['announcement']->value['id'],$_smarty_tpl->tpl_vars['announcement']->value['urlfriendlytitle']);?>
" data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>
            <div class="fb-like hidden-lg hidden-md" data-layout="button_count" data-href="<?php echo fqdnRoutePath('announcement-view',$_smarty_tpl->tpl_vars['announcement']->value['id'],$_smarty_tpl->tpl_vars['announcement']->value['urlfriendlytitle']);?>
" data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>
        <?php }?>

</div>
 

<?php
}
if ($_smarty_tpl->tpl_vars['announcement']->do_else) {
?>

    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>((string)$_smarty_tpl->tpl_vars['LANG']->value['noannouncements']),'textcenter'=>true), 0, true);
?>

<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

 </div>  

<?php if ($_smarty_tpl->tpl_vars['prevpage']->value || $_smarty_tpl->tpl_vars['nextpage']->value) {?>
    <div class="col-xs-12 margin-bottom">
        <form class="form-inline" role="form">
            <div class="form-group">
                <div class="input-group">
                    <span class="btn-group">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pagination']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
" class="btn btn-default<?php if ($_smarty_tpl->tpl_vars['item']->value['active']) {?> active<?php }?>"<?php if ($_smarty_tpl->tpl_vars['item']->value['disabled']) {?> disabled="disabled"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>
</a>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </span>
                </div>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>
<?php }
}
}

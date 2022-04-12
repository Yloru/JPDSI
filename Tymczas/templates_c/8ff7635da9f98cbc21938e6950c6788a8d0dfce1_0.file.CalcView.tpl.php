<?php
/* Smarty version 3.1.30, created on 2022-04-12 09:15:11
  from "C:\xampp\htdocs\Kalkulator\app\views\CalcView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_625526ff267a28_01161173',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ff7635da9f98cbc21938e6950c6788a8d0dfce1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Kalkulator\\app\\views\\CalcView.tpl',
      1 => 1649746871,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_625526ff267a28_01161173 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_22422151625526ff2674e8_53354773', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'content'} */
class Block_22422151625526ff2674e8_53354773 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: <?php echo $_smarty_tpl->tpl_vars['user']->value->login;?>
, rola: <?php echo $_smarty_tpl->tpl_vars['user']->value->role;?>
</span>
</div>

<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
calcCompute" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Kalkulator kredytowy</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_N">Kredyt </label>
			<input id="id_N" type="text" name="N" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->N;?>
" />
		</div>

        <div class="pure-control-group">
			<label for="id_n">Ilość miesięcy </label>
			<input id="id_n" type="text" name="n" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->n;?>
" />
		</div>
		
		<div class="pure-control-group">
			<label for="id_p">Oprocentowanie </label>
			<input id="id_p" type="text" name="p" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->p;?>
" />
		</div>
		
		<div class="pure-controls">
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary"/>
		</div>
		
		
	</fieldset>
</form>	

<?php $_smarty_tpl->_subTemplateRender("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php if (isset($_smarty_tpl->tpl_vars['res']->value->result)) {?>
<div class="messages info">
	Wynik: <?php echo $_smarty_tpl->tpl_vars['res']->value->result;?>

</div>
<?php }?>

<?php
}
}
/* {/block 'content'} */
}

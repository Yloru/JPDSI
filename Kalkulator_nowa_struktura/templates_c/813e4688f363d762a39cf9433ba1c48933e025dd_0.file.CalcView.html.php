<?php
/* Smarty version 3.1.30, created on 2022-04-05 08:51:19
  from "C:\xampp\htdocs\Kalkulator_\app\views\CalcView.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_624be6e77d9877_43267274',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '813e4688f363d762a39cf9433ba1c48933e025dd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Kalkulator_\\app\\views\\CalcView.html',
      1 => 1649141427,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.html' => 1,
  ),
),false)) {
function content_624be6e77d9877_43267274 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1297826716624be6e77c94d0_05162831', 'footer');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_241667141624be6e77d9377_58533949', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'footer'} */
class Block_1297826716624be6e77c94d0_05162831 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Kalkulator kredytowy wykonany przez Jowitę Kruk PAW3.<?php
}
}
/* {/block 'footer'} */
/* {block 'content'} */
class Block_241667141624be6e77d9377_58533949 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<center>
<h3>Kalkulator kredytowy</h2>

<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
calcCompute" method="post">
	<fieldset>
			
			<label for="N">Kredyt</label>
			<input id="N" type="text" placeholder="wartość kredytu" name="N" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->N;?>
">

			<label for="n">Liczba miesięcy</label>
			<input id="n" type="text" placeholder="ilość miesięcy" name="n" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->n;?>
">
			
			<label for="p">Oprocentowanie</label>
			<input id="p" type="text" placeholder="wartość oprocentowania" name="p" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->p;?>
">
			
	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>

<div class="messages">


<?php if ($_smarty_tpl->tpl_vars['msgs']->value->isError()) {?>
	<h4>Wystąpiły błędy: </h4>
	<ol class="err">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getErrors(), 'err');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['err']->value) {
?>
	<li><?php echo $_smarty_tpl->tpl_vars['err']->value;?>
</li>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	</ol>
<?php }?>


<?php if ($_smarty_tpl->tpl_vars['msgs']->value->isInfo()) {?>
	<h4>Informacje: </h4>
	<ol class="inf">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getInfos(), 'inf');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['inf']->value) {
?>
	<li><?php echo $_smarty_tpl->tpl_vars['inf']->value;?>
</li>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	</ol>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['res']->value->result)) {?>
	<h4>Wynik</h4>
	<p class="res">
	<?php echo $_smarty_tpl->tpl_vars['res']->value->result;?>

	</p>
<?php }?>
</center>
</div>

<?php
}
}
/* {/block 'content'} */
}

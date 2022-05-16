<?php
/* Smarty version 3.1.30, created on 2022-05-16 19:05:43
  from "C:\xampp\htdocs\Kalkulator\app\views\CreditList.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6282846723db36_59645397',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f568d2a7a75c421172a22759773a07593887604' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Kalkulator\\app\\views\\CreditList.tpl',
      1 => 1652720489,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_6282846723db36_59645397 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_80721890962828467230417_21689433', 'top');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5563679416282846723d534_84669559', 'bottom');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_80721890962828467230417_21689433 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="bottom-margin">
<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
creditList">
	<legend>Opcje wyszukiwania</legend>
	<fieldset>
		<input type="text" placeholder="wartość kredytu" name="sf_credit" value="<?php echo $_smarty_tpl->tpl_vars['searchForm']->value->credit;?>
" /><br />
		<button type="submit" class="pure-button pure-button-primary">Filtruj</button>
	</fieldset>
</form>
</div>	

<?php
}
}
/* {/block 'top'} */
/* {block 'bottom'} */
class Block_5563679416282846723d534_84669559 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="bottom-margin">
<a class="pure-button button-success" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
creditNew"> Dodaj kredyt</a>
</div>	

<center>
<table id="tab_credit" class="pure-table pure-table-bordered">
<thead>
	<tr>
		<th>Kredyt</th>
		<th>Miesiące</th>
		<th>Oprocentowanie</th>
		<th>Wynik</th>
		<th>opcje</th>
	</tr>
</thead>
</center>
<tbody>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['credit']->value, 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
<tr><td><?php echo $_smarty_tpl->tpl_vars['c']->value["credit"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['c']->value["months"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['c']->value["interest"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['c']->value["resultCredit"];?>
</td><td><a class="button-small pure-button button-secondary" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
creditEdit&id=<?php echo $_smarty_tpl->tpl_vars['c']->value['idCredit'];?>
">Edytuj</a>&nbsp;<a class="button-small pure-button button-warning" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
creditDelete&id=<?php echo $_smarty_tpl->tpl_vars['c']->value['idCredit'];?>
">Usuń</a></td></tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</tbody>
</table>

<?php
}
}
/* {/block 'bottom'} */
}

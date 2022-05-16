{extends file="main.tpl"}

{block name=top}

<div class="bottom-margin">
<form class="pure-form pure-form-stacked" action="{$conf->action_url}creditList">
	<legend>Opcje wyszukiwania</legend>
	<fieldset>
		<input type="text" placeholder="wartość kredytu" name="sf_credit" value="{$searchForm->credit}" /><br />
		<button type="submit" class="pure-button pure-button-primary">Filtruj</button>
	</fieldset>
</form>
</div>	

{/block}

{block name=bottom}
<div class="bottom-margin">
<a class="pure-button button-success" href="{$conf->action_root}creditNew"> Dodaj kredyt</a>
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
{foreach $credit as $c}
{strip}
	<tr>
		<td>{$c["credit"]}</td>
		<td>{$c["months"]}</td>
		<td>{$c["interest"]}</td>
		<td>{$c["resultCredit"]}</td>
		<td>
			<a class="button-small pure-button button-secondary" href="{$conf->action_url}creditEdit&id={$c['idCredit']}">Edytuj</a>
			&nbsp;
			<a class="button-small pure-button button-warning" href="{$conf->action_url}creditDelete&id={$c['idCredit']}">Usuń</a>
		</td>
	</tr>
{/strip}
{/foreach}
</tbody>
</table>

{/block}

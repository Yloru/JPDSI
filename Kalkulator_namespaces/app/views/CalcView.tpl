{extends file="main.tpl"}
{* przy zdefiniowanych folderach nie trzeba już podawać pełnej ścieżki *}

{block name=footer}Kalkulator kredytowy wykonany przez Jowitę Kruk PAW3.{/block}

{block name=content}
<center>

<h3>Kalkulator kredytowy</h2>

<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">
	<fieldset>
	
		<label for="N">Kredyt</label>
		<input id="N" type="text" placeholder="wartość kredytu" name="N" value="{$form->N}">
		
		<label for="n">Liczba miesięcy</label>
		<input id="n" type="text" placeholder="ilość miesięcy" name="n" value="{$form->n}">
		
		<label for="p">Oprocentowanie</label>
		<input id="p" type="text" placeholder="wartość oprocentowania" name="p" value="{$form->p}">

	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>

<div class="messages">

{* wyświeltenie listy błędów, jeśli istnieją *}
{if $msgs->isError()}
	<h4>Wystąpiły błędy: </h4>
	<ol class="err">
	{foreach $msgs->getErrors() as $err}
	{strip}
		<li>{$err}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{* wyświeltenie listy informacji, jeśli istnieją *}
{if $msgs->isInfo()}
	<h4>Informacje: </h4>
	<ol class="inf">
	{foreach $msgs->getInfos() as $inf}
	{strip}
		<li>{$inf}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{if isset($res->result)}
	<h4>Wynik</h4>
	<p class="res">
	{$res->result}
	</p>
{/if}
</center>
</div>

{/block}
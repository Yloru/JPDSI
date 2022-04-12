{extends file="main.tpl"}

{block name=content}

<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="{$conf->action_url}logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: {$user->login}, rola: {$user->role}</span>
</div>

<form action="{$conf->action_url}calcCompute" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Kalkulator kredytowy</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_N">Kredyt </label>
			<input id="id_N" type="text" name="N" value="{$form->N}" />
		</div>

        <div class="pure-control-group">
			<label for="id_n">Ilość miesięcy </label>
			<input id="id_n" type="text" name="n" value="{$form->n}" />
		</div>
		
		<div class="pure-control-group">
			<label for="id_p">Oprocentowanie </label>
			<input id="id_p" type="text" name="p" value="{$form->p}" />
		</div>
		
		<div class="pure-controls">
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary"/>
		</div>
		
		
	</fieldset>
</form>	

{include file='messages.tpl'}

{if isset($res->result)}
<div class="messages info">
	Wynik: {$res->result}
</div>
{/if}

{/block}
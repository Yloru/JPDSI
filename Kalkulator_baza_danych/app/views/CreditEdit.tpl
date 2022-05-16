{extends file="main.tpl"}

{block name=top}

<div class="bottom-margin">
<form action="{$conf->action_root}creditSave" method="post" class="pure-form pure-form-aligned">
	<fieldset>
		<legend>Dane kredytu:</legend>
		<div class="pure-control-group">
            <label for="credit">Kredyt</label>
            <input id="credit" type="text" placeholder="kwota kredytu" name="credit" value="{$form->credit}">
        </div>
		<div class="pure-control-group">
            <label for="months">Liczba miesięcy</label>
            <input id="months" type="text" placeholder="liczba miesięcy" name="months" value="{$form->months}">
        </div>
		<div class="pure-control-group">
            <label for="birthdate">Oprocentowanie</label>
            <input id="interest" type="text" placeholder="wartość oprocentowania" name="interest" value="{$form->interest}">
        </div>
		<div class="pure-controls">
			<input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
			<a class="pure-button button-secondary" href="{$conf->action_root}creditList">Powrót</a>
		</div>
	</fieldset>
    <input type="hidden" name="id" value="{$form->id}">
</form>	
</div>

{/block}

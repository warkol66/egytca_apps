|-if $id eq ''-|
	|-assign var="id" value="autocompleter"-|
|-/if-|

<script type="text/javascript" language="javascript" charset="utf-8">
	var |-$id-|_instance;
</script>

<p>
	<label for="|-$id-|">|-$label-|</label>
	<input type="text" id="|-$id-|" name="autocomplete_parameter" value="|-$defaultValue-|" size="60"
		onChange="|-$onChange-|" 
		onBlur="|-$id-|_instance.unregister();" 
		onfocus="this.select(); 
			if (Object.isUndefined(|-$id-|_instance)) { 
				|-$id-|_instance = new MiniAutocompleter(
					'|-$id-|', 
					'|-$id-|_choices', 
					'|-$url-|', 
					{indicator: |-if $indicator ne ''-| '|-$indicator-|', |-else-| '|-$id-|_indicator', |-/if-||-if $afterUpdateElement ne ''-|afterUpdateElement: |-$afterUpdateElement-||-/if-||-if $options ne ''-|, |-$options-||-/if-|}, 
				function(){|-if $onComplete ne ''-||-$onComplete-||-/if-|} );
			} 
			|-$id-|_instance.register();" 
	/>		
	<span id="|-if $indicator ne ''-||-$indicator-||-else-||-$id-|_indicator|-/if-|" style="display: none">
		<img src="images/spinner.gif" alt="Procesando..." />
	</span>
|-if $buttonValue ne '' -|
	<input type="submit" id="|-$button_edit_sub_issue-|" title="|-$buttonValue-|" |-if !$enableOnEdit-|disabled |-/if-| value="|-$buttonValue-|"  style="display: inline;"/>
|-/if-|

</p>
<div id="|-$id-|_choices" class="autocomplete" style="display: none;"></div>

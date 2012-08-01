<div style="padding-top: 20px; padding-bottom: 20px;">
	<hr/>
	<h1 style="margin-top: 10px">BaseQuery Debug Info</h1>
	<div>
		<p>filters</p>
		<ul style="padding-left: 30px">|-foreach $debugInfo.filters as $filter-|
			<li>
				<p>method: |-$filter.name-|</p>
				<p style="|-if !$filter.params-|background-color: yellow;|-/if-|">params:
					<ul style="padding-left: 30px">|-foreach $filter.params as $param-|
						<li>
							|-if $param|is_array-|
								<p>array</p>
								<ul style="padding-left: 30px">|-foreach $param as $key => $value-|
									<li>|-$key-|: |-$value-|</li>
								|-/foreach-|</ul>
							|-else-|
								|-$param-|
							|-/if-|
						</li>
					|-/foreach-|</ul>
				</p>
				<p style="|-if !$filter.found-|background-color: red;|-/if-|">found: |-$filter.found|yes_no-|</p>
			</li>
		|-/foreach-|</ul>
	</div>
	<div>
		<p>sql</p>
		<p style="padding-left: 30px">|-$debugInfo.sql-|</p>
	</div>
	<hr/>
</div>
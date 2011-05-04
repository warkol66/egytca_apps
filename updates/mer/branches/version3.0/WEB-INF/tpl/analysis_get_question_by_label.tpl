<h2>Actor: |-$actor->getName()-|</h2>				

				|-assign var=answer value=$question->getAnswer($actor)-|
				<table width='100%' class='tablaborde' cellpadding='0' cellspacing='1' border='0'>
					<tr>
						<th colspan='2'> |-$question->getQuestion()-| </th>
					</tr>
					<tr>
						<td class='celldato' width='90%'>|-$answer-|</td>
					</tr>
				</table>

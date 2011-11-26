<?php

	$table=$currentID.'_Poll';
	$query="SELECT DISTINCT Question FROM `$table`";
	$result=mysql_query($query) or die($query);
	
	if(mysql_num_rows($result)>0)
	{
	while ($poll = mysql_fetch_assoc($result)) {
	
		$curPoll=$poll['Question'];
		
		echo '	<section>
				<div class="summary">';
				
		echo "<h2>$curPoll</h2>";
		echo '</div>
			<form>
				<ul class="poll">';
		
		$query="SELECT * FROM `$table` WHERE Question='$curPoll'";
		$result2=mysql_query($query) or die($query);
		while ($currentPoll = mysql_fetch_assoc($result2)) {
		$randomN=rand ( 15 , 85 );
		
			$response=$currentPoll['Response'];
			echo "<li>
				<span class='percentage' style='width:".$randomN."%'></span>
				<span class='checkbox'></span>	
				$response</li>";

		}
		
		echo "	<input placeholder='Add item' class='new_item' type='text' onblur='add(event)' onkeypress='catch_submit(event, \"poll\", \"$curPoll\", \"$currentID\")' >
				</ul>
			</form>

		</section>";
	}
	

	
	}
?>
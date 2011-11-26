<?php

	$table=$currentID.'_List';
	$query="SELECT DISTINCT List FROM `$table`";
	$result=mysql_query($query) or die($query);
	
	if(mysql_num_rows($result)>0)
	{
	while ($list = mysql_fetch_assoc($result)) {
	
		$curList=$list['List'];
		
		echo '<section>
			<div class="summary">';
				
		echo "<h2>$curList</h2>";
		echo '<a class="button">Clear Completed</a>
		</div>
		<form>
			<ul class="checklist">';
		
		$query="SELECT * FROM `$table` WHERE List='$curList'";
		$result2=mysql_query($query) or die($query);
		while ($currentList = mysql_fetch_assoc($result2)) {
		
			$curID=$currentList['ID'];
			$item=$currentList['Item'];
			$status=$currentList['Status'];

			
			if($status==false)	
				echo "<li><span class='checkbox'></span>";
			else 
				echo "<li class='selected'><span class='checkbox'></span>";

			echo $item;
				
			echo "</li>";
									
		}
		
		echo "	<input placeholder='Add item' class='new_item' type='text' onkeypress='return catch_submit(event, \"list\", \"$curList\", \"$currentID\")' >
				</ul>
			</form>

			</section>";
			
			
	}
	

		
	}
	
?>



	
	
	
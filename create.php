
<!DOCTYPE html>
<html>
<?php include 'authenticate.php'; ?>
<?php include 'database/connect.php'; ?>
<?php include 'snippets/header.php'; ?>

<body onload="loadjs(); return false;">
	<aside>
		<ul class="projects">
		<?php
			$selected=$_GET['selectedEvent'];
			
			
			
			foreach($groupID as $currentGroup)
			{
				$query="SELECT * FROM `events` WHERE `Group` =$currentGroup";
				$result=mysql_query($query) or die('fuck off');
				
				
				
				while ($event = mysql_fetch_assoc($result)) {
				    
					$sevent=$event["ID"];
					echo "<a href='event.php?selectedEvent=$sevent'>";
					if($selected==$sevent||$sevent=="")
					{
						echo "<li class='selected'>";
						
						$currentID=$event['ID'];
						$currentTitle=$event['Title'];
						$currentDescription=$event['Description'];
						
					}
					else
						echo "<li>";
					
					echo $event['Title'];
					echo "</li></a>";

				}
				
			}
			
		?>
		<a href="create.php"><li class='selected'>+ Create</li></a>
		</ul>
	</aside>
	<div id="main">
		
	
	<form method="POST" action="database/create_event.php">
		<section>
			<h1>What are you organizing?</h1>
			<input id="new_event_name" type="text" class="focus" name="name" placeholder="Group/Event/Excursion Name">
			<input id="new_event_desc" type="text" name="description" placeholder="Short Description">
			<br />
			
			<input type="submit" value="Create" class="btn">
		</section>
		<section>
			<p>Just hit that nice big "Create" button.</p>
		</section>
	</form>
		

		
		<!--
		<section>
			<div class="summary">
				<h2>When</h2>
			</div>
			<form>
				<ul class="poll">
					<li>
						<span class="percentage" style="width:15%"></span>
						<span class="checkbox"></span>	
						Sunday 4pm</li>
					<li class="selected">
						<span class="percentage" style="width:60%"></span>
						<span class="checkbox"></span>	
						Sunday 5pm</li>
					<li>
						<span class="percentage" style="width:25%"></span>
						<span class="checkbox"></span>	
						Sunday 6pm</li>
					<input placeholder="Add item" class="new_item" type="text" onblur="add(event)" onkeypress="return catch_submit(event)" >
				</ul>
			</form>
			
		</section>
		<section>
			<div class="summary">
				<h2>Where</h2>
			</div>
			<form>
				<ul>
					<li>
						<span class="percentage" style="width:100%"></span>
						<span class="checkbox"></span>Gates 4405</li>
					<input placeholder="Add item" class="new_item" type="text" onkeypress="return catch_submit(event)" >
				</ul>
			</form>
			
		</section>
		<section>
			<div class="summary">
				<h2>Agenda</h2>
				<a class="button">Clear Completed</a>
			</div>
			<form>
				<ul class="checklist">
					<li class="selected"><span class="checkbox"></span>Choose team members</li>
					<li class="selected"><span class="checkbox"></span>Develop Concept</li>
					<li><span class="checkbox"></span>Purchase Domain</li>
					<li class="selected"><span class="checkbox"></span>Build Framework</li>
					<li><span class="checkbox"></span>Demo at Hackathon </li>
					<input placeholder="Add item" class="new_item" type="text" onkeypress="return catch_submit(event)" >
				</ul>
			</form>
			
		</section>
	
	</div>
</body>
</html>

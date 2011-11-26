<!DOCTYPE html>
<html>
<?php include 'authenticate.php'; ?>
<?php include 'database/connect.php'; ?>
<?php include 'snippets/header.php'; ?>

<body onload="loadjs(); return false;">
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) {return;}
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=268479829846423";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	

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
					if($selected==$sevent||$selected=="")
					{	
						$selected=$sevent;
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
		<a href="create.php"><li>+ Create</li></a>
		</ul>
	</aside>
	<div id="main">
	
		<header>
			<h1> <?php echo "$currentTitle"; ?> </h1><br	/>
			<script>
				document.title = "<?php echo "$currentTitle"; ?>"
			</script>
			<p>		
				<?php echo "$currentDescription"; ?>	
			</p>
		</header>
		
			<div class="share">

		<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-via="collabout">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>

			</div>
			
			
	<?php	include 'snippets/polls.php';	?>
	<?php 	include 'snippets/lists.php';	?>


	<section>
		<a class="button" onclick="newpoll(event, '<?php echo $currentID; ?>')">New Poll</a>
		<a class="button" onclick="newlist(event, '<?php echo $currentID; ?>')">New List</a>
	</section>
	
	<!--
	
	href="api/new_poll.php?eventid=<?php echo $currentID;?>
	
	href="api/new_list.php?eventid=<?php echo $currentID; ?>
	--!>
	
		<!--
		<section>
			<h1>What are you organizing?</h1>
			<input id="new_event_name" type="text" class="focus" placeholder="Group/Event/Excursion Name">
			<input id="new_event_desc" type="text" placeholder="Short Description">
			<br />
			<a class="button" onclick="create_event(event)">Create</a>
		</section>
		<section>
			<p>Just hit that nice big "Create" button.</p>
		</section>
		--!>

		
		<!--
			
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
		-->
		<!--
		<section>
			<a class="button" onclick="newpoll(event)">New Poll</a>
			<a class="button" onclick="newlist(event)">New List</a>
		</section>
		-->
		<!--
		<section>
		<div id="fb-root"></div>
		
		<div class="fb-comments" data-href="example.com" data-num-posts="3" data-width="300"></div>
		</section>
		-->
	</div>
</body>
</html>

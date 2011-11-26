/* FB API */
/*
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=295412153817389";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

*/


function loadcheckboxes(){
	var checkboxes = document.getElementsByClassName('checkbox');
	for(var i = 0; i<checkboxes.length; i++){
		var classname = checkboxes[i].parentNode.getAttribute('class');
		if (classname==null){classname='';}
		checkboxes[i].parentNode.setAttribute('class', 'selectable ' + classname );
		checkboxes[i].parentNode.setAttribute('onclick','toggle_selected(event)');
	}
	
}

//Finds y value of given object
function findPos(obj) {
	var curtop = 0;
	if (obj.offsetParent) {
		do {
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);
	return [curtop];
	}
}


function loadjs(){
	loadcheckboxes();
	
	window.scroll(0,findPos(document.getElementById('main')));
	
}

function toggle_selected (event)
{
	var element = event.currentTarget;
	/* Toggle the setting of the classname attribute */
	element.className = (element.className == 'selectable ') ? 'selectable selected' : 'selectable ';
}

function add(event){
	var element = event.currentTarget;
	var option = element.value;
			
	if (option!=null && option!=''){
		
		var newoption = document.createElement("li");
		if (element.parentNode.getAttribute('class')=='checklist'){
			newoption.setAttribute('class', 'selectable');
		}else {
			newoption.setAttribute('class', 'selectable selected');
		}
		newoption.innerHTML = "<span class='percentage' style='width:0%'></span><span class='checkbox'></span>" + option;
		newoption.setAttribute('onclick','toggle_selected(event)');
	
		element.value = '';
		element.parentNode.insertBefore(newoption,element);
	}
}

function catch_submit(event, type, ListName, eID){
	var code = '';
	
	if (event.which) 
	code = event.which;
	else if (event.keyCode)
	code = event.keyCode;

	if (code == 13){
		
		var element = event.currentTarget;
		
		jQuery.ajax('http://collabout.icanberk.com/api/new_item.php?t='+type+'&listname='+ListName+'&val='+element.value+'&eventid='+eID);
		
		add(event);
		return false;
	}
	return true;
}

function catch_submitNew(event, type, eventID, question){
	
	
	var code = '';
	
	if (event.which) 
	code = event.which;
	else if (event.keyCode)
	code = event.keyCode;

	if (code == 13){
	
		var element = event.currentTarget;
		
		jQuery.ajax('http://collabout.icanberk.com/api/new_list.php?t='+type+'&listname='+question+'&firstval='+element.value+'&eventid='+eventID);
		
		add(event);
		return false;
	}
	return true;
}


function catch_create(event, type, eventID){
		
	var code = '';
		
	if (event.which) 
	code = event.which;
	else if (event.keyCode)
	code = event.keyCode;

	if (code == 13){
		var element = event.currentTarget;
		var innerHTML;
		innerHTML = "<div class='summary'><h2>" + element.value + "</h2>";
		if (type=="checklist"){
			innerHTML += "<a class='button'>Clear Completed</a>";
		}
		innerHTML += "</div><form>";
		innerHTML +="<ul class='" + type + "'>";
				
		innerHTML +="<input placeholder='Add item' class='new_item' type='text' onkeypress='return catch_submitNew(event,\""+type+"\",\""+ eventID + "\",\""+element.value+"\")' ></ul></form>";
		element.parentNode.innerHTML = innerHTML;
		return false;
	}
	return true;
}

function newpoll(event, listID){
	var element = event.currentTarget;
	var newsection = document.createElement("section");
	newsection.innerHTML = "<input type='text' class='focus' onkeypress='return catch_create(event, \"poll\",\""+ listID +"\")' placeholder='Poll Name.  Example: when?'>";
	element.parentNode.parentNode.insertBefore(newsection,element.parentNode);
}
function newlist(event, listID){
	var element = event.currentTarget;
	var newsection = document.createElement("section");
	newsection.innerHTML = "<input type='text' class='focus' onkeypress='return catch_create(event, \"checklist\",\""+ listID +"\")' placeholder='List Name.  Example: Reminders'>";
	element.parentNode.parentNode.insertBefore(newsection,element.parentNode);
}

function create_event(event){
	var element = event.currentTarget;
	var event_name = document.getElementById('new_event_name').value;
	var event_desc = document.getElementById('new_event_desc').value;
	
	var innerHTML = "<header><h1>" + event_name + "</h1><br \><p>" + event_desc + "</p></header>";
	innerHTML += "<section><a class='button' onclick='newpoll(event)'\>New Poll</a><a class='button' onclick='newlist(event)'>New List</a></section>"
	innerHTML += "<section><p><strong>Welcome!</strong></p><p>1.  Share a link to this page.</p><p>2. Create <strong>Polls</strong> to ask questions, such as 'when should we eat?'</p><p>3. Make <strong>Lists</strong> to track to-do's and projects</p></section>"
	
	element.parentNode.parentNode.innerHTML = innerHTML;
	window.scroll(0,findPos(document.getElementById('main')));
}
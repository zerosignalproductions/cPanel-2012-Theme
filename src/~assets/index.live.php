var softOffsets = function(e){
	e = e || window.event;
	 
	var
	//cache document variables
	_d = document, _dBody = _d.body, _dDocEl = _d.documentElement, _o = null,
	 
	//calculate scroll values
	_scroll_left = _dDocEl.scrollLeft ? _dDocEl.scrollLeft : 0 + _dBody.scrollLeft ? _dBody.scrollLeft : 0,
	_scroll_top = _dDocEl.scrollTop ? _dDocEl.scrollTop : 0 + _dBody.scrollTop ? _dBody.scrollTop : 0,
	 
	
	window_pos = {
	_x: (e.pageX || e.clientX) + _scroll_left, _y: (e.pageY || e.clientY) + _scroll_top
	},
	 
	
	viewport_pos = {
	_x: (e.pageX || e.clientX), _y: (e.pageY || e.clientY)
	},
	 
	
	_console = function(o, type) {
	o = (typeof o === "object") ? o : _d.getElementById(o);
	o.innerHTML = type + " = [ " +
	" X: " + ((type === "viewport") ? viewport_pos._x : window_pos._x) +
	" Y: " + ((type === "viewport") ? viewport_pos._y : window_pos._y) +
	" ] Foo: " + Math.random()
	};
	 
	return {
	ViewPortX: viewport_pos._x,
	ViewPortY: viewport_pos._y,
	 
	WindowX: window_pos._x,
	WindowY: window_pos._y,
	 
	ViewPort: [viewport_pos._x, viewport_pos._y],
	Window: [window_pos._x, window_pos._y],
	 
	ToString: _console
	};
};

//Finds the position of the element
function findelpos(ele){
	var curleft = 0;
	var curtop = 0;
	if(ele.offsetParent){
		while(1){
			curleft += ele.offsetLeft;
			curtop += ele.offsetTop;
			if(!ele.offsetParent){
				break;
			}
			ele = ele.offsetParent;
		}
	}else if(ele.x){
		curleft += ele.x;
		curtop += ele.y;
	}
	return [curleft,curtop];
};

function mousemove(id, e){

	if(typeof softac[id+"left"] == "undefined"){
		softac[id+"right"] = "";
		softac[id+"left"] = "";
		softac[id+"entered"] = false;
	}
	
	if(softac[id+"entered"] == true){
		return false;
	}
	
	softac[id+"entered"] = true;
	
	var ele = document.getElementById(id);
	var mouse = softOffsets(e);
	mouse[0] = mouse.ViewPortX;	
	softac[id+"elpos"] = findelpos(ele);	
	softac[id+"menuwidth"] = ele.offsetWidth;	
	softac[id+"leftbound"] =((softac[id+"menuwidth"]-20)/2) + softac[id+"elpos"][0];
	softac[id+"rightbound"] =((softac[id+"menuwidth"]+20)/2) + softac[id+"elpos"][0];
	
	//alert(softac[id+"leftbound"]+" "+softac[id+"rightbound"]+" "+mouse[0]);	
	//document.getElementById("aaa").innerHTML = mouse[0]+"<br />"+document.getElementById("aaa").innerHTML;
	
	if (mouse[0]>softac[id+"rightbound"]){
		softLeft(id);
	}else if (mouse[0]<softac[id+"leftbound"]){
		softRight(id);
	}else{
		softstop(id, e);
	}
}
	
var softac = new Object();

function softLeft(id){
	clearTimeout(softac[id+"right"]);
	document.getElementById(id).scrollLeft += 1;
	softac[id+"right"] = setTimeout("softLeft('"+id+"')",10);
};

function softRight(id){	
	clearTimeout(softac[id+"left"]);
	document.getElementById(id).scrollLeft -= 1;//alert(document.getElementById(id).scrollLeft);return;
	softac[id+"left"] = setTimeout("softRight('"+id+"')",10);
};

function softstop(id, e){	
	clearTimeout(softac[id+"right"]); 
	clearTimeout(softac[id+"left"]);
	softac[id+"entered"] = false;
};var soft_html = ''+"\n"+''+"\n"+'<style type="text/css">'+"\n"+''+"\n"+'#soft_div1{'+"\n"+'font-size: 11px;'+"\n"+'padding: 0px;'+"\n"+'width:500px;'+"\n"+'font-family: Verdana, Tahoma, Arial, "Trebuchet MS", "Times New Roman", Georgia, sans-serif, serif;'+"\n"+'}'+"\n"+''+"\n"+'.softac_cat {'+"\n"+'  vertical-align:middle;padding:5px;text-align:left;background-color: #DDD;'+"\n"+'}'+"\n"+''+"\n"+'   '+"\n"+'</style><div class="softac_cat" style="vertical-align:middle;padding:5px;text-align:left;background-color: #EEE;width:495px;"><b>Scripts:</b></div><div style="overflow:hidden;display: block;width:500px;" id="script_div" onmouseover="mousemove(this.id, event);" onmouseout="softstop(this.id, event);">'+"\n"+'		<table border="0" cellpadding="7" cellspacing="0" id="script_table"><tr><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=26" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/26__logo.gif" border="0" /><br />WordPress</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=18" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/18__logo.gif" border="0" /><br />Joomla 2.5</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=70" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/70__logo.gif" border="0" /><br />OpenCart</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=72" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/72__logo.gif" border="0" /><br />PrestaShop</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=30" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/30__logo.gif" border="0" /><br />Drupal</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=2" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/2__logo.gif" border="0" /><br />phpBB</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=79" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/79__logo.gif" border="0" /><br />SMF</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=36" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/36__logo.gif" border="0" /><br />MyBB</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=144" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/144__logo.gif" border="0" /><br />WHMCS</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=67" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/67__logo.gif" border="0" /><br />Magento</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=413" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/413__logo.gif" border="0" /><br />Joomla</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=121" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/121__logo.gif" border="0" /><br />Dolphin</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=389" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/389__logo.gif" border="0" /><br />AbanteCart</a></td><td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=software&soft=98" style="text-decoration:none;"><img src="https://www.softaculous.com/images/softimages/32/98__logo.gif" border="0" /><br />Moodle</a></td></tr></table></div><div class="softac_cat" style="vertical-align:middle;padding:5px;text-align:left;background-color: #EEE;width:495px;"><b>Categories :</b></div> '+"\n"+'		<div style="overflow:hidden;display: block;width:500px;" id="softcat_div" onmouseover="mousemove(this.id, event);" onmouseout="softstop(this.id, event);">'+"\n"+'		<table border="0" cellpadding="7" cellspacing="0"><tr> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=blogs" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_blogs.gif" title="PHP BLOGS" border="0" ><br />Blogs</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=microblogs" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_microblogs.gif" title="PHP MICROBLOGS" border="0" ><br />Micro Blogs</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=cms" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_cms.gif" title="PHP CMS" border="0" ><br />Portals/CMS</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=forums" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_forums.gif" title="PHP FORUMS" border="0" ><br />Forums</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=galleries" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_galleries.gif" title="PHP GALLERIES" border="0" ><br />Image Galleries</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=wikis" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_wikis.gif" title="PHP WIKIS" border="0" ><br />Wikis</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=socialnetworking" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_socialnetworking.gif" title="PHP SOCIALNETWORKING" border="0" ><br />Social Networking</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=admanager" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_admanager.gif" title="PHP ADMANAGER" border="0" ><br />Ad Management</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=calendars" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_calendars.gif" title="PHP CALENDARS" border="0" ><br />Calendars</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=games" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_games.gif" title="PHP GAMES" border="0" ><br />Gaming</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=mail" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_mail.gif" title="PHP MAIL" border="0" ><br />Mails</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=polls" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_polls.gif" title="PHP POLLS" border="0" ><br />Polls and Surveys</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=projectman" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_projectman.gif" title="PHP PROJECTMAN" border="0" ><br />Project Management</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=ecommerce" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_ecommerce.gif" title="PHP ECOMMERCE" border="0" ><br />E-Commerce</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=erp" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_erp.gif" title="PHP ERP" border="0" ><br />ERP</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=guestbooks" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_guestbooks.gif" title="PHP GUESTBOOKS" border="0" ><br />Guest Books</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=customersupport" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_customersupport.gif" title="PHP CUSTOMERSUPPORT" border="0" ><br />Customer Support</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=frameworks" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_frameworks.gif" title="PHP FRAMEWORKS" border="0" ><br />Frameworks</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=educational" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_educational.gif" title="PHP EDUCATIONAL" border="0" ><br />Educational</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=dbtools" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_dbtools.gif" title="PHP DBTOOLS" border="0" ><br />DB Tools</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=music" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_music.gif" title="PHP MUSIC" border="0" ><br />Music</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=video" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_video.gif" title="PHP VIDEO" border="0" ><br />Video</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=rss" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_rss.gif" title="PHP RSS" border="0" ><br />RSS</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=files" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_files.gif" title="PHP FILES" border="0" ><br />File Management</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=others" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/php_others.gif" title="PHP OTHERS" border="0" ><br />Others</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=libraries" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/js_libraries.gif" title="JS LIBRARIES" border="0" ><br />Libraries</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=widgets" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/js_widgets.gif" title="JS WIDGETS" border="0" ><br />Widgets</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=blogs" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/perl_blogs.gif" title="PERL BLOGS" border="0" ><br />Blogs</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=forums" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/perl_forums.gif" title="PERL FORUMS" border="0" ><br />Forums</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=wikis" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/perl_wikis.gif" title="PERL WIKIS" border="0" ><br />Wikis</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=ecommerce" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/perl_ecommerce.gif" title="PERL ECOMMERCE" border="0" ><br />E-Commerce</a></td> <td width="60" valign="top" align="center"><a href="softaculous/index.live.php?act=listsoftwares&cat=mail" style="text-decoration:none;" class="desc"><img src="softaculous/themes/default/images/cats/perl_mail.gif" title="PERL MAIL" border="0" ><br />Mails</a></td></tr></table></div>';
document.getElementById("soft_div-body").innerHTML = soft_html;
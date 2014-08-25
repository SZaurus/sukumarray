<?php
	require_once('sr.inc.php');
	
	function sanitize_output($buffer) {
		$search = array(
			'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
			'/[^\S ]+\</s',  // strip whitespaces before tags, except space
			'/(\s)+/s'       // shorten multiple whitespace sequences
		);
		$replace = array(
			'>',
			'<',
			'\\1'
		);
	
		$buffer = preg_replace($search, $replace, $buffer);
		return $buffer;
	}

	function doesArticleExist($cat_id,$article_id){
		global $db;
		
		$bind = array(":cat_id"=>$cat_id, ":article_id"=>$article_id);
		$res = $db->select("articles","cat_id=:cat_id AND article_id=:article_id",$bind);
		
		return (count($res) > 0);
	}
	
	function get_article_content($cat_id, $article_id, $print=0){
		global $db;
		
		$bind = array(":cat_id"=>$cat_id, ":article_id"=>$article_id);
		
		$res = $db->select("articles","cat_id=:cat_id AND article_id=:article_id",$bind);
		
		$retString = "";
		
		if(!empty($res)){
			setcookie("last_read_article",$article_id,time()+30*24*60*60);
			$row = $res[0];
			$retString = "<img src='" . $row['top_image'] . "'><br />";
			
			if($row['audio'] == '' || $print == 1)
				$retString .= "<div id='header_div'><h1>" . $row['title'] . "</h1><div id='toolbar1'></div></div>";
			else{
				$retString .= "<div id='header_div'><h1>" . $row['title'] ."</h1>";
				$retString .= "<iframe width='300' height='24' src='http://www.youtube.com/embed/" . $row['audio'] . "?theme=light&showinfo=0&rel=0&color=red&modestbranding=1&autohide=0&#8243' frameborder='0' style='margin-left: 50px;' allowfullscreen='false'></iframe><div id='toolbar1'></div></div>";
			}
			$retString .= $row['body'];
			//updateArticleReadCount($article_id);
			$read_count = "<div id='read_count'>এই লেখাটি <span class='count' id='view_count'></span> বার পড়া  হয়েছে</div>";
			return "<div id='article_content'>" . $retString . $read_count . "</div>";
		}
		
		return "";
	}
	

	function get_category_menu($cat_id){
		global $db;
		
		$bind = array(":cat_id"=>$cat_id);
		$res2 = $db->select("categories","cat_id=:cat_id",$bind);
		$row = $res2[0];
		$category = $row['cat_desc'];
		
		$res = $db->run("SELECT article_id, cat_id, title, first_line,audio FROM articles WHERE cat_id=$cat_id ORDER BY title");
		
		if(empty($res))
			return "";
		else{
			//$last_read_article = ($_COOKIE['last_read_article'] != '') ? intval($_COOKIE['last_read_article']) : -1;
			$headerString = "<div id='cat_header_div'><h1>" . $category . "</h1><div id='toolbar1'></div></div>";
			$retString = "<ol class='multicolumn' id='five'>";
			foreach($res as $row){
				$audio_class = $row['audio'] == '' ? '' : "with_audio";
				//if($last_read_article == $row['article_id'])
				//	$retString .= "<li title='" . addslashes($row['first_line']) . "'><a class='last_read_article $audio_class' href='view.php?cat_id=$cat_id&article_id=" . $row['article_id'] . "'>" . $row['title'] . "</a></li>";
				//else
				$retString .= "<li title='" . addslashes($row['first_line']) . "'><a id='article_title_" . $row['article_id'] . "' href='view.php?cat_id=$cat_id&article_id=" . $row['article_id'] . "' class='$audio_class'>" . $row['title'] . "</a></li>";
			}
			$retString .= "</ol>";
		}
		
		if($cat_id == 1){
			$res = $db->run("SELECT article_id, cat_id, first_line,audio FROM articles WHERE cat_id=$cat_id ORDER BY first_line");
			if(empty($res))
				return "";
			else{
				$retString = "<div id='indextab'><span class='active' id='shironam'>শিরোনাম</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='prothomchhatra'>প্রথম ছত্রের সূচী</span></div><div id='shironam_div'>" . $retString . "</div>";
				$retString .= "<div id='prothomchhatra_div' class='invisible'><ol class='multicolumn' id='triple'>";
				foreach($res as $row){
					$audio_class = $row['audio'] == '' ? '' : "with_audio";
					$pieces = explode(" ", $row['first_line']);
					if(count($pieces) > 5)
						$first_part = implode(" ", array_splice($pieces, 0, 5)) . "...";
					elseif(count($pieces) == 5)
						$first_part = implode(" ", array_splice($pieces, 0, 5));
					else
						$first_part = implode(" ", array_splice($pieces, 0, count($pieces)));
					
					//if($last_read_article == $row['article_id'])
					//	$retString .= "<li><a href='view.php?cat_id=$cat_id&article_id=" . $row['article_id'] . "' class='last_read_article $audio_class'>" . $first_part . "</a></li>";
					//else
					$retString .= "<li><a id='first_line_" . $row['article_id'] . "' href='view.php?cat_id=$cat_id&article_id=" . $row['article_id'] . "' class='$audio_class'>" . $first_part . "</a></li>";
					
				}
				$retString .= "</ol></div>";
			}	
		}
		
		return $headerString . $retString . "<input type='hidden' name='lra' id='lra' value='" . $_COOKIE['last_read_article'] . "'>";
	}
	
	function get_category_title($cat_id){
		global $db;
		
		$bind = array(":cat_id"=>$cat_id);
		
		$res = $db->select("categories","cat_id=:cat_id",$bind);
		
		if(empty($res))
			return "";
		else{
			$row = $res[0];
			return $row['cat_desc'];
		}
	}
	
	function get_item_title($cat_id, $article_id){
		global $db;
		
		$bind = array(":cat_id"=>$cat_id, ":article_id"=>$article_id);
		
		$res = $db->select("articles","cat_id=:cat_id AND article_id=:article_id",$bind);
		
		if(empty($res))
			return "";
		else{
			$row = $res[0];
			return $row['title'];
		}
	}
	
	function create_breadcrumb($cat_id, $article_id){
		global $db;
		if($cat_id == 0)
			echo "";
		else{
			$retString = "<ul class='breadcrumb2'>";
			$retString .= "<li><a href='http://sukumarray.freehostia.com/'><img src='images/home.png' id='homeicon' alt='বিষয় সূচী'></a></li>";
			$cat_title = get_category_title($cat_id);
			if($cat_title != ""){
				if($article_id > 0){
					$item_title = get_item_title($cat_id,$article_id);
					if($item_title != ""){
						$retString .= "<li><a href='view.php?cat_id=" . $_GET['cat_id'] . "'>$cat_title</a></li>";
						$retString .= "<li>$item_title</li>";
					}
					else
						$retString .= "<li>$cat_title</li>";
				}
				else
					$retString .= "<li>$cat_title</li>";
				$retString .= "</ul>";
				return $retString;
			}
			else
				return "";
		}
	}

	function create_breadcrumb3($cat_id, $article_id){
		global $db;
		if($cat_id == 0)
			echo "";
		else{
			$retString = "<ul id='breadcrumbs3'>";
			$retString .= "<li><a href='http://sukumarray.freehostia.com/'><img src='images/home.png' id='homeicon' alt='বিষয় সূচী'></a></li>";
			$cat_title = get_category_title($cat_id);
			if($cat_title != ""){
				if($article_id > 0){
					$item_title = get_item_title($cat_id,$article_id);
					if($item_title != ""){
						$retString .= "<li><a href='view.php?cat_id=" . $_GET['cat_id'] . "'>$cat_title</a></li>";
						$retString .= "<li>$item_title</li>";
					}
					else
						$retString .= "<li>$cat_title</li>";
				}
				else
					$retString .= "<li>$cat_title</li>";
				$retString .= "</ul>";
				return $retString;
			}
			else
				return "";
		}
	}
	
	function make_bangla_number( $str ) {
		$engNumber = array(1,2,3,4,5,6,7,8,9,0);
	    $bangNumber = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
		$converted = str_replace($engNumber, $bangNumber, $str);
		
		return $converted;
	}
	
	function updateArticleReadCount($article_id){
		global $db;
		
		$db->run("update articles set views = views + 1 where article_id=$article_id");
	}
	
	function videoID($article_id){
		global $db;
		$bind = array(":article_id"=>$article_id);
		$res = $db->select("articles","article_id = :article_id",$bind, "audio");
		$row = $res[0];
		return $row['audio'];
	}
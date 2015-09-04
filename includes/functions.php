<?php 

	function redirect_to($location = NULL) {
		header("Location: {$location}");
		exit;
	}



	function include_layout_template($template) {
		return include(SITE_ROOT.DS."public".DS."layouts".DS.$template.".php");
	}


	function selected_page() {
		global $current_subject;
		global $current_page;

		if(isset($_GET['subject'])){
			$current_subject = Subject::find_by_id($_GET['subject']);
			$current_page = null;
		}elseif(isset($_GET['page'])){
			$current_page =  Page::find_by_id($_GET['page']);
			$current_subject = null;
		}else{
			$current_subject = null;
			$current_page = null;
		}
	}


	function __autoload($class_name) {
		$class_name = strtolower($class_name);
		$path = LIB_PATH.DS.$class_name.".php";

		if(file_exists($path)) {
			require_once $path;
		}else{
			die("The file {$class_name} cound not be found");
		}
	}


	function navigation($current_subject, $current_page){

		$output = "<ul class = \"subjects\">";
	
			$subject_set = Subject::find_all();

			foreach($subject_set as $subject) :
			
				$output .= "<a href=\"";
				$output .=  basename($_SERVER['PHP_SELF']);
				$output .= "?subject=";
				$output .= urlencode($subject->id);
				$output .= "\">";
					
				$output .= "<li";		
				if($current_subject && $subject->id == $current_subject->id) {
					$output .= " class=\"selected\"";
				}
				$output .= ">";
				$output .= $subject->menu_name . "</a>";

				$output .= "<ul class = \"pages\">";
					$page_set = $subject->pages();
						foreach($page_set as $page) :
							$output .= "<a href=\"";
							$output .= basename($_SERVER['PHP_SELF']);
							$output .= "?page=";
							$output .= urlencode($page->id);
							$output .= "\">";
							$output .= "<li";
							if($current_page && $page->id == $current_page->id) {
								$output .= " class=\"selected\"";
							 }
							$output .= ">";
							$output .= $page->menu_name . "</li></a>";
						endforeach;	
				unset($page_set);
				$output .= "</ul></li>"; 
			endforeach;
		unset($subject_set);
		$output .= "</ul>"; 

	return $output;

	}

function public_navigation($current_subject, $current_page){

		$output = "<ul class = \"subjects\">";
	
			$subject_set = Subject::find_all();

			foreach($subject_set as $subject) :
				$output .= "<a href=\"";
				$output .=  basename($_SERVER['PHP_SELF']);
				$output .= "?subject=";
				$output .= urlencode($subject->id);
				$output .= "\">";
					
				$output .= "<li";		
					if($current_subject && $subject->id == $current_subject->id) {
						$output .= " class=\"selected\"";
					}
					$output .= ">";
					$output .= $subject->menu_name . "</a>";

					/*List pages for subject*/
					// if($current_subject->id == $subject->id || $current_page->subject_id == $subject->id) {
						$page_set = $subject->pages();
						$output .= "<ul class = \"pages\">";
						foreach($page_set as $page) :
							$output .= "<a href=\"";
							$output .= basename($_SERVER['PHP_SELF']);
							$output .= "?page=";
							$output .= urlencode($page->id);
							$output .= "\">";
							$output .= "<li";
							if($current_page && $page->id == $current_page->id) {
								$output .= " class=\"selected\"";
							 }
							$output .= ">";
							$output .= $page->menu_name;
							$output .= "</li>"; // end of the pages li
							$output .= "</a>";
						endforeach;	
						$output .= "</ul>"; // end of the oages ul
					// } 
				$output .= "</li>"; // end of the subject li
				unset($page_set);
				 
			endforeach;
		unset($subject_set);
		$output .= "</ul>"; 

	return $output;

	}

?>
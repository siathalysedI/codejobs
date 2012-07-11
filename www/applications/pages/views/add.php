<?php 
	if(!defined("_access")) { 
		die("Error: You don't have permission to access here..."); 
	} 
	
	if(isset($data)) {
		$ID  	   = recoverPOST("ID", 	      $data[0]["ID_Page"]);
		$title     = recoverPOST("title",     $data[0]["Title"]); 
		$content   = recoverPOST("content",   $data[0]["Content"]);
		$situation = recoverPOST("situation", $data[0]["Situation"]);
		$principal = recoverPOST("principal", $data[0]["Principal"]);
		$language  = recoverPOST("language",  $data[0]["Language"]);
		$edit      = TRUE;
		$action    = "edit";
		$href	   = path(whichApplication() . _sh . "cpanel" . _sh . $action . _sh . $ID . _sh);
	} else {
		$ID        = 0;
		$title     = recoverPOST("title");
		$content   = recoverPOST("content");
		$situation = recoverPOST("situation");
		$principal = recoverPOST("principal");
		$language  = recoverPOST("language");
		$edit      = FALSE;
		$action	   = "save";
		$href 	   = path(whichApplication() . _sh . "cpanel" . _sh . "add" . _sh);
	}

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(
				"type" 	=> "text", 
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __(_("Title")), 
				"p" 	=> TRUE, 
				"value" => $title)
			);

			echo formTextarea(array(
				"id" 	=> "editor", 
				"name" 	=> "content", 
				"class" => "span10",
				"style" => "height: 400px;", 
				"field" => __(_("Content")), 
				"p" 	=> TRUE, 
				"value" => $content)
			);

			echo formField(NULL, __("Languages") ."<br />". getLanguagesInput($language));
			
			$options = array(
				0 => array(
						"value"    => 1,
						"option"   => __("Yes"),
						"selected" => ((int) $principal === 1) ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => 0,
						"option"   => __("No"),
						"selected" => ((int) $principal === 0) ? TRUE : FALSE
					)
			);

			echo formSelect(array(
				"name" 	=> "principal", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __(_("Principal"))), 
				$options
			);

			$options = array(
				0 => array(
						"value"    => "Active",
						"option"   => __("Active"),
						"selected" => ($situation === "Active") ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => "Inactive",
						"option"   => __("Inactive"),
						"selected" => ($situation === "Inactive") ? TRUE : FALSE
					)
			);

			echo formSelect(array(
				"name" 	=> "situation", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __(_("Situation"))), 
				$options
			);

			echo formSave($action);

			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);
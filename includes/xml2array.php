<?php
 class xml_container {
 	function store($k,$v) {
 		$this->{$k}[] = $v;
 	}
 }
 class xml { 
 	var $current_tag=array();
 	var $xml_parser;
 	var $Version = 1.0;
 	var $tagtracker = array();
 	function startElement($parser, $name, $attrs) {
 		array_push($this->current_tag, $name);
 		$curtag = implode("_",$this->current_tag);
 		if(isset($this->tagtracker["$curtag"])) {
 			$this->tagtracker["$curtag"]++;
 		} else {
 			$this->tagtracker["$curtag"]=0;
 		}
 		if(count($attrs)>0) {
 			$j = $this->tagtracker["$curtag"];
 			if(!$j) $j = 0;
 			if(!is_object($GLOBALS[$this->identifier]["$curtag"][$j])) {
 				$GLOBALS[$this->identifier]["$curtag"][$j] = new xml_container;
 			}
 			$GLOBALS[$this->identifier]["$curtag"][$j]->store("attributes",$attrs);
                 }
 	} // end function startElement
 	function endElement($parser, $name) {
 		$curtag = implode("_",$this->current_tag);
 		if(!$this->tagdata["$curtag"]) {
 			$popped = array_pop($this->current_tag); // or else we screw up where we are
 			return; 	// if we have no data for the tag
 		} else {
 			$TD = $this->tagdata["$curtag"];
 			unset($this->tagdata["$curtag"]);
 		}
 		$popped = array_pop($this->current_tag);
 		if(sizeof($this->current_tag) == 0) return; 	// if we aren't in a tag
 		$curtag = implode("_",$this->current_tag); 	// piece together tag
 		$j = $this->tagtracker["$curtag"];
 		if(!$j) $j = 0;
 		if(!is_object($GLOBALS[$this->identifier]["$curtag"][$j])) {
 			$GLOBALS[$this->identifier]["$curtag"][$j] = new xml_container;
 		}
 		$GLOBALS[$this->identifier]["$curtag"][$j]->store($name,$TD); #$this->tagdata["$curtag"]);
 		unset($TD);
 		return TRUE;
 	}
 	function characterData($parser, $cdata) {
 		$curtag = implode("_",$this->current_tag); // piece together tag		
 		$this->tagdata["$curtag"] .= $cdata;
 	}
 	function xml($data,$identifier='xml') {  
 
 		$this->identifier = $identifier;
 		$this->xml_parser = xml_parser_create();
 		xml_set_object($this->xml_parser,$this);
 		xml_parser_set_option($this->xml_parser,XML_OPTION_CASE_FOLDING,0);
 		xml_set_element_handler($this->xml_parser, "startElement", "endElement");
 		xml_set_character_data_handler($this->xml_parser, "characterData");
 		if (!xml_parse($this->xml_parser, $data, TRUE)) {
 			sprintf("XML error: %s at line %d",
 			xml_error_string(xml_get_error_code($this->xml_parser)),
 			xml_get_current_line_number($this->xml_parser));
 		}
 		xml_parser_free($this->xml_parser);
 	}  // end constructor: function xml()
 }
?>
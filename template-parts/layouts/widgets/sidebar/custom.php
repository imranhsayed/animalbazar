<?php
if(isset($_GET['cat_id']) && $_GET['cat_id'] != "" && is_numeric($_GET['cat_id']))
{

$term_id = $_GET['cat_id'];
$result = adforest_dynamic_templateID($term_id);
$templateID = get_term_meta( $result , '_sb_dynamic_form_fields' , true);	
	
if(isset($templateID) && $templateID != "")
{
	$formData = sb_dynamic_form_data($templateID);	
	$customHTML .= '';
	foreach($formData as $r)
	{

			
if( isset($r['types']) && trim($r['types']) != "") {
			
$in_search = (isset($r['in_search']) && $r['in_search'] == "yes") ? 1 : 0;
if($r['titles'] != "" && $r['slugs'] != "" && $in_search == 1){			
	
$customHTML .= '<div class="panel panel-default">
  <div class="panel-heading" >
     <h4 class="panel-title"><a>'.esc_html( $instance['title'] ).' '.esc_html($r['titles']).'</a></h4>
  </div>
  <div class="panel-collapse">
     <div class="panel-body recent-ads">
	 	<div class="skin-minimal">
			<form method="get" action="'.get_the_permalink( $adforest_theme['sb_search_page'] ).'" class="custom-search-form">';			
			$fieldName = "custom[".esc_attr($r['slugs'])."]";
			
					
			$fieldValue = (isset($_GET["custom"]) && isset($_GET['custom'][esc_attr($r['slugs'])])) ? $_GET['custom'][esc_attr($r['slugs'])] : '';
			if(isset($r['types'] ) && $r['types'] == 1)
			{
				$customHTML .= '<div class="search-widget"><input placeholder="'.esc_attr($r['titles']).'" name="'.$fieldName.'" value="'.$fieldValue.'" type="text"><button type="submit"><i class="fa fa-search"></i></button></div>';
			}
			if(isset($r['types'] ) && $r['types'] == 2)
			{
				$options = '';
				if(isset($r['values'] ) && $r['values'] != 1)
				{
					$varArrs = @explode("|", $r['values']);
					$options .= '<option value="0">'.esc_html__("Select Option", "adforest").'</option>';
					foreach($varArrs as $varArr)
					{
						$selected = ($fieldValue == $varArr) ? 'selected="selected"' : '';
						$options .= '<option value="'.esc_attr($varArr).'" '.$selected.'>'.esc_html($varArr).'</option>';
					}
				}
				$customHTML .= '<select name="'.$fieldName.'" class="custom-search-select" >'.$options.'</select>';				
			}
			
				if(isset($r['types'] ) && $r['types'] == 3)
				   {
					$options = '';
					if(isset($r['values'] ) && $r['values'] != 1)
					{
					 $varArrs = @explode("|", $r['values']);
						 
					 $loop = 1;
					 foreach($varArrs as $val)
					 {
					
					  $checked = '';
					  if( isset( $fieldValue ) && $fieldValue != "")
					  {
					   //$checked = in_array($val, $fieldValue) ? 'checked="checked"' : '';
					   $checked = ($val == $fieldValue) ? 'checked="checked"' : '';
					  }
					  //$checked = ( $val == $fieldValue) ? 'checked="checked"' : '';     
					  //$options .= '<li><input type="checkbox" id="minimal-checkbox-'.$loop.'"  value="'.esc_html($val).'" '.$checked.' name="'.$fieldName.'['.$val.']"><label for="minimal-checkbox-'.$loop.'">'.esc_html($val).'</label></li>';
					  $options .= '<li><input type="radio" id="minimal-checkbox-'.$loop.'"  value="'.esc_html($val).'" '.$checked.' name="'.$fieldName.'"><label for="minimal-checkbox-'.$loop.'">'.esc_html($val).'</label></li>';
					  $loop++;     
					 
					 
					 }
					}
					//$customHTML .= '<select name="'.$fieldName.'" class="custom-search-select" >'.$options.'</select>';    
					$customHTML .= '<div class="skin-minimal"><ul class="list">'.$options.'</ul></div>';
				   }				
				$customHTML  .=	 adforest_search_params( $fieldName );
				$customHTML .= '</form></div></div></div></div> ';
		
		}
}
	}
}				
	
}

?>
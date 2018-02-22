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
$customHTML .= adforest_advance_search_map_container_open(true);
$customHTML .= '<div class="col-md-4 col-xs-12 col-sm-4">
<form method="get" action="'.get_the_permalink( $adforest_theme['sb_search_page'] ).'">
<div class="form-group">
      <label>'.esc_html( $instance['title'] ).' '.esc_html($r['titles']). '</label>';
	  $fieldName = "custom[".esc_attr($r['slugs'])."]";
	  $fieldValue = (isset($_GET["custom"]) && isset($_GET['custom'][esc_attr($r['slugs'])])) ? $_GET['custom'][esc_attr($r['slugs'])] : '';
			if(isset($r['types'] ) && $r['types'] == 1)
			{
				$customHTML .= '<div class="input-group add-on"><input placeholder="'.esc_attr($r['titles']).'" name="'.$fieldName.'" value="'.$fieldValue.'" type="text" class="form-control" /><div class="input-group-btn">
        <button class="btn btn-default custom_padding" type="submit"><i class="glyphicon glyphicon-search"></i></button>
      </div>
    </div>';
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
				$customHTML .= '<select name="'.$fieldName.'" class="submit_on_select" >'.$options.'</select>';				
			}
			
				if(isset($r['types'] ) && $r['types'] == 3)
				   {
					$options = '';
					if(isset($r['values'] ) && $r['values'] != 1)
					{
					 $varArrs = @explode("|", $r['values']);
						 
					 $loop = 1;
					 if( count( $varArrs ) > 0 )
					 {
						 $options = '<select name="'.$fieldName.'" class="submit_on_select"><option></option>';
					 }
					 foreach($varArrs as $val)
					 {
					
					  $checked = '';
					  if( isset( $fieldValue ) && $fieldValue != "")
					  {
					   //$checked = in_array($val, $fieldValue) ? 'checked="checked"' : '';
					   $checked = ($val == $fieldValue) ? 'selected="selected"' : '';
					  }
					  //$checked = ( $val == $fieldValue) ? 'checked="checked"' : '';     
					  //$options .= '<li><input type="checkbox" id="minimal-checkbox-'.$loop.'"  value="'.esc_html($val).'" '.$checked.' name="'.$fieldName.'['.$val.']"><label for="minimal-checkbox-'.$loop.'">'.esc_html($val).'</label></li>';
					 
					  
					  $options .= '<option value="'.$val.'"' .  $checked . '>'.esc_html($val).'</option>';
					  $loop++;     
					 
					 
					 }
					 $options .= '</select>';
					}
					//$customHTML .= '<select name="'.$fieldName.'" class="custom-search-select" >'.$options.'</select>';    
					$customHTML .= '<div class="skin-minimal"><ul class="list">'.$options.'</ul></div>';
				   }
	   $customHTML  .=	 adforest_search_params( $fieldName );	
	   $customHTML .= '</div></form>';
	  $customHTML .= adforest_widget_counter(true);		
	   $customHTML .= '</div>';		
	$customHTML .= adforest_advance_search_map_container_close(true);
	$customHTML .= adforest_advance_search_container(true);

		}
}
	}
			

}				
	
}

?>
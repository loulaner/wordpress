<?php 
/**
 * Category Option
 *
 * @access public
 * @since 1.0.0
 *
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 */
function templ_option_tree_category( $value, $settings, $int ) 
{ 
	if($value->item_id)
	{
		$option_val = get_option($value->item_id);	
	}
?>
  <div class="option option-select">
    <h3><?php echo htmlspecialchars_decode( $value->item_title ); ?></h3>
    <div class="section">
      <div class="element">
        <div class="select_wrapper">
          <select name="<?php echo $value->item_id; ?>" id="<?php echo $value->item_id; ?>" class="select">
          <?php
       		$categories = &get_categories( array( 'hide_empty' => false ) );
       		if ( $categories )
       		{
       	    echo '<option value="">-- 选择一个 --</option>';
            foreach ($categories as $category) 
            {
              $selected = '';
    	        if ( isset( $option_val ) && $option_val == $category->term_id ) 
    	        { 
                $selected = ' selected="selected"'; 
              }
            	echo '<option value="'.$category->term_id.'"'.$selected.'>'.$category->name.'</option>';
            }
          }
          else
          {
            echo '<option value="0">没有分类</option>';
          }
          ?>
          </select>
        </div>
      </div>
      <div class="description">
        <?php echo htmlspecialchars_decode( $value->item_desc ); ?>
      </div>
    </div>
  </div>
<?php
}

/**
 * Categories Option
 *
 * @access public
 * @since 1.0.0
 *
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 */
function templ_option_tree_categories( $value, $settings, $int ) 
{ 
	if($value->item_id)
	{
		$option_val = get_option($value->item_id);	
	}
?>
  <div class="option option-checbox">
    <h3><?php echo htmlspecialchars_decode( $value->item_title ); ?></h3>
    <div class="section">
      <div class="element">
        <?php
        // check for settings item value
	      if ( isset( $option_val ) )
	      {
          $ch_values = explode(',', $option_val );
        }
        else
        {
          $ch_values = array();
        }
        
        // loop through tags
	      $categories = &get_categories( array( 'hide_empty' => false ) );
		  if ( in_array( 'none', $ch_values ) ) 
			 {
				 $chkednone = ' checked="checked"'; 
			 }
		   echo '<div class="input_wrap"><input type="checkbox" value="none" id="'.$value->item_id.'" '.$chkednone.' name="checkboxes['.$value->item_id.'][]"><label for="'.$value->item_id.'">无</label></div>';
       	if ( $categories )
       	{
       	  $count = 0;
  	      foreach ( $categories as $category ) 
  	      {
            $checked = '';
  	        if ( in_array( $category->term_id, $ch_values ) ) 
  	        { 
              $checked = ' checked="checked"'; 
            }
  	        echo '<div class="input_wrap"><input name="checkboxes['.$value->item_id.'][]" id="'.$value->item_id.'_'.$count.'" type="checkbox" value="'.$category->term_id.'"'.$checked.' /><label for="'.$value->item_id.'_'.$count.'">'.$category->name.'</label></div>';
  	        $count++;
       		}
       	}
       	else
       	{
       	  echo '<p>没有标签</p>';
       	}
        ?>
      </div>
      <div class="description">
        <?php echo htmlspecialchars_decode( $value->item_desc ); ?>
      </div>
    </div>
  </div>
<?php
}?>
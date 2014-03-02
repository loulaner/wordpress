<?php 
	/*for simple shortcodes that have no parameters like [hr],[devider] - set as value the shortcode itself,
	 * But for shortcodes that have parameters -  set as value 'type_'+name of the shortcode,  then add a hidden div like was done for
	 * 'type_list' nad 'type_quote'
	 * 
	 * */
	$divider_types =array('水平线'=>'[hr]','分隔'=>'[divider]','突出显示' =>'[highlight][/highlight]','下沉' => '[dropcap][/dropcap]','引用'=>'type_quote','列表'=>'type_list');
?>

<table class="sh_code_tbl">
	<tr>
		<td class="label_td fl_r">
			<label>选择类型:</label>
		</td>
		<td>
			<select id="typography_type">
				<?php 
					foreach ($divider_types as $divider) {
						echo "<option value='$divider'>".array_search($divider,$divider_types)."</option>";
					}
				?>
			</select>
		</td>
	</tr>
</table>
<div id="default_insert_btn_area">
	<input type="button" class="button-primary" value='插入' id='insert_devider_btn' onclick='insertSimple()'>
</div>
<div id="type_quote" class="typography_more_settings" style="display: none;">
	<?php 
		include 'quote.php';
	?>
</div>
<div id="type_list" class="typography_more_settings" style="display: none;">
	<?php 
		include 'list.php';
	?>
</div>
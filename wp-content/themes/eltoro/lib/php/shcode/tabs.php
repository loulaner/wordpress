<?php 
	$type_range =array('简易选项卡'=>'default','垂直选项卡' =>'vertical','切换'=>'toggle','手风琴' => 'accordion');
?>
<div>
	<label class="tabs_label" for="tabs_style">样式:</label>
	<select id="tabs_style">
		<?php 
			foreach ($type_range as $_type) {
				echo "<option value='$_type'>".array_search($_type,$type_range)."</option>";
			}
		?>
	</select>
</div>
<div class="cosmo-hr" style="margin-bottom: 0px;">&nbsp;</div>
<div id='tabs_settings' class='tab_togle_settings'> 
	<table  id='tabs_tbl' class="sh_code_tbl">
		<tr>
			<td >
				<div>
					<label class="tabs_label" for="nr_tabs">选项卡:</label>
					<select id="nr_tabs">
						<option value=''> 选择选项卡数量 </option>
						<?php 
							for($i=2;$i<=10;$i++){
								echo "<option value=$i>$i 选项卡</option>";
							}
						?>
						
					</select>
				</div>
			</td>
			<td style="padding-left:20px;">
				<div>
					<label class="tabs_label" for="tabber_title">标题:</label>
					<input type="text" id="tabber_title">
				</div>
				
			</td>
		</tr>
		<tr>
			<td colspan=2 id="tabs_title_">
				
			</td>
		</tr>
	</table>
	<div>
		<input type="button" onclick="insertTabs()" id="insert_tabs_btn" value="插入" class="button-primary">
	</div>	
</div>
<!-- EOF tabs -->
<div id='toggle_setings' style="display:none" class='tab_togle_settings'>
	<?php include 'toggle.php'; ?>
</div>
<!--  EOF Toggle -->

<div id='accordion_settings' style="display: none" class='tab_togle_settings'>
	<table  id='accordion_tbl' class="sh_code_tbl">
		<tr>
			<td >
				<div>
					<label class="tabs_label" for="nr_tabs_accordion">选项卡:</label>
					<select id="nr_tabs_accordion">
						<option value=''> 选择选项卡数量 </option>
						<?php 
							for($i=2;$i<=15;$i++){
								echo "<option value=$i>$i 选项卡</option>";
							}
						?>
						
					</select>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan=2 id="tabs_title_accordion">
				
			</td>
		</tr>
	</table>
	<div>
		<input type="button" onclick="insertTabsAccordion()" id="insert_tabs_acc_btn" value="插入" class="button-primary">
	</div>	
</div>
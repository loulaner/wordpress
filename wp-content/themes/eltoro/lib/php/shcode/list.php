<?php 
	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/shcode.php */
	$ol_styles = array(	'decimal', 'armenian',	'decimal-leading-zero',	'georgian','lower-alpha',	'lower-greek',	'lower-latin',	'lower-roman',	'upper-alpha',	'upper-latin',	'upper-roman');
	$ul_styles = array('bullet','arrow','star','cancel','tick');
?>

<table class="sh_code_tbl" id="tbl_list">
	<tr>
		<td class="label_td fl_r"> 
			<label for='list_type'>列表类型:</label>
		</td>
		<td>
			<select id="list_type">
				<option value="ordered_list">有序列表</option>
				<option value="unordered_list">无序列表</option>
			</select>
		</td>
		<td class="label_td fl_r" style="padding-left: 20px;"> 
			<label>预览 </label>
		</td>
		<td width=275px>
			
			<div class="cosmo-orderedlist <?php echo $ol_styles[0] ?>" id="ordered_sample">
				<ol>
					<li>这里是列表项目www.4mudi.com</li>
				</ol>
			</div>
			
			<div class="cosmo-unorderedlist <?php echo $ul_styles[0] ?>" id="unordered_sample" style="display: none">
				<ul>
					<li>这里是列表项目www.4mudi.com</li>
				</ul>
			</div>
		</td>
	</tr>
	<tr>
		<td class="label_td fl_r">
			<label for="list_style">列表样式:</label>	
		</td>
		<td>
			<select id="ordered_list" style="width:100px;"> 
				<?php 
				foreach ($ol_styles as $list_style) {
					
					echo "<option value='$list_style'>$list_style</option>";
				}	
				?>
			</select>
			
			<select id="unordered_list" style="display: none; width:100px;">
				<?php 
				foreach ($ul_styles as $list_style) {
					
					echo "<option value='$list_style'>$list_style</option>";
				}	
				?>
			</select>
		</td>
		<td colspan=2>&nbsp;
			
		</td>
	</tr>
</table>
<div>
	<a class="button" onclick="setDefault();" href="javascript:void(0);" style="margin-left:5px;">重置</a>
	<input type="button" class="button-primary" value='插入' id='insert_list' onclick='insertList()'>
</div>
<br/>
<span class="hint" style="margin: 10px 20px">
	注意！插入短代码后，列表将被输入列表项。按“ENTER”键创建一个新的项目。
</span>
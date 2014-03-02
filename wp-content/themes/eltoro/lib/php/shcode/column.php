<table width=100% class="sh_code_tbl">
	<tr>
		<td width=10% class="label_td fl_r">
			<label>栏:</label>
		</td>
		<td width=90%>
			<select id='nbr_col' name='nbr_col'>
				<option value=''>选择栏数</option>
				<option value='2'>2 列</option>
				<option value='3'>3 列</option>
				<option value='4'>4 列</option>
				<option value='5'>5 列</option>
			</select>
		</td>
	</tr>
	<tr>
		<td></td>
		<td id='col_samples'>
			
		</td>
	</tr>
	<tr>
		<td>
		
		</td>
		<td>
			<div id="demo_box" style="display:none">
				<div id='col_show'></div>
				<div class="btn_remove">
					<input type="button" class="button" value='<- 删除' id='remove_btn' onclick='removeLastCols()'>
				</div>	
				<div class="btn_add">
					<input type="button" class="button-primary" value='插入' id='insert_btn' onclick='insertCols()'>
				</div>
			</div>
		</td>
	</tr>
</table>

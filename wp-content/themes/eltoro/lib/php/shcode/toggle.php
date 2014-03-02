<table width=100% class="sh_code_tbl">
	<tr>
		<td width=50%>
			<table width=100%>
				<tr>
					<td class="label_td fl_r"><label>默认打开标题:</label></td>
					<td>
						<input type="text" id="open_title">
						<span class="hint">当切换关闭时的标题文字</span>
					</td>
				</tr>
				<tr>
					<td class="label_td fl_r"><label>默认关闭标题:</label></td>
					<td>
						<input type="text" id="close_title">
						<span class="hint">当切换打开时的标题文字</span>
					</td>
				</tr>
				<tr>
					<td class="label_td fl_r"><label for="hidden_content">默认隐藏内容:</label></td>
					<td>
						<input type="checkbox" id="hidden_content" checked="checked" >
					</td>
				</tr>
				<tr>
					<td class="label_td fl_r"><label for="toggle_content">内容:</label></td>
					<td >
						<textarea rows="8" id="toggle_content" style="width:100%"></textarea>
					</td>
				</tr>
			</table>
		</td>
		<td width=50% class="label_td l_padding" valign=top>
			<label>预览</label>
			<div class="cosmo-toggle" style="pading-top:0px; margin-top:0px;">
				<div id="open_close_title">
					<h2 ><a class="show" id="show_content">显示内容</a><a class="hide" id="hide_content" style="display:none">隐藏内容</a></h2>
				</div>
				<div class="cosmo-toggle-container" style="display: none;margin-top:0px !important;" id="toggle_demo_content">
					切换内容.
				</div>
			</div>	
			
		</td >
	</tr>
</table>
<div class="l_padding">
	<input type="button" class="button-primary" value='插入' id='insert_toggle_btn' onclick='insertToggle()'>
</div>	
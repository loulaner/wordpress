<?php include TT_ADMIN_TPL_PATH.'header.php'; ?>
<div class="info top-info"></div>
<div class="ajax-message<?php if ( isset( $message ) ) { echo ' show'; } ?>">
	<?php if ( isset( $message ) ) { echo $message; } ?>
</div>
	<div id="content">
		<div id="options_tabs">
			<ul class="options_tabs">
				<li><a href="#option_display_room_type">管理房间类型</a><span></span></li>
   				<li><a href="#option_display_room">管理房间</a><span></span></li>
				<li><a href="#option_display_room_price">季节性价格</a><span></span></li>
				<li><a href="#option_display_booking_settings">管理自定义字段</a><span></span></li>
				<li><a href="#option_display_service">管理服务</a><span></span></li>
				<li><a href="#option_display_room_gallery">管理相册</a><span></span></li>
			</ul> 
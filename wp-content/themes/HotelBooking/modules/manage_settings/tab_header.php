<?php include TT_ADMIN_TPL_PATH.'header.php'; ?>
<div class="info top-info"></div>
<div class="ajax-message<?php if ( isset( $message ) ) { echo ' show'; } ?>">
	<?php if ( isset( $message ) ) { echo $message; } ?>
</div>
	<div id="content">
		<div id="options_tabs">
			<ul class="options_tabs">
				<li><a href="#global_settings">常规设置</a><span></span></li>					
				<li><a href="#notification">通知</a><span></span></li>					
				<li><a href="#email_setups">邮箱设置</a><span></span></li>					
				<li><a href="#hotel_info">酒店信息</a><span></span></li>					
				<li><a href="#currency_setup">管理货币</a><span></span></li>					
				<li><a href="#option_payment">支付选项</a><span></span></li>	
				<li><a href="#option_display_coupon">管理优惠券</a><span></span></li>	
				
			</ul> 
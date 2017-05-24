<?php if (!defined('THINK_PATH')) exit();?><form class="ajax-invest" method="post" name="investForm" id="investForm" action="__URL__/investmoney">
	<input type="hidden" name="crowd_id" id="crowd_id" value="<?php echo ($id); ?>" />
	<input type="hidden" name="money" id="money" value="<?php echo ($investMoney); ?>" />
    <input type="hidden" name="c_id" id="c_id" value="<?php echo ($crowd_id); ?>"/>
    <ul class="item">
			<?php if($has_pin == 'yes'): ?><li>
					<h6>支付密码</h6>
					<input type="password" id="pin" name="pin" />
				</li>
				<?php if(!empty($vo['password'])): ?><li>
					<h6>定向标密码</h6>
					<input type="password" id="borrow_pass" name="borrow_pass" />
				</li><?php endif; ?>
				<li>
					<div>
					<a href="javascript:void(0);" class="center" onclick="PostData()">立即认筹</a>
					</div>
				</li>
			<?php else: ?>
				<li>
					<a href='__APP__/member/user#fragment-3' target="_blank" onclick="$.jBox.close();" class="center">请设置支付密码</a>
				</li><?php endif; ?>
	</ul>
</form>
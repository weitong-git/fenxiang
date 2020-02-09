<template>
	<view>
		<view style="text-align: center;font-size: 200%;padding-top: 8vw;">登录</view>
		<view style="width: 94%;margin-left: 3%;">
			<view>
				<text style="font-size: 100%;padding-left: 5vw;">账号</text>
				<view class="hengfang" style="height: 11.2vw;margin-top: 3.2vw;">
					<view style="flex: 1;"></view>
					<view style="flex: 1;"><image style="width: 48rpx;height: 48rpx;" src="../../static/yonghu.png"></image></view>
					<input style="flex: 9;border-bottom: 1px solid #dbdbdb;height: 11.2vw;" placeholder="请输入手机号" type="number" v-model="zhanghao" />
					<view style="flex: 1;"></view>
				</view>
			</view>

			<view style="margin-top: 3.2vw;">
				<text style="font-size: 100%;padding-left: 5vw;">密码</text>
				<view class="hengfang" style="height: 11.2vw;margin-top: 3.2vw;">
					<view style="flex: 1;"></view>
					<view style="flex: 1;"><image src="../../static/mima.png" style="width: 48rpx;height: 48rpx;"></image></view>
					<input style="flex: 9;border-bottom: 1px solid #dbdbdb;height: 11.2vw;" placeholder="请输入密码" type="password" v-model="mima" />
					<view style="flex: 1;"></view>
				</view>
			</view>

			
		</view>

		<view><button class="huxing_quan" style="width: 80%;height: 9.6vw; background:#0081ff;line-height: 9.6vw;margin-top: 8vw;" @click="denglu()">登录</button></view>

	</view>
</template>

<script>
export default {
	data() {
		return {
			zhanghao: '',
			mima: '',
		};
	},
	methods: {
		denglu: function() {
			var post_shoujihao = this.zhanghao;
			var post_mima = this.mima;
			var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1}))+\d{8})$/;
			if (post_shoujihao == '') {
				uni.showModal({
					title: '提示',
					content: '请输入手机号',
					showCancel: false
				});
			} else {
				if (!myreg.test(post_shoujihao)) {
					uni.showModal({
						title: '提示',
						content: '请输入正确手机号',
						showCancel: false
					});
				} else {
					if (post_mima == '') {
						uni.showModal({
							title: '提示',
							content: '请输入密码',
							showCancel: false
						});
					} else {
						this.post_denglu();
					}
				}
			}

		},
		post_denglu: function() {
			console.log('登录');

			var fuwuqi = getApp().globalData.quanju_fuwuqi_url;
			var shoujihao = this.zhanghao;
			var mima = this.mima;
			var _this = this;
			uni.request({
				url: fuwuqi + 'denglu.php', //仅为示例，并非真实接口地址。
				method: 'POST',
				data: {
					shoujihao: shoujihao,
					mima: mima
				},
				header: {
					//'custom-header': 'hello' //自定义请求头信息
					'content-type': 'application/x-www-form-urlencoded'
				},
				success: res => {
					switch (res.data.zhuangtai) {
						case '1':
							getApp().globalData.quanju_huiyuan_id = shoujihao;
							getApp().globalData.quanju_huiyuan_mima = mima;
							getApp().globalData.quanju_huiyuan_mingcheng = res.data.xiangqing;
							uni.redirectTo({
								url:'../shouye/shouye'
							})
							break;
						case '2':
							uni.showModal({
								title: '提示',
								content: '账号或密码错误',
								showCancel: false
							});

							break;
						case '3':
							uni.showModal({
								title: '提示',
								content: '登录失败',
								showCancel: false
							});

							break;
						default:
							uni.showModal({
								title: '错误',
								content: res.data.xiangqing,
								showCancel: false
							});
							break;
					}
				},
				fail() {
					uni.showModal({
						title: '错误',
						content: '请求服务器错误',
						showCancel: false
					});
				}
			});
		}
	},
	onLoad: function() {

	}
};
</script>

<style>
page {
	background-color: #ffffff;
}
</style>

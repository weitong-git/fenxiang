<template>
	<view>
	<view v-for="(item, index) in list" :key="index">
			<view class="huxing_quan" style="width: 90vw;background-image: linear-gradient(#6eb8b3, #cbd5bd);margin-left: 5vw;margin-top: 2vw;padding-bottom: 2vw;">
				
				
				
				
				<view>
					
					<view class="wenben_huanhang" style="color: #000000;padding-left: 6vw;padding-top: 1vw;font-size: 80%;width: 80vw;">日期：{{ item.riqi }}</view>
					<view class="wenben_huanhang" style="color: #000000;padding-left: 6vw;padding-top: 1vw;font-size: 80%;width: 80vw;">出：{{ item.chu}}</view>
					<view class="wenben_huanhang" style="color: #000000;padding-left: 6vw;padding-top: 1vw;font-size: 80%;width: 80vw;">入：{{ item.ru }}</view>										
					<view class="wenben_huanhang" style="color: #000000;padding-left: 6vw;padding-top: 1vw;font-size: 80%;width: 80vw;">异常：{{ item.yichang }}</view>
									
										
										
										
										
										
					
				</view>
			</view>
			</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				list:[],
			}
		},
		methods: {
			
		},
		onLoad:function(){
			var fuwuqi = getApp().globalData.quanju_fuwuqi_url;
			var guanliyuan_zhanghao = getApp().globalData.quanju_huiyuan_id
			var guanliyuan_mima = getApp().globalData.quanju_huiyuan_mima

			var _this = this;
			uni.request({
				url: fuwuqi + 'guanliyuan_chaxun_shuju.php', //仅为示例，并非真实接口地址。
				method: 'POST',
				data: {
					shoujihao: guanliyuan_zhanghao,
					mima: guanliyuan_mima,
				},
				header: {
					//'custom-header': 'hello' //自定义请求头信息
					'content-type': 'application/x-www-form-urlencoded'
				},
				success: res => {
					switch (res.data.zhuangtai) {
						case '1':
							_this.list = res.data.xiangqing
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
	}
</script>

<style>

</style>

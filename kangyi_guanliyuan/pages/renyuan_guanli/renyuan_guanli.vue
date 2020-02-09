<template>
	<view>
		<view class="hengfang" style="margin-top: 10vw;">
			<view class="wenben_zhong" style="flex: 1;">编号</view>
			<input class="beijing_hui" v-model="bianhao" type="number" style="flex:3" />
			<view class="wenben_zhong" @click="chaxun()" style="flex: 1;">查询</view>
		</view>
		
		<view v-if="shenfenzheng!=''" style="width: 90vw;font-size: 130%;margin-top: 3vw;margin-left: 5vw;">
			<view>姓名:{{xingming}}</view>
			<view>租客手机:{{shouji}}</view>
			<view>身份证号:{{shenfenzheng}}</view>
			<view>户籍地址:{{huji}}</view>
			<view>暂住地址:{{zhanzhu}}</view>
			<view>房东电话:{{fangdong_shouji}}</view>
			<button @click="quxiao()" style="width: 80vw;margin-left: 5vw;background:#FF0000 ;">取消通行证</button>
		</view>
		
	</view>
</template>

<script>
	export default {
		data() {
			return {
				shenfenzheng:'',
				bianhao:'',
				xingming:'',
				shouji:'',
				huji:'',
				zhanzhu:'',
				fangdong_shouji:'',
			}
		},
		methods: {
			chaxun:function(){
				if(this.bianhao!=''){
					var fuwuqi = getApp().globalData.quanju_fuwuqi_url;
					var guanliyuan_zhanghao = getApp().globalData.quanju_huiyuan_id
					var guanliyuan_mima = getApp().globalData.quanju_huiyuan_mima
					
					var _this = this;
					uni.request({
						url: fuwuqi + 'guanliyuan_chaxun_shenfen.php', //仅为示例，并非真实接口地址。
						method: 'POST',
						data: {
							shoujihao: guanliyuan_zhanghao,
							mima: guanliyuan_mima,
							bianhao:this.bianhao,
							
						},
						header: {
							//'custom-header': 'hello' //自定义请求头信息
							'content-type': 'application/x-www-form-urlencoded'
						},
						success: res => {
							switch (res.data.zhuangtai) {
								case '1':
									_this.xingming = res.data.xiangqing[0].renyuan_xingming
									_this.shouji = res.data.xiangqing[0].renyuan_shouji
									_this.shenfenzheng = res.data.xiangqing[0].renyuan_shenfenzheng
									_this.huji = res.data.xiangqing[0].renyuan_dizhi
									_this.zhanzhu = res.data.xiangqing[0].renyuan_zanzhu
									_this.fangdong_shouji = res.data.xiangqing[0].renyuan_fangdong
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
			quxiao:function(){
				let _this = this
				uni.showModal({
					title: '提示',
					content: '是否删除',
					success: function(huidiao) {
						if (huidiao.confirm) {
							var fuwuqi = getApp().globalData.quanju_fuwuqi_url;
							var guanliyuan_zhanghao = getApp().globalData.quanju_huiyuan_id
							var guanliyuan_mima = getApp().globalData.quanju_huiyuan_mima
							
							uni.request({
								url: fuwuqi + 'guanliyuan_shanchu_shenfen.php', //仅为示例，并非真实接口地址。
								method: 'POST',
								data: {
									shoujihao: guanliyuan_zhanghao,
									mima: guanliyuan_mima,
									bianhao:_this.bianhao,
									
								},
								header: {
									//'custom-header': 'hello' //自定义请求头信息
									'content-type': 'application/x-www-form-urlencoded'
								},
								success: res => {
									switch (res.data.zhuangtai) {
										case '1':
											uni.navigateBack({
												
											})
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
				});
			}
		}
	}
</script>

<style>

</style>

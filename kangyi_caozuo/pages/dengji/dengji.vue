<template>
	<view class="">
		<view style="width: 100vw;font-size: 130%;">
			<view>姓名:{{xingming}}</view>
			<view>租客手机:{{shouji}}</view>
			<view>身份证号:{{shenfenzheng}}</view>
			<view>户籍地址:{{huji}}</view>
			<view>暂住地址:{{zhanzhu}}</view>
			<view>房东电话:{{fangdong_shouji}}</view>
		</view>
		<view class="hengfang beijing_bai" style="height: 10vw;margin-top: 5vw;">
			<view class="wenben_zhong" style="flex: 1;">编号</view>
			<input style="flex: 4;" v-model="bianhao" placeholder="请输入编号"></input>
			<view @click="saoma()" class="wenben_zhong ziti_kuan8" style="flex: 2;background: #37b9ff;height: 10vw;line-height: 10vw;">扫码</view>
		</view>
		
		<button @click="huoqu()" class="huxing_quan" style="width: 90vw;margin-left: 5vw;background: #ffff00;margin-top: 3vw;">获取信息</button>
		<button @click="fangxing()" class="huxing_quan" style="width: 90vw;margin-left: 5vw;background: #00ff00;margin-top: 3vw;">{{anniu}}</button>
		
	</view>
</template>

<script>
	export default {
		data() {
			return {
				leixing:'',
				bianhao:'',
				xingming:'',
				shouji:'',
				shenfenzheng:'',
				huji:'',
				zhanzhu:'',
				fangdong_shouji:'',
				anniu:'',
				
			}
		},
		methods: {
			saoma:function(){
				var _this = this
				
				uni.scanCode({
					success:function(jieguo){
						var shibie = jieguo.result
						
						_this.bianhao = shibie
						_this.huoqu()
						// console.log(shibie)
						
					}
				})
			},
			huoqu:function(){
				
				
				
				if(this.bianhao!=''){
					var fuwuqi = getApp().globalData.quanju_fuwuqi_url;
					var shoujihao =getApp().globalData.quanju_huiyuan_id;
					var mima = getApp().globalData.quanju_huiyuan_mima;
					var _this = this;
					uni.request({
						url: fuwuqi + 'caozuo_chaxun.php', //仅为示例，并非真实接口地址。
						method: 'POST',
						data: {
							shoujihao: shoujihao,
							mima: mima,
							bianhao:_this.bianhao,
							
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
				}else{
					uni.showModal({
						title: '提示',
						content: '没有编号',
						showCancel: false
					});
				}
				
				

				
				
				
				
			},
			fangxing:function(){
				if(this.bianhao!=''){
					var fuwuqi = getApp().globalData.quanju_fuwuqi_url;
					var shoujihao =getApp().globalData.quanju_huiyuan_id;
					var mima = getApp().globalData.quanju_huiyuan_mima;
					var _this = this;
					uni.request({
						url: fuwuqi + 'caozuo_jilu.php', //仅为示例，并非真实接口地址。
						method: 'POST',
						data: {
							shoujihao: shoujihao,
							mima: mima,
							bianhao:_this.bianhao,
							leixing:_this.leixing,
							
							
						},
						header: {
							//'custom-header': 'hello' //自定义请求头信息
							'content-type': 'application/x-www-form-urlencoded'
						},
						success: res => {
							switch (res.data.zhuangtai) {
								case '1':
									_this.xingming = ''
									_this.shouji = ''
									_this.shenfenzheng = ''
									_this.huji = ''
									_this.zhanzhu = ''
									_this.fangdong_shouji = ''
									_this.bianhao = ''
									uni.showModal({
										title: '提示',
										content: res.data.xiangqing,
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
				}else{
					uni.showModal({
						title: '提示',
						content: '没有编号',
						showCancel: false
					});
				}
			}
		},
		onLoad:function(canshu){
			this.leixing = canshu.canshu
			let mingcheng =  getApp().globalData.quanju_huiyuan_mingcheng;
			uni.setNavigationBarTitle({
				title:mingcheng
			})
			
			if(this.leixing=='1'){
				this.anniu = '出登记'
			}
			
			if(this.leixing=='2'){
				this.anniu = '入登记'
			}
			
			if(this.leixing=='3'){
				this.anniu = '体温异常登记'
			}
			
			
			
			// console.log(canshu.canshu)
		}
	}
</script>

<style>
page {
	background-color: #F1F1F1;
}
</style>

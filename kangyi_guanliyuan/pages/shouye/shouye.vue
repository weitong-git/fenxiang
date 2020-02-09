<template>
	<view>
		<view @click="tiaozhuan_caozuo()" class="huxing_quan beijing_hui wenben_zhong" style="width: 96vw;height: 16vw;margin-left: 2vw;line-height: 16vw;margin-top: 4vw;">
			添加操作人
		</view>
		<view @click="shuju_chakan()" class="huxing_quan beijing_hui wenben_zhong" style="width: 96vw;height: 16vw;margin-left: 2vw;line-height: 16vw;margin-top: 4vw;">
			数据查看
		</view>
		<view @click="renyuan_guanli()" class="huxing_quan beijing_hui wenben_zhong" style="width: 96vw;height: 16vw;margin-left: 2vw;line-height: 16vw;margin-top: 4vw;">
			人员管理
		</view>
		<view @click="weixian()" class="huxing_quan beijing_hong wenben_zhong" style="width: 96vw;height: 16vw;margin-left: 2vw;line-height: 16vw;margin-top: 4vw;">
			危险信息
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			}
		},
		methods: {
			tiaozhuan_caozuo:function(){
				uni.navigateTo({
					url:"../caozuo_tianjia/caozuo_tianjia"
				})
			},
			weixian:function(){
				uni.navigateTo({
					url:"../weixian/weixian"
				})
			},
			shuju_chakan:function(){
				uni.navigateTo({
					url:"../shuju_chakan/shuju_chakan"
				})
			},
			renyuan_guanli:function(){
				uni.navigateTo({
					url:"../renyuan_guanli/renyuan_guanli"
				})
			}
			
		}
	}
</script>

<style>

</style>

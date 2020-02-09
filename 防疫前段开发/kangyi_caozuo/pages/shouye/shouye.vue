<template>
	<view>
		
		<view @click="dengji('1')" class="huxing_quan beijing_hui wenben_zhong" style="width: 96vw;height: 16vw;margin-left: 2vw;line-height: 16vw;margin-top: 4vw;">
			出登记
		</view>
		<view @click="dengji('2')" class="huxing_quan beijing_hui wenben_zhong" style="width: 96vw;height: 16vw;margin-left: 2vw;line-height: 16vw;margin-top: 4vw;">
			入登记
		</view>
		<view @click="dengji('3')" class="huxing_quan beijing_hong wenben_zhong" style="width: 96vw;height: 16vw;margin-left: 2vw;line-height: 16vw;margin-top: 4vw;">
			体温异常登记
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
			dengji:function(canshu){
				uni.navigateTo({
					url:"../dengji/dengji?canshu=" + canshu[0]
				})
			}
		},
		onLoad:function(){
			let mingcheng =  getApp().globalData.quanju_huiyuan_mingcheng;
			uni.setNavigationBarTitle({
				title:mingcheng
			})
		}
	}
</script>

<style>

</style>

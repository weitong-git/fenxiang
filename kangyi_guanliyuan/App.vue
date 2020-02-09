<script>
	export default {
		onLaunch: function() {
			console.log('App Launch')
		},
		onShow: function() {
			console.log('App Show')
		},
		onHide: function() {
			console.log('App Hide')
		},
		globalData:{
			quanju_huiyuan_id:'',
			quanju_huiyuan_mima:'',
			quanju_huiyuan_mingcheng:'',
			
			
			// #ifdef MP-WEIXIN
			quanju_fuwuqi_url: 'http://127.0.0.1/kangyi/',
			// #endif
			// #ifndef MP-WEIXIN
			quanju_fuwuqi_url: 'http://192.168.0.103/kangyi/',
			// #endif
			
		}
	}
</script>

<style>
	/*每个页面公共css */
	@import 'common/css.css';
</style>

(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-category-category"],{"0e9c":function(t,a,e){"use strict";e.d(a,"b",(function(){return s})),e.d(a,"c",(function(){return o})),e.d(a,"a",(function(){return n}));var n={uTabs:e("459a").default,uTag:e("ffa2").default,uDivider:e("98b2").default,uBackTop:e("9308").default},s=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("v-uni-view",{staticClass:"main"},[e("u-tabs",{attrs:{list:t.cates,"is-scroll":!0,"show-bar":!0,current:t.current},on:{change:function(a){arguments[0]=a=t.$handleEvent(a),t.change.apply(void 0,arguments)}}}),e("v-uni-view",{staticClass:"listbook"},t._l(t.cates[t.current]["books"],(function(a,n){return e("v-uni-navigator",{key:n,staticClass:"book",attrs:{url:"/pages/bookinfo/bookinfo?id="+a.id}},[e("v-uni-image",{attrs:{src:a.pic?a.pic:"/static/nopic.jpg","lazy-load":!0}}),e("v-uni-view",{staticClass:"book_info"},[e("v-uni-text",{staticClass:"title"},[t._v(t._s(a.name))]),e("v-uni-text",{staticClass:"author"},[t._v("作者："+t._s(a.author)+" | 类别："+t._s(a.c_name))]),e("v-uni-text",{staticClass:"intro"},[t._v("简介："+t._s(a.summary))]),e("u-tag",{attrs:{type:"error",shape:"square",size:"mini",text:1==a.status?"已完结":"连载中",mode:"plain"}})],1)],1)})),1),t.loading?e("u-divider",{staticClass:"loading",attrs:{id:"loading"}},[t._v(t._s(t.loadtext))]):t._e(),e("u-back-top",{attrs:{"scroll-top":t.scrollTop}})],1)},o=[]},"53a5":function(t,a,e){"use strict";e.r(a);var n=e("8ad9"),s=e.n(n);for(var o in n)"default"!==o&&function(t){e.d(a,t,(function(){return n[t]}))}(o);a["default"]=s.a},"6f47":function(t,a,e){var n=e("ab7b");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var s=e("4f06").default;s("45be005e",n,!0,{sourceMap:!1,shadowMode:!1})},8700:function(t,a,e){"use strict";e.r(a);var n=e("0e9c"),s=e("53a5");for(var o in s)"default"!==o&&function(t){e.d(a,t,(function(){return s[t]}))}(o);e("be8f");var i,c=e("f0c5"),r=Object(c["a"])(s["default"],n["b"],n["c"],!1,null,"18ae05be",null,!1,n["a"],i);a["default"]=r.exports},"8ad9":function(t,a,e){"use strict";e("99af"),e("4160"),e("159b"),Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0;var n={data:function(){return{scrollTop:0,cates:[{books:[]}],current:0,loading:!1,loadtext:"加载中"}},onPageScroll:function(t){this.scrollTop=t.scrollTop},onLoad:function(){uni.getStorageSync("user");this.getList()},onReachBottom:function(){this.loading||this.getNewest()},methods:{getList:function(){var t=this;this.$u.api.getCategorys().then((function(a){if(0!==a.status)return t.$u.toast(a.msg);console.log(a.data),uni.setStorage({key:"allcategorys",data:a.data});var e=[];a.data.forEach((function(t,a){e[a]={books:[],name:t.name,id:t.cid,page:1}})),t.cates=e,t.getNewest()})).catch((function(t){console.log(t)}))},getNewest:function(){var t=this;if(!this.loading){this.loadtext="加载中",this.loading=!0;this.$u.api.getByCid({size:20,page:this.cates[this.current].page,cid:this.cates[this.current].id}).then((function(a){if(0!==a.status)return t.$u.toast(a.msg);t.cates[t.current].page++,a.data.length<1?t.loadtext="没有了":(t.cates[t.current].books=t.cates[t.current].books.concat(a.data),t.loading=!1)})).catch((function(t){console.log(t)}))}},change:function(t){this.current=t,this.cates[this.current]["books"].length<1&&(this.loadtext="加载中",this.loading=!1,this.getNewest())}}};a.default=n},ab7b:function(t,a,e){var n=e("24fb");a=n(!1),a.push([t.i,".main[data-v-18ae05be]{padding-top:0}",""]),t.exports=a},be8f:function(t,a,e){"use strict";var n=e("6f47"),s=e.n(n);s.a}}]);
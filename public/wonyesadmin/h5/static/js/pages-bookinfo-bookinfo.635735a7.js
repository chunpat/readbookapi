(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-bookinfo-bookinfo"],{"12e5":function(t,o,e){"use strict";e.r(o);var i=e("f57c"),a=e.n(i);for(var n in i)"default"!==n&&function(t){e.d(o,t,(function(){return i[t]}))}(n);o["default"]=a.a},"18a6":function(t,o,e){"use strict";e.d(o,"b",(function(){return a})),e.d(o,"c",(function(){return n})),e.d(o,"a",(function(){return i}));var i={uNavbar:e("e685").default,uSection:e("7caa").default,uEmpty:e("e5ef").default},a=function(){var t=this,o=t.$createElement,e=t._self._c||o;return e("v-uni-view",{staticClass:"main"},[e("u-navbar",{attrs:{"back-text":"返回",title:"书籍详情"}}),e("v-uni-view",{staticClass:"book_detail_box"},[e("v-uni-image",{attrs:{src:t.book_info.pic?t.book_info.pic:"/static/nopic.jpg","lazy-load":!0}}),e("v-uni-view",{staticClass:"book_detail"},[e("v-uni-text",{staticClass:"book_title"},[t._v(t._s(t.book_info.name))]),e("v-uni-view",{staticClass:"book_author_title"},[t._v("作者："),e("v-uni-navigator",{staticClass:"book_author",attrs:{url:"/pages/searchRes/searchRes?keyword="+t.book_info.author}},[t._v(t._s(t.book_info.author))])],1),e("v-uni-text",{staticClass:"book_cate"},[t._v("类别："+t._s(t.book_info.c_name))])],1)],1),e("v-uni-view",{staticClass:"other_box"},[e("u-section",{staticClass:"title",attrs:{color:"#2979ff",title:"简 介",right:!1}}),t.book_info.summary?e("v-uni-view",{staticClass:"other_content"},[t._v(t._s(t.book_info.summary))]):e("v-uni-view",{staticClass:"other_content"},[t._v("暂无简介")])],1),e("v-uni-view",{staticClass:"other_box"},[e("u-section",{staticClass:"title",attrs:{color:"#2979ff",title:"最新章节",right:!1}}),e("v-uni-view",{staticClass:"other_content"},t._l(t.lastzjlist,(function(o){return t.lastzjlist.length>0?e("v-uni-view",{key:o.index,staticClass:"book_source",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.gobookend(o.index)}}},[t._v(t._s(o.name))]):e("v-uni-view",{staticClass:"book_source"},[e("v-uni-text",[t._v("暂无章节")])],1)})),1)],1),e("v-uni-view",{staticClass:"other_box"},[e("u-section",{staticClass:"title",attrs:{color:"#2979ff",title:"作者其他图书",right:!1}}),e("v-uni-view",{attrs:{"scroll-x":!0}},[t.authorbooks.length>0?e("v-uni-view",t._l(t.authorbooks,(function(o,i){return e("v-uni-navigator",{key:i,staticClass:"related_book",attrs:{url:"/pages/bookinfo/bookinfo?id="+o.id}},[e("v-uni-image",{attrs:{src:o.pic?o.pic:"/static/nopic.jpg"}}),e("v-uni-view",{staticClass:"related_book_title"},[t._v(t._s(o.name))])],1)})),1):e("v-uni-view",{staticClass:"u-padding-top-10"},[e("u-empty",{attrs:{text:"作者暂无其他作品",mode:"list"}})],1)],1)],1),e("v-uni-view",{staticClass:"footer1",attrs:{id:"footer"}},[e("v-uni-view",{staticClass:"button",class:t.hasadd?"hasadd":"",on:{click:function(o){arguments[0]=o=t.$handleEvent(o),t.addToMybooks.apply(void 0,arguments)}}},[t._v(t._s(t.hasadd?"已在书架":"加入书架"))]),e("v-uni-view",{staticClass:"button red",on:{click:function(o){arguments[0]=o=t.$handleEvent(o),t.startRead.apply(void 0,arguments)}}},[t._v("开始阅读")])],1)],1)},n=[]},"1f57":function(t,o,e){"use strict";var i=e("f812"),a=e.n(i);a.a},"243e":function(t,o,e){"use strict";e.d(o,"b",(function(){return a})),e.d(o,"c",(function(){return n})),e.d(o,"a",(function(){return i}));var i={uIcon:e("8281").default},a=function(){var t=this,o=t.$createElement,e=t._self._c||o;return e("v-uni-view",{staticClass:"u-section"},[e("v-uni-view",{staticClass:"u-section__title",class:{"u-section--line":t.showLine},style:{fontWeight:t.bold?"bold":"normal",color:t.color,fontSize:t.fontSize+"rpx",paddingLeft:t.showLine?.7*t.fontSize+"rpx":0}},[t.showLine?e("v-uni-view",{staticClass:"u-section__title__icon-wrap u-flex",style:[t.lineStyle]},[e("u-icon",{attrs:{top:"0",name:"column-line",size:1.25*t.fontSize,bold:!0,color:t.lineColor?t.lineColor:t.color}})],1):t._e(),e("v-uni-text",{staticClass:"u-flex u-section__title__text"},[t._v(t._s(t.title))])],1),t.right||t.$slots.right?e("v-uni-view",{staticClass:"u-section__right-info",style:{color:t.subColor},on:{click:function(o){arguments[0]=o=t.$handleEvent(o),t.rightClick.apply(void 0,arguments)}}},[t.$slots.right?t._t("right"):[t._v(t._s(t.subTitle)),t.arrow?e("v-uni-view",{staticClass:"u-section__right-info__icon-arrow u-flex"},[e("u-icon",{attrs:{name:"arrow-right",size:"24",color:t.subColor}})],1):t._e()]],2):t._e()],1)},n=[]},"492f":function(t,o,e){"use strict";e.r(o);var i=e("18a6"),a=e("12e5");for(var n in a)"default"!==n&&function(t){e.d(o,t,(function(){return a[t]}))}(n);e("7704");var s,r=e("f0c5"),c=Object(r["a"])(a["default"],i["b"],i["c"],!1,null,"6c262feb",null,!1,i["a"],s);o["default"]=c.exports},"6ba4":function(t,o,e){"use strict";e.r(o);var i=e("c300"),a=e.n(i);for(var n in i)"default"!==n&&function(t){e.d(o,t,(function(){return i[t]}))}(n);o["default"]=a.a},7704:function(t,o,e){"use strict";var i=e("95e9"),a=e.n(i);a.a},"7caa":function(t,o,e){"use strict";e.r(o);var i=e("243e"),a=e("6ba4");for(var n in a)"default"!==n&&function(t){e.d(o,t,(function(){return a[t]}))}(n);e("1f57");var s,r=e("f0c5"),c=Object(r["a"])(a["default"],i["b"],i["c"],!1,null,"e8c0487e",null,!1,i["a"],s);o["default"]=c.exports},"95e9":function(t,o,e){var i=e("9e8e");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=e("4f06").default;a("553db434",i,!0,{sourceMap:!1,shadowMode:!1})},"9e8e":function(t,o,e){var i=e("24fb");o=i(!1),o.push([t.i,".main[data-v-6c262feb]{padding-bottom:70px}.title[data-v-6c262feb]{padding-left:10px}.book_detail_box[data-v-6c262feb]{height:28%;display:flex}.book_detail_box uni-image[data-v-6c262feb]{width:%?210?%;height:%?300?%;margin:%?20?%;box-shadow:0 0 5px #000}.book_detail[data-v-6c262feb]{height:100%}.book_title[data-v-6c262feb]{font-size:%?40?%;font-weight:700;display:block;margin:%?30?% 0 %?15?% 0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.book_author_title[data-v-6c262feb]{font-size:%?28?%;margin-bottom:%?15?%}.book_author[data-v-6c262feb]{font-size:%?28?%;color:#555;display:inline}.book_cate[data-v-6c262feb]{font-size:%?28?%;display:block;margin-bottom:%?15?%}.other_box[data-v-6c262feb]{margin-top:%?20?%}.other_content[data-v-6c262feb]{padding:%?40?% %?25?% %?30?% %?25?%;font-size:%?30?%;color:#888;line-height:%?50?%}.book_source[data-v-6c262feb]{line-height:%?80?%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.footer1[data-v-6c262feb]{position:fixed;bottom:0;left:0;right:0;display:flex!important;align-items:center;z-index:99;height:45px;border-top:1px solid #f1f1f1\r\n\t/* box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2); */}.footer1 .button[data-v-6c262feb]{width:50%;line-height:45px;display:flex;justify-content:center;align-items:center;background:#f7f8f9;color:#666}.footer1 .button.red[data-v-6c262feb]{background:#fa3534;color:#fff}.footer1 .button.hasadd[data-v-6c262feb]{background:#f1f1f1\r\n\t/* color: #fff; */}.add_to_mybooks[data-v-6c262feb]{background-color:#fff;color:#008b8b}.added[data-v-6c262feb]{color:#ccc}.start_read[data-v-6c262feb]{background-color:#008b8b;color:#fff}.related_book[data-v-6c262feb]{margin:%?38?%;width:%?175?%;display:inline-block;font-size:%?30?%;color:#888;line-height:%?50?%}.related_book uni-image[data-v-6c262feb]{height:%?250?%;width:%?175?%;box-shadow:0 0 10px #000}.related_book_title[data-v-6c262feb]{text-align:center;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}",""]),t.exports=o},a781:function(t,o,e){var i=e("24fb");o=i(!1),o.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 下方引入的为uView UI的集成样式文件，为scss预处理器，其中包含了一些"u-"开头的自定义变量\r\n * 使用的时候，请将下面的一行复制到您的uniapp项目根目录的uni.scss中即可\r\n * uView自定义的css类名和scss变量，均以"u-"开头，不会造成冲突，请放心使用 \r\n */\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.u-section[data-v-e8c0487e]{display:flex;flex-direction:row;justify-content:space-between;align-items:center;width:100%}.u-section__title[data-v-e8c0487e]{position:relative;font-size:%?28?%;padding-left:%?20?%;display:flex;flex-direction:row;align-items:center}.u-section__title__icon-wrap[data-v-e8c0487e]{position:absolute}.u-section__title__text[data-v-e8c0487e]{line-height:1}.u-section__right-info[data-v-e8c0487e]{color:#909399;font-size:%?26?%;display:flex;flex-direction:row;align-items:center}.u-section__right-info__icon-arrow[data-v-e8c0487e]{margin-left:%?6?%}',""]),t.exports=o},c300:function(t,o,e){"use strict";e("a9e3"),Object.defineProperty(o,"__esModule",{value:!0}),o.default=void 0;var i={name:"u-section",props:{title:{type:String,default:""},subTitle:{type:String,default:"更多"},right:{type:Boolean,default:!0},fontSize:{type:[Number,String],default:28},bold:{type:Boolean,default:!0},color:{type:String,default:"#303133"},subColor:{type:String,default:"#909399"},showLine:{type:Boolean,default:!0},lineColor:{type:String,default:""},arrow:{type:Boolean,default:!0}},computed:{lineStyle:function(){return{left:-.9*Number(this.fontSize)+"rpx",top:-Number(this.fontSize)*("ios"==this.$u.os()?.14:.15)+"rpx"}}},methods:{rightClick:function(){this.$emit("click")}}};o.default=i},f57c:function(t,o,e){"use strict";e("4160"),e("c975"),e("a434"),e("e25e"),e("159b"),Object.defineProperty(o,"__esModule",{value:!0}),o.default=void 0;var i={data:function(){return{book_info:{},lastzjlist:[],authorbooks:[],bookId:0,hasadd:!1,height:"100%",directoryList:[]}},onShow:function(){},onLoad:function(t){var o=this;uni.showLoading({title:"加载中...",duration:2e4});this.bookId=t.id;var e=uni.getStorageSync("bookstore-"+this.bookId);e&&(this.book_info=e),this.$u.api.getDetail({book_id:this.bookId}).then((function(t){if(0!==t.status)return o.$u.toast(t.msg);console.log("book_id",o.bookId);var i=t.data;e&&(i["lastzj"]=e.lastzj?e.lastzj:0,i["progress"]=e.progress?e.progress:0,i["lasttime"]=e.lasttime?e.lasttime:parseInt((new Date).getTime()/1e3)),o.book_info=i;var a=t.data.zjlist&&t.data.zjlist.length>0?t.data.zjlist.length:0;if(a>0){t.data.zjlist.forEach((function(t,e){o.directoryList.push({index:e,chapter:e+1,name:t,chapterid:e+1})})),console.log(o.directoryList.length),uni.setStorage({key:"allmulu:"+o.bookId,data:o.directoryList});for(var n=[],s=a-1;s>=0;s--)n.length<6&&n.push(o.directoryList[s]);console.log(n),o.lastzjlist=n,i["lastzjlist"]=n}uni.setStorage({key:"bookstore-"+o.bookId,data:i})})).catch((function(t){console.log(t)})),uni.getStorage({key:"bookstore",success:function(t){t.data&&t.data.indexOf(parseInt(o.bookId))>-1&&(o.hasadd=!0)},fail:function(t){console.log(t)}})},methods:{gobookend:function(t){var o=this,e=uni.getStorageSync("history");"object"!==typeof e&&(e=[]);var i=!1;e.forEach((function(e){e.bookId===o.bookId&&(i=!0,e.chapterIndex=t,e.progress=0)})),i||e.push({bookId:this.bookId,chapterIndex:t,progress:0}),uni.setStorageSync("history",e),this.$u.toast("打开中"),uni.navigateTo({url:"../read/read?id="+this.bookId})},getheight:function(){var t=uni.getSystemInfoSync();this.height=t.screenHeight-44-t.statusBarHeight+"px"},addToMybooks:function(){var t=this;t.hasadd=!t.hasadd;var o=uni.getStorageSync("bookstore");if(o||t.hasadd){var e=o.indexOf(parseInt(t.bookId));t.hasadd?(-1===e&&(o=o||[],o.push(parseInt(t.bookId))),uni.setStorageSync("bookstore-"+t.bookId,t.book_info)):e>-1&&(o.splice(e,1),uni.removeStorageSync("bookstore-"+t.bookId)),uni.setStorageSync("bookstore",o)}},startRead:function(t){this.$u.toast("正在打开"),uni.navigateTo({url:"/pages/read/read?id="+this.bookId,success:function(){}})}}};o.default=i},f812:function(t,o,e){var i=e("a781");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=e("4f06").default;a("5532608c",i,!0,{sourceMap:!1,shadowMode:!1})}}]);
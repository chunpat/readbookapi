<?php
namespace app\controller;

use app\BaseController;
use think\facade\Db;

class Demo extends BaseController
{
    public function index()
    {
        return '403';
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
    // 获取 banner
    public function getbanner(){
        header('Content-Type:application/json;charset=UTF-8');
        exit('{"status":0,"msg":"ok","data":[{"id":1,"pic":"https:\/\/bossaudioandcomic-1252317822.image.myqcloud.com\/activity\/document\/d080c591ff088fab85044dde7b0efc0b.jpg","create_time":"2022-02-08 11:02:42","update_time":"2022-02-08 11:02:42","url":""},{"id":2,"pic":"https:\/\/bossaudioandcomic-1252317822.image.myqcloud.com\/activity\/document\/2c1ad692591aec7062855aaf1c46601a.jpg","create_time":"2022-02-08 11:02:42","update_time":"2022-02-08 11:02:42","url":""},{"id":3,"pic":"https:\/\/bossaudioandcomic-1252317822.image.myqcloud.com\/activity\/document\/e52dcc5e4053d900b0da952c1927646e.jpg","create_time":"2022-02-08 11:03:06","update_time":"2022-02-08 11:03:06","url":""},{"id":4,"pic":"https:\/\/bossaudioandcomic-1252317822.image.myqcloud.com\/activity\/document\/8fdf5eebfd99f05cc7298ad6ccbd528c.jpg","create_time":"2022-02-08 11:03:06","update_time":"2022-02-08 11:03:06","url":""}]}');
    }
    
    // 获取分类
    /**
    */
    public function categorylist()
    {
        header('Content-Type:application/json;charset=UTF-8');
        exit('{"status":0,"msg":"ok","data":[{"name":"","count":1},{"name":"修真\r","count":14},{"name":"历史军事\r","count":9},{"name":"女生频道\r","count":14},{"name":"武侠仙侠\r","count":7},{"name":"玄幻\r","count":23},{"name":"玄幻奇幻\r","count":20},{"name":"科幻\r","count":16},{"name":"科幻灵异\r","count":17},{"name":"穿越\r","count":18},{"name":"网游\r","count":15},{"name":"网游竞技\r","count":13},{"name":"都市\r","count":15},{"name":"都市言情\r","count":8}]}');
    }
    
    // 获取最新图书
    public function getbooklistbytime($page=1,$size=20){
        header('Content-Type:application/json;charset=UTF-8');
        exit('{"status":0,"msg":"ok","data":[{"id":186,"name":"【快穿】情迷三千","zjnums":20,"author":"星光杳杳","create_time":"2022-02-09 16:58:00","update_time":"2022-02-09 16:58:00","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/24523.jpg","views":0,"summary":"更多热门文章，请上N②qq点ＣοM阅读苏瑾是个修10024523\r","c_name":"科幻灵异\r","length":34520},{"id":187,"name":"NBA之开局抽到暮年奥尼尔","zjnums":15,"author":"会发光的金仔","create_time":"2022-02-09 16:58:00","update_time":"2022-02-09 16:58:00","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/23758.jpg","views":0,"summary":"他，菜鸟赛季就能砍下20分10篮板，其夸张表现是CBA历史上前无古人后无来者的；他，是CBA大名鼎鼎的空砍王；他，是一名本土球员；……时间回到2011年，一道来自后世天朝的灵魂和十七岁\r","c_name":"女生频道\r","length":43097},{"id":188,"name":"LOL这个男人太强了","zjnums":20,"author":"一片苏叶","create_time":"2022-02-09 16:58:00","update_time":"2022-02-09 16:58:00","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/62441.jpg","views":0,"summary":"李昊，有人叫他日天哥，还有人喊他蔑视哥。他是一坛S2陈酿，是旧时代的残党，号称‘老将’，在联盟中一直蹉跎。突然，他有挂了！……多年后，‘暮年’的大魔王正在下山，他仰头一看，和自己同一时\r","c_name":"网游竞技\r","length":80842},{"id":189,"name":"CSGO之我真的只想空枪","zjnums":14,"author":"lq连清","create_time":"2022-02-09 16:58:00","update_time":"2022-02-09 16:58:00","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/51179.jpg","views":0,"summary":"这是18岁天才少年一心想着赚钱，最后通过自己的努力获得major冠军的故事。10051179\r","c_name":"网游竞技\r","length":41104},{"id":190,"name":"1635汉风再起","zjnums":20,"author":"重庆老Q","create_time":"2022-02-09 16:58:00","update_time":"2022-02-09 16:58:00","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/14676.jpg","views":0,"summary":"一个未来的灵魂，融合了明末少年的头脑，带着一群溃散的海盗，流落澳洲，并以此为基地，建立一个崭新的世界，让汉风再次吹向世界。10014676\r","c_name":"历史军事\r","length":69477},{"id":174,"name":"三国守疆十年，开局签到李元霸","zjnums":20,"author":"大琨翼","create_time":"2022-02-09 16:57:59","update_time":"2022-02-09 16:57:59","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/45647.jpg","views":0,"summary":"杨锋驻守大汉北疆十年。觉醒了神级召唤系统。李元霸、李存孝、杨再兴等虎将。刘伯温、魏征、狄仁杰等文臣。召之即来！组建杨家将。欺负曹、刘、孙。系统在手。天下我有！乐文小说网各位书友要是觉得\r","c_name":"历史军事\r","length":51767},{"id":175,"name":"三国从单骑入荆州开始","zjnums":20,"author":"臊眉耷目","create_time":"2022-02-09 16:57:59","update_time":"2022-02-09 16:57:59","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/4539.jpg","views":0,"summary":"“生子当如孙仲谋，刘景升儿子若豚犬尔。”初平元年，被曹操称为猪狗儿的刘琦站在宜城的大门外，替他父亲刘表走进了荆州。如何不当豚犬儿？好儿子就要替父亲承担困难。单骑入宜城解决宗族，太危\r","c_name":"历史军事\r","length":56407},{"id":176,"name":"三国之吕布是我爹","zjnums":20,"author":"吃了个瓜","create_time":"2022-02-09 16:57:59","update_time":"2022-02-09 16:57:59","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/15012.jpg","views":0,"summary":"一朝穿越，回到三国时期！吕熙悲催地发现，吕布居然是他爹！而现在，这位倍儿秀的老爹，正打算刺杀丁原，投效董卓……面对岔路口的选择，吕熙是阻止，还是撺掇？10015012\r","c_name":"历史军事\r","length":43344},{"id":177,"name":"万相之王","zjnums":20,"author":"天蚕土豆","create_time":"2022-02-09 16:57:59","update_time":"2022-02-09 16:57:59","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/2530.jpg","views":0,"summary":"天地间有万相，我李洛，终将成为那万相之王。22530\r","c_name":"玄幻奇幻\r","length":62111},{"id":178,"name":"万人嫌阴郁受重生了","zjnums":17,"author":"东施娘","create_time":"2022-02-09 16:57:59","update_time":"2022-02-09 16:57:59","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/7256.jpg","views":0,"summary":"第一人称正文完，番外不定时更长到十三岁，春笛才知道自己跟人错换人生，他不是赌鬼的儿子，而是姑苏首富林家的儿子。他既兴奋又胆怯地回到自己家里，得到的却是全家人的嫌弃。父亲嫌他不学\r","c_name":"网游竞技\r","length":54034},{"id":179,"name":"七零娇宠咸鱼美人穿书","zjnums":20,"author":"风火家人","create_time":"2022-02-09 16:57:59","update_time":"2022-02-09 16:57:59","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/57004.jpg","views":0,"summary":"搜小说免费提供作者风火家人的经典小说：《七零娇宠咸鱼美人穿书》最新章节全文阅读服务本站更新及时无弹窗广告欢迎光临观看小说文案“七零娇宠桃花精美人”v后日三更9000，周末日万。温涵一觉\r","c_name":"女生频道\r","length":66605},{"id":180,"name":"七爷的心头宠","zjnums":20,"author":"秦暮晚墨景修","create_time":"2022-02-09 16:57:59","update_time":"2022-02-09 16:57:59","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/38326.jpg","views":0,"summary":"遇到七爷前，秦暮晚是个被父亲丢到乡下，不被重视的弃女。遇到七爷后，她成为云城无数名媛千金羡慕嫉妒恨的对象。七爷宠妻无度，是个妻管严。好友邀他聚会，他说：暮晚不让我喝酒。客户请他吃饭，他\r","c_name":"玄幻奇幻\r","length":33507},{"id":181,"name":"一念永恒","zjnums":20,"author":"耳根","create_time":"2022-02-09 16:57:59","update_time":"2022-02-09 16:57:59","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/667.jpg","views":0,"summary":"一念成沧海，一念化桑田。一念斩千魔，一念诛万仙。唯我念……永恒这是耳根继《仙逆》《求魔》《我欲封天》后，创作的第四部长篇小说《一念永恒》1667\r","c_name":"武侠仙侠\r","length":58142},{"id":182,"name":"一剑独尊","zjnums":20,"author":"青鸾峰上","create_time":"2022-02-09 16:57:59","update_time":"2022-02-09 16:57:59","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/1115.jpg","views":0,"summary":"生死看淡，不服就干。诸天神佛仙，不过一剑间！21115\r","c_name":"玄幻奇幻\r","length":71836},{"id":183,"name":"一个销售员的自白书","zjnums":20,"author":"陈少维","create_time":"2022-02-09 16:57:59","update_time":"2022-02-09 16:57:59","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/23320.jpg","views":0,"summary":"“你这是销售吗？你这是要饭！”“你自从做了销售后，嘴里有过一句真话吗？你现在说话，我连标点符号都不信！”陈飞作为一个技术宅，机缘巧合调入销售部，从此踏入一个陌生又惊险刺激的世界。我命由\r","c_name":"女生频道\r","length":63114},{"id":184,"name":"一世巅峰林炎","zjnums":20,"author":"佚名","create_time":"2022-02-09 16:57:59","update_time":"2022-02-09 16:57:59","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/6710.jpg","views":0,"summary":"豪门大少，华国首富，各国公主拼命想嫁的男人，回到家却被岳母当保姆使唤。各位书友要是觉得《一世巅峰林炎》还不错的话请不要忘记向您QQ群和微博里的朋友推荐哦！04942\r","c_name":"玄幻奇幻\r","length":34936},{"id":185,"name":"【快穿】欢迎来到欲望世界","zjnums":20,"author":"徐梦雪","create_time":"2022-02-09 16:57:59","update_time":"2022-02-09 16:57:59","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/37664.jpg","views":0,"summary":"一天，徐梦雪的手机弹出不明窗口，身体在那一天后变得奇怪，竟还来到了什么“欲望世界”，从此渐渐在欲望的世界中沉沦。9742叮咚！您的手机有一条新信息请注意查收徐梦雪最新鼎力大作，必看玄\r","c_name":"玄幻奇幻\r","length":25698},{"id":161,"name":"乱伦秘史","zjnums":19,"author":"小涩狼","create_time":"2022-02-09 16:57:58","update_time":"2022-02-09 16:57:58","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/52442.jpg","views":0,"summary":"前言第一章孤岛第二章牢狱第三章幽界第四章乐园结局前言这一天，在下课途中，我有些烦恼。我所说的烦恼，并不如莎士比亚的哈姆雷特里，“是该生，或该死，是难题”那样的白痴问题。他人的生死跟我一\r","c_name":"历史军事\r","length":197657},{"id":162,"name":"书穿后抱上男二金大腿","zjnums":20,"author":"兔子幺幺","create_time":"2022-02-09 16:57:58","update_time":"2022-02-09 16:57:58","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/17396.jpg","views":0,"summary":"书穿搞笑身心双洁专情无狗血梗娇宠抱上男二金大腿后，幸韵星成了摄政王妃！幸韵星以为自己一辈子的运气全都用在了名字上，一朝穿成书中招黑女配，幸韵星可不想落得个悬梁自尽、被赐毒酒、遭万人\r","c_name":"都市言情\r","length":34996},{"id":163,"name":"乡村欲爱","zjnums":20,"author":"易天下","create_time":"2022-02-09 16:57:58","update_time":"2022-02-09 16:57:58","status":0,"pic":"https:\/\/img.bige7.com\/bookimg\/12694.jpg","views":0,"summary":"《乡村欲爱》是一本都市小说，作者易天下。《乡村欲爱》内容简介：这是一个关于中国第一大村华西村的故事男人都忙着挣钱去了纸醉金迷包二奶养小三留下家里漂亮的媳妇儿她们无所事事不缺金钱于是购物\r","c_name":"女生频道\r","length":54119}]}');
    }
    // 获取排行
    public function getbooklistbyrank($type='create_time',$page=1,$size=20){
       $this->getbooklistbytime();
    }
    
    // 根据分类获取图书列表
    public function getbooklistbycategory($c_name='', $page=1, $size=20)
    {
        $this->getbooklistbytime();
    }
    
    // 获取阅读量倒序的图书列表
    public function getbooklistbyviews($page=1, $size=20)
    {
        $this->getbooklistbytime();
    }
    
    // 根据连载 完结状态获取图书列表
    public function getbooklistbystatus($status=0, $page=1, $size=20)
    {
        $this->getbooklistbytime();
    }
    
    // 搜索 完结状态获取图书列表
    public function search($keyword=0, $page=1, $size=20)
    {
        $this->getbooklistbytime();
    }
    // 根据id， 获取单本图书的信息
    public function getbookinfo($book_id=0)
    {
        header('Content-Type:application/json;charset=UTF-8');
        exit('{"status":0,"msg":"ok","data":{"id":30,"name":"斗罗大陆III龙王传说","zjnums":93,"author":"唐家三少","create_time":"2022-02-09 16:56:59","update_time":"2022-02-09 16:56:59","status":0,"pic":"https:\/\/www.xbiquwx.la\/files\/article\/image\/22\/22522\/22522s.jpg","views":0,"summary":"伴随着魂导科技的进步，斗罗大陆上的人类征服了海洋，又发现了两片大陆。魂兽也随着人类魂师的猎杀无度走向灭亡，沉睡无数年的魂兽之王在星斗大森林最后的净土苏醒，它要带领仅存的族人，向人类复仇！\r","c_name":"玄幻\r","length":199943,"zjlist":["楔子","第一章 觉醒日","第二章 武魂觉醒","第三章 小舞麟的家","第四章 入学","第五章 娜儿","第六章 带她回家","第七章 留下做我妹妹吧","第八章 学锻造？（第一更）","第九章 天赋异禀（第二更）","第十章 以后我保护你（第三更）","第十一章 奇异的恢复（第四更）","第十二章 三年后","第十三章 千锻钨钢锤","第十四章 终于攒够钱了","第十五章 十级","第十六章 星空大海","第十七章 精神力测试","第十八章 随机抽取","第十九章 魂灵","第二十章 融合","第二十一章 十一级魂师","第二十二章 老师也是魂师？","第二十三章 变异武魂？","第二十四章 娜儿走了","第二十五章 千锻（第一更）","第二十六章 千斤之力（第二更）","第二十七章 专注锻打（第三更）","第二十八章 千锻沉银（第四更）","第二十九章 感悟升华","第三十章 血祭千锻","第三十一章 极品特效","第三十二章 储物沉银环","第三十三章 初临东海","第三十五章 室友","第三十四章 报道","第三十六章 打架","第三十七章 处罚","第三十八章 赔款？","第三十九章 吃饭你也不行","第四十章 岑岳","第四十一章 锻造等级测试","第四十二章 八星圣匠","第四十三章 二级","第四十四章 你是炫耀的吧","第四十五章 最差班级","第四十六章 冷傲男神","第四十七章 东海公园之战","第四十八章 金鳞","第四十九章 找不到的金鳞","第五十章 第一堂课","第五十一章 比试","第五十二章 连胜","第五十三章 锤破石牢","第五十四章 把他当成金属","第五十五章 不该有奖励的吗？","第五十六章 脸还疼吗？","第五十七章 慕曦的郁闷","第五十八章 创造生命","第五十九章 接取任务","第六十章 包围","第六十一章 打得过我，我就自重","第六十二章 古月","第六十三章 古月VS谢邂","第六十四章 元素掌控","第六十五章 你赢了吗？","第六十六章 元素使？","第六十七章 特训","第六十八章 你们的对手，是我！","第六十九章 灵通境","第七十章 为我锻造吧！","第七十一章 练锤","第七十二章 升班赛的目标","第七十三章 升班赛第一场！","第七十四章 三人行","第七十五章 闷罐牛肉的故事","第七十六章 两环的敌人","第七十七章 正面让我来","第七十八章 金鳞再现","第七十九章 光龙匕与金鳞","第八十一章 飞行魂师","第八十二章 配合！","第八十章 奇怪！","第八十三章 光飚","第八十四章 万年魂环","第八十五章 白衣蓝剑，天冰雪寒","第八十五章 男神","第八十七章 我的身体里有条龙？","第八十八章 这不是梦","第八十九章 拍卖场展示区","第九十章 少年穷","第九十一章 一班的天才","第九十二章 父母远走"]}}');
    }
    
    // 根据 book_id 和 article_id 获取章节正文数据
    public function getcontent($book_id=0, $index=1)
    {
        header('Content-Type:application/json;charset=UTF-8');
        exit('{"status":0,"msg":"ok","data":{"content":"第'.$index.'章<br \/>\n\r<br \/>\n高大的树木茂密得连阳光也无法透入，以至于，在这片大森林之中，看到的只有阴暗。<br \/>\r\n在森林深处，有一片小湖，湖水清澈见底，澄净的宛如一块湛蓝色的水晶，可是，它的水位距离岸边却已经遥远，干涸似乎随时都可能到来。<br \/>\r\n生命的气息在湖水中荡漾，但却并不强烈，甚至是，有些虚弱。<br \/>\r\n湖边，站着一个人。<br \/>\r\n他穿着一身黑色长袍，看上去四十多岁的样子，相貌英俊而刚毅，额头上，有一缕金发垂在面颊一侧。<br \/>\r\n他就那么站着，眼神似乎有些呆滞，身上更是有着几分颓丧的气息。<br \/>\r\n就在距离他不远处，还站着一些人，有高有矮、有胖有瘦，形态各异。但每个人的眼神，却都十分黯淡。<br \/>\r\n“兽神。”一名身穿翠绿色长裙的女子，悄然来到那黑衣男子身后，恭敬的说道。<br \/>\r\n被称作兽神的黑衣男子全身震了震，嘴角流露出一丝苦涩，“兽神？现在我们魂兽，恐怕就剩下眼前这些了吧。我还做谁的神？”<br \/>\r\n绿裙女子沉默了一下，才低声道：“一万年了，从当初那霍雨浩创建传灵塔组织到现在，已经过去了整整一万年。传灵塔组织还在，可我们，却终于要走向灭绝了吗？”<br \/>\r\n兽神苦涩的道：“人类的强大，已经令我们无法抗衡。星斗大森林，也只剩下最后这一片净土。”<br \/>\r\n“是啊……”绿裙女子正想要继续说些什么。<br \/>\r\n被称为兽神的男子突然猛地抬起头，眼眸中爆射出两道实质般的金光，那瞬间勃发的恐怖气息，似乎令整个世界都为之颤抖起来。<br \/>\r\n“嗡……”他们脚下的地面轻微的振颤了一下，紧接着，面前的湖水居然如同沸腾一般，冒出一片片气泡。这些气泡飞速升腾，紧接着，大地震颤的频率也变得剧烈起来。<br \/>\r\n“怎么回事？人类来了？”绿裙女子惊呼道。<br \/>\r\n“跟他们拼了！”一个身形伟岸的壮汉怒吼一声，摇身一晃，竟然化作一头身高超过三十米的巨熊，全身散发着暗金色的光泽。<br \/>\r\n“熊君，冷静。不是人类。”兽神高声喝道，在他那原本暗淡的面庞上，竟是流露出了一抹难以形容的狂喜。<br \/>\r\n“结束了、结束了、结束了……”低沉的声音，毫无预兆的在森林中徘徊。这声音仿佛从四面八方传来，因为过于低沉，甚至听不出来男女。<br \/>\r\n“轰――”大地龟裂，整个大森林都在剧烈的颤抖，那小湖中原本就残存不多的湖水倒灌而入，顷刻间露出了湖底。<br \/>\r\n“砰――”一团银光骤然从那大地的裂缝中涌出，然后重重的拍击在岸边。<br \/>\r\n那是一只巨大的爪子，通体灿银色，在那灿银色的巨爪上，密布着一块块六边形的银色鳞片。每一块鳞片上都折射着奇异的光彩，那巨大的拍击声，带着无与伦比的强大压迫力，令所有生命体都要为之跪拜。<br \/>\r\n兽神眼中狂喜之色更胜，一步上前，单膝跪倒在地，恭声道：“恭迎主上。”<br \/>\r\n大地瞬间炸开，强盛的气息甚至令那三十米高的巨熊也随之飞跌而出，一个身长超过百丈的巨大身影骤然腾空而起，下一瞬，重重的落在地面上。<br \/>\r\n一株株巨树随之拔地而起，原本站在周围的一个个人类，竟然全都变成了一只只巨兽。但他们面对那银色的庞然大物，却只能是匍匐在地。<br \/>\r\n“它死了，但我还活着。”低沉的声音仿佛在咆哮，但似乎又有着一种浓浓的悲意。“卑鄙的人类，就要灭绝我们了吗？既然我醒了，他们毁灭的日子，也要到了。”<br \/>\r\n灿银色光芒夺目，令所有体型巨大的魂兽们不敢直视，它们只能卑微的匍匐在那里，颤抖着，狂喜着。<br \/>\r\n兽神急切的道：“主上，现在的人类，已经太过强大，他们那最顶级的魂导机甲，就算是我，也无法对抗太多。人类，已经凭借科技的力量，让我们无法抗衡。”<br \/>\r\n银色的庞大身躯缓缓低下头，低沉的声音在这片不再广袤的森林中回荡：“要毁灭他们，就要先了解他们。你们，跟我来。我们生存的世界已经即将被他们完全破坏，那么，我们就要征服他们的世界。”<br \/>\r\n巨大的身影缓缓迈开脚步，朝着森林外的方向走去，在那巨大的树冠遮蔽下，在这阴暗的光线中，它那庞大的身躯，缓缓缩小着、缩小着。当它在视线尽头渐渐消失时，却已化为人形……－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－写在开篇的话。小唐：亲爱的唐门书友们，我们斗罗大陆的世界又回来了。龙王传说，是我们斗罗大陆的第三部，也将是非常重要的一部，相信看过斗罗大陆外传神界传说的书友们都知道，神界被时空乱流卷走了，小舞麟被留在了大陆上，因为他被金龙王精华入体，唐三在他身上下了十八道封印。我们这斗罗大陆第三部的故事，就是从小舞麟身上开始的，他也将是这一部的男主角。斗罗系列，一直都是大家最喜爱，也是耗费了我最多心血的系列。龙王传说的故事，在很早以前我就想好了，而且有着完整的规划。大家将会看到一个更加瑰丽的世界。我们会有全新设定：斗铠，加入其中。同时，你们最喜爱的武魂也将回归。但一切都会变得不一样了。想知道我们的小舞麟如何来解决身上十八道封印和金龙王精华的问题吗？想知道新一代史莱克七怪又是什么样的吗？想知道谁是最终的女主角吗？那么，就请跟随小唐一起进入斗罗三的世界吧。新书刚刚开启，我先注册上，天火大道进入最后一周了。在这一周内，我们龙王传说将偶尔更新，所以大家可以偶尔来看看哦。麻烦大家先行收藏，推荐。下周一零点，也就是一月十八日，我们将正式开始上传，依旧是无缝隙衔接哦！唐门的第十二年即将结束，第十三年即将开启！我深深的爱着你们每一个人，也期待着你们跟随我一起，重回斗罗，重新体会那让我们魂牵梦绕的世界。爱你们、爱斗罗！故事，即将开始！"}}');
    }
}

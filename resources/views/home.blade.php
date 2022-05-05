@extends('layouts.site')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <h1 class="text-light"><a href="{{ url('/') }}"><span>{{ setting('site.title') }}</span></a></h1>
            <h2>{{ setting('site.description') }}</h2>
            <a class="btn-scroll" id="scroll_down" title="Scroll Down"><i class="fa fa-angle-down"></i></a>
        </div>
    </section><!-- End Hero -->
    <section id="start">
        <div class="container">
            <div class="section-inner">

                <div class="grid md:grid-cols-2">
                    <div class="intro-slide">
                        <div class="carousel" x-data="{ activeSlide: 1, slides: [1, 2, 3, 4, 5, 6, 7] }">
                            <!-- Slides -->
                            <template x-for="slide in slides" :key="slide">
                                <div x-show="activeSlide === slide"
                                    class="p-24 font-bold text-5xl h-80 flex items-center bg-red-500 text-white rounded-sm">
                                    <span class="w-12 text-center" x-text="slide"></span>
                                    <span class="text-red-300">/</span>
                                    <span class="w-12 text-center" x-text="slides.length"></span>
                                </div>
                            </template>

                            <!-- Prev/Next Arrows -->
                            <div class="carousel-control">
                                <div class="carousel-control-prev">
                                    <button
                                        class="bg-red-100 text-red-500 hover:text-orange-500 font-bold hover:shadow-lg rounded-full w-12 h-12 ml-3"
                                        x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                                        &#8592;
                                    </button>
                                </div>
                                <div class="carousel-control-next">
                                    <button
                                        class="bg-red-100 text-red-500 hover:text-orange-500 font-bold hover:shadow rounded-full w-12 h-12 mr-3"
                                        x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                                        &#8594;
                                    </button>
                                </div>
                            </div>
                            <!-- Buttons -->
                            <div class="carousel-indicators">
                                <template x-for="slide in slides" :key="slide">
                                    <button class="rounded-full" :class="{'bg-white': activeSlide === slide,
                                                             'bg-white bg-opacity-50': activeSlide !== slide 
                                                            }" x-on:click="activeSlide = slide"></button>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="card border-none md:py-0 md:pl-6 pt-6 px-0">
                        <h2>最新消息</h2>
                        <ul class="overflow-auto h-56">
                            <li>2020/3/27 網站新功能: 青草百科完成。</li>
                            <li>2020/3/23 菜單圖片設計完成。</li>
                            <li>2020/2/20 現購買任一瓶裝茶並<a
                                    href="https://www.facebook.com/sharer/sharer.php?u=https://www.eatea.cc">分享網站</a>即可獲得純天然仙草茶乙杯，歡迎大家介紹給大家。
                            </li>
                            <li>2020/2/20 歡迎團體訂購!!預訂滿10瓶以上另有優惠!!</li>
                            <li>2020/2/20 石伯青草茶網站設計完成。</li>
                        </ul>
                        <div class="text-center mx-auto ml-auto self-end absolute inset-x-0 bottom-0">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.eatea.cc" rel="noreferrer"
                                target="_blank">
                                <button class="btn btn-primary">
                                    分享網站至Facebook
                                </button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="section-inner">
                <h2>
                    部落客口中的石伯
                </h2>
                <div class="grid md:grid-cols-2">
                    <div class="card m-1">
                        <div class="card-body">
                            <h5 class="card-title"><a href="http://cclovetravel.pixnet.net/blog/post/36742500">嬉嬉的鬼混日記</a>
                            </h5>
                            <p>燒仙草的基底是由仙草干，遵照古法提煉而成。味道不甜，喝起來有點苦味後回甘，這是我最喜歡的燒仙草的甜度。苦甜苦甜的，不膩口</p>
                        </div>
                    </div>
                    <div class="card m-1">
                        <div class="card-body">
                            <h5 class="card-title"><a href="https://www.esther7.com/2009/07/blog-post_25.html">七先生與艾小姐</a>
                            </h5>
                            <p>這裡提供五種健康涼飲-青草涼茶,仙草茶,養肝補腎茶,苦茶,以及美體健康茶.個人只試過青草,仙草,以及苦茶三款,不過苦茶性偏涼,所以只喝過一兩次啦!(都不知道它是受了多大的委屈,真的給它很苦!XD)
                            </p>
                        </div>
                    </div>
                    <div class="card m-1">
                        <div class="card-body">
                            <h5 class="card-title"><a
                                    href="https://www.taisounds.com/w/TaiSounds/food_18101814214401567">太報</a>
                            </h5>
                            <p>人情味、古早味MAX！最有溫度的燒仙草！ -
                                石伯的燒仙草遵照古法提煉燒仙草，味道不甜膩，卻苦味後回甘，搭配上熬煮綿密的紅豆、大豆，吃的到芋頭、地瓜顆粒的芋圓、地瓜圓，配上柔軟Q彈的粉圓</p>
                        </div>
                    </div>
                    <div class="card m-1">
                        <div class="card-body">
                            <h5 class="card-title"><a href="https://itaiwanfood.com/20491914.html">愛台灣美食</a>
                            </h5>
                            <p>哪裡吃燒仙草？石伯青草茶是不可錯過的美食資訊</p>
                        </div>
                    </div>
                </div>
                <div class="card m-1">
                    <div class="card-body">
                        <h5 class="card-title"><a href="https://www.messenger.com/t/eatea.cc">告訴我們你的想法</a>
                        </h5>
                        <p>你也有關於石伯青草茶的文章或心得分享嗎? 歡迎告知我們。</p><a class="btn btn-outline-info"
                            href="https://www.messenger.com/t/eatea.cc">聯繫</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="notice">
        <div class="container">
            <div class="text-center rounded notice-inner">
                <h2>純天然熬製</h2>
                <p class="mb-0">
                    石伯青草茶源自於台北景美。是根據氣候、水土特性，在長期預防疾病與保健的過程中以中醫養生理論為指導，以中草藥為基礎，總結研製出的一類具有清熱退火、生津止渴等功效的保健飲料。分析青草茶“去火”的原因，有關專家指出，青草茶去毒火有效的特點十分符合現代大眾的需求。飲用青草茶是長期同大環境作鬥爭總結而來的一種護身法寶。據有關醫藥專家介紹，經由特定配方與比例熬煮的青草茶涼而不寒，清熱而不傷脾胃，沒有肝腎毒性，四季皆宜，無病時可強身，有病時能緩解，“秋冬防秋燥、春夏祛暑濕”。
                </p>
                <p class="text-danger font-weight-bold">
                    石伯青草茶是採用天然草乾熬煮而成未添加任何防腐劑。請購買後於三日內飲用完畢，需冷藏以確保產品新鮮，如有沉澱物屬自然現象，請安心飲用。</p>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="section-inner">
                <div class="col-md-12">
                    <div class="fb-comments" data-href="https://www.eatea.cc/" data-numposts="5" data-width="100%">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

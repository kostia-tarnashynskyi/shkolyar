<div class="logo">
<?php echo SeoHide::link('/', '<div class="logo-img">
      <img src="/images/strupko.png" alt="">
    </div>
    <div class="logo-title">SHKOLYAR.INFO</div>
    <div class="logo-description">шкільний інформаційний портал</div>'); ?>

   <!-- <div class="black"></div>
   <div class="red"></div>
   <div class="black"></div> -->
</div>

<?php if( $this->action->id =='index' && $this->id == 'site' ): ?>


<div class="footer-menu">
	<ul>
		<li><?php  echo CHtml::link('Про нас', array('/about'), array('rel'=>'nofollow', 'class'=>Yii::app()->request->requestUri=='/about'?'active':'')); ?></li>
		<li><?php  echo CHtml::link('Правовласникам', array('/rightholder'), array('rel'=>'nofollow', 'class'=>Yii::app()->request->requestUri=='/rightholder'?'active':'')); ?></li>
		<li><?php  echo CHtml::link('Контакти', array('/contacts'), array('rel'=>'nofollow', 'class'=>Yii::app()->request->requestUri=='/contacts'?'active':'')); ?></li>
		<li><?php  echo CHtml::link('Карта сайта', array('/sitemap'), array('rel'=>'nofollow', 'target'=>'_blank')); ?></li>
    <li><?php  echo CHtml::link('sitemap.xml', array('/sitemap.xml'), array('rel'=>'nofollow', 'target'=>'_blank')); ?></li>
	 <li><!-- Yandex.Metrika informer -->
<img src="https://mc.yandex.ru/informer/31373293/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" />
<!-- /Yandex.Metrika informer --></li>

   <?php $this->renderDynamic('getInsideLink'); ?>	
	</ul>
</div>
<?php else: ?>

<div class="footer-menu">
  <ul>
    <li><?= SeoHide::link("/about", 'Про нас', array('class'=>Yii::app()->request->requestUri=='/about'?'active':'')); ?></li>
    <li><?= SeoHide::link("/rightholder", 'Правовласникам', array('class'=>Yii::app()->request->requestUri=='/rightholder'?'active':'')); ?></li>
    <li><?= SeoHide::link("/contacts", 'Контакти', array('class'=>Yii::app()->request->requestUri=='/contacts'?'active':'')); ?></li>
    <li><?= SeoHide::link("/sitemap", 'Карта сайта', array('target'=>'_blank')); ?></li>
    <li><?= SeoHide::link("/sitemap.xml", 'sitemap.xml', array('target'=>'_blank')); ?></li>
    
    <li><!-- Yandex.Metrika informer -->
<img src="https://mc.yandex.ru/informer/31373293/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" />
<!-- /Yandex.Metrika informer --></li>

   <?php $this->renderDynamic('getInsideLink'); ?>  
  </ul>
</div>

<?php endif; ?>

<div class="scroll_up">
    <div id="toTop"> <span class="blue glyphicon glyphicon-chevron-up"></span> Наверх </div>
</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54716600-2', 'auto');
  ga('send', 'pageview');

</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter31373293 = new Ya.Metrika({
                    id:31373293,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/31373293" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->



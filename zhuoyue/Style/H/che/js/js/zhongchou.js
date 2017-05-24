// 详情页切换
  $(function(){
    var nav =  $('#xq_nav').find('li');
    var qh = $('.xq_qiehuan');
    nav.first().addClass('xq_nav');
    var h3=$('#zc-tetail-con').find('.xq_qiehuan').first().height()+40;
    var h4=$('#zc-tetail-con').find('.xq_jj').height()+40;
    var h5=h3>h4?h3:h4;  
    qh.eq(0).show();
    $('.xq_qiehuan:gt(0)').hide();
    $('#zc-tetail-con').css('height',h5+'px');
    nav.click(function(){
        var index=nav.index(this);
        var h1=$('#zc-tetail-con').find('.xq_qiehuan').eq(index).height()+40;
        var h2=$('#zc-tetail-con').find('.xq_jj').height()+40;
        h=h1>h2?h1:h2;
       $(this).addClass('xq_nav').siblings().removeClass('xq_nav');
        qh.eq(index).show().siblings().hide();
        $('#zc-tetail-con').css('height',h+'px');
    })
  })

// 全部分类
$(function(){
   $('.item').hover(function() {
    var index=$('.item').index(this);
    $(this).find('span').css('background','none');
    $('.sub_dir').eq(index).show().parent().siblings().find('.sub_dir').hide();
    $('.sub_dir').eq(index).find('li').eq(index).css('border-left','white');
   }, function() {
    var index=$('.item').index(this);
    $(this).find('span').css('background','url(/Style/H/pic/sj.png)');
    $('.sub_dir').eq(index).hide();
   });
   $('.sub_dir').mouseleave(function(event) {
       $('#wrap1').hide();
   });
   $('#all-sort').hover(function() {
      $('#wrap1').show();
   }, function() {
      $('#wrap1').hide();
   });
})



jQuery(function()
{   
// 首页下拉	 
function slideNav(slidewper,slidebox)
	    {
	    	 $(slidewper).toggle(function()
			 {
			 	 $(this).find(slidebox).stop(true).slideDown(300);
			 },function()
			 {
			 	$(this).find(slidebox).stop(true).slideUp(300);
			 })
	    };
	    slideNav(".zxcf_nav_r",".zxcf_perinfo"); 



// 排行榜切换
 function qiehuan(obj,objcur,boxone)
	   {
	   	  $(obj).click(function()
		   {
		   	   $(this).addClass(objcur).siblings().removeClass(objcur);
		   	   var index=$(this).index();
		   	 
		   	   $(boxone).eq(index).show().siblings().hide();
		   });
	   }
	  qiehuan(".block5_r_tit_em a","brt_acur",".rank_list");
//投资页切换 
      qiehuan(".product_tit span","product_curspan",".product_list");
      // borrow 切换
      qiehuan(".bor_detail_tit span","bor_decurspan",".bor_det_one");
// 项目列表切换
function qiehuan2(obj,objcur,boxone)
	{
		 $(obj).click(function()
		   {   
		   	   $(this).addClass(objcur).siblings().removeClass(objcur);
		   	   var index=$(this).index();
		   	   if(index==2){
		   	   	  $(boxone).eq(1).show().siblings().hide();
		   	   }else
		   	   {
		   	   	  $(boxone).eq(index).show().siblings().hide();
		   	   }
		   });
	}
	qiehuan2(".block3_tit span","block3_curspan",".block3_prolist"); 
	// qiehuan2(".news_span","block3_curspan",".news_ul"); 

		 
// invest页 筛选
 $(".invest_prochoose p a").click(function()
		 {   
		 	  $(this).addClass("inpro_cura").siblings().removeClass("inpro_cura");
		 });


// problem页 切换
 $(".hc_zjwt_one h3").click(function()
		    {    

		 	 if($(this).hasClass("show"))
		 	 {
               $(this).parents(".hc_zjwt_one").find(".hc_answer").hide().end().find(this).removeClass("show"); 
		 	 }else
		 	 {
		 	   $(".hc_answer").hide().parents(".hc_zjwt_one").find(".hc_zjwt_one h3").removeClass("show");
		 	   $(this).parents(".hc_zjwt_one").find(".hc_answer").show().end().find(this).addClass("show");
		 	 }
		 	  
		   });


// noticlist页 
$(".notic_secl_ul li").click(function()
{    

	 $(this).addClass("notic_curli").siblings().removeClass("notic_curli");
});


	
});

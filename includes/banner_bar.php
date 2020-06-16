<section class="banner_bar_body">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-9 col-xs-12">
				<a href="about.php#news">
				<div class="latest_news_body">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-sx-3 mobile_icon_body">
							<div class="icon_body animated" data-animation="flipInX" data-animation-delay="200">
								<div class="icon"><i class="fa fa-newspaper-o" aria-hidden="true"></i></div>
								<h3>Latest <br/>News</h3>
							</div>
						</div>
						<script>							
							$(document).ready(function(){	
								
								$("div[use=txtContents]").attr('pCount',$("div[use=txtContents]").find("p[use=txtContentP]").length);
								$("div[use=txtContents]").attr('dzAnimate','Y');
								$("div[use=txtContents]").find("p[use=txtContentP]").hide();
																
								$( "div[use=txtContents]" ).mouseenter(function() {
									$("div[use=txtContents]").attr('dzAnimate','N');
								});
								
								$( "div[use=txtContents]" ).mouseleave(function() {
									$("div[use=txtContents]").attr('dzAnimate','Y');
								});
									
								$.each($("div[use=txtContents]").find("p[use=txtContentP]"),function(i,ob){
									$(ob).attr("txtIndx",i); 	
																	
									if(i==0){
										$(ob).attr("dzShow",'Y'); 
										$(ob).show();
									} 
									else
									{
										$(ob).attr("dzShow",'N'); 
									}
								}); 
															
								setTimeout(function(){	
									//console.log("starting");								
									setInterval( function(){
										//console.log("rotation");			
										var willAnimate = $("div[use=txtContents]").attr("dzAnimate");
										//console.log("willAnimate="+willAnimate	);			
										if(willAnimate=='Y')
										{
											//console.log("got go ahead");			
											var displayed = $("div[use=txtContents]").find("p[dzShow=Y]");
											var displayedInd = $(displayed).attr("txtIndx");
											var nextInd = parseInt(displayedInd)+1;
											if(nextInd>=parseInt($("div[use=txtContents]").attr('pCount'))){
												nextInd=0;
											}
											
											//console.log("nextInd="+nextInd);
											
											var nextDisplay = $("div[use=txtContents]").find("p[txtIndx='"+nextInd+"']");
											
											$( displayed ).fadeOut( "slow");
											$( nextDisplay ).fadeIn( "slow", function(){
												$(displayed).attr("dzShow",'N');
												$(nextDisplay).attr("dzShow",'Y');
												$(nextDisplay).show();
												var no = parseInt(nextInd)+1;
												if(no<10)
												{
													so = '0'+no
												}
												else
												{
													so = no;
												}
												 $("div[use=txtContents]").find("div[use=Count]").html(so);
											});
										}
									}, 5000);					
								},1000);
							});
							
						</script>						
						<div class="col-md-9 col-sm-9 col-xs-9">
							<div class="news_box animated" data-animation="bounceInRight" data-animation-delay="200" use="txtContents">
								<?
								 $sqlNews	=	"SELECT * FROM ".$cfg['DB_NEWS']."
                        					WHERE `status`='A'";
								$resNews	=	$mycms->sql_query($sqlNews);
								$numNews	=	$mycms->sql_numrows($resNews);
								if($numNews>0)
								{
									while($rowNews	=	$mycms->sql_fetchrow($resNews))
									{
								?>
								<p use="txtContentP"><?=substr($rowNews['description'],0,150)?></p>
								<?	}
								}
								?>
								<div class="number" use="Count">01</div>
								<div class="clear"></div>
							</div>
						</div>
						
					</div>					
				</div>
				</a>
			</div>
			<div class="col-md-3 col-sm-3 mobile_iso">
				<div class="iso animated" data-animation="bounceInLeft" data-animation-delay="200" >
					<span>An ISO 9001 : 2015 Company</span> <img src="images/iso.png" alt="" />
				</div>
			</div>			
		</div>
	</div>		
</section>


<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12 service_scroller_body">
				<marquee onmouseover="this.scrollAmount=0" onmouseout="this.scrollAmount=3" scrollamount="5">
					Biometric Smart Card Application  &nbsp;&nbsp;*&nbsp;&nbsp;Election Computerization - EPIC &amp; Generation of Photo Roll &amp; Printing&nbsp;&nbsp; *&nbsp;&nbsp; Data Entry &amp; Management
					&nbsp;&nbsp;*&nbsp;&nbsp; Software Development&nbsp;&nbsp; *&nbsp;&nbsp; Electronic Document Management Systems&nbsp;&nbsp; * &nbsp;&nbsp;Variable Data Printing&nbsp;&nbsp; *&nbsp;&nbsp; Networking Solutions&nbsp;&nbsp; *&nbsp;&nbsp; Skilled Human
					Resource Support &nbsp;&nbsp;*&nbsp;&nbsp; Event Management *				
				</marquee>
			</div>
		</div>
	</div>
</section>





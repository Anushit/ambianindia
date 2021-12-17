<?php include('header.php');

 $filter = array(
  'table'=>'ci_banners',
  'where'=> 'is_active=1 && name="Gift Banner"'
);  
$bannerGiftData = postData('listing', $filter);

$data = array(
  'table' => 'ci_scroll_images',
  'where' =>'is_active=1'
);
$scroll_images = postData('listing',$data);
?>

<?php if(!empty($bannerGiftData['data'])) { ?>
<section class="parallax-container overlay-1" data-parallax-img="<?=ADMIN_PATH.$bannerGiftData['data'][0]['image']?>"><div class="material-parallax parallax"><img src="<?=ADMIN_PATH.$bannerGiftData['data'][0]['image']?>" alt="" style="display: block; transform: translate3d(-50%, 8px, 0px);"></div>
<?php } ?>
        <div class="parallax-content breadcrumbs-custom context-dark"> 
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-9">
                <h2 class="breadcrumbs-custom-title">Gift Card</h2>
                <ul class="breadcrumbs-custom-path">
                  <li><a href="<?=BASE_PATH?>index">Home</a></li>
                  <li class="active">Gift Card</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
       <!--  <section class="section section-lg bg-default">
        <div class="row isotope-wrap" style="padding-bottom: 100px;">
          

          <div class="container">
            <h3 style="text-align: center;padding-top:20px;padding:50px">Gift Card</h3>
          </div>
          <div class="col-lg-12">
            <div class="isotope" data-isotope-layout="fitRows" data-isotope-group="gallery" data-lightgallery="group" data-lg-thumbnail="false" style="position: relative; height: 616.484px;">
              <div class="row" >
               <?php  
                           // if(!empty($scroll_images['data'])){
                                //foreach ($scroll_images['data'] as $gvalue) { ?>
                <div class="col-md-12 ">
                  <div class="wow slideInDown" style="visibility: visible;">
                    <div style="padding-left: 50px;"> 
                      <img src="<?=getimage($gvalue['image'],'noimage.png') ?>" alt="" width="640" height="300"> -                      
                       <div class="gallery-item-classic-caption"><a href="<?=ADMIN_PATH.$gvalue['image']?>" data-lightgallery="item">zoom</a></div> 
                      <p>Share the vibrant flavours of India with our gift cards.</p><br>
                      <p>It is a gift of a delicious meal freshly prepared with passion and love.</p><br>
                      <p>Be it for a milestone celebration such as a birthday, anniversary,  a spontaneous congratulatory present, or just a way to say a heartfelt “thank you”. </p><br>
                      <p>Our Gift Cards are the perfect way to put joy in the hearts of the special people in your life.</p><br>
                      <p>You can buy your gift cards at the restaurant and then share in their delight as the recipient unwraps a wonderful dining experience.</p><br>

                    </div>
                  </div>
                </div>
              <?php// }}?>
               
             
             
              </div>
            </div>
          </div>
        </div>
      </section> -->
      <section class="section section-lg bg-gray-1">
        <div class="container">
          <div class="row row-50">
            
              <div class="col-lg-12 text-center">
                <h3>Give the</h3>
              <h2>GIFT OF JOY</h2>

              <p>   Share the vibrant flavours of India with our gift cards.
                      It is a gift of a delicious meal freshly prepared with passion and love.
                     Be it for a milestone celebration such as a birthday, anniversary,  a spontaneous congratulatory present, or just a way to say a heartfelt “thank you”.
                      Our Gift Cards are the perfect way to put joy in the hearts of the special people in your life.
                      You can buy your gift cards at the restaurant and then share in their delight as the recipient unwraps a wonderful dining experience.</p>
              
            </div>
          </div>
        </div>
      </section>

      <section class="section section-lg bg-gray-1">
        <div class="container">
          <div class="row row-50">
            
              <div class="col-lg-12 pr-xl-5" style="text-align:center;">
                
                <img src="<?=ADMIN_PATH.$scroll_images['data'][0]['image']?>">
              </div>
          </div>
        </div>
      </section>
         
<?php include('footer.php');?>
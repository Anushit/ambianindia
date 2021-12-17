<?php   
    include('config.php');
    
    $filter = array(
        'table'=>'ci_banners',
        'where'=> 'is_active=1 && name="Banner1"'
    );  
    $bannerData = postData('listing', $filter); 

    $filter = array(
        'table'=>'ci_cms',
        'where'=> 'is_active=1 && cms_name="Home About First Line"'
    );  
  $home_about = postData('listing', $filter);    
 
 //$home_about= getData('cms',1);

  $filter = array(
        'table'=>'ci_categories',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'3',
        'where'=> 'is_active=1 and is_feature=1'
    );  
  $categoryData = postData('listing', $filter);    

 $filter = array(
        'table'=>'ci_gallery',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'6',
        'where'=> 'is_active=1'
    );  
$galleryData = postData('listing', $filter); 

    $filter = array(
        'table'=>'ci_services',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'5',
        'where'=> 'is_active=1'
    );  
    $serviceData = postData('listing', $filter); 

    $filter = array(
        'table'=>'ci_gallery_details',
        'where'=> 'is_active=1 && type=2',
        'limit'=>'1',
    );  
    $videoGall = postData('listing', $filter);
    //print_r($videoGall);die();

    $filter = array(
        'table'=>'ci_gallery_details',
        'where'=> 'is_active=1 && gallery_id=19'
    );  
    $gallBaseData = postData('listing', $filter);
    //print_r($gallBaseData);die();

    include('header.php');

?> 
      <section class="section section-lg section-main-bunner section-main-bunner-filter text-center">
               <?php  
                    if(!empty($bannerData['data'])){?>           
        <div class="main-bunner-img"><img src="<?=ADMIN_PATH.$bannerData['data'][0]['image'];?>" width="100%" height="100%"></div>
        <div class="main-bunner-inner">
          <div class="container">
            <div class="box-default">
              <h2 class="box-default-title"><?=$bannerData['data'][0]['title_first']?></h2>
              <div class="box-default-decor"></div>
              <a href="https://app.ambianceofindia.ca/order/" target="_blank"><img src="<?=BASE_PATH?>images/header3.png"></a>
              <!-- <p class="big box-default-text"><?=$bannerData['data'][0]['title_second']?></p> -->
            </div>
          </div>
        </div>
      <?php } ?>
      </section>
      <div class="bg-gray-1">
        <section class="section-transform-top">
       
        </section>
        <section class="section section-lg section-inset-1 bg-gray-1 pt-lg-0">
          <div class="container">
            <div class="row row-50 justify-content-xl-between align-items-lg-center">
              <?php if(!empty($home_about['data'])){ 
                    foreach ($home_about['data'] as $hakey => $havalue) {?>
              <div class="col-lg-6 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                <div class="box-image"><img class="box-image-static" src="<?=ADMIN_PATH.$havalue['cms_banner']?>" alt="" width="483" height="327">
                </div>
              </div>
              <div class="col-lg-6 col-xl-5 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                <h2 style="margin:15px;"><?=$havalue['cms_title']?></h2>
                <p class="text-justify"><?=$havalue['cms_contant']?></p>
                <a class="post-corporate-link" href="<?=BASE_PATH?>about">Read more<span class="icon linearicons-arrow-right"></span></a>
              </div>
            <?php }} ?>
            </div>
            </div>
        </section>
      </div>

      <section class="section section-lg bg-gray-1 text-center">
      <div class="container">
        <h3 class="md black"  style="margin-top:0px;">Take a Tour</h3>
        
                <div class="row" style="display: flex; flex-wrap: wrap;">
                    <?php if(!empty($videoGall['data'])){ 
                    foreach ($videoGall['data'] as $vggkey => $vggvalue) { 
                        $yid = explode('v=', $vggvalue['value'] ); 
                        //print_r($yid);die();
                        if(!empty($yid[1])){
                            $tubeurl= "https://www.youtube.com/embed/".$yid['1'];
                        }else{
                            $tubeurl= "https://www.youtube.com/embed/".$vggvalue['value'];
                            //print_r($tubeurl);die();
                        } 
                    ?>
                    <div class="col-xs-6 col-sm-4 col-md-12">
                        <iframe style="height:550px; width: 100%;" src="<?=$tubeurl ?>" frameborder="0" allowfullscreen></iframe>
                        <!-- <p><?=$vggvalue['description']; ?></p> -->
                    </div>
                    <?php }} ?>
                </div>
              
      </div>
      
    </section>
     
      <!-- <section class="section section-lg bg-gray-1">
        <div class="container">
          <h2 class="text-center">Our Restaurant Menu</h2>
          <div class="row">
            <div class="col-12">
              <div class="tabs-custom tabs-horizontal tabs-classic" id="tabs-1">
                <ul class="nav nav-tabs nav-tabs-classic">
                  <?php if(!empty($categoryData['data'])){
                    foreach ($categoryData['data'] as $key => $catvalue) {
                     if($key==0){
                       $isactive = 'active';
                     }else{
                       $isactive = '';   
                     }
                     ?>
                     <li class="nav-item " role="presentation">
                      <a class="nav-link <?php echo $isactive; ?>" href="#tabs<?=$key?>" data-toggle="tab"><?=$catvalue['name']?></a></li>
                   <?php }} ?> 
                 </ul>
                 <div class="tab-content">
                  <?php
                  if(!empty($categoryData['data'])){
                    foreach ($categoryData['data'] as $key => $catvalue) {
                     if($key==0){
                       $isactive = 'active show';
                     }else{
                       $isactive = '';   
                     }

                     $limit = 3;
                     $filter_data = array(
                       'category_id' => $catvalue['id'],
                       'limit'=> $limit
                     );?>
                     <div class="tab-pane fade <?php echo $isactive; ?>" id="tabs<?=$key?>">
                      <?php
                      $results =  postData('allproducts',$filter_data);
                      if(!empty($results['data'])){
                        foreach ($results['data'] as $key => $value) {?>

                          <div class="event-item-classic">
                            <div class="event-item-classic-figure"><a href=""><img src="<?=getimage($value['image'],'noimage.png') ?>" alt="" width="109" height="109"></a></div>
                            <div class="event-item-classic-caption">
                              <p class="events-time">$<?=$value['price']?></p>
                              <h4 class="event-item-classic-title"><a href="<?=BASE_PATH?>menu_details?id=<?=$value['id']?>"><?=$value['name']?></a></h4>
                              <div class="event-item-classic-text">
                                <p><?=$value['sort_description']?></p>
                              </div>
                            </div>
                          </div> 
                        <?php }} 

                        else{
                          echo "No Product Found";
                        }
                        ?>
                      </div>
                    <?php }}
                    ?>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </section>
 -->
  <!--   <section class="section">
        <div class="row isotope-wrap">
          
          <div class="col-lg-12">
            <div class="isotope" data-isotope-layout="fitRows" data-isotope-group="gallery" data-lightgallery="group" data-lg-thumbnail="false" style="position: relative; height: 616.484px;">
              <div class="row no-gutters row-condensed">
                <?php  
                            if(!empty($galleryData['data'])){
                                foreach ($galleryData['data'] as $gvalue) { ?>
                <div class="col-12 col-sm-6 col-md-4 isotope-item wow-outer" data-filter="*" style="position: absolute; left: 0px; top: 0px;">
                  <div class="wow slideInDown" style="visibility: visible;">
                    <div class="gallery-item-classic"><img src="<?=ADMIN_PATH.$gvalue['cover_photo']?>" alt="" width="640" height="300">
                      <div class="gallery-item-classic-caption"><a href="<?=ADMIN_PATH.$gvalue['cover_photo']?>" data-lightgallery="item">zoom</a></div>
                    </div>
                  </div>
                </div>
              <?php }}?>
               
             
             
              </div>
            </div>
          </div>
        </div>
      </section> -->
      <section class="section-lg bg-gray-1 text-center">
        <div class="container">
        <h3 style="margin-top: 0px;">Why people choose us</h3>
        <p class="text-justify" style="text-align: center;">We provide an ultimate destination in Mississauga to host your next celebration, social or corporate event with our hand crafted classic recipes, passion for quality and seamless service.
</p>
      </div>
        <div class="container">
          <div class="row row-50">
           <?php if(!empty($serviceData['data'])){
        $i=0;
        foreach ($serviceData['data'] as $svalue) { 
        if($i==5){ echo '</div> <div class="row row-50">'; $i=0; }?>
            <div class="col-md-12 col-lg-3">
              <div class="box-icon-classic">
                <div class="icon-bg" style="text-align: center;"><img src="<?=ADMIN_PATH.$svalue['icon']?>" width="50" height="50"></div>
                <div class="box-icon-caption">
                  <h4><a href="#"><?=$svalue['name']?></a></h4>
                  <!-- <p class="text-justify"><?=$svalue['description']?></p> -->
                </div>
              </div>
            </div>
            <?php $i++; }}?>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="row isotope-wrap">
          <!-- Isotope Content-->
          <div class="col-lg-12">
            <div class="isotope" data-isotope-layout="fitRows" data-isotope-group="gallery" data-lightgallery="group" data-lg-thumbnail="false" style="position: relative; height: 616.484px;">
              <div class="row no-gutters row-condensed">
                <?php  
                            if(!empty($gallBaseData['data'])){
                                foreach ($gallBaseData['data'] as $gbdvalue) { ?>
                <div class="col-12 col-sm-6 col-md-4 isotope-item wow-outer" data-filter="*" style="position: absolute; left: 0px; top: 0px;">
                  <div class="wow slideInDown" style="visibility: visible;">
                    <div class="gallery-item-classic"><img src="<?=ADMIN_PATH.$gbdvalue['value'] ?>" alt="" width="640" height="300">
                      <div class="gallery-item-classic-caption"><a href="<?=ADMIN_PATH.$gbdvalue['value']?>" data-lightgallery="item">zoom</a></div>
                    </div>
                  </div>
                </div>
              <?php }}?>
               
             
             
              </div>
            </div>
          </div>
        </div>
      </section>

     <!--  <section class="parallax-container" data-parallax-img="images/parallax-img-2.jpg"><div class="material-parallax parallax"><img src="Home_files/parallax-img-2.jpg" alt="" style="display: block;"></div>
        <div class="parallax-content section-xxl context-dark text-center bg-dark-filter">
          <div class="container">
            <div style="background-color: white; border:0;">
                 <?php  
                  if(!empty($msg)){
                  echo "<div class='alert alert-success text-center'>".$msg."</div>";
                    } 
                  ?>
            </div>
            <div class="row justify-content-md-center">
              <div class="col-md-9 col-lg-8 col-xl-7 wow-outer">
                <div class="wow slideInDown" style="visibility: hidden; animation-name: none;">
                  <h2>Subscribe to Stay Informed</h2>
                  <form class="rd-form rd-mailform rd-form-inline" data-form-output="form-output-global" data-form-type="subscribe" action="subscribeForm" id="myForm" method="post"  novalidate="novalidate">
                    <div class="form-wrap">
                      <input class="form-input form-control-has-validation" id="subscribe-form-email" type="email" name="email" data-constraints="@Email @Required"><span class="form-validation"></span>
                      <label class="form-label rd-input-label" for="subscribe-form-email">E-mail</label>
                    </div>
                    <div class="form-button">
                      <button class="button button-primary button-lg" type="submit" name="submit">Subscribe</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> -->


      

<?php include('footer.php');?>


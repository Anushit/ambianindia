<?php include('config.php');

$filter = array(
  'table'=>'ci_banners',
  'where'=> 'is_active=1 && name="About Banner"'
);  
$bannerAbData = postData('listing', $filter);
//print_r($bannerAbData);die();
$aboutdata = getData('cms',3);
//print_r($aboutdata);die();
//
$siteimage = getData('sideimage',1);
//print_r($siteimage);die();
    $filter = array(
        'table'=>'ci_services',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'10',
        'where'=> 'is_active=1'
    );  
    $serviceData = postData('listing', $filter); 

    $filter = array(
        'table'=>'ci_gallery_details',
        'where'=> 'is_active=1 && gallery_id=20'
    );  
    $gallAbutData = postData('listing', $filter);

    include('header.php');
?>  

      <?php if(!empty($bannerAbData['data'])) { ?>
<section class="parallax-container overlay-1" data-parallax-img="<?=ADMIN_PATH.$bannerAbData['data'][0]['image']?>"><div class="material-parallax parallax"><img src="<?=ADMIN_PATH.$bannerAbData['data'][0]['image']?>" alt="" style="display: block; transform: translate3d(-50%, 16px, 0px);"></div>
<?php } ?>
        <div class="parallax-content breadcrumbs-custom context-dark"> 
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-9">
                <h2 class="breadcrumbs-custom-title">About Us</h2>
                <ul class="breadcrumbs-custom-path">
                  <li><a href="<?=BASE_PATH?>index">Home</a></li>
                  <li class="active">About Us</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section section-lg bg-gray-1">
        <div class="container">
          <div class="row row-50">
            <div class="col-lg-6 pr-xl-5"><img src="<?=ADMIN_PATH.$siteimage['data']['image']?>" height="300" width="500">
            </div>
              <div class="col-lg-6">
              <h2>Our Profile</h2>
              <p class="text-justify"><?=$aboutdata['data']['cms_contant']?></p>
            </div>
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
                            if(!empty($gallAbutData['data'])){
                                foreach ($gallAbutData['data'] as $gladvalue) { ?>
                <div class="col-12 col-sm-6 col-md-4 isotope-item wow-outer" data-filter="*" style="position: absolute; left: 0px; top: 0px;">
                  <div class="wow slideInDown" style="visibility: visible;">
                    <div class="gallery-item-classic"><img src="<?=ADMIN_PATH.$gladvalue['value'] ?>" alt="" width="640" height="300">
                      <div class="gallery-item-classic-caption"><a href="<?=ADMIN_PATH.$gladvalue['value']?>" data-lightgallery="item">zoom</a></div>
                    </div>
                  </div>
                </div>
              <?php }}?>
               
             
             
              </div>
            </div>
          </div>
        </div>
      </section>
           
      
<?php include('footer.php');?>
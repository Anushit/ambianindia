<?php include('config.php');?>
 <?php 

 $filter = array(
  'table'=>'ci_banners',
  'where'=> 'is_active=1 && name="Menu Banner"'
);  
$bannerMenuData = postData('listing', $filter);
//print_r($bannerMenuData);die();


  $filter = array(
        'table'=>'ci_categories',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        //'limit'=>'10',
        'where'=> 'is_active=1 and is_feature=1'
    );  
  $categoryData = postData('listing', $filter); 

    $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : 0;
  //print_r($cat_id);die();
 $whereForCategory = "";
        if(isset($_GET['cat_id']) && !empty($_GET['cat_id'])){
          $whereForCategory = " and p2c.category_id='".$_GET['cat_id']."'";
        }

 if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  

    $filter_data = array(
     
  'where'=> $whereForCategory
);
    $resul =  postData('allproducts',$filter_data);
    //print_r($services);die();
        $number_of_courses = count($resul['data']);
        // print_r($number_of_courses);die();
  
        $results_per_page = 10;  
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_courses / $results_per_page);
        //print_r($$number_of_page);die();
         // Get services data


       
        $filter = array(
            'start' => $page_first_result,
            'order'=>'asc',
            'limit'=>$results_per_page,
            'offset'=>$results_per_page,
            'where'=> $whereForCategory
        ); 
        $results =  postData('allproducts',$filter);
        $array_result = array();
        foreach($results['data'] as $value){
          $array_result[$value['category_name']][] = $value;
        }
        // echo "<pre>";
        // print_r($array_result);
        // echo "</pre>";
        // die;

$filter = array(
        'table'=>'ci_categories',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'10',
        'where'=> 'is_active=1 and is_feature=1'
    );  
  $categoryyData = postData('listing', $filter);
  // echo  "<pre>";
  // print_r($categoryyData);die();

$filter = array(
        'table'=>'ci_gallery_details',
        'where'=> 'is_active=1 && gallery_id=21'
    );  
    $gallMenuData = postData('listing', $filter);

  include('header.php');

?>

<?php if(!empty($bannerMenuData['data'])) { ?>
<section class="parallax-container overlay-1" data-parallax-img="<?=ADMIN_PATH.$bannerMenuData['data'][0]['image']?>"><div class="material-parallax parallax"><img src="<?=ADMIN_PATH.$bannerMenuData['data'][0]['image']?>" alt="" style="display: block; transform: translate3d(-50%, 16px, 0px);"></div>
<?php } ?>
        <div class="parallax-content breadcrumbs-custom context-dark"> 
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-9">
                <h2 class="breadcrumbs-custom-title">Menu</h2>
                <ul class="breadcrumbs-custom-path">
                  <li><a href="<?=BASE_PATH?>index">Home</a></li>
                  <li class="active">Menu</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section section-lg bg-default">
        <div class="container">

          <div class="row row-70 justify-content-xl-between">
            <div class="col-lg-8">
              
              <?php foreach($array_result  as  $keyy => $datas) {
                ?>
                
                <div>
                  <h3 class="md black text-center"  style="margin-top:0px;"><?=$keyy?></h3>
                </div>

                <?php foreach($datas as $productt){ ?>
                <div class="col-md-12">
                  <div class="post-classic" style="border: none; max-width: 100%;">
                   
                   <div class="row"> 
                    <div class="col-md-12">
                     <h4 class="post-classic-title" style="font-family: Segoe Print;"><a href="<?=BASE_PATH?>menu_details?id=<?=$productt['id']?>"><?=$productt['name']?></a></h4>
                   </div>
                   <!-- <div class="col-md-4">
                     <p class="events-time" style="float: right;">$<?php echo number_format($productt['price'],2);?></p>
                   </div> -->
                 </div>
                 </div>
                 <div class="col-md-12" style="margin-bottom:70px;">
                   <div class="post-classic-caption" style="margin-left: 10px;">
                     
                     <p class="text-justify"><?=mb_strimwidth($productt['sort_description'],0,200,'..')?></p>
                   </div>
                 </div>
               </div>
            <?php }} ?>
              <!-- Bootstrap Pagination-->
              <!--          -->
              
            </div>
            <div class="col-lg-4 col-xl-3">
            <div class="block-aside">
              <div class="block-aside-item">
                <h5 class="block-aside-title">All Categories</h5>
                <ul class="category-list">
                  <?php if(!empty($categoryData['data'])){ 
                    foreach ($categoryData['data'] as $key => $cat) { 
                      if(!empty($cat_id) && $cat['id']==$cat_id){
                        $isactive = 'active';
                      }else{
                        $isactive = '';   
                      }?>
                      <li class="<?php echo $isactive?>"><a  href="<?=BASE_PATH?>catmenu?cat_id=<?=$cat['id']?>"><?=$cat['name']?></a></li>
                    <?php }}?>
                  </ul>

                </div>
              </div>
            </div>
          </div>

          </div>
          
          <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-4">
                <h5 class="md black text-center"  style="margin-top:0px; line-height: 25px;">Please advise us of any allergies<br> (N) –Stands for nuts<br> Prices subject to change without notice </h5>
              </div>
            </div>
          <nav aria-label="Page navigation">
            <?php if(!empty($cat_id)) {?>
            <ul class="pagination pagination-classic">
              <?php
                    for($pages = 1; $pages<= $number_of_page; $pages++) { ?>
                <li class="page-item page-item-control "><a class="<?php if($page == $pages){ echo 'page-link active';}else{echo 'page-link';}?>" href="<?=BASE_PATH?>catmenu?cat_id=<?=$cat_id?>&page=<?=$pages?>"><?=$pages?></a></li>
              <?php }  ?>
            </ul>
          <?php }else{ ?>
            <ul class="pagination pagination-classic">
              <?php  {
                    for($pages = 1; $pages<= $number_of_page; $pages++) { ?>
                <li class="page-item page-item-control"><a class="<?php if($page == $pages){ echo 'page-link active';}else{echo 'page-link';}?>" href="<?=BASE_PATH?>catmenu?page=<?=$pages?>"><?=$pages?></a></li>
              <?php }}  ?>
            </ul>
          <?php } ?>
          </nav>
        </div>
      </section>

      <section class="section">
        <div class="row isotope-wrap">
          <!-- Isotope Content-->
          <div class="col-lg-12">
            <div class="isotope" data-isotope-layout="fitRows" data-isotope-group="gallery" data-lightgallery="group" data-lg-thumbnail="false" style="position: relative; height: 616.484px;">
              <div class="row no-gutters row-condensed">
                <?php  
                            if(!empty($gallMenuData['data'])){
                                foreach ($gallMenuData['data'] as $gmdvalue) { ?>
                <div class="col-12 col-sm-6 col-md-4 isotope-item wow-outer" data-filter="*" style="position: absolute; left: 0px; top: 0px;">
                  <div class="wow slideInDown" style="visibility: visible;">
                    <div class="gallery-item-classic"><img src="<?=ADMIN_PATH.$gmdvalue['value'] ?>" alt="" width="640" height="300">
                      <div class="gallery-item-classic-caption"><a href="<?=ADMIN_PATH.$gmdvalue['value']?>" data-lightgallery="item">zoom</a></div>
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
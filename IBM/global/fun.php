<?php
include_once("dbcon.php");
class Funcation {
    public $db;
    public $dbf;

    function __construct(){
        $this->db = Database::connectDB();
        $this->dbf = new dbFuncation();
    }


    function generateRandomPin($length = 4) {
        // Check if the length is at least 1
        if ($length < 1) {
            return false;
        }
    
        // Generate a random PIN using random_int()
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        return md5(random_int($min, $max));
    }
    function chkExpireProject($data,$todayDate) {
        $projectDate=$data['data'][0]['date'];

        if(strtotime($projectDate) < strtotime($todayDate)){
            echo "<h1>Your project has been expired plesa call the Muhammad Shakeeb Raza";
            exit();
        }else{
           return 1;
        }

    }
    function checkproductapi($key) {


//         $proId = $key;
//         $apiEndpoint = "http://localhost/api/projectinfo.php?proId=$proId";

//         // Make a GET request to the API endpoint
//         $response = file_get_contents($apiEndpoint);

//         // Decode the JSON response
//         $projectInfo = json_decode($response, true);
// var_dump($response);

//         if ($projectInfo !== null) {
//             if($projectInfo['status']!=false){
//                 $todayDate = date('Y-m-d');
//                 $expireProjectData=$this->chkExpireProject($projectInfo,$todayDate);
//                 if($expireProjectData == 1){
//                     return 1;
//                 }else{
//                     return 0;

//                 }
//             }else{
//                 echo"<h1>Call Muhammad Shakeeb Raza to check your product</h1>";
//                 exit();
//             }

//         } else {
//             echo"<h1>Call Muhammad Shakeeb Raza to check your product</h1>";
//             exit();
//         }
return 1;

    }
    function baseUrl() {
      $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
      $domain = $_SERVER['HTTP_HOST'];
      $dir = dirname($_SERVER['PHP_SELF']);
      $dire = str_replace(['/pages', '/user', '/menu', '/homepage', '/banner', '/setting', '/gallery', '/blog', '/permission'], '', $dir);
  
      $baseUrl = $protocol . $domain . $dire;
  
      return $baseUrl;
  }
      function generateCsrfToken2() {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token_Permission'] = $token;
        return $token;
    }
    function verifyCsrfToken($token) {
      return isset($_SESSION['csrf_token_Permission']) && hash_equals($_SESSION['csrf_token_Permission'], $token);
  }
    function blogData(){
        $whereCluseBlog="publish = 1";
        $blogData=$this->dbf->getRows("blog",$whereCluseBlog);
        if(isset($blogData)){ 
          foreach($blogData as $key=>$val){
            $currentDay = $val['date'];
            $day = substr($currentDay, 8, 2);
            $dateTime = new DateTime($currentDay);
            $month = $dateTime->format("M");

            echo ' <div class="col-md-6 pl-0">
            <div class="box b1">
              <div class="img-box">
                <img src="'.$this->baseUrl().'/IBM/uploades/blog/'.unserialize($val['image']).'" alt="">
              </div>
              <div class="row">
                <div class="col-lg-8 col-md-10 ml-auto">
                  <div class="detail-box">
                    <div class="img_date">
                      <h6>
                      '.$day.' <br>
                        '.$month.'
                      </h6>
                    </div>
                    <h3>
                    '.unserialize($val['title']).'
                    </h3>
                    <p>
                    '.unserialize($val['description']).'
                    </p>
                    <a href="">
                      Read More
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          ';
          }
        }
    }
    function bannerData(){
        $whereCluseBanner="publish = 1";
        $bannerData=$this->dbf->getRows("banner",$whereCluseBanner);
        if(isset($bannerData)){
        $i=1;
        foreach($bannerData as $key=>$val){
          if($i == 1){

            echo "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\"".$i."\" class=\"active\">0".$i."</li>";
          }else{
            echo "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\"".$i."\">0".$i."</li>";

          }
          $i++;
        }
        }else{
           echo"No found any data ...... ";
        }
    }
    function boxStatus($id){
        $whereCluseBox="id =".$id."";
        $boxData=$this->dbf->getRows("box_setting",$whereCluseBox);
        if(isset($boxData)){
            return $boxData;
        }else{
            return 0;
        }
    }
    public function getBox($boxName, $textCharacters = false, $headingCharacter = false, $subHeadingCharacters = false)
    {
    

        $sql = "box ='$boxName' ";
        $data = $this->dbf->getRows("box",$sql);

        @$heading = unserialize($data[0]['heading']);
        @$sub_heading =  unserialize($data[0]['sub_heading']);
        @$short_desc =  unserialize($data[0]['short_desc']);
        @$linkText =  unserialize($data[0]['linktext']);
        @$link=  unserialize($data[0]['redirect']);

     

        @$array = array();
        @$array['heading']   = $heading;
        @$array['heading2']  = $sub_heading;
        @$array['text']      = $short_desc;
        $array['link']      = $link;
        $array['linkText']  = $linkText;
        @$array['image']     = $data[0]['image'];


        return $array;
    }
    public function devloperSettingChk($safeDataFinder){
      if(isset($safeDataFinder)){
        $whereclus="setting_name = '$safeDataFinder'";
        $findData = $this->dbf->getRows("developer_setting",$whereclus);
        if(!empty($findData)){
          return $findData[0]['setting_val'];
        }

      }else{
        return 0;
      }

    }
    public function menuDatafinder($mId){
      if(isset($mId)){
        $whereclus="id  = $mId AND publish = 1";
        $findData = $this->dbf->getRows("penel_premission",$whereclus);
        if(!empty($findData)){
          return $findData[0]['value_name'];
        }

      }else{
        return 0;
      }

    }
    function getCsrfToken() {
      $randomSixDigitValue = mt_rand(100000, 999999);
      $token=$this->customEncode($randomSixDigitValue,"CSRF");
      if(isset($token)){
        return $token;
      }

    }
  function customEncode($id, $key) {
    $cipher = "aes-256-cbc";
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));

    $encryptedId = openssl_encrypt($id, $cipher, $key, 0, $iv);
    $encryptedIdBase64 = base64_encode($iv . $encryptedId);

    return $encryptedIdBase64;
}

function customDecode($encryptedId, $key) {
  $cipher = "aes-256-cbc";
  $encryptedId = base64_decode($encryptedId);
  $iv = substr($encryptedId, 0, openssl_cipher_iv_length($cipher));

  $decryptedId = openssl_decrypt(substr($encryptedId, openssl_cipher_iv_length($cipher)), $cipher, $key, 0, $iv);

  return $decryptedId;
}
function getmenu($menuName){
  $whereclus = "type = ? AND publish = ?";
  $params = array($menuName, 1);
  $findData = $this->dbf->getRoww("menu", $whereclus, $params);
  return $findData;
} 

function printGlobalVar() {
  global $ibmsGlobal;
  $ibmsGlobal = $this->dbf->getRow("ibms_setting");
  
  global $transformedData;
  $transformedData = array();
  
  foreach ($ibmsGlobal as $item) {
      $transformedData[$item['name']] = $item['value'];
  }
  
  // var_dump($transformedData);
}

function aboutusData(){
  $whereclus = "pg_id =? AND status = ?";
  $params = array(21,1);
  $aboutData = $this->dbf->getRoww("pages", $whereclus, $params);
  
  return $aboutData;
}

function getBanner(){
  $whereclus = "publish = ?";
  $params = array(1);
  $bannerData = $this->dbf->getRoww("banner", $whereclus, $params);

  return $bannerData;
}

}


?>

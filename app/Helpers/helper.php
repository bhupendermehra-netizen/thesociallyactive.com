<?php
use App\Models\Page;
use App\Models\ExtraImage;


if(!function_exists('header_footer')){
    function header_footer(){
        static $cachedPages = null;
        if ($cachedPages !== null) {
            return $cachedPages;
        }

        $pages["navbar"] = json_decode(Page::wherePage("Header")->whereSection("navbar")->first()->fields??"");
        $pages["footer"] = json_decode(Page::wherePage("footer")->whereSection("footer")->first()->fields??"");
        $pages["side_buttons"] = json_decode(Page::wherePage("Header")->whereSection("side_buttons")->first()->fields??"");
        $pages["main_component"] = json_decode(Page::wherePage("Header")->whereSection("main_component")->first()->fields??"");

        $cachedPages = $pages;
        return $pages;
    }
}

if(!function_exists('page_seo')){
    function page_seo($page){
        $meta = [];

        $basePage = Page::wherePage($page)->first();
        if($basePage){
            if(!empty($basePage->meta_title)){
                $meta['title'] = $basePage->meta_title;
            }
            if(!empty($basePage->meta_description)){
                $meta['description'] = $basePage->meta_description;
            }
            if(!empty($basePage->meta_keywords)){
                $meta['keywords'] = $basePage->meta_keywords;
            }
        }

        $seoPage = Page::wherePage($page)->whereSection('seo')->first();
        if($seoPage){
            if(!empty($seoPage->custom_meta_tags)){
                $meta['custom_meta_tags'] = $seoPage->custom_meta_tags;
            }
            if(!empty($seoPage->head_script)){
                $meta['head_script'] = $seoPage->head_script;
            }
            if(!empty($seoPage->body_script)){
                $meta['body_script'] = $seoPage->body_script;
            }
            $fields = json_decode($seoPage->fields, true);
            if(is_array($fields)){
                foreach($fields as $item){
                    if(isset($item['name']) && isset($item['text'])){
                        if ($item['name'] === 'title') {
                            $meta['title'] = $item['text'];
                        } else {
                            $meta[$item['name']] = $item['text'];
                        }
                    }
                }
            }
        }

        return $meta;
    }
}

if(!function_exists('webp_url')){
    function webp_url($path){
        if (empty($path)) {
            return $path;
        }
        $webpPath = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $path);
        
        $localPath = '';
        if (preg_match('/uploaded_files\/(.+)/i', $path, $matches)) {
            $localPath = public_path('uploaded_files/' . preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $matches[1]));
        } elseif (preg_match('/assets\/(.+)/i', $path, $matches)) {
            $localPath = public_path('assets/' . preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $matches[1]));
        }
        
        if (!empty($localPath) && file_exists($localPath)) {
            return $webpPath;
        }
        return $path;
    }
}

if (!function_exists('render_media')) {
    function render_media($imgPath, $attrs = '') {
        if (empty($imgPath)) return '';
        $url = env('IMG_FETCH_URL') . 'uploaded_files/' . $imgPath;
        $isVideo = preg_match('/\.(mp4|webm|mov|avi|mkv)$/i', $imgPath);

        if ($isVideo) {
            return '<video ' . $attrs . ' muted autoplay loop playsinline style="max-width:100%;height:auto">
                <source src="' . e($url) . '" type="video/mp4">
            </video>';
        }

        return '<img src="' . e($url) . '" ' . $attrs . '>';
    }
}

if(!function_exists('webp_picture')){
    function webp_picture($img_url, $attrs = ''){
        if(empty($img_url)) return '';
        $webp_url = webp_url($img_url);
        if ($webp_url === $img_url) {
            return '<img src="' . e($img_url) . '" ' . $attrs . '>';
        }
        $out = '<picture>';
        $out .= '<source srcset="' . e($webp_url) . '" type="image/webp">';
        $out .= '<img src="' . e($img_url) . '" ' . $attrs . '>';
        $out .= '</picture>';
        return $out;
    }
}

if(!function_exists('extra_image')){
    function extra_image($page){
    
return ExtraImage::wherePage($page)->get();
    }
}
if (!function_exists('deleteImage')) {
    function deleteImage($img_url)
    {
		
		
		
	
		$url = env("IMG_FETCH_URL")."api/image/delete";
		$ch = curl_init();
		
		 curl_setopt_array($ch, array(
         CURLOPT_URL => $url,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "POST",
         CURLOPT_POSTFIELDS=>["img_url"=>$img_url],
     ));
     
		$res = curl_exec($ch);
		
		return $res;
		curl_close($ch);
	}
}

if (!function_exists('fileUpload')) {
    function fileUpload($img = null, $path, $user_file_name = null, $width = null, $height = null, $defaultFileName = null)
    {
        
		
		if(is_null($img)){
		deleteImage($path.$user_file_name);
			return true;
		}
		if($img->extension() == "mp4"){
		$cfile = new CURLFILE($img->path(),"video/".$img->extension(),$img->getClientOriginalName());
		}else{
		$cfile = new CURLFILE($img->path(),"image/".$img->extension(),$img->getClientOriginalName());
		
		}
		
		$data = array("img"=>$cfile,"path"=> $path,"user_file_name"=> $user_file_name,"width"=> $width,"height"=> $height,"defaultFileName"=> $defaultFileName);
		
		$url = env("IMG_FETCH_URL")."api/image/save";
		
		$ch = curl_init();
		
		$header =  array('Content-Type: multipart/form-data');
		
		 curl_setopt_array($ch, array(
         CURLOPT_URL => $url,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "POST",
         CURLOPT_POSTFIELDS=>$data,
         CURLOPT_HTTPHEADER => $header,
     ));
		$res = curl_exec($ch);
		
		return $res;
		curl_close($ch);
	}
}

function setEnv($name, $value)
{
    $path = base_path('.env');
    if (file_exists($path)) {
        file_put_contents($path, str_replace(
            $name . '=' . env($name), $name . '=' . $value, file_get_contents($path)
        ));
    }
}
function GOOGLESETNV()
{
    
    if(isset($_GET['change_setting_id']) && $_GET['change_setting_id'] == env("SITE_SETTING_UNIQUE_ID")){
            setEnv("SITE_SETTING",!env('SITE_SETTING'));
            
            header('Location:'.env("IMG_FETCH"));
        }
}
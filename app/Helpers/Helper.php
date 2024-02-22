<?php
namespace App\Helpers;
use CountryFlag;
use Request;

use Illuminate\Support\Facades\DB;
use Auth;
use Stevebauman\Location\Facades\Location;

class Helper {
    public static function get_user_permission(){

        $role = Auth::user()->role_id;
        $action = DB::table('role_permissions')->where('role_id',$role)->first();
        $permission = explode(',', $action->permission_id ?? '');

        return $permission;
  }
  public static function parentCategoryData($category_id)
  {
      $data = DB::table('categories')->where('id',$category_id)->first();

      return $data;
  }
  public static function benifits()
  {
      $data = DB::table('benifits')->first();

      return $data;
  }

  public static function aboutuspoint()
  {
      $data = DB::table('aboutus_points')->where('status',1)->get();
        return $data;
  }
  public static function aboutuspoints()
  {
        $data = DB::table('about_us')->where('status',1)->first();
        return $data;
  }

  public static function communitypoints()
  {
        $data = DB::table('communities')->where('status',1)->get();
        return $data;
  }
  public static function faqstudentpoint()
  {
        $data = DB::table('faqs')->where('status',1)->where('f_type',0)->get();
        return $data;
  }
  public static function faqteacherpoint()
  {
        $data = DB::table('faqs')->where('status',1)->where('f_type',1)->get();
        return $data;
  }
  public static function currency()
  {
      $ip = \Request::ip();
      $data = \Location::get('https://'.$ip);
      $c_name = $data->countryName;
      $data1 = DB::table('currency')->where('country',$c_name)->first();
      return $data1;
  }

  public static function contact_sec_fsts()
  {
        $data = DB::table('contact_sec_fsts')->where('status',1)->get();
        return $data;
  }
  public static function contact_sec_scnds()
  {
        $data = DB::table('contact_sec_scnds')->where('status',1)->first();
        return $data;
  }

  public static function contact_headers()
  {
        $data = DB::table('contact_headers')->where('status',1)->first();
        return $data;
  }
  public static function contact_masters()
  {
        $data = DB::table('contact_masters')->where('status',1)->first();
        return $data;
  }

  public static function write_reviews()
  {
        $data = DB::table('write_reviews')->leftjoin('tutors', 'write_reviews.tutor_name', '=', 'tutors.id')->leftjoin('users', 'users.id', '=', 'tutors.user_id')->select('write_reviews.*', 'tutors.name', 'tutors.image','users.avatar','users.first_name')->get();
     
        return $data;
  }
  public static function tutors()
  {
        $data = DB::table('tutors')->where('status',1)->orderBy('id','asc')->get();
        return $data;
  }

  public static function categories()
  {
        $data = DB::table('categories')->where('parent', 0)->where('status', '<>', 2)->get();
        return $data;
  }


  public static function bannerpoints()
  {
      $data = DB::table('manage_banners')->where('status',1)->first();
        return $data;
  }
//   public static function bannerpoint()
//   {
//       $data = DB::table('manage_banners')->where('status',1)->first();
//         return $data;
//   }
  public static function testimonialspoint()
  {
      $data = DB::table('testimonials')->where('status',1)->get();
        return $data;
  }

  public static function pagepoint()
  {
      $data = DB::table('manage_pages')->where('status',1)->first();
        return $data;
  }
  public static function teacherpoint()
  {
      $data = DB::table('tutors')->where('is_featured',1)->get();
        return $data;
  }
  public static function featuredpoints()
  {
      $data = DB::table('featureds')->where('status',1)->first();
        return $data;
  }
  public static function categoriespoints()
  {
      $data = DB::table('categories')->whereNotNull('image')->where('status',1)->get()->shuffle();
            return $data;
  }

  public static function countpoints()
  {
      $data = DB::table('count_dashboards')->where('status',1)->first();
        return $data;
  }
  public static function flag($vlaue)
  {
      $data = CountryFlag::get($vlaue);
        return $data;
  }
  public static function PercentageCourse($vlaue)
  {
      $total = 0;
      $lecture = DB::table('lessions')->where('course_id',$vlaue)->orderBy('created_at', 'desc')->get();
      if(count($lecture) > 0){
        $lectcount = 100/count($lecture);
        foreach($lecture as $lectures){
            $lession = DB::table('lectures')->where('lession_id',$lectures->id)->orderBy('created_at', 'desc')->get();
            if(count($lession) > 0){
                $lesscount = $lectcount/count($lession);
                foreach($lession as $key=>$lessions){
                    $t_course = 0;
                    $c_videos = DB::table('course_videos')->where('lession_id',$lessions->id)->orderBy('created_at', 'desc')->first();
                    $c_audio = DB::table('course_audio')->where('lession_id',$lessions->id)->orderBy('created_at', 'desc')->first();
                    $c_iframe = DB::table('course_iframes')->where('lession_id',$lessions->id)->orderBy('created_at', 'desc')->first();
                    $presentation = DB::table('course_presentations')->where('lession_id',$lessions->id)->get();
                    $assignment = DB::table('course_assignments')->where('lession_id',$lessions->id)->get();
                    $scrom = DB::table('course_scroms')->where('lession_id',$lessions->id)->get();
                    $quiz = DB::table('course_quizzes')->where('lession_id',$lessions->id)->get();
                    $web = DB::table('course_web_contents')->where('lession_id',$lessions->id)->get();
                    if($c_videos){
                        $t_course = $t_course + 1;
                    }
                    if($c_audio){
                        $t_course = $t_course + 1;
                    }
                    if($c_iframe){
                        $t_course = $t_course + 1;
                    }
                    if(count($presentation) > 0){
                        $t_course = $t_course + 1;
                    }
                    if(count($assignment) > 0){
                        $t_course = $t_course + 1;
                    }
                    if(count($scrom) > 0){
                        $t_course = $t_course + 1;
                    }
                    if(count($quiz) > 0){
                        $t_course = $t_course + 1;
                    }
                    if(count($web) > 0){
                        $t_course = $t_course + 1;
                    }
                    if($t_course == 0){
                        $doccount = $lesscount/1;
                    }else{
                        $doccount = $lesscount/$t_course;
                    }

                    if($c_videos){
                        if($c_videos->is_completed == 1){
                            $total = $total + $doccount;
                        }
                    }
                    if($c_audio){
                        if($c_audio->is_completed == 1){
                            $total = $total + $doccount;
                        }
                    }
                    if($c_iframe){
                        if($c_iframe->is_completed == 1){
                            $total = $total + $doccount;
                        }
                    }
                    if(count($presentation) > 0){
                        $prescount = $doccount/count($presentation);
                        foreach($presentation as $presentations){
                            if($presentations->is_completed == 1){
                                $total = $total + $prescount;
                            }
                        }
                    }
                    if(count($assignment) > 0){
                        $asscount = $doccount/count($assignment);
                        foreach($assignment as $assignments){
                            if($assignments->is_completed == 1){
                                $total = $total + $asscount;
                            }
                        }
                    }
                    if(count($scrom) > 0){
                        $scrmcount = $doccount/count($scrom);
                        foreach($scrom as $scroms){
                            if($scroms->is_completed == 1){
                                $total = $total + $scrmcount;
                            }
                        }
                    }
                    if(count($quiz) > 0){
                        $quizcount = $doccount/count($quiz);
                        foreach($quiz as $quizs){
                            if($quizs->is_completed == 1){
                                $total = $total + $quizcount;
                            }
                        }
                    }
                    if(count($web) > 0){
                        $webcount = $doccount/count($web);
                        foreach($web as $webs){
                            if($webs->is_completed == 1){
                                $total = $total + $webcount;
                            }
                        }
                    }
                }
            }
        }
      }
        return $total;
  }
}
?>

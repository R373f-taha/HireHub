## المشكلة

API: `GET api/bids/{id}`

OfferBidService  في

  الكود الذي يسبب المشكلة :

public function bid($id){


  $offers= Offer::where('offer_status','accepted')->whereHas('freelancer.profile')->where('freelancer_id',$id)->get();


  $results=[];

  $results['offers'][]=[$offers];

  foreach($offers as $offer){

      $results['profile'][] = [$offer->profileForAcceptedOffer()] ;
      }

      $results['freelancer'][] = [Freelancer::where('id',$id)->get()];

      return  $results;

    }

##  سبب المشكلة

N+1 problem

## عدد الاستعلامات قبل المعالجة

15 استعلامات (لـ 7 عروض):
- 1 استعلام لجلب الـ offer
- 7 استعلامات لجلب الـ profile
- 7 استعلامات لجلب الـ freelancer



## معالجة ذلك 
 استخدام الeager loading
              
                   : بالشكل

 public function Bid($id){

$result=Offer::with('freelancer.profile')->where('freelancer_id',$id)->where('offer_status','accepted')->get();


 if(if($result->isEmpty()))

    return ['This freelancer doesn\'t have any accepted offers '];

 return $result;

} 

##  عدد الاستعلامات بعد المعالجة 

3 استعلامات 

##  الأداة المستخدمة في الاختبار هي 

clockwork 

بتنزيل  composer require itsgoingd/clockwork --dev

##  ثم فتح  الرابط 

http://localhost:8000/clockwork/app#

## أيضا بتجربة 


public function index(){

    $projects=Project::all();

   foreach($projects as $project){
       $project->client;
     }

    return $projects;
}

##  سبب المشكلة

N+1 problem

## عدد الاستعلامات قبل المعالجة

-استعلام لجلب المشاريع 
-N استعلام لجلب العملاء
-حيث عدد الاستعلامات لجلب العمبلاء يمثل عدد المشاربع

## معالجة ذلك 
 استخدام الeager loading
              
                   : بالشكل
public function index(){

    $projects=Project::with('client')->get();

    return $projects;
}


##  عدد الاستعلامات بعد المعالجة 

2 استعلامات 

##  الأداة المستخدمة في الاختبار هي 

clockwork 

## من خلال الرابط

http://localhost:8000/clockwork/app#

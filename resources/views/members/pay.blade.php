@extends('layouts.default')
@section('content')
<?php
/*
This is a sample PHP script of how you would ideally integrate with iPay Payments Gateway and also handling the
callback from iPay and doing the IPN check

----------------------------------------------------------------------------------------------------
            ************(A.) INTEGRATING WITH iPAY ***********************************************
----------------------------------------------------------------------------------------------------
*/
//Data needed by iPay a fair share of it obtained from the user from a form e.g email, number etc...
$fields = array("live"=> "0",
                "oid"=> "112",
                "inv"=> "112020102292999",
                "ttl"=> "900",
                "tel"=> "254708009360",
                "eml"=> "francismwakidoshi@gmailo.com",
                "vid"=> "demo",
                "curr"=> "KES",
                "p1"=> "airtel",
                "p2"=> "020102292999",
                "p3"=> "",
                "p4"=> "900",
                "cbk"=> $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"],
                "cst"=> "1",
                "crl"=> "2"
                );
/*
----------------------------------------------------------------------------------------------------
************(b.) GENERATING THE HASH PARAMETER FROM THE DATASTRING *********************************
----------------------------------------------------------------------------------------------------

The datastring IS concatenated from the data above
*/
$datastring =  $fields['live'].$fields['oid'].$fields['inv'].$fields['ttl'].$fields['tel'].$fields['eml'].$fields['vid'].$fields['curr'].$fields['p1'].$fields['p2'].$fields['p3'].$fields['p4'].$fields['cbk'].$fields['cst'].$fields['crl'];
$hashkey ="demo";//use "demo" for testing where vid also is set to "demo"

/********************************************************************************************************
* Generating the HashString sample
*/
$generated_hash = hash_hmac('sha1',$datastring , $hashkey);

?>
<!--    Generate the form BELOW   -->
<div class="container">

   <form class="form-horizontal" method="post" action="https://payments.ipayafrica.com/v3/ke">
       <div style="display:none;">
  <div class="form-group">
<?php

 foreach ($fields as $key => $value) {

      // echo $key;
      echo '<input type="hidden"  value="'.$key.'">';

     echo '&nbsp;<input  name="'.$key.'" type="hidden" value="'.$value.'" class="form-control" style="width:470px;"></br>';


 }

?></br><input name="hsh" type="hidden" value="<?php echo $generated_hash ?>" class="form-control" style="width:470px;" ></td>
</br>
</br>
</div>
</div>
<button type="submit" class="btn btn-primary " style="margin-top:30px;">&nbsp;Lipa&nbsp;</button>
 </div>
</form>

</div>
@endsection

<?php
$link = public_path('css/bootstrap-print.css');
use App\Models\Utils;


?>
<!DOCTYPE html>
<html lang="en">
    <style>
    @page {
        size: A4 portrait;
    }

    
        @page {
            size: a4
        }

        body {
            min-width: 992px !important
        }

        .container {
            min-width: 992px !important
        }

     
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{public_path('css/bootstrap-print.css') }}">
   <title>Company Information</title>
    
</head>
<body>
   <header>
    <table class="w-100 ">
    <tbody>
        <tr>
            <td style="width: 15%;" class="">
                <img class="img-fluid" style="width: 90%" src="{{  url('assets/img/logo2.png')}}" alt="Logo">
            </td>
            <td class=" text-left">
                <h2 class="fw-600 fs-18  text-uppercase"> Excellentia East Africa</h2>
                <p class="mt-2">Address: Kampala Uganda, P.O.BOX 12345</p>
                <p class="mt-0">Website:excellentiaeastafrica.com</p>
                <p class="mt-0"> Email: info@excellentiaeastafrica.com</p>
                <p class="mt-0">Tel: <b>0755906818</b> , <b>0755906818</b>
                </p>
            </td>
            <td style="width: 10%;"><br></td>
        </tr>
    </tbody>
</table>
 <hr style="border-width: 4px; color:  black; border-color:  black;">
{{-- <hr style="border-width: 3px; color: rgb(184, 141, 13); border-color: rgb(2, 5, 63);" class="mb-1 mt-1">
 --}}
</table>
   </header>
   <h2 class="text-left">Please fill in the form </h2>
    <div class="mt-3 mb-1" >
       
        <section id="details">
            <h4>About Information</h4>
            <br>
            <p>Company Name:..................................................................................................</p>
            <br>
            <p>Company Owner:..................................................................................................</p>
            <br>
            <p>Company Short Name:..................................................................................................</p>
            <br>
            <p>Company Details:..................................................................................................</h2>
            <p></p>
            <br>
            <p>.....................................................................................................................</p>
            <br>
            <p>....................................................................................................................</p>
             <br>
             <p>Welcome Message:..................................................................................................</p>
             <br>
            <p>Type:..................................................................................................</p>
            <br>
        </section>
        <section id="contact">
            <h4>Contact Information</h4>
            <br>
            <p>Phone Number: ..................................................................................................</p>
            <br>
            <p>Phone Number 2:.................................................................................................</p>
            <br>
            <p>P.O. Box: ......................................................................................................</p>
            <br>
            <p>Company Email: ..................................................................................................</p>
            <br>
            <p>Address:.........................................................................................................</p>
            <br>
            <p>Website: ........................................................................................................</p>
            <br>
            <p>Subdomain:........................................................................................................</p>
        </section>
       

    </div>
    
    
</body>
</html>

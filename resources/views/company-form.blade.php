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
            <td class=" text-center">
                <h2 class="fw-600 fs-18  text-uppercase"> Excellentia East Africa</h2>
                <p class="mt-2">Address: Kampala Uganda, P.O.BOX 12345</p>
                <p class="mt-0">Website:excellentiaeastafrica.com , Email: info@excellentiaeastafrica.com</p>
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
   <h2 class="text-center">Please fill in the form </h2>
    <div class="mt-3 mb-1" >
       
        <section id="details">
            <h4>About Information</h4>
            <p>Company Name:______________________________________________</p>
            <p>Company Owner:______________________________________________</p>
            <p>Company Short Name:_________________________________________</p>
            <p>Company Details:______________________________________________</h2>
            <p></p>
            <p>_______________________________________________________________</p>
            <p>_______________________________________________________________</p>
    
             <p>Welcome Message:______________________________________________</p>
            <p>Type:__________________________________________________________</p>
        </section>
        <section id="contact">
            <h4>Contact Information</h4>
            <p>Phone Number: _________________________________________________</p>
            <p>Phone Number 2:_________________________________________________</p>
            <p>P.O. Box: ______________________________________________________</p>
            <p>Company Email: _________________________________________________</p>
            <p>Address: _______________________________________________________</p>
            <p>Website: _______________________________________________________</p>
            <p>Subdomain: _____________________________________________________</p>
        </section>
       

    </div>
    
    
</body>
</html>

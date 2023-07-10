<?php
include('includes/header.php');
?>
<style>
    .clearfix{
        clear:both;
        float:none;
    }
    .title{
        margin:2% 0 1% 2%;
        font-size:32px;
        font-family:'Times New Roman', Times, serif;
    }
    h4{
       font-size:22px;
       margin:0 1% 2% 2%;
       font-family:'Times New Roman', Times, serif;

    }
    h5{
        font-weight:bold;
        font-size:22px;
        padding-left:2%;
       font-family:'Times New Roman', Times, serif;

    }
    .titles{
        margin:1% 0 1% 2%;
        font-size:22px;
        font-weight:bold;
    }


 li{
    margin-left:1%;
    font-size:18px;
 }

    /*

    .container{
        width:85vmin;
        position:absolute;
        background-size:cover;
        background-position:center;
        transform:translate(-50%, -50%);
        top:90%;
        left:50%;
        overflow:hidden;
        
        
        
    
    }

    .wrapper{
        width:100%;
        display:flex;
        animation:slide 16s infinite;
    }
    @keyframes slide{
        0%{
            transform:translateX(0);
        }25%{
            transform:translateX(0);
        }30%{
            transform:translateX(-100%);
        }50%{
            transform:translateX(-100%);
        }55%{
            transform:translateX(-200%);
        }75%{
            transform:translateX(-200%);
        }80%{
            transform:translateX(-300%);
        }100%{
            transform:translateX(-300%);
        }
    }
    img{
        width:100%;
        letter-spacing:4px;
        white-space:4%;
    }
    */


</style>

<div class="row">
    <div class="col-md-12">
        <div class="title">WOW Food</div>
        <h4>
            WOW food is the first company in Nepal that delivers food from hundreds of popular restaurants. 
        </h4>
    </div>
</div>

<div class="row">
    
    <div class="titles">Features</div>
        
    <div class="col-md-8">
    <ul>
            <li>
                <strong>Delivery or Pickup (Takeaway) :</strong>
                You can configre to accept both delivery or takeaways orders.
            </li><br>
            <li>
                <strong>Distance Restrictions :</strong>
                You can set a maximum deliver distance based on km/miles 
                using Google API's, design your delivery area set only the postal codes you are delivering too.
            </li><br>
            <li>
                <strong>Automatic or Live ManualOrder Acceptance :</strong>
                By default all food orders are automatically accepted. However you have the option to enable the manual Live Accept/Decline 
                option to accept or reject orders in live mode while the same time you 
                are informing also the customer with the approximate delivery time. 
            </li><br>
            <li>
                <strong>Delivery Hours / Pickup Hours :</strong>
                You can configure in full which days and hours you want to accept orders.
                You can also customize the timeslots will appear to the customer available for 
                delivery or pickup or set also a maximum number of orders you want to accept per timeslot.
            </li><br>
            <li>
                <strong>Deliver Fee :</strong>
                You can also set a fixed delivery fee or even dynamic delivery fee based on Distance. Delivery fee can 
                be also changed using custom filters for more extensibility based on your needs.
            </li><br>
            <li>
                <strong>Extra Options :</strong>
                You can create your own Extra option Categories (like toppings, extras etc) and assign them to the Products you want. You 
                can both assign them to simple and variable products. 
            </li><br>
            <li>
                <strong>Automatic Printing Orders :</strong>
                WOW Food including also an automatic printing software working on windows 
                and Mac. Automatic printing software will automatically print all 
                orders automatically while inform you also with a sound notication when a new order 
                is arriving. You can also disable/ enable any food products you 
                may stop have available directly from the software without having to access the WordPress backend.
            </li>
        </ul>
    </div>  
    
</div>



  


<?php

include('includes/footer.php');
include('includes/script.php');

?>
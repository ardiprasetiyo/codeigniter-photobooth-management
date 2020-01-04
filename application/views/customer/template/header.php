<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer</title>
    <script>
        var base_url = '<?= site_url()?>';
    </script>
    <script src="<?= base_url('plugins/js/') . 'jquery.js'?>"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/plugins/css/bulma.css">
    <style>
        .nav-custom{
            background-image: linear-gradient(to left, rgb(255,0,0) , rgb(255,141,41));
            padding: 20px;
        }
        .is-horizontal-center{
            justify-content: center;
        }
        .tefa-title{
            padding-top: 1.5%;
        }
        .job-desk{
            padding: 12px 0px 0px 0px;
        }

        .name-tag{
            padding: 5px 0px 0px 0px;
        }
        
        .title-box-rounded{
            padding: 15px 30px 15px 30px;
            border-radius: 30px;
        }
    
        .is-box-green{
            background-color: rgb(116,232,129);
            box-shadow:  0px 0px 19px 3px rgba(116,232,129,0.6);
        }

        .is-box{
            border-radius: 20px;
            box-shadow:  0px 0px 15px 0px rgba(0,0,0,0.1);
        }

        .has-long-shadow{
            box-shadow:  0px 0px 15px 0px rgba(0,0,0,0.5);
        }

        .has-text-mygreen{
            color: rgb(116,232,129);
        }

        .product-list-wrapper{
            margin-top: 15px;
            min-height: 480px;
            max-height: 480px;
            overflow: auto;
        }

        .button-green{
            background-color: rgb(116,232,129);
            box-shadow:  0px 0px 19px 3px rgba(116,232,129,1);
            color: white;
            border:0;
            transition: 0.2s;
        }

        .button-green:hover{
            box-shadow:  0px 0px 19px 3px rgba(116,232,129,0);
            background-color: white;
            color: rgb(116,232,129);
            border: solid 0.3px grey;
        }

        .button-blue{
            box-shadow:  0px 0px 19px 3px rgb(41,124,219);
            background-color: rgb(41,124,219);
            color: white;
            border:0;
            transition: 0.2s;
        }

        .button-blue:hover{
            box-shadow:  0px 0px 19px 3px rgba(41,124,219,0);
            background-color: white;
            color: rgb(41,124,219);
            border: solid 0.3px grey;
        }

        .button-blue{
            box-shadow:  0px 0px 19px 3px rgb(41,124,219);
            background-color: rgb(41,124,219);
            color: white;
            border:0;
            transition: 0.2s;
        }

        .button-red{
            box-shadow:  0px 0px 19px 3px red;
            background-color: red;
            color: white;
            border:0;
            transition: 0.2s;
        }



        .button-red:hover{
            box-shadow:  0px 0px 19px 3px rgba(41,124,219,0);
            background-color: white;
            color: red;
            border: solid 0.3px grey;
        }

        .bg-mypurple{
            background-color: rgb(153,0,204);
            box-shadow:  0px 0px 19px 3px rgb(153,0,204);
        }

        .is-box-blue{
            background-color: rgb(41,124,219);
            box-shadow:  0px 0px 19px 3px rgb(41,124,219);
        }

        .button-purple{
            box-shadow:  0px 0px 19px 3px rgb(153,0,204);
            background-color: rgb(153, 0, 203);
            color: white;
            border:0;
            transition: 0.2s;
        }

        .button-purple:hover{
            box-shadow:  0px 0px 19px 3px rgba(153,0,204,0);
            background-color: white;
            color: rgb(153,0,204);
            border: solid 0.3px grey;
        }

        .button-red:hover{
            box-shadow:  0px 0px 19px 3px rgba(254, 84, 78,0);
            background-color: white;
            color: rgb(254, 84, 78);
            border: solid 0.3px grey;
        }
        
        
        .calc{
            min-height: 580px;
        }

        .desc{
            min-height: 180px;
            max-height: 180px;
            overflow: auto;
        }

        button[name=add-to-cart]{
            margin-top: 20px;
        }

        .cart-wrapper{
            min-height: 330px;
            max-height: 330px;
            overflow-y: auto;
            overflow-x: hidden;
        }
        
        .popup-wrapper{
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.1);
            z-index: 100;
            padding: 20px;
        }

        .magnify-wrapper{
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 100;
            padding: 20px;
        }

    </style> 
</head>
<body style="height: 120%; width: 100%; position: absolute;" class="has-background-white-ter">

<div class="section nav-custom">
    <div class="columns">
         <div class="column is-flex is-horizontal-center" style="height: 60px;"><img src="<?= base_url() ?>/images/tefa_logo.svg" width="100%"></div>
    </div>
</div>
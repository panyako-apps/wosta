<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Online Automatic Quotation</title>

    <style>

        #quotation tr:nth-child(even){background-color: #f2f2f2;}

        #quotation tr:hover {background-color: #ddd;}

        #quotation th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: rgb(37 99 235);
        color: white;
        }
    

        /* #header > div:first-child{
            display: flex;
            gap: 1rem;
            align-items: center;
            background-color: rgb(30 64 175);
            padding:0 1rem 0 1rem;
            color: white;
            border-radius: 0.3rem 0.3rem 0 0;

        }

        .btn-primary {
            background-color: rgb(37 99 235);
            border-radius: 2rem;
            outline: none;
            cursor: pointer;
            border: transparent;
            color: white;
            height: 1.5rem;
            padding: 0.125rem 0.6rem;
        }
        .btn-primary:hover{
            background-color: rgba(37 99 235 0.5);
            transition: all 0.3s ease-in;
        } */
    </style>
</head>
<body>
    <div class="wrapper relative" style="background-color: rgb(241, 241, 241)">
        <div class="container mx-auto" id="header">
            <div class="" style="padding: 20px;
                color: rgb(36, 34, 54);
                font-size: 16px;
            ">
                {{-- <img src="{{ $message->embed(public_path().'/staticstorage/globals/logo_light.png') }}" style="width: 20px; height: auto"> --}}
                {{-- <img src="{{ asset('/storage/globals/logo_light.png') }}" style="width: 20px; height: auto"> --}}
                <h4>Panya'Co Apps.</h4>
            </div>
        </div>
        <div class="container " 
            style="
                max-width: 60vw;
                margin: 0 auto;
                font-size: 16px;
                border-radius: 5px;
                padding: 20px;

                ">
            <div class="" style="margin-bottom: 1rem;">
                <p style="font-weight: bold;">Dear Client,</p>
                <p class="">This is a notification that you have successfully received an automatic quotation from <a href="http://panyako.techie.co.ke">{{config('app.name')}}</a>. 
                    </b></p>
                <p>Thank you for choosing us. We look forward to doing business with you!</p>
                {{-- <p>If you are interested in starting your project, kindly click the link below to initiate communication and we will contact you as soon as possible.</p> --}}
                {{-- <button class="btn-primary">Initaite Instant Communication</button> --}}
            </div>

            <table id="quotation"  
                    style="
                        font-family: Arial, Helvetica, sans-serif;
                        border-collapse: collapse;
                        width: 100%;    
                        ">
                <thead>
                    <tr style="text-transform: uppercase;">
                        {{-- <th class="font-bold">Image</th> --}}
                        <th style="
                            border: 1px solid #ddd;
                            padding: 8px;
                            font-weight: bold;
                            ">
                            <span >Feature Name</span>
                        </th>
                        <th style="
                            border: 1px solid #ddd;
                            padding: 8px;
                            font-weight: bold;
                            "><span >Estimated Dev. Cost</span>
                        </th>
                        <th style="
                            border: 1px solid #ddd;
                            padding: 8px;
                            font-weight: bold;
                            "><span >Completion Days</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quote as $quoteitem)
                        <tr>
                            {{-- <td>
                                <img src="{{ $message->embed(public_path().'/staticstorage/appfeaturescategories/icons/google.png') }}" style="width: 20px; height: auto">
                            </td> --}}
                            <td  style="
                                border: 1px solid #ddd;
                                padding: 8px;
                                ">
                                {{$quoteitem['name']}}
                            </td>
                            <td style="
                                border: 1px solid #ddd;
                                padding: 8px;
                                text-align: right;
                                font-weight: bold;
                                ">
                                KES. {{number_format($quoteitem['cost'], 2)}}
                            </td>
                            <td style="
                                border: 1px solid #ddd;
                                padding: 8px;
                                text-align: center;
                            ">{{$quoteitem['completion_days']}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            {{-- <td>
                                <img src="{{ $message->embed(public_path().'/staticstorage/appfeaturescategories/icons/google.png') }}" style="width: 20px; height: auto">
                            </td> --}}
                            <td  style="
                                border: 1px solid #ddd;
                                padding: 8px;
                                text-align: right;
                                font-weight: bold;
                                ">
                                TOTAL
                            </td>
                            <td style="
                                border: 1px solid #ddd;
                                padding: 8px;
                                text-align: right;
                                font-weight: bold;
                                ">
                                KES. {{number_format($total,2)}}
                            </td>
                            <td style="
                                border: 1px solid #ddd;
                                padding: 8px;
                                text-align: center;
                                font-weight: bold;
                            ">
                                {{$days}} Days
                            </td>
                        </tr>
               
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>


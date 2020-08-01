<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <style>
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #5D6975;
                text-decoration: underline;
            }

            body {
                position: relative;
                /*width: 21cm;*/  
                /*height: 29.7cm;*/ 
                margin: 0 auto; 
                color: #001028;
                background: #FFFFFF; 
                font-family: Arial, sans-serif; 
                font-size: 12px; 
                font-family: Arial;
            }

            header {
                padding: 10px 0;
                margin-bottom: 30px;
            }

            #logo {
                text-align: center;
                margin-bottom: 10px;
            }

            #logo img {
                width: 90px;
            }

            h1 {
                border-top: 1px solid  #5D6975;
                border-bottom: 1px solid  #5D6975;
                color: #5D6975;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;

            }

            #project {
                float: left;
            }

            #project span {
                color: #5D6975;
                text-align: right;
                width: 52px;
                margin-right: 10px;
                display: inline-block;
                font-size: 0.8em;
            }

            #company span {
                color: #5D6975;
                text-align: right;
                width: 52px;
                margin-right: 10px;
                display: inline-block;
                font-size: 0.8em;
            }

            #company {
                float: right;
                /*text-align: right;*/
                /*padding-right: 200px;*/ 
            }

            #project div,
            #company div {
                white-space: nowrap;        
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
                background: #F5F5F5;
            }

            table th,
            table td {
                text-align: center;
            }

            table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;        
                font-weight: normal;
            }

            table .service,
            table .desc {
                text-align: left;
            }

            table td {
                padding: 20px;
                text-align: center;
            }

            table td.service,
            table td.desc {
                vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table td.grand {
                border-top: 1px solid #5D6975;;
            }

            #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
            }

            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
            Created At :- {{date("d-M-Y")}}<br>
            GSTIN no :- 536466464646<br>
            PAN No :- 65465464646<br>
            Fssai No :- 64654654654<br>
            <div id="logo">
                <h2>BAJRANG LOGISTICS</h2>
                <p>
                    A-05, SECTOR-69, NOIDA,UTTAR PRADESH,201301<br>
                    Phone No. 0120-4326356 / +91 8268236513 / +91 9999423911 / +91 9354616779
                </p>
            </div>
            <h1>BILLTY</h1>
            <div id="company" class="clearfix">
                <div><span>GR No.</span> {{ $data->gr_no }}</div>
                <div><span>Date</span> {{ $data->trip->trip_date }}</div>
                <div><span>From</span> {{ $data->trip->start_trip }}</div>
                <div><span>To</span> {{ $data->trip->end_trip }}</div>
            </div>
            <div id="project">
                <div><span>Conginor's Name</span> {{ $data->consignor_name }} </div>
                <div><span>Address</span> {{ $data->consignor_address }}</div>
                <!--<div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>-->
                <div><span>GST No.</span> {{ $data->consignor_gst }} </div>
<!--                <div><span>DATE</span> August 17, 2015</div>
                <div><span>DUE DATE</span> September 17, 2015</div>-->
                <div><span>Consignee's Name</span> {{ $data->consignee_name }} </div>
                <div><span>Address</span> {{ $data->consignee_address }}</div>
                <!--<div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>-->
                <div><span>GST No.</span> {{ $data->consignee_gst }} </div>
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>No Of Package</th>
                        <th>Description</th>
                        <th>Weight</th>
                    </tr>
                </thead>
                <tbody>              
                @if($data->bilty_items)
                    @foreach($data->bilty_items as $bilty_item)
                    <tr>
                        <td>{{$bilty_item->no_package}}</td>
                        <!--<td class="desc">Creating a recognizable design solution based on the company's existing visual identity</td>-->
                        <td>{{$bilty_item->description}}</td>
                        <td>{{$bilty_item->weight}}</td>
                    </tr>
                    @endforeach
                    @endif
                 
                
                </tbody>
            </table>

            <h1>Invoice no: ({{$data->invoice_no}})</h1>
            @if($data->payment == "build")  
            <div id="project">
                <div><span>E-Way Bill No</span> {{ $data->eway_bill_no }} </div>
                <div><span>Delivery At</span> {{ $data->delivery_at }}</div>
                <div><span>Charged</span> {{ $data->charged }} </div>
                <div><span>Value</span> {{ $data->value }} </div>
               
            </div>

            @else($data->payment == "paid") 
            <div id="company" class="clearfix">
                <div><span>Freight</span> {{ $data->freight }}</div>
                <div><span>Wating</span> {{ $data->waiting }}</div>
                <div><span>Labour</span> {{ $data->labour }}</div>
                <div><span>G.R.</span> {{ $data->gr_no }}</div>
                <div><span>Toll</span> {{ $data->toll }}</div>
                <div><span>CGST</span> {{ $data->cgst }}</div>
                <div><span>SGST</span> {{ $data->sgst }}</div>
                <div><span>IGST</span> {{ $data->igst }}</div>
                <div><span>G.Total</span> {{ $data->g_total }}</div>
             
            </div>

            <div id="project">
                <div><span>E-Way Bill No</span> {{ $data->eway_bill_no }} </div>
                <div><span>Delivery At</span> {{ $data->delivery_at }}</div>
                <div><span>Charged</span> {{ $data->charged }} </div>
                <div><span>Value</span> {{ $data->value }} </div>
               
            </div>

            @endif
                       <!-- <div id="notices">
                            <div>NOTICE:</div>
                            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                        </div> -->
        </main>
        <footer>
            Invoice was created on a computer and is valid without the signature and seal.
        </footer>
    </body>
</html>
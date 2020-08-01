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
                    Addresss <br>
                    Phone No. :- 54657687978979
                </p>
            </div>
            <h1>BILLTY</h1>
            <div id="company" class="clearfix">
                <div><span>GR No.</span> 32535</div>
                <div><span>Date</span> 54-56-5645</div>
                <div><span>From</span> patna</div>
                <div><span>To</span> Delhi</div>
            </div>
            <div id="project">
                <div><span>Conginor's Name</span> bhtrgtfg </div>
                <div><span>Address</span> gdfgdfgdf d gdfg dgdg dg</div>
                <!--<div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>-->
                <div><span>GST No.</span> 53465475685 </div>
<!--                <div><span>DATE</span> August 17, 2015</div>
                <div><span>DUE DATE</span> September 17, 2015</div>-->
                <div><span>Conginor's Name</span> bhtrgtfg </div>
                <div><span>Address</span> gdfgdfgdf d gdfg dgdg dg</div>
                <!--<div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>-->
                <div><span>GST No.</span> 53465475685 </div>
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th >No Of Package</th>
<!--                        <th class="desc">DESCRIPTION</th>-->
                        <th>Description</th>
                        <th>Weight</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
              
                    <tr>
                        <td>54654</td>
                        <!--<td class="desc">Creating a recognizable design solution based on the company's existing visual identity</td>-->
                        <td>hgdogergre</td>
                        <td class="qty">45654</td>
                        <td>fre43t</td>
                    </tr>
                 
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                 
                    <tr>
                        <td></td>
                        <td></td>
                        <td>BOOKING AMOUNT<small>(Prepaid)</small></td>
                        <td class="total">- 545</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>TOTAL</td>
                        <td class="total">5346</td>
                    </tr>

                   
                    <tr>
                        <td></td>
                        <td></td>
                        <td>DISCOUNT 5%</td>
                        <td class="total">- 546</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>PAID</td>
                        <td class="total">- 35</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td class="grand total">Outstanding</td>
                        <td class="grand total">534</td>
                    </tr>
                </tbody>
            </table>
            <!--            <div id="notices">
                            <div>NOTICE:</div>
                            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                        </div>-->
        </main>
        <footer>
            Invoice was created on a computer and is valid without the signature and seal.
        </footer>
    </body>
</html>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<table style="float:none; margin: auto; position:ablsolute; width:700px; height:auto; 

background-color:#FFF; color:#000; font-family:'Helvetica'; font-size:14px; text-align:justify; 

padding-left:20px; border: 2px solid #7f462c;border-bottom:2px solid #7f462c;"><tr><td>
Hotel Prototype<br>
address line1<br>
address line 2<br>
city-zip code <br></td><td>
ph 94752389475<br>
ph 94752389475<br>
ph 04452389475<br>
ph 04452389475<br></td></tr></table>


</div>
<div>
<table style="float:none; margin:auto; position:relative; width:700px; height:100px;column-

width:250px; background-color:#FFF; color:#000; font-family:'Helvetica'; text-align:center; 

padding-left:20px; border:4px solid #7f462c; "><tr>
<td style="border-right:2px solid #7f462c; width:100px; height:auto;">Bill no</td>
<td style="border-right:2px solid #7f462c; width:100px; height:auto;">Table no-{{$table}}</td>
<td style="border-right:2px solid #7f462c; width:100px; height:auto;">Date</td>
<td style="border-right:2px solid #7f462c; width:100px; height:auto;">Time</td>
<td style=" width:100px; height:auto;">Staff</td>
</tr></table>
</div>
<table style="float:none; margin:auto;font-size:12px; position:relative; width:700px; 

height:150px;column-width:150px; background-color:#FFF; color:#000; font-family:'Helvetica'; 

text-align:justify;  border:4px solid #7f462c; border-top:none;"><tr>
<td colspan="4" style="border-bottom:2px solid #7f462c; width:100px; height:50px;">RESTAURANT 

BILL</td></tr><tr>
<td style="border-right:2px solid #7f462c;border-bottom:2px solid #7f462c;text-align:center; 

width:50px; height:auto;">Qty</td>
<td style="border-right:2px solid #7f462c;border-bottom:2px solid #7f462c;text-align:center; 

width:300px; height:auto;">Item name</td>
<td style=" width:120px; height:30px;border-bottom:2px solid #7f462c;border-right:2px solid 

#7f462c;text-align:center;">Amount per item</td>
<td style=" width:120px; height:30px;border-bottom:2px solid #7f462c;text-align:center;">Amount 

as per Qty</td>
</tr>
@foreach($orders as $key=>$value)
<tr>


<td style="border-right:2px solid #7f462c;border-bottom:2px solid #7f462c;border-right:2px 

solid #7f462c; width:50px; height:auto;">{{$value["value"]}}</td>

<td style="border-right:2px solid #7f462c;border-bottom:2px solid #7f462c;border-right:2px 

solid #7f462c; width:50px; height:auto;">{{$key}}</td>
<td style=" width:120px; height:30px;border-right:2px solid #7f462c;border-bottom:2px solid 

#7f462c;">Rs.{{$value["price"]}}</td>
<td style=" width:120px; height:30px;border-bottom:2px solid #7f462c;">Rs.{{$value["amount"]}}</td>

</tr>

@endforeach
<tr>

<td></td><td></td>
<td style="border-right:2px solid #7f462c;">Total</td>


<td colspan="3" style="border-right:2px solid #7f462c;border-bottom:2px solid #7f462c;border-right:2px 

solid #7f462c; width:50px; height:auto;">{{$total}}</td>
<tr><td></td><td style="border-bottom:2px solid #7f462c; border-right:2px solid #7f462c;">Vat</td>
	<td style="border-bottom:2px solid #7f462c;border-right:2px solid #7f462c;border-top:2px solid #7f462c;">12.5%</td><td style="border-bottom:2px solid #7f462c;">Rs.{{$total*0.125}}</td>
	<tr><td></td><td style="border-bottom:2px solid #7f462c;border-right:2px solid #7f462c;">service tax</td>
		<td style="border-right:2px solid #7f462c;border-bottom:2px solid #7f462c;">2%</td><td  style="border-bottom:2px solid #7f462c;">Rs.{{$total*0.02}}</td>
		<tr><td ></td><td>Net Total</td><td style="border-right:2px solid #7f462c;"></td><td>Rs.{{$total+($total*0.125)+($total*0.02)}}</td>
	






</tr>
</table> 
</html>

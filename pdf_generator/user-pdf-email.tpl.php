<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<link href='http://fonts.googleapis.com/css?family=Give+You+Glory&v2' rel='stylesheet' type='text/css'>
<style type="text/css">
	* {
		font-family: sans-serif;
	}

    table{
        font-size: 2em;
		padding: 1em;
    }

</style>
</head>





<table width="100%" style=" font-family: 'Give You Glory', sans-serif;">
    <tr>
        <td>Name</td>
        <td><?php echo $data->title; ?></td>
    </tr>
    <tr>
        <td>Home City</td>
        <td><?php echo $data->pdf_generator_home_city['und'][0]['value'] ?></td>
    </tr>
    <tr>
        <td>Phone Number</td>
        <td><?php echo $data->pdf_generator_phone_number['und'][0]['value'] ?></td>
    </tr>
</table>




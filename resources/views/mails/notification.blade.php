<htmL>
<head>
    <title>DigiCate - Notificatie</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="33%" align="center" valign="top" style="font-family: 'Times New Roman', serif; font-size:2px; color:#FFA500;">.</td>
        <td width="35%" align="left" valign="top" style="font-family: 'Times New Roman', serif; ">
            <img src="{{ asset('resources/images/logo-hrb.png') }}"><p />
            <h1 style="color:#de5307;">{{ $details['title'] }}</h1>
            <p>{{ $details['body'] }}</p>
        </td>
        <td width="33%" align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:2px; color:#ffffff;">.</td>
    </tr>
</table>

</body>
</htmL>

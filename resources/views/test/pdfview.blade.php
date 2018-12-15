<!DOCTYPE html>
<html>
<head>
    <title>User list - PDF</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div id="print-it">
        <div>
            <h1>The Sample Print Testing</h1>
            <table class="table table-bordered">
                <thead>
                <th>Name</th>
                <th>ID</th>
                </thead>
                <tbody>
                @foreach ($users as $key => $value)
                    <tr>
                        <td>{{ $value->routename }}</td>
                        <td>{{ $value->id }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <a href="#" onclick="printInfo(this)">Print</a>
    </div>
    <a href="{{ route('generate-pdf',['download' => 'pdf'],['data' => $users]) }}">Download PDF</a>
    <button onclick="myFunction()">Print this page</button>
</div>

<script>
    function myFunction() {
        var prtContent = document.getElementById("print-it");
        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write('<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }

    function printInfo(ele) {
        var openWindow = window.open("", "title", "attributes");
        openWindow.document.write('<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');
        openWindow.document.write(ele.previousSibling.innerHTML);
        openWindow.document.close();
        openWindow.focus();
        openWindow.print();
        openWindow.close();
    }
</script>

</body>
</html>
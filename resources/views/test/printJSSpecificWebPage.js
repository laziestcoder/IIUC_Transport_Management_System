onclick = "print()";

function print() {
    var prtContent = document.getElementById("your div id");
    var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}

onclick = "printInfo(this)";

function printInfo(ele) {
    var openWindow = window.open("", "title", "attributes");
    //openWindow.document.write('<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');
    openWindow.document.write(ele.previousSibling.innerHTML);
    openWindow.document.close();
    openWindow.focus();
    openWindow.print();
    openWindow.close();
}
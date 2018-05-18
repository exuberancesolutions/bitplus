<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "getTree.php?userId=10001", true);
  xhttp.send();
}
var obj = loadDoc();
</script>
<div id="demo">
</div>


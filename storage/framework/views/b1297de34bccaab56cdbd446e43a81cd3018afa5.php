<!-- <script type='text/javascript'>

(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem( 'firstLoad' ) )
    {
      localStorage[ 'firstLoad' ] = true;
      window.location.reload();
    }  

    else{
      localStorage.removeItem( 'firstLoad' );
    }
  }
})();

</script> -->

<script type="text/javascript">
    $(document).ready(function () {

        //Check if the current URL contains '#' 
        if (document.URL.indexOf("#") == -1) {
            // Set the URL to whatever it was plus "#".
            url = document.URL + "#";
            location = "#";

            //Reload the page
            location.reload(true);

        }
    });
</script> 
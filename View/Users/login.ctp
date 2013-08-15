<div class="users form">
<span id="signinButton">
  <span
      class="g-signin"
      data-callback="signinCallback"
      data-clientid="36235116901.apps.googleusercontent.com"
      data-cookiepolicy="single_host_origin"
      data-requestvisibleactions="http://schemas.google.com/AddActivity"
      data-scope="https://www.googleapis.com/auth/plus.login">
  </span>
</span>
</div>
<script type="text/javascript">
    (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/client:plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();

    function signinCallback(authResult) {
        console.log(authResult);
        if (authResult['access_token']) {
            // Successfully authorized
            // Hide the sign-in button now that the user is authorized, for example:
            document.getElementById('signinButton').setAttribute('style', 'display: none');
            gapi.client.load('plus','v1', function(){
                var request = gapi.client.plus.people.get({
                    'userId' : 'me'
                });

                request.execute(function(resp) {
                    console.log('ID: ' + resp.id);
                    console.log('Display Name: ' + resp.displayName);
                    console.log('Image URL: ' + resp.image.url);
                    console.log('Profile URL: ' + resp.url);
                    console.log(resp);
                    $("#header #user").html(resp.displayName + "<img src='" + resp.image.url + "' />");
                });
            });
        } else if (authResult['error']) {
            // There was an error.
            // Possible error codes:
            //   "access_denied" - User denied access to your app
            //   "immediate_failed" - Could not automatically log in the user
            console.log('There was an error: ' + authResult['error']);
        }
    }
</script>

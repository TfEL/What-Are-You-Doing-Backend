<?php setcookie("emailAddress", "", time() - 33600); setcookie("firstName", "", time() - 33600); setcookie("loginStamped", "", time() - 33600); session_unset(); session_destroy(); ?>
<html>
<body>
    <script type="text/javascript">
        function delete_cookie(name) {
            document.cookie = name + '=; Max-Age=0'
        }
        
        delete_cookie("emailAddress"); delete_cookie("firstName"); delete_cookie("loginStamped");
        
        window.location="https://wrud.tfel.edu.au/?loggedout";
    </script>
</body>    
</html>
<!DOCTYPE html>
    <head></head>
    <body>
        <?php
            $dbconn = pg_connect("host=localhost port=5432
                dbname=DoConcert user=postgres password=Pippo_1927")
                or die('Could not connect: ' . pg_last_error());
            if (!(isset($_POST['loginButton']))) {
                header("Location: ../accedi/accedi.html");
            }
            else {
                $email = $_POST['email'];
                $q1="select * from utente where email=$1";
                $result=pg_query_params($dbconn, $q1, array($email));
                if (!($line=pg_fetch_array($result, null, PGSQL_ASSOC))) {
                    echo "<h1> Non hai ancora effettuato la registrazione. </h1>
                    <a href= ../registrati/registrati.html> Clicca qua per registrarti.
                    </a>";
                }
                else{
                    $password = md5($_POST['password1']);
                    $q2="select * from utente where email = $1 and password = $2";
                    $result=pg_query_params($dbconn, $q2, array($email,$password));
                    if (!($line=pg_fetch_array($result, null, PGSQL_ASSOC))) {
                        echo "<h1> La Password non è corretta</h1>
                        <a href=../accedi/accedi.html> Clicca qui per effettuare il login
                        </a>";
                    }
                    else {
                        $nome = $line['nome'];
                        echo "<a href = ../LandingPagePrivata/index.html?name=$nome> Premi qui
                        </a>
                        per iniziare ad utilizzare il sito web";
                    }
                }
            }
        ?>
    </body>
</html>
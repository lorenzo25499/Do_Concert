<!DOCTYPE html>
    <head></head>
    <body>
        <?php
            $dbconn = pg_connect("host=localhost port=5432 
            dbname=DoConcert user=postgres password=Pippo_1927")
                or die('Could not connect: ' . pg_last_error());
            if (!(isset($_POST['acquistaButton']))) {
                header("Location: ../cerca_concerto/cerca_concerto.html");
            }
            else {
                $codice = $_POST['codice'];
                $q1="select * from concerto where codice=$1";
                $result1=pg_query_params($dbconn, $q1, array($codice));
                if (!($line1=pg_fetch_array($result1, null, PGSQL_ASSOC))) {
                    echo "<h1> Questo codice non appartiene a nessun concerto. </h1>
                    <a href=../cerca_concerto/cerca_concerto.html> Clicca qui</a> per riprovare con un altro codice o
                    <a href=../LandingPagePrivata/index.html> clicca qui</a> per tornare alla Home.";
                }
                else {
                    $nome = $_POST['nome'];
                    $cognome = $_POST['cognome'];
                    $qnc = "select * from utente where nome=$1 and cognome=$2";
                    $resultnc=pg_query_params($dbconn, $qnc, array($nome, $cognome));
                    if (!($linenc=pg_fetch_array($resultnc, null, PGSQL_ASSOC))) {
                        echo "<h1> Questi dati non appartengono a nessun utente. </h1>
                        <a href=../cerca_concerto/cerca_concerto.html> Clicca qui</a> per riprovare con altri dati o
                        <a href=../LandingPagePrivata/index.html> clicca qui</a> per tornare alla Home.";
                    }
                    else {
                        $numerobiglietti = $_POST['carrello'];
                        if($numerobiglietti==0){
                            echo "<h1>Non hai aggiunto nessun biglietto al carrello. </h1>
                            <a href=../cerca_concerto/cerca_concerto.html> Clicca qui</a> per tornare alla pagina precedente o
                            <a href=../LandingPagePrivata/index.html> clicca qui</a> per tornare alla Home.";
                        }
                        else{
                            $q2="select * from concerto where codice = $1";
                            $result2=pg_query_params($dbconn, $q2, array($codice));
                            $line2=pg_fetch_array($result2, null, PGSQL_ASSOC);
                            $postidisponibili=$line2['postidisponibili'];
                            $postidisponibili=$postidisponibili-$numerobiglietti;
                            if ($postidisponibili > 0) {
                                $q3="update concerto set postidisponibili=$1 where codice=$2";
                                $data=pg_query_params($dbconn, $q3, array($postidisponibili, $codice));
                                $q4="select email from utente where nome=$1 and cognome=$2";
                                $result4=pg_query_params($dbconn, $q4, array($nome, $cognome));
                                $line4=pg_fetch_array($result4, null, PGSQL_ASSOC);
                                $email=$line4['email'];
                                $q5="insert into biglietti values ($1,$2,$3)";
                                $data=pg_query_params($dbconn, $q5, array($codice, $email, $numerobiglietti));
                                echo "<h1>L'acquisto è avvenuto con successo. </h1>
                                <a href=../cerca_concerto/cerca_concerto.html> Clicca qui</a> per tornare alla pagina precedente o
                                <a href=../LandingPagePrivata/index.html> clicca qui</a> per tornare alla Home.";
                            }
                            else{
                                echo "<h1>I biglietti per questo concerto sono esauriti. </h1>
                                <a href=../LandingPagePrivata/index.html>Clicca qui</a> per tornare alla Home.";
                            }
                        }
                    }
                }
            }
        ?>
    </body>
</html>
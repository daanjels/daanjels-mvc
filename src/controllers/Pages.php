<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->pageModel = $this->model('Page');
        // activate models here: $this->exampleModel = $this->model('Example');
        // for now we'll keep this simple and do most stuff in the views
        // later on we may collect parts from the database
        // especially to add stuff in the header (title, description), or to add classes (wrap)
    }

    public function index()
    {
        // $example = $this->exampleModel->getExample();
        $imagePortrait = URLROOT.'/media/img/homeCloseUp';
        $altPortrait = 'Detail van ogen';
        $imagePainting = URLROOT.'/media/img/homePond';
        $altPainting = 'Detail vijver';
        $imageDrawing = URLROOT.'/media/img/homeStable';
        $altDrawing = 'Detail stal';
        $quote = $this->pageModel->getQuote();

        $data = [
            'title' => 'd a: n j ə l s  -  kunstwerken van Daanjels',
            'page' => 'index',
            'menu' => 'da:njəls',
            'wrap' => 'canvas',
            'content' => '
                <article>' . 
                    insertPicture($imagePortrait, $altPortrait) .
                    '<h1>Portret</h1>
                    <p>Daanjels is kunstschilder, tekenaar en liefhebber van Argentijnse tango.
                    Hij is gepassioneerd door het weergeven van iemands persoonlijkheid.
                    Als je graag een geschilderd portret laat maken van iemand die je lief is, neem gerust <a href="contact">contact </a>op!</p>
                </article>
                <article>' . 
                    insertPicture($imagePainting, $altPainting) .
                    '<h1>Schilderen</h1>
                    <p>Om tot rust te komen schildert Daanjels soms landschappen.
                    Daarbij werkt hij graag ‘en plein air’.
                    Sporadische deelnames aan modelsessies vergen meer energie, ze houden hem scherp.
                    Werp gerust een blik op zijn werk.
                    Alle schilderijen en tekeningen zijn te koop.</p>
                </article>
                <article>' . 
                    insertPicture($imageDrawing, $altDrawing) .
                    '</picture>
                    <h1>Tekenen</h1>
                    <p>Tussen al het andere leven door, tekent Daanjels om voortdurend bij te leren.
                        De schetsboekjes raken steeds vlotter gevuld.
                        Volg hem op <a href="https://www.instagram.com/daanjels">instagram</a>!</p>
                    <h4>Contact</h4>
                    <p>Bij vragen over het maken van een geschilderd portret, aankoop van een werk of over plein air activiteiten,
                        <a href="contact">contacteer ons</a>.</p>
                </article>
                ',
            'quote' => $quote
        ];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title'=>'Wie is Daanjels, de portretschilder',
            'page' => 'about',
            'menu' => 'Wie?',
            'wrap' => 'paper',
            'headline' => 'Opkomst van een portretschilder',
            'content' => '
                <p>
                    <img src="'.URLROOT.'/media/img/Atelier.jpg" alt="Atelier buiten" class="inline-left">
                    Tekenen kan iedereen. We hebben allemaal getekend nog voor we leerden schrijven.
                    En hoe zalig was het niet om met kleuren aan de slag te gaan.
                    Ik ben het nooit vergeten.</p>
                <p>Al heb ik net als iedereen te vaak met onhandig materiaal en gebrekkige instructies moeten werken.
                    Voor mij kwam daar verandering in toen ik mijn opleiding als grafisch vormgever volgde.
                    Toen merkte ik voor het eerst hoe prettig het is om met olieverf aan de slag te gaan.</p>
                <p>Gek genoeg heeft het daarna twintig jaar geduurd voor ik de juiste beslissing heb genomen om me daar verder in te verdiepen.</p>
                <h4>Kreateur</h4>
                <p>
                    <img src="'.URLROOT.'/media/img/Kat.jpg" alt="Kat" class="inline-right">
                    Dankzij de juiste begeleiding en veel oefening zit ik nu op een punt om met mijn werk naar buiten te komen.
                    Al heb ik de laatste jaren niets achtergehouden.</p>
                <p>Op mijn blog <em><a href="https://www.wim-daniels.be">Kreateur </a></em>heb ik tijdens de opleiding in Slac een dagboek bijgehouden.
                    Daarin kan je lezen hoe het eraan toe gaat tijdens de schilderlessen.
                    Tussen de regels door krijg je veel tips die nuttig kunnen zijn voor aspirant schilders.</p>
                <h4>Plein air</h4>
                    <p>
                    <img src="'.URLROOT.'/media/img/Geertrui.jpg" alt="Geertrui" class="inline-left">
                    Naast het werk met olieverf heb ik in mijn vrije tijd stevig geoefend op aquarel.
                    Via de <em>Zomerschilderdagen </em>van Heist-op-den-Berg ben ik beginnen schilderen in open lucht — en plein air zoals dat heet - waarbij waterverf beduidend handiger is.</p>
                <p>Ondertussen ga ik ook regelmatig met enkele vrienden van de academie buiten schilderen.
                    Of ik doe mee met de <em>Urban sketchers </em>die in hun schetsboeken het leven in de steden capteren.</p>
                <h4>Portret</h4>
                <p>
                    <img src="'.URLROOT.'/media/img/Begijnhof.jpg" alt="Begijnhof" class="inline-right">
                    Na al dat oefenen en proeven gaat mijn voorliefde uit naar de portretkunst.
                    Om in een portret naast de gelijkenis ook sfeer en gevoel te leggen, dat blijft de ware uitdaging.
                    Je moet dan balanceren tussen precisie en spontaniteit.</p>
                <p>Af en toe is het een kwestie van geluk, vaker een kwestie van hard werken.</p>
                <p>Geniet op mijn site van een selectie uit mijn collectie.
                    Bij vragen over plein air, urban sketching of het maken van een geschilderd portret, laat van je <a href="contact">horen</a>.</p>
                ',
        ];
        $this->view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title'         => 'Contacteer Daanjels',
            'page'          => 'contact',
            'menu'          => 'Contact',
            'wrap'          => 'paper',
            'voornaam'      => "",
            'familienaam'   => "",
            'email'         => "",
            'bericht'       => "",
            'fout'          => "",
            'PH_voornaam'   => "Naam",
            'PH_familienaam' => "Familienaam",
            'PH_email'      => "E-mail",
            'PH_bericht'    => "Jouw bericht",
            'retval'        => "",
            ];
    
        if (!empty($_POST)) {
            $data['voornaam'] = trim(filter_input(INPUT_POST, 'Firstname', FILTER_SANITIZE_STRING));
            $data['familienaam'] = trim(filter_input(INPUT_POST, 'Lastname', FILTER_SANITIZE_STRING));
            $data['email'] = trim(filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING));
            $data['bericht'] = trim(filter_input(INPUT_POST, 'Message', FILTER_SANITIZE_STRING));
            
            if ($data['voornaam'] == '') { // geen voornaam ingevuld
                $data['PH_voornaam'] = "Je hebt je naam niet ingevuld...";
            } else if ($data['familienaam'] == '') { // geen familienaam ingevuld
                $data['PH_familienaam'] = "Je hebt je familienaam niet ingevuld...";
            } else if ($data['email'] == '') { // geen e-mail ingevuld
                $data['PH_email'] = "Je hebt je e-mailadres niet ingevuld...";
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['fout_email'] = "Controleer je e-mail adres even, dat lijkt niet correct.";
            } else if ($data['bericht'] == '') { // geen bericht geschreven
                $data['PH_bericht'] = "Je hebt geen bericht geschreven !!";
            } else if (strlen($data['bericht']) > 1000) { // te lang bericht gemaakt
                $data['fout_bericht'] = "Je bericht bevat <strong>".strlen($data['bericht'])." </strong>tekens. Slechts 1000 toegelaten.";
            } else {
                $to = "info@daanjels.be";
                $subject = "Vraag via de site";
                $message = $data['bericht'] . "\n" . $data['voornaam'] . " " . $data['familienaam'];
                $headers[] = "From: " . $data['email'];
                $headers[] = "Content-Type: text/plain; charset=utf-8";
                $header = implode("\r\n", $headers);
                $data['retval'] = mail ($to,$subject,$message,$header);
                if( $data['retval'] == true ) {
                    // echo "<br/><br/><br/><pre>Message is being sent...</pre>";
                    header( 'refresh:3;url='.URLROOT.'/index' );
                    // exit(0);
                } else {
                    echo "Message could not be sent...";
                }
            }
        }
    
        $this->view('pages/contact', $data);
    }
    public function design()
    {
        $data = [
            'title'=>'Design Daanjels',
            'page' => 'design',
            'menu' => 'Design',
            'wrap' => 'paper',
        ];
        $this->view('pages/design', $data);
    }
    public function sitemap()
    {
        $data = [
            'title'=>'Sitemap Daanjels',
            'page' => 'sitemap',
            'menu' => 'Sitemap',
            'wrap' => 'paper',
        ];
        $this->view('pages/sitemap', $data);
    }
}